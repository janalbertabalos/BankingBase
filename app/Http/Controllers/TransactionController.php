<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with('account')
            ->latest()
            ->paginate(10);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $accountsQuery = Account::query();

        if (auth()->check()) {
            $accountsQuery->where('user_id', auth()->id());
        }

        $accounts = $accountsQuery->orderBy('account_number')->get();

        return view('transactions.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'account_id' => ['required', 'integer', 'exists:accounts,id'],
            'type' => ['required', Rule::in(['deposit', 'withdrawal'])],
            'amount' => ['required', 'numeric', 'min:1'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ]);

        $transaction = DB::transaction(function () use ($validated) {
            $accountQuery = Account::whereKey($validated['account_id']);

            if (auth()->check()) {
                $accountQuery->where('user_id', auth()->id());
            }

            $account = $accountQuery->lockForUpdate()->firstOrFail();

            if ($validated['type'] === 'withdrawal') {
                $remaining = (float) $account->balance - (float) $validated['amount'];

                if ($remaining < (float) $account->minimum_balance || $remaining < 0) {
                    throw ValidationException::withMessages([
                        'amount' => 'Insufficient funds. You must maintain the minimum balance.',
                    ]);
                }
            }

            return $account->transactions()->create([
                'type' => $validated['type'],
                'amount' => $validated['amount'],
                'reference_number' => (string) Str::uuid(),
                'notes' => $validated['notes'] ?? null,
            ]);
        });

        return redirect()
            ->route('transactions.index')
            ->with('success', 'Transaction completed successfully.');
    }
}
