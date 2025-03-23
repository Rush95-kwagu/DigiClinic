@extends('layout')
@section('user_content')
<?php  
 $user_role_id=Session::get('user_role_id');
 $user_id=Session::get('user_id');
?>
<div class="container">
    <h1>Éditer les résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient->nom_patient }} {{ $patient->prenom_patient }}</p>
    <p><strong>Téléphone :</strong> {{ $patient->telephone }}</p>
    <hr>

    @foreach($prestations as $prestation)
        <div class="card mb-3">
            <div class="card-header">
                <h5>{{ $prestation->nom_prestation }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('save_resultat', $prestation->id_prestation) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="resultat_{{ $prestation->id_prestation }}">Résultat</label>
                        <textarea class="form-control" id="resultat_{{ $prestation->id_prestation }}" name="resultat" rows="5">{{ $prestation->resultat ?? '' }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection