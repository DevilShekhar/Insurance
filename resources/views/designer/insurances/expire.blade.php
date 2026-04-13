@extends('designer.layouts.app')

@section('content')



 
        <section class="section">
          <div class="section-header"><h1>Expire Insurance</h1></div>
          <div class="section-body">
            <div class="card">
              <div class="card-header"><h4>Policies Expiring Soon</h4></div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped" id="table-1">
                    <thead><tr><th>Policy No</th><th>Customer</th><th>Phone</th><th>Vehicle</th><th>Expiry Date</th><th>Days Left</th><th>Action</th></tr></thead>
                    <tbody>
                      <tr><td>POL-2001</td><td>Nitin Shah</td><td>9876501234</td><td>MH02DD8877</td><td>2026-04-12</td><td>5</td><td><a href="basic-form.html" class="btn btn-sm btn-primary">Renew</a></td></tr>
                      <tr><td>POL-2002</td><td>Riya Kulkarni</td><td>9988012345</td><td>MH04AZ1144</td><td>2026-04-15</td><td>8</td><td><a href="basic-form.html" class="btn btn-sm btn-primary">Renew</a></td></tr>
                      <tr><td>POL-2003</td><td>Dev Rana</td><td>9765432101</td><td>MH10QW6655</td><td>2026-04-20</td><td>13</td><td><a href="basic-form.html" class="btn btn-sm btn-primary">Renew</a></td></tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </section>
         
    


@endsection