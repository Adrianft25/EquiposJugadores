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

// Validación del formulario de creación de jugador
$(document).ready(function() {
    $('#jugadorForm').submit(function(e) {
        var nombre = $('#nombre').val();
        var numero = $('#numero').val();

        if (nombre === '' || numero === '') {
            e.preventDefault();
            alert('Por favor, completa todos los campos.');
        }
    });
});
