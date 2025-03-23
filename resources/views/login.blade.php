<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Connexion | DigiClinic</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="frontend/images/favicon.svg">

    <!-- *************
			************ CSS Files *************
		************* -->
    <link rel="stylesheet" href="{{asset('frontend/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.min.css')}}">

  </head>

  <body class="login-bg">
  <?php $error=Session::get('error')?>
  <?php $succes=Session::get('succes')?>
  <?php $warn=Session::get('warn')?>
    <!-- Container starts -->
    <div class="container">

      <!-- Auth wrapper starts -->
      <div class="auth-wrapper">


        <!-- Form starts -->
        <form action="{{url('login')}}" method="POST">
            @csrf
           
            @if($error)
              <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                      <?php
                        $error=Session::get('error'); 
                            if ($error) {
                              echo $error;
                                Session::put('error',null);
                            }
                      ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif 


            @if($succes)
              <div class="alert bg-success text-white alert-dismissible d-flex align-items-center fade show"
                      role="alert">
              <i class="ri-checkbox-circle-line fs-3 me-2 lh-1"></i>
                      <?php
                        $succes=Session::get('succes'); 
                            if ($succes) {
                              echo $succes;
                                Session::put('succes',null);
                            }
                      ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif 


            @if($warn)
              <div class="alert bg-warning  text-white alert-dismissible d-flex align-items-center fade show"
                      role="alert">
              <i class="ri-alert-line fs-3 me-2 lh-1"></i>
                      <?php
                        $warn=Session::get('warn'); 
                            if ($warn) {
                              echo $warn;
                                Session::put('warn',null);
                            }
                      ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif 

          <div class="auth-box">
            <a href="#" class="auth-logo mb-4">
              <img src="{{asset('frontend/images/logo.png')}}" alt="Bootstrap Gallery">
            </a>

            <h4 class="mb-4">Connexion</h4>

            <div class="mb-3">
              <label class="form-label" for="email">Votre adresse mail <span class="text-danger">*</span></label>
              <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>

            <div class="mb-2">
              <label class="form-label" for="password">Votre mot de passe<span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="password" id="password" name="password" class="form-control" placeholder="saisir le mot de passe" required>
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ri-eye-line text-primary"></i>
                </button>
              </div>
            </div>

            <div class="d-flex justify-content-end mb-3">
              <a href="forgot-password.html" class="text-decoration-underline">Réinitialiser le mot de passe?</a>
            </div>

            <div class="mb-3 d-grid gap-2">
              <button type="submit" class="btn btn-primary">Se connecter</button>
              {{-- <a href="{{URL::to('register')}}" class="btn btn-secondary">Not registered? Signup</a>  --}}
            </div>

          </div>

        </form>
        <!-- Form ends -->

      </div>
      <!-- Auth wrapper ends -->

    </div>
    <!-- Container ends -->


    <script src="{{asset('frontend/js/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/moment.min.js')}}"></script>

    <!-- *************
      ************ Vendor Js Files *************
    ************* -->

    <!-- Overlay Scroll JS -->
    <script src="{{asset('frontend/vendor/overlay-scroll/jquery.overlayScrollbars.min.js')}}"></script>
    <script src="{{asset('frontend/vendor/overlay-scroll/custom-scrollbar.js')}}"></script>

    <!-- Custom JS files -->
    <script src="{{asset('frontend/js/custom.js')}}"></script>
  </body>

</html>
