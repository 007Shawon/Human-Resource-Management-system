<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Skill;
use Illuminate\Http\Request;
class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index', [
            'employees' => Employee::with('department', 'skills')->get(),
            'departments' => Department::all()
        ]);
    }

    public function create()
    {
        return view('employees.create', [
            'departments' => Department::all(),
            'skills' => Skill::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:employees,email',
            'department_id' => 'required',
            'skills' => 'array'
        ]);

        $employee = Employee::create($request->only([
            'first_name','last_name','email','department_id'
        ]));

        $employee->skills()->sync($request->skills);

        return redirect()->route('employees.index');
    }

    public function show(Employee $employee)
    {
        return view('employees.show', compact('employee'));
    }

    public function edit(Employee $employee)
    {
        return view('employees.edit', [
            'employee' => $employee,
            'departments' => Department::all(),
            'skills' => Skill::all()
        ]);
    }

    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'email'      => 'required|email|unique:employees,email,' . $employee->id,
            'department_id' => 'required',
            'skills' => 'array'
        ]);

        $employee->update($request->only([
            'first_name','last_name','email','department_id'
        ]));

        $employee->skills()->sync($request->skills ?? []);

        return redirect()->route('employees.index');
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return back();
    }

    // AJAX Filter
    public function filter($departmentId)
    {
        return Employee::with('department', 'skills')
            ->where('department_id', $departmentId)
            ->get();
    }
    public function checkEmail(Request $request)
    {
        return Employee::where('email', $request->email)
            ->when($request->id, fn ($q) => $q->where('id', '!=', $request->id))
            ->exists();
    }


}

