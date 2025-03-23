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
			       	<form class="row" action="{{ url('/save-prisenc') }}" method="POST">
			            {{csrf_field()}}
              <input type="hidden" name="centre_id" value="{{$centre_id}}">
			        <div class="col-md-12 mb-3">
							<label class="classItems" for="selectError1"> Patients </label>
							<div class="controls col-12">
							<select class="form-control form-select" id="patient_id" name="patient_id" data-target="#service" data-source="get-detail/id">
					  	<?php 
              $all_patients=DB::table('tbl_patient')
                ->orderBy('patient_id','ASC')  
                ->get(); 
              foreach ($all_patients as $v_patient){ ?>  
							<option value="{{$v_patient->patient_id}}">{{$v_patient->prenom_patient}} {{$v_patient->nom_patient}} -- {{$v_patient->nip}} -- {{$v_patient->telephone}}</option>
					 	<?php } ?>
							  </select>
							</div>
					</div> 

					 <div class="col-md-4 mb-3">
							<label class="classItems" for="selectError1"> Mal/Maux du patient </label>
							<div class="controls col-12">
                          <input type="text" name="maux" class="form-control" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend" required />
                          </div>
					</div> 

          <div class="col-md-2 mb-3">
              <label class="classItems" for="selectError1"> Température </label>
              <div class="controls col-12">
                          <input type="number" min="27" name="temp" class="form-control" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend" required />
                          </div>
          </div> 

					<div class="col-md-6 mb-3">
							<label class="classItems" for="selectError1"> Observation </label>
							<div class="controls col-12">
                          <input type="text" name="observation" value="Néant" class="form-control" id="validationCustom05" required />
                          </div>
					</div> 
				<div class="col-md-10 mb-3">
			      <button type="submit" class="btn btn-success btn-pill col-md-4">
			            Poursuivre 
			      </button> 
			    </div>      
			    </form>
			    <br>
			    <a class="btn btn-warning btn-pill" href="#" onClick="THEFUNCTION(this.selectedIndex);">Nouveau Patient</a>
			    </div>

                  <div class="card-body" style="display:none; "id="enlever">
			    <div class="card-body" id="step2E">
          
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('save.step1') }}">
            				{{csrf_field()}}
                    <input type="hidden" name="centre_id" value="{{$centre_id}}">
                    <div></div>
            		      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">N°de dossier</label>
                        <input type="text" name="dossier_numero" class="form-control" id="validationCustom05" readonly />
                       
                      </div>
            		      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Mal/Maux du patient*</label>
                        <input type="text" name="maux" class="form-control" id="validationCustom05" required />
                        <div class="invalid-feedback">
                          Entrez les maux du patient.
                        </div>
                      </div>

                      <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Observation</label>
                        <input type="text" name="observation" value="Néant" class="form-control" id="validationCustom05" required />
                        <div class="invalid-feedback">
                          Entrez des observations sur le patient.
                        </div>
                      </div>
                      <div class="col-md-6 col-sm-12 col-12">
		                <div class="card mb-3">
		                  <div class="card-body">
		                    <div class="form-check was-validated">
		                      <input type="radio" class="form-check-input" id="validationFormCheck3" name="sexe_patient"
		                        required="" value="F">
		                      <label class="form-check-label" for="validationFormCheck3">Féminin</label>
		                    </div>
		                  </div>
		                </div>
		              </div>
		              <div class="col-md-6 col-sm-12 col-12">
		                <div class="card mb-3">
		                  <div class="card-body">
		                    <div class="form-check was-validated">
		                      <input type="radio" class="form-check-input" id="validationFormCheck4" name="sexe_patient" value="M">
		                      <label class="form-check-label" for="validationFormCheck4">Masculin</label>
		                    </div>
		                  </div>
		                </div>
		              </div>
                      
       
                      <div class="col-12">
                        <button class="btn btn-primary" name="save" type="submit">
                          Enregistrer
                        </button>
                        <button class="btn btn-secondary" name="next" type="submit">
                          Compléter les informations
                        </button>
			                   {{-- <a class="btn btn-warning btn-pill" id="nextButton" href="#" onClick="MYFUNCTION(this.selectedIndex);">Complément d'informations</a> --}}

                        <a  class="btn btn-danger btn-pill" href="javascript:window.location.reload(history.go(-1))">Revenir à la sélection</a>
                      </div>
                    </form>
                  </div>
                  {{-- Début seconde partie du formulaire --}}
                   <div class="card-body" style="display:none; "id="step2">
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
                        <input type="text" name="nom_patient" class="form-control" id="validationCustom01" value="Mark"/>
                        <div class="valid-feedback"></div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Prénom</label>
                        <input type="text" name="prenom_patient" class="form-control" id="validationCustom02" value="Otto"/>
                        <div class="valid-feedback"></div>
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
                        <a  class="btn btn-danger btn-pill" href="javascript:window.location.reload(history.go(-1))">Revenir à la sélection</a>
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