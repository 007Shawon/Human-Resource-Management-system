@extends('layouts.app')

@section('content')

    <div class="page-header">
        <h2>Employees</h2>
        <a href="{{ route('employees.create') }}" class="btn-add">+ Add Employee</a>
    </div>

    <div class="filter-section">
        <label for="departmentFilter">Filter by Department:</label>
        <select id="departmentFilter" class="filter-select">
            <option value="">All Departments</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
        </select>
    </div>

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
                        {{ $skill->name }}
                        @if(!$loop->last), @endif
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('employees.show', $employee) }}" class="btn-view">View</a>
                    <a href="{{ route('employees.edit', $employee) }}" class="btn-edit">Edit</a>
                    <button class="btn-delete delete-btn" data-id="{{ $employee->id }}">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .btn-add {
            background: #4f46e5;
            color: #fff;
            padding: 6px 14px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            transition: background 0.3s;
        }
        .btn-add:hover { background: #4338ca; }

        .filter-section {
            margin-bottom: 15px;
        }
        .filter-select {
            padding: 6px 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            min-width: 200px;
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

        th { background: #f3f4f6; }

        td span {
            display: inline-block;
            margin-right: 4px;
            background: #eef2ff;
            color: #4f46e5;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 13px;
        }

        tr:nth-child(even) { background: #f9fafb; }

        .btn-view {
            background: #10b981;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
        }
        .btn-view:hover { background: #059669; }

        .btn-edit {
            background: #f59e0b;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            text-decoration: none;
            margin-right: 5px;
        }
        .btn-edit:hover { background: #d97706; }

        .btn-delete {
            background: #ef4444;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-delete:hover { background: #b91c1c; }

    </style>

    <script>
        $(document).ready(function () {

            // Filter employees by department
            $('#departmentFilter').change(function () {
                let deptId = $(this).val();

                $.get(deptId ? '/employees/filter/' + deptId : '/employees', function (employees) {
                    let rows = '';

                    employees.forEach(emp => {
                        let skills = '';
                        emp.skills.forEach(skill => { skills += skill.name + ', '; });
                        skills = skills.replace(/, $/, '');

                        rows += `
                <tr>
                    <td>${emp.first_name} ${emp.last_name}</td>
                    <td>${emp.email}</td>
                    <td>${emp.department.name}</td>
                    <td>${skills}</td>
                    <td>
                        <a href="/employees/${emp.id}" class="btn-view">View</a>
                        <a href="/employees/${emp.id}/edit" class="btn-edit">Edit</a>
                        <button class="btn-delete delete-btn" data-id="${emp.id}">Delete</button>
                    </td>
                </tr>
                `;
                    });

                    $('#employeeTable').html(rows);
                });
            });

            // AJAX delete without reload
            $(document).on('click', '.delete-btn', function () {
                if (!confirm('Delete?')) return;

                let $btn = $(this);
                let id = $btn.data('id');

                $.ajax({
                    url: '/employees/' + id,
                    type: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                    success: function () {
                        $btn.closest('tr').remove(); // Remove row
                    },
                    error: function () {
                        alert('Unable to delete employee. Please try again.');
                    }
                });
            });

        });
    </script>

@endsection
