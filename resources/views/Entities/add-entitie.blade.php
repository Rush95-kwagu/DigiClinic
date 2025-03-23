@extends('layout')
@section('title')
    Admin
@endsection
@section('user_content')
<?php
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>


          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Ajouter une nouvelle entité</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                       <form action="{{route('entities.store')}}" method="POST">
                              @csrf
                        <div class="mb-3">
                          <label class="form-label" for="nom_entite">Nom de l'entité<span
                            class="text-danger">*</span></label>
                          
                          <input type="text" class="form-control" name="nom_entite" id="nom_entite" placeholder="Entrez le nom de l'entité" required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="chef_service">Directeur de la clinique<span
                            class="text-danger">*</span></label>
                          <select class="form-select"  id="personnel_id" name="directeur" required>
                            @php
                                $personnel = DB::table('personnel')->get();
                            @endphp
                            <option value="">---Identité du Directeur---</option>
                                @foreach($personnel as $chef_serv)
                                    <option value="{{ $chef_serv->id }}">Dr. {{ $chef_serv->nom }} {{ $chef_serv->prenom }}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                 
                     <div class="col-xxl-3 col-lg-4 col-sm-6">
                      <label class="form-label" for="a1"><span
                            class="text-danger"></span></label>
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="{{ route('entities.index') }}" class="btn btn-outline-secondary">
                            Annuler
                          </a>
                          <button type="submit" class="btn btn-primary">
                            Créer l'entité
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
