@extends('layout')
@section('admin_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
 $centre_id=Session::get('centre_id');

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
                    <h5 class="card-title"><u>Données du patient</u> <br>
                    </h5>
                    <div style="position: absolute;
                           left: 40%;
                           top: 5px;
                           transform: translateX(-80%);">
                     <h5 class="card-title">
                        <u>Pathologie du patient</u>: <br> <br>
                      </h5>
                      <h4>
                         <span class="badge bg-danger">{{$patient->maux}}
                          </span> 
                        </h4>
                    </div>
                      <b>Nom </b>: <span style="color: green;"> {{$patient->prenom_patient}} {{$patient->nom_patient}}</span><br>
                      <b>Sexe</b> : {{ $patient->sexe_patient }} <br>
                      <b>Âge </b>: {{ $patient->age_formatted }} <br>
                      <b>Profession</b>:
                      <div style="position: absolute;
                      left: 70%;
                      top: 5px;
                      transform: translateX(-80%);">
                    <h5 class="card-title">
                       <u>Constantes vitales</u> : <br><br>
                   </h5>
                   
                        @foreach($last_constance as $type => $constante)
    
                      <b>{{ $type }}</b> : {{ $constante->valeur }} {{ $constante->unite }} <br>
                      
                      @endforeach 
                      {{-- Température : <span class="badge bg-primary">{{$patient->temp}} °C</span>   --}}

                      </div>
                     @if($patient->new_temp)Actuellement : <span class="badge bg-primary">{{$patient->new_temp}} °C</span>
                     @endif 
                     <span class="badge bg-secondary">
                      {{$patient->observation}}
                    </span>

                    </h5> <br><br><br>
                   @if($user_role_id !=0 && $user_role_id !=1 && $user_role_id !=10)
                      @if ($patient->etat_traitement == 0)
                          
                      <button type="button" class="btn btn-light float-right" data-bs-toggle="modal" data-bs-target="#constantesModal">
                        Nouvelles Constantes
                      </button>
                      @endif

                    <button type="button" class="btn btn-light float-right" data-bs-toggle="modal"
                      data-bs-target="#presc">Délivrer une ordonnance
                    </button>
                    
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="custom-tabs-container">
                      <ul class="nav nav-tabs justify-content-end" id="customTab5" role="tablist">
                        @if ($user_role_id !=0 && $user_role_id !=1 && $user_role_id !=10)
                      @if($patient->etat_hospitalisation == 0)
                  
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="tab-oneAAAA" data-bs-toggle="tab" href="#oneAAAA" role="tab"
                            aria-controls="oneAAAA" aria-selected="true">
                            <span class="badge bg-primary">Prise en charge</span>
                          </a>
                        </li>
                      @endif
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
                      @if ($user_role_id != 0 && $user_role_id != 1 && $user_role_id != 10)

                      <div class="tab-content" id="customTabContent">
                        <div class="tab-pane fade show active" id="oneAAAA" role="tabpanel">
                        <div class="card-body">
                              <div class="collapse" id="collapse-from-validation">
                                
                              </div>
                             <form onsubmit="confirm('Cliquez ok pour cloturer le traitement')" 
                                      class="form-horizontal" 
                                      method="post" 
                                      action="{{url('/save-traitement')}}" 
                                      enctype="multipart/form-data">
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
                                       <optgroup label="Hospitalisation">
                                         <option value="0">Mise en Hospitalisation</option>
                                       </optgroup>
                                        <optgroup label="Observation">
                                          <option value="2">Mise en observation</option>
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
                                          <option value="{{$v_specialist->user_id}}">{{$v_specialist->designation}} :
                                          {{$v_specialist->prenom}}
                                          {{$v_specialist->nom}}</option>
                                        <?php } ?>
                                         </optgroup>
                                           <optgroup label="Envoyer pour analyses">
                                         
                                        <?php 

                                           $all_specialiste=DB::table('user_roles')
                                                ->join('users','user_roles.user_role_id','=','users.user_role_id')
                                                ->join('personnel','users.email','=','personnel.email')
                                                ->where('user_roles.user_role_id',1)
                                                ->where('personnel.id_centre',$centre_id)
                                                ->get(); 
                                          foreach ($all_specialiste as $v_specialist){ ?>  
                                          <option value="{{$v_specialist->user_id}}">{{$v_specialist->designation}}
                                          {{-- {{$v_specialist->prenom}}
                                          {{$v_specialist->nom}} --}}
                                        </option>
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
                                <button class="btn btn-light btn-pill" type="submit">Annuler</button>
                              </form>

                            </div>

                        </div>
           
                        </div>
                        @endif
                        @endif
                        @if($patient->etat_hospitalisation ==0 && $user_role_id ==0 || $user_role_id ==1 || $user_role_id ==10)
                        <div class="tab-pane fade" id="twoAAAA" role="tabpanel">
                          @else
                        <div class="tab-pane fade show" id="twoAAAA" role="tabpanel">
                          @endif
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

                        @if($patient->new_temp)
                        <p class="mb-3">
                          <em>Température relevée : {{$patient->new_temp}} °C  </em>
                        </p>
                        @endif

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
                                    @if($v_detail->date_ordo)
                                    @foreach($all_details as $v_detail)
                                    <div class="feed-item">
                                      
                                      <span class="feed-date pb-1" data-bs-toggle="tooltip" data-bs-title="{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans() }}">{{\Carbon\Carbon::parse($v_detail->created_at)->diffForHumans()}} <span class="badge bg-danger">{{$v_detail->maux}}</span></span>


                                      <div class="mb-1">
                                        <a href="{{URL::to('ordonnance/'.$v_detail->id_ordo_traitement)}}"><span class="text-primary">
                                        {!!$v_detail->ordonnance_consultation!!}</span></a>
                                      </div> 
                                     <?php  ?>
                                    </div>
                                    @endforeach
                                    @endif
                                    <!--  <h5 class="card-title">Ordonnance de fin de traitement</h5>
                                    <div class="feed-item">
                                      <div class="mb-1">
                                        <a href="{{URL::to('ordonnance-final/'.$v_detail->id_prise_en_charge)}}"><span class="text-primary">{!!$v_detail->ordonnance!!}</span></a>
                                      </div>
                                    </div> -->
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

<div class="modal fade" id="presc" data-bs-backdrop="static" data-bs-keyboard="false"
                      tabindex="-1" aria-labelledby="prescLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Prescrire une ordonnance</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modall" aria-label="Annuler"></button>
            </div>
            <form action="{{ url('/make-ordonnance') }}" method="POST">
                            {{csrf_field()}}
            <div class="modal-body">
            <h4>Veuillez éditer votre ordonnance</h4>
            <br>
            <input type="hidden" name="id_consultation" value="{{$id_consultation}}">
            <input type="hidden" name="id_prise_en_charge" value="{{$patient->id_prise_en_charge}}">

            <div class="control-group hidden-phone">
                <label class="control-label" for="textarea2">Contenu de l'ordonnance</label>
                <br>
                <div id="editor" style="height: 200px;"></div>
                <input type="hidden" name="ordonnance_consultation" id="ordonnance_consultation">
            </div>
          </div>
             <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                  Fermer
                </button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">
                  Oui, confirmer
                </button>
              </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="constantesModal" tabindex="-1" aria-labelledby="constantesModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="constantesModalLabel">Gestion des constantes médicales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="constantesForm">
          @csrf
          <div class="row">
            <div class="col-md-4 mb-3">

              {{-- <input type="hidden" name="id_consultation" value="{{$id_consultation}}"> --}}
              <input type="hidden" name="id_prise_en_charge" value="{{$patient->id_prise_en_charge}}">
              <input type="hidden" name="patient_id" value="{{ $patient->patient_id }}">
              <input type="hidden" name="centre_id" value="{{ $centre_id }}">
              <input type="hidden" name="id_consultation" value="{{$id_consultation}}">

              <label class="classItems" for="selectError1"><b>Constantes</b><span style="color: red">*</span></label>
              <div class="controls col-12">
                <select class="form-control form-select" name="constantes" id="constante-select">
                  <option value="" selected>Sélectionner une constante</option>
                  <option value="TENSION ARTERIELLE">Tension Artérielle</option>
                  <option value="FREQUENCE CARDIAQUE">Fréquence Cardiaque</option>
                  <option value="FREQUENCE RESPIRATOIRE">Fréquence Respiratoire</option>
                  <option value="TEMPERATURE">Température</option>
                  <option value="SATURATION O2">Saturation O2</option>
                  <option value="GLYCEMIE CAPILLAIRE">Glycémie Capillaire</option>
                  <option value="GLYCEMIE A JEUN">Glycémie à Jeun</option>
                  <option value="GLYCEMIE POST PRANDIALE">Glycémie Post Prandiale</option>
                  <option value="POIDS">Poids</option>
                  <option value="TAILLE">Taille</option>
                </select>
              </div>
            </div>
            
            <div class="col-md-3 mb-3">
              <label class="classItems" for="selectError1"><b>Valeur</b><span style="color: red">*</span></label>
              <div class="controls col-12">
                <input type="text" name="valeur" class="form-control" id="valeur-constante" placeholder="Valeur">
              </div>
            </div>
            
            <div class="col-md-3 mb-3">
              <label class="classItems" for="selectError1"><b>Unité</b><span style="color: red">*</span></label>
              <div class="controls col-12">
                <input type="text" name="unite" class="form-control" id="unite-constante" placeholder="Unité" readonly>
              </div>
            </div>
            
            <div class="col-md-2 mb-3 d-flex align-items-end">
              <button type="button" class="btn btn-primary" id="add-constante">Ajouter</button>
            </div>
          </div>
          
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Constante</th>
                  <th>Valeur</th>
                  <th>Unité</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="constantes-container">
                <!-- Les constantes ajoutées apparaîtront ici -->
              </tbody>
            </table>
          </div>
          
          <input type="hidden" id="constante-count" name="constante_count" value="0">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-success" id="save-constantes">Enregistrer</button>
      </div>
    </div>
  </div>
</div>

<!-- Include the Quill library -->
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

<!-- Initialize Quill editor -->
<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });
   // Mettre à jour le champ caché lors de la saisie
   quill.on('text-change', function() {
        document.getElementById('ordonnance_consultation').value = quill.root.innerHTML;
    });
</script>
@push('js')
<script src="{{ asset('frontend/js/NewConstantes.js') }}"></script>
    
@endpush

@endsection




