@extends('layouts.app')

@section('content')

    <div class="details-container">
        <h2>Employee Details</h2>

        <div class="details-card">
            <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
            <p><strong>Email:</strong> {{ $employee->email }}</p>
            <p><strong>Department:</strong> {{ $employee->department->name }}</p>

            <p><strong>Skills:</strong></p>
            <div class="skills-container">
                @foreach($employee->skills as $skill)
                    <span class="skill-tag">{{ $skill->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="btn-container">
            <a href="{{ route('employees.index') }}" class="btn-back">Back</a>
        </div>
    </div>

    <style>
        .details-container {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #1f2937;
        }

        .details-card {
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .details-card p {
            font-size: 16px;
            margin-bottom: 12px;
            color: #374151;
        }

        .skills-container {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 6px;
        }

        .skill-tag {
            background: #e0e7ff;
            color: #3730a3;
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        .btn-container {
            text-align: center; /* Center the button */
            margin-top: 20px;
        }

        .btn-back {
            display: inline-block;
            padding: 12px 250px;
            background: #4f46e5;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            transition: background 0.3s;
        }

        .btn-back:hover {
            background: #4338ca;
        }
    </style>

@endsection
