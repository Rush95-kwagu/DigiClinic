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
                    <h5 class="card-title">Données relatives aux services</h5>
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
                    <h5 class="card-title">Données relatives aux employés </h5>
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
                    <h5 class="card-title">Répertoire des services</h5>

                    <a href="{{route('services.create')}}" class="btn btn-primary ms-auto">Créer un nouveau service</a>
                  </div>
                  <div class="card-body">
                    @if (session()->has('ServiceDeleted'))
                    <div class="alert alert-success" role="alert">
                    {{session()->get('ServiceDeleted')}}
                </div>

                   @endif

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="basicExample" class="table m-0 align-middle">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Service</th>
                            {{-- <th>Nombre de chambre</th> --}}
                            <th>Chef service</th>
                            <th>Liste des médécins</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tbody>
                          @php
                            
                             $all_services = DB::table('services')
                                          ->join('personnel', 'services.chef_service','=','personnel.id')
                                          ->select('services.*','personnel.nom as chef_service_nom','personnel.prenom as chef_service_prenom')
                                          ->get();             

                          @endphp
                            @foreach ($all_services as $service)


                          <tr>
                            <td>{{$service->id}}</td>
                            <td>{{$service->service}}</td>
                            
                            <td>
                              <img src="{{asset('frontend/images/user.png')}}" class="img-shadow img-2x rounded-5 me-1"
                                alt="Doctors Admin Template">
                             
                         {{-- Dr. {{ $service->chef_service_prenom }} {{ $service->chef_service_nom }} --}}
                           <a href="{{ route('entitie.directeur.show',['id' => $service->chef_service,
                            'nom' => $service->chef_service_nom, 
                            'prenom' => $service->chef_service_prenom])  }}">  
                            Dr. {{ $service->chef_service_nom }} {{ $service->chef_service_prenom }}</a> 

                            </td>
                            <td>
                              <div class="stacked-images">
                                <img src="{{asset('frontend/F.png')}}" alt="Medical Dashboard">
                                <img src="{{asset('frontend/M.png')}}" alt="Medical Dashboard">
                                <img src="{{asset('frontend/F.png')}}" alt="Medical Dashboard">
                                @php
                                    $doctor = DB::table('')
                                @endphp
                                <span class="plus bg-primary">+5</span>
                              </div>
                            </td>
                            <td>
                              <div class="d-inline-flex gap-1">
                                {{-- <form action="{{route('services.destroy',$service->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                        <button type="submit" class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal"
                                        data-bs-target="#delRow">
                                        <i class="ri-delete-bin-line"></i>
                                        </button>

                                </form> --}}
                                <button class="btn btn-outline-danger btn-sm" data-bs-toggle="modal"
                                  data-bs-target="#delRow">
                                  <i class="ri-delete-bin-line"></i>
                                </button>
                                <a href="{{route('services.edit',$service->id)}}" class="btn btn-outline-success btn-sm rounded-5"
                                  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Modifier les informartions du service">
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
                            Voulez-vous vraiment supprimer ces informations ?
                          </div>
                          <div class="modal-footer">
                            <div class="d-flex justify-content-end gap-2">
                              <a href="#" class="btn btn-secondary" data-bs-dismiss="modal"
                                aria-label="Close">Non</a>
                                  <form action="{{route('services.destroy',$service->id)}}" method="POST">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"
                                            aria-label="Close">Oui</button>
                                        </form>
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
