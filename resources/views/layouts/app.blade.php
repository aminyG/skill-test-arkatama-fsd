<!DOCTYPE html>
<html>
<head>
    <title>PetCare+</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: #f4f6f9;
        }
        .sidebar {
            width: 230px;
            background: #1e293b;
            color: white;
            position: fixed;
            top: 0;
            bottom: 0;
            padding: 20px;
        }
        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 5px;
        }
        .sidebar a:hover {
            background: #334155;
            color: white;
        }
        .content {
            margin-left: 250px;
            padding: 30px;
        }
        .logo {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">PetCare+</div>
    <a href="/">Dashboard</a>
    <a href="/owners">Pemilik</a>
    <a href="/pets">Data Hewan</a>
    <a href="/checkups">Pemeriksaan</a>
</div>

<div class="content">
    @yield('content')
</div>

</body>
</html>
