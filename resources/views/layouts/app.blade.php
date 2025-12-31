<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'HRMS' }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: #f5f5f5;
        }

        nav {
            background: #4f46e5;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin-right: 15px;
            font-weight: 500;
        }

        nav a:hover {
            text-decoration: underline;
        }

        nav form button {
            background: #fff;
            color: #4f46e5;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
        }

        nav form button:hover {
            background: #e0e0ff;
        }

        .container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: #fff;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        tr:nth-child(even) {
            background: #f9f9f9;
        }

        .alert-success {
            background: #d1fae5;
            color: #065f46;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

        .alert-error {
            background: #fee2e2;
            color: #b91c1c;
            padding: 10px 15px;
            border-radius: 5px;
            margin-bottom: 15px;
        }

    </style>
</head>
<body>

<nav>
    <div>
        <a href="{{ url('/') }}">{{ 'HRMS' }}</a>
    </div>

    <div>
        @auth
            <a href="{{ route('employees.index') }}">Employees</a>
            <a href="{{ route('departments.index') }}">Departments</a>
            <a href="{{ route('skills.index') }}">Skills</a>

            <form method="POST" action="{{ route('logout') }}" style="display:inline">
                @csrf
                <button type="submit">Logout</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
            @endif
        @endauth
    </div>
</nav>

<div class="container">

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')

</div>

</body>
</html>
