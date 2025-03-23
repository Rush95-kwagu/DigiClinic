@extends('layout')
@section('service content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Entités</h5>
                  </div>
                  <div class="card-body">

                    <div class="chart-height-lg">
                      <div id="total-department" class="auto-align-graph"></div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="card mb-3">
                  <div class="card-header">
                    <h5 class="card-title">Centres</h5>
                  </div>
                  <div class="card-body">

                    <div class="chart-height-lg">
                      <div id="employees" class="auto-align-graph"></div>
                    </div>

                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Department List</h5>
                    <a href="{{ route('entities.add') }}" class="btn btn-primary ms-auto">Créer une nouvelle entité</a>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="basicExample" class="table m-0 align-middle">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nom de la Clinique</th>
                            <th>Directeur de la clinique</th>
                           
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php
                          $all_entities = DB::table('tbl_entite')
                                     ->join('personnel', 'tbl_entite.directeur', '=', 'personnel.id')
                                     ->select('tbl_entite.*', 'personnel.nom as directeur_nom', 'personnel.prenom as directeur_prenom')
                                     ->get();
                        @endphp
                        @foreach($all_entities as $entitie)
                          
                      <tr>
                            <td>{{ $entitie->id_entite }}</td>
                            <td>{{ $entitie->nom_entite }}</td>
                            <td>
                              <img src="{{ asset('frontend/images/user.png') }}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Doctors Admin Template">
                           <a href="{{ route('entitie.directeur.show',['id' => $entitie->directeur, 'nom' => $entitie->directeur_nom, 'prenom' => $entitie->directeur_prenom])  }}">  {{ $entitie->directeur_nom }} {{ $entitie->directeur_prenom }}</a> 
                            </td>
                           
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal"
                                  data-bs-target="#delRow">
                                  <i class="ri-delete-bin-line"></i>
                                </button>
                                <a href="edit-department.html" class="btn btn-outline-success btn-sm rounded-5"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Department">
                                  <i class="ri-edit-box-line"></i>
                                </a>
                              </div>
                            </td>
                          </tr>
                            @endforeach
                          
                        </tbody>
                      </table>
                    </div>
                    <!-- Table ends -->

                    <!-- Modal Delete Row -->
                    <div class="modal fade" id="delRow" tabindex="-1" aria-labelledby="delRowLabel" aria-hidden="true">
                      <div class="modal-dialog modal-sm">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="delRowLabel">
                              Confirmation
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Voulez-vous vraiment supprimer la {{ $entitie->nom_entite  }} ?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <a href="departments-list.html" class="btn btn-secondary" data-bs-dismiss="modal"
                                aria-label="Close">No</a>
                              <a href="departments-list.html" class="btn btn-danger" data-bs-dismiss="modal"
                                aria-label="Close">Yes</a>
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

   @endsection