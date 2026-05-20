<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CanchApp Reservas')</title>
    <style>
        :root {
            --bg: #f4f7fb;
            --card: #ffffff;
            --text: #1f2937;
            --muted: #6b7280;
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --danger: #dc2626;
            --success: #16a34a;
            --border: #e5e7eb;
            --warning: #f59e0b;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: var(--bg);
            color: var(--text);
        }
        .navbar {
            background: #0f172a;
            color: white;
            padding: 16px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
        }
        .brand { font-weight: 700; font-size: 20px; color: white; text-decoration: none; }
        .nav-links { display: flex; gap: 12px; align-items: center; }
        .nav-links a { color: #dbeafe; text-decoration: none; font-weight: 600; }
        .nav-links a:hover { color: white; }
        .container { max-width: 1120px; margin: 28px auto; padding: 0 18px; }
        .card {
            background: var(--card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
            padding: 22px;
            margin-bottom: 20px;
        }
        .header-row, .actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }
        h1, h2, h3 { margin-top: 0; }
        .muted { color: var(--muted); }
        .grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
        .stat { border-left: 5px solid var(--primary); padding: 16px; border-radius: 12px; background: #f8fafc; }
        .stat strong { display: block; font-size: 28px; margin-bottom: 4px; }
        .btn {
            display: inline-block;
            border: 0;
            border-radius: 10px;
            padding: 10px 14px;
            color: white;
            background: var(--primary);
            text-decoration: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
        }
        .btn:hover { background: var(--primary-dark); }
        .btn.secondary { background: #475569; }
        .btn.danger { background: var(--danger); }
        .btn.success { background: var(--success); }
        .btn.warning { background: var(--warning); color: #111827; }
        table { width: 100%; border-collapse: collapse; overflow: hidden; }
        th, td { padding: 12px 10px; border-bottom: 1px solid var(--border); text-align: left; vertical-align: top; }
        th { background: #f8fafc; color: #334155; }
        tr:hover td { background: #fbfdff; }
        .badge {
            display: inline-block;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 12px;
            font-weight: 700;
            background: #e0f2fe;
            color: #075985;
        }
        .badge.confirmada { background: #dcfce7; color: #166534; }
        .badge.cancelada { background: #fee2e2; color: #991b1b; }
        .badge.finalizada { background: #ede9fe; color: #5b21b6; }
        .badge.pendiente { background: #fef3c7; color: #92400e; }
        .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        label { display: block; font-weight: 700; margin-bottom: 6px; }
        input, select, textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 15px;
            background: white;
        }
        textarea { min-height: 96px; resize: vertical; }
        .error { color: var(--danger); font-size: 13px; margin-top: 5px; }
        .alert { border-radius: 12px; padding: 14px 16px; margin-bottom: 18px; }
        .alert.success { background: #dcfce7; color: #14532d; border: 1px solid #86efac; }
        .checkbox-group { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .checkbox-card { border: 1px solid var(--border); border-radius: 12px; padding: 10px; background: #f8fafc; }
        .checkbox-card input { width: auto; margin-right: 8px; }
        .pagination { margin-top: 16px; }
        .detail-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
        .detail-item { background: #f8fafc; border: 1px solid var(--border); border-radius: 12px; padding: 14px; }
        .filter-form { display: grid; grid-template-columns: 2fr 1fr auto; gap: 10px; align-items: end; }
        @media (max-width: 800px) {
            .grid, .form-grid, .detail-grid, .checkbox-group, .filter-form { grid-template-columns: 1fr; }
            .navbar { flex-direction: column; align-items: flex-start; }
            table { font-size: 14px; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="brand">CanchApp Reservas</a>
        <div class="nav-links">
            <a href="{{ route('home') }}">Inicio</a>
            <a href="{{ route('reservas.index') }}">Reservas</a>
            <a href="{{ route('reservas.create') }}">Nueva reserva</a>
        </div>
    </nav>

    <main class="container">
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
</body>
</html>
