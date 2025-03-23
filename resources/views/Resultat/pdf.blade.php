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
    <p><strong>Patient :</strong> {{ $patient->nom_patient }} {{ $patient->prenom_patient }}</p>
    <p><strong>Date :</strong> {{ now()->format('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>Analyse</th>
                <th>Résultat</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultats as $resultat)
            <tr>
                <td>{{ $resultat->nom_prestation }}</td>
                <td>{{ $resultat->resultat }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>