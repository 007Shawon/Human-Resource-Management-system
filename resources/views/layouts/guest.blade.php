<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{  'HRMS' }}</title>

    <!-- Google Fonts or your custom font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

    <!-- Tailwind / CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* disables page scrolling */
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: url('/images/background.jpg') no-repeat center center fixed;
            background-size: cover;

            /* Flexbox to center the form */
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .auth-container {
            max-width: 400px; /* keep original width */
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            /* text and inputs remain unchanged */
        }

        .auth-logo {
            display: block;
            margin: 0 auto 20px;
            width: 100px;
        }
    </style>

</head>
<body>

<div class="auth-container">
    <!-- Replace Laravel logo with your custom logo -->
    <img src="/images/my-logo.jpg" alt="Logo" class="auth-logo">

    {{ $slot }}
</div>

</body>
</html>
