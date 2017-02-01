<?php 
include "../crud.php";
@session_start();
	$type=$_SESSION['type'];
	$servidor=$_SESSION['servidor'];
	$usuario=$_SESSION['usuario'];
	$password=$_SESSION['password'];
	$basedatos=$_SESSION['basedatos'];
	$table=$_SESSION['table'];
$crud=new CRUD($type,$servidor,$usuario,$password,$basedatos);

if (!(isset($_POST['aceptar']))){
$datos=$crud->getColumn($table);
$crud->formularioInsertar($datos,$table);}
else
{
	$valores=$_POST['valores'];
	print_r($valores);
	//$crud->insertadatos($table,$valores);
	
}




 ?>