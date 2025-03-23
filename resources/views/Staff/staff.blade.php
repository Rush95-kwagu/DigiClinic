@extends('layout')
@section('user_content')
@section('title')
Espace du personnel
@endsection
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
                <div class="card">
                  <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title">Liste du personnel</h5>
                    <a href="{{route('personnel.create')}}" class="btn btn-primary ms-auto">Ajouter</a>
                  </div>
                  <div class="card-body">

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="basicExample" class="table m-0 align-middle">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Nom</th>
                            <th>Désignation</th>
                            <th>Téléphone</th>
                            <th>Email</th>
                            <th>Date de Naissance</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                        @php
                          $personnels = DB::table('personnel')
                                      ->get();
                          $services = DB::table('services')
                                      ->get();
                        @endphp
                            @foreach ($personnels as $personnel)


                          <tr>
                            <td>{{$personnel->id}}</td>
                            
                            <td>
                             
                                  @if($personnel->sexe == 'F')
                                  <img src="{{asset('frontend/F.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                    alt="Doctors Admin Template">
                                  @else
                                   <img src="{{asset('frontend/M.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                    alt="Doctors Admin Template">
                                  @endif
                             {{$personnel->nom}} {{$personnel->prenom}}

                            </td>
                            <td>{{$personnel->qualification}}</td>
                            <td>
                              {{$personnel->telephone}}
                            </td>
                            <td>{{$personnel->email}}</td>
                            <td>{{$personnel->birthdate}}</td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                  data-bs-target="#delRow">
                                  <i class="ri-delete-bin-line"></i>
                                </button>
                                <a href="{{route('personnel.edit',$personnel->id)}}" class="btn btn-outline-success btn-sm"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Staff Member">
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
                              Confirm
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete the staff member?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <button class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                aria-label="Close">No</button>
                              <button class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Yes</button>
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
