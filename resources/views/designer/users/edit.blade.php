@extends('designer.layouts.app')

@section('content')


<section class="section premium-dashboard">
    <div class="premium-page-head">
        <div class="premium-page-title">
            <span class="mini-badge">User Management</span>
            <h2>Edit User</h2>
            <p>Update a premium user account with role, department and access permissions.</p>
        </div>

        <div class="premium-head-actions">
            <a href="{{ route('users.index') }}" class="btn premium-btn ghost-btn">
                <i data-feather="arrow-left"></i> Back to All User
            </a>
        </div>
    </div>
</section>

<section class="section premium-dashboard pt-0">
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

    <form action="{{ route('users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="card premium-block form-section-card">
                    <div class="card-header premium-card-header">
                        <div>
                            <h4>User Information</h4>
                            <p class="header-subtext">Basic account and personal details</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control premium-input" placeholder="Enter full name">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control premium-input" placeholder="Enter email address">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Mobile Number</label>
                                <input type="text" name="mobile_number" value="{{ old('mobile_number', $user->mobile_number) }}" class="form-control premium-input" placeholder="Enter mobile number">
                                @error('mobile_number')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                           

                            

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Gender</label>
                               <select name="gender" class="form-control premium-input">
                                 <option value="">Select gender</option>
                                 <option value="Male" {{ old('gender', $user->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                                 <option value="Female" {{ old('gender', $user->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                                 <option value="Other" {{ old('gender', $user->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                               </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Role</label>
                                <select name="role" class="form-control premium-input">
                                    <option value="">Select role</option>
                                    <option value="Admin" {{ old('role', $user->role) == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Staff" {{ old('role', $user->role) == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Agent" {{ old('role', $user->role) == 'Agent' ? 'selected' : '' }}>Agent</option>
                                    <option value="Executive" {{ old('role', $user->role) == 'Executive' ? 'selected' : '' }}>Executive</option>
                                </select>
                                @error('role')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-group-label">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth', !empty($user->date_of_birth) ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : '') }}" class="form-control premium-input">
                                @error('date_of_birth')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            <div class="col-md-12 mb-4">
                                <label class="form-group-label">Address</label>
                                <textarea name="address" class="form-control premium-input premium-textarea" placeholder="Enter full address">{{ old('address', $user->address) }}</textarea>
                                @error('address')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                        </div>
                    </div>
                </div>

                <div class="action-bar mt-4">
                    <a href="{{ route('users.index') }}" class="btn action-btn btn-light-premium">Cancel</a>
                    <button type="submit" class="btn action-btn btn-main-premium">Update User</button>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="card premium-block form-section-card">
                    <div class="card-header premium-card-header">
                        <div>
                            <h4>Profile Upload</h4>
                            <p class="header-subtext">Upload user photo and preview details</p>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="profile-upload-box">
                            <div class="profile-avatar-preview">
                               @if($user->profile_photo)
    <img src="{{ asset('storage/' . $user->profile_photo)}}"
         alt="{{ $user->name }}"
         width="45"
         height="45"
         style="object-fit: cover; border-radius: 50%;">
@else
    <img src="{{ asset('assets/img/user.png') }}"
         alt="Default User"
         width="45"
         height="45"
         style="object-fit: cover; border-radius: 50%;">
@endif
                            </div>
                            <h5>Upload Profile Photo</h5>
                            <p>PNG, JPG supported</p>
                            <input type="file" name="profile_photo" class="form-control premium-input">
                            @error('profile_photo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>
</section>

@endsection