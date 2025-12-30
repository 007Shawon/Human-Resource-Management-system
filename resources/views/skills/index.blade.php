@extends('layouts.app')

@section('content')

    <h2>Skills</h2>

    <form method="POST" action="{{ route('skills.store') }}">
        @csrf
        <input name="name" placeholder="Skill Name">
        <button>Add</button>
    </form>

    <table>
        <tr>
            <th>Name</th>
        </tr>
        @foreach($skills as $skill)
            <tr>
                <td>{{ $skill->name }}</td>
            </tr>
        @endforeach
    </table>

@endsection
