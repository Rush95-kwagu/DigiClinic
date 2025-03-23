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
                Add Department
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
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Création d'un département</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">

                   @if (session()->has('DepartementCreated'))
                   <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Département Ajouté</h4>
                    <p>{{session()->get('DepartementCreated')}}</p>
                    <hr />
                    <p class="mb-0"><a href="{{route('departement.index')}}">Retour à la liste</a> </p>
                   </div>

                </div>


                   @endif
                        @if (!session()->has('DepartementCreated'))
                        <div class="col-xxl-3 col-lg-4 col-sm-6">

                          <form action="{{route('departement.update',$departement->id)}}" method="POST">
                              @csrf

                        <div class="mb-3">
                          <label class="form-label" for="code_depart">Code du département</label>
                        <input type="text" class="form-control" id="code_depart" name="code_depart" value="{{$departement->code_depart}}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="libelle">Libelle du département</label>
                       <select class="form-select"  id="libelle" name="libelle" value="{{$departement->libelle}}" >
                            <option value="">---Selectionner----</option>
                            <option value="Médecine Générale">Médécine Générale</option>
                            <option value="" disabled >Médecine Spéciale</option>
                            <option value="Spécialités Médicales">Spécialités Médicales</option>
                            <option value="Spécialités Chirurgicales">Spécialités Chirurgicales</option>
                            <option value="Spécialités Paracliniques">Spécialités Paracliniques</option>
                            <option value="Pharmacie">Pharmacie</option>
                            <option value="Caisse">Caisse</option>
                        </select>
                        </div>
                        </div>

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="chef_departement_id">Le chef du département</label>
                          <select class="form-select"  id="chef_departement_id" name="chef_departement_id">
                            <option value="">Nommer un chef</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">Dr. {{ $user->name }} {{ $user->prenom }}</option>
                                @endforeach
                          </select>

                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="telephone">Téléphone du département</label>
                          <input type="text" class="form-control" id="a5" name="telephone" placeholder="Entrez le téléphone du département" value="{{$departement->email}}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="email">Email du département</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="Entrez l'email' du département" value="{{$departement->email}}">
                        </div>
                      </div>

                      {{-- <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="service_id">Choisir un service</label>
                        <select class="form-select"  id="service_id" name="service_id" >
                    <option value=""></option>
                            @foreach ($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>

                            @endforeach
                        </select>
                            </div>
                            </div> --}}


                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="inlineRadio1">Etat</label>
                          <div class="m-0">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Fonctionnel" name="status" id="inlineRadio1">
                              <label class="form-check-label" for="inlineRadio1">Fonctionnel</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Non fonctionnel" name="status" id="inlineRadio2">
                              <label class="form-check-label" for="inlineRadio2">Non Fonctionnel</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      {{-- <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label" for="a7">Message</label>
                          <textarea class="form-control" id="a7" placeholder="Enter message" rows="3"></textarea>
                        </div>
                      </div> --}}
                      <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="departments-list.html" class="btn btn-outline-secondary">
                            Annuler
                          </a>
                          <button type="submit" class="btn btn-primary">
                            Créer le départment
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- Row ends -->
                </form>


                        @endif
                </div>
            </div>
        </div>
    </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->

@endsection
