@extends('layout')

@section('add service content')

@php
$user_role_id=Session::get('user_role_id');
$user_id=Session::get('user_id');
$centre_id=Session::get('centre_id')
  
@endphp


          <!-- App body starts -->
          <div class="app-body">

            <!-- Row starts -->
            <div class="row gx-3">
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5 class="card-title">Informations relatives au nouveau service</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">

                      @if (session()->has('ServiceCreated'))
                      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                      <script>
                          document.addEventListener('DOMContentLoaded', function () {
                              Swal.fire({
                                  title: 'Service créé avec succès',
                                  text: 'Voulez-vous ajouter un autre ?',
                                  icon: 'success',
                                  showCancelButton: true,
                                  confirmButtonText: 'Oui',
                                  cancelButtonText: 'Non',
                                  reverseButtons: true,
                                  confirmButtonColor: '#28a745',
                                  cancelButtonColor: '#dc3545'
                              }).then((result) => {
                                  if (!result.isConfirmed) {
                                      window.location.href = "{{ route('services.index') }}";
                                  }
                                  
                              });
                          });
                      </script>
                 
                  
                </div>

                   @endif
                  

                        @if (!session()->has('ServiceCreated'))
                        <div class="col-xxl-3 col-lg-4 col-sm-6">
                          <form id="service-form" action="{{route('services.store')}}" method="POST">
                              @csrf
                        <div class="mb-3">
                          <input type="hidden" name="centre_id" value="{{ $centre_id }}">
                          <label class="form-label" for="specialite">Spécialité <span
                            class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="a1" name="specialite" placeholder="Spécialité" required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="service">Service <span
                            class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="service" name="service" placeholder="Service" required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="telephone">Téléphone <span
                            class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Nom du service" required>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="email">Email <span
                            class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email du service" required>
                        </div>
                      </div>
                   

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="status">Fonctionnel <span
                              class="text-danger">*</span></label>
                          <div class="m-0">
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" id="status" value="1">
                              <label class="form-check-label" for="status">Oui</label>
                            </div>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="status" id="status" value="0">
                              <label class="form-check-label" for="status">Non</label>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="chef_service">Chef service<span
                            class="text-danger">*</span></label>
                          <select class="form-select" name="chef_service" required>
                            @php
                                $personnel = DB::table('personnel')->get();
                                @endphp
                            <option value="" selected>---Nommer un chef---</option>
                            {{-- @php
                                // dd($personnel);
                            @endphp --}}
                                @foreach($personnel as $chef_serv)
                                    <option value="{{ $chef_serv->personnel_id }}">Dr. {{ $chef_serv->nom }} {{ $chef_serv->prenom }}</option>
                                @endforeach
                          </select>
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
                            Créer le service
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
          <script>
            document.getElementById("service-form")
            .addEventListener("submit", function(event) {
              event.preventDefault();
              Swal.fire({
        title: "Confirmer l'enregistrement ?",
        // text: "Cliquez sur OK pour enregistrer cette chambre.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Oui, enregistrer",
        cancelButtonText: "Annuler"
    }).then((result) => {
        if (result.isConfirmed) {
            this.submit(); 
        }
    });
});
</script>
          </script>
@endsection
