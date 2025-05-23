@extends('layout')
@section('user_content')
@section('title')
Dossier médical
@endsection
@php
    $user_role_id = Session::get('user_role_id');
    $user_id = Session::get('user_id');
    $centre_id = Session::get('centre_id');
    $patient = $all_details->first() ?? null;
@endphp


          <!-- App body starts -->
          <div class="app-body">

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
                          <div class="icon-box lg bg-secondary rounded-5 me-2">
                            <i class="ri-stethoscope-line fs-3 text-body"></i>
                          </div>
                          <div>
                            <h4 class="mb-1">{{ $patient->user_id }}</h4>
                            <p class="m-0">Médécin traitant</p>
                          </div>
                        </div>
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
            
             <button type="button" class="btn btn-success float-right card-title" data-bs-toggle="modal" data-bs-target="#constantesModal">
                Nouvelles Constantes
            </button>
          </div>
              @foreach ($last_constance as $type => $constante)
                              
              <div class="col-xxl-3 col-sm-4 col-12">
                <div class="card mb-3">
                  
                  <div class="card-body">
                    <div class="text-center">
                      <div class="icon-box md bg-info rounded-5 m-auto">
                        {{-- <i class="ri-capsule-line fs-3"></i> --}}
                        <i class="ri-stethoscope-line fs-3"></i>
                      </div>
                      <div class="mt-3">
                        <h5>{{ $type }}</h5>
                        <p class="m-0 opacity-50">3 dernières visites</p>
                      </div>
                    </div>
                    
                    <div id=""></div>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>{{ $constante->created_at}}</div>
                        <div>{{ $constante->valeur}} {{ $constante->unite}}</div>
                      </li>
                      {{-- <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>16/04/2024</div>
                        <div>190</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>10/04/2024</div>
                        <div>230</div>
                      </li> --}}
                    </ul>
                  </div>
                </div>
              </div>
              @endforeach
              {{-- <div class="col-xxl-3 col-sm-6 col-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="icon-box md bg-info rounded-5 m-auto">
                        <i class="ri-contrast-drop-2-line fs-3"></i>
                      </div>
                      <div class="mt-3">
                        <h5>Taux de sucre</h5>
                        <p class="m-0 opacity-50">3 récentes visites</p>
                      </div>
                    </div>
                    <div id="sugarLevels"></div>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>24/04/2024</div>
                        <div>140</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>16/04/2024</div>
                        <div>190</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>10/04/2024</div>
                        <div>230</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-sm-6 col-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="icon-box md bg-success rounded-5 m-auto">
                        <i class="ri-heart-pulse-line fs-3"></i>
                      </div>
                      <div class="mt-3">
                        <h5>Fréquence cardiaque</h5>
                        <p class="m-0 opacity-50">3 dernières visites</p>
                      </div>
                    </div>
                    <div id="heartRate"></div>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>24/04/2024</div>
                        <div>110</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>16/04/2024</div>
                        <div>120</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>10/04/2024</div>
                        <div>100</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-xxl-3 col-sm-6 col-12">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="text-center">
                      <div class="icon-box md bg-warning rounded-5 m-auto">
                        <i class="ri-flask-line fs-3"></i>
                      </div>
                      <div class="mt-3">
                        <h5>Le cholestérol</h5>
                        <p class="m-0 opacity-50">3 dernières visites</p>
                      </div>
                    </div>
                    <div id="clolesterolLevels"></div>
                    <ul class="list-group">
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>24/04/2024</div>
                        <div>180</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>16/04/2024</div>
                        <div>220</div>
                      </li>
                      <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>10/04/2024</div>
                        <div>230</div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div> --}}
            </div>
            <!-- Row ends -->

            <!-- Row starts -->
            <div class="row gx-3">
              {{-- <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Health Insurance Claims</h5>
                  </div>
                  <div class="card-body">
                    <div id="insuranceClaims"></div>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">My Medical Expenses</h5>
                  </div>
                  <div class="card-body">
                    <div id="medicalExpenses"></div>
                  </div>
                </div>
              </div> --}}
              <div class="col-xl-7 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title" style="text-align: center">Soins appliqués
                    <button type="button" class="btn btn-success float-right card-title" data-bs-toggle="modal" data-bs-target="#constantesModal2">
                      Nouveau soins
                  </button></h5>
                  </div>
                  <div class="card-body">
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table align-middle truncate m-0">
                          <thead>
                            <tr>
                              <th>Infirmier</th>
                              <th>Type de soins</th>
                              <th>Date</th>
                              {{-- <th>Date</th> --}}
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>
                                <a href="#!" class="link-primary text-truncate">Reports 1 clinical
                                  documentation</a>
                              </td>
                              <td>May-28, 2024</td>
                              <td>
                                
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                data-bs-target="#viewReportsModal1">
                                Voir
                              </button>
                                </div>
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-5 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title" style="text-align:center">Ordonnances médicales</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-outer">
                      <div class="table-responsive">
                        <table class="table align-middle truncate m-0">
                          <thead>
                            <tr>
                              <th>Médecin</th>
                              <th>Date</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>
                                <img src="assets/images/user1.png" class="img-3x rounded-2" alt="Medical Dashboard"> Dr.
                                Hector
                              </td>
                              {{-- <td>20/05/2024</td> --}}
                              <td>20/05/2024</td>
                              
                              <td>
                                <div class="d-inline-flex gap-1">
                                  <button class="btn btn-info btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#viewReportsModal1">
                                    Voir
                                  </button>
                                  <button class="btn btn-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Télécharger">
                                    <i class="ri-file-download-line"></i>
                                  </button>
                                </div>
                              </td>
                            </tr>
                            
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

            <!-- Modal Delete Row -->
            <div class="modal fade" id="delRow" tabindex="-1" aria-labelledby="delRowLabel" aria-hidden="true">
              <div class="modal-dialog modal-sm">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="delRowLabel">
                      Confirm
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    Are you sure you want to delete this report?
                  </div>
                  <div class="modal-footer">
                    <div class="d-flex justify-content-end gap-2">
                      <button class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">No</button>
                      <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Modal View All Reports -->
            <div class="modal fade" id="viewReportsModal1" tabindex="-1" aria-labelledby="viewReportsModalLabel1"
              aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewReportsModalLabel1">
                      View Reports
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <!-- Row starts -->
                    <div class="row g-3">
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Clinical Report</h6>
                          <p class="m-0 small">10/05/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Dentist Report</h6>
                          <p class="m-0 small">20/06/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Glucose Report</h6>
                          <p class="m-0 small">30/06/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">X-ray Report</h6>
                          <p class="m-0 small">26/08/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Ultrasound Report</h6>
                          <p class="m-0 small">21/08/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Hypothermia Report</h6>
                          <p class="m-0 small">15/04/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Discharge Report</h6>
                          <p class="m-0 small">22/07/2024</p>
                        </a>
                      </div>
                      <div class="col-sm-2">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center"
                          data-bs-target="#viewReportsModal2" data-bs-toggle="modal">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Diabetes Report</h6>
                          <p class="m-0 small">17/05/2024</p>
                        </a>
                      </div>
                    </div>
                    <!-- Row ends -->

                  </div>
                </div>
              </div>
            </div>

            <!-- Modal View Single Report -->
            <div class="modal fade" id="viewReportsModal2" tabindex="-1" aria-labelledby="viewReportsModalLabel2"
              aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewReportsModalLabel2">
                      <div class="d-flex align-items-center">
                        <a href="#!" class="btn btn-sm btn-outline-primary me-2" data-bs-target="#viewReportsModal1"
                          data-bs-toggle="modal">
                          <i class="ri-arrow-left-wide-fill"></i>
                        </a>
                        Clinical Report
                      </div>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">

                    <!-- Row starts -->
                    <div class="row g-3">
                      <div class="col-sm-12">
                        <a href="#" class="d-flex flex-column bg-light p-2 rounded-2 text-center">
                          <img src="assets/images/report.svg" class="img-fluid rounded-2" alt="Medical Dashboards">
                          <h6 class="mt-3 mb-1 text-truncate">Clinical Report</h6>
                          <p class="m-0 small">10/05/2024</p>
                        </a>
                      </div>
                    </div>
                    <!-- Row ends -->

                  </div>
                </div>
              </div>
            </div>
@include('layouts.partials._new-constantes')
          </div>
          <!-- App body ends -->
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

  @endsection
