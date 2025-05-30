@extends('layout')
@section('title')
    Admin
@endsection
@section('user_content')
<?php
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id')
?>

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Chambres d'hospitalisation</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th width="100px">Services</th>
                              <th width="60px">N° Chambre</th>
                              <th width="60px">N° Lit</th>
                              <th width="100px">Patient</th>
                              <th width="100px">Date admission</th>
                              <th width="100px">Age</th>
                              <th width="100px">Sexe</th>
                              <th width="100px">Type de chambre</th>
                              <th width="100px">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>Endocrinology</td>
                              <td>301</td>
                              <td>3</td>
                              <td>James Macias</td>
                              <td>12/07/2024</td>
                              <td>65</td>
                              <td>Male</td>
                              <td><span class="badge border border-success text-success">Delux</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Pathology</td>
                              <td>810</td>
                              <td>2</td>
                              <td>Liza Morrison</td>
                              <td>26/05/2024</td>
                              <td>31</td>
                              <td>Female</td>
                              <td><span class="badge border border-success text-success">Delux</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Cardiology</td>
                              <td>608</td>
                              <td>2</td>
                              <td>Jerold Rich</td>
                              <td>30/06/2024</td>
                              <td>22</td>
                              <td>Male</td>
                              <td><span class="badge border border-info text-info">Standard</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Anatomy</td>
                              <td>507</td>
                              <td>1</td>
                              <td>Kim Crosby</td>
                              <td>14/05/2024</td>
                              <td>71</td>
                              <td>Male</td>
                              <td><span class="badge border border-primary text-primary">Private</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Gastroenterology</td>
                              <td>212</td>
                              <td>4</td>
                              <td>Helena Moyer</td>
                              <td>18/06/2024</td>
                              <td>29</td>
                              <td>Female</td>
                              <td><span class="badge border border-success text-success">Delux</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Neurology</td>
                              <td>408</td>
                              <td>1</td>
                              <td>Beverly Vaughan</td>
                              <td>20/05/2024</td>
                              <td>53</td>
                              <td>Female</td>
                              <td><span class="badge border border-info text-info">Standard</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                            <tr>
                              <td>Orthopedics</td>
                              <td>503</td>
                              <td>3</td>
                              <td>Joni Hull</td>
                              <td>12/06/2024</td>
                              <td>36</td>
                              <td>Female</td>
                              <td><span class="badge border border-warning text-warning">Suite</span></td>
                              <td>
                                <button class="btn btn-primary" data-bs-toggle="modal"
                                  data-bs-target="#dischargeNow">Discharge</button>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                    <!-- Modal Delete Row -->
                    <div class="modal fade" id="dischargeNow" tabindex="-1" aria-labelledby="dischargeNowLabel"
                      aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="dischargeNowLabel">
                              Confirm
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to discharge?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <button class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                              <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->
@endsection
