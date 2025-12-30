@extends('layouts.app')

@section('content')

    <h2>Employee Details</h2>

    <p><strong>Name:</strong> {{ $employee->first_name }} {{ $employee->last_name }}</p>
    <p><strong>Email:</strong> {{ $employee->email }}</p>
    <p><strong>Department:</strong> {{ $employee->department->name }}</p>

    <p><strong>Skills:</strong></p>
    <ul>
        @foreach($employee->skills as $skill)
            <li>{{ $skill->name }}</li>
        @endforeach
    </ul>

    <a href="{{ route('employees.index') }}">Back</a>

@endsection
