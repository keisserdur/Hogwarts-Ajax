(function() {
    
    $('#divLogout').hide();

    $('#btEnviar').on('click', function() {
        $.ajax({
            url: "index.php",
            data: {
                ruta: 'ajax',
                accion: 'login',
                email: $('#iptEmail').val(),
                password: $('#iptPassword').val()
            },
            type: "GET",
            dataType: "json"
        }).done(function(objetoJson) {
            if(objetoJson.login === 1){
                // $('#divLogin').css('display','none');
                $('#divLogin').hide();
                $('#divLogout').show();
                $('#divUser').text(objetoJson.info.nombre);
                $('#divOcultar').hide();
            }
        });
    });

}());
