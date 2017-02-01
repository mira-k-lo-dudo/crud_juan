<?php
include "crud.php";

$crud=new CRUD("mysqli","localhost","root","","lidia");

$crud->render("catalogo");
?>