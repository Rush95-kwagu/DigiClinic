@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
?>

          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Consultations - Enregistrer des prises en charge de patients</h5>
                </div>

			    <div class="card-body" id="enleverE">
			       
			
                  {{-- Début seconde partie du formulaire --}}
                   <div class="card-body" style="display:block; "id="step2">
                    <form class="row g-3 needs-validation" id="step2Form" method="POST" action="{{ route('save.step2') }}">
            				{{csrf_field()}}
                    <input type="hidden" name="centre_id" value="{{$centre_id}}">
                          <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Température*</label>
                        <input type="number" min="27" name="temp" class="form-control" id="validationCustom05" required />
                        <div class="invalid-feedback">
                          Entrez la température.
                        </div>
                      </div>

                      
        <div class="row g-3 needs-validation">
          <div class="col-md-6">
            <label for="phone1">Télephone du patient</label><br>
            <input type="tel" class="form-control" type="tel" placeholder="Contact Whatsapp/Appel" id="phone1" name="mobile_number" required="" />
            <input type="hidden" id='lnai' name="telephone">
          </div>

          <div class="col-md-6">
            <label for="lnaii">Personne à contacter</label><br>
            <input type="tel" class="form-control" type="tel" placeholder="Personne à contacter en cas d'urgence" id="phone2" name="mobile_urgence" required="" />
            <input type="hidden" id='lnaii' name="contact_urgence">
          </div>
        </div>


			          <div class="col-md-4 form-group">
			            <label for="phone1">Nip</label><br>
			            <input type="tel" class="form-control" placeholder="Cip" name="nip" required="" />
			            
			          </div>


            		  <div class="col-md-4">
                      <label for="validationCustom01" class="form-label">Nom</label>
                        <input type="text" name="nom_patient" class="form-control" id="validationCustom01" >
                        <div class="valid-feedback">Données acceptées</div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Prénom</label>
                        <input type="text" name="prenom_patient" class="form-control" id="validationCustom02">
                        <div class="valid-feedback">Données acceptées</div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Email</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" name="email_patient" class="form-control" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend"/>
                          <div class="invalid-feedback">
                            Entrez l'email du patient.
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Adresse</label>
                        <input type="text" name="adresse" class="form-control" id="validationCustom03"/>
                        <div class="invalid-feedback">
                          Entrez l'adresse du patient.
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Groupe Sanguin</label>
                        <input type="text" name="gsang" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez le groupe sanguin du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Nationalité</label>
                        <input type="text" name="nationalite" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la nationnalité du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Situation matrimoniale</label>
                        <input type="text" name="smatrimonial" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la situation matrimoniale du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Date de naissance</label>
                        <input type="date" name="datenais" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la date de naissance du patient.
                        </div>
                      </div>

                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">
                          Valider
                        </button>
                        {{-- <a  class="btn btn-danger btn-pill" href="javascript:window.location.reload(history.go(-1))">Revenir à la sélection</a> --}}
                      </div>
                    </form>
                  </div>
                  {{-- Fin seconde partie du formulaire --}}
                </div>
              </div>
            </div>
            <!-- Row ends -->
          </div>
          <!-- App body ends -->

	@push('js')
    <script>
        new SlimSelect({
            select: '.form-select'
        })
    </script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js" crossorigin="anonymous"></script>



      <script>                                      
      var input = document.querySelector("#phone1");
      window.intlTelInput(input, {
        initialCountry: "BJ",
        separateDialCode: true,
        hiddenInput: "telephone",
        utilsScript: "intl/build/js/utils.js?1537727621611" // just for formatting/placeholders etc

      });

      var iti = window.intlTelInputGlobals.getInstance(input);

        input.addEventListener('input', function() {
          var fullNumber = iti.getNumber();
          document.getElementById('lnai').value = fullNumber;
        });



      </script>

      <script>                                      
      var inputt = document.querySelector("#phone2");
      window.intlTelInput(inputt, {
        initialCountry: "BJ",
        separateDialCode: true,
        hiddenInput: "telephone",
        utilsScript: "intl/build/js/utils.js?1537727621611" // just for formatting/placeholders etc

      });

      var itii = window.intlTelInputGlobals.getInstance(inputt);

        inputt.addEventListener('input', function() {
          var fullNumberr = itii.getNumber();
          document.getElementById('lnaii').value = fullNumberr;
        });



      </script>
@endpush         
<script type="text/javascript">
          function THEFUNCTION(i)
     {
          var enlever = document.getElementById('enlever');
          switch(i) {
              case 1 : enlever.style.display = ''; break;
              default: enlever.style.display = ''; break;
       
          }
      var enleverE = document.getElementById('enleverE');
          switch(i) {
              case 2 : enleverE.style.display = 'none'; break;
              default: enleverE.style.display = 'none'; break;
       
       
          }
      }
          function MYFUNCTION(i)
     {
          var enlever = document.getElementById('step2');
          switch(i) {
              case 1 : enlever.style.display = ''; break;
              default: enlever.style.display = ''; break;
       
          }
      var enleverE = document.getElementById('step2E');
          switch(i) {
              case 2 : enleverE.style.display = 'none'; break;
              default: enleverE.style.display = 'none'; break;
       
       
          }
      }
       document.getElementById('nextButton').addEventListener('click', function () {
    // Enregistrer les données de l'étape 1 via AJAX
    const formData = new FormData(document.getElementById('step1Form'));
    fetch("{{ url('/save-prisenc') }}", {
      method: "POST",
      body: formData,
    })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Passer à l'étape 2
          document.getElementById('step1').style.display = "none";
          document.getElementById('step2').style.display = "block";
        } else {
          alert("Une erreur est survenue : " + data.message);
        }
      })
      .catch(error => console.error('Error:', error));
  });
</script>
@endsection