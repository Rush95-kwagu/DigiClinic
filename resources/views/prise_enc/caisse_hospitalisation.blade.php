@extends('layout')
@section('admin_content')
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
                    <h5 class="card-title">Gestion des frais d'hospitalisation</h5>
                  </div>
                  <div class="card-body">
                     <!-- <a href="#" class="btn btn-primary btn-lg">
                        Hospitalisations - Hospitalisation
                      </a> -->
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-center" id="customTab4" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAA" data-bs-toggle="tab" href="#oneAAA" role="tab"
                            aria-controls="oneAAA" aria-selected="true">Hospitalisations Impayées</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAA" data-bs-toggle="tab" href="#twoAAA" role="tab"
                            aria-controls="twoAAA" aria-selected="false">Hospitalisations payées</a>
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
                                    <h5 class="card-title">Patients devant à la caisse des frais d'hospitalisation</h5>
                                  </div>
                                  <div class="card-body">
                                    <div class="">
                                      <div class="table-responsive">
                                        <table class="table truncate align-middle" id="example">
                                          <thead>
                                            <tr>
	                                          <th></th>
	                                          <th>Patient</th>
	                                          <th>Mal/Maux</th>
	                                          <th>Situation matrimonial</th>
	                                          <th>Contact à appeller</th>
	                                          <th>Spécialiste actuel</th>
	                                          <th>Date Hospitalisation</th>
                                              <th width="100px">Actions</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                           @foreach($all_hospiti as $v_consult) 
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
                                              <td>{{$v_consult->smatrimonial}}</td>
                                              <td>{{$v_consult->contact_urgence}}</td>
                                              <td>Pas de spécialiste actuel</td>
                                              <td>Date Hospitalisation</td>                                            
                                              <td>

                                            @if($v_consult->etat_hospitalisation == 0)
                                            <button type="button" class="btn btn-outline-light"> <Marquee>Hospitalisation en cours</Marquee></button>
                                            @else
                                              	<form action="{{url('pay-hospt')}}" method="POST">
                                              		{{csrf_field()}}
                                              		<input type="hidden" name="id_prise_en_charge" value="{{$v_consult->id_prise_en_charge}}">
                    													<select name="frais_Hospitalisation" id="myDropdown" class="form-select btn btn-outline-success" name="dropdown">
                    													  <option selected>Régler</option>
                    													 <optgroup label="Frais d'hospitalisation">
                    													 
                    													<?php 

                    							                     		$all_hospital=DB::table('tbl_frais_hospitalisation')
                    									                	->get(); 
                    							                            foreach ($all_hospital as $v_hospital){ ?>  
                    														<option value="{{$v_hospital->montant_hospital}}">{{$v_hospital->montant_hospital}} F {{$v_hospital->nom_hospital}}</option>
                    												 	<?php } ?>
                    													 </optgroup>
                    													</select>
                    												</form>
                    												@endif
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
                                <h5 class="card-title">Patients ayant réglé leurs frais d'hospitalisation</h5>
                              </div>
                              <div class="card-body">
                                <div class="table-outer">
                                  <div class="table-responsive">
                                    <table class="table table-striped truncate m-0">
                                      <thead>
                                        <tr>
                                          <th></th>
                                          <th>Patient</th>
                                          <th>Contact</th>
                                          <th>Mal/Maux</th>
                                          <th>Situation matrimonial</th>
                                          <th>Contact à appeller</th>
                                          <th>Les spécialistes</th>
                                          <th>Adresse</th>
                                          
                                        </tr>
                                      </thead>
                                      <tbody>
                                      @foreach($all_hospitp as $v_hospit)    
                                        <tr>
                                          <td>
                                          </td>
                                          <td>{{$v_hospit->nom_patient}}
                                          {{$v_hospit->prenom_patient}}</td>
                                          <td>{{$v_hospit->telephone}}</td>
                                          <td>{{$v_hospit->maux}}</td>
                                          <td>{{$v_hospit->smatrimonial}}</td>
                                          <td>{{$v_hospit->contact_urgence}}</td>
                                        <?php 
                                          $all_specialiste=DB::table('users')
                                                ->join('personnel','users.email','=','personnel.email')
                                                ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                                                ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                                                ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                                                ->where('users.user_id',$v_hospit->last_consult_user_id)
                                                ->get();
                                          ?>   
                                          <td>
                                            @foreach($all_specialiste as $v_specialist)
                                            {{$v_specialist->designation}}. {{$v_specialist->prenom}} {{$v_specialist->nom}}
                                            @endforeach
                                          </td>
                                          <td>
                                            @foreach($all_specialiste as $v_date)
                                            {{$v_date->conslt_created_at}}
                                            @endforeach
                                          </td>
                                        <?php ?>
                                          <td>{{$v_hospit->adresse}}</td>
                                        
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