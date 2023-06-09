// Validación del formulario de creación de equipo
$(document).ready(function() {
    $('#equipoForm').submit(function(e) {
        var nombre = $('#nombre').val();
        var fecha = $('#fecha').val();

        if (nombre === '' || fecha === '') {
            e.preventDefault();
            alert('Por favor, completa todos los campos.');
        }
    });
});
