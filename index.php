<?php
include "crud.php";

$crud=new CRUD("mysqli","localhost","root","","inmobiliaria_ci");

$crud->render("vivienda");
?>