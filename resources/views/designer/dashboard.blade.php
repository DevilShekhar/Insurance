@extends('designer.layouts.app')

@section('content')

 <!-- SECTION 1 -->
        <section class="section premium-dashboard">
          <div class="premium-page-head">
            <div class="premium-page-title">
              <span class="mini-badge">Insurance Control Center</span>
              <h2>Vehicle Insurance Dashboard</h2>
              <p>Track policies, renewals, expiring records and recent uploads from one premium admin panel.</p>
            </div>

            <div class="premium-head-actions">
              <a href="upload-excel.html" class="btn premium-btn primary-btn">
                <i data-feather="upload"></i> Upload Excel
              </a>
              <a href="all-insurance.html" class="btn premium-btn ghost-btn">
                <i data-feather="layers"></i> View Insurance
              </a>
            </div>
          </div>

          <div class="row premium-stats-row original-cards-row">
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card premium-top-card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">All Policies</h5>
                          <h2 class="mb-3 font-18" id="allPoliciesCount">258</h2>
                          <p class="mb-0"><span class="col-green">10%</span> Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card premium-top-card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Expiring Soon</h5>
                          <h2 class="mb-3 font-18" id="expiringCount">1,287</h2>
                          <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card premium-top-card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Re-Expired</h5>
                          <h2 class="mb-3 font-18" id="expiredCount">128</h2>
                          <p class="mb-0"><span class="col-green">18%</span> Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card premium-top-card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">New Entries</h5>
                          <h2 class="mb-3 font-18" id="newEntriesCount">$48,697</h2>
                          <p class="mb-0"><span class="col-green">42%</span> Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/4.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- SECTION 2 -->
        <section class="section premium-dashboard pt-0">
          <div class="card premium-block quick-actions-card">
            <div class="card-header premium-card-header">
              <h4>Quick Actions</h4>
            </div>

            <div class="card-body">
              <div class="quick-actions-grid">
                <a href="upload-excel.html" class="quick-action-box">
                  <div class="quick-icon purple-bg">
                    <i data-feather="upload-cloud"></i>
                  </div>
                  <div>
                    <h5>Upload Excel</h5>
                    <p>Import bulk insurance data</p>
                  </div>
                </a>

                <a href="all-insurance.html" class="quick-action-box">
                  <div class="quick-icon green-bg">
                    <i data-feather="layers"></i>
                  </div>
                  <div>
                    <h5>View All Insurance</h5>
                    <p>Browse complete policy list</p>
                  </div>
                </a>

                <a href="expire-insurance.html" class="quick-action-box">
                  <div class="quick-icon orange-bg">
                    <i data-feather="alert-circle"></i>
                  </div>
                  <div>
                    <h5>Expire Insurance</h5>
                    <p>Policies already expired</p>
                  </div>
                </a>

                <a href="reexpire-insurance.html" class="quick-action-box">
                  <div class="quick-icon blue-bg">
                    <i data-feather="refresh-cw"></i>
                  </div>
                  <div>
                    <h5>Re-Expire Insurance</h5>
                    <p>Repeated expiry follow-up</p>
                  </div>
                </a>
              </div>
            </div>
          </div>
        </section>

        <!-- SECTION 3 -->
        <section class="section premium-dashboard pt-0">
          <div class="row">
            <div class="col-lg-8 col-md-12">
              <div class="card premium-block premium-info-card">
                <div class="card-header premium-card-header">
                  <div>
                    <h4>Recent Upload Activity</h4>
                    <p class="header-subtext">Latest insurance data imports and system activity</p>
                  </div>
                  <span class="mini-status-badge success">Live Updates</span>
                </div>

                <div class="card-body">
                  <div class="activity-timeline">
                    <div class="timeline-item">
                      <div class="timeline-dot purple"></div>
                      <div class="timeline-content">
                        <h5>Excel file uploaded successfully</h5>
                        <p>126 new insurance records imported into the system.</p>
                        <span>10 minutes ago</span>
                      </div>
                    </div>

                    <div class="timeline-item">
                      <div class="timeline-dot blue"></div>
                      <div class="timeline-content">
                        <h5>All Insurance data synced</h5>
                        <p>Uploaded records reflected in master insurance table.</p>
                        <span>22 minutes ago</span>
                      </div>
                    </div>

                    <div class="timeline-item">
                      <div class="timeline-dot orange"></div>
                      <div class="timeline-content">
                        <h5>Expiry alerts generated</h5>
                        <p>18 policies moved to expiring list for renewal follow-up.</p>
                        <span>35 minutes ago</span>
                      </div>
                    </div>

                    <div class="timeline-item last">
                      <div class="timeline-dot green"></div>
                      <div class="timeline-content">
                        <h5>Re-expired records updated</h5>
                        <p>7 old pending records moved into re-expire section.</p>
                        <span>1 hour ago</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4 col-md-12">
              <div class="card premium-block premium-info-card">
                <div class="card-header premium-card-header">
                  <div>
                    <h4>Expiring Alerts</h4>
                    <p class="header-subtext">Urgent renewal attention required</p>
                  </div>
                </div>

                <div class="card-body">
                  <div class="alert-list">
                    <div class="alert-item danger-alert">
                      <div>
                        <h6>MH12AB1234</h6>
                        <p>Policy ends in 2 days</p>
                      </div>
                      <span>Urgent</span>
                    </div>

                    <div class="alert-item warning-alert">
                      <div>
                        <h6>MH14XY9087</h6>
                        <p>Policy ends in 4 days</p>
                      </div>
                      <span>Follow-up</span>
                    </div>

                    <div class="alert-item warning-alert">
                      <div>
                        <h6>MH13PQ4567</h6>
                        <p>Policy ends in 6 days</p>
                      </div>
                      <span>Upcoming</span>
                    </div>

                    <div class="alert-item success-alert">
                      <div>
                        <h6>MH11LK7788</h6>
                        <p>Renewal quote already generated</p>
                      </div>
                      <span>Ready</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

        <!-- SECTION 4 -->
        <section class="section premium-dashboard pt-0">
          <div class="row">
            <div class="col-lg-12">
              <div class="card premium-block premium-analytics-card">
                <div class="card-header premium-card-header">
                  <div>
                    <h4>Insurance Performance Summary</h4>
                    <p class="header-subtext">Track renewal performance, policy movement and data health</p>
                  </div>
                </div>

                <div class="card-body">
                  <div class="analytics-grid">
                    <div class="analytics-box">
                      <div class="analytics-top">
                        <h5>Renewal Success Rate</h5>
                        <strong>91%</strong>
                      </div>
                      <div class="premium-progress">
                        <div class="premium-progress-bar purple-gradient" style="width: 91%;"></div>
                      </div>
                    </div>

                    <div class="analytics-box">
                      <div class="analytics-top">
                        <h5>Upload Accuracy</h5>
                        <strong>96%</strong>
                      </div>
                      <div class="premium-progress">
                        <div class="premium-progress-bar blue-gradient" style="width: 96%;"></div>
                      </div>
                    </div>

                    <div class="analytics-box">
                      <div class="analytics-top">
                        <h5>Expired Policy Clearance</h5>
                        <strong>68%</strong>
                      </div>
                      <div class="premium-progress">
                        <div class="premium-progress-bar orange-gradient" style="width: 68%;"></div>
                      </div>
                    </div>

                    <div class="analytics-box">
                      <div class="analytics-top">
                        <h5>Customer Follow-up Completion</h5>
                        <strong>84%</strong>
                      </div>
                      <div class="premium-progress">
                        <div class="premium-progress-bar green-gradient" style="width: 84%;"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-12 mt-4">
              <div class="card premium-block">
                <div class="card-header premium-card-header">
                  <div>
                    <h4>Recent Policy Records</h4>
                    <p class="header-subtext">Latest records added to the insurance system</p>
                  </div>
                  <a href="all-insurance.html" class="btn premium-small-btn">View All</a>
                </div>

                <div class="card-body p-0">
                  <div class="table-responsive premium-table-wrap">
                    <table class="table premium-table mb-0">
                      <thead>
                        <tr>
                          <th>Vehicle No</th>
                          <th>Owner Name</th>
                          <th>Policy Type</th>
                          <th>Mobile</th>
                          <th>Expiry Date</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>MH12AB1234</td>
                          <td>Rohit Patil</td>
                          <td>Comprehensive</td>
                          <td>9876543210</td>
                          <td>15 Apr 2026</td>
                          <td><span class="status-badge active-status">Active</span></td>
                        </tr>
                        <tr>
                          <td>MH14XY9087</td>
                          <td>Sneha Jadhav</td>
                          <td>Third Party</td>
                          <td>9822001122</td>
                          <td>09 Apr 2026</td>
                          <td><span class="status-badge warning-status">Expiring</span></td>
                        </tr>
                        <tr>
                          <td>MH13PQ4567</td>
                          <td>Akash More</td>
                          <td>Commercial</td>
                          <td>9988776655</td>
                          <td>04 Apr 2026</td>
                          <td><span class="status-badge expired-status">Expired</span></td>
                        </tr>
                        <tr>
                          <td>MH11LK7788</td>
                          <td>Pooja Shinde</td>
                          <td>Comprehensive</td>
                          <td>9090909090</td>
                          <td>28 Apr 2026</td>
                          <td><span class="status-badge active-status">Active</span></td>
                        </tr>
                        <tr>
                          <td>MH16BN2221</td>
                          <td>Vikas Kale</td>
                          <td>Third Party</td>
                          <td>9011223344</td>
                          <td>11 Apr 2026</td>
                          <td><span class="status-badge warning-status">Expiring</span></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </section>
@endsection
