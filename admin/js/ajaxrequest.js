/*global $*/
(function(){
    var user;
    var tablaActual = '';
    var currentUser = '';
    
    (function init(){
        isLogged();
        //resetControles();
        closeModal();
    }());
    
    function printTitle(){
        $('#titulo').text(tablaActual);
    }
    
    /**************************************************/
    /******************** SESSION *********************/
    /**************************************************/
    
    $('#dologin').on('click', function(){
        $.ajax({
            url : 'index.php',
            data : {
                ruta : 'ajaxprofesor',
                accion : 'dologin',
                nick : $('#nick_login').val(),
                password : $('#pass_login').val()
            },
            dataType : 'json'
            
        }).done(function(msg) {
            if(msg){
                hideLogin();
                pedirUser();
            }else{
                alert('Usuario o contraseña incorrecta');
            }
            
        }).fail(function(jqXHR, textStatus) {
            alert('error de logueo ' + $('#nick_login').val());
        })
    })
    
    $('#dogout').on('click', function(){
        $.ajax({
            url : 'index.php',
            data : {
                ruta : 'ajaxprofesor',
                accion : 'dologout'
            }
            
        }).done(function(msg) {
            showLogin();
            currentUser = null;
            
        }).fail(function(jqXHR, textStatus) {
            alert('error de deslogueo ' + $('#nick_login').val());
        })
    });

    function isLogged(){
         $.ajax({
            url : 'index.php',
            data : {
                ruta : 'ajaxprofesor',
                accion : 'islogin'
            },
            dataType : 'json'
            
        }).done(function(msg) {
            if(msg){
                hideLogin();
                pedirUser();
            }else{
            }
        });
    }
    
    function pedirUser(){
        $.ajax({
            url : 'index.php',
            data: {
                ruta : 'ajaxprofesor',
                accion : 'getuserlogin',
            },
            dataType : 'json'
        }).done(function(msg){
            currentUser = msg;
            resetControles();
            $('#name').text(currentUser.nick);
            $('#depart').text(currentUser.department);
        })
    }
    
    function showLogin(){
        $('#login').toggle();
        $('#content').toggle();
        $('#content').css('display','none');
    }
    
    function hideLogin(){
        $('#login').toggle();
        $('#content').toggle();
        $('#content').css('display','flex');
    }
    
    /**************************************************/
    /******************** CONTROL *********************/
    /**************************************************/
    
    function activarControles(){
        var filaPulsada = $('.marcada');
        currentUser;
        switch (tablaActual) {
            case 'actividad':
                if(filaPulsada.length > 1){
                    $('#primeroRemove').removeClass('disabled');
                    $('#primeroEdit').addClass('disabled');
                    activarEditActividades(false);
                    activarRemoveActividades(true);
                }
                if(filaPulsada.length == 1){
                    $('#primeroRemove').removeClass("disabled");
                    $('#primeroEdit').removeClass("disabled");
                    activarEditActividades(true);
                    activarRemoveActividades(true);
                }
                break;
            case 'profesor':
                 if(filaPulsada.length > 1 && currentUser.admin == 1){
                    $('#segundoRemove').removeClass('disabled');
                    $('#segundoEdit').addClass('disabled');
                    activarEditProfesores(false);
                    activarRemoveProfesores(true);
                }if(filaPulsada.length == 1 && currentUser.admin == 1){
                    $('#segundoRemove').removeClass('disabled');
                    $('#segundoEdit').removeClass('disabled');
                    activarEditProfesores(true);
                    activarRemoveProfesores(true);
                }
                
                break;
            case 'grupo':
                 if(filaPulsada.length > 1 && currentUser.admin == 1){
                    $('#terceroRemove').removeClass('disabled');
                    $('#terceroEdit').addClass('disabled');
                    activarEditGrupos(false);
                    activarRemoveGrupos(true);
                }if(filaPulsada.length == 1 && currentUser.admin == 1){
                    $('#terceroRemove').removeClass('disabled');
                    $('#terceroEdit').removeClass('disabled');
                    activarEditGrupos(true);
                    activarRemoveGrupos(true);
                }
                break;
            
            default:
        }
    }
    
    function resetControles(){
        $('#primeroRemove').addClass('disabled');
        $('#primeroEdit').addClass('disabled');
        activarEditActividades(false);
        activarRemoveActividades(false);
        
        $('#segundoRemove').addClass('disabled');
        $('#segundoEdit').addClass('disabled');
        activarEditProfesores(false);
        activarRemoveProfesores(false);
        
        $('#terceroRemove').addClass('disabled');
        $('#terceroEdit').addClass('disabled');
        activarEditGrupos(false);
        activarRemoveGrupos(false);
        
        if(currentUser.admin == 0){
            $('#segundoAdd').addClass('disabled');
            $('#terceroAdd').addClass('disabled');
            $('#segundoAdd').off('click');
            $('#terceroAdd').off('click');
            
        }
    }
    
    function validarCampos(){
        var bandera=true;
        $(".lb-generico input").each(function() {
            
            $(this).closest('.lb-generico').find(".error").remove();
            if($(this).val()==""){
                $(this).after("<span class='error'>*Required field</span>");
                bandera=false;
            }
        
        });
        return bandera;
    }
    
    /**************************************************/
    /******************** CONSULTAS *******************/
    /**************************************************/
    
    //Pide los datos al servidor
    function pedirDatos(miruta){
        $.ajax({
            url: "index.php",
            method: "POST",
            data: { 
                    ruta : miruta,
                    accion : 'getListJson'},
            dataType : 'json'
        }).done(function( msg ) {
            createTable(msg);
        }).fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        })
    }
    
    //Crea la tabla segun los datos del servidor
    function createTable(msg){
        var keys = Object.keys(msg.data[0]);
            printTitle();
        
            //Borramos la tabla anterior
            $('#tableresult').remove();
        
            //Creamos nueva tabla
            $('.content').append('<table id="tableresult"></table>');
            
            //Metemos los titulos
            $('#tableresult').append('<tr class="tablehead"></tr>');
            var tablehead = $('.tablehead');
            
            for(var pos in keys){
                tablehead.append('<th>' + keys[pos] + '</th>');
            }
            
            //Metemos el resto de filas
            for(var pos in msg.data){
                var object = msg.data[pos];
                $('#tableresult').append('<tr></tr>');
                var lastFila = $('#tableresult').find('tr').last();
                var ident=0;
                for(var position in keys){
                    lastFila.append("<td>" + object[keys[position]] + '</td>');
                }
            }
            
            clickTable();
    }
    
    function clickTable(){
        $('tr').on('click','td', function(e) {
            var filaPulsada = $(e.delegateTarget);
            if(tablaActual == 'actividad' && currentUser.admin == 0){
                var tdTeacher = filaPulsada.find('td')[1];
                if(tdTeacher.textContent == currentUser.nick){
                    filaPulsada.toggleClass('marcada');
                    resetControles();
                    activarControles();
                }
            }else{
                filaPulsada.toggleClass('marcada');
                resetControles();
                activarControles();
            }
        })
    }
            
    /**************************************************/
    /********************* BORRAR *********************/
    /**************************************************/
         
    function initRemove(miruta){
        var arrayjson = { id : [] };
        var array = [];
        
        var count= $('.marcada').length;
        
        var palabra = tablaActual;
        
        if(count >1){
            palabra += 's';
        }
        
        $('.marcada').each(function(){
            array.push( $(this).find('td').first().text() );
        });
        
        arrayjson.id = array;
        $('.modal').css('visibility','visible');
        $('.modal-box').remove();
        $('.modal').append('<div class="modal-box modal-delete"><p>Esta usted seguro de que desea borrar ' + count + ' ' + palabra + '</p> <button class="aceptar">Aceptar</button> <button class="cancelar">Cancelar</button></div>');

        $('.modal .aceptar').on("click",function(){
            remove(miruta, arrayjson);
            $('.modal').css('visibility','hidden');
        });
        
        $('.modal .cancelar').on("click",function(){
            $('.modal').css('visibility','hidden');
        });
    }     
           
    //Lee y borra la filas marcadas
    function remove(miruta, arrayjson){
        $.ajax({
        url : "index.php",
        method : "POST",
        data : {
            ruta : miruta,
            accion:'dodelete',
            id : arrayjson
            },
        dataType:'json'
        }).done(function(msg){
            createTable(msg);
            resetControles();
        });
    }
    
    /**************************************************/
    /********************* EDITAR *********************/
    /**************************************************/
    
    //Una vez pulsado edit
    function initEdit(miruta){
        $.ajax({
            url : "index.php",
            method : "POST",
            data : {
                ruta : miruta,
                accion:'getatributes'
                },
            dataType:'json'
            }).done(function(campos){
                createEdit(miruta, tablaActual , campos);
            });
    }
    
    function edit(miruta, campos){
        var pulsada = $('.marcada td');
        var formData = new FormData();
        
        formData.append('ruta', miruta);
        formData.append('accion', 'doedit');
        
        
        for(var value in campos){
            if(value.indexOf('id') != -1){
                if(tablaActual == 'actividad'){
                    if(value == 'idActivity'){
                        formData.append(value, pulsada[0].textContent);
                    }
                    if(value == 'idTeacher'){
                        formData.append(value, pulsada[1].textContent);
                    }
                    if(value == 'idGroup'){
                        formData.append(value, $('#'+value).val());
                    }
                }
                if(tablaActual == 'grupo'){
                    formData.append(value, pulsada[0].textContent);
                }
                if(tablaActual == 'profesor'){
                    formData.append(value, pulsada[0].textContent);
                }
            }else if(value == 'photo'){
                formData.append(value, $('#'+value)[0].files[0]);
            }else{
                formData.append(value, $('#'+value).val());
            }
        }
        
        var validado = validarCampos();
        if(validado){
            $.ajax({
                url : "index.php",
                method : "POST",
                data : formData,
                dataType:'json',
                contentType: false,
                processData: false
            }).done(function(msg){
                resetControles();
                createTable(msg);
            });
        }else{
            alert('Hay algun campo mal escrito');
        }
    }
    
    //Crea la modal para insertar una nueva fila
    function createEdit(miruta, pojo , campos){
        $('.modal').css('visibility','visible');
        $('body').css('overflow', 'hidden');
        $('.modal-box').remove();
        $('.modal').append('<div class="modal-box modal-' + pojo +'"><div class="modal-form"><h1 class="header-modal">New ' + pojo +'</h1></div></div>');
        
        var box = $('.modal-form');
        
        if(pojo == 'actividad'){
            createInputActividad(campos, pojo);
        }else{
            createInputGenerico(pojo , campos)
        }
        
        insertDefaultData(campos);
        
        box.append('<button id="edit" class="btn">Edit</button>');
        var inictialheight = $('.modal-form').outerHeight();
        
        //resizeModal();
        addControllModalEdit(miruta, campos);
        
    }
    //box.append('<div class="label-animation"><label class="lb-generico" for="' + value +'">' + value + '</lable><input id="' + value + '" class="ip-generico ' + pojo + '" placeholder="' + value + '" type="text" name="' + value + '"></div>');
    function insertDefaultData(campos){
        var td = $('.marcada td');
        var i = 0;
        for(var value  in campos){
            $('#'+value).attr('value',td[i].textContent);
            i++;
        }
    }
    
    //Añade los eventos para cerrar y añadir de la ventana modal
    function addControllModalEdit(miruta,campos){
        $('#edit').on('click', function(){
            var validado = validarCampos();
            if(validado){
                edit(miruta,campos);
                $('.modal').css('visibility','hidden');
            }
        });
    }
    
    
    /*****************************************************/
    /********************* INSERCION *********************/
    /*****************************************************/
  
  
    //Pide los parametros al servidor para mandarselos al createInsert
    function initAdd(miruta, pojo){
        $.ajax({
            url : "index.php",
            method : "POST",
            data : {
                ruta : miruta,
                accion:'getatributes'
                },
            dataType:'json'
            }).done(function(campos){
                createInsert(miruta,pojo , campos);
            });
    }
  
    //Crea la modal para insertar una nueva fila
    function createInsert(miruta, pojo , campos){
        //$('.modal').toggle();
        $('.modal').css('visibility','visible');
        $('body').css('overflow', 'hidden');
        $('.modal-box').remove();
        $('.modal').append('<div class="modal-box modal-' + pojo +'"><div class="modal-form"><h1 class="header-modal">New ' + pojo +'</h1></div></div>');
        
        var box = $('.modal-form');
        
        if(pojo == 'actividad'){
            createInputActividad(campos, pojo);
        }else{
            createInputGenerico(pojo , campos)
        }
        
        box.append('<button id="add" class="btn">Add</button>');
        var inictialheight = $('.modal-form').outerHeight();
        
        //resizeModal();
        addControllModalAdd(miruta, campos, pojo);
    }

    //Añade los eventos para cerrar y añadir de la ventana modal
    function addControllModalAdd(miruta, campos, pojo){
        $('#add').on('click', function(){
            var validado = validarCampos();
            if(validado){
                insert(miruta, campos, pojo);
                $('.modal').css('visibility','hidden');
            }
        });
    }
    
    
    function closeModal(){
        $('#salir').on('click',function(){
           $('.modal').css('visibility','hidden');
           $('body').css('overflow', 'auto' );
        });
    }
    
    //Lanzamos el ajax para insertar en la bd y mostramos la lista
    function insert(miruta, campos, pojo){
        var formData = new FormData();
        formData.append('ruta', miruta);
        formData.append('accion', 'doinsert');
        var miData = { ruta : miruta , accion : 'doinsert'};
        
        for(var value in campos){
            if(value == 'photo'){
                formData.append(value, $('#'+value)[0].files[0]);
            }else{
                formData.append(value, $('#'+value).val());
            }
        }
        
        $.ajax({
            url : "index.php",
            method : "POST",
            data : formData,
            dataType:'json',
            contentType: false,
            processData: false
        }).done(function( msg ) {
            createTable(msg);
            tablaActual = pojo;
            resetControles();
        }).fail(function( jqXHR, textStatus ) {
            alert( "Request failed: " + textStatus );
        })
    }
    
    function createInputActividad(campos, pojo){
        var box = $('.modal-form');
        for(var value in campos){
            if(value.indexOf('id') != -1 ){
                if(value == 'idTeacher'){
                    box.append('<input id="' + value + '" class="ip-generico  ' + pojo + '" placeholder="' + value + '" type="hidden" name="' + value + '">');
                    $('#'+value).attr('value', currentUser.nick);
                    $('#'+value).attr('disabled', true);
                }
                if(value == 'idGroup'){
                    box.append('<div class="label-animation"><label class="lb-generico" for="' + value +'">' + value + '</lable><input id="' + value + '" class="ip-generico  ' + pojo + '" placeholder="' + value + '" type="text" name="' + value + '"></div>');
                }
            }else if(value == 'day'){
                box.append('<label for="' + value +'">Day</lable>');
                box.append('<input id="' + value + '" class="ip-generico ip-date ' + pojo + '" placeholder="' + value + '" type="date" name="' + value + '">');
                
            }else if(value.indexOf('Time') != -1 ){
                box.append('<label for="' + value +'">' + value + '</lable>');
                box.append('<input id="' + value + '" class="ip-generico ip-time ' + pojo + '" placeholder="' + value + '" type="time" name="' + value + '">');
                
            }else if(value.indexOf('photo') != -1 ){
                box.append('<input id="' + value + '" class="inputfile inputfile2 inputfile-4 ' + pojo + '" placeholder="' + value + '" type="file" name="' + value + '"> <label for="' + value + '"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg><span>Choose a file&hellip;</span></label>');
                
                var inputs = document.querySelectorAll( '.inputfile' );
                Array.prototype.forEach.call( inputs, function( input )
                {
                	var label	 = input.nextElementSibling,
                		labelVal = label.innerHTML;
                
                	input.addEventListener( 'change', function( e )
                	{
                		var fileName = '';
                		if( this.files && this.files.length > 1 )
                			fileName = ( this.getAttribute( 'data-multiple-caption' ) || '' ).replace( '{count}', this.files.length );
                		else
                			fileName = e.target.value.split( '\\' ).pop();
                
                		if( fileName )
                			label.querySelector( 'span' ).innerHTML = fileName;
                		else
                			label.innerHTML = labelVal;
                	});
                });
            }else{
                box.append('<div class="label-animation"><label class="lb-generico" for="' + value +'">' + value + '</lable><input id="' + value + '" class="ip-generico ' + pojo + '" placeholder="' + value + '" type="text" name="' + value + '"></div>');
            }
        }
    }
    
    //A partir de una tabla y unos campos genera un formulario
    function createInputGenerico(pojo , campos){
        var box = $('.modal-form');
        for(var value in campos){
            if(value.indexOf('id') != -1 ){
                
            }else{
                box.append('<div class="label-animation"><label class="lb-generico" for="' + value +'">' + value + '</lable><input id="' + value + '" class="ip-generico ' + pojo + '" placeholder="' + value + '" type="text" name="' + value + '" required></div>');
                if(value == 'idTeacher'){
                    $('#'+value).attr('value', currentUser.nick);
                    $('#'+value).attr('disabled', true);
                }
            }
        }
    }
    
    
    /*******************************************************/
    /********************* ACTIVIDADES *********************/
    /*******************************************************/
    
    //Evento para pedir los datos
    $('#primero').on('click',function(){
        pedirDatos('ajaxactividad');
        tablaActual = 'actividad';
        resetControles();
    });
    
    //Evento para añadir una nueva fila
    $('#primeroAdd').on('click',function(){
        initAdd('ajaxactividad' , 'actividad');
    });
    
    //Funcion que activa y desactiva el editar
    function activarEditActividades(valor){
        if(valor){
            $('#primeroEdit').on('click',function(){
                initEdit('ajaxactividad');
            });
        }else{
            $('#primeroEdit').off('click');
        }
    }
    
    //Funcion que activa y desactiva el borrar
    function activarRemoveActividades(valor){
        if(valor){
            $('#primeroRemove').on('click',function(){
                initRemove('ajaxactividad');
            });
        }else{
            $('#primeroRemove').off('click');
        }
    }
    
    
    /*******************************************************/
    /********************* PROFESORES **********************/
    /*******************************************************/
    
    //Evento para pedir los datos
    $('#segundo').on('click',function(){
        pedirDatos('ajaxprofesor');
        tablaActual = 'profesor';
        resetControles();
    });
    
    //Evento para añadir una nueva fila
    $('#segundoAdd').on('click',function(){
        initAdd('ajaxprofesor' , 'profesor');
    });
    
    //Funcion que activa y desactiva el editar
    function activarEditProfesores(valor){
        if(valor){
            $('#segundoEdit').on('click',function(){
                initEdit('ajaxprofesor');
            });
        }else{
            $('#segundoEdit').off('click');
        }
    }
    
    //Funcion que activa y desactiva el borrar
    function activarRemoveProfesores(valor){
        if(valor){
            $('#segundoRemove').on('click',function(){
                initRemove('ajaxprofesor');
            });
        }else{
            $('#segundoRemove').off('click');
        }
    }
    

    /*******************************************************/
    /*********************** GRUPOS ************************/
    /*******************************************************/
    
    
    //Evento para pedir los datos/ Muestra la lista
    $('#tercero').on('click',function(){
        pedirDatos('ajaxgrupo');
        tablaActual = 'grupo';
        resetControles();
    });
    
    //Evento para añadir una nueva fila
    $('#terceroAdd').on('click',function(){
        initAdd('ajaxgrupo' , 'grupo');
    });
    
    //Funcion que activa y desactiva el editar
    function activarEditGrupos(valor){
        if(valor){
            $('#terceroEdit').on('click',function(){
                initEdit('ajaxgrupo');
            });
        }else{
            $('#terceroEdit').off('click');
        }
    }
    
    //Funcion que activa y desactiva el borrar
    function activarRemoveGrupos(valor){
        if(valor){
            $('#terceroRemove').on('click',function(){
                initRemove('ajaxgrupo');
            });
        }else{
            $('#terceroRemove').off('click');
        }
    }
}());