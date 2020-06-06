<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$Id = (isset($_POST['Id'])) ? $_POST['Id'] : '';
$Fecha_Cliente = (isset($_POST['Fecha_Cliente'])) ? $_POST['Fecha_Cliente'] : '';
$Cod_Cliente = (isset($_POST['Cod_Cliente'])) ? $_POST['Cod_Cliente'] : '';
$Nombre_Cliente = (isset($_POST['Nombre_Cliente'])) ? $_POST['Nombre_Cliente'] : '';
$Direccion_Llegada = (isset($_POST['Direccion_Llegada'])) ? $_POST['Direccion_Llegada'] : '';
$Distrito = (isset($_POST['Distrito'])) ? $_POST['Distrito'] : '';
$Latitud = (isset($_POST['Latitud'])) ? $_POST['Latitud'] : '';
$Longitud = (isset($_POST['Longitud'])) ? $_POST['Longitud'] : '';
$Gui_Trans = (isset($_POST['Gui_Trans'])) ? $_POST['Gui_Trans'] : '';
$Guia_Remi = (isset($_POST['Guia_Remi'])) ? $_POST['Guia_Remi'] : '';
$Guia_Cliente = (isset($_POST['Guia_Cliente'])) ? $_POST['Guia_Cliente'] : '';
$Estado= (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
$Observaciones = (isset($_POST['Observaciones'])) ? $_POST['Observaciones'] : '';
$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';
switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO Entregas (Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
        Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
        Guia_Cliente, Estado, Observaciones) VALUES('$Id', '$Fecha_Cliente', '$Cod_Cliente',
        '$Nombre_Cliente', '$Direccion_Llegada','$Distrito', '$Latitud','$Longitud',  
        '$Gui_Trans','$Guia_Remi', '$Guia_Cliente', '$Estado','$Observaciones') ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
        Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
        Guia_Cliente, Estado, Observaciones FROM Entregas ORDER BY Id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE Entregas SET Fecha_Cliente='$Fecha_Cliente', Cod_Cliente='$Cod_Cliente',
         Nombre_Cliente='$Nombre_Cliente', Direccion_Llegada='$Direccion_Llegada', Distrito='$Distrito',
         Latitud='$Latitud' ,Longitud='$Longitud', Gui_Trans='$Gui_Trans',
         Guia_Remi='$Guia_Remi' , Guia_Cliente='$Guia_Cliente' ,Estado='$Estado', Observaciones='$Observaciones' WHERE  Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
        Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
        Guia_Cliente, Estado, Observaciones FROM Entregas WHERE Id='$Id' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM Entregas WHERE Id='$Id' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();   
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);                        
        break;   
    case 4: 
        $consulta = "UPDATE Entregas SET Fecha_Cliente='$Fecha_Cliente', Cod_Cliente='$Cod_Cliente',
        Nombre_Cliente='$Nombre_Cliente', Direccion_Llegada='$Direccion_Llegada', Distrito='$Distrito',
        Latitud='$Latitud' ,Longitud='$Longitud', Gui_Trans='$Gui_Trans',
        Guia_Remi='$Guia_Remi' , Guia_Cliente='$Guia_Cliente' ,Estado='$Estado', Observaciones='$Observaciones' WHERE  Id='$Id' ";		
       $resultado = $conexion->prepare($consulta);
       $resultado->execute();        
       
       $consulta = "SELECT Id, Fecha_Cliente, Cod_Cliente, Nombre_Cliente, 
       Direccion_Llegada, Distrito, Latitud, Longitud, Gui_Trans, Guia_Remi, 
       Guia_Cliente, Estado, Observaciones FROM Entregas WHERE Id='$Id' ";       
       $resultado = $conexion->prepare($consulta);
       $resultado->execute();
       $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
       break;     
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
