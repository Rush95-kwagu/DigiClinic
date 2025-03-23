<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reçu de Paiement</title>
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

    <!-- Informations du Patient -->
    <p><strong>Nom :</strong> {{ $patient->nom_patient }}</p>
    <p><strong>Prénom :</strong> {{ $patient->prenom_patient }}</p>
    <p><strong>Téléphone :</strong> {{ $patient->telephone }}</p>

    <!-- Tableau des Prestations -->
    <table>
        <thead>
            <tr>
                <th>Désignation</th>
                <th>Tarif</th>
                <th>Quantité</th>
                <th>Coût</th>
            </tr>
        </thead>
        <tbody>
            @foreach($prestations as $prestation)
            <tr>
                <td>{{ $prestation->nom_prestation }}</td>
                <td class="right">{{ number_format($prestation->tarif, 2, ',', ' ') }} F CFA</td>
                <td class="right">1</td> <!-- Si chaque analyse est comptée une fois -->
                <td class="right">{{ number_format($prestation->tarif, 2, ',', ' ') }} F CFA</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    <p class="total">Total : {{ number_format($montant, 2, ',', ' ') }} F CFA</p>

    <!-- Code QR pour Authentification -->
    <div style="text-align: center; margin-top: 20px;">
        <p><strong>Authentification du reçu</strong></p>
        
        @if (!empty($qr_code))
            <img src="data:image/svg+xml;base64,{{ base64_encode($qr_code) }}" alt="QR Code" style="width: 150px;">
        @else
            <p>Aucun QR Code disponible</p>
        @endif

        <p>Scannez le code QR pour vérifier l'authenticité</p>
    </div>

    <!-- Boutons pour Impression et Téléchargement -->
    <div class="no-print">
        <button onclick="window.print()">🖨️ Imprimer</button>
        <button onclick="downloadPDF()">📥 Télécharger en PDF</button>
    </div>

    <!-- Script pour Génération du PDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        function downloadPDF() {
            const { jsPDF } = window.jspdf;
            let doc = new jsPDF();

            doc.text("Reçu de Paiement", 10, 10);
            doc.text("Clinique: {{ $infos->nom_centre }}", 10, 20);
            doc.text("Autorisation: {{ $infos->Autorisation_decret }}", 10, 30);
            doc.text("Téléphone: {{ $infos->tel_centre }}", 10, 40);
            doc.text("Adresse: {{ $infos->adresse_centre }}", 10, 50);
            
            doc.text("Patient: {{ $patient->nom_patient }} {{ $patient->prenom_patient }}", 10, 70);
            doc.text("Téléphone: {{ $patient->telephone }}", 10, 80);
            
            let y = 100;
            @foreach($prestations as $prestation)
                doc.text("{{ $prestation->nom_prestation }} - {{ number_format($prestation->tarif, 2, ',', ' ') }} F CFA", 10, y);
                y += 10;
            @endforeach

            doc.text("Total: {{ number_format($montant, 2, ',', ' ') }} F CFA", 10, y + 10);

            doc.save("Reçu_Paiement.pdf");
        }
    </script>

</body>
</html>
