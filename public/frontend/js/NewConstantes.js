 $(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
  const unites = {
    'TENSION ARTERIELLE': 'mmHg', 
    'FREQUENCE CARDIAQUE': 'bpm', 
    'FREQUENCE RESPIRATOIRE': 'rpm',
    'TEMPERATURE': '°C', 
    'SATURATION O2': '%', 
    'GLYCEMIE CAPILLAIRE': 'g/L',
    'GLYCEMIE A JEUN': 'g/L',
    'GLYCEMIE POST PRANDIALE': 'g/L',
    'POIDS': 'kg', 
    'TAILLE': 'cm'
  };

  const constantesDejaAjoutees = new Set(); // Pour suivre les constantes ajoutées

    $('#constante-select').off('change').on('change', function() {
        $('#unite-constante').val(unites[$(this).val()] || '');
    });

    $('#add-constante').off('click').on('click', function() {
        const type = $('#constante-select').val();
        const valeur = $('#valeur-constante').val().trim();
        const unite = $('#unite-constante').val();

        if (!type || !valeur) {
            Swal.fire('Erreur', 'Veuillez renseigner tous les champs !', 'error');
            return;
        }

        if (constantesDejaAjoutees.has(type)) {
            Swal.fire('Attention', 'Cette constante a déjà été ajoutée !', 'warning');
            return;
        }

        const newRow = `
            <tr data-type="${type}" data-valeur="${valeur}" data-unite="${unite}">
                <td>${$('#constante-select option:selected').text()}</td>
                <td>${valeur}</td>
                <td>${unite}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-constante">Supprimer</button>
                </td>
            </tr>
        `;

        $('#constantes-container').append(newRow);
        constantesDejaAjoutees.add(type); // Ajouter à l'ensemble
        constanteIndex++;
        $('#constante-count').val(constanteIndex);

        // Réinitialiser et désactiver temporairement l'option sélectionnée
        $('#constante-select option:selected').prop('disabled', true);
        $('#constante-select').val('');
        $('#valeur-constante').val('');
        $('#unite-constante').val('');
    });

    $(document).on('click', '.remove-constante', function() {
        const type = $(this).closest('tr').data('type');
        $(this).closest('tr').remove();
        
        // Réactiver l'option dans le select
        $('#constante-select option[value="' + type + '"]').prop('disabled', false);
        
        constantesDejaAjoutees.delete(type);
        constanteIndex = $('#constantes-container tr').length;
        $('#constante-count').val(constanteIndex);
    });


 $('#save-constantes').off('click').on('click', function() {
    if (constanteIndex === 0) {
        Swal.fire('Attention', 'Aucune constante ajoutée!', 'warning');
        return;
    }

    const formData = {
        _token: $('input[name="_token"]').val(),
        id_prise_en_charge: parseInt($('input[name="id_prise_en_charge"]').val()),
        patient_id: parseInt($('input[name="patient_id"]').val()),
        centre_id: parseInt($('input[name="centre_id"]').val()),
        id_consultation: parseInt($('input[name="id_consultation"]').val()),
        constante_count: constanteIndex,
        constantes: []
    };

   
    $('#constantes-container tr').each(function() {
        formData.constantes.push({
            type: $(this).data('type'),
            valeur: parseFloat($(this).data('valeur')), // Conversion en nombre
            unite: $(this).data('unite')
        });
    });

    $.ajax({
        url: `/traitement-patient/${formData.id_consultation}/${formData.patient_id}/modifier-constante`,
        type: 'POST',
        data: JSON.stringify(formData),
        contentType: 'application/json',
        success: function(response) {
            if (response.success) {
                Swal.fire('Succès!', 'Données enregistrées', 'success')
                    .then(() => $('#constantesModal').modal('hide'));
                    location.reload();
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.message || 'Erreur serveur';
            Swal.fire('Erreur', errorMsg, 'error');
        }
    });
});
});