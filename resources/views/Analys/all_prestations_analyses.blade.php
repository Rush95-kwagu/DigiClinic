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

<div class="app-body">
  <div class="row gx-3">
    <div class="col-sm-12">
      <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between">
          <table style="width: 100%; border-collapse: collapse;">
            <th style="border: 1px solid black; padding: 5px; text-align: left;  background-color: #f2f2f2;">Infos patient</th>
            <th style=" padding: 5px; position: absolute;
                           left: 40%;
                           transform: translateX(-50%);  background-color: #f2f2f2;">Objet
            </th>
            <th style=" padding: 5px; position: absolute;
                           left: 90%;
                           transform: translateX(-50%);  background-color: #f2f2f2;">A payer
            </th>
            <tr>
              <td style="border: 1px solid black; padding: 5px; text-align: left; ">
                <h5 class="card-title">
                  <span 
                    style="position: absolute;
                           left: 40%;
                           transform: translateX(-50%);">
                             @if ($validate_analyse->nom_service == "Laboratoire")
                          <span class="badge bg-danger">Demande d'Analyse</span> 
                           @else
                          <span class="badge bg-info">Demande de Scanner</span> 
                           
                           @endif
                  </span>  <br> 
                  Nom :
                  <span style="color: green;"> 
                    {{ $validate_analyse->nom_patient }} 
                  </span> <br>
                  Prénom :  <span style="color: green;"> 
                     {{ $validate_analyse->prenom_patient }} 
                  </span> <br>
                  Sexe :  <span style="color: rgb(0, 53, 128);"> 
                     {{ $validate_analyse->sexe_patient }} 
                  </span>
                  </span> <br>
                  Âge :  <span style="color: rgb(0, 53, 128);"> 
                     {{ $validate_analyse->age }} ans 
                  </span>
           <b> <h4 style="display :flex; justify-content:flex-end">  0 FCFA</h4></b>
           <button id="payer-btn" class="btn btn-success ms-auto" style="display :flex; justify-content:flex-end"
        data-patient-id="{{ $validate_analyse->patient_id }}"
        data-patient-nom="{{ $validate_analyse->nom_patient }}"
        data-patient-prenom="{{ $validate_analyse->prenom_patient }}"
        data-service-id = "{{ $validate_analyse->services_id }}"
        data-service-nom = "{{ $validate_analyse->nom_service }}"
        data-demande-id="{{ $validate_analyse->id_demande }}">
    Encaisser
</button>
              </td>
           
            </tr>
          </table> <br>
          
        </div>
    <div class="card-body">
          <div class="table-responsive">
            <table class="table m-0 align-middle">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Libelle de l'analyse</th>
                  <th>Coût de l'analyse</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="selected-analyses">
                <!-- Les analyses ajoutées apparaîtront ici -->
              </tbody>
            </table>
          </div>
        </div>

        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title">Répertoire des analyses</h5>
          <a href="{{URL::to('add-analyse')}}" class="btn btn-primary ms-auto">Ajouter une analyse</a>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="example2" class="table truncate m-0 align-middle">
              <thead>
                <tr>
                  <th>Type d'analyse</th>
                  <th>Coût de l'analyse</th>
                  <th>Coût de l'analyse assuré</th>
                  <th>Actions</th>
                </tr>
              </thead>
              @php
                               $centre_id=Session::get('centre_id');
                               $analyse=DB::table('tbl_type_analyse')
                                            ->where('service',"LABORATOIRE")
                                            ->get();
                          @endphp
              <tbody>
                @foreach ($analyse as $all_analyses)
                <tr>
                  <td>{{$all_analyses->libelle_analyse}}</td>
                  <td>{{$all_analyses->prix_analyse}} FCFA</td>
                  <td>{{$all_analyses->prix_analyse_assure}} FCFA</td>
                  <td>
                    <button class="btn btn-outline-success btn-sm add-analysis" 
                        data-id="{{$all_analyses->id_type_analyse}}" 
                        data-libelle="{{$all_analyses->libelle_analyse}}" 
                        data-prix="{{$all_analyses->prix_analyse}}">
                          Sélectionner
                </button>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@section('Datatable')
<script>
  $(document).ready(function () {
      let selectedAnalyses = [];
  
      // Ajouter une analyse
      $(document).on("click", ".add-analysis", function () {
          let prestationId = $(this).data("id");
          let libelle = $(this).data("libelle");
          let prix = $(this).data("prix");
  
          if (selectedAnalyses.includes(prestationId)) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Erreur',
                  text: 'Cette analyse est déjà ajoutée !',
              });
              return;
          }
  
          selectedAnalyses.push(prestationId);
          let newRow = `
              <tr data-prestation-id="${prestationId}">
                  <td>${$("#selected-analyses tr").length + 1}</td>
                  <td>${libelle}</td>
                  <td>${prix} FCFA</td>
                  <td>
                      <button class="btn btn-danger remove-analysis" data-id="${prestationId}">Retirer</button>
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
  
      // Mettre à jour le total
      function updateTotal() {
          let total = calculateTotal();
          $(".card-header h4").text("Montant de la facture : " + total.toFixed(2) + " FCFA");
      }
  
      // Calculer le total
      function calculateTotal() {
          let total = 0;
          $('#selected-analyses tr').each(function() {
              let prix = parseFloat($(this).find('td:eq(2)').text().replace(' FCFA', ''));
              total += isNaN(prix) ? 0 : prix;
          });
          return total;
      }
  
    
      $("#payer-btn").click(function () {
    if (selectedAnalyses.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: 'Veuillez sélectionner au moins une analyse',
        });
        return;
    }

    let csrfToken = $('meta[name="csrf-token"]').attr('content');
    let patientId = $(this).data("patient-id");
    let idDemande = $(this).data("demande-id");
    let patientNom = $(this).data("patient-nom");
    let patientPrenom = $(this).data("patient-prenom");
    let serviceId = $(this).data("service-id");
    let serviceNom = $(this).data("service-nom");
    let total = calculateTotal();

    Swal.fire({
        title: "Confirmer le paiement",
        html: `
            <p><strong>Motif : </strong>${serviceNom}</p>
            <p><strong>Patient :</strong> ${patientPrenom} ${patientNom}</p>
            <p><strong>Nombre d'analyses :</strong> ${selectedAnalyses.length}</p>
            <p><strong>Montant total :</strong> ${total.toFixed(2)} FCFA</p>
            <p>Voulez-vous vraiment valider ce paiement ?</p>
        `,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, valider",
        cancelButtonText: "Annuler",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/payer-analyse",
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                data: {
                    patient_id: patientId,
                    id_demande: idDemande,
                    prestation_id: selectedAnalyses,
                    services_id: serviceId,
                    total: total
                },
                success: function (response) {
                  Swal.fire({
    icon: 'success',
    title: 'Paiement réussi !',
    html: `
        <p>Le paiement de <strong>${response.total} FCFA</strong> pour ${serviceNom} a été enregistré.</p>
        <p>Patient : <strong>${patientPrenom} ${patientNom}</strong></p>
        <p><a href="${response.pdf_url}" class="btn btn-primary" onclick="redirectAfterDownload()">Télécharger le reçu</a></p>
        <div id="qrcode"></div>
    `,
    timer: 60000, 
    timerProgressBar: true,
}).then((result) => {
   
    window.location.href = '/gestion-demande-ext'; 
});

function redirectAfterDownload() {
    window.location.href = '/gestion-demande-ext'; 
}
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Erreur',
                        text: 'Une erreur est survenue lors du paiement.',
                    });
                    console.error(xhr.responseText);
                }
            });
        }
    });
});
    
  });
  </script>
@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
    
  
@endsection
@endsection