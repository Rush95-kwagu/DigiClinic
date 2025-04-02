@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

    <h1>Informations sur le patient</h1>

    <div>
        <h2>Nom : {{ $patient['nom'] }} {{ $patient['prenom'] }}</h2>
        <p><strong>Âge :</strong> {{ $patient['age'] ?? 'non défini'}}</p>
    </div>

    <h3>Analyses</h3>
    @if (count($patient['analyses']) > 0)
        <table class="table table-hover table-stripped table-sm">
            <thead>
                <tr>
                    <th>Analyse ID</th>
                    <th>Date de Paiement</th>
                    <th>Montant</th>
                    <th>Prestation</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($patient['analyses'] as $analyse)
                    <tr>
                        <td>{{ $analyse->analyse_id }}</td>
                        <td>{{ $analyse->date_paiement ? \Carbon\Carbon::parse($analyse->date_paiement)->format('d-m-Y H:i:s') : 'Non payé' }}</td>
                        <td>{{ $analyse->montant ?? 'Non spécifié' }}</td>
                        <td>{{ $analyse->prestation_nom ?? 'Non spécifiée' }}</td>
                        <td>{{ $analyse->prix ?? 'Non spécifié' }}</td>
                        <td>
                            <a class="btn btn-sm btn-primary" href="{{URL::to('store-analyses-result/'.$analyse->analyse_id.'/'.$patient['patient_id'] )}}" type="button" >Ajouter un résultat</a>

                            @if ($analyse->id_resultat)
                            <a class="btn btn-sm btn-warning" target="_blank" href="{{env('APP_URL')}}/storage/{{$analyse->path}}" type="button" >Voir le résultat</a>   
                            @endif
                            <!-- Formulaire caché pour ajouter un résultat -->
                             <!-- Modal to add analysis result -->
                          
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune analyse trouvée pour ce patient.</p>
    @endif


@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])

@section('Datatable')
    <script>
      $(document).ready(function() {
      $("#example").DataTable();
    });
      $(document).ready(function() {
      $("#example2").DataTable();
    });
      $(document).ready(function() {
      $("#example3").DataTable();
    });
      $("select").change(function(){
      if(confirm('Cliquez OK pour envoyer le patient vers le spécialiste')){
          {this.form.submit()} 
      }
      else $("select option:selected").prop("selected", false);
    });
    </script>
    </script>
    @endsection
@endsection