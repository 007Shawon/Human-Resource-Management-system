@extends('layouts.app')

@section('content')

    <h2>Departments</h2>

    <form method="POST" action="{{ route('departments.store') }}">
        @csrf
        <input name="name" placeholder="Department Name">
        <button>Add</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
        </tr>
        @foreach($departments as $dept)
            <tr>
                <td>{{ $dept->name }}</td>
            </tr>
        @endforeach
    </table>

@endsection
