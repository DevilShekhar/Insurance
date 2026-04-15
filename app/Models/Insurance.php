<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected $fillable = [
        'lead_id',
        'policy_category',
        'assigned_agent',
        'stage',
        'status',
        
        'full_name',
        'mobile_number',
        'email',
        'date_of_birth',
        'gender',
        'occupation',
        'aadhaar_number',
        'pan_number',
        'address',
        'city',
        'state',
        'pin_code',

        'vehicle_number',
        'vehicle_type',
        'fuel_type',
        'make_brand',
        'model',
        'variant',
        'manufacturing_year',
        'registration_date',
        'registration_city_rto',
        'engine_number',
        'chassis_number',
        'current_idv',

        'policy_type',
        'insurance_company',
        'policy_term',
        'policy_start_date',
        'policy_end_date',
        'ncb_percentage',

        'zero_dep_addon',
        'roadside_assistance',
        'engine_protect',
        'consumables_cover',

        'previous_insurer_name',
        'previous_policy_number',
        'previous_policy_expiry_date',
        'claim_in_previous_policy',
        'break_in_case',
    ];
}