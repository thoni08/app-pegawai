<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendance = Attendance::with('employee')->latest()->paginate(5);
        $employees  = Employee::all();
        $statuses   = Attendance::STATUS_OPTIONS;

        return view('attendance.index', compact('attendance', 'employees', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $employees = Employee::all();
        $statuses  = Attendance::STATUS_OPTIONS;
        return view('attendance.create', compact('employees', 'statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date', 
            'waktu_masuk'    => 'required|date_format:H:i', 
            'waktu_keluar'   => 'required|date_format:H:i', 
            'status_absensi' => ['required', Rule::in(Attendance::STATUS_OPTIONS)],
        ]); 
        Attendance::create($request->all()); 
        return redirect()->route('attendance.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $attendance = Attendance::with('employee')->findOrFail($id);
        return view('attendance.show', compact('attendance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $attendance = Attendance::findOrFail($id);
        $employees  = Employee::all();
        $statuses   = Attendance::STATUS_OPTIONS;
        return view('attendance.edit', compact('attendance', 'employees', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'karyawan_id'    => 'required|exists:employees,id',
            'tanggal'        => 'required|date', 
            'waktu_masuk'    => 'required', 
            'waktu_keluar'   => 'required', 
            'status_absensi' => ['required', Rule::in(Attendance::STATUS_OPTIONS)],
        ]); 
        $attendance = Attendance::findOrFail($id); 
        $attendance->update($request->only([ 
            'karyawan_id', 
            'tanggal', 
            'waktu_masuk', 
            'waktu_keluar', 
            'status_absensi',
        ])); 
        return redirect()->route('attendance.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attendance = Attendance::find($id);
        $attendance->delete();
        return redirect()->route('attendance.index');
    }
}