<?php
  date_default_timezone_set('America/Santiago');
  ini_set('display_errors', 'On');
  set_time_limit(3600);

  require('consultas.php');
  require('phpSpreadsheet/vendor/autoload.php');

  use PhpOffice\PhpSpreadsheet\IOFactory;

  echo "Hora de inicio: " . date('Y-m-d H:i:s') . "\n\n";

  echo "Seteando estructura y cookie\n";

  // $ruta = 'C:\\xampp\\htdocs\\Git\\rexmas\\';
  $ruta = '/var/www/html/generico/rexmas/';
  $cookie = $ruta . 'cookieRR.txt';

  echo "Abriendo primer sitio\n";

  // Pagina 1
  $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');
  curl_setopt ($ch, CURLOPT_POST, false);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");

  $respuesta = curl_exec($ch);

  curl_close($ch);

  $linea = "";

  echo "Obteniendo token\n";

  echo $ruta . 'cookieRR.txt' . "\n";

  $fp = fopen($ruta . 'cookieRR.txt', "r");
  while (!feof($fp)){
      $linea = fgets($fp);
      if(strpos($linea, "csrftoken"))
      {
          // echo $linea;
          break;
      }
  }
  fclose($fp);

  $array = explode("csrftoken",$linea);

  $csrftoken = trim($array[1]);

  echo "Token1: " . $csrftoken . "\n";

  echo "Logueandonos en sistema\n";

  // Pagina 2
  $request = [];

  // $request[] = 'POST /remuneraciones/es-CL/login HTTP/1.1';
  // $request[] = 'Host: soloverde.rexmas.cl';
  // $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  // $request[] = 'Accept: application/json, text/plain, */*';
  // $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  // $request[] = 'Accept-Encoding: gzip, deflate, br';
  $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/login';
  $request[] = 'Content-Type: application/json';
  $request[] = 'X-XSRF-TOKEN: ' . $csrftoken;
  $request[] = 'X-CSRFTOKEN: ' . $csrftoken;
  // $request[] = 'Content-Length: 46';
  // $request[] = 'Origin: https://soloverde.rexmas.cl';
  // $request[] = 'DNT: 1';
  // $request[] = 'Connection: keep-alive';
  // $request[] = 'Cookie: csrftoken=' . $csrftoken;
  // $request[] = 'Sec-Fetch-Dest: empty';
  // $request[] = 'Sec-Fetch-Mode: cors';
  // $request[] = 'Sec-Fetch-Site: same-origin';
  // $request[] = 'Pragma: no-cache';
  // $request[] = 'Cache-Control: no-cache';

  $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');

  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config01"}');
  curl_setopt($ch, CURLOPT_ENCODING,"");

  $respuesta = curl_exec($ch);

  curl_close($ch);

  echo "Obteniendo token e identificador de sesion\n";

  $linea = "";

  $fp = fopen($ruta . 'cookieRR.txt', "r");
  while (!feof($fp)){
      $linea = fgets($fp);
      if(strpos($linea, "csrftoken"))
      {
          // echo $linea;
          break;
      }
  }
  fclose($fp);

  $array = explode("csrftoken",$linea);

  $csrftoken = trim($array[1]);

  $linea = "";

  $fp = fopen($ruta . 'cookieRR.txt', "r");
  while (!feof($fp)){
      $linea = fgets($fp);
      if(strpos($linea, "sessionid"))
      {
          // echo $linea;
          break;
      }
  }
  fclose($fp);

  $array = explode("sessionid",$linea);

  $sessionid = trim($array[1]);

  echo "Token2: " . $csrftoken . "\n";
  echo "Sessionid1: " . $sessionid . "\n";

  $informes = [];
  $informe[1122] = 'Empleados';
  $informe[1123] = 'Contratos';
  $informe[1124] = 'Empresas';
  $informe[1125] = 'Cargos';
  $informe[1126] = 'Centro_de_costos';
  $informe[1127] = 'Vacaciones';
  $informe[1128] = 'Licencias';

  for($i = 1122; $i <= 1128; $i++){
    echo "Descargando informe de $informe[$i]\n";

    // Informe Empleados
    $request = [];

    $request[] = 'POST /remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar HTTP/1.1';
    $request[] = 'Host: soloverde.rexmas.cl';
    $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
    $request[] = 'Accept: application/json, text/plain, */*';
    $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
    $request[] = 'Accept-Encoding: gzip, deflate, br';
    $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar';
    $request[] = 'Content-Type: application/json;charset=utf-8';
    $request[] = 'X-CSRFToken: ' . $csrftoken;
    $request[] = 'Content-Length: 17';
    $request[] = 'Origin: https://soloverde.rexmas.cl';
    $request[] = 'DNT: 1';
    $request[] = 'Connection: keep-alive';
    $request[] = 'Cookie: csrftoken=' . $csrftoken . '; sessionid=' . $sessionid;
    // $request[] = 'Sec-Fetch-Dest: empty';
    // $request[] = 'Sec-Fetch-Mode: cors';
    // $request[] = 'Sec-Fetch-Site: same-origin';
    // $request[] = 'Pragma: no-cache';
    // $request[] = 'Cache-Control: no-cache';

    $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $i . '/ejecutar');

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"parametros":""}');
    curl_setopt($ch, CURLOPT_ENCODING,"");

    $respuesta = curl_exec($ch);

    curl_close($ch);

    $file = fopen($ruta . "descargas/" . $informe[$i] . '.xlsx', 'w+');
    fwrite($file, $respuesta);
    fclose($file);

    echo "Ruta de informe: " . $ruta . "descargas/" . $informe[$i] . ".xlsx\n";

    // Re Login

    $request = [];

    // $request[] = 'POST /remuneraciones/es-CL/login HTTP/1.1';
    // $request[] = 'Host: soloverde.rexmas.cl';
    // $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
    // $request[] = 'Accept: application/json, text/plain, */*';
    // $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
    // $request[] = 'Accept-Encoding: gzip, deflate, br';
    $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/login';
    $request[] = 'Content-Type: application/json';
    $request[] = 'X-XSRF-TOKEN: ' . $csrftoken;
    $request[] = 'X-CSRFTOKEN: ' . $csrftoken;
    // $request[] = 'Content-Length: 46';
    // $request[] = 'Origin: https://soloverde.rexmas.cl';
    // $request[] = 'DNT: 1';
    // $request[] = 'Connection: keep-alive';
    // $request[] = 'Cookie: csrftoken=' . $csrftoken;
    // $request[] = 'Sec-Fetch-Dest: empty';
    // $request[] = 'Sec-Fetch-Mode: cors';
    // $request[] = 'Sec-Fetch-Site: same-origin';
    // $request[] = 'Pragma: no-cache';
    // $request[] = 'Cache-Control: no-cache';

    $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');

    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:72.0) Gecko/20100101 Firefox/72.0");
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
    curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config01"}');
    curl_setopt($ch, CURLOPT_ENCODING,"");

    $respuesta = curl_exec($ch);

    curl_close($ch);

    echo "Obteniendo token e identificador de sesion\n";

    $linea = "";

    $fp = fopen($ruta . 'cookieRR.txt', "r");
    while (!feof($fp)){
        $linea = fgets($fp);
        if(strpos($linea, "csrftoken"))
        {
            // echo $linea;
            break;
        }
    }
    fclose($fp);

    $array = explode("csrftoken",$linea);

    $csrftoken = trim($array[1]);

    $linea = "";

    $fp = fopen($ruta . 'cookieRR.txt', "r");
    while (!feof($fp)){
        $linea = fgets($fp);
        if(strpos($linea, "sessionid"))
        {
            // echo $linea;
            break;
        }
    }
    fclose($fp);

    $array = explode("sessionid",$linea);

    $sessionid = trim($array[1]);

    echo "Token2: " . $csrftoken . "\n";
    echo "Sessionid1: " . $sessionid . "\n";

    sleep(20);
  }

  echo "Informe descargado se borrara la cookie para matar la sesion\n\n";

  echo "Hora de termino: " . date('Y-m-d H:i:s') . "\n";

  unlink($cookie);

  // Lectura de archivo de centro de costo
  $rutaArchivo = $ruta . "descargas/Centro_de_costos.xlsx";
  $documento = IOFactory::load($rutaArchivo);
  $hojaActual = $documento->getSheet(0);

  $arreglo = [];
  $f = 0;
  foreach ($hojaActual->getRowIterator() as $fila) {
    if($f > 1){
      $flag = 0;
      $datos = [];
      foreach ($fila->getCellIterator() as $celda) {
        if($flag > 13){
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
    $id = $arreglo[$j][0];
    $lista = $arreglo[$j][1];
    $item = $arreglo[$j][2];
    $nombre = str_replace("'","",$arreglo[$j][3]);
    $valora = $arreglo[$j][4];
    $valorb = $arreglo[$j][5];
    $valorc = $arreglo[$j][6];
    $datoAdic = $arreglo[$j][7];
    $sincronizado_externos = $arreglo[$j][8];
    $habilitado = $arreglo[$j][9];
    $reservado = $arreglo[$j][10];

    $sel = datoCentroCostoIngresado($item);
    $sel[0]['CANTIDAD'];

    if($sel[0]['CANTIDAD'] == '0'){
      $ins = ingresaCentroCosto($item,$nombre,$datoAdic);
      if($ins == "Ok"){
        echo "Centro de costo ingresado: " . $item . "\n";
      }
      else{
        echo "Centro de costo error: " . $item . "\n";
      }
    }
    else{
      echo "Centro de costo existente: " . $item . "\n";
    }
  }

  // echo count($arreglo) . "\n";
?>
