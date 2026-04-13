@extends('designer.layouts.app')

@section('content')






<section class="section">
          <div class="section-header"><h1>Re-Expire Insurance</h1></div>
          <div class="section-body">
            <div class="card">
              <div class="card-header"><h4>Overdue Renewal Cases</h4></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead><tr><th>Policy No</th><th>Customer</th><th>Vehicle</th><th>Expired On</th><th>Follow-up</th><th>Priority</th></tr></thead>
                    <tbody>
                      <tr><td>POL-3001</td><td>Arjun Das</td><td>MH03TT5544</td><td>2026-03-29</td><td>3 calls made</td><td>High</td></tr>
                      <tr><td>POL-3002</td><td>Kiran Joshi</td><td>MH01BC7711</td><td>2026-03-22</td><td>Email sent</td><td>Medium</td></tr>
                      <tr><td>POL-3003</td><td>Megha Soni</td><td>MH05PA2288</td><td>2026-03-18</td><td>Visit scheduled</td><td>High</td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>

@endsection