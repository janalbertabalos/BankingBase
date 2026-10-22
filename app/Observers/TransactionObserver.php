<?php

namespace App\Observers;

use App\Models\Transaction;
use App\Notifications\LowBalanceNotification;
use Illuminate\Validation\ValidationException;

class TransactionObserver
{
    public function created(Transaction $transaction): void
    {
        $account = $transaction->account()
            ->lockForUpdate()
            ->firstOrFail();

        $oldBalance = (float) $account->balance;
        $amount = (float) $transaction->amount;
        $minimum = (float) $account->minimum_balance;

        if ($amount <= 0) {
            throw ValidationException::withMessages([
                'amount' => 'The amount must be greater than zero.',
            ]);
        }

        if ($transaction->type === 'deposit') {
            $newBalance = $oldBalance + $amount;
        } elseif (in_array($transaction->type, ['withdrawal', 'transfer'], true)) {
            $newBalance = $oldBalance - $amount;
        } else {
            throw ValidationException::withMessages([
                'type' => 'Unsupported transaction type.',
            ]);
        }

        if ($newBalance < $minimum || $newBalance < 0) {
            throw ValidationException::withMessages([
                'amount' => 'Insufficient funds. The minimum balance must be maintained.',
            ]);
        }

        $account->balance = number_format($newBalance, 2, '.', '');
        $account->save();

        if (
            $transaction->type === 'withdrawal' &&
            $oldBalance > $minimum &&
            $newBalance <= $minimum
        ) {
            $account->user->notify(
                (new LowBalanceNotification($account->fresh()))->afterCommit()
            );
        }
    }
}
