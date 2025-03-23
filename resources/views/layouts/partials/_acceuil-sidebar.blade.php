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
                  <span class="menu-text">{{$role}}</span>
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
                  <span class="menu-text">Les Patients</span>
                </a>
                <ul class="treeview-menu">

                  <li>
                    <a href="{{route('patient.index')}}">Patients reçus</a>
                  </li>
                  <li>
                    <a href="{{route('patient.create')}}">Nouveau patient</a>
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
                    <a href="appointments.html">Rendez-vous groupés</a>
                  </li>
                  <li>
                    <a href="appointments-list.html">Rendez-vous détaillés</a>
                  </li>

                </ul>
              </li>
              <li>
                <a href="events.html">
                  <i class="ri-calendar-line"></i>
                  <span class="menu-text">Gestion d'evenements</span>
                </a>
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
