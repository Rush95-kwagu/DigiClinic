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
    <div class="">
    <img src="{{ public_path('entete.jpg') }}" alt="Logo Clinique" style="width: 100%;height:120px" >
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
 
    <div class="" style="text-align-center">
    <p>QR CODE ICI</p>
        <!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->
    </div>
    <br>

@foreach ($data2 as $d )
<div class="page-break">
<div class="">
    <img src="{{ public_path('entete.jpg') }}" alt="Logo Clinique" style="width: 100%;height:120px" >
    </div>
<hr>
    <h1>Résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Catégorie :</strong> {{$d['categorie']}}</p>
    <p><strong>Analyse :</strong> {{$d['element']}}</p>

<table>
        <thead>
            <tr>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Norme</th>
            </tr>
        </thead>
        <tbody>
        @foreach($d['resultats'] as $group => $resultats2)
                    <tr>
                  <td style="text-align:center" colspan="3">
                    <h4><strong>{{$group}}</strong> </h4>
                  </td>
                </tr>
            @foreach($resultats2 as $resultat)

            <tr>
                <td>{{ $resultat->element }}</td>
                <td>{{ $resultat->result }}</td>
                <td>{{ $resultat->norme }}</td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>
</div> 

<div class="" style="text-align-center">
        <p>QR CODE ICI</p>
        <!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->
    </div>
@endforeach
</body>
</html>