<?php
require('conexion.php');

function datoCentroCostoIngresado($item){
	$con = conectar();
	if($con != 'No conectado'){
		$sql = "SELECT COUNT(*) 'CANTIDAD'
            FROM CENTROS_DE_COSTO
            WHERE CODIGO = '{$item}'";
		if ($row = $con->query($sql)) {
			while($array = $row->fetch_array(MYSQLI_BOTH)){
				$return[] = $array;
			}
			return $return;
		}
		else{
			return "Error";
		}
	}
	else{
		return "Error";
	}
}

function ingresaCentroCosto($item,$nombre,$datoAdic){
    $con = conectar();
    $con->query("START TRANSACTION");
    if($con != 'No conectado'){
      $sql = "INSERT INTO CENTROS_DE_COSTO(CODIGO, NOMBRE, DESCRIPCION)
              VALUES('{$item}','{$nombre}','{$datoAdic}')";
      if ($con->query($sql)) {
        $con->query("COMMIT");
        return "Ok";
      }
      else{
        // return $con->error;
        $con->query("ROLLBACK");
        // return "Error";
        return $sql;
      }
    }
    else{
      $con->query("ROLLBACK");
      return "Error";
    }
}
?>
