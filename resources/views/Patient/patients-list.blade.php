@extends('layout')
@section('user_content')
@section('title')
Repertoire patient
@endsection
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');
?>

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Répertoire des patients</h5>
                    @if($user_role_id == 0)
                      
                   <a href="{{URL::to('enregistrer-prise-en-charge')}}" class="btn btn-primary ms-auto">Enregistrer un nouveau patient</a>
                    @endif
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="example" class="table truncate m-0 align-middle">
                        <thead>
                          <tr>
                            <th>N° du dossier.</th>
                            <th>Nom du Patient</th>
                            <th>Sexe</th>
                            <th>Né(e) le</th>
                            <th>Groupe Sanguin</th>
                            <th>Traitement</th>
                            <th>Contact</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php
                          $all_patients = DB ::table('tbl_patient')
                                       ->where('id_centre',$centre_id)
                                        ->get();
                                       
                        @endphp
                        @foreach($all_patients as $data_patient)
                      
                          <tr>
                            <td>{{$data_patient ->dossier_numero}}</td>
                            <td>
                            @if($data_patient->sexe_patient == 'F')
                              <img src="{{asset('frontend/F.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Medical Admin Template">
                            @else
                              <img src="{{asset('frontend/M.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Medical Admin Template">
                            @endif
                              
                              {{ $data_patient->nom_patient }} {{ $data_patient->prenom_patient }}
                            </td>
                            <td><span class="badge bg-info-subtle text-info">{{ $data_patient->sexe_patient }}</span></td>
                            <td>{{ $data_patient->datenais }}</td>
                            <td><span class="badge bg-info-subtle text-danger">{{ $data_patient->gsang}}</span></td>
                            <td>
                              Diabetes
                            </td>
                            <td>{{ $data_patient->telephone}}</td>
                            <td>{{ $data_patient->email_patient }}</td>
                            <td>{{ $data_patient->adresse}}</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                              @if($user_role_id == 10)
                                
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                  data-bs-target="#delRow">
                                  <i class="ri-delete-bin-line"></i>
                                </button>
                                <a href="#" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modifier les informations du patient">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                                <a href="{{ route('patient.datas', $data_patient->patient_id) }}" class="btn btn-outline-info btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Accéder au dossier médical">
                                  <i class="ri-eye-line"></i>
                                </a>
                                 @elseif($user_role_id == 0)
                                  <a href="#" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modifier les informations du patient">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                                <a href="{{ route('patient.datas', $data_patient->patient_id) }}" class="btn btn-outline-info btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Accéder au dossier médical">
                                  <i class="ri-eye-line"></i>
                                </a>
                                @endif
                              </div>
                            </td>
                          </tr>
                       @endforeach
                        </tbody>
                      </table>
                    </div>
                    <!-- Table ends -->

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
                            Are you sure you want to delete the patient?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <button class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                              <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->
          @section('Datatable')
          <script>
            $(document).ready(function() {
            $("#example").DataTable();
                      });
            $("select").change(function(){
            if(confirm('Cliquez OK pour envoyer le patient vers le spécialiste')){
                {this.form.submit()} 
            }
            else $("select option:selected").prop("selected", false);
          });
          </script>
          
          @endsection
       @endsection
