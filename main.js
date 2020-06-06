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
    Id=null;
    opcion = 1; //alta
   

});    
    
var fila; //capturar la fila para editar o borrar el registro
    
//botón EDITAR    
$(document).on("click", ".btnEditar", function(){
    fila = $(this).closest("tr");
    Id = parseInt(fila.find('td:eq(0)').text());
    Fecha_Cliente = fila.find('td:eq(1)').text();
    Cod_Cliente = parseInt(fila.find('td:eq(2)').text());
    Nombre_Cliente= fila.find('td:eq(3)').text();
    Direccion_Llegada = fila.find('td:eq(4)').text();
    Distrito = fila.find('td:eq(5)').text();
    Latitud = parseInt(fila.find('td:eq(6)').text());
    Longitud = parseInt(fila.find('td:eq(7)').text());
    Gui_Trans = parseInt(fila.find('td:eq(8)').text());
    Guia_Remi = parseInt(fila.find('td:eq(9)').text());
    Guia_Cliente = parseInt(fila.find('td:eq(10)').text());
    Estado = fila.find('td:eq(11)').text();
    Observaciones = fila.find('td:eq(12)').text();
    
    
    $("#Fecha_Cliente").val(Fecha_Cliente);
    $("#Cod_Cliente").val(Cod_Cliente);
    $("#Nombre_Cliente").val(Nombre_Cliente);
    $("#Direccion_Llegada").val(Direccion_Llegada);
    $("#Distrito").val(Distrito);
    $("#Latitud").val(Latitud);
    $("#Longitud").val(Longitud);
    $("#Gui_Trans").val(Gui_Trans);
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
    Id = parseInt(fila.find('td:eq(0)').text());
    Fecha_Cliente = fila.find('td:eq(1)').text();
    Cod_Cliente = parseInt(fila.find('td:eq(2)').text());
    Nombre_Cliente= fila.find('td:eq(3)').text();
    Direccion_Llegada = fila.find('td:eq(4)').text();
    Distrito = fila.find('td:eq(5)').text();
    Latitud = parseInt(fila.find('td:eq(6)').text());
    Longitud = parseInt(fila.find('td:eq(7)').text());
    Gui_Trans = parseInt(fila.find('td:eq(8)').text());
    Guia_Remi = parseInt(fila.find('td:eq(9)').text());
    Guia_Cliente = parseInt(fila.find('td:eq(10)').text());
    Estado = fila.find('td:eq(11)').text();
    Observaciones = fila.find('td:eq(12)').text();
    
    
    $("#Fecha_Cliente2").val(Fecha_Cliente);
    $("#Cod_Cliente2").val(Cod_Cliente);
    $("#Nombre_Cliente2").val(Nombre_Cliente);
    $("#Direccion_Llegada2").val(Direccion_Llegada);
    $("#Distrito2").val(Distrito);
    $("#Latitud2").val(Latitud);
    $("#Longitud2").val(Longitud);
    $("#Gui_Trans2").val(Gui_Trans);
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
    Id = parseInt($(this).closest("tr").find('td:eq(0)').text());
    opcion = 3 //borrar
    var respuesta = confirm("¿Está seguro de eliminar el registro: "+Id+"?");
    if(respuesta){
        $.ajax({
            url: "bd/crud.php",
            type: "POST",
            dataType: "json",
            data: {opcion:opcion, Id:Id},
            success: function(){
                tablaPersonas.row(fila.parents('tr')).remove().draw();
            }
        });
    }
    header("location:index.php");

});
    
$("#formPersonas").submit(function(e){
    e.preventDefault();    
    Fecha_Cliente = $.trim($("#Fecha_Cliente").val());
    Cod_Cliente = $.trim($("#Cod_Cliente").val());
    Nombre_Cliente = $.trim($("#Nombre_Cliente").val());    
    Direccion_Llegada = $.trim($("#Direccion_Llegada").val());
    Distrito = $.trim($("#Distrito").val());
    Latitud = $.trim($("#Latitud").val()); 
    Longitud = $.trim($("#Longitud").val());
    Gui_Trans = $.trim($("#Gui_Trans").val());
    Guia_Remi = $.trim($("#Guia_Remi").val()); 
    Guia_Cliente = $.trim($("#Guia_Cliente").val());
    Estado = $.trim($("#Estado").val());
    Observaciones = $.trim($("#Observaciones").val()); 
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Fecha_Cliente:Fecha_Cliente, Cod_Cliente:Cod_Cliente, Nombre_Cliente:Nombre_Cliente, 
            Direccion_Llegada:Direccion_Llegada, Distrito:Distrito, Latitud:Latitud, 
            Longitud:Longitud, Gui_Trans:Gui_Trans, Guia_Remi:Guia_Remi, Guia_Cliente:Guia_Cliente, 
            Estado:Estado, Observaciones:Observaciones, 
            Id:Id, opcion:opcion},
        success: function(data){  
            console.log(data);
            Id = data[0].Id;            
            Fecha_Cliente = data[0].Fecha_Cliente;
            Cod_Cliente = data[0].Cod_Cliente;
            Nombre_Cliente = data[0].Nombre_Cliente;
            Direccion_Llegada = data[0].Direccion_Llegada;
            Distrito = data[0].Distrito;
            Latitud = data[0].Latitud;
            Longitud = data[0].Longitud;
            Gui_Trans = data[0].Gui_Trans;
            Guia_Remi = data[0].Guia_Remi;
            Guia_Cliente = data[0].Guia_Cliente;
            Estado = data[0].Estado;
            Observaciones = data[0].Observaciones;
            
            if(opcion == 1){tablaPersonas.row.add([Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
                Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
                Guia_Cliente, Estado, Observaciones]).draw();}
            else{tablaPersonas.row(fila).data([Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
                Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
                Guia_Cliente, Estado, Observaciones]).draw();}            
        }        
    });
    $("#modalCRUD").modal("hide");    
});    

$("#form").submit(function(e){
    e.preventDefault();    
    Fecha_Cliente = $.trim($("#Fecha_Cliente2").val());
    Cod_Cliente = $.trim($("#Cod_Cliente2").val());
    Nombre_Cliente = $.trim($("#Nombre_Cliente2").val());    
    Direccion_Llegada = $.trim($("#Direccion_Llegada2").val());
    Distrito = $.trim($("#Distrito2").val());
    Latitud = $.trim($("#Latitud2").val()); 
    Longitud = $.trim($("#Longitud2").val());
    Gui_Trans = $.trim($("#Gui_Trans2").val());
    Guia_Remi = $.trim($("#Guia_Remi2").val()); 
    Guia_Cliente = $.trim($("#Guia_Cliente2").val());
    Estado = $.trim($("#Estado2").val());
    Observaciones = $.trim($("#Observaciones2").val()); 
    $.ajax({
        url: "bd/crud.php",
        type: "POST",
        dataType: "json",
        data: {Fecha_Cliente:Fecha_Cliente, Cod_Cliente:Cod_Cliente, Nombre_Cliente:Nombre_Cliente, 
            Direccion_Llegada:Direccion_Llegada, Distrito:Distrito, Latitud:Latitud, 
            Longitud:Longitud, Gui_Trans:Gui_Trans, Guia_Remi:Guia_Remi, Guia_Cliente:Guia_Cliente, 
            Estado:Estado, Observaciones:Observaciones, 
            Id:Id, opcion:opcion},
        success: function(data){  
            console.log(data);
            Id = data[0].Id;            
            Fecha_Cliente = data[0].Fecha_Cliente;
            Cod_Cliente = data[0].Cod_Cliente;
            Nombre_Cliente = data[0].Nombre_Cliente;
            Direccion_Llegada = data[0].Direccion_Llegada;
            Distrito = data[0].Distrito;
            Latitud = data[0].Latitud;
            Longitud = data[0].Longitud;
            Gui_Trans = data[0].Gui_Trans;
            Guia_Remi = data[0].Guia_Remi;
            Guia_Cliente = data[0].Guia_Cliente;
            Estado = data[0].Estado;
            Observaciones = data[0].Observaciones;
            
            if(opcion == 1){tablaPersonas.row.add([Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
                Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
                Guia_Cliente, Estado, Observaciones]).draw();}
            else{tablaPersonas.row(fila).data([Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
                Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
                Guia_Cliente, Estado, Observaciones]).draw();}            
        }        
    }); 
    $("#modalVER").modal("hide");   
});    
    
});