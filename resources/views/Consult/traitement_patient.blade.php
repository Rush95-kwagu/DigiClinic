@extends('layout')
@section('admin_content')
<style>
        .editor-container {
            margin-bottom: 200px;
        }
        .editor-title {
            font-weight: bold;
            margin-bottom: 25px;
        }
    </style>

@php
    $user_role_id = Session::get('user_role_id');
    $user_id = Session::get('user_id');
    $centre_id = Session::get('centre_id');
    $patient = $all_details->first() ?? null;
@endphp

<!-- App body starts -->
<div class="app-body">
    @if(!$patient)
        <div class="alert alert-danger m-3">Aucune donnée patient disponible</div>
    @else
        <!-- Row starts -->
            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="d-flex ">
                      <!-- Stats starts -->
                      <div class="d-flex align-items-center flex-wrap gap-4">
                        <div class="d-flex align-items-center">
                          
                          <div class="icon-box lg bg-primary rounded-5 me-2">
                            <i class="ri-account-circle-line fs-3"></i>
                          </div>
                          
                          <div>
                            <h4 class="mb-1">{{ $patient->nom_patient}} {{ $patient->prenom_patient }}</h4>
                            <p class="m-0">Nom du patient</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg bg-success rounded-5 me-2">
                            <i class="ri-women-line fs-3"></i>
                          </div>
                          <div>
                            <h4 class="mb-1">{{ $patient->sexe_patient }}</h4>
                            <p class="m-0">Sexe</p>
                          </div>
                        </div>
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg bg-primary rounded-5 me-2">
                            <i class="ri-arrow-right-up-line fs-3"></i>
                          </div>
                          <div>
                            <h4 class="mb-1">{{ $patient->age_formatted }}</h4>
                              <p class="m-0">Âge du patient </p>
                           
                          </div>
                        </div>
                        @if($patient->gsang)

                        <div class="d-flex align-items-center">
                          <div class="icon-box lg bg-danger rounded-5 me-2">
                            <i class="ri-contrast-drop-2-line fs-3"></i>
                          </div>
                            <div>
                              <h4 class="mb-1">{{ $patient->gsang }}</h4>
                              <p class="m-0">Groupe sanguin</p>
                            </div>
                          </div>
                        @endif
                        <div class="d-flex align-items-center">
                          <div class="icon-box lg bg-danger rounded-5 me-2">
                            <i class="ri-stethoscope-line fs-3 text-body"></i>
                          </div>
                          <div>
                            <h4 class="mb-1">{{ $patient->maux }}</h4>
                            <p class="m-0">Motif d'admission</p>
                          </div>
                          <div>
                        </div>
                        
                    </div>
                    <button type="button" class="btn btn-light float-right" data-bs-toggle="modal" data-bs-target="#presc">
                         Délivrer une ordonnance
                     </button>
                      </div>
                      <!-- Stats ends -->
                      @if($patient->sexe_patient == 'F')
                        <img src="{{asset ('frontend/F.png') }}" class="img-7x rounded-circle ms-auto"
                        alt="Patient Admin Template">
                      @else
                         <img src="{{asset ('frontend/F.png') }}" class="img-7x rounded-circle ms-auto"
                        alt="Patient Admin Template">
                      @endif
                      
                    </div>
                </div>
                
            </div>
        </div>
    </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row gx-3">
             <div class="card-header">
              <h5 class="card-title" style="text-align: center">Constantes relevées</h5> 
            
            
          </div>
          @if (!Empty($last_constance))
           
             @foreach ($last_constance as $type => $constantes)
              <div class="col-xxl-3 col-sm-4 col-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="icon-box md bg-info rounded-5 m-auto">
                        <i class="ri-stethoscope-line fs-3"></i>
                      </div>
                      <div class="mt-3">
                        <h5>{{ $type }}</h5>
                        <p class="m-0 opacity-50">3 dernières visites</p>
                      </div>
                    </div>

                    <ul class="list-group mt-3">
                      @foreach (collect($constantes)->take(3) as $constante)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                          <div>{{ Carbon::parse($constante->created_at)->translatedFormat('l d F \à H\hi') }}</div>
                          <div>{{ $constante->valeur }} {{ $constante->unite }}</div>
                        </li>
                      @endforeach
                    </ul>

                  </div>
                </div>
              </div>
            @endforeach
            @else
             <span class="text-muted">Aucune constante disponible</span>
            
            @endif
          </div>
                    
                    <div class="card-body">
                        <div class="custom-tabs-container">
                            <ul class="nav nav-tabs justify-content-end" id="customTab5" role="tablist">
                                @if ($user_role_id != 0 && $user_role_id != 1 && $user_role_id != 10)
                                    @if($patient->etat_hospitalisation == 0)
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="tab-oneAAAA" data-bs-toggle="tab" href="#oneAAAA" role="tab"
                                                aria-controls="oneAAAA" aria-selected="true">
                                                <span class="badge bg-primary">Prise en charge</span>
                                            </a>
                                        </li>
                                    @endif
                                @endif
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link @if($patient->etat_hospitalisation != 0 || $user_role_id == 0 || $user_role_id == 1 || $user_role_id == 10) active @endif" 
                                       id="tab-twoAAAA" data-bs-toggle="tab" href="#twoAAAA" role="tab"
                                       aria-controls="twoAAAA" aria-selected="false">
                                        <span class="badge bg-primary">Dossier Médical</span>
                                    </a>
                                </li>
                            </ul>
                            
                            <div class="tab-content" id="customTabContent">
                                @if($patient->etat_hospitalisation == 0 && $user_role_id != 0 && $user_role_id != 1 && $user_role_id != 10)
                                    <div class="tab-pane fade show active" id="oneAAAA" role="tabpanel">
                                        <div class="card-body">
                                            <div class="collapse" id="collapse-from-validation"></div>
                                            <form id="traitementForm" class="form-horizontal" method="post" action="{{ url('/save-traitement') }}" enctype="multipart/form-data">
                                                @csrf
                                                <input id="idc" type="hidden" name="id_consultation" value="{{ $id_consultation }}">
                                                <input id="idp" type="hidden" name="id_prise_en_charge" value="{{ $patient->id_prise_en_charge }}">
                                                <input id="idpa" type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
                                            
                                                <div class="form-row">
                                                    
                                                    <div class="col-md-6 mb-3">
                                                        <div class="editor-editor-container">
                                                        <div class="editor-title">Interrogatoire</div>
                                                        <textarea class="form-control" id="editor1" name="interrogatoire" required></textarea>
                                                    </div>
                                                    </div>
                                            
                                                    <div class="col-md-6 mb-3">
                                                          <div class="editor-editor-container">
                                                        <div class="editor-title">Examens physique</div>
                                                        <textarea class="form-control" id="editor2" name="observation" rows="8" required></textarea>
                                                    </div>
                                                    </div>
                                            
                                                    <div class="file col-md-6 mb-3">
                                                        <label class="control-label editor-title">Pièce jointe</label>
                                                        <input type="file" class="form-control" name="fichier_joint" accept="application/pdf">
                                                        <div class="text-success small mt-1">PDF supporté</div>
                                                    </div>
                                                    
                                            
                                                    <!-- Bloc décision (masqué si clôture) -->
                                                    {{-- <div class="analys col-md-6 mb-3">
                                                        <label class="control-label editor-title">Examens Paracliniques</label>
                                                        <select id="" class="form-select" name="examen">
                                                            <option value="" selected>Choisir une action</option>
                                                            
                                                            <optgroup label="Analyses médicales">
                                                                <option value="3">Analyse</option>
                                                                
                                                            </optgroup>
                                                            <optgroup label="Imagerie médicale">
                                                                <option value="4">Scanner</option>
                                                                <option value="5">Radio</option>
                                                                
                                                            </optgroup>
                                                        </select>
                                                    </div> --}}
                                                     <div class="diagnostic col-md-6 mb-3">
                                                          <div class="editor-editor-container">
                                                        <div class="editor-title">Diagnostics</div>
                                                        <textarea class="form-control" id="editor3" name="diagnostic" rows="8" required></textarea>
                                                    </div>
                                                    </div>
                                                     <div class="advise col-md-6 mb-3">
                                                          <div class="editor-editor-container">
                                                        <div class="editor-title">Conduites à tenir</div>
                                                        <textarea class="form-control" id="editor4" name="recommandation" rows="8" required></textarea>
                                                    </div>
                                                    </div>
                                                    <div class="affect col-md-12 mb-3">
                                                        <label class="control-label editor-title">Affecter</label>
                                                        <select id="decisionSelect" class="form-select" name="specialiste">
                                                            <option value="" selected>Envoyer vers</option>
                                                            <optgroup label="Hospitalisation">
                                                                <option value="0">Mise en Hospitalisation</option>
                                                            </optgroup>
                                                            <optgroup label="Observation">
                                                                <option value="2">Mise en observation</option>
                                                            </optgroup>
                                                            <optgroup label="Spécialistes">
                                                                @foreach($specialistes as $specialiste)
                                                                    <option value="{{ $specialiste->user_id }}">
                                                                        {{ $specialiste->qualification }}: {{ $specialiste->prenom }} {{ $specialiste->nom }}
                                                                    </option>
                                                                @endforeach
                                                            </optgroup>
                                                            
                                                        </select>
                                                    </div>
                                            
                                                    <!-- Bloc ordonnance (visible seulement si clôture) -->
                                                    <div class="ordo col-md-6 mb-3" style="display: none;">
                                                        <div class="editor-editor-container">
                                                            <label class="control-label editor-title">Ordonnance de fin de traitement</label>
                                                            <textarea class="form-control" rows="8" name="ordonnance" id="editor5" hidden></textarea>
                                                        </div>
                                                    </div>
                                            
                                                    <!-- Switch clôture -->
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="clotureSwitch" name="etat_traitement" value="1">
                                                        <label class="form-check-label" for="clotureSwitch">Clôturer le traitement</label>
                                                        <input type="hidden" name="etat_hospitalisation" id="etatHospitalisation" value="0">
                                                    </div>
                                                </div>
                                            
                                                <button type="submit" class="btn btn-primary btn-pill mr-2">Validation</button>
                                                <button type="reset" class="btn btn-light btn-pill">Annuler</button>
                                            </form>
                                        </div>
                                    </div>
                                @endif
                                
                                <div class="tab-pane fade @if($patient->etat_hospitalisation != 0 || $user_role_id == 0 || $user_role_id == 1 || $user_role_id == 10) show active @endif" 
                                     id="twoAAAA" role="tabpanel">
                                    <div class="row">
                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <h5 class="card-title">Parcours Médical</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="scroll350">
                                                        <div class="activity-feed">
                                                            @foreach($all_details as $v_detail)
                                                                @php
                                                                    $consults = DB::table('tbl_consultation')
                                                                        ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                                                                        ->join('users','tbl_consultation.user_id','=','users.user_id')              
                                                                        ->join('personnel','users.email','=','personnel.email')              
                                                                        ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                                                                        ->where('tbl_consultation.id_prise_en_charge', $v_detail->id_prise_en_charge ?? '')
                                                                        ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','users.*','personnel.*')
                                                                        ->orderBy('conslt_created_at','DESC')
                                                                        ->get();
                                                                @endphp
                                                                
                                                                @foreach($consults as $v_consult)
                                                                    <div class="col-sm-12">
                                                                        <div class="accordion mb-3" id="accordion{{ $v_consult->id_consultation }}">
                                                                            <div class="accordion-item">
                                                                                <h2 class="accordion-header" id="heading{{ $v_consult->id_consultation }}">
                                                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                                                            data-bs-target="#collapse{{ $v_consult->id_consultation }}" 
                                                                                            aria-expanded="false"
                                                                                            aria-controls="collapse{{ $v_consult->id_consultation }}">
                                                                                        <div class="d-flex flex-column">
                                                                                            <h5 class="m-0">
                                                                                                <strong>
                                                                                                    <em class="text-primary">
                                                                                                        <i class="ri-calendar-line"></i> 
                                                                                                        {{ $v_consult->conslt_created_at ?? '' }}
                                                                                                    </em>
                                                                                                </strong>
                                                                                            </h5>
                                                                                        </div>
                                                                                    </button>
                                                                                </h2>
                                                                                <div id="collapse{{ $v_consult->id_consultation }}" 
                                                                                     class="accordion-collapse collapse"
                                                                                     aria-labelledby="heading{{ $v_consult->id_consultation }}" 
                                                                                     data-bs-parent="#accordion{{ $v_consult->id_consultation }}">
                                                                                    <div class="accordion-body">
                                                                                        <p class="mb-3">
                                                                                            <code><strong> Dr. {{ $v_consult->prenom ?? '' }} {{ $v_consult->nom ?? '' }}</strong></code>
                                                                                        </p>

                                                                                        <p class="mb-3">
                                                                                            {!! $v_consult->diagnostic ?? '' !!}
                                                                                        </p>

                                                                                        @if(!empty($v_consult->observation))
                                                                                            <p class="mb-3">
                                                                                                <strong>{{ $v_consult->observation }}</strong>
                                                                                            </p>
                                                                                        @endif

                                                                                        @if(!empty($patient->new_temp))
                                                                                            <p class="mb-3">
                                                                                                <em>Température relevée : {{ $patient->new_temp }} °C</em>
                                                                                            </p>
                                                                                        @endif

                                                                                        <div class="d-flex gap-2">
                                                                                            @if(!empty($v_consult->fichier_joint))
                                                                                                <a href="{{ $v_consult->fichier_joint }}" class="btn btn-primary" download>
                                                                                                    Fichier joint
                                                                                                </a>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-sm-6">
                                            <div class="card mb-3">
                                                <div class="card-header">
                                                    <h5 class="card-title">Ordonnances Antérieures</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="scroll350">
                                                        <div class="activity-feed">
                                                            @foreach($all_details as $v_detail)
                                                                @if(!empty($v_detail->date_ordo))
                                                                    <div class="feed-item">
                                                                        <span class="feed-date pb-1" data-bs-toggle="tooltip" 
                                                                              data-bs-title="{{ \Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">
                                                                            {{ \Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}
                                                                            <span class="badge bg-danger">{{ $v_detail->maux ?? '' }}</span>
                                                                        </span>

                                                                        <div class="mb-1">
                                                                            @if(!empty($v_detail->id_ordo_traitement))
                                                                                <a href="{{ URL::to('ordonnance/'.$v_detail->id_ordo_traitement) }}">
                                                                                    <span class="text-primary">
                                                                                        {!! $v_detail->ordonnance_consultation ?? '' !!}
                                                                                    </span>
                                                                                </a>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

<!-- Modal Prescription -->
<div class="modal fade" id="presc" data-bs-backdrop="static" data-bs-keyboard="false"
     tabindex="-1" aria-labelledby="prescLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Ordonnance de soin du patient </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Annuler"></button>
            </div>
            <form action="{{ url('/make-ordonnance') }}" method="POST">
                @csrf
                <div class="modal-body">
                    Nom : 
                    <span class="badge bg-info">
                        {{ $patient->nom_patient ?? '' }}
                    </span> 
                    Prénom : 
                    <span class="badge bg-info">
                        {{ $patient->prenom_patient ?? '' }}
                    </span> 
                    Sexe : 
                    <span class="badge bg-info">
                        {{ $patient->sexe_patient }}
                    </span>
                    <br>
                    <input type="hidden" name="id_consultation" value="{{ $id_consultation }}">
                    <input type="hidden" name="id_prise_en_charge" value="{{ $patient->id_prise_en_charge ?? '' }}">

                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2"></label>
                        <br>
                        <div id="editor6" style="height: 200px;"></div>
                        <input type="hidden" name="ordonnance_consultation" id="ordonnance_consultation" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Fermer
                    </button>
                    <button type="submit" class="btn btn-primary">
                        Confirmer
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Constantes -->
<div class="modal fade" id="constantesModal" tabindex="-1" aria-labelledby="constantesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="constantesModalLabel">Gestion des constantes médicales</h5>
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

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

  <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 1 :', error);
            });

        ClassicEditor
            .create(document.querySelector('#editor2'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 2 :', error);
            });
        ClassicEditor
            .create(document.querySelector('#editor3'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 3 :', error);
            });
        ClassicEditor
            .create(document.querySelector('#editor4'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 4 :', error);
            });
        ClassicEditor
            .create(document.querySelector('#editor5'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 5 :', error);
            });
        ClassicEditor
            .create(document.querySelector('#editor6'))
            .catch(error => {
                console.error('Erreur sur l’éditeur 6 :', error);
            });

        document.getElementById('submitBtn').addEventListener('click', () => {
            const editor1Data = document.querySelector('#editor1').value;
            const editor2Data = document.querySelector('#editor2').value;
            const editor3Data = document.querySelector('#editor3').value;
            const editor4Data = document.querySelector('#editor4').value;
            const editor5Data = document.querySelector('#editor5').value;
            const editor6Data = document.querySelector('#editor6').value;
            
            document.getElementById('output').innerHTML = `
                <h3>Contenu de l’éditeur 1 :</h3>
                <div>${editor1Data}</div>
                <h3>Contenu de l’éditeur 2 :</h3>
                <div>${editor2Data}</div>
                <h3>Contenu de l’éditeur 3 :</h3>
                <div>${editor3Data}</div>
                <h3>Contenu de l’éditeur 4 :</h3>
                <div>${editor4Data}</div>
                <h3>Contenu de l’éditeur 5 :</h3>
                <div>${editor5Data}</div>
                <h3>Contenu de l’éditeur 6 :</h3>
                <div>${editor6Data}</div>
            `;
        });
  </script>
  <script>
        document.addEventListener('DOMContentLoaded', function() {
        
            const clotureSwitch = document.getElementById('clotureSwitch');
            const affectDiv     = document.querySelector('.affect');
            const ordoDiv       = document.querySelector('.ordo');
            const analysDiv     = document.querySelector('.analys');
            const adviseDiv     = document.querySelector('.advise');
            const diagnosticDiv = document.querySelector('.diagnostic');
            const fileDiv       = document.querySelector('.file')
            

            clotureSwitch.addEventListener('change', function() {
                if(this.checked) {
                    affectDiv.style.display     = 'none';
                    ordoDiv.style.display       = 'block';
                    analysDiv.style.display     ='none';
                    adviseDiv.style.display     ='block';
                    diagnosticDiv.style.display ='none';
                    fileDiv.style.display       ='none'
                    document.getElementById('etatHospitalisation').value = '1';
                } else {
                    affectDiv.style.display     = 'block';
                    ordoDiv.style.display       = 'none';
                    analysDiv.style.display     ='block';
                    adviseDiv.style.display     ='block';
                    diagnosticDiv.style.display ='block';
                    fileDiv.style.display       ='block'
                    document.getElementById('etatHospitalisation').value = '0';
                }
            });

            // Confirmation avant soumission
            document.getElementById('traitementForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const decision = clotureSwitch.checked ? 'cloture' : 
                                document.getElementById('decisionSelect').value;
                
                let confirmText, confirmTitle;
                
                switch(decision) {
                    case '0':
                        confirmTitle = "Confirmer l'hospitalisation";
                        confirmText = "Voulez-vous vraiment hospitaliser ce patient?";
                        break;
                    case '2':
                        confirmTitle = "Confirmer la mise en observation";
                        confirmText = "Voulez-vous vraiment mettre ce patient en observation?";
                        break;
                    case '3':
                        confirmTitle = "Confirmer l'envoie du patient pour analyse paraclinique";
                        confirmText = "Voulez-vous vraiment envoyer ce patient en examen ?";
                        break;
                    case 'cloture':
                        confirmTitle = "Confirmer la clôture";
                        confirmText = "Voulez-vous vraiment clôturer ce traitement?";
                        break;
                    default:
                        if(decision) { // Transfert spécialiste
                            const specialisteText = document.getElementById('decisionSelect')
                                .options[document.getElementById('decisionSelect').selectedIndex].text;
                            confirmTitle = "Confirmer le transfert";
                            confirmText = `Voulez-vous vraiment transférer ce patient à ${specialisteText}?`;
                        } else {
                            Swal.fire('Erreur', 'Veuillez sélectionner une action', 'error');
                            return;
                        }
                }

                Swal.fire({
                    title: confirmTitle,
                    text: confirmText,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Oui, confirmer',
                    cancelButtonText: 'Annuler'
                }).then((result) => {
                    if (result.isConfirmed) {
                        
                        e.target.submit();
                    }
                });
            });
        });
  </script>

@push('js')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        const unites = {
            'TENSION ARTERIELLE': 'mmHg', 
            'FREQUENCE CARDIAQUE': 'bpm', 
            'FREQUENCE RESPIRATOIRE': 'rpm',
            'TEMPERATURE': '°C', 
            'SATURATION O2': '%', 
            'GLYCEMIE CAPILLAIRE': 'g/L',
            'GLYCEMIE A JEUN': 'g/L',
            'GLYCEMIE POST PRANDIALE': 'g/L',
            'POIDS': 'kg', 
            'TAILLE': 'cm'
        };

        const constantesDejaAjoutees = new Set();
        let constanteIndex = 0;

        $('#constante-select').on('change', function() {
            $('#unite-constante').val(unites[$(this).val()] || '');
        });

        $('#add-constante').on('click', function() {
            const type = $('#constante-select').val();
            const valeur = $('#valeur-constante').val().trim();
            const unite = $('#unite-constante').val();

            if (!type || !valeur) {
                Swal.fire('Erreur', 'Veuillez renseigner tous les champs !', 'error');
                return;
            }

            if (constantesDejaAjoutees.has(type)) {
                Swal.fire('Attention', 'Cette constante a déjà été ajoutée !', 'warning');
                return;
            }

            const newRow = `
                <tr data-type="${type}" data-valeur="${valeur}" data-unite="${unite}">
                    <td>${$('#constante-select option:selected').text()}</td>
                    <td>${valeur}</td>
                    <td>${unite}</td>
                    <td>
                        <button type="button" class="btn btn-danger btn-sm remove-constante">Supprimer</button>
                    </td>
                </tr>
            `;

            $('#constantes-container').append(newRow);
            constantesDejaAjoutees.add(type);
            constanteIndex++;
            $('#constante-count').val(constanteIndex);

            $('#constante-select option:selected').prop('disabled', true);
            $('#constante-select').val('');
            $('#valeur-constante').val('');
            $('#unite-constante').val('');
        });

        $(document).on('click', '.remove-constante', function() {
            const type = $(this).closest('tr').data('type');
            $(this).closest('tr').remove();
            
            $('#constante-select option[value="' + type + '"]').prop('disabled', false);
            
            constantesDejaAjoutees.delete(type);
            constanteIndex = $('#constantes-container tr').length;
            $('#constante-count').val(constanteIndex);
        });

        $('#save-constantes').on('click', function() {
            if (constanteIndex === 0) {
                Swal.fire('Attention', 'Aucune constante ajoutée!', 'warning');
                return;
            }

            const formData = {
                _token: $('input[name="_token"]').val(),
                id_prise_en_charge: parseInt($('input[name="id_prise_en_charge"]').val()),
                patient_id: parseInt($('input[name="patient_id"]').val()),
                centre_id: parseInt($('input[name="centre_id"]').val()),
                id_consultation: parseInt($('input[name="id_consultation"]').val()),
                constante_count: constanteIndex,
                constantes: []
            };

            $('#constantes-container tr').each(function() {
                formData.constantes.push({
                    type: $(this).data('type'),
                    valeur: parseFloat($(this).data('valeur')),
                    unite: $(this).data('unite')
                });
            });

            $.ajax({
                url: `/traitement-patient/${formData.id_consultation}/${formData.patient_id}/modifier-constante`,
                type: 'POST',
                data: JSON.stringify(formData),
                contentType: 'application/json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Succès!', 'Données enregistrées', 'success')
                            .then(() => {
                                $('#constantesModal').modal('hide');
                                location.reload();
                            });
                    }
                },
                error: function(xhr) {
                    const errorMsg = xhr.responseJSON?.message || 'Erreur serveur';
                    Swal.fire('Erreur', errorMsg, 'error');
                }
            });
        });
    });
</script>    
@endpush

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection