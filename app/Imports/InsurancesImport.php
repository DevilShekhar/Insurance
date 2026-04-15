<?php

namespace App\Imports;

use App\Models\Insurance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;

class InsurancesImport implements ToModel, WithHeadingRow, SkipsEmptyRows
{
    public function model(array $row)
    {
        $vehicleNumber = strtoupper(trim($row['vehicle_number'] ?? ''));
        $vehicleNumber = str_replace([' ', '-'], '', $vehicleNumber);

        if (empty($vehicleNumber)) {
            return null;
        }

        $exists = Insurance::where('vehicle_number', $vehicleNumber)->exists();

        if ($exists) {
            return null;
        }

        return new Insurance([
            'lead_id' => $row['lead_id'] ?? null,
            'policy_category' => $row['policy_category'] ?? 'Vehicle Insurance',
            'assigned_agent' => $row['assigned_agent'] ?? null,
            'stage' => $row['stage'] ?? 'Application Started',
            'status' => $row['status'] ?? 'Active',

            'full_name' => $row['full_name'] ?? null,
            'mobile_number' => $row['mobile_number'] ?? null,
            'email' => $row['email'] ?? null,
            'date_of_birth' => !empty($row['date_of_birth']) ? Carbon::parse($row['date_of_birth'])->format('Y-m-d') : null,
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
            'registration_date' => !empty($row['registration_date']) ? Carbon::parse($row['registration_date'])->format('Y-m-d') : null,
            'registration_city_rto' => $row['registration_city_rto'] ?? null,
            'engine_number' => $row['engine_number'] ?? null,
            'chassis_number' => $row['chassis_number'] ?? null,
            'current_idv' => $row['current_idv'] ?? null,

            'policy_type' => $row['policy_type'] ?? null,
            'insurance_company' => $row['insurance_company'] ?? null,
            'policy_term' => $row['policy_term'] ?? null,
            'policy_start_date' => !empty($row['policy_start_date']) ? Carbon::parse($row['policy_start_date'])->format('Y-m-d') : null,
            'policy_end_date' => !empty($row['policy_end_date']) ? Carbon::parse($row['policy_end_date'])->format('Y-m-d') : null,
            'ncb_percentage' => $row['ncb_percentage'] ?? null,

            'zero_dep_addon' => !empty($row['zero_dep_addon']) ? 1 : 0,
            'roadside_assistance' => !empty($row['roadside_assistance']) ? 1 : 0,
            'engine_protect' => !empty($row['engine_protect']) ? 1 : 0,
            'consumables_cover' => !empty($row['consumables_cover']) ? 1 : 0,

            'previous_insurer_name' => $row['previous_insurer_name'] ?? null,
            'previous_policy_number' => $row['previous_policy_number'] ?? null,
            'previous_policy_expiry_date' => !empty($row['previous_policy_expiry_date']) ? Carbon::parse($row['previous_policy_expiry_date'])->format('Y-m-d') : null,
            'claim_in_previous_policy' => $row['claim_in_previous_policy'] ?? $row['any_claim_previous_policy'] ?? null,
            'break_in_case' => $row['break_in_case'] ?? null,
        ]);
    }
}