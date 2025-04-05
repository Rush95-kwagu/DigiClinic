    $(document).ready(function() {
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

  // changement de constantes
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
      <tr>
        <td>
          <input type="hidden" name="constantes[${constanteIndex}][type]" value="${type}">
          ${$('#constante-select option:selected').text()}
        </td>
        <td>
          <input type="hidden" name="constantes[${constanteIndex}][valeur]" value="${valeur}">
          ${valeur}
        </td>
        <td>
          <input type="hidden" name="constantes[${constanteIndex}][unite]" value="${unite}">
          ${unite}
        </td>
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
      Swal.fire({
        icon: 'warning',
        title: 'Attention',
        text: 'Aucune constante n\'a été ajoutée !',
      });
      return;
    }
    
    
    Swal.fire({
      icon: 'success',
      title: 'Succès',
      text: 'Les constantes ont été enregistrées !',
    }).then(() => {
      $('#constantesModal').modal('hide');
    });
  });
});
