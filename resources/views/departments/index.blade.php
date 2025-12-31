@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h2>Departments</h2>
    </div>

    <div class="form-container">
        <form method="POST" action="{{ route('departments.store') }}">
            @csrf
            <div class="form-group">
                <input type="text" name="name" class="form-input" placeholder="Department Name" required>
            </div>
            <button type="submit" class="btn-submit">Add Department</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>
        @foreach($departments as $dept)
            <tr>
                <td>{{ $dept->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <style>
        .page-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto 30px auto;
            background: #fff;
            padding: 20px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-input {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 14px;
        }

        .form-input:focus {
            border-color: #4f46e5;
            outline: none;
        }

        .btn-submit {
            width: 100%;
            padding: 10px 0;
            background: #4f46e5;
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.3s;
        }

        .btn-submit:hover {
            background: #4338ca;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        tr:nth-child(even) {
            background: #f9fafb;
        }
    </style>

@endsection
