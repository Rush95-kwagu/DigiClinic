@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
 $personnel_id = Session::get('personnel_id');
?>

          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Analyses - Externes</h5>
                </div>

			    <div class="card-body" id="enleverE">
			       	<form class="row" action="{{ url('/save-demande-externe') }}" method="POST">
			            {{csrf_field()}}
              <input type="hidden" name="centre_id" value="{{$centre_id}}">
              <input type="hidden" name="user_id" value="{{$user_id}}">
              {{-- <input type="hidden" name="personnel_id" value="{{$personnel_id}}"> --}}
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

					 <div class="col-md-12 mb-3">
							<label class="classItems" for="selectError1">Service traitant</label>
							<div class="controls col-12">
                <select class="form-control form-select" name="services_id" id="validationCustomUsername">
                  <option value="0">Selectionner le service</option>
                  <?php
                  $all_services=DB::table('services')
                              ->where('centre_id', $centre_id)
                              ->orderBy('services_id','ASC')
                              ->get();
                  foreach ($all_services as $v_service){ ?>
                  <option value="{{$v_service->services_id}}">{{$v_service->service}}</option>
                  <?php } ?>
                  
                </select>
                         
                          </div>
					</div> 

       
				<div class="col-md-10 mb-3">
			      <button type="submit" class="btn btn-success btn-pill col-md-4">
			            Enregistrer 
			      </button> 
			    </div>      
			    </form>
			    <br>
			    <a class="btn btn-warning btn-pill" href="#" onClick="THEFUNCTION(this.selectedIndex);">Nouveau Patient</a>
			    </div>

                  <div class="card-body" style="display:none; "id="enlever">
			    <div class="card-body" id="step2E">
          
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('save.demandeExt') }}">
            				{{csrf_field()}}
                    <input type="hidden" name="centre_id" value="{{$centre_id}}">
                    {{-- <input type="hidden" name="user_id" value="{{$user_id}}"> --}}
                        <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">N°de dossier</label>
                        <input type="text" name="dossier_numero" class="form-control" id="validationCustom05" readonly />
                       
                      </div>
                      <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Mal/Maux du patient <span style="color: red">*</span></label>
                        <select class="form-control form-select" name="services_id" id="validationCustomUsername">
                          <option value="0">Selectionner le service</option>
                          <?php
                          $all_services=DB::table('services')
                                          ->orderBy('services_id','ASC')
                                          ->get();
                          foreach ($all_services as $v_service){ ?>
                          <option value="{{$v_service->services_id}}">{{$v_service->service}}</option>
                          <?php } ?>
                          
        
                        </select>
                      </div>
                      <div class="col-md-3">
                        <label for="validationCustom01" class="form-label">Nom <span style="color: red">*</span></label>
                          <input type="text" name="nom_patient" class="form-control" id="validationCustom01" required>
                          <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-3">
                          <label for="validationCustom02" class="form-label">Prénom <span style="color: red">*</span></label>
                          <input type="text" name="prenom_patient" class="form-control" id="validationCustom02" required>
                          <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-3">
                          <label for="phone1" class="form-label">N° Téléphone</label>
                          <input type="tel" name="telephone" class="form-control" id="validationCustom02">
                          <div class="valid-feedback"></div>
                        </div>
                        <div class="col-md-3">
                          <label for="country" class="form-label">Nationalité</label>
                          <select class="form-control form-select" name="nationalite" id="nationalite">
                           
                            <option value="beninoise">Béninoise</option>
                            <option value="afghane">Afghane</option>
                            <option value="sud-africaine">Sud-Africaine</option>
                            <option value="albanaise">Albanaise</option>
                            <option value="algerienne">Algérienne</option>
                            <option value="allemande">Allemande</option>
                            <option value="americaine">Américaine</option>
                            <option value="andorrane">Andorrane</option>
                            <option value="angolaise">Angolaise</option>
                            <option value="antiguaise-et-barbudienne">Antiguaise-et-Barbudienne</option>
                            <option value="saoudienne">Saoudienne</option>
                            <option value="argentine">Argentine</option>
                            <option value="armenienne">Arménienne</option>
                            <option value="australienne">Australienne</option>
                            <option value="autrichienne">Autrichienne</option>
                            <option value="azerbaïdjanaise">Azerbaïdjanaise</option>
                            <option value="bahamienne">Bahamienne</option>
                            <option value="bahreinienne">Bahreïnienne</option>
                            <option value="bangladaise">Bangladaise</option>
                            <option value="barbadienne">Barbadienne</option>
                            <option value="belge">Belge</option>
                            <option value="belizienne">Bélizienne</option>
                            <option value="bermudienne">Bermudienne</option>
                            <option value="bhoutanaise">Bhoutanaise</option>
                            <option value="bielorusse">Biélorusse</option>
                            <option value="birmane">Birmane</option>
                            <option value="bolivienne">Bolivienne</option>
                            <option value="bosnienne">Bosnienne</option>
                            <option value="botswanaise">Botswanaise</option>
                            <option value="brazilienne">Brésilienne</option>
                            <option value="britannique">Britannique</option>
                            <option value="bulgare">Bulgare</option>
                            <option value="burkinabe">Burkinabé</option>
                            <option value="burundaise">Burundaise</option>
                            <option value="cambodgienne">Cambodgienne</option>
                            <option value="camerounaise">Camerounaise</option>
                            <option value="canadienne">Canadienne</option>
                            <option value="cap-verdienne">Cap-Verdienne</option>
                            <option value="centrafricaine">Centrafricaine</option>
                            <option value="chilienne">Chilienne</option>
                            <option value="chinoise">Chinoise</option>
                            <option value="chypriote">Chypriote</option>
                            <option value="colombienne">Colombienne</option>
                            <option value="comorienne">Comorienne</option>
                            <option value="congolaise">Congolaise</option>
                            <option value="costaricaine">Costaricaine</option>
                            <option value="croate">Croate</option>
                            <option value="cubaine">Cubaine</option>
                            <option value="danoise">Danoise</option>
                            <option value="djiboutienne">Djiboutienne</option>
                            <option value="dominicaine">Dominicaine</option>
                            <option value="egyptienne">Égyptienne</option>
                            <option value="emirienne">Émirienne</option>
                            <option value="equatorienne">Équatorienne</option>
                            <option value="espagnole">Espagnole</option>
                            <option value="est-timoraise">Est-Timoraise</option>
                            <option value="estonienne">Estonienne</option>
                            <option value="etats-unienne">États-Unienne</option>
                            <option value="ethiopienne">Éthiopienne</option>
                            <option value="fidjienne">Fidjienne</option>
                            <option value="finlandaise">Finlandaise</option>
                            <option value="française">Française</option>
                        </select>
                        
                          
                        </div>
            		     

                      
                      <div class="col-md-4 form-group">
                        <label for="phone1">N° Pièce ID</label><br>
                        <input type="tel" class="form-control" placeholder="Cip" name="nip">
                        
                      </div>
                      <div class="col-md-2">
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
		              <div class="col-md-2">
		                <div class="card mb-3">
		                  <div class="card-body">
		                    <div class="form-check was-validated">
		                      <input type="radio" class="form-check-input" id="validationFormCheck4" name="sexe_patient" value="M">
		                      <label class="form-check-label" for="validationFormCheck4">Masculin</label>
		                    </div>
		                  </div>
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
                        <button class="btn btn-primary" name="save" type="submit">
                          Enregistrer
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