<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard | DigiClinic</title>

    <!-- Meta -->
    <meta name="description" content="DigiClinic">
    <meta name="author" content="Administration | Gestion de Cliniques">
    <link rel="canonical" href="https://www.gnlfconsult.com/">
    <meta property="og:url" content="https://www.gnlfconsult.com">
    <meta property="og:title" content="Administration | Gestion de Cliniques">
    <meta property="og:description" content="DigiClinic | Administration de Cliniques">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Administration | Gestion de Cliniques">
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.svg')}}">

    <!-- *************
		************ CSS Files *************
	************* -->
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('assets/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/main.min.css')}}">

    <!-- *************
		************ Vendor Css Files *************
	************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('assets/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/quill/quill.core.css')}}">
  </head>

  <body>

    <!-- Loading starts -->
    <div id="loading-wrapper">
      <div class='spin-wrapper'>
        <div class='spin'>
          <div class='inner'></div>
        </div>
        <div class='spin'>
          <div class='inner'></div>
        </div>
        <div class='spin'>
          <div class='inner'></div>
        </div>
        <div class='spin'>
          <div class='inner'></div>
        </div>
        <div class='spin'>
          <div class='inner'></div>
        </div>
        <div class='spin'>
          <div class='inner'></div>
        </div>
      </div>
    </div>
    <!-- Loading ends -->

    <!-- Page wrapper starts -->
    <div class="page-wrapper">

      <!-- App header starts -->
      <div class="app-header d-flex align-items-center">

        <!-- Toggle buttons starts -->
        <div class="d-flex">
          <button class="toggle-sidebar">
            <i class="ri-menu-line"></i>
          </button>
          <button class="pin-sidebar">
            <i class="ri-menu-line"></i>
          </button>
        </div>
        <!-- Toggle buttons ends -->

        <!-- App brand starts -->
        <div class="app-brand ms-3">
          <a href="#" class="d-lg-block d-none">
            <img src="{{asset('assets/images/logo.svg')}}" class="logo" alt="Medicare Admin Template">
          </a>
          <a href="#" class="d-lg-none d-md-block">
            <img src="{{asset('assets/images/logo-sm.svg')}}" class="logo" alt="Medicare Admin Template">
          </a>
        </div>
        <!-- App brand ends -->

        <!-- App header actions starts -->
        <div class="header-actions">

          <!-- Search container starts -->
          <div class="search-container d-lg-block d-none mx-3">
            <input type="text" class="form-control" id="searchId" placeholder="Search">
            <i class="ri-search-line"></i>
          </div>
          <!-- Search container ends -->

          <!-- Header actions starts -->
          <div class="d-lg-flex d-none gap-2">

            <!-- Select country dropdown starts -->
            <div class="dropdown">
              <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="{{asset('assets/images/flags/1x1/fr.svg')}}" class="header-country-flag" alt="Bootstrap Dashboards">
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-mini">
                <div class="country-container">
                  <a href="index.html" class="py-2">
                    <img src="{{asset('assets/images/flags/1x1/us.svg')}}" alt="Admin Panel">
                  </a>
                  <a href="index.html" class="py-2">
                    <img src="{{asset('assets/images/flags/1x1/in.svg')}}" alt="Admin Panels">
                  </a>
                  <a href="index.html" class="py-2">
                    <img src="{{asset('assets/images/flags/1x1/br.svg')}}" alt="Admin Dashboards">
                  </a>
                  <a href="index.html" class="py-2">
                    <img src="{{asset('assets/images/flags/1x1/tr.svg')}}" alt="Admin Templatess">
                  </a>
                  <a href="index.html" class="py-2">
                    <img src="{{asset('assets/images/flags/1x1/gb.svg')}}" alt="Google Admin">
                  </a>
                </div>
              </div>
            </div>
            <!-- Select country dropdown ends -->

            <!-- Notifications dropdown starts -->
            <div class="dropdown">
              <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="ri-list-check-3"></i>
                <span class="count-label warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-300">
                <h5 class="fw-semibold px-3 py-2 text-primary">Activity</h5>

                <!-- Scroll starts -->
                <div class="scroll300">

                  <!-- Activity List Starts -->
                  <div class="p-3">
                    <ul class="p-0 activity-list2">
                      <li class="activity-item pb-3 mb-3">
                        <a href="#!">
                          <h5 class="fw-regular">
                            <i class="ri-circle-fill text-danger me-1"></i>
                            Invoices.
                          </h5>
                          <div class="ps-3 ms-2 border-start">
                            <div class="d-flex align-items-center mb-2">
                              <div class="flex-shrink-0">
                                <img src="{{asset('assets/images/products/1.jpg')}}" class="img-shadow img-3x rounded-1"
                                  alt="Hospital Admin Templates">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                23 invoices have been paid to the MediCare Labs.
                              </div>
                            </div>
                            <p class="m-0 small">10:20AM Today</p>
                          </div>
                        </a>
                      </li>
                      <li class="activity-item pb-3 mb-3">
                        <a href="#!">
                          <h5 class="fw-regular">
                            <i class="ri-circle-fill text-info me-1"></i>
                            Purchased.
                          </h5>
                          <div class="ps-3 ms-2 border-start">
                            <div class="d-flex align-items-center mb-2">
                              <div class="flex-shrink-0">
                                <img src="{{asset('assets/images/products/2.jpg')}}" class="img-shadow img-3x rounded-1"
                                  alt="Hospital Admin Templates">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                28 new surgical equipments have been purchased.
                              </div>
                            </div>
                            <p class="m-0 small">04:30PM Today</p>
                          </div>
                        </a>
                      </li>
                      <li class="activity-item pb-3 mb-3">
                        <a href="#!">
                          <h5 class="fw-regular">
                            <i class="ri-circle-fill text-success me-1"></i>
                            Appointed.
                          </h5>
                          <div class="ps-3 ms-2 border-start">
                            <div class="d-flex align-items-center mb-2">
                              <div class="flex-shrink-0">
                                <img src="{{asset('assets/images/products/8.jpg')}}" class="img-shadow img-3x rounded-1"
                                  alt="Hospital Admin Templates">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                36 new doctors and 28 staff members appointed.
                              </div>
                            </div>
                            <p class="m-0 small">06:50PM Today</p>
                          </div>
                        </a>
                      </li>
                      <li class="activity-item">
                        <a href="#!">
                          <h5 class="fw-regular">
                            <i class="ri-circle-fill text-warning me-1"></i>
                            Requested
                          </h5>
                          <div class="ps-3 ms-2 border-start">
                            <div class="d-flex align-items-center mb-2">
                              <div class="flex-shrink-0">
                                <img src="{{asset('assets/images/products/9.jpg')}}" class="img-shadow img-3x rounded-1"
                                  alt="Hospital Admin Templates">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                Requested for 6 new vehicles for medical emergency. .
                              </div>
                            </div>
                            <p class="m-0 small">08:30PM Today</p>
                          </div>
                        </a>
                      </li>
                    </ul>
                  </div>
                  <!-- Activity List Ends -->

                </div>
                <!-- Scroll ends -->

                <!-- View all button starts -->
                <div class="d-grid m-3">
                  <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                </div>
                <!-- View all button ends -->

              </div>
            </div>
            <!-- Notifications dropdown ends -->

            <!-- Notifications dropdown starts -->
            <div class="dropdown">
              <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="ri-alarm-warning-line"></i>
                <span class="count-label success"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-300">
                <h5 class="fw-semibold px-3 py-2 text-primary">Alerts</h5>

                <!-- Scroll starts -->
                <div class="scroll300">

                  <!-- Alert list starts -->
                  <div class="p-3">
                    <div class="d-flex py-2">
                      <div class="icon-box md bg-info rounded-circle me-3">
                        <span class="fw-bold fs-6 text-white">DS</span>
                      </div>
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Douglass Shaw</h6>
                        <p class="mb-1">
                          Appointed as a new President 2014-2025
                        </p>
                        <p class="small m-0 opacity-50">Today, 07:30pm</p>
                      </div>
                    </div>
                    <div class="d-flex py-2">
                      <div class="icon-box md bg-danger rounded-circle me-3">
                        <span class="fw-bold fs-6 text-white">WG</span>
                      </div>
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Willie Garrison</h6>
                        <p class="mb-1">
                          Congratulate, James for new job.
                        </p>
                        <p class="small m-0 opacity-50">Today, 08:00pm</p>
                      </div>
                    </div>
                    <div class="d-flex py-2">
                      <div class="icon-box md bg-warning rounded-circle me-3">
                        <span class="fw-bold fs-6 text-white">TJ</span>
                      </div>
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Terry Jenkins</h6>
                        <p class="mb-1">
                          Lewis added new doctors training schedule.
                        </p>
                        <p class="small m-0 opacity-50">Today, 09:30pm</p>
                      </div>
                    </div>
                  </div>
                  <!-- Alert list ends -->

                </div>
                <!-- Scroll ends -->

                <!-- View all button starts -->
                <div class="d-grid m-3">
                  <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                </div>
                <!-- View all button ends -->

              </div>
            </div>
            <!-- Notifications dropdown ends -->

            <!-- Messages dropdown starts -->
            <div class="dropdown">
              <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <i class="ri-message-3-line"></i>
                <span class="count-label"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-300">
                <h5 class="fw-semibold px-3 py-2 text-primary">Messages</h5>

                <!-- Scroll starts -->
                <div class="scroll300">

                  <!-- Messages list starts -->
                  <div class="p-3">
                    <div class="d-flex py-2">
                      <img src="{{asset('assets/images/user3.png')}}" class="img-shadow img-3x me-3 rounded-5"
                        alt="Hospital Admin Templates">
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Nick Gonzalez</h6>
                        <p class="mb-1">
                          Appointed as a new President 2014-2025
                        </p>
                        <p class="small m-0 opacity-50">Today, 07:30pm</p>
                      </div>
                    </div>
                    <div class="d-flex py-2">
                      <img src="{{asset('assets/images/user1.png')}}" class="img-shadow img-3x me-3 rounded-5"
                        alt="Hospital Admin Templates">
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Clyde Fowler</h6>
                        <p class="mb-1">
                          Congratulate, James for new job.
                        </p>
                        <p class="small m-0 opacity-50">Today, 08:00pm</p>
                      </div>
                    </div>
                    <div class="d-flex py-2">
                      <img src="{{asset('assets/images/user4.png')}}" class="img-shadow img-3x me-3 rounded-5"
                        alt="Hospital Admin Templates">
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">Sophie Michiels</h6>
                        <p class="mb-1">
                          Lewis added new doctors training schedule.
                        </p>
                        <p class="small m-0 opacity-50">Today, 09:30pm</p>
                      </div>
                    </div>
                  </div>
                  <!-- Messages list ends -->

                </div>
                <!-- Scroll ends -->

                <!-- View all button starts -->
                <div class="d-grid m-3">
                  <a href="javascript:void(0)" class="btn btn-primary">View all</a>
                </div>
                <!-- View all button ends -->

              </div>
            </div>
          </div>
          <!-- Header actions ends -->

          <!-- Header user settings starts -->
          <div class="dropdown ms-2">
            <a id="userSettings" class="dropdown-toggle d-flex align-items-center" href="#!" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              <div class="avatar-box">JB<span class="status busy"></span></div>
            </a>
            <div class="dropdown-menu dropdown-menu-end shadow-lg">
              <div class="px-3 py-2">
                <span class="small">{{$role}}</span>
                <h6 class="m-0">{{$name}} {{$prenom}} </h6>
              </div>
              <div class="mx-3 my-2 d-grid">
                <a href="{{route('logout')}}" class="btn btn-danger">Déconnexion</a>
              </div>
            </div>
          </div>
          <!-- Header user settings ends -->

        </div>
        <!-- App header actions ends -->

      </div>
      <!-- App header ends -->


        @yield('main content')
        @yield('Doctor content')
        @yield('doctor profile content')
        @yield('patient list content')
        @yield('waiting patient content')
        @yield('acceuil content')
        @yield('add')
        @yield('patient datas content')
        @yield('adding doctor content')
        @yield('doctor list content')
        @yield('add staff content')
        @yield('staff content')


        <!-- App footer starts -->
          <div class="app-footer bg-white">
            <span>© Medflex admin 2024</span>
          </div>
          <!-- App footer ends -->

        </div>
        <!-- App container ends -->

      </div>
      <!-- Main container ends -->

    </div>
    <!-- Page wrapper ends -->



<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/optionadd.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

<!-- *************
************ Vendor Js Files *************
************* -->


<!-- Overlay Scroll JS -->
<script src="{{asset('assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('assets/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

<!-- Apex Charts -->
<script src="{{asset('assets/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/area.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/line.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/bar.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/column-area.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/candlestick.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/graphs/heatmap.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/patients/medicalExpenses.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/patients/healthActivity.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/patients/insuranceClaims.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/patients/sparklines.js')}}"></script>
<script src="{{asset('assets/vendor/apex/custom/department/department-list.js')}}"> </script>
<script src="{{asset('assets/vendor/apex/custom/department/employees.js')}}"> </script>
<script src="{{asset('assets/vendor/apex/custom/graphs/pie.js')}}"></script>

<!-- Calendar JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('assets/vendor/calendar/js/main.min.js')}}"></script>
<script src="{{asset('assets/vendor/calendar/custom/daygrid-calendar.js')}}"></script>

<!-- Date Range JS -->
<script src="{{asset('assets/vendor/daterange/daterange.js')}}"></script>
<script src="{{asset('assets/vendor/daterange/custom-daterange.js')}}"></script>

<!-- Vector Maps -->
<script src="{{asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.5.min.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/world-mill-en.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/gdp-data.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/us_aea.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/usa.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/continents-mill.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/custom/world-map-markers2.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/custom/map-usa.js')}}"></script>
<script src="{{asset('assets/vendor/jvectormap/custom/map-usa2.js')}}"></script>

<!-- Morris Graphs -->
<script src="{{asset('assets/vendor/morris/raphael-min.js')}}"></script>
<script src="{{asset('assets/vendor/morris/morris.min.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/area.j')}}s"></script>
<script src="{{asset('assets/vendor/morris/custom/barColors.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/dayData.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/donutColors.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/donutFormatter.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/morrisBar.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/negativeValues.js')}}"></script>
<script src="{{asset('assets/vendor/morris/custom/stackedBar.js')}}"></script>

<!-- Custom JS files -->
<script src="{{asset('assets/js/custom.js')}}"></script>

<script src="{{asset('assets/vendor/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('assets/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('assets/vendor/quill/custom.js')}}"></script>
  </body>

</html>
