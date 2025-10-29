<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salaries;
use Illuminate\Http\Request;

class SalariesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salaries = Salaries::with('employee')->latest()->paginate(5);

        return view('salaries.index', compact('salaries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    $employees = Employee::with('position')->get();
        return view('salaries.create', compact('employees'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:255', 
            'gaji_pokok'  => 'required|numeric|between:0,99999999.99', 
            'tunjangan'   => 'required|numeric|between:0,99999999.99', 
            'potongan'    => 'required|numeric|between:0,99999999.99', 
            'total_gaji'  => 'required|numeric|between:0,99999999.99',
        ]);
        $payload = $this->preparePayload($validated);
        Salaries::create($payload); 
        return redirect()->route('salaries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $salaries = Salaries::with('employee')->findOrFail($id);
        return view('salaries.show', compact('salaries'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    $salaries = Salaries::findOrFail($id);
    $employees = Employee::with('position')->get();
        return view('salaries.edit', compact('salaries', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([ 
            'karyawan_id' => 'required|exists:employees,id',
            'bulan'       => 'required|string|max:255', 
            'gaji_pokok'  => 'required|numeric|between:0,99999999.99', 
            'tunjangan'   => 'required|numeric|between:0,99999999.99', 
            'potongan'    => 'required|numeric|between:0,99999999.99', 
            'total_gaji'  => 'required|numeric|between:0,99999999.99',
        ]); 
        $salaries = Salaries::findOrFail($id); 
        $payload = $this->preparePayload($validated);
        $salaries->update($payload);
        return redirect()->route('salaries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salaries = Salaries::findOrFail($id);
        $salaries->delete(); 
        return redirect()->route('salaries.index');
    }

    private function preparePayload(array $validated): array
    {
        $employee = Employee::with('position')->find($validated['karyawan_id']);

        if ($employee && $employee->position) {
            $validated['gaji_pokok'] = $employee->position->gaji_pokok;
        }

        $validated['total_gaji'] = $this->calculateTotal(
            $validated['gaji_pokok'] ?? 0,
            $validated['tunjangan'] ?? 0,
            $validated['potongan'] ?? 0
        );

        return $validated;
    }

    private function calculateTotal($gajiPokok, $tunjangan, $potongan): float
    {
        $gaji = (float) $gajiPokok;
        $allowance = (float) $tunjangan;
        $deduction = (float) $potongan;

        return round(($gaji + $allowance) - $deduction, 2);
    }
}
