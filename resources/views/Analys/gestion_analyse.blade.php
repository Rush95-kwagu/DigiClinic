@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

<!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Gestion des analyses</h5>
                  </div>
                  <div class="card-body">
                     <!-- <a href="{{URL::to('enregistrer-prise-en-charge')}}" class="btn btn-primary btn-lg">
                        Enregistrer une nouvelle prise en charge
                      </a> -->
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                            aria-controls="oneAAA" aria-selected="true">Analyses interne en attente</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab"
                            aria-controls="oneAAA" aria-selected="true">Analyses externe en attente</a>
                        </li>
                       
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">Analyses traités</a>
                        </li>
                        
                      </ul>
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    <h5 class="card-title">Analyses non traités</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">Client</th>
                                              <th width="100px">Analyse </th>
                                              <th width="100px">Numero</th>
                                              <th width="100px">Adresse</th>
                                          
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($all_analyse_nt as $v_prisenc) 
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
                                              <td>
                                                {{$v_prisenc->prenom_patient}}
                                                {{$v_prisenc->nom_patient}}
                                              </td>
                                              <td><h4><span class="badge bg-danger">{{$v_prisenc->libelle_analyse}}</span></h4></td>
                                              <td>{{$v_prisenc->telephone}}</td>
                                              <td>{{$v_prisenc->adresse}}</td>
                                                                                            
                                              <td>
                                              
                                              <a title="Dossier medial du patient" class="btn btn-outline-success" href="{{URL::to('traitement-analyse/'.$v_prisenc->id_type_analyse.'/'.$v_prisenc->patient_id)}}">
                                              <i class="ri-file-edit-fill"></i></a>                    
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
                        <div class="tab-pane fade" id="twoAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                          <div class="col-sm-12">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Analyses traités</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0" id="example2">
                                      <thead>
                                        <tr>
                                          <th></th>
                                          <th>Client</th>
                                          <th>Analyse</th>
                                          <th>Contact</th>
                                          <th>Date</th>
                                          <th>Action</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_analyse_t as $v_consult)    
                                        <tr>
                                          <td>
                                          </td>
                                          <td>{{$v_consult->nom_patient}}
                                          {{$v_consult->prenom_patient}}</td>
                                          <td>{{$v_prisenc->libelle_analyse}}</td>
                                          <td>{{$v_prisenc->telephone}}</td>
                                          <td>
                                            {{$v_prisenc->created_at}}
                                          </td>
                                          
                                          <td>
                                              
                                              <a title="Dossier medial du patient" class="btn btn-outline-success" href="{{URL::to('traitement-analyse/'.$v_consult->id_analyse.'/'.$v_consult->patient_id)}}">
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
                        <div class="tab-pane fade" id="threeAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                          <div class="col-sm-12">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Analyses traités</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table truncate align-middle" id="example3">
                                      <thead>
                                        <tr>
                                          <th width="30px">&nbsp;</th>
                                          <th width="60px">Patient</th>
                                          <th width="100px">Analyse </th>
                                          <th width="100px">Statut </th>
                                          <th width="100px">nip/numero</th>
                                          <th width="100px">Actions</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach($all_demand_p as $d_analyse) 
                                        <tr>
                                          <td>
                                            @if($d_analyse->sexe_patient == 'F')
                                            <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                            @else
                                            <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                            @endif
                                          </td>
                                          <td>
                                            {{$d_analyse->prenom_patient}}
                                            {{$d_analyse->nom_patient}}
                                          </td>
                                          <td>
                                           <h4><span class="badge bg-danger"> {{$d_analyse->nom_prestation}}</span></h4>
                                          <td>
                                            2
                                          <td>{{$d_analyse->telephone}}</td>
                                         <td>
                                            <a title="Reçu de paiement" class="btn btn-outline-success" href="{{ URL::to('edit-resultat/'.$d_analyse->patient_id.'/'.$d_analyse->id_demande)}}"                                                    >
                                              <i class="ri-file-edit-fill"></i></a>                    
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
    });
      $(document).ready(function() {
      $("#example2").DataTable();
    });
      $(document).ready(function() {
      $("#example3").DataTable();
    });
      $("select").change(function(){
      if(confirm('Cliquez OK pour envoyer le patient vers le spécialiste')){
          {this.form.submit()} 
      }
      else $("select option:selected").prop("selected", false);
    });
    </script>
    </script>
    @endsection
@endsection