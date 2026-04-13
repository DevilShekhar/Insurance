<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
         return view('designer.insurances.expire');
    }
public function re_expire()
    {
         return view('designer.insurances.re_expire');
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
        $request->validate([
            'lead_id' => 'nullable|string|max:255',
            'policy_category' => 'nullable|string|max:255',
            'assigned_agent' => 'nullable|string|max:255',
            'stage' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',

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

            'zero_dep_addon' => 'nullable',
            'roadside_assistance' => 'nullable',
            'engine_protect' => 'nullable',
            'consumables_cover' => 'nullable',

            'previous_insurer_name' => 'nullable|string|max:255',
            'previous_policy_number' => 'nullable|string|max:255',
            'previous_policy_expiry_date' => 'nullable|date',
            'claim_in_previous_policy' => 'nullable|string|max:50',
            'break_in_case' => 'nullable|string|max:50',
            'claim_details' => 'nullable|string',
        ]);

        Insurance::create([
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

        return redirect()->back()->with('success', 'Insurance record created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
