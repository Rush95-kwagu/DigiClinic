@extends('layout')
@section('gstatic')
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
@endsection
@section('title')
Admin
@endsection
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
              <div class="col-xxl-12 col-sm-12">
                <div class="card mb-3 <?php if ($user_role_id == 0 ) {
                  echo "bg-2"; }else{ echo "bg-3"; } ; ?> ">
                  <div class="card-body">
                    <div class="mh-230">
                      <div class="py-4 px-3 text-white">
                        <h6>Bonjour,</h6>
                        <h2>{{Session::get('qualification')}}. {{Session::get('prenom')}} {{Session::get('nom')}}</h2>
                        <h5>Au programme aujourd'hui.</h5>
                        <div class="mt-4 d-flex gap-3">

                        @if($user_role_id == 0)
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('prises-en-charges')}}">
                            <div class="icon-box lg bg-arctic rounded-2 me-3">
                              <i class="ri-surgical-mask-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                             <?php
                                   $nbr_prisenc=DB::table('tbl_prise_en_charge')
                                          ->where('last_consult_user_id',null)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                              ?>
                              <h2 class="m-0 lh-1">{{$nbr_prisenc}}</h2>


                              <p class="m-0"> Prises en charges</p>
                              
                            <?php  
                            
                            ?>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('prises-en-charges')}}">
                            <div class="icon-box lg bg-lime rounded-2 me-3">
                              <i class="ri-stethoscope-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_sendconsult=DB::table('tbl_prise_en_charge')
                                          ->where('last_consult_user_id','!=',null)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$nbr_sendconsult}}</h2>


                              <p class="m-0"> Envoyés en consultation</p>
                            <?php  ?>
                            </div>
                          <div class="d-flex align-items-center">
                            <a href="{{route('patient.repertoire')}}">
                            <div class="icon-box lg bg-lime rounded-2 me-3">
                              <i class="ri-user-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $list_patient=DB::table('tbl_patient')
                                          ->where('id_centre',$centre_id)
                                          ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$list_patient}}</h2>


                              <p class="m-0"> Repertoire de patients</p>
                            <?php  ?>
                            </div>
                          </div>
                        @elseif($user_role_id == 1)
                        <div class="d-flex align-items-center">
                            <a href="{{URL::to('caisse-consultations')}}">
                            <div class="icon-box lg bg-lime rounded-2 me-3">
                              <i class="ri-stethoscope-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                             <?php
                                   $nbr_conslt_imp=DB::table('tbl_caisse_prise_en_charge')
                                          ->where('frais_consultation',NULL)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                              ?>
                              <h2 class="m-0 lh-1">{{$nbr_conslt_imp}}</h2>


                              <p class="m-0"> Consultations Impayées </p>
                            <?php  ?>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('caisse-hospitalisations')}}">
                            <div class="icon-box lg bg-peach rounded-3 me-3">
                              <i class="ri-walk-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_hosp_imp=DB::table('tbl_caisse_prise_en_charge')
                                          ->where('frais_hospitalisation',NULL)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$nbr_hosp_imp}}</h2>


                              <p class="m-0"> Hospitalisations Impayées </p>
                            <?php  ?>
                            </div>
                          </div>


                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('caisse-analyses')}}">
                            <div class="icon-box lg bg-arctic rounded-3 me-3">
                              <i class="ri-surgical-mask-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_analyses=DB::table('tbl_analyse_payed')
                                          ->where('centre_id',$centre_id)
                                          ->count();
                            ?>
                              <h2 style="color:black;" class="m-0 lh-1">{{$nbr_analyses}}</h2>


                              <p style="color:black;" class="m-0"> Analyses </p>
                            <?php  ?>
                            </div>
                          </div>
                        @elseif($user_role_id == 13)
                        <div class="d-flex align-items-center">
                            <a href="{{URL::to('caisse-consultations')}}">
                            <div class="icon-box lg bg-lime rounded-2 me-3">
                              <i class="ri-stethoscope-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                             <?php
                                   $nbr_conslt_imp=DB::table('tbl_caisse_prise_en_charge')
                                          ->where('frais_consultation',NULL)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                              ?>
                              <h2 class="m-0 lh-1">{{$nbr_conslt_imp}}</h2>


                              <p class="m-0"> Patients à hospitaliser</p>
                            <?php  ?>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('caisse-hospitalisations')}}">
                            <div class="icon-box lg bg-peach rounded-3 me-3">
                              <i class="ri-walk-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_hosp_imp=DB::table('tbl_caisse_prise_en_charge')
                                          ->where('frais_hospitalisation',NULL)
                                          ->where('id_centre',$centre_id)
                                          ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$nbr_hosp_imp}}</h2>


                              <p class="m-0"> Patients hospitalisés </p>
                            <?php  ?>
                            </div>
                          </div>


                          
                            </div>
                          </div>
                         @elseif($user_role_id == 2 || $user_role_id == 3 || $user_role_id == 5 || $user_role_id == 6 || $user_role_id == 7 || $user_role_id == 8 )

                        <div class="d-flex align-items-center">
                            <a href="{{URL::to('consultations')}}">
                            <div class="icon-box lg bg-lime rounded-2 me-3">
                              <i class="ri-stethoscope-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                             <?php
                                   $nbr_patient_nt=DB::table('tbl_consultation')
                                          ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                                          ->where('etat_traitement',0)
                                          ->where([
                                              ['tbl_consultation.user_id',$user_id],
                                              ['id_centre',$centre_id],
                                          ])
                                          ->count();
                              ?>
                              <h2 class="m-0 lh-1">{{$nbr_patient_nt}}</h2>


                              <p class="m-0"> Patients non traité </p>
                            <?php  ?>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('consultations')}}">
                            <div class="icon-box lg bg-peach rounded-3 me-3">
                              <i class="ri-walk-line fs-4"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_patient_t=DB::table('tbl_consultation')
                                  ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                                  ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                                  ->where([
                                        ['tbl_consultation.user_id',$user_id],
                                        ['tbl_prise_en_charge.id_centre',$centre_id],
                                        ['etat_hospitalisation',1],
                                    ])
                                  ->DISTINCT('tbl_prise_en_charge.patient_id')
                                  ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$nbr_patient_t}}</h2>
                              <p class="m-0"> Patients traités  </p>
                            <?php  ?>
                            </div>
                          </div>
                        @elseif($user_role_id == 4)

                        <div class="d-flex align-items-center">
                            <a href="{{URL::to('gestion-analyses')}}">
                            <div class="icon-box lg bg-white rounded-2 me-3">
                              <i class="ri-syringe-line fs-1 text-danger"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                             <?php
                                   $nbr_analyse_nt=DB::table('tbl_analyse')
                                          ->where('statut_analyse',0)
                                          ->where([
                                              ['user_id',$user_id],
                                              ['id_centre',$centre_id],
                                          ])
                                          ->count();
                              ?>
                              <h2 class="m-0 lh-1">{{$nbr_analyse_nt}}</h2>


                              <p class="m-0"> Analyses en attente </p>
                            <?php  ?>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <a href="{{URL::to('gestion-analyses')}}">
                            <div class="icon-box lg bg-lime rounded-3 me-3">
                              <i class="ri-verified-badge-line fs-4 lh-1"></i>
                            </div>
                            </a>
                            <div class="d-flex flex-column">
                            <?php
                                $nbr_analyse_t=DB::table('tbl_analyse')
                                          ->where('statut_analyse',1)
                                          ->where([
                                              ['user_id',$user_id],
                                              ['id_centre',$centre_id],
                                          ])
                                          ->count();
                            ?>
                              <h2 class="m-0 lh-1">{{$nbr_analyse_t}}</h2>


                              <p class="m-0"> Analyses Effectuées  </p>
                            <?php  ?>
                            </div>
                          </div>
                           @elseif($user_role_id == 10)

                        <div class="mt-4 d-flex gap-3">
                          <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-arctic rounded-3 me-3">
                              <i class="ri-surgical-mask-line fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                              @php
                                  $nbre_patie_jr=DB::table('tbl_analyse')
                                              ->where('statut_analyse',1)
                                              ->whereDate('created_at', '=',
                                              date('Y-m-d'))
                                              ->count()
                              @endphp
                              <h2 class="m-0 lh-1">{{$nbre_patie_jr}}</h2>
                              <p class="m-0">Patients</p>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-lime rounded-3 me-3">
                              <i class="ri-lungs-line fs-4"></i>
                            </div>
                            <div class="d-flex flex-column">
                              <h2 class="m-0 lh-1">3</h2>
                              <p class="m-0">Opérations</p>
                            </div>
                          </div>
                          <div class="d-flex align-items-center">
                            <div class="icon-box lg bg-peach rounded-3 me-3">
                              <i class="ri-walk-line fs-4"></i>
                            </div>
                            @php
                                $patient_trait_jr=DB::table('tbl_consultation')
                                          ->where('etat_traitement',1)
                                          // ->where('user_id',$user_id)
                                          ->whereDate('conslt_created_at','=',
                                          date('Y-m-d'))
                                          ->count();
                            @endphp
                            <div class="d-flex flex-column">
                              <h2 class="m-0 lh-1">{{$patient_trait_jr}} </h2>
                              <p class="m-0">Traité</p>
                            </div>
                          </div>
                        </div>


                        @endif


                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
            <!-- Row ends -->

            <!-- Row ends -->
            @if ($user_role_id==10 )
              <!-- Row starts -->
              <div class="row gx-3">
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="p-2 border border-success rounded-circle me-3">
                          <div class="icon-box md bg-success-subtle rounded-5">
                            <i class="ri-surgical-mask-line fs-4 text-success"></i>
                          </div>
                        </div>
                        @php
                            $nbr_patien_moi=DB::table('tbl_patient')
                                          ->whereMonth('pcreated_at', '=',
                                          date('m'))
                                          ->whereYear('pcreated_at', '=',
                                          date('Y'))
                                          ->count();
                        @endphp
                        <div class="d-flex flex-column">
                          <h2 class="lh-1">{{$nbr_patien_moi}}</h2>
                          <p class="m-0">Nouveaux Patients</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-end justify-content-between mt-1">
                        <a class="text-success" href="javascript:void(0);">
                          <span>Tout voir</span>
                          <i class="ri-arrow-right-line text-success ms-1"></i>
                        </a>
                        <div class="text-end">
                          <p class="mb-0 text-success">+40%</p>
                          <span class="badge bg-success-subtle text-success small">Ce mois</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="p-2 border border-primary rounded-circle me-3">
                          <div class="icon-box md bg-primary-subtle rounded-5">
                            <i class="ri-lungs-line fs-4 text-primary"></i>
                          </div>
                        </div>
                        @php
                            $patient_trait_moi=DB::table('tbl_consultation')
                                        ->whereMonth('conslt_created_at', '=',
                                        date('m'))
                                        ->whereYear('conslt_created_at', '=',
                                        date('Y'))
                                        ->where('etat_traitement', 1)
                                        ->count();
                        @endphp
                        <div class="d-flex flex-column">
                          <h2 class="lh-1">{{$patient_trait_moi}} </h2>
                          <p class="m-0">Patients traités</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-end justify-content-between mt-1">
                        <a class="text-primary" href="javascript:void(0);">
                          <span>Tout voir</span>
                          <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <div class="text-end">
                          <p class="mb-0 text-primary">+30%</p>
                          <span class="badge bg-primary-subtle text-primary small">this month</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @elseif ($user_role_id == 10 || $user_role_id == 4)
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="p-2 border border-danger rounded-circle me-3">
                          <div class="icon-box md bg-danger-subtle rounded-5">
                            <i class="ri-microscope-line fs-4 text-danger"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <h2 class="lh-1">980</h2>
                          <p class="m-0">Analyses effectuées</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-end justify-content-between mt-1">
                        <a class="text-danger" href="javascript:void(0);">
                          <span>Tout voir</span>
                          <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <div class="text-end">
                          <p class="mb-0 text-danger">+60%</p>
                          <span class="badge bg-danger-subtle text-danger small">Ce mois</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @elseif($user_role_id == 10)
                <div class="col-xl-3 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex align-items-center">
                        <div class="p-2 border border-warning rounded-circle me-3">
                          <div class="icon-box md bg-warning-subtle rounded-5">
                            <i class="ri-money-dollar-circle-line fs-4 text-warning"></i>
                          </div>
                        </div>
                        <div class="d-flex flex-column">
                          <h2 class="lh-1">$98000</h2>
                          <p class="m-0">Total Earnings</p>
                        </div>
                      </div>
                      <div class="d-flex align-items-end justify-content-between mt-1">
                        <a class="text-warning" href="javascript:void(0);">
                          <span>View All</span>
                          <i class="ri-arrow-right-line ms-1"></i>
                        </a>
                        <div class="text-end">
                          <p class="mb-0 text-warning">+20%</p>
                          <span class="badge bg-warning-subtle text-warning small">this month</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row ends -->

              <!-- Row starts -->
              <div class="row gx-3">
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-verified-badge-line fs-4 lh-1"></i>
                        </div>
                        <h6>Rendez-vous</h6>
                        <h2 class="text-primary m-0">639</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-stethoscope-line fs-4 lh-1"></i>
                        </div>
                        <h6>Docteurs</h6>
                        <h2 class="text-primary m-0">83</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-psychotherapy-line fs-4 lh-1"></i>
                        </div>
                        <h6>Personnel</h6>
                        <h2 class="text-primary m-0">296</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-lungs-line fs-4 lh-1"></i>
                        </div>
                        <h6>Operations</h6>
                        <h2 class="text-primary m-0">49</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-hotel-bed-line fs-4 lh-1"></i>
                        </div>
                        <h6>Hospitalisés</h6>
                        <h2 class="text-primary m-0">372</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xl-2 col-sm-6 col-12">
                  <div class="card mb-3">
                    <div class="card-body">
                      <div class="d-flex flex-column align-items-center">
                        <div class="icon-box md rounded-5 bg-primary mb-3">
                          <i class="ri-walk-line fs-4 lh-1"></i>
                        </div>
                        <h6>Libérés</h6>
                        <h2 class="text-primary m-0">253</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Row ends -->

             @elseif($user_role_id ==0 || $user_role_id == 13)

            <div class="row gx-3">
              <div class="col-xxl-6 col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Hospitalisations
                    <a href="{{route('room.index')}}" class="float-right btn btn-warnig">
                      <span class="badge rounded-pill bg-success"><i class="ri-menu-line"></i></span>
                      <i class="ri-hotel-bed-line"></i>
                    </a>
                    </h5>
                    <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="badge rounded-pill bg-warning">+</span>
                    <i class="ri-hotel-bed-line"></i>
                    </button>


                  </div>
                  <div class="card-body">
                    <div id="carouselSurgeries" class="carousel slide carousel-fade" data-bs-ride="carousel">
                      <div class="carousel-inner">

                      <?php
                        $rooms=DB::table('tbl_chambre')
                              ->where('id_centre',$centre_id)
                              ->get()
                      ?>
                      @foreach($rooms as $key => $v_room)

                      <?php

                        $nbre_lits=DB::table('tbl_lits')
                              ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                              ->where('tbl_lits.id_chambre',$v_room->id_chambre)
                              ->where('id_centre',$centre_id)
                              ->select('tbl_chambre.*','tbl_lits.*')
                              ->count();

                        $nbre_lits_libre=DB::table('tbl_lits')
                              ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                              ->where('tbl_lits.id_chambre',$v_room->id_chambre)
                              ->where([
                                    ['tbl_lits.statut',0],
                                    ['id_centre',$centre_id],
                                ])

                              ->select('tbl_chambre.*','tbl_lits.*')
                              ->count();
                      ?>


                      <div class="carousel-item {{$key == 0 ? 'active' : ''}}" data-bs-interval="3000">
                          <div class="grid gap-2 p-1">
                            <div class="g-col-12">
                              <div class="border rounded-2 p-3 mh-100">
                                <div class="d-flex align-items-start">
                                  <div class="icon-box lg rounded-3
                                  <?php
                                  if($nbre_lits == $nbre_lits_libre)
                                  {
                                    echo 'bg-success-subtle text-success';
                                  }elseif ($nbre_lits_libre > 1) {
                                    echo 'bg-warning-subtle text-warning';
                                  }else{
                                    echo 'bg-danger-subtle text-danger';
                                  }
                                  ?> ">
                                  <div class="d-flex flex-column text-center">
                                      <p class="m-0">CH</p>
                                      <h3 class="m-0">{{$v_room->libelle_chambre}}</h3>
                                    </div>
                                  </div>
                                  <div class="ms-3">
                                    <h6 class="mb-1"><span class="badge border

                                  <?php
                                  if($nbre_lits == $nbre_lits_libre)
                                  {
                                    echo 'border-success text-success';
                                  }elseif ($nbre_lits_libre > 1) {
                                    echo 'border-warning text-warning';
                                  }else{
                                    echo 'border-danger text-danger';
                                  }
                                  ?> ">


                                  <?php
                                  if($nbre_lits == $nbre_lits_libre)
                                  {
                                    echo 'Libre';
                                  }elseif ($nbre_lits_libre > 1) {
                                    echo 'Occupée';
                                  }else{
                                    echo 'Indisponible';
                                  }
                                  ?></span></h6>

                                  <p class="mb-1">Lits dispo</p>
                                  <span class="badge
                                  <?php
                                  if($nbre_lits == $nbre_lits_libre)
                                  {
                                    echo 'bg-success';
                                  }elseif ($nbre_lits_libre > 1) {
                                    echo 'bg-warning';
                                  }else{
                                    echo 'bg-danger';
                                  }
                                  ?>">{{$nbre_lits_libre}} </span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php ?>
                          </div>
                        </div>
                        @endforeach
                      <?php ?>
                      </div>
                      <div class="carousel-custom-btns">
                        <button class="carousel-control-prev btn text-danger" type="button"
                          data-bs-target="#carouselSurgeries" data-bs-slide="prev">
                          <i class="ri-arrow-left-s-line fs-2 lh-1"></i>
                        </button>
                        <button class="carousel-control-next btn text-danger" type="button"
                          data-bs-target="#carouselSurgeries" data-bs-slide="next">
                          <i class="ri-arrow-right-s-line fs-2 lh-1"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               <div class="col-xxl-6 col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Patients en attente d'hospitalisation
                    <a href="{{URL::to('/prises-en-charges')}}" class="float-right btn btn-secondary">
                    <span class="badge rounded-pill bg-warning">  <i class="ri-stethoscope-line"></i></span></a>
                    </h5>
                  </div>
                  <div class="card-body">

                  <div class="g-col-12">
                  <?php
                    $all_patient_h=DB::table('tbl_consultation')
                    ->join('tbl_prise_en_charge','tbl_consultation.id_prise_en_charge','=','tbl_prise_en_charge.id_prise_en_charge')
                    ->join('tbl_patient','tbl_prise_en_charge.patient_id','=','tbl_patient.patient_id')
                    ->where('is_hospitalisation',1)
                    ->where([
                          ['id_lit',null],
                          ['tbl_prise_en_charge.id_centre',$centre_id],
                      ])
                    ->select('tbl_prise_en_charge.*','tbl_patient.*','tbl_consultation.*')
                    ->groupBy('tbl_prise_en_charge.patient_id')
                    ->orderBy('etat_consultation','DESC')
                    ->get();
                  ?>
                  <div class="table-responsive">
                    <table class="table m-0 align-middle">
                    <thead>
                      <tr>

                        <th>Patient</th>
                        <th>Mal/Maux</th>
                        <th>Spécialiste actuel</th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody>
                    @foreach($all_patient_h as $v_consulted)
                      <tr>

                        <td>{{$v_consulted->nom_patient}}
                        {{$v_consulted->prenom_patient}}</td>
                        <td>{{$v_consulted->maux}}</td>

                        <?php
                        $all_special=DB::table('users')
                              ->join('personnel','users.email','=','personnel.email')
                              ->join('user_roles','users.user_role_id','=','user_roles.user_role_id')
                              ->join('tbl_consultation','users.user_id','=','tbl_consultation.user_id')
                              ->select('users.*','personnel.*','user_roles.*','tbl_consultation.*')
                              ->where('users.user_id',$v_consulted->last_consult_user_id)
                              ->where('users.id_centre',$centre_id)
                              ->first();
                        ?>
                        <td>
                          {{$all_special->designation}}. {{$all_special->prenom}} {{$all_special->nom}}
                        </td>

                        <td>

                           <form action="{{url('hospitaliser')}}" method="POST">
                                {{csrf_field()}}
                           <input type="hidden" name="id_consultation" value="{{$v_consulted->id_consultation}}">
                            <select id="myDropdown" class="form-select btn btn-outline" name="id_lit">
                              <option selected>Vers</option>
                             <optgroup label="Chambre Ordinaire libre">

                            <?php

                              $all_lists=DB::table('tbl_lits')
                              ->join('tbl_chambre','tbl_lits.id_chambre','=','tbl_chambre.id_chambre')
                              ->where('tbl_lits.statut',0)
                              ->where([
                                      ['id_centre',$centre_id],
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
                                      ['id_centre',$centre_id],
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
                          <?php ?>
                          </tr>
                        @endforeach
                        </tbody>
                      </table>
                      <?php ?>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
                 
            @elseif($user_role_id == 2 || $user_role_id == 3 || $user_role_id == 4 || $user_role_id == 5 || $user_role_id == 6 || $user_role_id == 7 || $user_role_id == 8 )
            @elseif($user_role_id == 9 || $user_role_id == 1)
            <div class="row">
               <div class="col-xxl-6 col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Ventes Mensuelles</h5>
                  </div>
                  <div class="card-body">
                    <div id="lineChartbarMens"></div>
                  </div>
                </div>
              </div>

              <div class="col-xxl-6 col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Ratio des ventes</h5>
                  </div>
                  <div class="card-body">
                    <div id="ratio_chart"></div>
                  </div>
                </div>
              </div>
            </div>


              <div class="col-xxl-12 col-sm-12">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Ventes annuelles</h5>
                  </div>
                  <div class="card-body">
                    <div id="lineChatbarAn"></div>
                  </div>
                </div>
              </div>


            @endif
      </div>
            <!-- Row ends -->
            <!-- Row starts -->
      {{-- <div class="row gx-3">
        <div class="col-sm-12">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="card-title">Appointments</h5>
            </div>
            <div class="card-body">

              <!-- Table starts -->
              <div class="table-outer">
                <div class="table-responsive">
                  <table class="table m-0 align-middle">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Consulting Doctor</th>
                        <th>Department</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Disease</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>001</td>
                        <td>
                          Deena Cooley
                        </td>
                        <td>65</td>
                        <td>
                          <img src="{{asset('assets/images/user.png')}}" class="img-shadow img-2x rounded-5 me-1"
                            alt="Hospital Admin Template">
                          Vicki Walsh
                        </td>
                        <td>Surgeon</td>
                        <td>05/23/2024</td>
                        <td>9:30AM</td>
                        <td>Diabeties</td>
                        <td>
                          <div class="d-inline-flex gap-1">
                            <button class="btn btn-success btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Accepted">
                              <i class="ri-checkbox-circle-line"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Reject" disabled>
                              <i class="ri-close-circle-line"></i>
                            </button>
                            <a href="edit-appointment.html" class="btn btn-outline-info btn-sm"
                              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                              <i class="ri-edit-box-line"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>002</td>
                        <td>
                          Jerry Wilcox
                        </td>
                        <td>73</td>
                        <td>
                          <img src="{{asset('assets/images/user1.png')}}" class="img-shadow img-2x rounded-5 me-1"
                            alt="Hospital Admin Template">
                          April Gallegos
                        </td>
                        <td>Gynecologist</td>
                        <td>05/23/2024</td>
                        <td>9:45AM</td>
                        <td>Fever</td>
                        <td>
                          <div class="d-inline-flex gap-1">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Accept" disabled>
                              <i class="ri-checkbox-circle-line"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top"
                              data-bs-title="Rejected">
                              <i class="ri-close-circle-line"></i>
                            </button>
                            <a href="edit-appointment.html" class="btn btn-outline-info btn-sm"
                              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                              <i class="ri-edit-box-line"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>003</td>
                        <td>
                          Eduardo Kramer
                        </td>
                        <td>84</td>
                        <td>
                          <img src="{{asset('assets/images/user2.png')}}" class="img-shadow img-2x rounded-5 me-1"
                            alt="Hospital Admin Template">
                          Basil Frost
                        </td>
                        <td>Psychiatrists</td>
                        <td>05/23/2024</td>
                        <td>10:00AM</td>
                        <td>Cold</td>
                        <td>
                          <div class="d-inline-flex gap-1">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Accept">
                              <i class="ri-checkbox-circle-line"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Reject">
                              <i class="ri-close-circle-line"></i>
                            </button>
                            <a href="edit-appointment.html" class="btn btn-outline-info btn-sm"
                              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                              <i class="ri-edit-box-line"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>004</td>
                        <td>
                          Jason Compton
                        </td>
                        <td>56</td>
                        <td>
                          <img src="{{asset('assets/images/user4.png')}}" class="img-shadow img-2x rounded-5 me-1"
                            alt="Hospital Admin Template">
                          Nannie Guerrero
                        </td>
                        <td>Urologist</td>
                        <td>05/23/2024</td>
                        <td>10:15AM</td>
                        <td>Prostate</td>
                        <td>
                          <div class="d-inline-flex gap-1">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Accept">
                              <i class="ri-checkbox-circle-line"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Reject">
                              <i class="ri-close-circle-line"></i>
                            </button>
                            <a href="edit-appointment.html" class="btn btn-outline-info btn-sm"
                              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                              <i class="ri-edit-box-line"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                      <tr>
                        <td>005</td>
                        <td>
                          Emmitt Bryan
                        </td>
                        <td>49</td>
                        <td>
                          <img src="{{asset('assets/images/user5.png')}}" class="img-shadow img-2x rounded-5 me-1"
                            alt="Hospital Admin Template">
                          Daren Andrade
                        </td>
                        <td>Cardiology</td>
                        <td>05/23/2024</td>
                        <td>10:30AM</td>
                        <td>Asthma</td>
                        <td>
                          <div class="d-inline-flex gap-1">
                            <button class="btn btn-outline-success btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Accept">
                              <i class="ri-checkbox-circle-line"></i>
                            </button>
                            <button class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip"
                              data-bs-placement="top" data-bs-title="Reject">
                              <i class="ri-close-circle-line"></i>
                            </button>
                            <a href="edit-appointment.html" class="btn btn-outline-info btn-sm"
                              data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Appointment">
                              <i class="ri-edit-box-line"></i>
                            </a>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Table ends -->

            </div>
          </div>
        </div>
        <div class="col-xxl-6 col-sm-12">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="card-title">Income</h5>
            </div>
            <div class="card-body">
              <div id="income"></div>
            </div>
          </div>
        </div>
        <div class="col-xxl-6 col-sm-12">
          <div class="card mb-3">
            <div class="card-header">
              <h5 class="card-title">Pharmacy Orders</h5>
            </div>
            <div class="card-body">
              <div id="orders"></div>
            </div>
          </div>
        </div>
      </div> --}}
      <!-- Row ends -->
    </div>
  <!-- App body ends -->

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">
            Ajouter une chambre d'hospitalisation
          </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
      <form onsubmit="confirm('Cliquer OK pour confirmer')" class="row" action="{{ url('/save-chambre') }}" method="POST">
          {{csrf_field()}}
        <div class="col-md-12 mb-3">
        <label for="validationServer07">Numéro de chambre</label>
          <input id="" type="number" class="form-control border-success" id="validationServer07" name="libelle_chambre">
          <div class="text-success small mt-1">
           
          </div>
        </div>

          <div class="col-md-12 mb-3">
        <label for="validationServer07">Services</label>
          <select class="form-control" name="service">
            @php
                $all_services = DB::table('services')
                              ->where('centre_id',$centre_id)
                              ->get();
            @endphp
            <option value="">------</option>
                @foreach($all_services as $serv_room)
            <option value="{{ $serv_room->services_id }}"> {{ $serv_room->service }}</option>
                 @endforeach
          </select>
          <div class="text-success small mt-1">
            
          </div>
        </div>

        <div class="col-md-12 mb-3">
        <label for="validationServer07">Nombre de lits</label>
          <input id="" type="number" class="form-control border-success" id="validationServer07" name="nbre_lit">
          <div class="text-success small mt-1">
          
          </div>
        </div>

        <div class="col-md-12 mb-3">
        <label for="validationServer07">Type de chambre</label>
          <select class="form-control" name="type_chambre">
            <option value="H/F">Homme / Femme</option>
            <option value="H">Homme</option>
            <option value="F">Femme</option>
          </select>
          <div class="text-success small mt-1">
            
          </div>
        </div>
        <label>Chambre VIP ?</label>
        <div class="card mb-3">
          <div class="card-body">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_vip" id="inlineRadio2"
                value="option2" checked="">
              <label class="form-check-label" for="inlineRadio2">Non</label>
            </div>
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="is_vip" id="inlineRadio3"
                value="option3" disabled="">
              <label class="form-check-label" for="inlineRadio3">Oui</label>
            </div>
          </div>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
            Fermer
          </button>
          <button type="submit" class="btn btn-primary">
            Enregistrer
          </button>
        </div>
      </form>
      </div>
    </div>
  </div>

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      $("select#myDropdown").change(function(){
      if(confirm('Cliquez OK pour hospitaliser le patient dans la chambre sélectionnée')){
          {this.form.submit()}
      }
      else $("select option:selected").prop("selected", false);
    });
    </script>
    </script>


    

@endsection

<script type="text/javascript">
                             
    var barMens = <?php echo $barMens; ?>;
    console.log(barMens);
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable(barMens);

    var options = {
            colors: ['#9E6DE0'],
            animation: {
            duration: 1000,

            startup: true //This is the new option
            },        title: 'Ventes mensulles de la pharmacie ',

                                      curveType: 'function',
                                      legend: { position: 'bottom' }
                                    };
                                    var chart = new google.visualization.BarChart(document.getElementById('lineChartbarMens'));
                                    chart.draw(data, options);
                                  }
      
  </script> 


  <script type="text/javascript">
                             
    var barAn = <?php echo $barAn; ?>;
    console.log(barAn);
    google.charts.load('current', {'packages':['corechart'],language:'en'});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
    var data = google.visualization.arrayToDataTable(barAn);
    var options = {
      
            colors: ['#46C79E'],
            animation: {
             duration: 1000,
            startup: true //This is the new option
            },                
            title: 'Ventes annuelles ',
              curveType: 'function',
                legend: { position: 'bottom' }
                                    };
                                    var chart = new google.visualization.ColumnChart(document.getElementById('lineChatbarAn'));
                                    chart.draw(data, options);
                                  }
      
  </script> 

  <script type="text/javascript">
      var ratio = "";
      var ratio = <?php echo $ratio; ?>

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart()
      {
          var data = google.visualization.arrayToDataTable(ratio);
          var options = {
            is3D: true,
               animation: {
                  duration: 1000,
                  startup: true //This is the new option
              },
              title : 'Ratio Ventes par rayons'
          };
          var chart = new google.visualization.PieChart(document.getElementById('ratio_chart'));
          chart.draw(data, options);
      }
</script> 

@endsection
