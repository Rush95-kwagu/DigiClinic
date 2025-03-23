<!DOCTYPE html>
<html lang="fr">

  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')| DigiClinic</title>

    <!-- Meta -->
    <meta name="description" content="DigiClinic">
    <meta name="author" content="Administration | Gestion de Cliniques">
    <link rel="canonical" href="https://www.gnlfconsult.com/">
    <meta property="og:url" content="https://www.gnlfconsult.com">
    <meta property="og:title" content="Administration | Gestion de Cliniques">
    <meta property="og:description" content="DigiClinic | Administration de Cliniques">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Administration | Gestion de Cliniques">

    <!-- SweetAlert DataTables.js -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.1/dist/sweetalert2.min.css">
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>


    <link rel="shortcut icon" href="{{asset('/frontend/images/favicon.svg')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('/frontend/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/css/main.min.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />

    <!-- *************
    ************ Vendor Css Files *************
  ************ -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="{{asset('/frontend/vendor/overlay-scroll/OverlayScrollbars.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/vendor/dropzone/dropzone.min.css')}}">
    <link rel="stylesheet" href="{{asset('/frontend/vendor/quill/quill.core.css')}}">
     @yield('gstatic')
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
          <a href="{{URL::to('/dashboard')}}" class="d-lg-block d-none">
            <img src="{{asset('/frontend/images/logo.png')}}" class="logo" alt="Digiclinic">
          </a>
          <a href="{{URL::to('/dashboard')}}" class="d-lg-none d-md-block">
            <img src="{{asset('/frontend/images/logo.png')}}" class="logo" alt="Digiclinic">
          </a>
        </div>
        <!-- App brand ends -->

        <!-- App header actions starts -->
        <div class="header-actions">

          <!-- Search container starts -->
          <!-- <div class="search-container d-lg-block d-none mx-3">
            <input type="text" class="form-control" id="searchId" placeholder="Search">
            <i class="ri-search-line"></i>
          </div> -->
          <!-- Search container ends -->

          <!-- Header actions starts -->
          <div class="d-lg-flex d-none gap-2">

            <!-- Select country dropdown starts -->
            <!-- <div class="dropdown">
              <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                <img src="assets/images/flags/1x1/fr.svg" class="header-country-flag" alt="Bootstrap Dashboards">
              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-mini">
                <div class="country-container">
                  <a href="{{URL::to('/dashboard')}}" class="py-2">
                    <img src="assets/images/flags/1x1/us.svg" alt="Admin Panel">
                  </a>
                  <a href="{{URL::to('/dashboard')}}" class="py-2">
                    <img src="assets/images/flags/1x1/in.svg" alt="Admin Panels">
                  </a>
                  <a href="{{URL::to('/dashboard')}}" class="py-2">
                    <img src="assets/images/flags/1x1/br.svg" alt="Admin Dashboards">
                  </a>
                  <a href="{{URL::to('/dashboard')}}" class="py-2">
                    <img src="assets/images/flags/1x1/tr.svg" alt="Admin Templatess">
                  </a>
                  <a href="{{URL::to('/dashboard')}}" class="py-2">
                    <img src="assets/images/flags/1x1/gb.svg" alt="Google Admin">
                  </a>
                </div>
              </div>
            </div> -->
            <!-- Select country dropdown ends -->

            <!-- Notifications dropdown starts -->
        {{--<div class="dropdown">
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
                              <img src="{{asset('frontend/images/products/1.jpg')}}" class="img-shadow img-3x rounded-1"
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
                              <img src="{{asset('frontend/images/products/2.jpg')}}" class="img-shadow img-3x rounded-1"
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
                              <img src="{{asset('frontend/images/products/8.jpg')}}" class="img-shadow img-3x rounded-1"
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
                              <img src="{{asset('frontend/images/products/9.jpg')}}" class="img-shadow img-3x rounded-1"
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
          </div>--}}
            <!-- Notifications dropdown ends -->

            <!-- Notifications dropdown starts -->
          <div class="dropdown">
            <a class="dropdown-toggle header-icon" href="#!" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
              @if($user_role_id == 9)
              <?php
                          $nbre_ostock=DB::table('tbl_products')
                                    ->where('stock',0)
                                    ->count();

                          $nbre_lstock=DB::table('tbl_products')
                                    ->where('stock','<=',5)
                                    ->where('stock','!=',0)
                                    ->count();
              ?>
                <span
                        class="position-absolute top-0 start-5 translate-middle badge rounded-pill bg-danger">{{$nbre_ostock + $nbre_lstock}}</span>
              <?php ?>
              @endif
                <i class="ri-alarm-warning-line"></i>

              </a>
              <div class="dropdown-menu dropdown-menu-end dropdown-300">


                <h5 class="fw-semibold px-3 py-2 text-primary">Alerts</h5>



                <!-- Scroll starts -->
                <div class="scroll300">

                  <!-- Alert list starts -->
                  <div class="p-3">

                  <?php
                        $low_stock=DB::table('tbl_products')
                                    ->where('stock','<=',5)
                                    ->where('stock','!=',0)
                                    ->get();
                  ?>

                  @foreach($low_stock as $v_lstok)
                    <div class="d-flex py-2">
                      <div class="icon-box md bg-info rounded-circle me-3">
                         <img style="width: 50px;" src="{{URL::asset($v_lstok->product_image)}}" alt="{{$v_lstok->product_name}}">
                      </div>
                      <div class="m-0">
                        <h6 class="mb-1 fw-semibold">{{$v_lstok->product_name}}</h6>
                        <p class="mb-1">
                          Prix : {{$v_lstok->product_price}} F
                        </p>
                        <p style="color:red" class="small m-0 opacity-50">Stock : {{$v_lstok->stock}}</p>
                      </div>
                    </div>
                  @endforeach
                  <?php ?>


                  </div>
                  <!-- Alert list ends -->

                </div>
                <!-- Scroll ends -->

                <!-- View all button starts -->
                <div class="d-grid m-3">
                  <a href="{{URL::to('etat-stock')}}" class="btn btn-primary">Imprimer l'état stock</a>
                </div>
                <!-- View all button ends -->

              </div>
            </div>
            <!-- Notifications dropdown ends -->

            <!-- Messages dropdown starts -->
            {{--<div class="dropdown">
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
                    <img src="{{asset('/frontend/images/user3.png')}}" class="img-shadow img-3x me-3 rounded-5"
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
                    <img src="{{asset('frontend/images/user1.png')}}" class="img-shadow img-3x me-3 rounded-5"
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
                    <img src="{{asset('frontend/images/user4.png')}}" class="img-shadow img-3x me-3 rounded-5"
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
          </div>--}}
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
                <span class="small">{{Session::get('role')}}</span>
                <h6 class="m-0">{{Session::get('prenom')}} {{Session::get('nom')}}</h6>
              </div>
              <div class="mx-3 my-2 d-grid">
                <a href="{{URL::to('logout')}}" class="btn btn-danger">Logout</a>
              </div>
            </div>
          </div>
          <!-- Header user settings ends -->

        </div>
        <!-- App header actions ends -->

      </div>
      <!-- App header ends -->

      <!-- Main container starts -->
      <div class="main-container">

        <!-- Sidebar wrapper starts -->
        <nav id="sidebar" class="sidebar-wrapper">
        <?php
        $email=Session::get('email');
        $user=DB::table('personnel')
              ->where('email',$email)
              ->first();
        ?>

          <!-- Sidebar profile starts -->
          <div class="sidebar-profile">
            @if($user->sexe == 'F')
            <img src="{{asset('frontend/F.png')}}" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
            @else
            <img src="{{asset('frontend/M.png')}}" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
            @endif
            <div class="m-0">
              <h5 class="mb-1 profile-name text-nowrap text-truncate">{{Session::get('nom')}} {{Session::get('prenom')}}</h5>
              <p class="m-0 small profile-name text-nowrap text-truncate">{{$user->specialite}}</p>
            </div>
          </div>
          <!-- Sidebar profile ends -->

          <!-- Sidebar menu starts -->
          <div class="sidebarMenuScroll">
            <ul class="sidebar-menu">
              @if($user_role_id == 0)
              <li class="active current-page">
                <a href="{{URL::to('/dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Mon tableau de bord</span>
                </a>
              </li>
               <li class="treeview">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('prises-en-charges')}}">Prises en charges</a>
                  </li>
                </ul>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('demande-externe')}}">Analyses Externes</a>
                  </li>
                </ul>
              </li>

              @elseif($user_role_id == 1)
              <li class="active current-page">
                <a href="{{URL::to('/dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Mon tableau de bord</span>
                </a>
                
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-money-dollar-circle-line"></i>
                  <span class="menu-text">{{Session::get('role')}} </span>
                </a>
                <ul class="treeview-menu">
                  
                  <li>
                    <a href="#!">
                      Analyses
                      <i class="ri-arrow-right-s-line"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li>
                        <a href="{{URL::to('gestion-demande-ext')}}">Gestion des analyses</a>
                      </li>
                      <li>
                        <a href="{{ URL::to('all-analyses') }}">Soumettre une analyse</a>
                      </li>
                      
                    </ul>
                  </li>
                 
                </ul>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('all-prestations')}}">Prestations</a>
                  </li>
                 
                  
                <li>
                  <a href="{{URL::to('/les-ventes')}}">Pharmacie</a>
                </li>
                </ul>
              </li>
              
              <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">Stock Pharmacie</span>
                </a>
                <ul class="treeview-menu">
                  {{-- <li>
                    <a href="{{URL::to('/les-ventes')}}">Ventes à Caisse</a>
                  </li> --}}
                  <li>
                    <a href="{{URL::to('all-category')}}">Etat du stock</a>
                  </li>

                  <li>
                    <a href="{{URL::to('approvisionnement')}}">Appro Pharmacie</a>
                  </li>

                </ul>
              </li>
              {{-- <li class="treeview">
                <a href="{{URL::to('revenus-globaux')}}">
                  <i class="ri-secure-payment-line"></i>
                  <span class="menu-text">Revenus</span>
                </a>
              </li> --}}
              @elseif($user_role_id == 2 || $user_role_id == 3  || $user_role_id == 7 || $user_role_id == 5 || $user_role_id == 6 || $user_role_id == 8 )

              <li class="treeview">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('consultations')}}">Consultations</a>
                  </li>
                </ul>
              </li>


              @elseif($user_role_id == 4)
              <li class="treeview">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('gestion-analyses')}}">Analyses</a>
                    {{-- <a href="{{URL::to('gestion-analyses')}}">Analyses Générales</a>
                    <a href="{{URL::to('consultations')}}">Analyses internes</a> --}}
                  </li>
                </ul>
              </li>

@elseif($user_role_id == 4)
              <li class="treeview">
                <a href="#!">
                  <i class="ri-microscope-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                  <a href="{{URL::to('gestion-analyses')}}">Analyses Générales</a>
                    <a href="{{URL::to('consultations')}}">Analyses internes</a>
                    <a href="#">Stock </a>
                  </li>
                </ul>
              </li>

              @elseif($user_role_id == 9)
              <li class="active current-page">
                <a href="{{URL::to('/dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Mon tableau de bord</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('/les-ventes')}}">Ventes à Caisse</a>
                  </li>
                  <li>
                    <a href="{{URL::to('all-category')}}">Produits en Pharmacie</a>
                  </li>

                  <li>
                    <a href="{{URL::to('approvisionnement')}}">Appro Pharmacie</a>
                  </li>

                </ul>
              </li>
              @elseif($user_role_id == 11)
              <li class="active current-page">
                <a href="{{URL::to('/dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Mon tableau de bord</span>
                </a>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">{{Session::get('role')}}</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('all-prestations')}}">Liste des prestations</a>
                  </li>
                  <li>
                    <li>
                      <a href="{{ URL::to('all-analyses') }}">Liste des Analyses</a>
                  </li>
                  <li>
                    <a href="{{URL::to('all-category')}}">Produits en Pharmacie</a>
                  </li>

                </ul>
              </li>
              @elseif($user_role_id == 10)

              <!-- Admin sidebar -->
              <!-- Admin sidebar -->
              <!-- Admin sidebar -->

              <li class="active current-page">
                <a href="{{URL::to('/dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Espace de l'hopital</span>
                </a>
              </li>
              <li>
                <a href="dashboard2.html">
                  <i class="ri-microscope-line fs-4"></i>
                  <span class="menu-text">Espace labo</span>
                </a>
              </li>
              <li class="">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">Espace Médecins</span>
                </a>
                {{-- <ul class="treeview-menu">
                  <li>
                    <a href="{{url('generaliste.profil')}}">Mes informations personnelles</a>
                  </li>
                  <li>
                    <a href="add-doctors.html">Modifier mes informations</a>
                  </li>

                </ul> --}}
              </li>
            
              <li class="treeview">
                <a href="#!">
                  <i class="ri-heart-pulse-line"></i>
                  <span class="menu-text">Patients</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{route('patient.repertoire')}}">Répertoire des patients</a>
                  </li>
                  {{-- <li>
                    <a href="{{route('personnel.create')}}">Ajouter </a>
                  </li> --}}
                  </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-nurse-line"></i>
                  <span class="menu-text">Personnel</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{route('personnel.index')}}">Liste du Peronnel</a>
                  </li>
                  <li>
                    <a href="{{route('personnel.create')}}">Ajouter </a>
                  </li>
                  </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-building-2-line"></i>
                  <span class="menu-text">Services</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{route('services.index')}}">Répertoire des services</a>
                  </li>
                  <li>
                    <a href="{{route('services.create')}}">Créer un nouveau service</a>
                  </li>

                </ul>
              </li>
               <li class="treeview">
                <a href="#!">
                  <i class="ri-hotel-bed-line"></i>
                  <span class="menu-text">Chambres</span>
                </a>
                <ul class="treeview-menu">
                  {{-- <li>
                    <a href="room-statistics.html">Statistics</a>
                  </li> --}}
                  <li>
                    <a href="{{route('room.index')}}">Chambres par départements</a>
                  </li>
                  <li>
                    <a href="{{route('allotted-room')}}">Chambres occupées</a>
                  </li>
                  <li>
                    <a href="available-rooms.html">Chambre disponible</a>
                  </li>
                  <li>
                    <a href="book-room.html">Book Room</a>
                  </li>
                  <li>
                    <a href="{{ route('room.create')}}">Ajout chambres</a>
                  </li>
                  <li>
                    <a href="edit-room.html">Edit Room</a>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-building-2-line"></i>
                  <span class="menu-text">Espace entités</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{route('entities.add')}}">Créer une entité</a>
                  </li>
                  <li>
                    <a href="{{route('entities.index')}}">Entités disponibles</a>
                  </li>

                </ul>
              </li>
               <li class="treeview">
                <a href="#!">
                  <i class="ri-building-2-line"></i>
                  <span class="menu-text">Espace centres</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{route('centers.add')}}">Créer un centre</a>
                  </li>
                  <li>
                    <a href="{{route('centers.index')}}">Centres disponibles</a>
                  </li>

                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-login-circle-line"></i>
                  <span class="menu-text">Comptes utilsateurs</span>
                </a>
                <ul class="treeview-menu">

                  <li>
                    <a href="{{route('create.user')}}">Créer un nouveau compte</a>
                  </li>
                 <li>
                    <a href="reset-password.html">Réinitialiser un mot de passe</a>
                  </li>
                </ul>
              </li>





              <!-- Accueil sidebar -->
              <!-- Accueil sidebar -->


              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-heart-pulse-line"></i>
                  <span class="menu-text">Les Patients</span>
                </a>
                <ul class="treeview-menu">

                  <li>
                    <a href="{{URL::to('patient.index')}}">Patients reçus</a>
                  </li>
                  <li>
                    <a href="{{URL::to('patient.create')}}">Nouveau patient</a>
                  </li>
                 </ul>
              </li> --}}

              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">Rendez-vous</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="appointments.html">Rendez-vous groupés</a>
                  </li>
                  <li>
                    <a href="appointments-list.html">Rendez-vous détaillés</a>
                  </li>

                </ul>
              </li> --}}
              {{-- <li>
                <a href="events.html">
                  <i class="ri-calendar-line"></i>
                  <span class="menu-text">Gestion d'evenements</span>
                </a>
              </li> --}}


              <!-- Doctor sidebar -->
              <!-- Doctor sidebar -->
              <!-- Doctor sidebar -->
              <!-- Doctor sidebar -->
              <!-- Doctor sidebar -->


              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-heart-pulse-line"></i>
                  <span class="menu-text">Espaces Patients</span>
                </a>
                <ul class="treeview-menu">

                  <li>
                    <a href="{{url('patient.index')}}">Patients reçus</a>
                  </li>
                  <li>
                    <a href="{{url('generaliste.patient.waiting')}}">Patients en attente</a>
                  </li>
                  <li>
                    <a href="edit-patient.html">Demander une analyse</a>
                  </li>
                </ul>
              </li> --}}
              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-nurse-line"></i>
                  <span class="menu-text">Rendez-vous</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="staff.html">Mes Rendez-vous</a>
                  </li>
                  <li>
                    <a href="add-staff.html">Nouveau Rendez-vous </a>
                  </li>

                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">Rendez-vous</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="appointments.html">Rendez-vous</a>
                  </li>
                  <li>
                    <a href="appointments-list.html">Liste des rendez-vous</a>
                  </li>
                  <li>
                    <a href="book-appointment.html">Nouveau rendez-vous</a>
                  </li>
                  <li>
                    <a href="edit-appointment.html">Editer un rendez-vous</a>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-building-2-line"></i>
                  <span class="menu-text">Mon Departments</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="departments-list.html">Informations relatives à mon département</a>
                  </li>

                </ul>
              </li> --}}

              <!-- General sidebar -->
              <!-- General sidebar -->
              <!-- General sidebar -->
              <!-- General sidebar -->
              <!-- General sidebar -->
              <!-- General sidebar -->

              {{-- <li class="treeview">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">Médecin</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{URL::to('')}}">Mes informations personnelles</a>
                  </li>
                  <li>
                    <a href="add-doctors.html">Modifier mes informations</a>
                  </li>

                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-heart-pulse-line"></i>
                  <span class="menu-text">Mes Patients</span>
                </a>
                <ul class="treeview-menu">

                  <li>
                    <a href="{{url('patient.index')}}">Patients reçus</a>
                  </li>
                  <li>
                    <a href="{{url('generaliste.patient.waiting')}}">Patients en attente</a>
                  </li>
                  <li>
                    <a href="edit-patient.html">Demander une analyse</a>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-nurse-line"></i>
                  <span class="menu-text">Rendez-vous</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="staff.html">Mes Rendez-vous</a>
                  </li>
                  <li>
                    <a href="add-staff.html">Nouveau Rendez-vous </a>
                  </li>

                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-dossier-line"></i>
                  <span class="menu-text">Rendez-vous</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="appointments.html">Rendez-vous</a>
                  </li>
                  <li>
                    <a href="appointments-list.html">Liste des rendez-vous</a>
                  </li>
                  <li>
                    <a href="book-appointment.html">Nouveau rendez-vous</a>
                  </li>
                  <li>
                    <a href="edit-appointment.html">Editer un rendez-vous</a>
                  </li>
                </ul>
              </li>
              <li class="treeview">
                <a href="#!">
                  <i class="ri-building-2-line"></i>
                  <span class="menu-text">Mon Departments</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="departments-list.html">Informations relatives à mon département</a>
                  </li>

                </ul>
              </li> --}}
              @endif



                </ul>
          </div>
          <!-- Sidebar menu ends -->

          <!-- Sidebar contact starts -->
          <div class="sidebar-contact">
            <p class="fw-light mb-1 text-nowrap text-truncate">Numéro Support</p>
            <h5 class="m-0 lh-1 text-nowrap text-truncate">+229 90006005</h5>
            <i class="ri-phone-line"></i>
          </div>
          <!-- Sidebar contact ends -->

        </nav>
        <!-- Sidebar wrapper ends -->

        <!-- App container starts -->
        <div class="app-container">

          <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="{{URL::to('/dashboard')}}">Acceuil</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page"><a href="{{URL::to('/dashboard')}}">
                Tableau de bord</a>
              </li>
            </ol>
            <!-- Breadcrumb ends -->

            <!-- Sales stats starts -->
            <!-- <div class="ms-auto d-lg-flex d-none flex-row">
              <div class="d-flex flex-row gap-1 day-sorting">
                <button class="btn btn-sm btn-primary">Today</button>
                <button class="btn btn-sm">7d</button>
                <button class="btn btn-sm">2w</button>
                <button class="btn btn-sm">1m</button>
                <button class="btn btn-sm">3m</button>
                <button class="btn btn-sm">6m</button>
                <button class="btn btn-sm">1y</button>
              </div>
            </div> -->
            <!-- Sales stats ends -->

          </div>
          <!-- App Hero header ends -->

          <!-- App body starts -->


                @yield('user_content')
                @yield('admin')
                @yield('admin_content')
                @yield('staff content')
                @yield('add staff content')
                @yield('service content')
                @yield('add service content')


          <!-- App body ends -->

          <!-- App footer starts -->
          <div class="app-footer bg-white">
            <span>© DigiClinic 2024</span>
          </div>
          <!-- App footer ends -->

        </div>
        <!-- App container ends -->

      </div>
      <!-- Main container ends -->

    </div>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/app.js')}}"></script>
<script src="{{asset('frontend/js/optionadd.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>

<!-- *************
************ Vendor Js Files *************
************* -->


<!-- Overlay Scroll JS -->
<script src="{{asset('frontend/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
<script src="{{asset('frontend/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

<!-- Apex Charts -->
<script src="{{asset('frontend/vendor/apex/apexcharts.min.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/area.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/line.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/bar.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/column-area.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/candlestick.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/heatmap.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/patients/medicalExpenses.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/patients/healthActivity.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/patients/insuranceClaims.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/patients/sparklines.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/department/department-list.js')}}"> </script>
<script src="{{asset('frontend/vendor/apex/custom/department/employees.js')}}"> </script>
<script src="{{asset('frontend/vendor/apex/custom/graphs/pie.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/rooms/admissions.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/income/income.js')}}"></script>




<!-- Calendar JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="{{asset('frontend/vendor/calendar/js/main.min.js')}}"></script>
<script src="{{asset('frontend/vendor/calendar/custom/daygrid-calendar.js')}}"></script>

<!-- Date Range JS -->
<script src="{{asset('frontend/vendor/daterange/daterange.js')}}"></script>
<script src="{{asset('frontend/vendor/daterange/custom-daterange.js')}}"></script>

<!-- Vector Maps -->
<script src="{{asset('frontend/vendor/jvectormap/jquery-jvectormap-2.0.5.min.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/world-mill-en.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/gdp-data.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/us_aea.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/usa.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/continents-mill.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/custom/world-map-markers2.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/custom/map-usa.js')}}"></script>
<script src="{{asset('frontend/vendor/jvectormap/custom/map-usa2.js')}}"></script>

<!-- Morris Graphs -->
<script src="{{asset('frontend/vendor/morris/raphael-min.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/morris.min.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/area.j')}}s"></script>
<script src="{{asset('frontend/vendor/morris/custom/barColors.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/dayData.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/donutColors.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/donutFormatter.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/morrisBar.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/negativeValues.js')}}"></script>
<script src="{{asset('frontend/vendor/morris/custom/stackedBar.js')}}"></script>

<!-- Custom JS files -->
<script src="{{asset('frontend/js/custom.js')}}"></script>

<script src="{{asset('frontend/vendor/dropzone/dropzone.min.js')}}"></script>
<script src="{{asset('frontend/vendor/quill/quill.min.js')}}"></script>
<script src="{{asset('frontend/vendor/quill/custom.js')}}"></script>
<script src="{{asset('frontend/vendor/apex/custom/dashboard2/orders.js')}}"></script>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>


<!-- DataTables.js -->
<link href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css" rel="stylesheet">

@yield('Datatable')
@yield('DataTable2')
<script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slim-select/1.23.0/slimselect.min.js"></script>
@stack('js')
@stack('ajax')

<script>
var quill = new Quill("#quill_editor", {
  theme: "snow",
});
let tb = document.querySelector('#tb')

    function block (para = null) {
        if(para){
            para.preventDefault();
        }else {
            return true;
        }
    }

let edit = document.querySelector('.ql-editor');
let texte = document.querySelector('#textar')
edit.addEventListener('keyup', () => {
        texte.innerHTML = edit.innerHTML
})



var quill1 = new Quill("#quill_editor1", {
  theme: "snow",
});
let tb1 = document.querySelector('#tb1')

    function block (para = null) {
        if(para){
            para.preventDefault();
        }else {
            return true;
        }
    }

let edit1 = document.querySelector('.ql-editor1');
let texte1 = document.querySelector('#textar1')
edit1.addEventListener('keyup', () => {
        texte1.innerHTML = edit1.innerHTML
})
</script>
<script>
  $(document).ready(function() {
      console.log("jQuery est bien chargé !");
  });
</script>


</body>

</html>