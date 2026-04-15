<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\InsurancesImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;

use App\Models\Insurance;
class InsuranceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $insurances = Insurance::all(); 
         return view('designer.insurances.index', compact('insurances'));
    }

    
  public function expire()
{
    $today = Carbon::today();

    $insurances = Insurance::whereDate('policy_end_date', '<', $today)
        ->latest()
        ->get();

    return view('designer.insurances.expire', compact('insurances'));
}

public function re_expire()
{
    $today = Carbon::today();
    $next30Days = Carbon::today()->addDays(30);

    $insurances = Insurance::whereDate('policy_end_date', '>=', $today)
        ->whereDate('policy_end_date', '<=', $next30Days)
        ->latest()
        ->get();

    return view('designer.insurances.re_expire', compact('insurances'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('designer.insurances.create');

    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
{
    $vehicleNumber = strtoupper(trim($request->vehicle_number));
    $vehicleNumber = str_replace([' ', '-'], '', $vehicleNumber);

    $request->merge([
        'vehicle_number' => $vehicleNumber
    ]);

    $request->validate([
        'full_name' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'address' => 'required|string',
        'city' => 'required|string|max:100',
        'state' => 'required|string|max:100',
        'pin_code' => 'required|string|max:10',

        'vehicle_number' => 'required|string|max:20|unique:insurances,vehicle_number',
        'vehicle_type' => 'required|string|max:50',
        'fuel_type' => 'required|string|max:50',
        'make_brand' => 'required|string|max:100',
        'model' => 'required|string|max:100',
        'manufacturing_year' => 'required|digits:4',

        'policy_type' => 'required|string|max:100',
        'insurance_company' => 'required|string|max:255',
        'policy_term' => 'required|string|max:100',
        'policy_start_date' => 'required|date',
        'policy_end_date' => 'required|date|after_or_equal:policy_start_date',
        'claim_in_previous_policy' => 'required|string|max:20',
    ], [
        'vehicle_number.unique' => 'This vehicle number already exists.',
    ]);

    Insurance::create([
        'full_name' => $request->full_name,
        'mobile_number' => $request->mobile_number,
        'email' => $request->email,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'occupation' => $request->occupation,
        'aadhaar_number' => $request->aadhaar_number,
        'pan_number' => $request->pan_number,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'pin_code' => $request->pin_code,

        'vehicle_number' => $request->vehicle_number,
        'vehicle_type' => $request->vehicle_type,
        'fuel_type' => $request->fuel_type,
        'make_brand' => $request->make_brand,
        'model' => $request->model,
        'variant' => $request->variant,
        'manufacturing_year' => $request->manufacturing_year,
        'registration_date' => $request->registration_date,
        'registration_city_rto' => $request->registration_city_rto,
        'engine_number' => $request->engine_number,
        'chassis_number' => $request->chassis_number,
        'current_idv' => $request->current_idv,

        'policy_type' => $request->policy_type,
        'insurance_company' => $request->insurance_company,
        'policy_term' => $request->policy_term,
        'policy_start_date' => $request->policy_start_date,
        'policy_end_date' => $request->policy_end_date,
        'ncb_percentage' => $request->ncb_percentage,

        'zero_dep_addon' => $request->has('zero_dep_addon'),
        'roadside_assistance' => $request->has('roadside_assistance'),
        'engine_protect' => $request->has('engine_protect'),
        'consumables_cover' => $request->has('consumables_cover'),

        'previous_insurer_name' => $request->previous_insurer_name,
        'previous_policy_number' => $request->previous_policy_number,
        'previous_policy_expiry_date' => $request->previous_policy_expiry_date,
        'claim_in_previous_policy' => $request->claim_in_previous_policy,
        'break_in_case' => $request->break_in_case,
    ]);

    return redirect()->back()->with('success', 'Insurance added successfully.');
}

  public function importExcel(Request $request)
{
    $request->validate([
        'excel_file' => 'required|mimes:xls,xlsx,csv'
    ]);

    $rows = \Maatwebsite\Excel\Facades\Excel::toArray([], $request->file('excel_file'));

    if (empty($rows) || empty($rows[0]) || count($rows[0]) <= 1) {
        return redirect()->back()->with('warning', 'Excel file is empty or invalid.');
    }

    $sheetRows = $rows[0];
    $header = array_map(function ($value) {
        return \Illuminate\Support\Str::snake(trim($value));
    }, $sheetRows[0]);

    $inserted = 0;
    $duplicates = 0;

    for ($i = 1; $i < count($sheetRows); $i++) {
        $excelRow = $sheetRows[$i];

        if (count(array_filter($excelRow, fn($v) => $v !== null && $v !== '')) === 0) {
            continue;
        }

        $row = [];
        foreach ($header as $index => $columnName) {
            $row[$columnName] = $excelRow[$index] ?? null;
        }

        $vehicleNumber = strtoupper(trim($row['vehicle_number'] ?? ''));
        $vehicleNumber = str_replace([' ', '-'], '', $vehicleNumber);

        if (empty($vehicleNumber)) {
            continue;
        }

        $exists = \App\Models\Insurance::where('vehicle_number', $vehicleNumber)->exists();

        if ($exists) {
            $duplicates++;
            continue;
        }

        \App\Models\Insurance::create([
            'lead_id' => $row['lead_id'] ?? null,
            'policy_category' => $row['policy_category'] ?? 'Vehicle Insurance',
            'assigned_agent' => $row['assigned_agent'] ?? null,
            'stage' => $row['stage'] ?? 'Application Started',
            'status' => $row['status'] ?? 'Active',

            'full_name' => $row['full_name'] ?? null,
            'mobile_number' => $row['mobile_number'] ?? null,
            'email' => $row['email'] ?? null,
            'date_of_birth' => !empty($row['date_of_birth']) ? \Carbon\Carbon::parse($row['date_of_birth'])->format('Y-m-d') : null,
            'gender' => $row['gender'] ?? null,
            'occupation' => $row['occupation'] ?? null,
            'aadhaar_number' => $row['aadhaar_number'] ?? null,
            'pan_number' => $row['pan_number'] ?? null,
            'address' => $row['address'] ?? null,
            'city' => $row['city'] ?? null,
            'state' => $row['state'] ?? null,
            'pin_code' => $row['pin_code'] ?? null,

            'vehicle_number' => $vehicleNumber,
            'vehicle_type' => $row['vehicle_type'] ?? null,
            'fuel_type' => $row['fuel_type'] ?? null,
            'make_brand' => $row['make_brand'] ?? null,
            'model' => $row['model'] ?? null,
            'variant' => $row['variant'] ?? null,
            'manufacturing_year' => $row['manufacturing_year'] ?? null,
            'registration_date' => !empty($row['registration_date']) ? \Carbon\Carbon::parse($row['registration_date'])->format('Y-m-d') : null,
            'registration_city_rto' => $row['registration_city_rto'] ?? null,
            'engine_number' => $row['engine_number'] ?? null,
            'chassis_number' => $row['chassis_number'] ?? null,
            'current_idv' => $row['current_idv'] ?? null,

            'policy_type' => $row['policy_type'] ?? null,
            'insurance_company' => $row['insurance_company'] ?? null,
            'policy_term' => $row['policy_term'] ?? null,
            'policy_start_date' => !empty($row['policy_start_date']) ? \Carbon\Carbon::parse($row['policy_start_date'])->format('Y-m-d') : null,
            'policy_end_date' => !empty($row['policy_end_date']) ? \Carbon\Carbon::parse($row['policy_end_date'])->format('Y-m-d') : null,
            'ncb_percentage' => $row['ncb_percentage'] ?? null,

            'zero_dep_addon' => !empty($row['zero_dep_addon']) ? 1 : 0,
            'roadside_assistance' => !empty($row['roadside_assistance']) ? 1 : 0,
            'engine_protect' => !empty($row['engine_protect']) ? 1 : 0,
            'consumables_cover' => !empty($row['consumables_cover']) ? 1 : 0,

            'previous_insurer_name' => $row['previous_insurer_name'] ?? null,
            'previous_policy_number' => $row['previous_policy_number'] ?? null,
            'previous_policy_expiry_date' => !empty($row['previous_policy_expiry_date']) ? \Carbon\Carbon::parse($row['previous_policy_expiry_date'])->format('Y-m-d') : null,
            'claim_in_previous_policy' => $row['claim_in_previous_policy'] ?? null,
            'break_in_case' => $row['break_in_case'] ?? null,
            'claim_details' => $row['claim_details'] ?? null,
        ]);

        $inserted++;
    }

    if ($inserted > 0 && $duplicates > 0) {
        return redirect()->back()->with('success', $inserted . ' records imported successfully. ' . $duplicates . ' duplicate records skipped.');
    }

    if ($inserted > 0) {
        return redirect()->back()->with('success', $inserted . ' records imported successfully.');
    }

    return redirect()->back()->with('warning', 'All selected records are duplicates. No new data was imported.');
}

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    return redirect()->route('insurances.index');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $insurance = Insurance::findOrFail($id);
        return view('designer.insurances.edit', compact('insurance'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
{
    $insurance = Insurance::findOrFail($id);

    $request->validate([
        'full_name' => 'required|string|max:255',
        'mobile_number' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|string|max:50',
        'occupation' => 'nullable|string|max:255',
        'aadhaar_number' => 'nullable|string|max:50',
        'pan_number' => 'nullable|string|max:50',
        'address' => 'required|string',
        'city' => 'required|string|max:255',
        'state' => 'required|string|max:255',
        'pin_code' => 'required|string|max:20',
        'vehicle_number' => 'required|string|max:50',
        'vehicle_type' => 'required|string|max:100',
        'fuel_type' => 'required|string|max:100',
        'make_brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'variant' => 'nullable|string|max:255',
        'manufacturing_year' => 'nullable|numeric',
        'registration_date' => 'nullable|date',
        'registration_city_rto' => 'nullable|string|max:255',
        'engine_number' => 'nullable|string|max:255',
        'chassis_number' => 'nullable|string|max:255',
        'current_idv' => 'nullable|numeric',
        'policy_type' => 'required|string|max:255',
        'insurance_company' => 'required|string|max:255',
        'policy_term' => 'required|string|max:255',
        'policy_start_date' => 'required|date',
        'policy_end_date' => 'required|date',
        'ncb_percentage' => 'nullable|string|max:50',
        'previous_insurer_name' => 'nullable|string|max:255',
        'previous_policy_number' => 'nullable|string|max:255',
        'previous_policy_expiry_date' => 'nullable|date',
        'claim_in_previous_policy' => 'nullable|string|max:50',
        'break_in_case' => 'nullable|string|max:50',
        'claim_details' => 'nullable|string',
    ]);

    $insurance->update([
        'lead_id' => $request->lead_id,
        'policy_category' => $request->policy_category,
        'assigned_agent' => $request->assigned_agent,
        'stage' => $request->stage,
        'status' => $request->status,
        'full_name' => $request->full_name,
        'mobile_number' => $request->mobile_number,
        'email' => $request->email,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'occupation' => $request->occupation,
        'aadhaar_number' => $request->aadhaar_number,
        'pan_number' => $request->pan_number,
        'address' => $request->address,
        'city' => $request->city,
        'state' => $request->state,
        'pin_code' => $request->pin_code,
        'vehicle_number' => $request->vehicle_number,
        'vehicle_type' => $request->vehicle_type,
        'fuel_type' => $request->fuel_type,
        'make_brand' => $request->make_brand,
        'model' => $request->model,
        'variant' => $request->variant,
        'manufacturing_year' => $request->manufacturing_year,
        'registration_date' => $request->registration_date,
        'registration_city_rto' => $request->registration_city_rto,
        'engine_number' => $request->engine_number,
        'chassis_number' => $request->chassis_number,
        'current_idv' => $request->current_idv,
        'policy_type' => $request->policy_type,
        'insurance_company' => $request->insurance_company,
        'policy_term' => $request->policy_term,
        'policy_start_date' => $request->policy_start_date,
        'policy_end_date' => $request->policy_end_date,
        'ncb_percentage' => $request->ncb_percentage,
        'zero_dep_addon' => $request->has('zero_dep_addon'),
        'roadside_assistance' => $request->has('roadside_assistance'),
        'engine_protect' => $request->has('engine_protect'),
        'consumables_cover' => $request->has('consumables_cover'),
        'previous_insurer_name' => $request->previous_insurer_name,
        'previous_policy_number' => $request->previous_policy_number,
        'previous_policy_expiry_date' => $request->previous_policy_expiry_date,
        'claim_in_previous_policy' => $request->claim_in_previous_policy,
        'break_in_case' => $request->break_in_case,
        'claim_details' => $request->claim_details,
    ]);

    return redirect()->route('insurances.index')->with('success', 'Insurance record updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $insurance = Insurance::findOrFail($id);
    $insurance->delete();

    return redirect()->route('insurances.index')->with('success', 'Insurance record deleted successfully.');
}
}
