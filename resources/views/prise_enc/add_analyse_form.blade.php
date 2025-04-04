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
                            <input type="hidden" name="user_id" value="{{ Session::get('user_id')}}">
                          <label class="form-label" for="a1">Nom de l'analyse'</label>
                          <input type="text" class="form-control" name="nom_prestation" id="a1" placeholder="Entrez le nom de l'analyse">
                        </div>
                      </div>
                      <div class="col-xxl-3 col-lg-4 col-sm-6">
                        <div class="mb-3">
                          <label class="form-label" for="a2">Coût de l'analyse</label>
                          <input type="number" class="form-control" name="tarif" id="a2" placeholder="Entrez le coût">
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
                      
                      <input type="hidden" id="normes" value="" name="normes" >
                      
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
    let selectedAnalyses = [];

    // Ajouter une analyse
    $(document).on("click", ".add-analysis", function () {
        let element = $("#element").val();
        let genre = $("#inputGroupSelect01").val();
        let libelle_norme = $("#libelle_norme").val();
        let valeur_norme = $("#valeur_norme").val();

        // Validation des champs du formulaire
        if (!element || !libelle_norme || !valeur_norme || genre === "Sélectionner...") {
            Swal.fire("Erreur", "Veuillez remplir tous les champs !", "error");
            return;
        }

      //  Les données (les éléments sélectionés) sont ajoutées au tableau
        selectedAnalyses.push({
          element:element,
          libelle_norme:libelle_norme,
          valeur_norme:valeur_norme,
          genre:genre
        })
        let newRow = `
            <tr>
                <td rel="${selectedAnalyses.length-1}">${selectedAnalyses.length}</td>
                <td>${element}</td>
                <td>${libelle_norme}</td>
                <td>${valeur_norme} </td>
                <td>
                    <button class="btn btn-danger btn-sm remove-analysis" data-id="${slugify(element)}">
                        Retirer
                    </button>
                </td>
            </tr>
        `;
      
        $("#selected-analyses").append(newRow);
        $("#normes").val(JSON.stringify(selectedAnalyses));
        console.log($("#normes"))

        // Réinitialisation des champs
        $("#element, #libelle_norme, #valeur_norme").val("");
        $("#inputGroupSelect01").val("Sélectionner...");
    });

    // Retirer une analyse
    $(document).on("click", ".remove-analysis", function () {
      selectedAnalyses.splice( $(this).closest("tr").attr('rel'),1)
      $("#normes").val(JSON.stringify(selectedAnalyses));

        $(this).closest("tr").remove();
        // N° de colonnes
        // $("#selected-analyses tr").each(function(index) {
        //     $(this).find("td:first").text(index + 1);
        // });
    });

    // Fonction de suppression des caractères spéciaux avant ajout dans le tableau
    function slugify(text) {
                  return text.toString().toLowerCase()
                    
                    .replace(/\s+/g, '-')
                    .replace(/[^\w\-]+/g, '')
                    .replace(/\-\-+/g, '-')
                    .replace(/^-+/, '')
                    .replace(/-+$/, '');
                }
});
</script>
                
    @endsection

       @endsection


  