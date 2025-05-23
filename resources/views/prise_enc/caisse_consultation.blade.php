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
                            aria-controls="oneAAA" aria-selected="true">Consultations Impayées</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">Consultations payées</a>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAA" data-bs-toggle="tab" href="#threeAAA" role="tab"
                            aria-controls="threeAAA" aria-selected="false">Tab Three</a>
                        </li> -->
                      </ul>
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAA" role="tabpanel">
                          <!-- Row starts -->
                          <div class="row gx-3">
                             <div class="col-sm-12">
                                <div class="card mb-3">
                                  <div class="card-header">
                                    <h5 class="card-title">Patients devant à la caisse des frais de consultation</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
                                              <th width="30px">&nbsp;</th>
                                              <th width="60px">Patient</th>
                                              <th width="100px">Mal/Maux </th>
                                              <th width="100px">nip/numero</th>
                                              <th width="100px">Adresse</th>
                                              <th width="100px">G Sanguin</th>
                                              <th width="100px">Naissance</th>
                                              </th>
                                              <th width="100px">
                                              Observation
                                              </th>
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($all_consulti as $v_consult) 
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
                                              <td><h4><span class="badge bg-danger">{{$v_consult->maux}}</span></h4></td>
                                              <td>{{$v_consult->telephone}}</td>
                                              <td>{{$v_consult->adresse}}</td>
                                              <td><h4><span class="badge bg-primary">O+</span></h4></td>
                                              <td>
                                                {{$v_consult->datenais}}
                                              </td>
                                              <td>{{$v_consult->observation}}</td>
                                              
                                              <td>
                                              <form action="{{url('pay-consult')}}" method="POST">
                                                  {{csrf_field()}}
                                            		<input type="hidden" name="id_prise_en_charge" value="{{$v_consult->id_prise_en_charge}}">
                      													<select name="frais_consultation" id="myDropdown" class="form-select btn btn-outline-warning" name="dropdown">
                      													  <option selected>Régler</option>
                      													 <optgroup label="Montants">
                      													  style="color:Black;">
                      													<?php 

                					                     		$all_conslt=DB::table('tbl_type_analyse')
                                                  ->where('centre_id',$centre_id)
                      									           ->get(); 
                      							             foreach ($all_conslt as $v_conslt){ ?>  
                      														<option value="{{$v_conslt->prix_analyse}}">{{$v_conslt->prix_analyse}} F {{$v_conslt->libelle_analyse}}</option>
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
                                          <th></th>
                                          <th>Patient</th>
                                          <th>Mal/Maux</th>
                                          <th>Situation matrimonial</th>
                                          <th>Contact à appeller</th>
                                          <th>Spécialiste actuel</th>
                                          <th>Date consultation</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_consultp as $v_hospit)    
                                        <tr>
                                          <td>
                                          </td>
                                          <td>{{$v_hospit->nom_patient}}
                                          {{$v_hospit->prenom_patient}}</td>
                                          <td>{{$v_hospit->maux}}</td>
                                          <td>{{$v_hospit->smatrimonial}}</td>
                                          <td>{{$v_hospit->contact_urgence}}</td>
                                          <td>Pas de spécialiste actuel</td>
                                          <td>Date consultation</td>
                                          
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