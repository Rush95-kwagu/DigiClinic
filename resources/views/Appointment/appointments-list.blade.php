@extends('layouts/app')
@section('waiting patient content')



      <!-- Main container starts -->
      <div class="main-container">

        <!-- Sidebar wrapper starts -->
       @include('layouts/partials/_general-sidebar')
        <!-- Sidebar wrapper ends -->

        <!-- App container starts -->
        <div class="app-container">

          <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="index.html">Home</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Appointments List
              </li>
            </ol>
            <!-- Breadcrumb ends -->

            <!-- Sales stats starts -->
            <div class="ms-auto d-lg-flex d-none flex-row">
              <div class="d-flex flex-row gap-1 day-sorting">
                <button class="btn btn-sm btn-primary">Today</button>
                <button class="btn btn-sm">7d</button>
                <button class="btn btn-sm">2w</button>
                <button class="btn btn-sm">1m</button>
                <button class="btn btn-sm">3m</button>
                <button class="btn btn-sm">6m</button>
                <button class="btn btn-sm">1y</button>
              </div>
            </div>
            <!-- Sales stats ends -->

          </div>
          <!-- App Hero header ends -->

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Applointments List</h5>
                    <a href="book-appointment.html" class="btn btn-primary ms-auto">Book Appointment</a>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="appointmentsGrid" class="table m-0 align-middle">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Patient Name</th>
                            <th>Age</th>
                            <th>Consulting Doctor</th>
                            <th>Department</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Disease</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>001</td>
                            <td>
                              Deena Cooley
                            </td>
                            <td>65</td>
                            <td>
                              <img src="{{asset('assets/images/user.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Vicki Walsh
                            </td>
                            <td>Surgeon</td>
                            <td>05/23/2024</td>
                            <td>9:30AM</td>
                            <td>Diabeties</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-title="Accepted">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject" disabled>
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>002</td>
                            <td>
                              Jerry Wilcox
                            </td>
                            <td>73</td>
                            <td>
                              <img src="{{asset('assets/images/user1.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> April Gallegos
                            </td>
                            <td>Gynecologist</td>
                            <td>05/23/2024</td>
                            <td>9:45AM</td>
                            <td>Fever</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept" disabled>
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                  data-bs-title="Rejected">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>003</td>
                            <td>
                              Eduardo Kramer
                            </td>
                            <td>84</td>
                            <td>
                              <img src="{{asset('assets/images/user2.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Basil Frost
                            </td>
                            <td>Psychiatrists</td>
                            <td>05/23/2024</td>
                            <td>10:00AM</td>
                            <td>Cold</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>004</td>
                            <td>
                              Jason Compton
                            </td>
                            <td>56</td>
                            <td>
                              <img src="{{asset('assets/images/user4.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Nannie Guerrero
                            </td>
                            <td>Urologist</td>
                            <td>05/23/2024</td>
                            <td>10:15AM</td>
                            <td>Prostate</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>005</td>
                            <td>
                              Emmitt Bryan
                            </td>
                            <td>49</td>
                            <td>
                              <img src="{{asset('assets/images/user5.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Daren Andrade
                            </td>
                            <td>Cardiology</td>
                            <td>05/23/2024</td>
                            <td>10:30AM</td>
                            <td>Asthma</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>006</td>
                            <td>
                              Truman Miles
                            </td>
                            <td>90</td>
                            <td>
                              <img src="{{asset('assets/images/user2.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Colleen Murillo
                            </td>
                            <td>Paediatrician</td>
                            <td>05/23/2024</td>
                            <td>10:45AM</td>
                            <td>Cholera</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>007</td>
                            <td>
                              Dillon Stokes
                            </td>
                            <td>36</td>
                            <td>
                              <img src="{{asset('assets/images/user3.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Josiah Hobbs
                            </td>
                            <td>Gynecologist</td>
                            <td>05/23/2024</td>
                            <td>11:00AM</td>
                            <td>Heart</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>008</td>
                            <td>
                              Harris Peters
                            </td>
                            <td>79</td>
                            <td>
                              <img src="{{asset('assets/images/user4.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Wilma Dickson
                            </td>
                            <td>Urologist</td>
                            <td>05/23/2024</td>
                            <td>11:15AM</td>
                            <td>Outbreaks</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td>009</td>
                            <td>
                              Tomas Schultz
                            </td>
                            <td>79</td>
                            <td>
                              <img src="{{asset('assets/images/user5.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Hospital Admin Template"> Monique Merritt
                            </td>
                            <td>Paediatrician</td>
                            <td>05/23/2024</td>
                            <td>11:30AM</td>
                            <td>Fever</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Accept">
                                  <i class="ri-checkbox-circle-line"></i>
                                </button>
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                                  data-bs-placement="top" data-bs-title="Reject">
                                  <i class="ri-close-circle-line"></i>
                                </button>
                                <a href="edit-appointment.html" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
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
