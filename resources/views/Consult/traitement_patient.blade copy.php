@extends('layout')
@section('admin_content')

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
        <div class="row gx-3">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title"><u>Données du patient</u></h5>
                        
                        <div style="position: absolute; left: 50%; top: 5px; transform: translateX(-80%);">
                            <h5 class="card-title ">
                                <u>Motif d'admission</u>: <br><br>
                            </h5>
                            <h4>
                                <span class="badge bg-danger text-truncate" style="max-width: 400px;">{{ $patient->maux ?? 'Non spécifié' }}</span> 
                            </h4>
                        </div>
                        
                        <b>Nom</b>: <span style="color: green;">{{ $patient->prenom_patient ?? '' }} {{ $patient->nom_patient ?? '' }}</span><br>
                        <b>Sexe</b>: {{ $patient->sexe_patient ?? 'Non renseigné' }} <br>
                        <b>Âge</b>: {{ $patient->age_formatted ?? 'Non renseigné' }} <br>
                        <b>Profession</b>: {{ $patient->profession ?? 'Non renseignée' }}
                        
                        <div style="position: absolute; left: 80%; top: 5px; transform: translateX(-80%);">
                            <h5 class="card-title">
                                <u>Constantes vitales</u>: <br><br>
                            </h5>
                            
                            @forelse($last_constance as $constante)
                                <b>{{ $constante->type }}</b>: {{ $constante->valeur }} {{ $constante->unite }} <br>
                            @empty
                                <span class="text-muted">Aucune constante disponible</span>
                            @endforelse
                        </div>
                        
                        @if(!empty($patient->new_temp))
                            Actuellement: <span class="badge bg-primary">{{ $patient->new_temp }} °C</span>
                        @endif 
                        
                        @if(!empty($patient->observation))
                            <span class="badge bg-secondary">
                                {{ $patient->observation }}
                            </span>
                        @endif

                        <br><br><br>
                        
                        @if($user_role_id != 0 && $user_role_id != 1 && $user_role_id != 10)
                            @if ($patient->is_hospitalisation == 1)
                                <button type="button" class="btn btn-light float-right" data-bs-toggle="modal" data-bs-target="#constantesModal">
                                    Nouvelles Constantes
                                </button>
                            @endif

                            <button type="button" class="btn btn-light float-right" data-bs-toggle="modal" data-bs-target="#presc">
                                Délivrer une ordonnance
                            </button>
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
                                                    <!-- Champs communs -->
                                                    {{-- <div class="contaire mt-8">
                                                        <textarea name="" id="" cols="80" rows="10"></textarea>
                                                        <textarea name="" id="" cols="80" rows="10"></textarea>
                                                    </div> --}}
                                                    <div class="col-md-12 mb-3">
                                                        <label class="control-label">Votre diagnostic</label>
                                                        <textarea class="form-control" name="diagnostic" rows="3" required></textarea>
                                                    </div>
                                            
                                                    <div class="col-md-10 mb-3">
                                                        <label>Observation</label>
                                                        <input type="text" class="form-control" name="observation">
                                                    </div>
                                            
                                                    <div class="col-md-12 mb-3">
                                                        <label>Pièce jointe</label>
                                                        <input type="file" class="form-control" name="fichier_joint" accept="application/pdf">
                                                        <div class="text-success small mt-1">PDF supporté</div>
                                                    </div>
                                            
                                                    <!-- Bloc décision (masqué si clôture) -->
                                                    <div class="affect col-md-12 mb-3">
                                                        <label class="control-label">Décision</label>
                                                        <select id="decisionSelect" class="form-select" name="specialiste">
                                                            <option value="" selected>Choisir une action</option>
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
                                                            <optgroup label="Analyse/Scanner">
                                                                <option value="3">Analyse / Scanner</option>
                                                                
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                            
                                                    <!-- Bloc ordonnance (visible seulement si clôture) -->
                                                    <div class="ordo col-md-12 mb-3" style="display: none;">
                                                        <label class="control-label">Ordonnance</label>
                                                        <div id="quill_editor"></div>
                                                        <textarea name="ordonnance" id="textar" hidden></textarea>
                                                    </div>
                                            
                                                    <!-- Switch clôture -->
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox" id="clotureSwitch" name="etat_traitement" value="1">
                                                        <label class="form-check-label" for="clotureSwitch">Clôturer le traitement</label>
                                                        <input type="hidden" name="etat_hospitalisation" id="etatHospitalisation" value="0">
                                                    </div>
                                                </div>
                                            
                                                <button type="submit" class="btn btn-primary btn-pill mr-2">Valider</button>
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
                        <div id="editor2" style="height: 200px;"></div>
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

<!-- Initialize Quill editor -->
<script>
    const quill = new Quill('#editor2', {
        theme: 'snow'
    });
    
    quill.on('text-change', function() {
        document.getElementById('ordonnance_consultation').value = quill.root.innerHTML;
    });
</script>

<script>
   document.addEventListener('DOMContentLoaded', function() {
  
    const quill = new Quill('#quill_editor', {
        theme: 'snow'
    });
    quill.on('text-change', function() {
        document.getElementById('textar').value = quill.root.innerHTML;
    });

    
    const clotureSwitch = document.getElementById('clotureSwitch');
    const affectDiv = document.querySelector('.affect');
    const ordoDiv = document.querySelector('.ordo');

    clotureSwitch.addEventListener('change', function() {
        if(this.checked) {
            affectDiv.style.display = 'none';
            ordoDiv.style.display = 'block';
            document.getElementById('etatHospitalisation').value = '1';
        } else {
            affectDiv.style.display = 'block';
            ordoDiv.style.display = 'none';
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