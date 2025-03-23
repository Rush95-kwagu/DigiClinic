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
                    <h5 class="card-title">Modifier</h5>
                  </div>
                  <div class="col-sm-12">
                    <div class="d-flex gap-2 justify-content-end">
                      <a href="{{url('all-analyses')}}" class="btn btn-success">
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
                          <form action="{{URL::to('update-analyse-form/'.$analyses->id_type_analyse)}}" method="POST">
                            @csrf
                            
                            <input type="hidden" name="centre_id" value="{{ Session::get('centre_id') }}">
                          <label class="form-label" for="a1">Nom de l'analyse'</label>
                          <input type="text" class="form-control" name="libelle_analyse" id="a1" value={{$analyses->libelle_analyse}}>
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse</label>
                          <input type="number" class="form-control" name="prix_analyse" id="a2" value="{{$analyses->prix_analyse}}">
                          </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse pour les assurés</label>
                          <input type="number" class="form-control" name="prix_analyse_assure" id="a2" value="{{$analyses->prix_analyse_assure}}">
                          </div>
                      </div>
                      
                    <div class="col-sm-12">
                        <div class="d-flex gap-2 justify-content-end">
                          <a href="{{URL::to('all-analyses')}}" class="btn btn-outline-secondary">
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