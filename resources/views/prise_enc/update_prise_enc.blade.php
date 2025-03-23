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
                    <h5 class="card-title"> Mise à jour du dossier N°{{ $all_details->dossier_numero }} </h5>
                </div>

			    <div class="card-body" id="enleverE">
			       	
			    </div>



                  <div class="card-body" style="display:block; "id="enlever">
                    <form class="row g-3 needs-validation" action="{{ url('complements-information'.'/'.$all_details->patient_id) }}" method="POST">
            				{{csrf_field()}}
                    <input type="hidden" name="centre_id" value="{{$centre_id}}">
            		      <div class="col-md-2">
                        <label for="validationCustom05" class="form-label">Dossier N°</label>
                        <input type="text" name="dossier_numero" class="form-control" value="{{ $all_details->dossier_numero }}" id="validationCustom05" readonly />
                        
                      </div>
            		      <div class="col-md-3">
                        <label for="validationCustom05" class="form-label">Mal/Maux du patient<span class="text-danger">*</span></label>
                        <input type="text" name="maux" value="{{ $all_details->maux }}" class="form-control" id="validationCustom05" readonly />
                        
                      </div>
                       <div class="col-md-6">
                        <label for="validationCustom05" class="form-label">Observation<span class="text-danger">*</span></label>
                        <input type="text" name="observation" value="{{ $all_details->observation }}" class="form-control" id="validationCustom05" readonly/>
                        <div class="invalid-feedback">
                          Entrez des observations sur le patient.
                        </div>
                      </div>
                      @if($all_details->sexe_patient == "F")
                        <div class="col-md-6 col-sm-12 col-12">
		                <div class="card mb-3">
		                  <div class="card-body">
		                    <div class="form-check was-validated">
		                      <input type="radio" class="form-check-input" id="validationFormCheck3" name="sexe_patient"
		                        selected value="{{ $all_details->sexe_patient }}">
		                      <label class="form-check-label" for="validationFormCheck3">Féminin</label>
		                    </div>
		                  </div>
		                </div>
		              </div>
                      @else
                        
		              <div class="col-md-6 col-sm-12 col-12">
		                <div class="card mb-3">
		                  <div class="card-body">
		                    <div class="form-check was-validated">
		                      <input type="radio" class="form-check-input" id="validationFormCheck4" name="sexe_patient" selected value="{{ $all_details->sexe_patient }}">
		                      <label class="form-check-label" for="validationFormCheck4">Masculin</label>
		                    </div>
		                  </div>
		                </div>
		              </div>
                      @endif
                     

		              
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Température<span class="text-danger">*</span></label>
                        <input type="number" min="27" name="temp" value="{{ $all_details->temp }}" class="form-control" id="validationCustom05" required />
                        <div class="invalid-feedback">
                          Entrez la température.
                        </div>
                      </div>

                     
        {{-- <div class="row g-3 needs-validation"> --}}
          <div class="col-md-4">
            <label for="phone1">Télephone du patient<span class="text-danger">*</span></label><br>
            <input type="tel" class="form-control" placeholder="Contact Whatsapp/Appel" name="telephone" id="phone1" value="{{ $all_details->telephone }}" required/>
            
          </div>

          <div class="col-md-4">
            <label for="lnaii">Personne à contacter<span class="text-danger">*</span></label><br>
            <input type="tel" class="form-control" placeholder="Personne à contacter en cas d'urgence" id="phone2" name="contact_urgence" value="{{ $all_details->contact_urgence }}" required />
            
          </div>
        {{-- </div> --}}


			          <div class="col-md-4 form-group">
			            <label for="phone1">Nip<span class="text-danger">*</span></label><br>
			            <input type="tel" class="form-control" placeholder="Cip" name="nip" value="{{ $all_details->nip }}" required />
			            
			          </div>


            		  <div class="col-md-4">
                      <label for="validationCustom01" class="form-label">Nom du patient<span class="text-danger">*</span></label>
                        <input type="text" name="nom_patient" class="form-control" id="validationCustom01" value="{{ $all_details->prenom_patient }}" required/>
                        <div class="valid-feedback">Valide!</div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label">Prénom du patient<span class="text-danger">*</span></label>
                        <input type="text" name="prenom_patient" class="form-control" id="validationCustom02" value="{{ $all_details->prenom_patient }}" required/>
                        <div class="valid-feedback">Valide!</div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label">Email du patient</label>
                        <div class="input-group has-validation">
                          <span class="input-group-text" id="inputGroupPrepend">@</span>
                          <input type="text" name="email_patient" value="{{ $all_details->email_patient}}" class="form-control" id="validationCustomUsername"
                            aria-describedby="inputGroupPrepend"/>
                          <div class="invalid-feedback">
                            Entrez l'email du patient.
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label">Adresse<span class="text-danger">*</span></label>
                        <input type="text" name="adresse" value="{{ $all_details->adresse}}" class="form-control" id="validationCustom03"/>
                        <div class="invalid-feedback">
                          Entrez l'adresse du patient.
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Groupe Sanguin</label>
                        <input type="text" name="gsang" value="{{ $all_details->gsang }}" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez le groupe sanguin du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Nationalité<span class="text-danger">*</span></label>
                        <input type="text" name="nationalite" value="{{ $all_details->nationalite }}" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la nationnalité du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Situation matrimoniale<span class="text-danger">*</span></label>
                        <input type="text" name="smatrimonial" value="{{ $all_details->smatrimonial}}" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la situation matrimoniale du patient.
                        </div>
                      </div>

                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label">Date de naissance<span class="text-danger">*</span></label>
                        <input type="date" name="datenais" value="{{ $all_details->datenais }}" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la date de naissance du patient.
                        </div>
                      </div>


                     

		              <!--  <div class="col-12">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required />
                          <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                          </label>
                          <div class="invalid-feedback">
                            You must agree before submitting.
                          </div>
                        </div>
                      </div> -->

                      <div class="col-12">
                        <button class="btn btn-primary" type="submit">
                         Valider la mise jour
                        </button>
                        <a  class="btn btn-danger btn-pill" href="{{ URL::to('prises-en-charges') }}">Annuler la mise à jour</a>
                      </div>
                    </form>
                  </div>
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
        hiddenInput: "",
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
        hiddenInput: "",
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
</script>
@endsection