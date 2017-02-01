<?php 
include "../crud.php";
if (!(isset($_GET['id'])))
{
?>
<script type="text/javascript">
	window.history.back();
</script>
<?php	
}
$id=$_GET['id'];
@session_start();
if (!(isset($_SESSION['type'])))
{
?>
<script type="text/javascript">
	window.history.back();
</script>
<?php	
}	$type=$_SESSION['type'];
	$servidor=$_SESSION['servidor'];
	$usuario=$_SESSION['usuario'];
	$password=$_SESSION['password'];
	$basedatos=$_SESSION['basedatos'];
	$table=$_SESSION['table'];
$crud=new CRUD($type,$servidor,$usuario,$password,$basedatos);
$campo=$crud->getFirstValue($table);


$datos=$crud->eliminadato($table,$campo,$id);
?>
<script type="text/javascript">
	window.history.back();
</script>

