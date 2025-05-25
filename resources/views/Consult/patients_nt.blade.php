@extends('layout')
@section('admin_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id')
?>

<!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Gestion des patients en consultation</h5>
                  </div>
                  <div class="card-body">
                     <!-- <a href="{{URL::to('enregistrer-prise-en-charge')}}" class="btn btn-primary btn-lg">
                        Enregistrer une nouvelle prise en charge
                      </a> -->
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                            aria-controls="oneAAA" aria-selected="true">
                            Patients en attente
                              <sup class="badge bg-warning ms-1">
                                {{ $totalPatient_nt }}
                              </sup>
                                      
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab"
                            aria-controls="threeAAA" aria-selected="false">
                            Patients en Hospitalisation
                            <sup class="badge bg-danger ms-1">
                              {{ $totalPatient_h }}
                            </sup>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">
                            Patients traités
                            <sup class="badge bg-success ms-2">
                              {{ $totalPatient_t }}
                            </sup>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-fourAAA" data-bs-toggle="tab" href="#fourAAA" role="tab"
                            aria-controls="fourAAA" aria-selected="false">
                            Patients en Observation
                         
                            <sup class="badge bg-warning ms-2">
                              {{ $totalPatient_ob }}
                            </sup>
                          </a>
                        </li>
                        
                      </ul>
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    <h5 class="card-title">Patients en attente 
                                    </h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">N° Dossier</th>
                                              <th width="60px">Nom & Prénom </th>
                                              <th width="100px">Pathologie</th>
                                              <th width="100px">Téléphone</th>
                                              {{-- <th width="100px">Adresse</th> --}}
                                              {{-- <th width="100px">G Sanguin</th> --}}
                                              
                                              <th width="100px">
                                              Observation
                                              </th>
                                              {{-- <th width="100px">Médecin en chef</th> --}}
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            @foreach($all_patient_nt as $v_prisenc) 
                                            <tr>
                                              <td>
                                                <a href="#" class="me-1 icon-box sm bg-light rounded-circle">
                                                @if($v_prisenc->sexe_patient == 'F')
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                                @else
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                                @endif
                                                </a>
                                              </td>
                                              <td>{{ $v_prisenc->dossier_numero }}</td>
                                              <td>
                                                {{$v_prisenc->prenom_patient}}
                                                {{$v_prisenc->nom_patient}}
                                              </td>
                                              <td><h4><span class="badge bg-danger">{{$v_prisenc->maux}}</span></h4></td>
                                              <td>{{$v_prisenc->telephone}}</td>
                                              <td><h4><span class="badge bg-primary">{{$v_prisenc->observation}}</span></h4></td>
                                              <td> <a title="Dossier medial du patient" class="btn btn-outline-success" href="{{URL::to('traitement-patient/'.$v_prisenc->id_consultation.'/'.$v_prisenc->patient_id)}}">
                                              <i class="ri-edit-fill"></i></a>                    
                                              </td>
                                            </tr>
                                          @endforeach
                                          </tbody>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                          </div>
                          <!-- Row ends -->
                        </div>

                        <div class="tab-pane fade" id="threeAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                          <div class="col-sm-12">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Patients en hospitalisation</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0" id="example2">
                                      <thead>
                                        <tr>
                                          <th>CHAMBRE</th>
                                          <th>LIT</th>
                                          <th>Patient</th>
                                          <th>Diagnostic</th>
                                          <th>Contact Urgence</th>
                                          <th>Hospitalisé le</th>
                                          <th>Dossier Médical</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_patient_h as $v_consulted)    
                                        <tr>
                                          <td>CH-{{$v_consulted->libelle_chambre}}</td>
                                          <td>{{$v_consulted->libelle_chambre}}</td>
                                          <td>{{$v_consulted->nom_patient}}
                                          {{$v_consulted->prenom_patient}}</td>
                                          <td><h4><span class="badge bg-danger">{{$v_consulted->diagnostic}}</span></h4></td>
                                          <td>{{$v_consulted->contact_urgence}}</td>
                                          <?php 
                                          $all_special=DB::table('users')
                                                ->join('personnel','users.email','=','personnel.email')
                                                ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                                ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                                                ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                                                ->where('users.user_id',$v_consulted->last_consult_user_id)
                                                ->first();
                                          ?>  
                                          <td>
                                            {{$all_special->conslt_updated_at}}
                                          </td>
                                          <td>
                                            <a title="Editer le dossier" 
                                               class="btn btn-outline-success" 
                                               href="{{ route('traitement-patient', [
                                               'id_consultation' => $v_consulted->id_consultation ?? null,
                                               'patient_id' => $v_consulted->patient_id ?? null]) }}">
                                              <i class="ri-edit-fill"></i>
                                            </a>                    
                                            <a title="Voir le dossier" 
                                               class="btn btn-outline-info" 
                                               href="#">
                                              <i class="ri-eye-line"></i>
                                            </a>                    
                                          </td>
                                        <?php ?>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                          <!-- Row ends -->
                        </div>

                        <div class="tab-pane fade" id="twoAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                          <div class="col-sm-12">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Patients traités</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0" id="example1">
                                      <thead>
                                        <tr>
                                          <th>N° Dossier</th>
                                          <th>Patient</th>
                                          <th>Pathologie Traité</th>
                                          <th>N°Téléphone</th>
                                          <th>Date fin traitement</th>
                                          <th>Action</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_patient_t as $v_consult)    
                                        <tr>
                                          <td>{{ $v_consult->dossier_numero }}</td>
                                          <td>{{$v_consult->nom_patient}}
                                          {{$v_consult->prenom_patient}}</td>
                                          <td><h4><span class="badge bg-danger">{{$v_consult->maux}}</span></h4></td>
                                          <td>{{$v_consult->telephone}}</td>
                                          <?php 
                                          $all_specialiste=DB::table('users')
                                                ->join('personnel','users.email','=','personnel.email')
                                                ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                                ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                                                ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                                                ->where('users.user_id',$v_consult->last_consult_user_id)
                                                ->first();
                                          ?>  
                                          <td>
                                            {{$all_specialiste->conslt_created_at}}
                                          </td>
                                           <td>
                                              
                                              <a title="Consulter le dossier" class="btn btn-outline-info" href="{{URL::to('traitement-patient/'.$v_consult->id_consultation.'/'.$v_consult->patient_id)}}">
                                              <i class="ri-eye-line"></i></a>                    
                                              </td>
                                        <?php ?>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                          <!-- Row ends -->
                        </div>
                        <div class="tab-pane fade" id="fourAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                          <div class="col-sm-12">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Patients en Observation</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0" id="example3">
                                      <thead>
                                        <tr>
                                          <th></th>
                                          <th>Patient</th>
                                          <th>Mal/Maux</th>
                                          <th>Situation matrimonial</th>
                                          <th>N° Téléphone</th>
                                          <th>Date Mise Observation</th>
                                          <th>Action</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_patient_ob as $v_consult)    
                                        <tr>
                                          <td>
                                          </td>
                                          <td>{{$v_consult->nom_patient}}
                                          {{$v_consult->prenom_patient}}</td>
                                          <td>{{$v_consult->maux}}</td>
                                          <td>{{$v_consult->smatrimonial}}</td>
                                          <td>{{$v_consult->telephone}}</td>
                                          <?php 
                                          $all_specialiste=DB::table('users')
                                                ->join('personnel','users.email','=','personnel.email')
                                                ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                                ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                                                ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                                                ->where('users.user_id',$v_consult->last_consult_user_id)
                                                ->first();
                                          ?>   
                                         
                                          <td>
                                            {{$all_specialiste->conslt_created_at}}
                                          </td>
                                           <td> 
                                              <a title="Editer le Dossier" 
                                                class="btn btn-outline-success" 
                                                href="{{URL::to('traitement-patient/'
                                                      .$v_consult->id_consultation.'/'
                                                      .$v_consult->patient_id)}}">
                                                    <i class="ri-edit-fill"></i>
                                              </a>                    
                                              <a title="Consulter le Dossier" 
                                                class="btn btn-outline-info" 
                                                href="#">
                                                  <i class="ri-eye-line"></i>
                                              </a>                    
                                           </td>
                                        <?php ?>
                                        </tr>
                                      @endforeach
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          </div>
                          <!-- Row ends -->
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

          
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
      $("#example1").DataTable();
      $("#example2").DataTable();
      $("#example3").DataTable();
    });
    $("select").change(function() {
    let selectElement = this; 
    Swal.fire({
        title: 'Hospitaliser le patient ?',
        text: "Cliquez sur OK pour hospitaliser le patient dans la chambre.",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            selectElement.form.submit(); 
        } else {
            $(selectElement).val(''); 
        }
    });
    });

    </script>
    </script>
@endsection
@endsection