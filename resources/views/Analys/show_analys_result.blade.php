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
      <div class="card">
        <div class="card-body">
        <h1>Résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>


    @if ($resultats)
    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Norme</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultats as $resultat)
            <tr>
                <td>{{ $resultat->element }}</td>
                <td>{{ $resultat->result }}</td>
                <td>{{ $resultat->norme }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <table>
        <thead>
            <tr>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Référence</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $element }}</td>
                <td>{{ $decision }}</td>
                <td>{{ $observation }}</td>
            </tr>
        </tbody>
    </table>
    @endif

        </div>
      </div>
   </div>
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