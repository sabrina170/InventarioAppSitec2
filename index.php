<?php 
include_once 'bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();

        $condition	=	'';
        if(isset($_REQUEST['xid']) and $_REQUEST['xid']!=""){
			$condition	.=	' AND Id LIKE "%'.$_REQUEST['xid'].'%" ';
		}
        if(isset($_REQUEST['xfecha']) and $_REQUEST['xfecha']!=""){
			$condition	.=	' AND Fecha_Cliente LIKE "%'.$_REQUEST['xfecha'].'%" ';
		}
		if(isset($_REQUEST['xcodigo']) and $_REQUEST['xcodigo']!=""){
			$condition	.=	' AND Cod_Cliente LIKE "%'.$_REQUEST['xcodigo'].'%" ';
		}
		if(isset($_REQUEST['xnombre']) and $_REQUEST['xnombre']!=""){
			$condition	.=	' AND Nombre_Cliente LIKE "%'.$_REQUEST['xnombre'].'%" ';
        }
        if(isset($_REQUEST['xdireccion']) and $_REQUEST['xdireccion']!=""){
			$condition	.=	' AND Direccion_Llegada LIKE "%'.$_REQUEST['xdireccion'].'%" ';
        }
        if(isset($_REQUEST['xdistrito']) and $_REQUEST['xdistrito']!=""){
			$condition	.=	' AND Distrito LIKE "%'.$_REQUEST['xdistrito'].'%" ';
        }
        if(isset($_REQUEST['xlatitud']) and $_REQUEST['xlatitud']!=""){
			$condition	.=	' AND Latitud LIKE "%'.$_REQUEST['xlatitud'].'%" ';
        }
        if(isset($_REQUEST['xlongitud']) and $_REQUEST['xlongitud']!=""){
			$condition	.=	' AND Longitud LIKE "%'.$_REQUEST['xlongitud'].'%" ';
        }
        if(isset($_REQUEST['xguiatrans']) and $_REQUEST['xguiatrans']!=""){
			$condition	.=	' AND Gui_Trans LIKE "%'.$_REQUEST['xguiatrans'].'%" ';
        }
        if(isset($_REQUEST['xguiaremi']) and $_REQUEST['xguiaremi']!=""){
			$condition	.=	' AND Guia_Remi LIKE "%'.$_REQUEST['xguiaremi'].'%" ';
        }
        if(isset($_REQUEST['xguiacliente']) and $_REQUEST['xguiacliente']!=""){
			$condition	.=	' AND Guia_Cliente LIKE "%'.$_REQUEST['xguiacliente'].'%" ';
        }
        if(isset($_REQUEST['xestado']) and $_REQUEST['xestado']!=""){
			$condition	.=	' AND Estado LIKE "%'.$_REQUEST['xestado'].'%" ';
		}

        $consulta="SELECT * from Entregas WHERE 1".$condition."";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);


        if(isset($_POST["export_data"])) {
            if(!empty($data)) {
            $filename = "reporte_entregas.xls";
            header("Content-Type: application/vnd.ms-excel");
            header("Content-Disposition: attachment; filename=".$filename);
           
            $mostrar_columnas = false;
           
            foreach($data as $dat) {
            if(!$mostrar_columnas) {
            echo implode("\t", array_keys($dat)) . "\n";
            $mostrar_columnas = true;
            }
            echo implode("\t", array_values($dat)) . "\n";
            }
           
            }else{
            echo 'No hay datos a exportar';
            }
            exit;
        }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="#" />  
    <title>Inventario</title>
      
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- CSS personalizado --> 
    <link rel="stylesheet" href="main.css">  
      
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!--datables CSS básico-->
    <link rel="stylesheet" type="text/css" href="datatables/datatables.min.css"/>
    <!--datables estilo bootstrap 4 CSS-->  
    <link rel="stylesheet"  type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">       
  </head>
    
  <body> 
     <header>
         <h4 class="text-center text-light"><i class="fa fa-car"></i> Inventario</h4> 
     </header>    
  
    <div class="container2" style="margin:20px; border: 3px #142538 inset;">
            <form method="post" style="margin:20px">
            <div class="form-row">
            <div class="col">
				<a style="margin-left:1230px" ><i class="fa fa-minus" aria-hidden="true"></i></a>
            </div>
            </div>
            <br>
            <div class="form-row">
            <div class="col">
                <input type="number" class="form-control" placeholder="Id Cliente" name="xid"/>
            </div>
            <div class="col">
                <input type="date" class="form-control" placeholder="Fecha" name="xfecha"/>
            </div>
            <div class="col">
                <input type="number"class="form-control" placeholder="Codigo" name="xcodigo"/>
            </div>    
            <div class="col">
				<input type="text" class="form-control" placeholder="Nombre" name="xnombre"/>
            </div>
            <div class="col">
                <input type="text" class="form-control" placeholder="Direccion" name="xdireccion"/>
            </div>
            <div class="col">
                                    <select name="xdistrito" id="" class="form-control">
                                        <option value="">Distrito</option>
                                        <?php
                                            foreach($data as $dat)
                                            {
                                        ?>
                                            <option value="<?php echo $dat['Distrito'] ?>"><?php echo $dat['Distrito'] ?></option>
                                        <?php        
                                            }
                                        ?>
                                    </select>
                                    </div>
            </div>
            <br>
            <div class="form-row">
            <div class="col">
                <input type="float" class="form-control" placeholder="Latitud" name="latitud"/>
            </div>
            <div class="col">
                <input type="float" class="form-control" placeholder="Longitud" name="xlongitud"/>
            </div>
            <div class="col">
				<input type="number" class="form-control" placeholder="Guia Transitable" name="xguiatrans"/>
            </div>
            <div class="col">
                <input type="number" class="form-control" placeholder="Guia Remitente" name="xguiaremi"/>
            </div>
            <div class="col">
				<input type="number" class="form-control" placeholder="Guia Cliente" name="xguiacliente"/>
            </div>
            <div class="col">
                                    <select name="xestado" id="" class="form-control">
                                        <option value="">Estado</option>
                                        <?php
                                            foreach($data as $dat)
                                            {
                                        ?>
                                            <option value="<?php echo $dat['Estado'] ?>"><?php echo $dat['Estado'] ?></option>
                                        <?php        
                                            }
                                        ?>
                                    </select> 
                                    </div>
            </div>
            <br>
            <div class="form-row">
            <div class="col">
				<button style="margin-left:1153px" class="btn btn-info"name="buscar" type="submit"><i class="fa fa-search" aria-hidden="true"></i>Consultar</button>
            </div>
            </div>
            
			</form>
    </div>      
    
                
              
    <div class="container2" style="margin:20px; border-bolor:green;">
        <div class="row" style="margin:10px">
        
            <!--<a class="btn btn-primary" href="index.php" role="button">Mostrar lista total</a>  --> 
       
        <form  style="margin:10px;" action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post">
                <button class="btn btn-info"><i class="fa fa-cog" aria-hidden="true"></i></button>
                <button type="submit" id="export_data" name='export_data' value="Export to excel" class="btn btn-info">Export to excel</button>
                <button id="btnNuevo" type="button" class="btn btn-success" data-toggle="modal">Nuevo</button> 
        </form>
                <div class="col-lg-12">
                    <div class="table-responsive">        
                        <table id="tablaPersonas" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                
                            
                                <th>Id</th>
                                <th>Fecha</th>
                                <th>Código</th>
                                <th>Nombre</th>           
                                <th>Dirección</th>  
                                <th>Distrito</th>   
                                <th>Lat.</th>
                                <th>Long.</th>
                                <th>GT</th>                                
                                <th>GR</th> 
                                <th>GC</th>                                
                                <th>Estado</th>
                                <th>Obs.</th> 
                                <th>Accionesdddd</th>                   
                            </tr>
                        </thead>
                        <tbody>
                            <?php                            
                            foreach($data as $dat) {                                                        
                            ?>
                            <tr>
                            
                                <td><?php echo $dat['Id'] ?></td>
                                <td><?php echo $dat['Fecha_Cliente'] ?></td>
                                <td><?php echo $dat['Cod_Cliente'] ?></td>
                                <td><?php echo $dat['Nombre_Cliente'] ?></td>    
                                <td><?php echo $dat['Direccion_Llegada'] ?></td>
                                <td><?php echo $dat['Distrito'] ?></td>
                                <td><?php echo $dat['Latitud'] ?></td>
                                <td><?php echo $dat['Longitud'] ?></td>  
                                <td><?php echo $dat['Gui_Trans'] ?></td>
                                <td><?php echo $dat['Guia_Remi'] ?></td>
                                <td><?php echo $dat['Guia_Cliente'] ?></td>
                                <td><?php echo $dat['Estado'] ?></td> 
                                <td><?php echo $dat['Observaciones'] ?></td>
                                <td>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>                                
                        </tbody>        
                       </table>                    
                    </div>
                </div>
        </div>  
    </div>    
      
<!--Modal para CRUD-->
<div class="modal fade" id="modalCRUD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">    
            <div class="modal-body">

                <div class="form-row">
                <div class="col">
                <label for="nombre" class="col-form-label">Fecha:</label>
                <input type="date" class="form-control" id="Fecha_Cliente">
                </div>
                <div class="col">
                <label for="pais" class="col-form-label">Codigo:</label>
                <input type="number" class="form-control" id="Cod_Cliente">
                </div>
                </div>

                <div class="form-row">
                <div class="col">
                <label for="edad" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="Nombre_Cliente">
                </div>   
                <div class="col">
                <label for="nombre" class="col-form-label">Distrito:</label>
                <input type="text" class="form-control" id="Direccion_Llegada">
                </div>
                </div>

              
                <div class="form-group">
                <label for="pais" class="col-form-label">Direccion de Llegada:</label>
                <input type="text" class="form-control" id="Distrito">
                </div>     

                <div class="form-row">       
                <div class="col">
                <label for="edad" class="col-form-label" step='0.01' value='0.00' placeholder='0.00'>Latitud:</label>
                <input type="float" class="form-control" id="Latitud">
                </div>  
                <div class="col">
                <label for="nombre" class="col-form-label" >Longitud:</label>
                <input type="float" class="form-control" id="Longitud">
                </div>
                </div>

                <div class="form-row">  
                <div class="col">
                <label for="pais" class="col-form-label">Gria Transportista:</label>
                <input type="number" class="form-control" id="Gui_Trans">
                </div>                
                <div class="col">
                <label for="edad" class="col-form-label">Guia Rem:</label>
                <input type="number" class="form-control" id="Guia_Remi">
                </div>  
                <div class="col">
                <label for="edad" class="col-form-label">Guia Cliente:</label>
                <input type="number" class="form-control" id="Guia_Cliente">
                </div>    
                </div>


                <div class="form-group">
                <label for="edad" class="col-form-label">Estado:</label>
                <input type="text" class="form-control" id="Estado">
                </div>  
                <div class="form-group">
                <label for="edad" class="col-form-label">Observaciones:</label>
                <input type="text" class="form-control" id="Observaciones">
                </div>          
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
            </div>
        </form>    
        </div>
    </div>
</div>
<!-- Modal Detalles-->
<div class="modal fade" id="modalVER" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
        <form id="formPersonas">   
        <fieldset disabled> 
            <div class="modal-body">

                <div class="form-row">
                <div class="col">
                <label for="nombre" class="col-form-label">Fecha:</label>
                <input type="date" class="form-control" id="Fecha_Cliente2">
                </div>
                <div class="col">
                <label for="pais" class="col-form-label">Codigo:</label>
                <input type="number" class="form-control" id="Cod_Cliente2">
                </div>
                </div>

                <div class="form-row">
                <div class="col">
                <label for="edad" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="Nombre_Cliente2">
                </div>   
                <div class="col">
                <label for="nombre" class="col-form-label">Distrito:</label>
                <input type="text" class="form-control" id="Direccion_Llegada2">
                </div>
                </div>

              
                <div class="form-group">
                <label for="pais" class="col-form-label">Direccion de Llegada:</label>
                <input type="text" class="form-control" id="Distrito2">
                </div>     

                <div class="form-row">       
                <div class="col">
                <label for="edad" class="col-form-label" step='0.01' value='0.00' placeholder='0.00'>Latitud:</label>
                <input type="float" class="form-control" id="Latitud2">
                </div>  
                <div class="col">
                <label for="nombre" class="col-form-label" >Longitud:</label>
                <input type="float" class="form-control" id="Longitud2">
                </div>
                </div>

                <div class="form-row">  
                <div class="col">
                <label for="pais" class="col-form-label">Gria Transportista:</label>
                <input type="number" class="form-control" id="Gui_Trans2">
                </div>                
                <div class="col">
                <label for="edad" class="col-form-label">Guia Rem:</label>
                <input type="number" class="form-control" id="Guia_Remi2">
                </div>  
                <div class="col">
                <label for="edad" class="col-form-label">Guia Cliente:</label>
                <input type="number" class="form-control" id="Guia_Cliente2">
                </div>    
                </div>


                <div class="form-group">
                <label for="edad" class="col-form-label">Estado:</label>
                <input type="text" class="form-control" id="Estado2">
                </div>  
                <div class="form-group">
                <label for="edad" class="col-form-label">Observaciones:</label>
                <input type="text" class="form-control" id="Observaciones2">
                </div>          
            </div>
            </fieldset>
        </form>    
        </div>
    </div>
</div>

      
    <!-- jQuery, Popper.js, Bootstrap JS -->
    <script src="jquery/jquery-3.3.1.min.js"></script>
    <script src="popper/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
      
    <!-- datatables JS -->
    <script type="text/javascript" src="datatables/datatables.min.js"></script>    
     
    <script type="text/javascript" src="main.js"></script>  
    
    
  </body>
</html>
