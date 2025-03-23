<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer un compte utilisateur | DigiClinic</title>

    <!-- Meta -->
    <meta name="description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta name="author" content="Bootstrap Gallery">
    <link rel="canonical" href="https://www.bootstrap.gallery/">
    <meta property="og:url" content="https://www.bootstrap.gallery">
    <meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
    <meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
    <meta property="og:type" content="Website">
    <meta property="og:site_name" content="Bootstrap Gallery">
    <link rel="shortcut icon" href="{{asset('frontend/images/favicon.svg')}}">

    <!-- *************
			************ CSS Files *************
		************* -->

    <link rel="stylesheet" href="{{asset('frontend/fonts/remix/remixicon.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/main.min.css')}}">

  </head>

  <body class="login-bg">
    <?php $message=Session::get('error')?>
      <!-- Container starts -->
      <div class="container">

          <!-- Auth wrapper starts -->
          @if (session()->has('AccountCreated'))
          <div class="alert alert-success" role="alert">
          {{session()->get('AccountCreated')}}
        </div>
          @endif

        <div class="auth-wrapper part-two">
     
            <form method="POST" action="{{ route('store.user') }}">
                @csrf

          @if($message)
              <div class="alert bg-danger text-white alert-dismissible fade show" role="alert">
                      <?php
                        $message=Session::get('error'); 
                            if ($message) {
                              echo $message;
                                Session::put('error',null);
                            }
                      ?>
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
          @endif 
          <div class="auth-box">
            <a href="#" class="auth-logo mb-4">
              <img src="{{asset('frontend/images/logo-dark.svg')}}" alt="Bootstrap Gallery">
            </a>

            <h4 class="mb-4">Création de compte</h4>

            <div class="mb-3">
              <label class="form-label" for="email">Adresse mail <span class="text-danger">*</span></label>
              <input id="email" type="text" class="form-control" name="email" placeholder="Entrez l'adresse mail" required>
            </div>

            <div class="mb-3">
              <label class="form-label" for="departement">Fonction <span class="text-danger">*</span></label>
                <select class="form-select" id="departement" name="user_role_id" style="display: block" aria-required="true">
                  <?php 

                                            $all_role=DB::table('user_roles')
                                                      
                                                      ->get();

                                            foreach ($all_role as $v_role){ ?>  
                                            <option class="form-control"  value="{{$v_role->user_role_id}}">{{$v_role->title}}</option>
                                    
                                
                  <?php } ?>
                </select>
            </div>

          

            <div class="mb-3">
              <label class="form-label" for="password">Mot de passe<span class="text-danger">*</span></label>
              <div class="input-group">
                <input type="password"  class="form-control" placeholder="Saisir mot de passe" name="password" required>
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ri-eye-line text-primary"></i>
                </button>
              </div>
              </div>

              <div class="mb-3">
              <label class="form-label" for="password-confirm">Confirmation Mot de passe<span class="text-danger">*</span></label>
               
              <div class="input-group">
              <div class="incorect" style="position: absolute; right: 0; font-size: 7px; text-transform: lowercase;width:50%; font-style: italic; transform: translateY(7px); color: red; text-align: end">
                             
               </div>

                <input id="password-confirm" type="password"  class="form-control" placeholder="Retapez le mot de passe" name="password_confirmation" required>
                <button class="btn btn-outline-secondary" type="button">
                  <i class="ri-eye-line text-primary"></i>
                </button>
              </div>
              </div> 

            <div class="mb-3 d-grid gap-2">
              <button type="submit" class="btn btn-primary">Créer le compte</button>
              <a href="{{URL::to('/')}}" class="btn btn-secondary">Se connecter</a>
              <!-- <a href="login.html" class="btn btn-secondary">Réinitialiser un compte</a> -->
            </div>

          </div>

        </form>
        <!-- Form ends -->

      </div>
      <!-- Auth wrapper ends -->

    </div>
    <!-- Container ends -->
<script src="{{asset('frontend/js/optionadd.js')}}"></script>
<script>
  
    const signIn = document.querySelector('.part-two')

    const alertA = document.querySelector('.incorect')
   
    const label_click = document.querySelectorAll('.mb-3 input + span')
    const inputI = document.querySelectorAll('.part-two .mb-3 input[type="password"]');
    let password = inputI[0]
    let confirm = inputI[1]
    

    console.log(inputI);

   

    label_click.forEach(enfant => {
        enfant.addEventListener('click', ()=>{
            enfant.classList.toggle('see');
            let input = enfant.parentNode.querySelector('input')
            if(input.type === "password"){
                input.type = "text"
            }else if(input.type = "text"){
                input.type = "password"
            }
        })
    })

    inputI.forEach(clild => {
        clild.addEventListener('keyup', ()=>{
            if((clild.value).length < 8){
                clild.style.border = '1px solid #fc8f93'
            }else{
                clild.style.border = '1px solid rgb(241, 241, 241)'
            }
        })
    })

    password.addEventListener('keyup', () =>{
        if((password.value).length > 7){
            confirm.removeAttribute('disabled')
        }else{
            confirm.setAttribute('disabled', '');
        }
    })

    confirm.addEventListener('keyup', () =>{
        let motdepasse = password.value;
        if( ((confirm.value).length > 7) & (confirm.value !== motdepasse)){
            alertA.innerHTML = 'Mot de passe incorrect' 
        }else{
            alertA.innerHTML = '';
        }
    })
</script>

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
