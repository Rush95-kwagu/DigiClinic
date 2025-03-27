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
                    <h5 class="card-title">Ajouter une nouvelle analyse</h5>
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
                          <form action="{{route('save.analyse')}}" method="POST">
                            @csrf
                           
                            
                            <input type="hidden" name="centre_id" value="{{ Session::get('centre_id') }}">
                          <label class="form-label" for="a1">Nom de l'analyse'</label>
                          <input type="text" class="form-control" name="libelle_analyse" id="a1" placeholder="Entrez le nom de l'analyse">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse</label>
                          <input type="number" class="form-control" name="prix_analyse" id="a2" placeholder="Entrez le coût">
                          </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse pour les assurés</label>
                          <input type="number" class="form-control" name="prix_analyse_assure" id="a2" placeholder="Entrez le coût">
                          </div>
                      </div>

                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a4">Groupe d'analyse</label>
                          <select class="form-select" id="a4" name="category" required>
                            <option value="HEMATOLOGIE">HEMATOLOGIE</option>
                            <option value="PARASITOLOGIE">PARASITOLOGIE</option>
                            <option value="SEROLOGIE">SEROLOGIE</option>
                            <option value="BIOCHIMIE">BIOCHIMIE</option>
                            <option value="IMMUNOLOGIE">IMMUNOLOGIE</option>
                          </select>
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
                      
                      <div class="col-12">
                        <h4>Ajout des normes (si disponible)</h4>
                        
                        <div class="input-group mb-3">
                        <input id="element"  type="text" class="form-control" placeholder="Elément" aria-label="Elément" aria-describedby="basic-addon2">
                        <input id="libelle_norme" type="text" class="form-control" placeholder="Libellé Norme" aria-label="Libellé Norme" aria-describedby="basic-addon2">
                        <input id="valeur_norme"  type="text" class="form-control" placeholder="Valeur Norme" aria-label="Valeur Norme" aria-describedby="basic-addon2">
                        <select name class="custom-select" id="inputGroupSelect01">
                          <option selected>Sélectionner...</option>
                          <option value="HOMME">HOMME</option>
                          <option value="FEMME">FEMME</option>
                          <option value="ADOLESCENT">ADOLESCENT</option>
                          <option value="FEMME ENCEINTE">FEMME ENCEINTE</option>
                          <option value="ENFANT">ENFANT</option>
                        </select>
                        <div class="input-group-append">
                          <button class="btn btn-outline-secondary add-analysis" type="button">Ajouter</button>
                        </div>
                      </div>

                      <div class="table-responsive">
                        <table class="table m-0 align-middle">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Eléments</th>
                              <th>Libellé Norme</th>
                              <th>Valeur Norme</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="selected-analyses">
                            <!-- Les analyses ajoutées apparaîtront ici -->
                          </tbody>
                        </table>
                      </div>
                      </div>
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


          @section('Datatable')
          <script>
            $(document).ready(function () {
              alert();
                let selectedAnalyses = [];
            
                // Ajouter une analyse
                $(document).on("click", ".add-analysis", function () {
                    let element = $("#element").val();
                    let genre = $("#inputGroupSelect01").val();
                    let libelle_norme = $("#libelle_norme").val();
                    let valeur_norme = $("#valeur_norme").val();
            
                    // if (selectedAnalyses.includes(prestationId)) {
                    //     Swal.fire({
                    //         icon: 'warning',
                    //         title: 'Erreur',
                    //         text: 'Cette analyse est déjà ajoutée !',
                    //     });
                    //     return;
                    // }
            
                  // selectedAnalyses.push(prestationId);
                    let newRow = `
                        <tr >
                            <td>${element}</td>
                            <td>${libelle_norme}</td>
                            <td>${valeur_norme} FCFA</td>
                            <td>
                                <button class="btn btn-danger remove-analysis" data-id="${slugify(element)}">Retirer</button>
                            </td>
                        </tr>
                    `;
                    $("#selected-analyses").append(newRow);
                    updateTotal();
                });
            
                // Retirer une analyse
                $(document).on("click", ".remove-analysis", function () {
                    let prestationId = $(this).data("id");
                    selectedAnalyses = selectedAnalyses.filter((id) => id !== prestationId);
                    $(this).closest("tr").remove();
                    updateTotal();
                });


                function slugify(text) {
                  return text.toString().toLowerCase()
                    // Remplacer les espaces par des tirets
                    .replace(/\s+/g, '-')
                    // Supprimer tous les caractères non alphanumériques et les tirets
                    .replace(/[^\w\-]+/g, '')
                    // Remplacer plusieurs tirets par un seul
                    .replace(/\-\-+/g, '-')
                    // Supprimer les tirets en début et fin de chaîne
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                }
              });

          <script>
    @endsection

       @endsection


  