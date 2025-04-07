<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats des analyses</title>
    <style>

        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 5px; text-align: left; }
        th { background-color: #f2f2f2; }
        .total { font-weight: bold; text-align: right; }
        .no-print { text-align: center; margin-top: 20px; } /* Cache les boutons lors de l'impression */
        @media print {
            .no-print { display: none; }
        }
        .page-break {
            page-break-before: always;
        }

        /* h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; } */
    </style>
</head>
<body>
    
@php
        use SimpleSoftwareIO\QrCode\Facades\QrCode;
        use Illuminate\Support\Facades\DB;

        $centre_id = session('centre_id');

        $infos = DB::table('tbl_centre')
            ->join('tbl_entite', 'tbl_entite.id_entite', '=', 'tbl_centre.id_entite')
            ->where('id_centre', $centre_id)
            ->select('tbl_entite.*', 'tbl_centre.*')
            ->first();
    @endphp



    <!-- Logo et Informations de la Clinique -->
    <div style="text-align: left;">
        <img src="{{ public_path('frontend/images/LogoDA.png') }}" alt="Logo Clinique" style="width: 100px;">
        <br>
        <!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->

    </div>

    <div style="text-align:right">
        {{ $infos->nom_centre }}
        <p>{{ $infos->Autorisation_decret }}</p>
        <p>Contact : {{ $infos->tel_centre }}</p>
        <p>Adresse : {{ $infos->adresse_centre }}</p>
    </div>
    <hr>


    <h1>Résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>


    

    <table>
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Référence</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data1 as $d )
            <tr>
                <td>{{ $d['categorie'] }}</td>
                <td>{{ $d['element'] }}</td>
                <td>{{ $d['decision'] }}</td>
                <td>{{ $d['observation'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
 
    <br>

@foreach ($data2 as $d )
<div class="@if(!$loop->first) page-break  @endif">
<table>
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Norme</th>
            </tr>
        </thead>
        <tbody>
            @foreach($d['resultats'] as $resultat)
            <tr>
                <td>{{ $d['categorie'] }}</td>
                <td>{{ $resultat->element }}</td>
                <td>{{ $resultat->result }}</td>
                <td>{{ $resultat->norme }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div> 
@endforeach
</body>
</html>