@extends('layout')
@section('admin_content')
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
                    <h5 class="card-title">Gestion des frais de consultation</h5>
                  </div>
                  <div class="card-body">
                     <!-- <a href="#" class="btn btn-primary btn-lg">
                        Consultations - Hospitalisation
                      </a> -->
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                            aria-controls="oneAAA" aria-selected="true">Analyses Impayées</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">Analyses payées</a>
                        </li>
                        
                      </ul>
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    <h5 class="card-title">Patients devant à la caisse des frais d'analyses</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">Patient</th>
                                              <th width="100px">Motif </th>
                                              <th width="100px">nip/numero</th>
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($all_demand_np as $v_consult) 
                                            <tr>
                                              <td>
                                                @if($v_consult->sexe_patient == 'F')
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/F.png')}}" alt="sexe')}}" class="rounded-circle img-3x">
                                                @else
                                                <img style="width:30px; height:30px;" src="{{asset('frontend/M.png')}}" alt="sexe" class="rounded-circle img-3x">
                                                @endif
                                              </td>
                                              <td>
                                                {{$v_consult->prenom_patient}}
                                                {{$v_consult->nom_patient}}
                                              </td>
                                              <td>
                                                @if ($v_consult->nom_service == 'Laboratoire')
                                                    
                                                <h4><span class="badge bg-danger">Analyse</span></h4></td>
                                                @elseif($v_consult->nom_service == 'Radio')
                                                <h4><span class="badge bg-success">Scanner</span></h4></td>
                                                @else
                                                <h4><span class="badge bg-info">N/A</span></h4></td>
                                                
                                                @endif
                                              <td>{{$v_consult->telephone}}</td>
                                             <td>
                                                
                                                  <a title="Demande du patient" class="btn btn-outline-success" href="{{ URL::to('all-analyses/'.$v_consult->patient_id.'/'.$v_consult->id_demande.'/' .$v_consult->services_id)}}"                                                    >
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
                                <h5 class="card-title">Patients ayant réglé leurs frais de consultation</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0">
                                      <thead>
                                       
                                          <tr>
                                            <th width="30px">&nbsp;</th>
                                            <th width="60px">Patient</th>
                                            <th width="100px">Motif </th>
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
                                             @if ($d_analyse->nom_service == 'Laboratoire')
                                                 
                                             <h4><span class="badge bg-danger">Analyse</span></h4></td>
                                             @elseif($d_analyse->nom_service == 'Radio')
                                             <h4><span class="badge bg-success">Scanner</span></h4></td>
                                             @else
                                             <h4><span class="badge bg-info">N/A</span></h4></td>
                                             
                                             @endif
                                           <td>
                                             @if ($d_analyse->statut == 0)
                                                 
                                             <h4><span class="badge bg-warning">En cours</span></h4></td>
                                             @elseif($d_analyse->statut == 1)
                                             <h4><span class="badge bg-success">Terminé</span></h4></td>
                                             @else
                                             <h4><span class="badge bg-info">N/A</span></h4></td>
                                             
                                             @endif
                                           <td>{{$d_analyse->telephone}}</td>
                                          <td>
                                             <a title="Reçu de paiement" class="btn btn-outline-success" href="{{ URL::to('all-analyses/'.$d_analyse->patient_id.'/'.$d_analyse->id_demande.'/' .$d_analyse->services_id)}}"                                                    >
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

    $("select").change(function(){
	    if(confirm('Cliquez OK pour confirmer le règlement')){
	        {this.form.submit()} 
	    }
	    else $("select option:selected").prop("selected", false);
	});
    </script>
    @endsection
@endsection