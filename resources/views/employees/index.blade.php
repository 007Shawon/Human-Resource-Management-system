@extends('layouts.app')

@section('content')

    <h2>Employees</h2>

    <a href="{{ route('employees.create') }}">+ Add Employee</a>

    <br><br>

    <label>Filter by Department:</label>
    <select id="departmentFilter">
        <option value="">All</option>
        @foreach($departments as $dept)
            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
        @endforeach
    </select>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Department</th>
            <th>Skills</th>
            <th>Action</th>
        </tr>
        </thead>

        <tbody id="employeeTable">
        @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->department->name }}</td>

                <td>
                    @foreach($employee->skills as $skill)
                        <span>{{ $skill->name }}</span>@if(!$loop->last), @endif
                    @endforeach
                </td>

                <td>
                    <a href="{{ route('employees.show', $employee) }}">View</a>
                    <a href="{{ route('employees.edit', $employee) }}">Edit</a>

                    <form method="POST"
                          action="{{ route('employees.destroy', $employee) }}"
                          style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        $(document).ready(function () {

            $('#departmentFilter').change(function () {
                let deptId = $(this).val();

                if (!deptId) {
                    location.reload();
                    return;
                }

                $.get('/employees/filter/' + deptId, function (employees) {
                    let rows = '';

                    employees.forEach(emp => {

                        let skills = '';
                        emp.skills.forEach(skill => {
                            skills += skill.name + ', ';
                        });
                        skills = skills.replace(/, $/, '');

                        rows += `
                <tr>
                    <td>${emp.first_name} ${emp.last_name}</td>
                    <td>${emp.email}</td>
                    <td>${emp.department.name}</td>
                    <td>${skills}</td>
                    <td>
                        <a href="/employees/${emp.id}">View</a>
                        <a href="/employees/${emp.id}/edit">Edit</a>
                        <button class="delete-btn" data-id="${emp.id}">
                            Delete
                        </button>
                    </td>
                </tr>
                `;
                    });

                    $('#employeeTable').html(rows);
                });
            });

            // AJAX delete
            $(document).on('click', '.delete-btn', function () {
                if (!confirm('Delete?')) return;

                let id = $(this).data('id');

                $.ajax({
                    url: '/employees/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function () {
                        location.reload();
                    }
                });
            });

        });
    </script>

@endsection
