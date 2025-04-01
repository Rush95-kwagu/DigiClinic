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

  $('#constante-select').off('change').on('change', function() {
    $('#unite-constante').val(unites[$(this).val()] || '');
  });

  let constanteIndex = 0;

  $('#add-constante').off('click').on('click', function() {
    const type = $('#constante-select').val();
    const valeur = $('#valeur-constante').val().trim();
    const unite = $('#unite-constante').val();

    if (!type || !valeur) {
      Swal.fire({
        icon: 'error',
        title: 'Erreur',
        text: 'Veuillez renseigner tous les champs !',
      });
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
    constanteIndex++;
    $('#constante-count').val(constanteIndex);

    $('#constante-select').val('');
    $('#valeur-constante').val('');
    $('#unite-constante').val('');
  });

  $(document).on('click', '.remove-constante', function() {
    $(this).closest('tr').remove();
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