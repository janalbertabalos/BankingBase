
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Banking Dashboard</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: #1e293b;
        }

        .layout {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 245px;
            background: #102342;
            color: white;
            padding: 30px 20px;
        }

        .brand {
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 45px;
        }

        .brand span {
            color: #60a5fa;
        }

        .nav-title {
            color: #94a3b8;
            font-size: 12px;
            margin: 25px 12px 12px;
            text-transform: uppercase;
        }

        .nav-link {
            display: block;
            padding: 14px 12px;
            color: #dbeafe;
            text-decoration: none;
            border-radius: 8px;
            margin-bottom: 8px;
        }

        .nav-link.active,
        .nav-link:hover {
            background: #2563eb;
            color: white;
        }

        .main {
            flex: 1;
            padding: 35px;
            min-width: 0;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 35px;
        }

        .topbar h1 {
            font-size: 28px;
        }

        .subtitle {
            color: #64748b;
            margin-top: 8px;
        }

        .profile {
            background: white;
            border: 1px solid #e2e8f0;
            padding: 12px 18px;
            border-radius: 10px;
            font-weight: bold;
        }

        .section-title {
            margin-bottom: 18px;
            font-size: 19px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.03);
        }

        .card-label {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 18px;
        }

        .card-value {
            font-size: 27px;
            font-weight: bold;
            overflow-wrap: anywhere;
        }

        .card-icon {
            width: 42px;
            height: 42px;
            display: grid;
            place-items: center;
            background: #dbeafe;
            color: #2563eb;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .panel {
            background: white;
            padding: 25px;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .panel-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background: #2563eb;
            color: white;
            padding: 12px 17px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .secondary {
            background: #eaf2ff;
            color: #1d4ed8;
        }

        .secondary:hover {
            background: #dbeafe;
        }

        .status {
            color: #64748b;
            font-size: 13px;
            margin-top: 18px;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        @media (max-width: 850px) {
            .sidebar {
                width: 190px;
            }

            .main {
                padding: 22px;
            }

            .cards {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 560px) {
            .layout {
                display: block;
            }

            .sidebar {
                width: 100%;
                padding: 18px;
            }

            .brand {
                margin-bottom: 18px;
            }

            .nav-title {
                display: none;
            }

            .nav-link {
                display: inline-block;
                margin: 5px 3px 0 0;
                padding: 10px;
            }

            .topbar {
                align-items: flex-start;
                flex-direction: column;
            }

            .main {
                padding: 18px;
            }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <div class="brand">JAR<span>Bank.</span></div>

            <div class="nav-title">Main Menu</div>
            <a href="/dashboard" class="nav-link active">▦ Dashboard</a>
            <a href="/transactions" class="nav-link">↔ Transactions</a>
            <a href="/transactions/create" class="nav-link">＋ New Transaction</a>
        </aside>

        <main class="main">
            <header class="topbar">
                <div>
                    <h1>Bank Dashboard</h1>
                    <p class="subtitle">Overview of your banking activity.</p>
                </div>

                <div class="profile">JAR Bank</div>
            </header>

            <h2 class="section-title">Financial Overview</h2>

            <section class="cards">
                <div class="card">
                    <div class="card-icon">▤</div>
                    <div class="card-label">Total Accounts</div>
                    <div class="card-value" id="total-accounts">0</div>
                </div>

                <div class="card">
                    <div class="card-icon">₱</div>
                    <div class="card-label">Total Money in Bank</div>
                    <div class="card-value" id="total-money">₱0.00</div>
                </div>

                <div class="card">
                    <div class="card-icon">↔</div>
                    <div class="card-label">Transactions Today</div>
                    <div class="card-value" id="transactions-today">0</div>
                </div>
            </section>

            <section class="panel">
                <div class="panel-header">
                    <div>
                        <h2 class="section-title">Quick Actions</h2>
                        <p class="subtitle">Manage your banking transactions.</p>
                    </div>
                </div>

                <div class="actions">
                    <a href="/transactions/create" class="button">＋ New Transaction</a>
                    <a href="/transactions" class="button secondary">View Transactions</a>
                </div>

                <p class="status" id="updated-at">Loading statistics...</p>
            </section>
        </main>
    </div>

    <script>
        async function loadDashboardStats() {
            try {
                const response = await fetch('/api/dashboard/stats');

                if (!response.ok) {
                    throw new Error('Failed to load statistics');
                }

                const stats = await response.json();

                document.getElementById('total-accounts').textContent =
                    stats.total_accounts;

                document.getElementById('total-money').textContent =
                    '₱' + Number(stats.total_money).toLocaleString('en-PH', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    });

                document.getElementById('transactions-today').textContent =
                    stats.transactions_today;

                document.getElementById('updated-at').textContent =
                    'Last updated: ' + new Date().toLocaleTimeString();
            } catch (error) {
                document.getElementById('updated-at').textContent =
                    'Unable to load statistics. Retrying shortly.';
            }
        }

        loadDashboardStats();
        setInterval(loadDashboardStats, 30000);
    </script>
</body>
</html>
