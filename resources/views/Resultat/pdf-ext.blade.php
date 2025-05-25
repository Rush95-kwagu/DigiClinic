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


        .header {
      text-align: center;
      border-bottom: 2px solid #ccc;
      padding-bottom: 10px;
    }

    .header .top-text {
      color: #0077cc;
      font-weight: bold;
      line-height: 1.5;
      text-align:left;
      width: 33%;
      font-size:12px
    }

    .header .zone {
      font-size: 12px;
    }

    .header .clinic-name {
      color: green;
      font-size: 24px;
      font-weight: bold;
      margin: 10px 0;
    }

    .header .authorization {
      color: red;
      font-style: italic;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .header .contact {
      color: #005baa;
      font-size: 16px;
    }

    .left-icon,
    .right-icon {
      width: 40px;
      position: absolute;
      top: 150px;
      height:80px;
    }

    .top-text2 {
      position: absolute;
      top: 10px;
      left: 33%;
      font-size: 12px;
    }

    .left-icon {
      left: 10px;
    }

    .right-icon {
      right: 10px;
    }

    .logo {
      position: absolute;
      right: 30px;
      top: 10px;
      text-align: right;
    }

    .logo img {
      height: 60px;
    }


    .logo .bureau {
      font-size: 14px;
      color: #005baa;
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
        use App\Models\User;

        $centre_id = session('centre_id');
        $user =User::where('user_id',session('user_id'))->first();
        $infos = DB::table('tbl_centre')
            ->join('tbl_entite', 'tbl_entite.id_entite', '=', 'tbl_centre.id_entite')
            ->where('id_centre', $centre_id)
            ->select('tbl_entite.*', 'tbl_centre.*')
            ->first();

            $userInfo=DB::table('personnel')
                ->where('email',$user->email)
                ->first(); 
    @endphp


    @include('Resultat.pdf-header')
    <hr>


    <h1>Résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Laboratin :</strong> {{$userInfo->nom}} {{$userInfo->prenom}}</p>


    

    <table>
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Elément</th>
                <th>Résultat</th>
                <th>Référence</th>
                <!-- <th>Date Validité</th> -->
            </tr>
        </thead>
        <tbody>
            @foreach ($data1 as $d )
            <tr>
                <td>{{ $d['categorie'] }}</td>
                <td>{{ $d['element'] }}</td>
                <td>{{ $d['decision'] }}</td>
                <td>{{ $d['observation'] }}</td>
                <!-- <td>{{ $d['date_validite'] }}</td> -->
            </tr>
            @endforeach
        </tbody>
    </table>
 


@foreach ($data2 as $d )
<div class="page-break">
@include('Resultat.pdf-header')
<hr>
    <h1>Résultats des analyses</h1>
    <p><strong>Patient :</strong> {{ $patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>
    <p><strong>Catégorie :</strong> {{$d['categorie']}}</p>
    <p><strong>Analyse :</strong> {{$d['element']}}</p>
    <p><strong>Laboratin :</strong> {{$userInfo->nom}} {{$userInfo->prenom}}</p>
    <p><strong>Date Validité :</strong> {{$d['date_validite']}}</p>

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

    <div class="">
      <h6>Référence</h6>
      <p>{{$d['observation']}}</p>
    </div>
</div> 


        <!-- <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code" style="width: 150px;"> -->
    </div>
@endforeach
</body>
</html>