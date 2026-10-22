
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction History | JAR Bank</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: Arial, sans-serif; }
        body { background: #f1f5f9; color: #1e293b; }
        .layout { display: flex; min-height: 100vh; }
        .sidebar { width: 245px; background: #102342; color: white; padding: 30px 20px; flex-shrink: 0; }
        .brand { font-size: 23px; font-weight: bold; margin-bottom: 45px; }
        .brand span { color: #60a5fa; }
        .nav-title { color: #94a3b8; font-size: 12px; margin: 25px 12px 12px; }
        .nav-link { display: block; padding: 14px 12px; color: #dbeafe; text-decoration: none; border-radius: 8px; margin-bottom: 8px; }
        .nav-link:hover, .active { background: #2563eb; color: white; }
        .main { flex: 1; min-width: 0; padding: 35px; }
        .heading { display: flex; justify-content: space-between; align-items: center; gap: 15px; flex-wrap: wrap; margin-bottom: 28px; }
        .subtitle { color: #64748b; margin-top: 8px; }
        .button { display: inline-block; background: #2563eb; color: white; padding: 12px 17px; border-radius: 8px; text-decoration: none; font-size: 14px; font-weight: bold; }
        .button:hover { background: #1d4ed8; }
        .panel { background: white; border: 1px solid #e2e8f0; border-radius: 14px; padding: 24px; overflow: hidden; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; min-width: 750px; }
        th, td { text-align: left; padding: 15px 13px; border-bottom: 1px solid #e2e8f0; font-size: 14px; }
        th { background: #f8fafc; color: #64748b; font-size: 12px; text-transform: uppercase; }
        tbody tr:hover { background: #f8fafc; }
        .badge { display: inline-block; padding: 6px 10px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .deposit { background: #dcfce7; color: #166534; }
        .withdrawal { background: #fee2e2; color: #991b1b; }
        .empty { text-align: center; color: #64748b; padding: 35px; }
        .amount { font-weight: bold; }
        @media(max-width:650px) {
            .layout { display: block; }
            .sidebar { width: 100%; padding: 18px; }
            .brand { margin-bottom: 18px; }
            .nav-title { display: none; }
            .nav-link { display: inline-block; margin: 5px 3px 0 0; padding: 10px; }
            .main { padding: 20px; }
            .panel { padding: 14px; }
        }
    </style>
</head>
<body>
<div class="layout">
    <aside class="sidebar">
        <div class="brand">JAR<span>Bank.</span></div>
        <div class="nav-title">Main Menu</div>
        <a href="/dashboard" class="nav-link">▦ Dashboard</a>
        <a href="/transactions" class="nav-link active">↔ Transactions</a>
        <a href="/transactions/create" class="nav-link">＋ New Transaction</a>
    </aside>

    <main class="main">
        <div class="heading">
            <div>
                <h1>Transaction History</h1>
                <p class="subtitle">Review all deposits and withdrawals.</p>
            </div>
            <a href="/transactions/create" class="button">＋ New Transaction</a>
        </div>

        <div class="panel">
            <div class="table-wrap">
                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Account</th>
                            <th>Type</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->created_at->format('M d, Y h:i A') }}</td>
                                <td>{{ $transaction->account->account_number ?? 'N/A' }}</td>
                                <td>
                                    <span class="badge {{ $transaction->type }}">
                                        {{ ucfirst($transaction->type) }}
                                    </span>
                                </td>
                                <td class="amount">₱{{ number_format($transaction->amount, 2) }}</td>
                                <td>{{ $transaction->reference_number ?? '—' }}</td>
                                <td>{{ $transaction->notes ?? '—' }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="empty">No transactions found yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</div>
</body>
</html>
