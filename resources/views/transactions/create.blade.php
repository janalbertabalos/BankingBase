
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Transaction | JAR Bank</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background: #f1f5f9; color: #1e293b; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 245px; background: #102342; color: white; padding: 30px 20px; }
        .brand { font-size: 23px; font-weight: bold; margin-bottom: 45px; }
        .brand span { color: #60a5fa; }
        .nav-title { color: #94a3b8; font-size: 12px; margin: 25px 12px 12px; }
        .nav-link { display: block; padding: 14px 12px; color: #dbeafe; text-decoration: none; border-radius: 8px; margin-bottom: 8px; }
        .nav-link:hover, .active { background: #2563eb; color: white; }
        .main { flex: 1; padding: 35px; }
        .subtitle { color: #64748b; margin-top: 8px; }
        .heading { margin-bottom: 28px; }
        .panel { max-width: 760px; background: white; padding: 30px; border: 1px solid #e2e8f0; border-radius: 14px; box-shadow: 0 4px 15px #0f172a08; }
        .field { margin-bottom: 22px; }
        label { display: block; font-size: 14px; font-weight: bold; margin-bottom: 9px; }
        input, select, textarea { width: 100%; padding: 13px 14px; border: 1px solid #cbd5e1; border-radius: 8px; background: white; font-size: 15px; }
        input:focus, select:focus, textarea:focus { outline: 2px solid #bfdbfe; border-color: #2563eb; }
        textarea { resize: vertical; }
        .button { display: inline-block; background: #2563eb; color: white; padding: 13px 20px; border: 0; border-radius: 8px; text-decoration: none; cursor: pointer; font-weight: bold; }
        .button:hover { background: #1d4ed8; }
        .secondary { background: #eaf2ff; color: #1d4ed8; }
        .secondary:hover { background: #dbeafe; }
        .error { color: #dc2626; font-size: 13px; margin-top: 7px; }
        .alert { background: #fee2e2; color: #991b1b; padding: 13px; border-radius: 8px; margin-bottom: 20px; }
        .actions { display: flex; gap: 12px; flex-wrap: wrap; }
        @media(max-width:650px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 18px; }
            .brand { margin-bottom: 18px; }
            .nav-title { display: none; }
            .nav-link { display: inline-block; margin: 5px 3px 0 0; padding: 10px; }
            .main { padding: 20px; }
            .panel { padding: 20px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">JAR<span>Bank.</span></div>
        <div class="nav-title">Main Menu</div>
        <a href="/dashboard" class="nav-link">▦ Dashboard</a>
        <a href="/transactions" class="nav-link">↔ Transactions</a>
        <a href="/transactions/create" class="nav-link active">＋ New Transaction</a>
    </aside>

    <main class="main">
        <div class="heading">
            <h1>New Transaction</h1>
            <p class="subtitle">Make a deposit or withdrawal from an account.</p>
        </div>

        <div class="panel">
            @if ($errors->any())
                <div class="alert">
                    <strong>Please check the following:</strong>
                    <ul style="padding-left:20px; margin-top:8px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <div class="field">
                    <label for="account_id">Bank Account</label>
                    <select name="account_id" id="account_id" required>
                        <option value="">Choose an account</option>
                        @foreach ($accounts as $account)
                            <option value="{{ $account->id }}" @selected(old('account_id') == $account->id)>
                                {{ $account->account_number }} — ₱{{ number_format($account->balance, 2) }}
                            </option>
                        @endforeach
                    </select>
                    @error('account_id') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="type">Transaction Type</label>
                    <select name="type" id="type" required>
                        <option value="deposit" @selected(old('type') == 'deposit')>Deposit</option>
                        <option value="withdrawal" @selected(old('type') == 'withdrawal')>Withdrawal</option>
                    </select>
                </div>

                <div class="field">
                    <label for="amount">Amount (₱)</label>
                    <input type="number" name="amount" id="amount" min="1" step="0.01" value="{{ old('amount') }}" placeholder="Enter amount" required>
                    @error('amount') <p class="error">{{ $message }}</p> @enderror
                </div>

                <div class="field">
                    <label for="notes">Notes (optional)</label>
                    <textarea name="notes" id="notes" rows="3" placeholder="Add a short note">{{ old('notes') }}</textarea>
                </div>

                <div class="actions">
                    <button type="submit" class="button">Submit Transaction</button>
                    <a href="/transactions" class="button secondary">View History</a>
                </div>
            </form>
        </div>
    </main>
</div>
</body>
</html>
