@extends('designer.layouts.app')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Expire Insurance</h1>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-header">
                <h4>Expired Insurance Policies</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="table-1">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th>Mobile Number</th>
                                <th>Vehicle Number</th>
                                <th>Policy Type</th>
                                <th>Insurance Company</th>
                                <th>Policy End Date</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($insurances as $insurance)
                                <tr>
                                    <td>{{ $insurance->full_name }}</td>
                                    <td>{{ $insurance->mobile_number }}</td>
                                    <td>{{ $insurance->vehicle_number }}</td>
                                    <td>{{ $insurance->policy_type }}</td>
                                    <td>{{ $insurance->insurance_company }}</td>
                                    <td>{{ \Carbon\Carbon::parse($insurance->policy_end_date)->format('d-m-Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No expired insurance records found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection