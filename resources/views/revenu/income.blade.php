@extends('layout')
@section('admin_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');

?>

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Revenu Mensuel</h5>
                  </div>
                  <div class="card-body">

                    <div class="chart-height-lg">
                      <div id="income"></div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

            <!-- Row start -->
            <div class="row gx-3">
              <div class="col-sm-12">

                <!-- Card start -->
                <div class="card">
                  <div class="card-header">

                    <!-- List start -->
                    {{-- <div class="d-flex flex-wrap gap-1">
                      <div class="d-flex align-items-center box-shadow px-3 py-1 rounded-2">
                        <i class="ri-pie-chart-2-fill text-success fs-4"></i>
                        <span class="me-1 fw-semibold ps-1">$24,590.00</span>
                        <span class="text-success">Total Income</span>
                      </div>
                      <div class="d-flex align-items-center box-shadow px-3 py-1 rounded-2">
                        <i class="ri-pie-chart-2-fill text-danger fs-4"></i>
                        <span class="me-1 fw-semibold ps-1">$12,300.00</span>
                        <span class="text-danger">Total Expenses</span>
                      </div>
                      <div class="d-flex align-items-center box-shadow px-3 py-1 rounded-2">
                        <i class="ri-pie-chart-2-fill text-info fs-4"></i>
                        <span class="me-1 fw-semibold ps-1">$14,290.00</span>
                        <span class="text-info">Total Revenue</span>
                      </div>
                    </div> --}}
                    <!-- List end -->

                  </div>
                  <div class="card-body">

                    <!-- Table start -->
                    <div class="table-responsive">
                      <table id="scrollVertical" class="table m-0 randomTableColors">
                        <thead>
                          <tr>
                            <th>Service</th>
                            <th>Jan</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Avr</th>
                            <th>Mai</th>
                            <th>Juin</th>
                            <th>Juil</th>
                            <th>Aout</th>
                            <th>Sept</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dec</th>
                            <th>Année</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><span class="badge bg-primary">Analyses</span></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                           
                          </tr>
                          <tr>
                            <td><span class="badge bg-info">Consulations</span></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                          </tr>
                          <tr>
                            <td><span class="badge bg-danger">Pharmacie</span></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                          </tr>
                          <tr>
                            <td><span class="badge bg-success">Hospitalisations</span></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                          </tr>
                          <tr>
                            <td><span class="badge bg-warning">Imagerie</span></td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                            <td>--</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <!-- Table end -->

                  </div>
                </div>
                <!-- Card end -->

              </div>
            </div>
            <!-- Row end -->

          </div>
          <!-- App body ends -->

    @endsection