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
	      return "Error";
	      // return $sql;
	    }
	  }
	  else{
	    $con->query("ROLLBACK");
	    return "Error";
	  }
	}

	function personalExistente($DNI){
		$con = conectar();
		if($con != 'No conectado'){
			$sql = "SELECT COUNT(*) 'CANTIDAD'
							FROM PERSONAL
							WHERE DNI = '{$DNI}'";
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

	function ingresaPersonal($DNI,$NOMBRES,$APELLIDOS,$SEXO,$FECHA_NACIMIENTO,$NACIONALIDAD,$DOMICILIO,$TELEFONO,$EMAIL,$BANCO,$BANCO_CUENTA,$BANCO_FORMA_PAGO,$IDAFP,$IDSALUD,$EMAIL_PERSONAL){
	  $con = conectar();
	  $con->query("START TRANSACTION");
	  if($con != 'No conectado'){
	    $sql = "INSERT INTO PERSONAL
							(
								DNI,
								NOMBRES,
								APELLIDOS,
								SEXO,
								FECHA_NACIMIENTO,
								NACIONALIDAD,
								DOMICILIO,
								TELEFONO,
								EMAIL,
								IDBANCO,
								BANCO_CUENTA,
								BANCO_FORMA_PAGO,
								IDAFP,
								IDSALUD,
								EMAIL_PERSONAL,
								FECHAACTUALIZACION
							)
							VALUES
							(
								'{$DNI}',
								'{$NOMBRES}',
								'{$APELLIDOS}',
								'{$SEXO}',
								'{$FECHA_NACIMIENTO}',
								(SELECT NACIONALIDAD
								FROM NACIONALIDAD
								WHERE PAIS LIKE '%{$NACIONALIDAD}%'),
								'{$DOMICILIO}',
								'{$TELEFONOS}',
								'{$EMAIL}',
								(SELECT IDBANCO
								FROM BANCO
								WHERE BANCO_REX LIKE '%{$BANCO}%'),
								'{$BANCO_CUENTA}',
								'{$BANCO_FORMA_PAGO}',
								(SELECT IDAFP
								FROM AFP
								WHERE AFP_REX LIKE '%{$IDAFP}%'),
								(SELECT IDSALUD
								FROM SALUD
								WHERE SALUD_REX LIKE '%{$IDSALUD}%'),
								'{$EMAIL_PERSONAL}',
								NOW()
							)";
	    if ($con->query($sql)) {
	      $con->query("COMMIT");
	      return "Ok";
	    }
	    else{
	      // return $con->error;
	      $con->query("ROLLBACK");
	      return "Error";
	      // return $sql;
	    }
	  }
	  else{
	    $con->query("ROLLBACK");
	    return "Error";
	  }
	}

	function actualizaPersonal($DNI,$NOMBRES,$APELLIDOS,$SEXO,$FECHA_NACIMIENTO,$NACIONALIDAD,$DOMICILIO,$TELEFONO,$EMAIL,$BANCO,$BANCO_CUENTA,$BANCO_FORMA_PAGO,$IDAFP,$IDSALUD,$EMAIL_PERSONAL){
	  $con = conectar();
	  $con->query("START TRANSACTION");
	  if($con != 'No conectado'){
	    $sql = "UPDATE PERSONAL
							SET
								NOMBRES = '{$NOMBRES}',
								APELLIDOS = '{$APELLIDOS}',
								SEXO = '{$SEXO}',
								FECHA_NACIMIENTO = '{$FECHA_NACIMIENTO}',
								NACIONALIDAD = (SELECT NACIONALIDAD
								FROM NACIONALIDAD
								WHERE PAIS LIKE '%{$NACIONALIDAD}%'),
								DOMICILIO = '{$DOMICILIO}',
								TELEFONO = '{$TELEFONOS}',
								EMAIL = '{$EMAIL}',
								IDBANCO = (SELECT IDBANCO
								FROM BANCO
								WHERE BANCO_REX LIKE '%{$BANCO}%'),
								BANCO_CUENTA = '{$BANCO_CUENTA}',
								BANCO_FORMA_PAGO = '{$BANCO_FORMA_PAGO}',
								IDAFP = (SELECT IDAFP
								FROM AFP
								WHERE AFP_REX LIKE '%{$IDAFP}%'),
								IDSALUD = (SELECT IDSALUD
								FROM SALUD
								WHERE SALUD_REX LIKE '%{$IDSALUD}%'),
								EMAIL_PERSONAL = '{$EMAIL_PERSONAL}',
								FECHAACTUALIZACION = NOW()
							WHERE DNI = '{$DNI}'";
	    if ($con->query($sql)) {
	      $con->query("COMMIT");
	      return "Ok";
	    }
	    else{
	      // return $con->error;
	      $con->query("ROLLBACK");
	      return "Error";
	      // return $sql;
	    }
	  }
	  else{
	    $con->query("ROLLBACK");
	    return "Error";
	  }
	}
?>
