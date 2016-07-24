CRUD
====

crud es una clase realizada en PHP que permite realizar CRUDs (CRUD es el acronimo en ingles de Create, Read, Update y Delete, es decir Crear, Leer, Actualizar y Borrar) sobre tablas de nuestra base de datos, es ideal para generar back-ends de nuestras aplicaciones de forma rapida y sencilla.

## Prerequisitos

* PHP Version 5.2+
* ADODB (inlcuido junto con la clase)
* BOOTSTRAP (incluido con la clase)
  
## Uso

Se incluye dentro del repositorio un fichero index.php que incluye un ejemplo de uso de esta libreria.

    <?php
        include "crud.php";

        // $crud=new CRUD(SISTEMA_GESTOR_DE_BASE_DE_DATOS,SERVIDOR,USUARIO,CONTRASEÑA,BASE_DE_DATOS);


        
        $crud->render(TABLA);
        ?>

Donde:

* SISTEMA_GESTOR_DE_BASE_DE_DATOS: De momento soporta los siguientes: MySQL, MySQLi y MariaDB. En un futuro se iran integrando mas SGBD
* SERVIDOR: Direccion del servidor del SGBD.
* USUARIO: Usuario del SGBD.
* CONTRASEÑA: Contraseña del usuario anterior del SGBD.
* BASE_DE_DATOS: Base de datos sobre la que vamos a trabajar.
* TABLA: Tabla de la BD en la que vamos a hacer CRUD.
* getAssoc()
    
## Licencia

CopyLeft 2016 Juan Ferrer / juanferrer437@hotmail.com / Murcia / España

Puede modificar, cambiar, mejorar lo que desee. 
