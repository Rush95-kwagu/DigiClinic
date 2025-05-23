<div class="modal fade" id="constantesModal" tabindex="-1" aria-labelledby="constantesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="constantesModalLabel">Gestion des constantes <br><span style="color: rgb(6, 156, 243)"><u>Nom</u></span>  : {{ $patient->nom_patient }};   <span style="color: rgb(6, 156, 243)"><u>Prénoms</u></span> : {{ $patient->prenom_patient }} <br><span style="color: rgb(6, 156, 243)"><u> Âge</u></span> : {{ $patient->age_formatted }}   <span style="color: rgb(6, 156, 243)"><u>Sexe </u></span> {{ $patient->sexe_patient }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form id="constantesForm">
                  @csrf
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <input type="hidden" name="id_prise_en_charge" value="{{ $patient->id_prise_en_charge ?? '' }}">
                          <input type="hidden" name="patient_id" value="{{ $patient->patient_id ?? '' }}">
                          <input type="hidden" name="centre_id" value="{{ $centre_id }}">
                          <input type="hidden" name="id_consultation" value="{{ $id_consultation }}">

                          <label class="classItems" for="selectError1"><b>Constantes</b><span style="color: red">*</span></label>
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
                      
                      <div class="col-md-3 mb-3">
                          <label class="classItems" for="selectError1"><b>Valeur</b><span style="color: red">*</span></label>
                          <div class="controls col-12">
                              <input type="text" name="valeur" class="form-control" id="valeur-constante" placeholder="Valeur">
                          </div>
                      </div>
                      
                      <div class="col-md-3 mb-3">
                          <label class="classItems" for="selectError1"><b>Unité</b><span style="color: red">*</span></label>
                          <div class="controls col-12">
                              <input type="text" name="unite" class="form-control" id="unite-constante" placeholder="Unité" readonly>
                          </div>
                      </div>
                      
                      <div class="col-md-2 mb-3 d-flex align-items-end">
                          <button type="button" class="btn btn-primary" id="add-constante">Ajouter</button>
                      </div>
                  </div>
                  
                  <div class="table-responsive">
                      <table class="table">
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
                  
                  <input type="hidden" id="constante-count" name="constante_count" value="0">
              </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
              <button type="button" class="btn btn-success" id="save-constantes">Enregistrer</button>
          </div>
      </div>
  </div>
</div>
@php
    $form_action = route('hospitalisation.saveTraitement', [
        'id_consultation' => $id_consultation,
        'patient_id' => $patient->patient_id
    ]);
@endphp
<div class="modal fade" id="constantesModal2" tabindex="-1" aria-labelledby="constantesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="constantesModalLabel">Gestion des constantes <br><span style="color: rgb(6, 156, 243)"><u>Nom</u></span>  : {{ $patient->nom_patient }};   <span style="color: rgb(6, 156, 243)"><u>Prénoms</u></span> : {{ $patient->prenom_patient }} <br><span style="color: rgb(6, 156, 243)"><u> Âge</u></span> : {{ $patient->age_formatted }}   <span style="color: rgb(6, 156, 243)"><u>Sexe </u></span> {{ $patient->sexe_patient }}</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
              <form action="{{ $form_action }}" method="POST">
                    @csrf

                    <input type="hidden" name="id_prise_en_charge" value="{{ $patient->id_prise_en_charge ?? '' }}">
                    <input type="hidden" name="patient_id" value="{{ $patient->patient_id ?? '' }}">
                    <input type="hidden" name="id_consultation" value="{{ $patient->id_consultation ?? '' }}">
                    <input type="hidden" name="centre_id" value="{{ $centre_id ?? '' }}">

                    <div class="col-auto">
                        <label class="classItems"><b>Soins appliqués</b></label>
                        <div class="controls col-12" style="height: 200px;">
                            <textarea name="libelle_soins" rows="4" class="form-control" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-success" id="save-constantes">Enregistrer</button>
                    </div>
                </form>

          </div>
      </div>
  </div>
</div>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
    const quill = new Quill('#editor', {
        theme: 'snow'
    });     
    
    quill.on('text-change', function() {
        document.getElementById('soin_appk').value = quill.root.innerHTML;
    });
</script>