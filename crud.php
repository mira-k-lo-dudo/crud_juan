<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<?php
class CRUD{

var $bd;

public function __construct($type,$server,$user,$password,$database) {
	include_once "adodb/adodb.inc.php";
	switch ($type) {
		case 'mysqli':
		case 'mariadb':
			$this->bd=newADOConnection("mysqli");
			$this->bd->Connect($server,$user,$password,$database);
			break;
		
		case 'mysql':
			$this->bd=newADOConnection("mysql");
			$vbd->Connect($server,$user,$password,$database);
			break;

	}
	}

public function getColumn($table)
{
	$sql="SHOW COLUMNS FROM $table";
	$datos=$this->bd->Execute($sql)->getRows();
	$array=array();
	$contador=0;
	foreach ($datos as $valor) 
	{
		$array[$contador]['nombre']=$valor[0];
		$array[$contador]['tipo']=$valor[1];
		$contador++;
	}
	return $array;
}

public function getData($table){
	$consulta="select * from $table";
	$datos=$this->bd->Execute($consulta)->getRows();
	return $datos;
}


public function modificarDato($valor)
{
	echo $valor;
}

public function render($table) {
	
	$datos_encabezado=$this->getColumn($table);
	echo " <div class='page-header'><h1><span class='label label-primary'>CRUD de la tabla $table</span></h1></div>";

	echo "<h2><a href='crud_alta.php?tabla=$table'><span class='label label-success'>Alta</span></a></h2>";

	echo " <table class='table'>";
	echo "<tr>";
	foreach ($datos_encabezado as $encabezados)
	{
	echo "<th>".$encabezados['nombre']."</th>";
	}
	echo "<th>Modificar</th><th>Eliminar</th>";
	
	echo "</tr><tr>";
	$datos_tabla=$this->getData($table);
	
	foreach ($datos_tabla as $datostabla)
	{
		$maximo=count($datostabla)/2;
		echo "<tr>";
	for ($i=0;$i<$maximo;$i++) { echo "<td>".$datostabla[$i]."</td>"; }
		
		
		echo "<td><a href='crud_modifica.php?tabla=$table&id=$datostabla[0]' onclick=\"window.open(this.href, this.target, 'toolbar=no, location=no, titlebar=no, status=no, menubar=no,top=100,left=50, width=800'); return false;\" >Modificar</a></td>";
 
		echo "<td><a href='crud_elimina.php?tabla=$table&id=$datostabla[0]' onclick=\"window.open(this.href, this.target, 'toolbar=no, location=no, titlebar=no, status=no, menubar=no,top=100,left=50, width=800'); return false;\" >Eliminar</a></td>";
	
	   	echo "</tr>";
		}

	
}





}
?>