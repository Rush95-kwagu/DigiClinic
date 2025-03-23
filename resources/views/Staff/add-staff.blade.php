@extends('layout')
@section('staff content')
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
                  <div class="card-header">
                    <h5 class="card-title">Ajout d'un membre</h5>
                  </div>
                  @if (session()->has('PersonnalAdded'))
                  <div class="alert alert-success" role="alert">
                    <h4>
                        <i class="ri-check-line me-2"></i>
                        <span>
                            {{session()->get('PersonnalAdded')}}
                        </span>
                    </h4>

                  </div>
                  @endif

                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-sm-12">
                        <div class="bg-light rounded-2 px-3 py-2 mb-3">
                          <h6 class="m-0">Details personnel</h6>
                        </div>
                      </div>
                      <div class="col-xxl-1 col-lg-4 col-sm-6">
                        <div class="mb-3">
                        <form action="{{route('personnel.store')}}" method="POST">
                            @csrf
                          <label class="form-label" for="a7">Titre <span class="text-danger">*</span></label>
                          <select type="text" class="form-select" id="a7" placeholder="Entrez la désignation" name="qualification" required>
                            <option value="Dr">Dr</option>
                            <option value="Inf">Inf</option>
                            <option value="C/se">C/se</option>
                            <option value="Sge-Fm">Sge-Fme</option>
                          </select>
                        </div>
                      </div>
                        
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a1">Prénom (s)<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="a1" placeholder="Entrez le prénom" name="prenom">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Nom <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="a2" placeholder="Entrez le nom"name="nom">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="selectGender1">Sexe <span
                              class="text-danger">*</span></label>
                          <div class="m-0">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexe" id="selectGender1"
                                value="M">
                              <label class="form-check-label" for="selectGender1">Masculin</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexe" id="selectGender2"
                                value="F">
                              <label class="form-check-label" for="selectGender2">Feminin</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-2 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a4">Date de naissance <span class="text-danger">*</span></label>
                          <input type="date" class="form-control" id="a4" placeholder="Date de naissance" name="birthdate">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="phone">Numéro de Téléphone<span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="phone" placeholder="Entres le numéro de téléphone" name="telephone" value="{{ old('telephone') }}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a3">Adresse mail<span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="a3" placeholder="Entres le numéro de téléphone" name="email" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
                                <div class="alert alert-danger">
                                    {{ $errors->first('email') }}
                                </div>
                        @endif
                      </div>
                      
                     
                      {{-- <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a5">Qualification <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="a5" placeholder="Enter Qualification">
                        </div>
                      </div> --}}
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a6">Service d'acceuil <span class="text-danger">*</span></label>
                          <select class="form-select" id="a6" name="service_id">
                            @php
                                $s_acceuil = DB::table('user_roles')->get();
                            @endphp
                            @foreach ($s_acceuil as $service)

                            <option value="{{$service->user_role_id}} "> {{$service->designation}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a6">Fonction <span class="text-danger">*</span></label>
                          <select class="form-select" id="a6" name="specialite">
                            @php
                                $s_acceuil = DB::table('user_roles')->get();
                            @endphp
                            @foreach ($s_acceuil as $service)

                            <option value="{{$service->user_role_id}} "> {{$service->title}}</option>
                            @endforeach
                          </select>
                        </div>
                      </div>
                     

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="departement">Département <span class="text-danger">*</span></label>
                          {{-- <input type="text" class="form-control" id="a9" placeholder="Ville de résidence" name="ville"> --}}
                        <select class="form-select" id="departement" onchange="updateCities()" name="departement">
                                <option value="">--Sélectionner un département--</option>
                                <option value="Alibori">Alibori</option>
                                <option value="Atacora">Atacora</option>
                                <option value="Atlantique">Atlantique</option>
                                <option value="Borgou">Borgou</option>
                                <option value="Collines">Collines</option>
                                <option value="Couffo">Couffo</option>
                                <option value="Donga">Donga</option>
                                <option value="Littoral">Littoral</option>
                                <option value="Mono">Mono</option>
                                <option value="Ouémé">Ouémé</option>
                                <option value="Plateau">Plateau</option>
                                <option value="Zou">Zou</option>
                        </select>


                        </div>
                      </div>

                  {{-- <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a11">State <span class="text-danger">*</span></label>
                          <select class="form-select" id="a11">
                            <option value="0">Select</option>
                            <option value="1">Alabama</option>
                            <option value="2">Alaska</option>
                            <option value="3">Arizona</option>
                            <option value="4">California</option>
                            <option value="5">Florida</option>
                          </select>
                        </div>
                     </div> --}}
                       <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="villes">Ville <span class="text-danger">*</span></label>
                            <select class="form-select" id="villes" name="ville">
                                 <option value=""></option>
                             </select>

                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label" for="a8">Addresse <span class="text-danger">*</span></label>
                          <textarea class="form-control" id="a8" placeholder="Entrez l'addresse" rows="2" name="adresse" required></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="staff.html" class="btn btn-outline-secondary">
                            Annuler
                          </a>
                          <button type="submit" class="btn btn-primary">
                            Ajouter les informations
                          </button>
                        </div>
                      </div>
                    </div>
                    <!-- Row ends -->
                        </form>

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->
@endsection
