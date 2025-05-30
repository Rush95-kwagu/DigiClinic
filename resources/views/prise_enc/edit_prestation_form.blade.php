@extends('layout')
@section('user_content')
@section('title')
Repertoire patient
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
                  <div class="card-header">
                    <h5 class="card-title">Modifier la prestation</h5>
                  </div>
                  <div class="col-sm-12">
                    <div class="d-flex gap-2 justify-content-end">
                      <a href="{{url('all-prestations')}}" class="btn btn-success">
                        Voir la liste
                      </a>
                      
                    </div>
                  </div>
                  <div class="card-body">
                    
                 <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            @if (session('PersonnalAdded'))
                                Swal.fire({
                                    title: 'Ajouté !',
                                    text: "{{ session('PersonnalAdded') }}",
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    timer: 5000 
                                    
                                });
                            @endif
                        });
            </script>
                  

                    <!-- Row starts -->
                    <div class="row gx-3">
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <form action="{{route('edit.prestation',$all_prestation->prestation_id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_role_id" value="{{ Session::get('user_role_id') }}">
                            <input type="hidden" name="centre_id" value="{{ Session::get('centre_id') }}">
                          <label class="form-label" for="a1">Nom de la prestation</label>
                          <input type="text" class="form-control" name="nom_prestation" id="a1" value="{{$all_prestation->nom_prestation}}">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de la prestation</label>
                          <input type="number" class="form-control" name="tarif" id="a2" value="{{$all_prestation->tarif}}">
                          </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse pour les assurés</label>
                          <input type="number" class="form-control" name="prix_analyse_assure" value="{{$all_prestation->prix_analyse_assure}}" id="a2" placeholder="Entrez le coût">
                          </div>
                      </div>

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a4">Groupe d'analyse</label>
                          <select class="form-select" id="a4" name="category"  required>
                            <option value="HEMATOLOGIE" @if($all_prestation->category=='HEMATOLOGIE') selected @endif>HEMATOLOGIE</option>
                            <option value="PARASITOLOGIE" @if($all_prestation->category=='PARASITOLOGIE') selected @endif>PARASITOLOGIE</option>
                            <option value="SEROLOGIE" @if($all_prestation->category=='SEROLOGIE') selected @endif>SEROLOGIE</option>
                            <option value="BIOCHIMIE" @if($all_prestation->category=='BIOCHIMIE') selected @endif>BIOCHIMIE</option>
                            <option value="IMMUNOLOGIE" @if($all_prestation->category=='IMMUNOLOGIE') selected @endif>IMMUNOLOGIE</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Paramètres résultats</label>
                          <input type="text" class="form-control" name="result_params" value="{{$all_prestation->result_params}}" id="a2" placeholder="Aligner les paramètres séparés par de ;">
                          </div>
                      </div>
                      
                      {{-- <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a4">Service</label>
                          <select class="form-select" id="a4">
                            <option value="0">Select</option>
                            <option value="1">Surgeon</option>
                            <option value="2">Gynecologist</option>
                            <option value="3">Psychiatrists</option>
                            <option value="4">Urologist</option>
                            <option value="5">Paediatrician</option>
                          </select>
                        </div>
                      </div> --}}
                      
                      <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="available-rooms.html" class="btn btn-outline-secondary">
                            Annuler
                          </a>
                          <button type="submit" class="btn btn-primary">
                            Valider les informations
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