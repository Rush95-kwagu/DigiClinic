<nav id="sidebar" class="sidebar-wrapper">

          <!-- Sidebar profile starts -->
          <div class="sidebar-profile">
            <img src="{{asset('assets/images/user6.png')}}" class="img-shadow img-3x me-3 rounded-5" alt="Hospital Admin Templates">
            <div class="m-0">
              <h5 class="mb-1 profile-name text-nowrap text-truncate">{{$name}} {{$prenom}} </h5>
              <p class="m-0 small profile-name text-nowrap text-truncate">{{$departement}}</p>
            </div>
          </div>
          <!-- Sidebar profile ends -->

          <!-- Sidebar menu starts -->
          <div class="sidebarMenuScroll">
            <ul class="sidebar-menu">
              <li class="active current-page">
                <a href="{{url('medecin.generaliste.dashboard')}}">
                  <i class="ri-home-6-line"></i>
                  <span class="menu-text">Mon tableau de bord</span>
                </a>
              </li>

              <li class="treeview">
                <a href="#!">
                  <i class="ri-stethoscope-line"></i>
                  <span class="menu-text">Médecin</span>
                </a>
                <ul class="treeview-menu">
                  <li>
                    <a href="{{url('generaliste.profil')}}">Mes informations personnelles</a>
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
              </li>

                </ul>
          </div>
          <!-- Sidebar menu ends -->

          <!-- Sidebar contact starts -->
          <div class="sidebar-contact">
            <p class="fw-light mb-1 text-nowrap text-truncate">Emergency Contact</p>
            <h5 class="m-0 lh-1 text-nowrap text-truncate">0987654321</h5>
            <i class="ri-phone-line"></i>
          </div>
          <!-- Sidebar contact ends -->

        </nav>
