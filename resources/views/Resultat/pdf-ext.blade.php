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


    @if ($resultats)
    <table>
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
                <td>{{ $resultat['element'] }}</td>
                <td>{{ $resultat['result'] }}</td>
                <td>{{ $resultat['norme'] }}</td>
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
 
</body>
</html>