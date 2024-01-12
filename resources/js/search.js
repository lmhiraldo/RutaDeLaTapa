$('#searchInput').on('input', function() {
    const searchTerm = $(this).val().toLowerCase();
    const $tapaSelect = $('#tapaSelect');

    // Filtrar las opciones del desplegable basado en el término de búsqueda
    const filteredOptions = $('#tapaSelect option').filter(function() {
        return $(this).text().toLowerCase().startsWith(searchTerm);
    });

    // Limpiar el desplegable y agregar las opciones filtradas
    $tapaSelect.empty();
    filteredOptions.clone().appendTo($tapaSelect);

    // Mostrar u ocultar el desplegable según si hay opciones o no
    if (filteredOptions.length > 0) {
        $tapaSelect.show();
    } else {
        $tapaSelect.hide();
    }
});

$('#searchButton').on('click', function() {
    const searchTerm = $('#searchInput').val();
    if (searchTerm) {
        // Redirigir a la página de resultados con el término de búsqueda
        window.location.href = "{{ route('tapa.index') }}?search=" + searchTerm;
    }
});
