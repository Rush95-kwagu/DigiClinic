@extends('layout')
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
        <div class="card mb-3">
          <div class="card-header">
            <h5 class="card-title">Informations sur le patient</h5>
          </div>
    {{-- <h1>Informations sur le patient</h1> --}}
    <div class="card-body">
        <h2>Nom : {{ $patient['nom'] }} {{ $patient['prenom'] }}</h2>
        <p><strong>Âge :</strong> {{calculerAge($patient['datenais'] )}} ans </p>
        <p><strong>Sexe :</strong> {{ $patient['sexe_patient']=="M" ? 'Homme':'Femme'}}</p>
    
        <div class="row gx-3">
            <div class="col-sm-12">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="card-title">Analyses traités</h5>
                </div>
                <div class="card-body">
                  <div class="table-outer">
                    <div class="table-responsive">
                        @if (count($patient['analyses']) > 0)
                        <table class="table table-striped table-bordered" id="example2">
        {{-- <table class="table table-hover table-stripped table-sm"> --}}
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
                        <td>{{ $analyse['analyse_id'] }}</td>
                        <td>{{ $analyse['date_paiement'] ? \Carbon\Carbon::parse($analyse['date_paiement'])->format('d-m-Y H:i:s') : 'Non payé' }}</td>
                        <td>{{ $analyse['montant'] ?? 'Non spécifié' }}</td>
                        <td>{{ $analyse['libelle_analyse'] ?? 'Non spécifiée' }}</td>
                        <td>{{ $analyse['prix'] ?? 'Non spécifié' }}</td>
                        <td>

                            @if (optional($analyse['resultat'])['id_resultat'])
                            <a class="btn btn-sm btn-warning" href="{{URL::to('show-analyses-result/'.$analyse['prestation_id'].'/'.optional($analyse['resultat'])['id_resultat'] .'/'.$analyse['idDemand'])}}" type="button">Voir le résultat</a>   
                            @if (!$is_closed)
                              <a class="btn btn-sm btn-warning" href="{{URL::to('store-analyses-result/'.$analyse['analyse_id'].'/'.$patient['patient_id'] )}}" type="button" >Editer un autre résultat</a>
                            @endif

                            @else
                            <a class="btn btn-sm btn-primary" href="{{URL::to('store-analyses-result/'.$analyse['analyse_id'].'/'.$patient['patient_id'] )}}" type="button" >Ajouter un résultat</a>

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
    <div class="container d-flex justify-content-between">
      @if ($is_closed)
        <a class="btn btn-sm btn-danger" href="{{URL::to('get-analyses-result/'.$patient['patient_id'].'/'.implode(',',$ids).'/'.$idDemand )}}" type="button">Prévisualiser les résulats</a>  
      @endif
    
    @if ($can_closed && !$is_closed)
    <a class="btn btn-sm btn-success" href="{{URL::to('close-analyse/'.implode(',',$ids).'/'.$patient['patient_id'] )}}" type="button">Clôturer le dossier</a>   

    @endif

    </div>
</div>
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