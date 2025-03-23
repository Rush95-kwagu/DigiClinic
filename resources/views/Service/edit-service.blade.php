@extends('layout')
@section('service content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

          <!-- App Hero header ends -->

          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Modification d'un service</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">

                   @if (session()->has('ServiceUpdated'))
                    <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Informations du service mises à jour</h4>
                    <p>{{session()->get('ServiceUpdated')}}</p>
                    <hr />
                    <p class="mb-0"><a href="{{route('services.index')}}">Retour à la liste</a> </p>
                   </div>
                </div>

                   @endif
                   {{-- @if(session('ServiceCreated'))
                    <script>
                        Swal.fire({
                            title: 'Succès!',
                            text: '{{ session('ServiceCreated') }}',
                            icon: 'success',
                            confirmButtonText: 'OK'
                        });
                    </script>
                    @endif --}}

                        @if (!session()->has('ServiceUpdated'))
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                          <form action="{{route('services.update', $service->id)}}" method="POST">
                             @method('PUT')
                            @csrf
                       
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="name">Libellé du service</label>
                          <input type="text" class="form-control" id="name" name="libelle" value="{{$service->libelle}}" required>
                        </div>
                      </div>
                       <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="specialite">Spécialité</label>
                          <select class="form-select" name="specialite" id="specialite" value="{{$service->specialite}}">
                            <option value="">---Choisir une Spécialité---</option>
                            <option value="Specialité Médicale">Spécialité Médicale</option>
                            <option value="Spécialité Chirurgicale">Spécialité Chirurgicale</option>
                            <option value="Spécialité Paraclinique">Spécialité Paraclinique</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="email">Email du service</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{$service->email}}" required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="telephone">Téléphone du service</label>
                          <input type="text" class="form-control" id="a5" name="telephone" value={{$service->telephone}} required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="chief_service_id">Chef service</label>
                          <select class="form-select"  id="chief_service_id" name="chief_service_id"  required>
                            <option value="">Nommer un chef</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">Dr. {{ $user->name }} {{ $user->prenom }}</option>
                                @endforeach
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="room_number">Nombre de chambre</label>
                         <input type="text" class="form-control" name="room_number" value="{{$service->room_number}}">
                        </div>
                      </div>

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="inlineRadio1">Fonctionnel</label>
                          <div class="m-0">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Fonctionnel" name="status" id="inlineRadio1">
                              <label class="form-check-label" for="inlineRadio1">Oui</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" value="Non fonctionnel" name="status" id="inlineRadio2">
                              <label class="form-check-label" for="inlineRadio2">Non</label>
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
                            Annuler les modifications
                          </a>
                          <button type="submit" class="btn btn-primary">
                            Sauvegarder les Modifications
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
