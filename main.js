$(document).ready(function(){
    tablaPersonas = $("#tablaPersonas").DataTable({
       "columnDefs":[{
        "targets": -1,
        "data":null,
        "defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btnEditar'><i class='fa fa-edit'></i></button><button class='btn btn-danger btnBorrar'><i class='fa fa-trash'></i></button><button class='btn btn-success btnVer'><i class='fa fa-eye' aria-hidden='true'></i></button></div></div>  "  
       }],
        
        //Para cambiar el lenguaje a español
    "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
             },
             "sProcessing":"Procesando...",
        },
        "lengthMenu":		[[3, 10, 20, 25, 50, -1], [3, 10, 20, 25, 50, "Todos"]],
			"iDisplayLength":	3,
			"bJQueryUI":		false,
			
    });
    
$("#btnNuevo").click(function(){
    $("#formPersonas").trigger("reset");
    $(".modal-header").css("background-color", "#28a745");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Nuevo registro");            
    $("#modalCRUD").modal("show");        
    idEntrega=null;
    opcion = 1; //alta
   

});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    idEntrega = parseInt(fila.find('td:eq(0)').text());
    Usuario_codigo = parseInt(fila.find('td:eq(1)').text());
    Direccion_Llegada = fila.find('td:eq(2)').text();
    Distrito = fila.find('td:eq(3)').text();
    Latitud = parseFloat(fila.find('td:eq(4)').text());
    Longitud = parseFloat(fila.find('td:eq(5)').text());
    Guia_Trans = parseInt(fila.find('td:eq(6)').text());
    Guia_Remi = parseInt(fila.find('td:eq(7)').text());
    Guia_Cliente = parseInt(fila.find('td:eq(8)').text());
    Estado = fila.find('td:eq(9)').text();
    Observaciones = fila.find('td:eq(10)').text();
    
    
    $("#Usuario_codigo").val(Usuario_codigo);
    $("#Direccion_Llegada").val(Direccion_Llegada);
    $("#Distrito").val(Distrito);
    $("#Latitud").val(Latitud);
    $("#Longitud").val(Longitud);
    $("#Guia_Trans").val(Guia_Trans);
    $("#Guia_Remi").val(Guia_Remi);
    $("#Guia_Cliente").val(Guia_Cliente);
    $("#Estado").val(Estado);
    $("#Observaciones").val(Observaciones);
    opcion = 2; //editar
    
    $(".modal-header").css("background-color", "#007bff");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Editar Persona");            
    $("#modalCRUD").modal("show");  
    
});
//botón VERDETALLES

$(document).on("click", ".btnVer", function(){
    fila = $(this).closest("tr");
    idEntrega = parseInt(fila.find('td:eq(0)').text());
    Usuario_codigo = parseInt(fila.find('td:eq(1)').text());
    Direccion_Llegada = fila.find('td:eq(2)').text();
    Distrito = fila.find('td:eq(3)').text();
    Latitud = parseFloat(fila.find('td:eq(4)').text());
    Longitud = parseFloat(fila.find('td:eq(5)').text());
    Guia_Trans = parseInt(fila.find('td:eq(6)').text());
    Guia_Remi = parseInt(fila.find('td:eq(7)').text());
    Guia_Cliente = parseInt(fila.find('td:eq(8)').text());
    Estado = fila.find('td:eq(9)').text();
    Observaciones = fila.find('td:eq(10)').text();
    
    
    $("#Usuario_codigo2").val(Usuario_codigo);
    $("#Direccion_Llegada2").val(Direccion_Llegada);
    $("#Distrito2").val(Distrito);
    $("#Latitud2").val(Latitud);
    $("#Longitud2").val(Longitud);
    $("#Guia_Trans2").val(Guia_Trans);
    $("#Guia_Remi2").val(Guia_Remi);
    $("#Guia_Cliente2").val(Guia_Cliente);
    $("#Estado2").val(Estado);
    $("#Observaciones2").val(Observaciones);
    opcion = 4; //ver detalles
    
    $(".modal-header").css("background-color", "green");
    $(".modal-header").css("color", "white");
    $(".modal-title").text("Detalles");            
    $("#modalVER").modal("show");  
    
});


//botón BORRAR
$(document).on("click", ".btnBorrar", function(){    
    fila = $(this);
    idEntrega = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+idEntrega+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, idEntrega:idEntrega},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }   
    header("location:index.php");
});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    Usuario_codigo = $.trim($("#Usuario_codigo").val());
    Direccion_Llegada = $.trim($("#Direccion_Llegada").val());
    Distrito = $.trim($("#Distrito").val()); 
    Latitud = $.trim($("#Latitud").val());    
    Longitud = $.trim($("#Longitud").val());    
    Guia_Trans = $.trim($("#Guia_Trans").val());    
    Guia_Remi = $.trim($("#Guia_Remi").val());    
    Guia_Cliente = $.trim($("#Guia_Cliente").val());    
    Estado = $.trim($("#Estado").val());  
    Observaciones = $.trim($("#Observaciones").val());  
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Usuario_codigo:Usuario_codigo, 
            Direccion_Llegada:Direccion_Llegada,
            Distrito:Distrito,Latitud:Latitud,
            Longitud:Longitud, Guia_Trans:Guia_Trans,
            Guia_Remi:Guia_Remi,Guia_Cliente:Guia_Cliente,
            Estado:Estado,Observaciones:Observaciones,
            idEntrega:idEntrega, opcion:opcion},
        success: function(data){  
            console.log(data);
            idEntrega = data[0].idEntrega;            
            Usuario_codigo = data[0].Usuario_codigo;
            Direccion_Llegada = data[0].Direccion_Llegada;
            Distrito = data[0].Distrito;
            Latitud = data[0].Latitud;
            Longitud = data[0].Longitud;
            Guia_Trans = data[0].Guia_Trans;
            Guia_Remi = data[0].Guia_Remi;
            Guia_Cliente = data[0].Guia_Cliente;
            Estado = data[0].Estado;
            Observaciones = data[0].Observaciones;
            
            if(opcion == 1){tablaPersonas.row.add([idEntrega,Usuario_codigo,Direccion_Llegada,
                Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
                Estado,Observaciones]).draw();}
            else{tablaPersonas.row(fila).data([idEntrega,Usuario_codigo,Direccion_Llegada,
                Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
                Estado,Observaciones]).draw();}               
        }        
    });
    $("#modalCRUD").modal("hide");    
});    

$("#form").submit(function(e){
    e.preventDefault();    
    Usuario_codigo = $.trim($("#Usuario_codigo").val());
    Direccion_Llegada = $.trim($("#Direccion_Llegada").val());
    Distrito = $.trim($("#Distrito").val()); 
    Latitud = $.trim($("#Latitud").val());    
    Longitud = $.trim($("#Longitud").val());    
    Guia_Trans = $.trim($("#Guia_Trans").val());    
    Guia_Remi = $.trim($("#Guia_Remi").val());    
    Guia_Cliente = $.trim($("#Guia_Cliente").val());    
    Estado = $.trim($("#Estado").val());  
    Observaciones = $.trim($("#Observaciones").val());  
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Usuario_codigo:Usuario_codigo, 
            Direccion_Llegada:Direccion_Llegada,
            Distrito:Distrito,Latitud:Latitud,
            Longitud:Longitud, Guia_Trans:Guia_Trans,
            Guia_Remi:Guia_Remi,Guia_Cliente:Guia_Cliente,
            Estado:Estado,Observaciones:Observaciones,
            idEntrega:idEntrega, opcion:opcion},
        success: function(data){  
            console.log(data);
            idEntrega = data[0].idEntrega;            
            Usuario_codigo = data[0].Usuario_codigo;
            Direccion_Llegada = data[0].Direccion_Llegada;
            Distrito = data[0].Distrito;
            Latitud = data[0].Latitud;
            Longitud = data[0].Longitud;
            Guia_Trans = data[0].Guia_Trans;
            Guia_Remi = data[0].Guia_Remi;
            Guia_Cliente = data[0].Guia_Cliente;
            Estado = data[0].Estado;
            Observaciones = data[0].Observaciones;
            
            if(opcion == 1){tablaPersonas.row.add([idEntrega,Usuario_codigo,Direccion_Llegada,
                Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
                Estado,Observaciones]).draw();}
            else{tablaPersonas.row(fila).data([idEntrega,Usuario_codigo,Direccion_Llegada,
                Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
                Estado,Observaciones]).draw();}            
        }        
    }); 
    $("#modalVER").modal("hide");   
});    
    
});