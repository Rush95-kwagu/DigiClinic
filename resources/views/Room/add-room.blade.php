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
                    <h5 class="card-title">Ajouter une nouvelle chambre</h5>
                  </div>
                  <div class="card-body">

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a1">Numéro de chambre <span
                            class="text-danger">*</span></label>
                          
                          <input type="text" class="form-control" name="numero_chambre" id="a1" placeholder="Entrez le numéro de la chambre">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Nombre de lits
                           <span
                            class="text-danger">*</span></label>
                          <input type="email" class="form-control" name="nombre_lits" id="a2" placeholder="Entrez le nombre de lits">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a3">Type de chambre
                           <span
                            class="text-danger">*</span></label>
                          <select class="form-select" id="a3" name ="is_vip">
                            <option value="">Sélectionnez un type</option>
                            <option value="0">Standard</option>
                            <option value="1">VIP</option>
                          
                          </select>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a4">Service
                           <span
                            class="text-danger">*</span></label>
                          
                            <select class="form-select"  id="service_ass" name="service_ass" required>
                            @php
                                $services = DB::table('services')->get();
                            @endphp
                            <option value="">---Nommer un chef---</option>
                                @foreach($services as $service_numb)
                                    <option value="{{ $service_numb->id }}"> {{ $service_numb->service }}</option>
                                @endforeach
                         
                          </select>
                        </div>
                      </div>
                      {{-- <div class="col-sm-12">
                        <div class="mb-3">
                          <label class="form-label" for="a5">Enter Message</label>
                          <textarea class="form-control" id="a5" placeholder="Enter message" rows="3"></textarea>
                        </div>
                      </div> --}}
                      <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="available-rooms.html" class="btn btn-outline-secondary">
                            Cancel
                          </a>
                          <a href="available-rooms.html" class="btn btn-primary">
                            Créer la chambre
                          </a>
                        </div>
                      </div>
                    </div>
                    <!-- Row ends -->

                  </div>
                </div>
              </div>
            </div>
            <!-- Row ends -->

          </div>
          <!-- App body ends -->

        @endsection