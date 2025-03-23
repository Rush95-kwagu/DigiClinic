@extends('layout')
@section('title')
    Admin
@endsection
@section('user_content')
<?php
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>


          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-lg-6 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Cardiology</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                203
                              </td>
                              <td>3</td>
                              <td>Private</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                308
                              </td>
                              <td>2</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                406
                              </td>
                              <td>5</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                302
                              </td>
                              <td>2</td>
                              <td>Standard</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                605
                              </td>
                              <td>4</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Gastroenterology</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                502
                              </td>
                              <td>1</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                307
                              </td>
                              <td>2</td>
                              <td>Standard</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                408
                              </td>
                              <td>4</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                303
                              </td>
                              <td>2</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Paediatrician</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                103
                              </td>
                              <td>2</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                205
                              </td>
                              <td>3</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                502
                              </td>
                              <td>4</td>
                              <td>Standard</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
              </div>
              <div class="col-lg-6 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Orthopedics</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                203
                              </td>
                              <td>3</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                208
                              </td>
                              <td>3</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                105
                              </td>
                              <td>1</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Anatomy</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                303
                              </td>
                              <td>3</td>
                              <td>Standard</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                209
                              </td>
                              <td>3</td>
                              <td>Private</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                106
                              </td>
                              <td>2</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                102
                              </td>
                              <td>4</td>
                              <td>Delux</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Neurology</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                103
                              </td>
                              <td>2</td>
                              <td>Private</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                            <tr>
                              <td>
                                205
                              </td>
                              <td>3</td>
                              <td>Suite</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Surgeon</h5>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table truncate align-middle m-0">
                          <thead>
                            <tr>
                              <th>Room No.</th>
                              <th>Bed No.</th>
                              <th>Room Type</th>
                              <th>Availability</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                502
                              </td>
                              <td>4</td>
                              <td>Private</td>
                              <td>
                                <a href="book-room.html" class="btn btn-primary">Book Now</a>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                    <!-- Table ends -->

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->

    @endsection
