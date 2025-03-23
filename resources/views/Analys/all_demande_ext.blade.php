@extends('layout')
@section('user_content')
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
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Gestion des demandes externes</h5>
                  </div>
                  @if ($user_role_id != 1)
                      
                  <div class="card-body">
                     <a href="{{URL::to('enregistrer-demande-externe')}}" class="btn btn-primary btn-lg">
                        Enregistrer une nouvelle demande
                      </a>
                  @endif

                    <div class="custom-tabs-container">
                     @if ($user_role_id ==0)
                     <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                          aria-controls="oneAAA" aria-selected="true">Demandes en attentes</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                          aria-controls="twoAAA" aria-selected="false">Demandes transmises</a>
                      </li>
                     @else
                     <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                      <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                          aria-controls="oneAAA" aria-selected="true">Analyses à payer</a>
                      </li>
                      <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                          aria-controls="twoAAA" aria-selected="false">Analyses payées</a>
                      </li>
                     @endif
                       
                      </ul>
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    @if ($user_role_id == 0)
                                    <h5 class="card-title">Demande en attente</h5>
                                        
                                    @else
                                    <h5 class="card-title">Analyses en attente de paiement</h5>
                                        
                                    @endif
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="30px">N° Dossier</th>
                                              <th width="60px">Patient</th>
                                              <th width="100px">Spécialité</th>
                                              <th width="100px">Sexe </th>
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($new_demand as $v_prisenc) 
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
                                                {{$v_prisenc->dossier_numero}}
                                                
                                              </td>
                                              <td>
                                                {{$v_prisenc->prenom_patient}}
                                                {{$v_prisenc->nom_patient}}
                                              </td>
                                              <td><h4><span class="badge bg-danger">{{$v_prisenc->nom_service}}</span></h4></td>
                                              <td><h4><span class="badge bg-success">{{$v_prisenc->sexe_patient}}</span></h4></td>
                                             
                                              <td>
                                              {{-- @if($v_prisenc->last_consult_user_role_id == NULL && $v_prisenc->etat_consultation == 0) --}}
                                              <form action="{{url('send-demande-ext')}}" method="POST">
                                                  {{csrf_field()}}
                                              <input type="hidden" name="id_demande" value="{{$v_prisenc->id_demande}}">
                                              <select id="myDropdown" class="form-select btn btn-outline-success" name="specialiste">
                                                @if ($user_role_id == 0)
                                                <option selected>Transmettre</option>
                                                                                              
                                                <optgroup label="Laboratoire / Imagerie">
                                                
                                               <?php 
 
                                                 $all_specialiste=DB::table('user_roles')
                                                                   ->join('users','user_roles.user_role_id','=','users.user_role_id')
                                                                   ->join('personnel','users.email','=','personnel.email')
                                                                   ->where('designation',"Caisse")
                                                                   ->where('personnel.id_centre',$centre_id)
                                                                   ->get(); 
                                                              
                                                 foreach ($all_specialiste as $v_specialist){ ?>  
                                                 <option value="{{$v_specialist->user_id}}">{{$v_specialist->title}}
                                                 {{$v_specialist->prenom}}
                                                 {{$v_specialist->nom}}</option>
                                               <?php } ?>
                                                </optgroup>
                                               </select>
                                                @else
                                                <option selected>Encaisser</option>
                                                                                              
                                                <optgroup label="Transmettre">
                                                
                                               <?php 
 
                                                 $all_specialiste=DB::table('tbl_type_analyse')
                                                                  //  ->join('users','user_roles.user_role_id','=','users.user_role_id')
                                                                  //  ->join('personnel','users.email','=','personnel.email')
                                                                   ->where('service',["Laboratoire","Radio", $centre_id])
                                                                  //  ->where('personnel.id_centre',$centre_id)
                                                                   ->get(); 
                                                              
                                                 foreach ($all_specialiste as $v_specialist){ ?>  
                                                 <option value="{{$v_specialist->id_type_analyse}}">{{$v_specialist->libelle_analyse}}
                                                 {{$v_specialist->prix_analyse}}
                                                 </option>
                                               <?php } ?>
                                                </optgroup>
                                               </select>
                                                @endif

                                              {{-- <button type="submit" class="btn btn-primary">Transmettre</button> --}}
                                              </form>
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
                                <h5 class="card-title">Patients en consultation</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table id="example3" class="table table-striped truncate m-0">
                                      <thead>
                                        <tr>
                                          <th width="30px">&nbsp;</th>
                                          <th width="30px">N° Dossier</th>
                                          <th width="60px">Patient</th>
                                          <th width="100px">Motif</th>
                                          <th width="100px">Sexe </th>
                                          <th width="100px">Date</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_demand as $v_consult)    
                                        <tr>
                                          <td>
                                            <a href="#" class="me-1 icon-box sm bg-light rounded-circle">
                                              @if($v_consult->sexe_patient == 'F')
                                              <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                              @else
                                              <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                              @endif
                                              </a>
                                          </td>
                                          <td>{{$v_consult->dossier_numero}}</td>
                                          <td>{{$v_consult->nom_patient}} {{$v_consult->prenom_patient}}</td>
                                          @if ($v_consult->nom_service == 'Laboratoire')
                                              
                                          <td><h4><span class="badge bg-danger">Analyse</span></h4></td>
                                          @else
                                          <td><h4><span class="badge bg-success">Scanner</span></h4></td>

                                          @endif
                                          <td><h4><span class="badge bg-info">{{$v_consult->sexe_patient}}</span></h4></td>
                                         <td>{{$v_consult->created_at}}</td>
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
      $("#example2").DataTable();
      $("#example3").DataTable();
      $("#example4").DataTable();
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