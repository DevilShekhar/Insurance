@extends('designer.layouts.app')

@section('content')

<section class="section">
    <div class="section-body">

        <div class="premium-page-header mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-start">
                <div>
                    <p class="header-kicker mb-2">Insurance Module</p>
                    <h2 class="page-title mb-2">Edit Vehicle Insurance Application</h2>
                    <p class="page-subtitle mb-0">
                        Update customer, vehicle, previous policy and payment details for this insurance record.
                    </p>
                </div>

                <div class="header-status-group mt-2 mt-md-0">
                    <span class="status-pill draft">{{ $insurance->status ?? 'Draft' }}</span>
                    <span class="status-pill pending">{{ $insurance->stage ?? 'Pending Review' }}</span>
                </div>
            </div>

            <div class="row mt-4 summary-row">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="summary-box">
                        <span class="summary-label">Lead ID</span>
                        <strong>{{ $insurance->lead_id ?? 'LEAD-2026-00124' }}</strong>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="summary-box">
                        <span class="summary-label">Policy Type</span>
                        <strong>{{ $insurance->policy_category ?? 'Vehicle Insurance' }}</strong>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="summary-box">
                        <span class="summary-label">Assigned Agent</span>
                        <strong>{{ $insurance->assigned_agent ?? 'Rahul Patil' }}</strong>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="summary-box">
                        <span class="summary-label">Stage</span>
                        <strong>{{ $insurance->stage ?? 'Application Started' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form id="vehicleInsuranceForm" action="{{ route('insurances.update', $insurance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="lead_id" value="{{ old('lead_id', $insurance->lead_id) }}">
            <input type="hidden" name="policy_category" value="{{ old('policy_category', $insurance->policy_category) }}">
            <input type="hidden" name="assigned_agent" value="{{ old('assigned_agent', $insurance->assigned_agent) }}">
            <input type="hidden" name="stage" value="{{ old('stage', $insurance->stage) }}">
            <input type="hidden" name="status" value="{{ old('status', $insurance->status) }}">

            <!-- CUSTOMER DETAILS -->
            <div class="premium-card mb-4">
                <div class="card-body">
                    <div class="card-top customer-top-upload">
                        <div>
                            <h4>Customer Details</h4>
                            <p>Personal and contact information of the vehicle owner.</p>
                        </div>

                        <div class="customer-upload-action">
                            <a href="{{ route('insurances.index') }}" class="quick-action-box" style="text-decoration:none;">
                                <div class="quick-icon purple-bg">
                                    <i data-feather="arrow-left"></i>
                                </div>
                                <div class="text-left">
                                    <h5>Back to List</h5>
                                    <p>View all insurance records</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label>Full Name <span>*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-user"></i>
                                <input type="text" name="full_name" value="{{ old('full_name', $insurance->full_name) }}" class="form-control premium-input" placeholder="Enter full name" required>
                            </div>
                            @error('full_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Mobile Number <span>*</span></label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-phone-alt"></i>
                                <input type="tel" name="mobile_number" value="{{ old('mobile_number', $insurance->mobile_number) }}" class="form-control premium-input" placeholder="Enter mobile number" required>
                            </div>
                            @error('mobile_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Email Address</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-envelope"></i>
                                <input type="email" name="email" value="{{ old('email', $insurance->email) }}" class="form-control premium-input" placeholder="Enter email address">
                            </div>
                            @error('email')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Date of Birth</label>
                            <div class="input-icon-wrap">
                                <i class="fas fa-calendar-alt"></i>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', !empty($insurance->date_of_birth) ? \Carbon\Carbon::parse($insurance->date_of_birth)->format('Y-m-d') : '') }}" class="form-control premium-input">
                            </div>
                            @error('date_of_birth')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Gender</label>
                            <select name="gender" class="form-control premium-input">
                                <option value="">Select gender</option>
                                <option value="Male" {{ old('gender', $insurance->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender', $insurance->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender', $insurance->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Occupation</label>
                            <input type="text" name="occupation" value="{{ old('occupation', $insurance->occupation) }}" class="form-control premium-input" placeholder="Enter occupation">
                            @error('occupation')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Aadhaar Number</label>
                            <input type="text" name="aadhaar_number" value="{{ old('aadhaar_number', $insurance->aadhaar_number) }}" class="form-control premium-input" placeholder="Enter Aadhaar number">
                            @error('aadhaar_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>PAN Number</label>
                            <input type="text" name="pan_number" value="{{ old('pan_number', $insurance->pan_number) }}" class="form-control premium-input" placeholder="Enter PAN number">
                            @error('pan_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-4">
                            <label>Address <span>*</span></label>
                            <textarea name="address" class="form-control premium-input premium-textarea" placeholder="Enter full address" required>{{ old('address', $insurance->address) }}</textarea>
                            @error('address')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>City <span>*</span></label>
                            <input type="text" name="city" value="{{ old('city', $insurance->city) }}" class="form-control premium-input" placeholder="Enter city" required>
                            @error('city')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>State <span>*</span></label>
                            <input type="text" name="state" value="{{ old('state', $insurance->state) }}" class="form-control premium-input" placeholder="Enter state" required>
                            @error('state')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>PIN Code <span>*</span></label>
                            <input type="text" name="pin_code" value="{{ old('pin_code', $insurance->pin_code) }}" class="form-control premium-input" placeholder="Enter PIN code" required>
                            @error('pin_code')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- VEHICLE DETAILS -->
            <div class="premium-card mb-4">
                <div class="card-body">
                    <div class="card-top">
                        <div>
                            <h4>Vehicle Details</h4>
                            <p>Vehicle registration and technical information.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <label>Vehicle Number <span>*</span></label>
                            <input type="text" name="vehicle_number" value="{{ old('vehicle_number', $insurance->vehicle_number) }}" class="form-control premium-input" placeholder="MH12AB1234" required>
                            @error('vehicle_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Vehicle Type <span>*</span></label>
                            <select name="vehicle_type" class="form-control premium-input" required>
                                <option value="">Select vehicle type</option>
                                <option value="Two Wheeler" {{ old('vehicle_type', $insurance->vehicle_type) == 'Two Wheeler' ? 'selected' : '' }}>Two Wheeler</option>
                                <option value="Private Car" {{ old('vehicle_type', $insurance->vehicle_type) == 'Private Car' ? 'selected' : '' }}>Private Car</option>
                                <option value="Commercial Vehicle" {{ old('vehicle_type', $insurance->vehicle_type) == 'Commercial Vehicle' ? 'selected' : '' }}>Commercial Vehicle</option>
                                <option value="Taxi / Cab" {{ old('vehicle_type', $insurance->vehicle_type) == 'Taxi / Cab' ? 'selected' : '' }}>Taxi / Cab</option>
                                <option value="Truck" {{ old('vehicle_type', $insurance->vehicle_type) == 'Truck' ? 'selected' : '' }}>Truck</option>
                                <option value="Bus" {{ old('vehicle_type', $insurance->vehicle_type) == 'Bus' ? 'selected' : '' }}>Bus</option>
                                <option value="Other" {{ old('vehicle_type', $insurance->vehicle_type) == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('vehicle_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Fuel Type <span>*</span></label>
                            <select name="fuel_type" class="form-control premium-input" required>
                                <option value="">Select fuel type</option>
                                <option value="Petrol" {{ old('fuel_type', $insurance->fuel_type) == 'Petrol' ? 'selected' : '' }}>Petrol</option>
                                <option value="Diesel" {{ old('fuel_type', $insurance->fuel_type) == 'Diesel' ? 'selected' : '' }}>Diesel</option>
                                <option value="CNG" {{ old('fuel_type', $insurance->fuel_type) == 'CNG' ? 'selected' : '' }}>CNG</option>
                                <option value="Electric" {{ old('fuel_type', $insurance->fuel_type) == 'Electric' ? 'selected' : '' }}>Electric</option>
                                <option value="Hybrid" {{ old('fuel_type', $insurance->fuel_type) == 'Hybrid' ? 'selected' : '' }}>Hybrid</option>
                            </select>
                            @error('fuel_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Make / Brand <span>*</span></label>
                            <input type="text" name="make_brand" value="{{ old('make_brand', $insurance->make_brand) }}" class="form-control premium-input" placeholder="Maruti, Tata, Honda..." required>
                            @error('make_brand')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Model <span>*</span></label>
                            <input type="text" name="model" value="{{ old('model', $insurance->model) }}" class="form-control premium-input" placeholder="Enter vehicle model" required>
                            @error('model')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Variant</label>
                            <input type="text" name="variant" value="{{ old('variant', $insurance->variant) }}" class="form-control premium-input" placeholder="Enter variant">
                            @error('variant')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Manufacturing Year <span>*</span></label>
                            <input type="number" name="manufacturing_year" value="{{ old('manufacturing_year', $insurance->manufacturing_year) }}" class="form-control premium-input" placeholder="2024" required>
                            @error('manufacturing_year')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Registration Date</label>
                            <input type="date" name="registration_date" value="{{ old('registration_date', !empty($insurance->registration_date) ? \Carbon\Carbon::parse($insurance->registration_date)->format('Y-m-d') : '') }}" class="form-control premium-input">
                            @error('registration_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Registration City / RTO</label>
                            <input type="text" name="registration_city_rto" value="{{ old('registration_city_rto', $insurance->registration_city_rto) }}" class="form-control premium-input" placeholder="Enter RTO / city">
                            @error('registration_city_rto')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Engine Number</label>
                            <input type="text" name="engine_number" value="{{ old('engine_number', $insurance->engine_number) }}" class="form-control premium-input" placeholder="Enter engine number">
                            @error('engine_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Chassis Number</label>
                            <input type="text" name="chassis_number" value="{{ old('chassis_number', $insurance->chassis_number) }}" class="form-control premium-input" placeholder="Enter chassis number">
                            @error('chassis_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Current IDV</label>
                            <div class="input-group premium-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">₹</span>
                                </div>
                                <input type="number" step="0.01" name="current_idv" value="{{ old('current_idv', $insurance->current_idv) }}" class="form-control premium-input" placeholder="Enter IDV amount">
                            </div>
                            @error('current_idv')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- POLICY DETAILS -->
            <div class="premium-card mb-4">
                <div class="card-body">
                    <div class="card-top">
                        <div>
                            <h4>Policy Details</h4>
                            <p>Insurance type and selected cover details.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <label>Policy Type <span>*</span></label>
                            <select name="policy_type" class="form-control premium-input" required>
                                <option value="">Select policy type</option>
                                <option value="Third Party" {{ old('policy_type', $insurance->policy_type) == 'Third Party' ? 'selected' : '' }}>Third Party</option>
                                <option value="Comprehensive" {{ old('policy_type', $insurance->policy_type) == 'Comprehensive' ? 'selected' : '' }}>Comprehensive</option>
                                <option value="Own Damage" {{ old('policy_type', $insurance->policy_type) == 'Own Damage' ? 'selected' : '' }}>Own Damage</option>
                                <option value="Zero Dep" {{ old('policy_type', $insurance->policy_type) == 'Zero Dep' ? 'selected' : '' }}>Zero Dep</option>
                            </select>
                            @error('policy_type')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Insurance Company <span>*</span></label>
                            <input type="text" name="insurance_company" value="{{ old('insurance_company', $insurance->insurance_company) }}" class="form-control premium-input" placeholder="Enter insurance company" required>
                            @error('insurance_company')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Policy Term <span>*</span></label>
                            <select name="policy_term" class="form-control premium-input" required>
                                <option value="">Select policy term</option>
                                <option value="1 Year" {{ old('policy_term', $insurance->policy_term) == '1 Year' ? 'selected' : '' }}>1 Year</option>
                                <option value="2 Years" {{ old('policy_term', $insurance->policy_term) == '2 Years' ? 'selected' : '' }}>2 Years</option>
                                <option value="3 Years" {{ old('policy_term', $insurance->policy_term) == '3 Years' ? 'selected' : '' }}>3 Years</option>
                            </select>
                            @error('policy_term')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Policy Start Date <span>*</span></label>
                            <input type="date" name="policy_start_date" value="{{ old('policy_start_date', !empty($insurance->policy_start_date) ? \Carbon\Carbon::parse($insurance->policy_start_date)->format('Y-m-d') : '') }}" class="form-control premium-input" required>
                            @error('policy_start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Policy End Date <span>*</span></label>
                            <input type="date" name="policy_end_date" value="{{ old('policy_end_date', !empty($insurance->policy_end_date) ? \Carbon\Carbon::parse($insurance->policy_end_date)->format('Y-m-d') : '') }}" class="form-control premium-input" required>
                            @error('policy_end_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>NCB Percentage</label>
                            <select name="ncb_percentage" class="form-control premium-input">
                                <option value="">Select NCB</option>
                                <option value="0%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '0%' ? 'selected' : '' }}>0%</option>
                                <option value="20%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '20%' ? 'selected' : '' }}>20%</option>
                                <option value="25%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '25%' ? 'selected' : '' }}>25%</option>
                                <option value="35%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '35%' ? 'selected' : '' }}>35%</option>
                                <option value="45%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '45%' ? 'selected' : '' }}>45%</option>
                                <option value="50%" {{ old('ncb_percentage', $insurance->ncb_percentage) == '50%' ? 'selected' : '' }}>50%</option>
                            </select>
                            @error('ncb_percentage')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                            <label class="d-block">Zero Dep Addon</label>
                            <label class="premium-switch">
                                <input type="checkbox" name="zero_dep_addon" {{ old('zero_dep_addon', $insurance->zero_dep_addon) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                            <label class="d-block">Roadside Assistance</label>
                            <label class="premium-switch">
                                <input type="checkbox" name="roadside_assistance" {{ old('roadside_assistance', $insurance->roadside_assistance) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                            <label class="d-block">Engine Protect</label>
                            <label class="premium-switch">
                                <input type="checkbox" name="engine_protect" {{ old('engine_protect', $insurance->engine_protect) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>

                        <div class="col-lg-3 col-md-6 mb-4">
                            <label class="d-block">Consumables Cover</label>
                            <label class="premium-switch">
                                <input type="checkbox" name="consumables_cover" {{ old('consumables_cover', $insurance->consumables_cover) ? 'checked' : '' }}>
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PREVIOUS POLICY -->
            <div class="premium-card mb-4">
                <div class="card-body">
                    <div class="card-top">
                        <div>
                            <h4>Previous Policy Details</h4>
                            <p>Old insurer, expiry, claims and continuity information.</p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-4 mb-4">
                            <label>Previous Insurer Name</label>
                            <input type="text" name="previous_insurer_name" value="{{ old('previous_insurer_name', $insurance->previous_insurer_name) }}" class="form-control premium-input" placeholder="Enter previous insurer">
                            @error('previous_insurer_name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Previous Policy Number</label>
                            <input type="text" name="previous_policy_number" value="{{ old('previous_policy_number', $insurance->previous_policy_number) }}" class="form-control premium-input" placeholder="Enter previous policy number">
                            @error('previous_policy_number')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-4 mb-4">
                            <label>Previous Policy Expiry Date</label>
                            <input type="date" name="previous_policy_expiry_date" value="{{ old('previous_policy_expiry_date', !empty($insurance->previous_policy_expiry_date) ? \Carbon\Carbon::parse($insurance->previous_policy_expiry_date)->format('Y-m-d') : '') }}" class="form-control premium-input">
                            @error('previous_policy_expiry_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Any Claim in Previous Policy? <span>*</span></label>
                            <select name="claim_in_previous_policy" class="form-control premium-input" id="claimHistory" required>
                                <option value="">Select option</option>
                                <option value="no" {{ old('claim_in_previous_policy', $insurance->claim_in_previous_policy) == 'no' ? 'selected' : '' }}>No</option>
                                <option value="yes" {{ old('claim_in_previous_policy', $insurance->claim_in_previous_policy) == 'yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('claim_in_previous_policy')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label>Break-in Case?</label>
                            <select name="break_in_case" class="form-control premium-input">
                                <option value="">Select option</option>
                                <option value="No" {{ old('break_in_case', $insurance->break_in_case) == 'No' ? 'selected' : '' }}>No</option>
                                <option value="Yes" {{ old('break_in_case', $insurance->break_in_case) == 'Yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('break_in_case')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-lg-12 mb-4" id="claimDetailsWrap">
                            <label>Claim Details</label>
                            <textarea name="claim_details" class="form-control premium-input premium-textarea" placeholder="Enter claim details">{{ old('claim_details', $insurance->claim_details) }}</textarea>
                            @error('claim_details')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-bar">
                <a href="{{ route('insurances.index') }}" class="btn action-btn btn-light-premium">Cancel</a>
                <button type="submit" class="btn action-btn btn-main-premium">Update Application</button>
            </div>
        </form>

    </div>
</section>

@endsection