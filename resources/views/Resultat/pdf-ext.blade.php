<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Résultats des analyses</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>


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