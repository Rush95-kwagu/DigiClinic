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
                    <h5 class="card-title">Créer un nouveau centre</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                       <form action="{{route('centers.store')}}" method="POST">
                              @csrf
                        <div class="mb-3">
                          <label class="form-label" for="id_entite">Entité principale<span
                            class="text-danger">*</span></label>
                          <select class="form-select"  id="id_entite" name="id_entite" required>
                            @php
                                $entities = DB::table('tbl_entite')->get();
                            @endphp
                            <option value="">---Rattacher à---</option>
                                @foreach($entities as $entitie_attach)
                                    <option value="{{ $entitie_attach->id_entite }}"> {{ $entitie_attach->nom_entite }}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="nom_centre">Nom du centre<span
                            class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="nom_centre" id="nom_centre" placeholder="Entrez un nom pour le centre" required>
                          
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="id_directeur">Directeur du centre<span
                            class="text-danger">*</span></label>
                           <select class="form-select"  id="id_directeur" name="id_directeur" required>
                            @php
                                $personnel = DB::table('personnel')->get();
                            @endphp
                            <option value="">---Identité du directeur---</option>
                                @foreach($personnel as $directeur_centre)
                                    <option value="{{ $directeur_centre->id }}"> {{ $directeur_centre->nom }} {{ $directeur_centre->prenom }}</option>
                                @endforeach
                          </select>
                          
                        </div>
                      </div>
                 
                     <div class="col-xxl-3 col-lg-4 col-sm-6">
                      <label class="form-label" for="a1"><span
                            class="text-danger"></span></label>
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="{{ route('centers.index') }}" class="btn btn-outline-secondary">
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
