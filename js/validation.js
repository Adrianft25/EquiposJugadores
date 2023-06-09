// Validación del formulario de creación de equipo
$(document).ready(function() {
    $('#equipoForm').submit(function(e) {
        var nombre = $('#nombre').val();
        var descripcion = $('#descripcion').val();

        if (nombre === '' || descripcion === '') {
            e.preventDefault();
            alert('Por favor, completa todos los campos.');
        }
    });
});
