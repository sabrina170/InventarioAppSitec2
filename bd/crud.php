<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

// Recepción de los datos enviados mediante POST desde el JS   

$idEntrega = (isset($_POST['idEntrega'])) ? $_POST['idEntrega'] : '';
$Usuario_codigo = (isset($_POST['Usuario_codigo'])) ? $_POST['Usuario_codigo'] : '';
$Direccion_Llegada = (isset($_POST['Direccion_Llegada'])) ? $_POST['Direccion_Llegada'] : '';
$Distrito = (isset($_POST['Distrito'])) ? $_POST['Distrito'] : '';
$Latitud = (isset($_POST['Latitud'])) ? $_POST['Latitud'] : '';
$Longitud = (isset($_POST['Longitud'])) ? $_POST['Longitud'] : '';
$Guia_Trans = (isset($_POST['Guia_Trans'])) ? $_POST['Guia_Trans'] : '';
$Guia_Remi = (isset($_POST['Guia_Remi'])) ? $_POST['Guia_Remi'] : '';
$Guia_Cliente = (isset($_POST['Guia_Cliente'])) ? $_POST['Guia_Cliente'] : '';
$Estado = (isset($_POST['Estado'])) ? $_POST['Estado'] : '';
$Observaciones = (isset($_POST['Observaciones'])) ? $_POST['Observaciones'] : '';

$opcion = (isset($_POST['opcion'])) ? $_POST['opcion'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO `entregas` (`idEntrega`, `Usuario_codigo`, `Direccion_Llegada`,
        `Distrito`, `Latitud`, `Longitud`, `Guia_Trans`, `Guia_Remi`, `Guia_Cliente`,
         `Estado`, `Observaciones`) VALUES ('$idEntrega', '$Usuario_codigo', '$Direccion_Llegada',
          '$Distrito', '$Latitud', '$Longitud', '$Guia_Trans', '$Guia_Remi', '$Guia_Cliente',
          ' $Estado', '$Observaciones'); ";			
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT * FROM entregas ORDER BY idEntrega DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE Entregas SET Usuario_codigo='$Usuario_codigo', Direccion_Llegada='$Direccion_Llegada',
         Distrito='$Distrito',
         Latitud='$Latitud', Longitud='$Longitud', Guia_Trans='$Guia_Trans',Guia_Remi='$Guia_Remi',
         Guia_Cliente='$Guia_Cliente', Estado='$Estado' , Observaciones='$Observaciones' WHERE idEntrega='$idEntrega' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT idEntrega,Usuario_codigo,Direccion_Llegada,
        Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
        Estado,Observaciones FROM entregas WHERE idEntrega='$idEntrega' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;         
    case 3://baja
        $consulta = "DELETE FROM entregas WHERE idEntrega='$idEntrega' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break; 
    case 4: 
        $consulta = "UPDATE Entregas SET Usuario_codigo='$Usuario_codigo', Direccion_Llegada='$Direccion_Llegada',
         Distrito='$Distrito',
         Latitud='$Latitud', Longitud='$Longitud', Guia_Trans='$Guia_Trans',Guia_Remi='$Guia_Remi',
         Guia_Cliente='$Guia_Cliente', Estado='$Estado' , Observaciones='$Observaciones' WHERE idEntrega='$idEntrega' ";		
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT idEntrega,Usuario_codigo,Direccion_Llegada,
        Distrito,Latitud,Longitud,Guia_Trans,Guia_Remi,Guia_Cliente,
        Estado,Observaciones FROM entregas WHERE idEntrega='$idEntrega' ";       
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;      
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
