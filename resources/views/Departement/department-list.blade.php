@extends('layouts.app')
@section('main content')
      <!-- Main container starts -->
      <div class="main-container">

        <!-- Sidebar wrapper starts -->
        @include('layouts/partials/_sidebar')
        <!-- Sidebar wrapper ends -->

        <!-- App container starts -->
        <div class="app-container">

          <!-- App hero header starts -->
          <div class="app-hero-header d-flex align-items-center">

            <!-- Breadcrumb starts -->
            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <i class="ri-home-8-line lh-1 pe-3 me-3 border-end"></i>
                <a href="index.html">Home</a>
              </li>
              <li class="breadcrumb-item text-primary" aria-current="page">
                Repertoire des services
              </li>
            </ol>
            <!-- Breadcrumb ends -->

            <!-- Sales stats starts -->
            <div class="ms-auto d-lg-flex d-none flex-row">
              <div class="d-flex flex-row gap-1 day-sorting">
                <button class="btn btn-sm btn-primary">Today</button>
                <button class="btn btn-sm">7d</button>
                <button class="btn btn-sm">2w</button>
                <button class="btn btn-sm">1m</button>
                <button class="btn btn-sm">3m</button>
                <button class="btn btn-sm">6m</button>
                <button class="btn btn-sm">1y</button>
              </div>
            </div>
            <!-- Sales stats ends -->

          </div>
          <!-- App Hero header ends -->

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
                    <h5 class="card-title">Répertoire des département</h5>
                    <a href="{{route('departement.create')}}" class="btn btn-primary ms-auto">Ajouter un département</a>
                  </div>
                  <div class="card-body">
                         @if (session()->has('DepartementDeleted'))
                    <div class="alert alert-success" role="alert">
                    {{session()->get('DepartementDeleted')}}
                </div>

                   @endif

                    <!-- Table starts -->
                    <div class="table-responsive">
                      <table id="basicExample" class="table m-0 align-middle">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Type de Département</th>
                            <th>Chef du département</th>
                            <th>Etat du Département</th>
                            <th>Numéro de téléphone</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($alldepartement as $departement)

                          <tr>

                              <td>{{$departement->libelle}}</td>
                            <td>@if(isset($departement->departementGenerale))
    {{ $departement->departementGenerale->libelle }}
@endif

@if(isset($departement->departementSpeciale))
    {{ $departement->departementSpeciale->libelle }}
@endif</td>
                            <td>
                              <img src="assets/images/user.png" class="img-shadow img-2x rounded-5 me-1"
                                alt="Doctors Admin Template">
                                @if(isset($departement->chef))
                                Dr. {{ $departement->chef->name }} {{$departement->chef->prenom}}
                                    @else
                                     Pas de chef de département attribué
                                @endif

                            </td>
                            <td>
                                @if (isset($departement->departementGenerale))

                                {{$departement->departementGenerale->status}}
                                @endif
                                @if (isset($departement->departementSpeciale))

                                {{$departement->departementSpeciale->status}}
                                @endif
                            </td>
                            <td>
                                @if (isset($departement->departementGenerale))
                                {{$departement->departementGenerale->telephone}}
                                @endif
                                @if (isset($departement->departementSpeciale))
                                 {{$departement->departementSpeciale->telephone}} </td>
                                 @endif

                            <td>
                              <div class="d-inline-flex gap-1">

                                    <button class="btn btn-outline-danger btn-sm rounded-5" data-bs-toggle="modal"
                                    data-bs-target="#delRow">
                                    <i class="ri-delete-bin-line"></i>
                                </button>

                                <a href="{{route('departement.edit',$departement->id)}}" class="btn btn-outline-success btn-sm rounded-5"
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
                                  <form action="{{route('departement.destroy',$departement->id)}}" method="POST">
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
