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
                                {{ $totalPatient_nh }}
                              </sup>
                                      
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab"
                            aria-controls="threeAAA" aria-selected="false">
                            Patients Hospitalisés
                            <sup class="badge bg-danger ms-1">
                              {{ $totalPatient_h }}
                            </sup>
                          </a>
                        </li>
                        {{-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">
                            Patients traités
                            <sup class="badge bg-success ms-2">
                              {{ $totalPatient_t }}
                            </sup>
                          </a>
                        </li> --}}
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
                                    <h5 class="card-title">Patients non traités 
                                    </h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">Patient</th>
                                              <th width="100px">Pathologie</th>
                                              <th width="100px">Contact Urgence</th>
                                              {{-- <th width="100px">Adresse</th> --}}
                                              <th width="100px">G Sanguin</th>
                                              
                                              <th width="100px">
                                              Observation
                                              </th>
                                              <th width="100px">Médecin en chef</th>
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($all_hospi_nt as $to_hospi) 
                                            <tr>
                                              <td>
                                                <a href="#" class="me-1 icon-box sm bg-light rounded-circle">
                                                @if($to_hospi->sexe_patient == 'F')
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                                @else
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                                @endif
                                                </a>
                                              </td>
                                              <td>
                                                {{$to_hospi->prenom_patient}}
                                                {{$to_hospi->nom_patient}}
                                              </td>
                                              <td><h4><span class="badge bg-danger">{{$to_hospi->maux}}</span></h4></td>
                                              <td>{{$to_hospi->contact_urgence}}</td>
                                              {{-- <td>{{$to_hospi->adresse}}</td> --}}
                                              <td><h4><span class="badge bg-primary">{{$to_hospi->gsang}}</span></h4></td>
                                              
                                              <td>{{$to_hospi->observation}}</td>
                                              
                                              <?php
                                              $all_special=DB::table('users')
                                                    ->join('personnel','users.email','=','personnel.email')
                                                    ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                                    ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                                                    ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                                                    ->where('users.user_id',$to_hospi->last_consult_user_id)
                                                    ->where('users.id_centre',$centre_id)
                                                    ->first();
                                              ?>
                                              <td>
                                                Dr. {{$all_special->nom}}
                                              </td>
                      
                                              <td>
                      
                                                 <form action="{{url('hospitaliser')}}" method="POST">
                                                      {{csrf_field()}}
                                                 <input type="hidden" name="id_consultation" value="{{$to_hospi->id_consultation}}">
                                                  <select id="myDropdown" style="background-color: rgb(3, 230, 128)" class="form-select btn btn-outline" name="id_lit">
                                                    <option selected>Hospitaliser</option>
                                                   <optgroup label="Chambre Ordinaire libre">
                      
                                                  <?php
                      
                                                    $all_lists=DB::table('tbl_lits')
                                                    ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                                                    ->where('tbl_lits.statut',0)
                                                    ->where([
                                                            ['tbl_lits.centre_id',$centre_id],
                                                            ['is_vip',0],
                                                            ])
                                                    ->select('tbl_chambre.*','tbl_lits.*')
                                                    ->get();
                                                    foreach ($all_lists as $v_lit){ ?>
                                                    <option value="{{$v_lit->id_chambre}}">CH {{$v_lit->libelle_chambre}} -
                                                    {{$v_lit->lit}}
                                                    </option>
                                                  <?php } ?>
                                                   </optgroup>
                      
                                                   <optgroup label="Chambre VIP libre">
                      
                                                  <?php
                      
                                                    $all_lists_vip=DB::table('tbl_lits')
                                                    ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                                                    ->where('tbl_lits.statut',0)
                                                    ->where([
                                                            ['tbl_lits.centre_id',$centre_id],
                                                            ['is_vip',1],
                                                            ])
                                                    ->select('tbl_chambre.*','tbl_lits.*')
                                                    ->get();
                                                    foreach ($all_lists_vip as $v_lit_vip){ ?>
                                                    <option value="{{$v_lit_vip->id_chambre}}">CH {{$v_lit_vip->libelle_chambre}} -
                                                    {{$v_lit_vip->lit}}
                                                    </option>
                                                  <?php } ?>
                                                   </optgroup>
                                                  </select>
                                                </form>
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
                                <h5 class="card-title">Patients hospitalisés</h5>
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
                                          <th>Pathologie</th>
                                          <th>Situation matrimonial</th>
                                          <th>Contact à appeller</th>
                                          <th>Spécialiste actuel</th>
                                          <th>Date consultation</th>
                                          <th></th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_patient_h as $v_consulted)    
                                        <tr>
                                          <td>CH-{{$v_consulted->libelle_chambre}}</td>
                                          <td>{{$v_consulted->libelle_chambre}}</td>
                                          <td>{{$v_consulted->nom_patient}}
                                          {{$v_consulted->prenom_patient}}</td>
                                          <td>{{$v_consulted->maux}}</td>
                                          <td>{{$v_consulted->smatrimonial}}</td>
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
                                            {{$all_special->designation}}. {{$all_special->prenom}} {{$all_special->nom}}
                                          </td>
                                          <td>
                                            {{$all_special->conslt_created_at}}
                                          </td>
                                          <td>
                                            <a title="Dossier médical du patient" 
                                               class="btn btn-outline-success" 
                                               href="{{ route('hospitalisation.traitement', [
                                               'id_consultation' => $v_consulted->id_consultation ?? null,
                                               'patient_id' => $v_consulted->patient_id ?? null
]) }}">
                                              <i class="ri-file-edit-fill"></i>
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

                        {{-- <div class="tab-pane fade" id="twoAAA" role="tabpanel">
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
                                          <th></th>
                                          <th>Patient</th>
                                          <th>Mal/Maux</th>
                                          <th>Situation matrimonial</th>
                                          <th>Contact à appeller</th>
                                          <th>Spécialiste actuel</th>
                                          <th>Date consultation</th>
                                          <th></th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_patient_t as $v_consult)    
                                        <tr>
                                          <td>
                                          </td>
                                          <td>{{$v_consult->nom_patient}}
                                          {{$v_consult->prenom_patient}}</td>
                                          <td>{{$v_consult->maux}}</td>
                                          <td>{{$v_consult->smatrimonial}}</td>
                                          <td>{{$v_consult->contact_urgence}}</td>
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
                                            {{$all_specialiste->designation}}. {{$all_specialiste->prenom}} {{$all_specialiste->nom}}
                                          </td>
                                          <td>
                                            {{$all_specialiste->conslt_created_at}}
                                          </td>
                                           <td>
                                              
                                              <a title="Dossier medial du patient" class="btn btn-outline-success" href="{{URL::to('traitement-patient/'.$v_consult->id_consultation.'/'.$v_consult->patient_id)}}">
                                              <i class="ri-file-edit-fill"></i></a>                    
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
                        </div> --}}
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
                                          <th>Contact à appeller</th>
                                          <th>Spécialiste actuel</th>
                                          <th>Date consultation</th>
                                          <th></th>
                                          
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
                                          <td>{{$v_consult->contact_urgence}}</td>
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
                                            {{$all_specialiste->designation}}. {{$all_specialiste->prenom}} {{$all_specialiste->nom}}
                                          </td>
                                          <td>
                                            {{$all_specialiste->conslt_created_at}}
                                          </td>
                                           <td>
                                              
                                              <a title="Dossier medial du patient" class="btn btn-outline-success" href="{{URL::to('traitement-patient/'.$v_consult->id_consultation.'/'.$v_consult->patient_id)}}">
                                              <i class="ri-file-edit-fill"></i></a>                    
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