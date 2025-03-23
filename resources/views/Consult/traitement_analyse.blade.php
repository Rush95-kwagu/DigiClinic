@extends('layout')
@section('admin_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

<!-- App body starts -->
          <div class="app-body">
@foreach ($all_details as $patient)
@endforeach
            <!-- Row starts -->
            <div class="row gx-3">
               <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Gestion de la prise en charge de <span style="color: green;"> {{$patient->prenom_patient}} {{$patient->nom_patient}}</span><br>
                      <span class="badge bg-danger">{{$patient->maux}}</span> <span class="badge bg-primary">{{$patient->temp}} °C</span> <span class="badge bg-secondary">{{$patient->observation}}</span>

                    </h5>
                  </div>
                  <div class="card-body">
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-end" id="customTab5" role="tablist">
                      @if($patient->etat_hospitalisation == 0)
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAAA" data-bs-toggle="tab" href="#oneAAAA" role="tab"
                            aria-controls="oneAAAA" aria-selected="true">
                            <span class="badge bg-primary">Prise en charge</span>
                          </a>
                        </li>
                      @endif
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-twoAAAA" data-bs-toggle="tab" href="#twoAAAA" role="tab"
                            aria-controls="twoAAAA" aria-selected="false">
                            <span class="badge bg-primary">Dossier Médical</span>
                          </a>
                        </li>
                        <!-- <li class="nav-item" role="presentation">
                          <a class="nav-link" id="tab-threeAAAA" data-bs-toggle="tab" href="#threeAAAA" role="tab"
                            aria-controls="threeAAAA" aria-selected="false">
                            <span class="badge bg-primary">Tab Three</span>
                          </a>
                        </li> -->
                      </ul>
                      @if($patient->etat_hospitalisation == 0)
                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAAA" role="tabpanel">
                        <div class="card-body">
                              <div class="collapse" id="collapse-from-validation">
                                
                              </div>

                             <form onsubmit="confirm('Cliquez ok pour cloturer le traitement')" class="form-horizontal" method="post" action="{{url('/save-traitement')}}" enctype="multipart/form-data">
                                    {{csrf_field()}}
                           
                                <div class="form-row">

                                  <div class="col-md-12 mb-3">
                                  <label class="control-label">Votre diagnostic</label>
                                  <div class="controls">
                                  <textarea class="form-control" name="diagnostic" rows="3" required></textarea>
                                  </div>
                                  </div>


                                  <div class="col-md-10 mb-3">
                                    <label for="validationServer0">Observation</label>
                                    <input type="text" class="form-control border-success" id="validationServer0" placeholder="libellé" name="observation" >
                                    <div class="text-success small mt-1">
                                      Facultatif!
                                    </div>
                                  </div>
                                

                                  <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Pièce jointe</label>
                                    <input type="file" class="form-control border-success" id="validationServer03" placeholder="description" name="fichier_joint" accept="application/pdf" />
                                    <div class="text-success small mt-1">
                                      Pdf supporté
                                    </div>
                                  </div>

                                  <div style="display: ;" class="affect col-md-12 mb-3">
                                  <label class="control-label">Décision</label>
                                  <div class="controls">
                                  <select id="myDropdown" class="form-select btn btn-outline-" name="specialiste">
                                  <option selected>Mettre en observation ou Affecter à un spécialiste</option>
                                        <optgroup label="Observation">
                                          <option value="0">Mise en observation</option>
                                        </optgroup>

                                         <optgroup label="Spécialistes">
                                         
                                        <?php 

                                          $all_specialiste=DB::table('user_roles')
                                          ->join('users','user_roles.user_role_id','=','users.user_role_id')
                                          ->join('personnel','users.email','=','personnel.email')
                                          ->where('is_consult',1)
                                          ->where('users.user_id','!=',$user_id)
                                          ->get(); 
                                          foreach ($all_specialiste as $v_specialist){ ?>  
                                          <option value="{{$v_specialist->user_id}}">{{$v_specialist->title}}
                                          {{$v_specialist->prenom}}
                                          {{$v_specialist->nom}}</option>
                                        <?php } ?>
                                         </optgroup>
                                           <optgroup label="Laboratoire">
                                         
                                        <?php 

                                          $all_specialiste=DB::table('user_roles')
                                          ->join('users','user_roles.user_role_id','=','users.user_role_id')
                                          ->join('personnel','users.email','=','personnel.email')
                                          ->where('is_consult',2)
                                          ->where('users.user_id','!=',$user_id)
                                          ->get(); 
                                          foreach ($all_specialiste as $v_specialist){ ?>  
                                          <option value="{{$v_specialist->user_id}}">{{$v_specialist->title}}
                                          {{$v_specialist->prenom}}
                                          {{$v_specialist->nom}}</option>
                                        <?php } ?>
                                         </optgroup>

                                        </select>
                                  </div>
                                  </div>

                                  <div style="display: ;" class="ordo col-md-12 mb-3">
                                  <label class="control-label">Ordonnance</label>
                                  <div class="controls">
                                  <div id="quill_editor" placeholder="Votre texte..."></div>
                                  <textarea name="ordonnance" id="textar" cols="30" rows="30" hidden></textarea>
                                  </div>
                                  </div>

                                   <div class="form-check form-switch">
                                    <input class="checkbox form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                    <label class="checkbox form-check-label" for="flexSwitchCheckDefault">Cloturer le traitemenent</label>
                                    <input id="sign" type="hidden" name="etat_hospitalisation" value="">
                                    <input id="idc" type="hidden" value="{{$id_consultation}}" name="id_consultation" value="">
                                    <input id="idp" type="hidden" value="{{$patient->id_prise_en_charge}}" name="id_prise_en_charge" value="">
                                    <input id="idpa" type="hidden" value="{{$patient->patient_id}}" name="patient_id" value="">
                                  </div>

                                </div>
                                <button class="btn btn-primary btn-pill mr-2" type="submit">Valider</button>
                                <button class="btn btn-light btn-pill" type="submit">Cancel</button>
                              </form>

                            </div>

                        </div>
           
                        </div>
                        @endif
                        <div class="tab-pane fade" id="twoAAAA" role="tabpanel">
                          <div class="row">
                          <div class="col-xl-6 col-sm-6">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Antécédents Médicaux</h5>
                              </div>
                              <!-- Activity starts -->
                              <div class="card-body">
                                <div class="scroll350">
                                  <div class="activity-feed">
                                    @foreach($all_details as $v_detail)
                                    <div class="feed-item">
                                      
                                      <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans()}} <span class="badge bg-danger">{{$v_detail->maux}}</span></span> 

                                      <?php 
                                        $consults=DB::table('tbl_consultation')
                                      ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')              
                                      ->join('users','tbl_consultation.user_id','=','users.user_id')              
                                      ->join('personnel','users.email','=','personnel.email')              
                                      ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                                      ->where('tbl_consultation.id_prise_en_charge',$v_detail->id_prise_en_charge)
                                      ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*','users.*','personnel.*')
                                      ->orderBy('conslt_created_at','DESC')
                                      ->get();
                                      ?>

                                      @foreach($consults as $v_consult)

              <div class="col-sm-6">
                <div class="accordion mb-3" id="{{$v_consult->id_consultation}}">
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSpecialTitleOne">
                      <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseSpecialTitleOne" aria-expanded="false"
                        aria-controls="collapseSpecialTitleOne">
                        <div class="d-flex flex-column">
                          <h5 class="m-0"><strong><em class="text-primary"><i class="ri-calendar-line"></i> {{$v_consult->conslt_created_at}}</em> </strong></h5>
                        </div>
                      </button>
                    </h2>
                    <div id="collapseSpecialTitleOne" class="accordion-collapse collapse show"
                      aria-labelledby="headingSpecialTitleOne" data-bs-parent="#{{$v_consult->id_consultation}}">
                      <div class="accordion-body">
                        <p class="mb-3">
                           <code><strong> Dr. {{$v_consult->prenom}} {{$v_consult->nom}}</strong></code>
                        </p>

                        <p class="mb-3">
                          {!!$v_consult->diagnostic!!}
                        </p>

                        <p class="mb-3">
                          <strong>{{$v_consult->observation}} </strong>
                        </p>

                        <div class="d-flex gap-2">
                         
                         @if($v_consult->fichier_joint)
                          <a href="{{$v_consult->fichier_joint}}" class="btn btn-primary" download="">Fichier joint</a>
                        @endif

                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                  </div>


                                      

                                      

                                      
                                      @endforeach
                                     <?php  ?>
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                              </div>
                              <!-- Activity ends -->
                            </div>
                          </div>

                          <div class="col-xl-6 col-sm-6">
                            <div class="card mb-3">
                              <div class="card-header">
                                <h5 class="card-title">Ordonnances Antérieures</h5>
                              </div>
                              <!-- Activity starts -->
                              <div class="card-body">
                                <div class="scroll350">
                                  <div class="activity-feed">
                                    @foreach($all_details as $v_detail)

             
                                    <div class="feed-item">
                                      
                                      <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans()}} <span class="badge bg-danger">{{$v_detail->maux}}</span></span> 

                                      <div class="mb-1">
                                        <span class="text-primary">{!!$v_detail->ordonnance!!}</span>
                                      </div>
                                      
                                      
                                     <?php  ?>
                                    </div>
                                    @endforeach
                                  </div>
                                </div>
                              </div>
                              <!-- Activity ends -->
                            </div>
                          </div>
                        </div>
                        </div>

                        <!-- <div class="tab-pane fade" id="threeAAAA" role="tabpanel">
                          <h1 class="display-1 text-center text-primary p-5">
                            Selected Tab Three
                          </h1>
                        </div> -->
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


<script>
    document.querySelector('input#sign').value = 0
    document.querySelector('.affect').style.display = ''
    document.querySelector('.ordo').style.display = 'none'
    let check = document.querySelector('.checkbox')
    check.addEventListener('click', () => {
        check.classList.toggle('active');

            if(check.classList.contains('active')){
                document.querySelector('.affect').style.display = 'none'
                document.querySelector('.ordo').style.display = ''
                document.querySelector('input#sign').value = 1

            }else{                
                document.querySelector('.affect').style.display = ''
                document.querySelector('.ordo').style.display = 'none'
                document.querySelector('input#sign').value = 0
                
            }
        })
  

</script>


              
              
              
            
              
            
              
            
           

          
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      $("select").change(function(){
      if(confirm('Cliquez OK pour confirmer la décision')){
          {this.form.submit()} 
      }
      else $("select option:selected").prop("selected", false);
    });
    </script>
@endsection
@endsection