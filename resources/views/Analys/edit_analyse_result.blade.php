@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>

    <h1>Informations sur l'analyse</h1>

    <div class="container p-5">
        <h2>Analyse : {{ $analyse->libelle_analyse}}</h2>
        @if ($analyse->treated)
          <p>Analyse déjà traitée</p> 
        @endif
        @if ($analyse->parametres->count()==0)
          
        <form action="{{URL::to('store-analyses-result')}}" method="post">
        @csrf

          
        <input type="hidden" name="patient_id" value="{{$patient_id}}">
        <input type="hidden" name="analyse_id" value="{{$analyse->analyse_id}}">
        <input type="hidden" name="id_type_analyse" value="{{$analyse->id_type_analyse}}">
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_role_id" value="{{$user_role_id}}">

            <div class="form-group">
              <label for="">Décision</label>
              <select class="form-control" name="decision" required>
                <option value="TEST POSITIF">TEST POSITIF</option>
                <option value="TEST NEGATIVE">TEST NEGATIVE</option>
              </select>
            </div>

            <div class="form-group">
              <label for="">Observation</label>
              <textarea class="form-control" name="observation" >

              </textarea>
            </div>

            <div class="">
              <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
            </div>
        </form>
        @else
        <form action="{{URL::to('store-analyses-result')}}" method="post">
          @csrf

          <input type="hidden" name="patient_id" value="{{$patient_id}}">
        <input type="hidden" name="analyse_id" value="{{$analyse->analyse_id}}">
        <input type="hidden" name="id_type_analyse" value="{{$analyse->id_type_analyse}}">
        <input type="hidden" name="user_id" value="{{$user_id}}">
        <input type="hidden" name="user_role_id" value="{{$user_role_id}}">

            <table class="table table-sm table-stripped table-hover">
              <thead>
                <th>Elements</th>
                <th>Résultats</th>
                <th>Normes</th>
              </thead>
              <tbody>
                @foreach ($analyse->parametres as $parameter)
                <tr>
                  <td>
                    <input type="hidden" name="elements[]" value="{{$parameter->element}}">
                    {{$parameter->element}}
                  </td>
                  <td>
                    <input type="text" name="results[]">
                  </td>
                  <td>
                    {{$parameter->valeur_norme}}
                    <input type="hidden" name="normes[]" value="{{$parameter->valeur_norme}}">
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <div class="">
              <button type="submit" class="btn btn-sm btn-primary">Enregistrer</button>
            </div>
        </form>
        @endif

       
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