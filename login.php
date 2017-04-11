<?php
session_start();
require_once("admin/query/cnx.php"); //Aqui se importa el script de conexión a la base de datos.
connect(); //El metodo que ejecuta la conexión (es maña de milico)
$correo = $_POST['correo']; //Se recibe el campo user del formulario login en index.php
$pass = $_POST['pass']; //Se recibe el campo pass del formulario login en index.php
$sqlrut = "select * from FUNCIONARIOS where correo = '$correo'";
$resultado = mysql_query($sqlrut);
while ($row = mysql_fetch_array($resultado)){
    $rut = $row['rut'];
    $nombre = $row['nombre'];
    $correo = $row['correo'];
    $ape_paterno = $row['ape_paterno'];
    $ape_materno = $row['ape_materno'];
    $telefono = $row['telefono'];
    $anexo = $row['anexo'];
    $id_cargo = $row['id_cargo'];
    $id_clinica = $row['id_clinica'];
    $id_ciudad = $row['id_ciudad'];
    $id_centro_costo = $row['id_centro_costo'];
}
$sqlid_clinica = "select nombre from CLINICAS where id_clinica = '$id_clinica'";
$resultado = mysql_query($sqlid_clinica);
while ($row = mysql_fetch_array($resultado)){
    $nombre_clinica = $row['nombre']; 
}
$sqlid_ciudad = "select * from CIUDADES where id_ciudad = '$id_ciudad'";
$resultado = mysql_query($sqlid_ciudad);
while ($row = mysql_fetch_array($resultado)){
    $nombre_ciudad = $row['nombre']; 
    $id_region = $row['id_region'];
}
$sqlregion = "select nombre from REGIONES where id_region = '$id_region'";
$resultado = mysql_query($sqlregion);
while ($row = mysql_fetch_array($resultado)){
    $nombre_region = $row['nombre']; 
}
$sqlid_centro = "select nombre from CENTROS_COSTOS where id_centro_costo = '$id_centro_costo'";
$resultado = mysql_query($sqlid_centro);
while ($row = mysql_fetch_array($resultado)){
    $nombre_centro_costo = $row['nombre']; 
}
$sqlid_usuario = "select id_usuario from USUARIOS where rut = '$rut'";
$resultado = mysql_query($sqlid_usuario);
while ($row = mysql_fetch_array($resultado)){
    $id_usuario = $row['id_usuario']; 
}
$sqlcargos = "select nombre from CARGOS where id_cargo = '$id_cargo'";
$resultado = mysql_query($sqlcargos);
while ($row = mysql_fetch_array($resultado)){
    $nombre_cargo = $row['nombre']; 
}
$sqlid_tipo_usuario = "select id_tipo_usuario from USUARIOS where rut = '$rut'";
$resultado = mysql_query($sqlid_tipo_usuario);
while ($row = mysql_fetch_array($resultado)){
    $id_tipo_usuario = $row['id_tipo_usuario']; 
}
$clave = hash_hmac("sha512",$pass,"interclinica");
$sql = "select * from LOGIN where id_usuario = '$id_usuario' and clave_login = '$clave'";
$result = mysql_query($sql); //Se ejecuta la query, el resultado en bruto esta en $result
$count = mysql_num_rows($result); //Se cuentan el numero de filas de la query, se almacena en $count como variable numerica
if ($count == 1) { //Como el usuario es único, deberia solamente retornar 1 fila, esta es la condición, que verifica si hay usuario
    while ($row = mysql_fetch_array($result)) { //En este while se almacenan las variables de sesión con los datos de la query
        $_SESSION['id_login']=  session_id();
     }
    $_SESSION['rut'] = $rut;
    $_SESSION['nombre'] = $nombre;
    $_SESSION['correo'] = $correo;
    $_SESSION['ape_paterno'] = $ape_paterno;
    $_SESSION['ape_materno'] = $ape_materno;
    $_SESSION['telefono'] = $telefono;
    $_SESSION['anexo'] = $anexo;
    $_SESSION['nombre_clinica'] = $nombre_clinica; 
    $_SESSION['nombre_ciudad'] = $nombre_ciudad;
    $_SESSION['nombre_region'] = $nombre_region;
    $_SESSION['nombre_centro_costo'] =$nombre_centro_costo;
    $_SESSION['id_usuario'] = $id_usuario;
    $_SESSION['nombre_cargo'] = $nombre_cargo; 
    $_SESSION['id_tipo_usuario'] = $id_tipo_usuario; 
    if ( $_SESSION['id_tipo_usuario'] == 1 ){
    header('location:admin/index.html');
    }else{
    header('location:funcionarios/index.php');	
    }
    /*
    if($_SESSION['activo']==1){
        header('location:../index.php');
        //echo'ok';
    }
    else{
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        //echo'fail';
    }
	*/
} else { //Aqui son los procesos si la autenticación esta mala
    echo'Usuario Incorrecto';
    //header('Location: ' . $_SERVER['HTTP_REFERER']);
}
?>
