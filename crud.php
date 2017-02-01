<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://bootswatch.com/united/bootstrap.min.css">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<?php
class CRUD{

var $bd;

public function __construct($type, $servidor,$usuario,$password,$basedatos)	{
	@session_start();
	$_SESSION['type']=$type;
	$_SESSION['servidor']=$servidor;
	$_SESSION['usuario']=$usuario;
	$_SESSION['password']=$password;
	$_SESSION['basedatos']=$basedatos;

	switch ($type) {
		case 'mysql':
		case 'mysqli':
		case 'mariadb':
			try {
			$this->bd=new PDO("mysql:host=$servidor;dbname=$basedatos", $usuario, $password);
			}
		catch (PDOException $e) {
			die("Error al conectar con el SGBD o la BD no existe. No puedo continuar ...");
		}
	}
	}

public function getFirstValue($table) {
$sql="SHOW COLUMNS FROM $table";
	$datos=$this->bd->query($sql)->fetch();
	$valor=$datos[0];
	return $valor;
	}


public function getColumn($table)
{
	$sql="SHOW COLUMNS FROM $table";
	$datos=$this->bd->query($sql)->fetchAll();
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
	$datos=$this->bd->query($consulta)->fetchAll();
	return $datos;
}

public function eliminadato($table,$campo,$id) {
$tipo=gettype($id);

			switch ($tipo) {
				case 'integer':
				case 'double':
					$consulta="DELETE FROM $table WHERE $campo=$id";
					break;
				default:
					$consulta="DELETE FROM $table WHERE $campo='$id'";
				}
	
	$this->bd->query($consulta);
}


public function modificarDato($valor)
{
	echo $valor;
}

public function render($table) {
	$_SESSION['table']=$table;
	$datos_encabezado=$this->getColumn($table);
	echo " <div class='page-header'><h1><span class='label label-primary'>CRUD de la tabla $table</span></h1></div>";

	echo "<h2><a href='ges/crud_alta.php'><span class='label label-success'>Alta</span></a></h2>";

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
	for ($i=0;$i<$maximo;$i++) { echo "<td>".utf8_encode($datostabla[$i])."</td>"; }
		
		
		echo "<td><a href='ges/crud_modifica.php?id=$datostabla[0]' onclick=\"window.open(this.href, this.target, 'toolbar=no, location=no, titlebar=no, status=no, menubar=no,top=100,left=50, width=800'); return false;\" >Modificar</a></td>";
 
		echo "<td><a href='ges/crud_elimina.php?id=$datostabla[0]' onclick=\"return confirm('Esta seguro?');\">Eliminar</a></td>";
	
	   	echo "</tr>";
		}

	
}

public function inserta_datos($table, $elementos) {
$cadena="INSERT INTO $table VALUES(";
		foreach ($elementos as $dato) {
			$tipo=gettype($dato);
			switch ($tipo) {
				case 'integer':
				case 'double':
					$cadena=$cadena.$dato;
					break;
				default:
					$cadena=$cadena."'".$dato."'";
			}
			$cadena=$cadena.",";
		}
		$cadena= substr($cadena, 0, -1);
		$cadena=$cadena.")";
		echo $cadena;
}

public function formularioInsertar($datos,$table) {

echo " <div class='page-header'><h1><span class='label label-primary'>Alta de la tabla de la tabla $table</span></h1></div>";
echo "<form method='post' action=''>";
echo "<table class='table'>";
	foreach ($datos as $linea) {
		
		echo "<tr><td><label>".$linea['nombre']."</label></td><td>";
		$porciones = explode("(", $linea['tipo']);
		switch ($porciones[0]) {
			case "int":
				echo "<input type='number' name=valores[]>";
				break;
			case "float":
				echo "<input type='number' step='0.01' name=valores[]>";
				break;
			case "varchar":
				echo "<input type='text' name=valores[]>";
				break;
			case "date":
				echo "<input type='date' name=valores[]>";
				break;
			case "text":
				echo "<textarea name=valores[]></textarea>";
				break;
			default :
				echo $porciones[0];



}
		echo "</td></tr>";
		

}
echo "</table><input type='submit' name='aceptar'></form>";
} 

}
?>