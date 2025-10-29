<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Department;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->string('search')->trim()->toString();
        $status = $request->string('status')->trim()->toString();

        $employeesQuery = Employee::with(['department', 'position'])->latest();

        if ($search !== '') {
            $employeesQuery->where(function ($query) use ($search) {
                $query->where('nama_lengkap', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('nomor_telepon', 'like', "%{$search}%");
            });
        }

        if ($status !== '' && in_array($status, Employee::STATUS_OPTIONS, true)) {
            $employeesQuery->where('status', $status);
        }

        $employees = $employeesQuery->paginate(5)->appends([
            'search' => $search !== '' ? $search : null,
            'status' => $status !== '' ? $status : null,
        ]);

        $statuses = Employee::STATUS_OPTIONS;

        return view('employees.index', compact('employees', 'statuses', 'search', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $departments = Department::all();
    $positions   = Position::all();
    $statuses    = Employee::STATUS_OPTIONS;

    return view('employees.create', compact('departments', 'positions', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'departemen_id'  => 'required|integer|exists:departments,id',
            'jabatan_id'     => 'required|integer|exists:positions,id',
            'status'         => ['required', Rule::in(Employee::STATUS_OPTIONS)],
        ]); 
        Employee::create($request->all()); 
        return redirect()->route('employees.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::with(['department', 'position'])->findOrFail($id);
        return view('employees.show', compact('employee')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $employee    = Employee::findOrFail($id);
    $departments = Department::all();
    $positions   = Position::all();
    $statuses    = Employee::STATUS_OPTIONS;

    return view('employees.edit', compact('employee', 'departments', 'positions', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|max:255',
            'nomor_telepon'  => 'required|string|max:20',
            'tanggal_lahir'  => 'required|date',
            'alamat'         => 'required|string|max:255',
            'tanggal_masuk'  => 'required|date',
            'departemen_id'  => 'required|integer|exists:departments,id',
            'jabatan_id'     => 'required|integer|exists:positions,id',
            'status'         => ['required', Rule::in(Employee::STATUS_OPTIONS)],
        ]);
        $employee = Employee::findOrFail($id); 
        $employee->update($request->only([
            'nama_lengkap',
            'email',
            'nomor_telepon',
            'tanggal_lahir',
            'alamat',
            'tanggal_masuk',
            'departemen_id',
            'jabatan_id',
            'status',
        ])); 
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id); 
        $employee->delete(); 
        return redirect()->route('employees.index');
    }
}
