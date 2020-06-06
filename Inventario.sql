USE inventario

CREATE TABLE Entregas
(
Id INT PRIMARY KEY AUTO_INCREMENT,
Fecha_Cliente DATE,
Cod_Cliente INT(10),
Nombre_Cliente VARCHAR(30),
Direccion_Llegada VARCHAR(30),
Distrito VARCHAR(30),
Latitud DOUBLE,
Longitud DOUBLE,
Gui_Trans INT(10),
Guia_Remi INT(10),
Guia_Cliente INT(10),
Estado VARCHAR(30),
Observaciones VARCHAR(100)
)

DROP TABLE Entregas

INSERT INTO `entregas`(`Id`, `Fecha_Cliente`, `Cod_Cliente`, `Nombre_Cliente`, 
`Direccion_Llegada`, `Distrito`, `Latitud`, `Longitud`, `Gui_Trans`, `Guia_Remi`, 
`Guia_Cliente`, `Estado`, `Observaciones`)
 VALUES (1,'2020-05-03',10901333,'Sabrina',
 'Los Deportes','Chaclacayo',-4.2251458,-5.225478754,140,
 150,452,'Entregado','Retraso de 30 min por trafico')
 
 SELECT * FROM Entregas