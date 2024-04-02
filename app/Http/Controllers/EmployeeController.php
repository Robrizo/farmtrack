<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    //
    public function index()
    {
        $employees = Employee::paginate(5);
        return response()->json(['employees' => $employees]);
    }

    public function show($id)
    {
        $employees = Employee::findOrFail($id);
        return response()->json(['employees' => $employees]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $employees = Employee::create($request->all());

        return response()->json(['message' => 'Employee created successfully', 'employees' => $employees]);
    }

    public function destroy($id)
    {
        $employees = Employee::findOrFail($id);
        $employees->delete();

        return response()->json(['message' => 'Employee deleted successfully']);
    }

    public function update(Request $request, $id)
    {
        $employees = Employee::findOrFail($id);

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'salary' => 'required|numeric',
        ]);

        $employees->update($request->all());

        return response()->json(['message' => 'Employee updated successfully', 'employees' => $employees]);
    }

    public function search($keyword)
    {
        $employees = Employee::where('firstname', 'like', "%$keyword%")->paginate(5);
        return response()->json(['employees' => $employees]);
    }

    public function totalEmployees()
    {
        $employees = Employee::count();

        return response()->json(['employees' => $employees]);
    }
}
