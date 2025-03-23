<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Caisse</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        .header, .footer { text-align: center; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table, th, td { border: 1px solid black; text-align: left; }
        th, td { padding: 5px; }
        .right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h2>CLINIQUE XYZ</h2>
        <p>Date : {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <h3>Informations Patient</h3>
    <p><strong>Nom :</strong> {{ $paiement->first()->nom_patient }} {{ $paiement->first()->prenom_patient }}</p>
    <p><strong>Téléphone :</strong> {{ $paiement->first()->telephone }}</p>

    <h3>Détails du Paiement</h3>
    <table>
        <thead>
            <tr>
                {{-- <th>N°</th> --}}
                <th>Désignation</th>
                <th>Tarif</th>
                <th>Qté</th>
                <th>Coût</th>
            </tr>
        </thead>
        <tbody>
            @foreach($paiement as  $detail)
            <tr>
                {{-- <td>{{ $key + 1 }}</td> --}}
                <td>{{ $detail->nom_prestation }}</td>
                <td class="right">{{ number_format($detail->tarif, 2, ',', ' ') }} F CFA</td>
                <td class="right">{{ $detail->quantite }}</td>
                <td class="right">{{ number_format($detail->tarif * $detail->quantite, 2, ',', ' ') }} F CFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h3>Récapitulatif</h3>
    {{-- <table>
        <tr>
            <td><strong>Total :</strong></td>
            <td class="right">{{ number_format($paiement->total, 2, ',', ' ') }} F CFA</td>
        </tr>
        <tr>
            <td><strong>Montant remis :</strong></td>
            <td class="right">{{ number_format($paiement->montant_remis, 2, ',', ' ') }} F CFA</td>
        </tr>
        <tr>
            <td><strong>Monnaie :</strong></td>
            <td class="right">{{ number_format($paiement->montant_remis - $paiement->total, 2, ',', ' ') }} F CFA</td>
        </tr>
    </table> --}}

    <div class="footer">
        <p>Merci pour votre confiance !</p>
    </div>

</body>
</html>
