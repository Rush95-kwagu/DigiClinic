@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
?>
<style>
  .table th, .table td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: left;
    }
    .table th {
      background-color: #f0f0f0;
      }
      h3{
        text-align:center; 
        background-color:rgb(39, 103, 242); 
        color:white; border-radius:5%
      }
</style>
          {{-- <div class="app-body"> --}}

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title">Consultations - Enregistrer des prises en charge de patients</h5>
                </div>

			             <div class="card-body" id="enleverE">
			
                 <div class="card-body" style="display:block; "id="step2">
                    <form class="row g-3 needs-validation" id="step2Form" method="POST" action="{{ route('save.step2') }}">
            				{{csrf_field()}}
                    <input type="hidden" name="centre_id" value="{{$centre_id}}">
                    <h3>Relever les constantes</h3>
                    <div class="col-md-3 mb-3">

                      <label class="classItems" for="selectError1"> <b>Constantes</b><span style="color: red">*</span></label>
                      <div class="controls col-12">
                        <select class="form-control form-select" name="constantes" id="constante-select">
                          <option value="" selected>Sélectionner une constante</option>
                          <option value="TENSION ARTERIELLE">Tension Artérielle</option>
                          <option value="FREQUENCE CARDIAQUE">Fréquence Cardiaque</option>
                          <option value="FREQUENCE RESPIRATOIRE">Fréquence Respiratoire</option>
                          <option value="TEMPERATURE">Température</option>
                          <option value="SATURATION O2">Saturation O2</option>
                          <option value="GLYCEMIE CAPILLAIRE">Glycémie Capillaire</option>
                          <option value="GLYCEMIE A JEUN">Glycémie à Jeun</option>
                          <option value="GLYCEMIE POST PRANDIALE">Glycémie Post Prandiale</option>
                          <option value="POIDS">Poids</option>
                          <option value="TAILLE">Taille</option>
                        </select>
                      </div>
                  </div> 
                  <div class="col-md-2 mb-3">
                      <label class="classItems" for="selectError1"> <b>Valeur</b><span style="color: red">*</span></label>
                      <div class="controls col-12">
                        <input type="text" name="valeur" class="form-control" id="valeur-constante" placeholder="Valeur">
                      </div>
                  </div> 
                  <div class="col-md-2 mb-3">
                      <label class="classItems" for="selectError1"> <b>Unité </b><span style="color: red">*</span></label>
                      <div class="controls col-12">
                    <input type="text" name="unite" class="form-control" id="unite-constante" placeholder="Unité" readonly>
        
                      </div>
                  </div> 
                  <div class="col-md-3 mb-3">
                    
                      <label class="classItems" for="selectError1">  </label>
                      <div class="input-group-append">
                        <button type="button" class="btn btn-primary" id="add-constante">Ajouter la constante</button>
                    
                      </div>
                  </div> 
                  <div class="table-responsive">
                    <table class="table ">
                      <thead>
                          <tr>
                              <th>Constante</th>
                              <th>Valeur</th>
                              <th>Unité</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody id="constantes-container">
                          <!-- Les constantes ajoutées apparaîtront ici -->
                      </tbody>
                  </table>
                  </div> 
                  <br>
                  <br>
                    <h3>Etat civil</h3>
               <div class="col-md-4 form-group">
			            <label for="phone1"><b>Nip / N°Pièce d'identité</b><span style="color: red">*</span></label><br>
			            <input type="tel" class="form-control" placeholder="Cip" name="nip">
			            
			          </div>
            		  <div class="col-md-4">
                      <label for="validationCustom01" class="form-label"><b>Nom</b><span style="color: red">*</span></label>
                        <input type="text" name="nom_patient" class="form-control" id="validationCustom01" >
                        <div class="valid-feedback">Données acceptées</div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom02" class="form-label"><b>Prénom</b><span style="color: red">*</span></label>
                        <input type="text" name="prenom_patient" class="form-control" id="validationCustom02">
                        <div class="valid-feedback">Données acceptées</div>
                      </div>
                      <div class="col-md-4">
                        {{-- <label for="phone1"><b>Télephone du patient</b><span style="color: red">*</span></label><br>
                         <input type="tel" class="form-control" type="tel" placeholder="Contact Whatsapp/Appel" id="phone1" name="mobile_number">
                         <input type="hidden" id='lnai' name="telephone"> --}}
                         <label for="phone1">Télephone du patient</label><br>
                         <input type="tel" class="form-control" type="tel" placeholder="Contact Whatsapp/Appel" id="phone1" name="mobile_number" required="" />
                         <input type="hidden" id='lnai' name="telephone">
                   </div>
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label"><b>Date de naissance</b><span style="color:red">*</span></label>
                        <input type="date" name="datenais" class="form-control" id="validationCustom05"/>
                        <div class="invalid-feedback">
                          Entrez la date de naissance du patient.
                        </div>
                      </div>
                      
                   <div class="col-md-4">
                    <label for="validationCustom05" class="form-label"><b>Nationalité</b> <span style="color: red">*</span></label>
                    {{-- <input type="text" name="nationalite" class="form-control" id="validationCustom05"/> --}}
                    <select name="nationalite" id="" class="form-control">
                      <option value="">Sélectionner la nationalité</option>
                      <option value="N/A">N/A</option>
                      <option value="Béninoise">Béninoise</option>
                      <option value="Burkinabé">Burkinabé</option>
                      <option value="Camerounaise">Camerounaise</option>
                      <option value="Ivoirienne">Ivoirienne</option>
                      <option value="Ghanéenne">Ghanaenne</option>
                      <option value="Guinéenne">Guinéenne</option>
                      <option value="Malienne">Malienne</option>
                      <option value="Nigerienne">Nigerienne</option>
                      <option value="Nigeriane">Nigeriane</option>
                      <option value="Koweïtienne">Kowetienne</option>
                      <option value="Togolaise">Togolaise</option>
                    </select>
                    <div class="invalid-feedback">
                      Entrez la nationnalité du patient.
                    </div>
                  </div>
                  <div class="col-md-4">
                    <label for="validationCustomUsername" class="form-label"><b>Profession</b> <span style="color: red"></span></label>
                    <div class="input-group has-validation">
                      <input type="text" name="profession" class="form-control" id="validationCustomUsername"/>
                    </div>
                  </div>
                  
                      <div class="col-md-4">
                        <label for="validationCustomUsername" class="form-label"><b>Email</b></label>
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
                        <label for="validationCustom03" class="form-label"><b>Adresse de résidence</b></label>
                        <input type="text" name="adresse" class="form-control" id="validationCustom03"/>
                        <div class="invalid-feedback">
                          Entrez l'adresse du patient.
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label"><b>Groupe Sanguin</b></label>
                        {{-- <input type="text" name="gsang" class="form-control" id="validationCustom05"/> --}}
                        <select class="form-control" name="gsang" id="validationCustom05">
                          <option value="">Sélectionner le groupe sanguin</option>
                          <option value="N/A">N/A</option>
                          <option value="A+">A+</option>
                          <option value="A-">A-</option>
                          <option value="B+">B+</option>
                          <option value="B-">B-</option>
                          <option value="AB+">AB+</option>
                          <option value="AB-">AB-</option>
                          <option value="O+">O+</option>
                          <option value="O-">O-</option>
                        </select>
                        <div class="invalid-feedback">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label"><b>Situation matrimoniale</b></label>
                        {{-- <input type="text" name="smatrimonial" class="form-control" id="validationCustom05"/> --}}
                        <select name="smatrimonial" id="" class="form-control">
                          <option value="">Sélectionner la situation matrimoniale</option>
                          <option value="N/A">N/A</option>
                          <option value="Célibataire">Célibataire</option>
                          <option value="Marié(e)">Marié(e)</option>
                          <option value="Divorcé(e)">Divorcé(e)</option>
                          <option value="Veuf(ve)">Veuf(ve)</option>
                          <option value="Séparé(e)">Séparé(e)</option>
                        </select>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom03" class="form-label"><b>Réligion</b></label>
                        <input type="text" name="religion" class="form-control" id="validationCustom03"/>
                      </div>
                      
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label"><b>Ethnie</b></label>
                        <input type="text" name="ethnie" class="form-control" id="validationCustom05"/>
                      </div>
                      <div class="col-md-4">
                        <label for="validationCustom05" class="form-label"><b>Electrophorèse HB</b></label>
                        <input type="text" name="electrophorese_Hb" class="form-control" id="validationCustom05"/>
                      </div> <br>
                      <br>
                        <h3>Personne à contacter en cas d'urgence</h3>
                        <div class="col-md-4">
                          <label for="validationCustom01" class="form-label"><b>Nom</b><span style="color: red">*</span></label>
                            <input type="text" name="nom_contact_urgence" class="form-control" id="validationCustom01" >
                            <div class="valid-feedback">Données acceptées</div>
                          </div>
                          <div class="col-md-4">
                            <label for="validationCustom02" class="form-label"><b>Prénom</b><span style="color: red">*</span></label>
                            <input type="text" name="prenom_contact_urgence" class="form-control" id="validationCustom02">
                            <div class="valid-feedback">Données acceptées</div>
                          </div>
                        <div class="col-md-4">
                          <label for="lnaii"><b>Personne à contacter</b><span style="color: red">*</span></label><br>
                          <input type="tel" class="form-control" type="tel" placeholder="Personne à contacter en cas d'urgence" id="phone2" name="mobile_number" required="" />
                          <input type="hidden" id='lnaii' name="contact_urgence">
                        </div>
                        <div class="col-md-4">
                          <label for="validationCustom02" class="form-label"><b>Liens</b>
                          <input type="text" name="lien_contact_urgence" class="form-control" id="validationCustom02">
                          
                        </div>
                  <input type="hidden" id="constante-count" name="constante_count" value="0">
                      <button class="btn btn-primary" type="submit">
                        Enregistrer les données
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
@push('js')
    <script src="{{ asset('frontend/js/constantes.js') }}"></script>
@endpush
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection