<?php
require('conexion.php');

function datoCentroCostoIngresado($item){
	$con = conectar();
	if($con != 'No conectado'){
		$sql = "SELECT COUNT(*) 'CANTIDAD'
            FROM ESTRUCTURA_OPERACION
            WHERE DEFINICION = '{$item}'";
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

function ingresaCentroCosto($item,$nombre){
    $con = conectar();
    $con->query("START TRANSACTION");
    if($con != 'No conectado'){
      $sql = "INSERT INTO ESTRUCTURA_OPERACION(DEFINICION, NOMENCLATURA, FECHA, USUARIO)
              VALUES('{$item}','{$nombre}', NOW(), 'Automata')";
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
