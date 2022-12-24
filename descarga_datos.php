<?php
  date_default_timezone_set('America/Santiago');
  ini_set('display_errors', 'On');
  set_time_limit(3600);

  require('consultas.php');
  require('phpSpreadsheet/vendor/autoload.php');

  use PhpOffice\PhpSpreadsheet\IOFactory;

  echo "Hora de inicio: " . date('Y-m-d H:i:s') . "\n\n";

  echo "Seteando estructura y cookie\n";

  $ruta = 'C:\\xampp\\htdocs\\Git\\rexmas\\';
  // $ruta = '/var/www/html/generico/rexmas/';
  $cookie = $ruta . 'cookieRR.txt';

  // echo "Abriendo primer sitio\n";
  //
  // // Pagina 1
  // $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');
  // curl_setopt ($ch, CURLOPT_POST, false);
  // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
  // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
  //
  // $respuesta = curl_exec($ch);
  //
  // curl_close($ch);
  //
  // sleep(5);
  //
  // $linea = "";
  //
  // echo "Obteniendo token\n";
  //
  // $fp = fopen($ruta . 'cookieRR.txt', "r");
  // while (!feof($fp)){
  //     $linea = fgets($fp);
  //     if(strpos($linea, "csrftoken"))
  //     {
  //         // echo $linea;
  //         break;
  //     }
  // }
  // fclose($fp);
  //
  // $array = explode("csrftoken",$linea);
  //
  // $csrftoken = trim($array[1]);
  //
  // echo "Token1: " . $csrftoken . "\n";
  //
  // echo "Logueandonos en sistema\n";
  //
  // // Pagina 2
  // $request = [];
  //
  // // $request[] = 'POST /remuneraciones/es-CL/login HTTP/1.1';
  // // $request[] = 'Host: soloverde.rexmas.cl';
  // // $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  // // $request[] = 'Accept: application/json, text/plain, */*';
  // // $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  // // $request[] = 'Accept-Encoding: gzip, deflate, br';
  // $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/login';
  // $request[] = 'Content-Type: application/json';
  // $request[] = 'X-XSRF-TOKEN: ' . $csrftoken;
  // $request[] = 'X-CSRFTOKEN: ' . $csrftoken;
  // // $request[] = 'Content-Length: 46';
  // // $request[] = 'Origin: https://soloverde.rexmas.cl';
  // // $request[] = 'DNT: 1';
  // // $request[] = 'Connection: keep-alive';
  // // $request[] = 'Cookie: csrftoken=' . $csrftoken;
  // // $request[] = 'Sec-Fetch-Dest: empty';
  // // $request[] = 'Sec-Fetch-Mode: cors';
  // // $request[] = 'Sec-Fetch-Site: same-origin';
  // // $request[] = 'Pragma: no-cache';
  // // $request[] = 'Cache-Control: no-cache';
  //
  // $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');
  //
  // curl_setopt($ch, CURLOPT_POST, true);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  // curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  // curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
  // curl_setopt($ch, CURLOPT_HEADER, true);
  // curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  // curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config01"}');
  // curl_setopt($ch, CURLOPT_ENCODING,"");
  //
  // $respuesta = curl_exec($ch);
  //
  // $file = fopen($ruta . 'login.html', 'w+');
  // fwrite($file, $respuesta);
  // fclose($file);
  //
  // curl_close($ch);
  //
  // sleep(5);
  //
  // echo "Obteniendo token e identificador de sesion\n";
  //
  // $linea = "";
  //
  // $fp = fopen($ruta . 'cookieRR.txt', "r");
  // while (!feof($fp)){
  //     $linea = fgets($fp);
  //     if(strpos($linea, "csrftoken"))
  //     {
  //         // echo $linea;
  //         break;
  //     }
  // }
  // fclose($fp);
  //
  // $array = explode("csrftoken",$linea);
  //
  // $csrftoken = trim($array[1]);
  //
  // $linea = "";
  //
  // $fp = fopen($ruta . 'cookieRR.txt', "r");
  // while (!feof($fp)){
  //     $linea = fgets($fp);
  //     if(strpos($linea, "sessionid"))
  //     {
  //         // echo $linea;
  //         break;
  //     }
  // }
  // fclose($fp);
  //
  // $array = explode("sessionid",$linea);
  //
  // // var_dump($array);
  //
  // $sessionid = trim($array[1]);
  //
  // echo "Token2: " . $csrftoken . "\n";
  // echo "Sessionid1: " . $sessionid . "\n";
  //
  // if($sessionid == ""){
  //   $linea = "";
  //
  //   $fp = fopen($ruta . 'login.html', "r");
  //   while (!feof($fp)){
  //       $linea = fgets($fp);
  //       if(strpos($linea, "sessionid"))
  //       {
  //           // echo $linea;
  //           break;
  //       }
  //   }
  //   fclose($fp);
  //
  //   $array = explode("sessionid=",$linea);
  //   $array2 = explode(";",$array);
  //
  //   // var_dump($array);
  //
  //   $sessionid = trim($array2[0]);
  // }
  //
  // echo "Sessionid1_head: " . $sessionid . "\n";
  //
  // $informes = [];
  // $informe[1122] = 'Empleados';
  // $informe[1123] = 'Contratos';
  // $informe[1124] = 'Empresas';
  // $informe[1125] = 'Cargos';
  // $informe[1126] = 'Centro_de_costos';
  // $informe[1127] = 'Vacaciones';
  // $informe[1128] = 'Licencias';
  //
  // for($i = 1122; $i <= 1128; $i++){
  //   echo "Descargando informe de $informe[$i]\n";
  //
  //   // Informe Empleados
  //   $request = [];
  //
  //   $request[] = 'POST /remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar HTTP/1.1';
  //   $request[] = 'Host: soloverde.rexmas.cl';
  //   $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  //   $request[] = 'Accept: application/json, text/plain, */*';
  //   $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  //   $request[] = 'Accept-Encoding: gzip, deflate, br';
  //   $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar';
  //   $request[] = 'Content-Type: application/json;charset=utf-8';
  //   $request[] = 'X-CSRFToken: ' . $csrftoken;
  //   $request[] = 'Content-Length: 17';
  //   $request[] = 'Origin: https://soloverde.rexmas.cl';
  //   $request[] = 'DNT: 1';
  //   $request[] = 'Connection: keep-alive';
  //   $request[] = 'Cookie: csrftoken=' . $csrftoken . '; sessionid=' . $sessionid;
  //   // $request[] = 'Sec-Fetch-Dest: empty';
  //   // $request[] = 'Sec-Fetch-Mode: cors';
  //   // $request[] = 'Sec-Fetch-Site: same-origin';
  //   // $request[] = 'Pragma: no-cache';
  //   // $request[] = 'Cache-Control: no-cache';
  //
  //   $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar');
  //
  //   curl_setopt($ch, CURLOPT_POST, true);
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  //   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  //   curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
  //   curl_setopt($ch, CURLOPT_HEADER, false);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, '{"parametros":""}');
  //   curl_setopt($ch, CURLOPT_ENCODING,"");
  //
  //   $respuesta = curl_exec($ch);
  //
  //   curl_close($ch);
  //
  //   sleep(5);
  //
  //   $file = fopen($ruta . "descargas/" . $informe[$i] . '.xlsx', 'w+');
  //   fwrite($file, $respuesta);
  //   fclose($file);
  //
  //   echo "Ruta de informe: " . $ruta . "descargas/" . $informe[$i] . ".xlsx\n";
  //
  //   // Re Login
  //
  //   $request = [];
  //
  //   // $request[] = 'POST /remuneraciones/es-CL/login HTTP/1.1';
  //   // $request[] = 'Host: soloverde.rexmas.cl';
  //   // $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  //   // $request[] = 'Accept: application/json, text/plain, */*';
  //   // $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  //   // $request[] = 'Accept-Encoding: gzip, deflate, br';
  //   $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/login';
  //   $request[] = 'Content-Type: application/json';
  //   $request[] = 'X-XSRF-TOKEN: ' . $csrftoken;
  //   $request[] = 'X-CSRFTOKEN: ' . $csrftoken;
  //   // $request[] = 'Content-Length: 46';
  //   // $request[] = 'Origin: https://soloverde.rexmas.cl';
  //   // $request[] = 'DNT: 1';
  //   // $request[] = 'Connection: keep-alive';
  //   // $request[] = 'Cookie: csrftoken=' . $csrftoken;
  //   // $request[] = 'Sec-Fetch-Dest: empty';
  //   // $request[] = 'Sec-Fetch-Mode: cors';
  //   // $request[] = 'Sec-Fetch-Site: same-origin';
  //   // $request[] = 'Pragma: no-cache';
  //   // $request[] = 'Cache-Control: no-cache';
  //
  //   $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');
  //
  //   curl_setopt($ch, CURLOPT_POST, true);
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  //   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  //   curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
  //   curl_setopt($ch, CURLOPT_HEADER, false);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config01"}');
  //   curl_setopt($ch, CURLOPT_ENCODING,"");
  //
  //   $respuesta = curl_exec($ch);
  //
  //   $file = fopen($ruta . 'login.html', 'w+');
  //   fwrite($file, $respuesta);
  //   fclose($file);
  //
  //   curl_close($ch);
  //
  //   sleep(5);
  //
  //   echo "Obteniendo token e identificador de sesion\n";
  //
  //   $linea = "";
  //
  //   $fp = fopen($ruta . 'cookieRR.txt', "r");
  //   while (!feof($fp)){
  //       $linea = fgets($fp);
  //       if(strpos($linea, "csrftoken"))
  //       {
  //           // echo $linea;
  //           break;
  //       }
  //   }
  //   fclose($fp);
  //
  //   $array = explode("csrftoken",$linea);
  //
  //   $csrftoken = trim($array[1]);
  //
  //   $linea = "";
  //
  //   $fp = fopen($ruta . 'cookieRR.txt', "r");
  //   while (!feof($fp)){
  //       $linea = fgets($fp);
  //       if(strpos($linea, "sessionid"))
  //       {
  //           // echo $linea;
  //           break;
  //       }
  //   }
  //   fclose($fp);
  //
  //   $array = explode("sessionid",$linea);
  //
  //   $sessionid = trim($array[1]);
  //
  //   echo "Token2: " . $csrftoken . "\n";
  //   echo "Sessionid1: " . $sessionid . "\n";
  //
  //   if($sessionid == ""){
  //     $linea = "";
  //
  //     $fp = fopen($ruta . 'login.html', "r");
  //     while (!feof($fp)){
  //         $linea = fgets($fp);
  //         if(strpos($linea, "sessionid"))
  //         {
  //             // echo $linea;
  //             break;
  //         }
  //     }
  //     fclose($fp);
  //
  //     $array = explode("sessionid=",$linea);
  //     $array2 = explode(";",$array);
  //
  //     // var_dump($array);
  //
  //     $sessionid = trim($array2[0]);
  //   }
  //
  //   echo "Sessionid1_head: " . $sessionid . "\n";
  //
  //   sleep(20);
  // }
  //
  // echo "Informe descargado se borrara la cookie para matar la sesion\n\n";
  //
  // echo "Hora de termino: " . date('Y-m-d H:i:s') . "\n";
  //
  // // unlink($cookie);

  // // Lectura de archivo de centro de costo
  // $rutaArchivo = $ruta . "descargas/Centro_de_costos.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arreglo = [];
  // $f = 0;
  // foreach ($hojaActual->getRowIterator() as $fila) {
  //   if($f > 1){
  //     $flag = 0;
  //     $datos = [];
  //     foreach ($fila->getCellIterator() as $celda) {
  //       if($flag > 13){
  //         break;
  //       }
  //       $fila = $celda->getRow();
  //       $columna = $celda->getColumn();
  //
  //       $datos[] = strval($celda->getValue());
  //
  //       $flag++;
  //     }
  //     $arreglo[] = $datos;
  //   }
  //   $f++;
  // }
  //
  // for($j = 0; $j < count($arreglo); $j++){
  //   $id = $arreglo[$j][0];
  //   $lista = $arreglo[$j][1];
  //   $item = $arreglo[$j][2];
  //   $nombre = str_replace("'","",$arreglo[$j][3]);
  //   $valora = $arreglo[$j][4];
  //   $valorb = $arreglo[$j][5];
  //   $valorc = $arreglo[$j][6];
  //   $datoAdic = str_replace("'","",$arreglo[$j][7]);
  //   $sincronizado_externos = $arreglo[$j][8];
  //   $habilitado = $arreglo[$j][9];
  //   $reservado = $arreglo[$j][10];
  //
  //   $sel = datoCentroCostoIngresado($item);
  //   $sel[0]['CANTIDAD'];
  //
  //   if($sel[0]['CANTIDAD'] == '0'){
  //     if($item != ""){
  //       $ins = ingresaCentroCosto($item,$nombre);
  //       if($ins == "Ok"){
  //         echo "Centro de costo ingresado: " . $item . "\n";
  //       }
  //       else{
  //         echo "Centro de costo error: " . $item . "\n";
  //       }
  //     }
  //     else{
  //       echo "Centro de costo error: " . $item . "\n";
  //     }
  //   }
  //   else{
  //     echo "Centro de costo existente: " . $item . "\n";
  //   }
  // }
  //
  // // Lectura de archivo de Empleados
  // $rutaArchivo = $ruta . "descargas/Empleados.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arreglo = [];
  // $f = 0;
  // foreach ($hojaActual->getRowIterator() as $fila) {
  //   if($f > 1){
  //     $flag = 0;
  //     $datos = [];
  //     foreach ($fila->getCellIterator() as $celda) {
  //       if($flag > 56){
  //         break;
  //       }
  //       $fila = $celda->getRow();
  //       $columna = $celda->getColumn();
  //
  //       $datos[] = strval($celda->getValue());
  //
  //       $flag++;
  //     }
  //     $arreglo[] = $datos;
  //   }
  //   $f++;
  // }
  //
  // for($j = 0; $j < count($arreglo); $j++){
  //   $DNI = $arreglo[$j][0];
  //   $NOMBRES = ucwords(strtolower($arreglo[$j][1]));
  //   $APELLIDOS = ucwords(strtolower($arreglo[$j][2] . " " . $arreglo[$j][3]));
  //   if($arreglo[$j][4] == "M"){
  //     $SEXO = "Hombre";
  //   }
  //   else{
  //     $SEXO = "Mujer";
  //   }
  //   $FECHA_NACIMIENTO = convertDate($arreglo[$j][5]);
  //   $NACIONALIDAD = ucwords(strtolower($arreglo[$j][7]));
  //   $DOMICILIO = ucwords(strtolower($arreglo[$j][8] . ", " . $arreglo[$j][9] . ", " . $arreglo[$j][10]));
  //   $TELEFONO = $arreglo[$j][11];
  //   $EMAIL = strtolower($arreglo[$j][12]);
  //   $BANCO = $arreglo[$j][13];
  //   $BANCO_CUENTA = $arreglo[$j][14];
  //   $BANCO_FORMA_PAGO = $arreglo[$j][15];
  //   $IDAFP = $arreglo[$j][18];
  //   $IDSALUD = $arreglo[$j][23];
  //   $EMAIL_PERSONAL = strtolower($arreglo[$j][39]);
  //
  //   $sel = personalExistente($DNI);
  //   $sel[0]['CANTIDAD'];
  //
  //   if($sel[0]['CANTIDAD'] == '0'){
  //     if($DNI != ""){
  //       $ins = ingresaPersonal($DNI,$NOMBRES,$APELLIDOS,$SEXO,$FECHA_NACIMIENTO,$NACIONALIDAD,$DOMICILIO,$TELEFONO,$EMAIL,$BANCO,$BANCO_CUENTA,$BANCO_FORMA_PAGO,$IDAFP,$IDSALUD,$EMAIL_PERSONAL);
  //
  //       if($ins == "Ok"){
  //         echo "Personal ingresado: " . $DNI . "\n";
  //       }
  //       else{
  //         echo "Personal error: " . $DNI . "\n";
  //       }
  //     }
  //     else{
  //       echo "Personal error: " . $DNI . "\n";
  //     }
  //   }
  //   else{
  //     if($DNI != ""){
  //       $ins = actualizaPersonal($DNI,$NOMBRES,$APELLIDOS,$SEXO,$FECHA_NACIMIENTO,$NACIONALIDAD,$DOMICILIO,$TELEFONO,$EMAIL,$BANCO,$BANCO_CUENTA,$BANCO_FORMA_PAGO,$IDAFP,$IDSALUD,$EMAIL_PERSONAL);
  //
  //       if($ins == "Ok"){
  //         echo "Personal actualizado: " . $DNI . "\n";
  //       }
  //       else{
  //         echo "Personal error: " . $DNI . "\n";
  //       }
  //     }
  //     else{
  //       echo "Personal error: " . $DNI . "\n";
  //     }
  //   }
  // }

  // Lectura de archivo de cargos
  // $rutaArchivo = $ruta . "descargas/Cargos.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arreglo = [];
  // $f = 0;
  // foreach ($hojaActual->getRowIterator() as $fila) {
  //   if($f > 1){
  //     $flag = 0;
  //     $datos = [];
  //     foreach ($fila->getCellIterator() as $celda) {
  //       if($flag > 22){
  //         break;
  //       }
  //       $fila = $celda->getRow();
  //       $columna = $celda->getColumn();
  //
  //       $datos[] = strval($celda->getValue());
  //
  //       $flag++;
  //     }
  //     $arreglo[] = $datos;
  //   }
  //   $f++;
  // }
  //
  // for($j = 0; $j < count($arreglo); $j++){
  //   $id = $arreglo[$j][0];
  //   $cargo = ucwords(strtolower($arreglo[$j][1]));
  //
  //   $sel = cargoExistente($id);
  //   $sel[0]['CANTIDAD'];
  //
  //   if($sel[0]['CANTIDAD'] == '0'){
  //     if($id != ""){
  //       $ins = ingresaCargo($id,$cargo);
  //
  //       if($ins == "Ok"){
  //         echo "Cargo ingresado: " . $id . "\n";
  //       }
  //       else{
  //         echo "Cargo error: " . $id . "\n";
  //       }
  //     }
  //     else{
  //       echo "Cargo error: " . $id . "\n";
  //     }
  //   }
  //   else{
  //     echo "Cargo error: " . $id . "\n";
  //   }
  // }

  // Lectura de archivo de contratos
  $rutaArchivo = $ruta . "descargas/Contratos.xlsx";
  $documento = IOFactory::load($rutaArchivo);
  $hojaActual = $documento->getSheet(0);

  $arreglo = [];
  $f = 0;
  foreach ($hojaActual->getRowIterator() as $fila) {
    if($f > 1){
      $flag = 0;
      $datos = [];
      foreach ($fila->getCellIterator() as $celda) {
        if($flag > 91){
          break;
        }
        $fila = $celda->getRow();
        $columna = $celda->getColumn();

        $datos[] = strval($celda->getValue());

        $flag++;
      }
      $arreglo[] = $datos;
    }
    $f++;
  }

  for($j = 0; $j < count($arreglo); $j++){
    $dni = $arreglo[$j][1];
    $idempresa = $arreglo[$j][2];
    $idcentrocosto = $arreglo[$j][12];
    $idcargo = $arreglo[$j][82];

    $ins = actualizaCargoPersonal($dni,$idcargo);

    if($ins == "Ok"){
      echo "Cargo actualizado a personal: " . $dni . " - " . $idcargo . "\n";
    }
    else{
      echo "Cargo error a personal: " . $dni . " - " . $idcargo . "\n";
    }

    $sel = ACTExistente($dni);
    $sel[0]['CANTIDAD'];

    if($sel[0]['CANTIDAD'] == '0'){
      if($dni != ""){
        $ins = ingresaACT($dni,$idcentrocosto);

        if($ins == "Ok"){
          echo "CECO ingresado correctamente: " . $dni . " - " . $idcentrocosto . "\n";
        }
        else{
          echo "CECO error: " . $dni . " - " . $idcentrocosto . "\n";
        }
      }
      else{
        echo "CECO error: " . $dni . " - " . $idcentrocosto . "\n";
      }
    }
    else{
      if($dni != ""){
        $ins = actualizaACT($dni,$idcentrocosto);

        if($ins == "Ok"){
          echo "CECO actualizado correctamente: " . $dni . " - " . $idcentrocosto . "\n";
        }
        else{
          echo "CECO error: " . $dni . " - " . $idcentrocosto . "\n";
        }
      }
    }
  }

  //Funciones
  function convertDate($dateValue) {
    $unixDate = ($dateValue - 25569) * 86400;
    return gmdate("Y-m-d", $unixDate);
  }

  // echo count($arreglo) . "\n";
?>
