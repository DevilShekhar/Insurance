<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->id();

            // Header / summary
            $table->string('lead_id')->nullable();
            $table->string('policy_category')->nullable();
            $table->string('assigned_agent')->nullable();
            $table->string('stage')->nullable()->default('Application Started');
            $table->string('status')->nullable()->default('Draft');

            // Customer details
            $table->string('full_name');
            $table->string('mobile_number');
            $table->string('email')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupation')->nullable();
            $table->string('aadhaar_number')->nullable();
            $table->string('pan_number')->nullable();
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('pin_code');

            // Vehicle details
            $table->string('vehicle_number');
            $table->string('vehicle_type');
            $table->string('fuel_type');
            $table->string('make_brand');
            $table->string('model');
            $table->string('variant')->nullable();
            $table->year('manufacturing_year')->nullable();
            $table->date('registration_date')->nullable();
            $table->string('registration_city_rto')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->decimal('current_idv', 12, 2)->nullable();

            // Policy details
            $table->string('policy_type');
            $table->string('insurance_company');
            $table->string('policy_term');
            $table->date('policy_start_date');
            $table->date('policy_end_date');
            $table->string('ncb_percentage')->nullable();

            // Addons
            $table->boolean('zero_dep_addon')->default(false);
            $table->boolean('roadside_assistance')->default(false);
            $table->boolean('engine_protect')->default(false);
            $table->boolean('consumables_cover')->default(false);

            // Previous policy details
            $table->string('previous_insurer_name')->nullable();
            $table->string('previous_policy_number')->nullable();
            $table->date('previous_policy_expiry_date')->nullable();
            $table->string('claim_in_previous_policy')->nullable();
            $table->string('break_in_case')->nullable();
            $table->text('claim_details')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('insurances');
    }
};