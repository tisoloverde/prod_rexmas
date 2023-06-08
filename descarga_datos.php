<?php
  date_default_timezone_set('America/Santiago');
  ini_set('display_errors', 'On');
  set_time_limit(3600);

  require('consultas.php');
  require('phpSpreadsheet/vendor/autoload.php');

  use PhpOffice\PhpSpreadsheet\IOFactory;

  // $ruta = 'C:\\xampp\\htdocs\\Git\\rexmas\\';
  $ruta = '/var/www/html/generico/rexmas/';
  $cookie = $ruta . 'descargas/cookieRR.txt';

  echo "Hora de inicio: " . date('Y-m-d H:i:s') . "\n\n";

  $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n================= " . date("d/m/Y")." =================") or die("Error escribiendo en el archivo");
  fclose($logFile);

  $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Hora de inicio") or die("Error escribiendo en el archivo");
  fclose($logFile);

  echo "Seteando estructura y cookie\n";

  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Seteando estructura y cookie") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // $ciclos = 0;
  //
  // start:
  // $ciclos++;
  // echo "Ciclos de lectura: " . $ciclos . "\n";
  //
  // echo "Abriendo primer sitio\n";
  //
  // try {
  //   // Pagina 1
  //   $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/login');
  //   curl_setopt ($ch, CURLOPT_POST, false);
  //   curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  //   curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
  //   curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  //   curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
  //
  //   $respuesta = curl_exec($ch);
  //
  //   curl_close($ch);
  //
  //   sleep(5);
  //
  //   $linea = "";
  //
  //   echo "Obteniendo token\n";
  //
  //   $fp = fopen($ruta . 'descargas/cookieRR.txt', "r");
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
  //   echo "Token1: " . $csrftoken . "\n";
  //
  //   echo "Logueandonos en sistema\n";
  //
  //   $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  //   fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Logueandonos en sistema") or die("Error escribiendo en el archivo");
  //   fclose($logFile);
  //
  //   // Pagina 2
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
  //   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
  //   curl_setopt($ch, CURLOPT_HEADER, true);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config03"}');
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
  //   $fp = fopen($ruta . 'descargas/cookieRR.txt', "r");
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
  //   $fp = fopen($ruta . 'descargas/cookieRR.txt', "r");
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
  //   // var_dump($array);
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
  // }
  // catch (\Exception $e) {
  //   echo "Error de captura de sesion id\n";
  //   goto start;
  // }
  // catch (\Error $e) {
  //   echo "Error de captura de sesion id\n";
  //   goto start;
  // }
  //
  //
  // $informes = [];
  // $informes[0] = [1122,'Empleados'];
  // $informes[1] = [1123,'Contratos'];
  // $informes[2] = [1124,'Empresas'];
  // $informes[3] = [1125,'Cargos'];
  // $informes[4] = [1126,'Centro_de_costos'];
  // $informes[5] = [1127,'Vacaciones'];
  // $informes[6] = [1128,'Licencias'];
  // $informes[7] = [1221,'Catalogo'];
  // $informes[8] = [1254,'Resultado_proceso'];
  //
  // $Actual = date("d-m-Y");
  // $periodoAnterior5 = date("Y-m",strtotime($Actual."-5 month"));
  // $periodoAnterior4 = date("Y-m",strtotime($Actual."-4 month"));
  // $periodoAnterior3 = date("Y-m",strtotime($Actual."-3 month"));
  // $periodoAnterior2 = date("Y-m",strtotime($Actual."-2 month"));
  // $periodoAnterior = date("Y-m",strtotime($Actual."-1 month"));
  // $periodoActual = date("Y-m",strtotime($Actual."-0 month"));
  //
  // $periodos = [];
  // $periodos[0] = $periodoAnterior5;
  // $periodos[1] = $periodoAnterior4;
  // $periodos[2] = $periodoAnterior3;
  // $periodos[3] = $periodoAnterior2;
  // $periodos[4] = $periodoAnterior;
  // $periodos[5] = $periodoActual;
  //
  // for($i = 0; $i < count($informes) ; $i++){
  //   if($i != 8){
  //     echo "Descargando informe de {$informes[$i][1]} \n";
  //
  //     $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  //     fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Descargando informe de {$informes[$i][1]}") or die("Error escribiendo en el archivo");
  //     fclose($logFile);
  //
  //     $request = [];
  //
  //     $request[] = 'POST /remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar HTTP/1.1';
  //     $request[] = 'Host: soloverde.rexmas.cl';
  //     $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  //     $request[] = 'Accept: application/json, text/plain, */*';
  //     $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  //     $request[] = 'Accept-Encoding: gzip, deflate, br';
  //     $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar';
  //     $request[] = 'Content-Type: application/json;charset=utf-8';
  //     $request[] = 'X-CSRFToken: ' . $csrftoken;
  //     $request[] = 'Content-Length: 17';
  //     $request[] = 'Origin: https://soloverde.rexmas.cl';
  //     $request[] = 'DNT: 1';
  //     $request[] = 'Connection: keep-alive';
  //     $request[] = 'Cookie: csrftoken=' . $csrftoken . '; sessionid=' . $sessionid;
  //     $request[] = 'Sec-Fetch-Dest: empty';
  //     $request[] = 'Sec-Fetch-Mode: cors';
  //     $request[] = 'Sec-Fetch-Site: same-origin';
  //     $request[] = 'Pragma: no-cache';
  //     $request[] = 'Cache-Control: no-cache';
  //
  //     $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar');
  //
  //     curl_setopt($ch, CURLOPT_POST, true);
  //     curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  //     curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  //     curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  //     curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //     curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
  //     curl_setopt($ch, CURLOPT_HEADER, false);
  //     curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //     curl_setopt($ch, CURLOPT_POSTFIELDS, '{"parametros":""}');
  //     curl_setopt($ch, CURLOPT_ENCODING,"");
  //
  //     $respuesta = curl_exec($ch);
  //
  //     curl_close($ch);
  //
  //     sleep(5);
  //
  //     $file = fopen($ruta . "descargas/" . $informes[$i][1] . '.xlsx', 'w+');
  //     fwrite($file, $respuesta);
  //     fclose($file);
  //
  //     sleep(5);
  //
  //     echo "Ruta de informe: " . $ruta . "descargas/" . $informes[$i][1] . ".xlsx\n";
  //     echo filesize($ruta . "descargas/" . $informes[$i][1] . '.xlsx') . "\n";
  //     if(filesize($ruta . "descargas/" . $informes[$i][1] . '.xlsx') < 2000){
  //       goto start;
  //     }
  //   }
  //   else{
  //     echo "Descargando informe de {$informes[$i][1]} \n";
  //
  //     $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  //     fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Descargando informe de {$informes[$i][1]}") or die("Error escribiendo en el archivo");
  //     fclose($logFile);
  //
  //     for($j = 0; $j < count($periodos); $j++){
  //       // Informe Empleados
  //       $request = [];
  //
  //       $request[] = 'POST /remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar HTTP/1.1';
  //       $request[] = 'Host: soloverde.rexmas.cl';
  //       $request[] = 'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:107.0) Gecko/20100101 Firefox/107.0';
  //       $request[] = 'Accept: application/json, text/plain, */*';
  //       $request[] = 'Accept-Language: es-CL,es;q=0.8,en-US;q=0.5,en;q=0.3';
  //       $request[] = 'Accept-Encoding: gzip, deflate, br';
  //       $request[] = 'Referer: https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar';
  //       $request[] = 'Content-Type: application/json;charset=utf-8';
  //       $request[] = 'X-CSRFToken: ' . $csrftoken;
  //       $request[] = 'Content-Length: 26';
  //       $request[] = 'Origin: https://soloverde.rexmas.cl';
  //       $request[] = 'DNT: 1';
  //       $request[] = 'Connection: keep-alive';
  //       $request[] = 'Cookie: csrftoken=' . $csrftoken . '; sessionid=' . $sessionid;
  //       $request[] = 'Sec-Fetch-Dest: empty';
  //       $request[] = 'Sec-Fetch-Mode: cors';
  //       $request[] = 'Sec-Fetch-Site: same-origin';
  //       $request[] = 'Pragma: no-cache';
  //       $request[] = 'Cache-Control: no-cache';
  //
  //       $ch = curl_init('https://soloverde.rexmas.cl/remuneraciones/es-CL/rexisa/gecos/' . $informes[$i][0] . '/ejecutar');
  //
  //       curl_setopt($ch, CURLOPT_POST, true);
  //       curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
  //       curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  //       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  //       curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
  //       curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
  //       curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
  //       curl_setopt($ch, CURLOPT_HEADER, false);
  //       curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //       curl_setopt($ch, CURLOPT_POSTFIELDS,  "{\"parametros\":\"'" . $periodos[$j] . "'\"}");
  //       curl_setopt($ch, CURLOPT_ENCODING,"");
  //
  //       $respuesta = curl_exec($ch);
  //
  //       curl_close($ch);
  //
  //       sleep(5);
  //
  //       $file = fopen($ruta . "descargas/" . $informes[$i][1] . '_' . $periodos[$j] . '.xlsx', 'w+');
  //       fwrite($file, $respuesta);
  //       fclose($file);
  //
  //       sleep(5);
  //
  //       echo "Ruta de informe: " . $ruta . "descargas/" . $informes[$i][1] . "_" . $periodos[$j] . ".xlsx\n";
  //
  //       if(filesize($ruta . "descargas/" . $informes[$i][1] . '_' . $periodos[$j] . '.xlsx') < 1040){
  //         unlink($ruta . "descargas/" . $informes[$i][1] . '_' . $periodos[$j] . '.xlsx');
  //       }
  //     }
  //   }
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
  //   curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
  //   curl_setopt($ch, CURLOPT_HEADER, false);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, $request);
  //   curl_setopt($ch, CURLOPT_POSTFIELDS, '{"username":"Consultas","password":"Config03"}');
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
  //   $fp = fopen($ruta . 'descargas/cookieRR.txt', "r");
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
  //   $fp = fopen($ruta . 'descargas/cookieRR.txt', "r");
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
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Informes descargados se borrara la cookie para matar la sesion") or die("Error escribiendo en el archivo");
  // fclose($logFile);

  // // unlink($cookie);
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando procesos") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // for($z = 0; $z < count($periodos); $z++){
  //   // Lectura de archivo de proceso
  //   $rutaArchivo = $ruta . "descargas/Resultado_proceso_" . $periodos[$z] . ".xlsx";
  //
  //   if(file_exists($rutaArchivo) && filesize($rutaArchivo) > 2000){
  //     $documento = IOFactory::load($rutaArchivo);
  //     $hojaActual = $documento->getSheet(0);
  //
  //     $arregloIni = $hojaActual->toArray();
  //     $arreglo = [];
  //
  //     for($i = 2; $i < count($arregloIni); $i++){
  //       $arreglo[] = $arregloIni[$i];
  //     }
  //
  //     limpiaPeriodoProceso($periodos[$z]);
  //
  //     for($j = 0; $j < count($arreglo); $j++){
  //       if($arreglo[$j][0] == 'Más información disponible si se establece DEBUG=True.'){
  //         break;
  //       }
  //
  //       $ins = ingresaPeriodoProceso($arreglo[$j][0],$arreglo[$j][1],$arreglo[$j][2],$arreglo[$j][3],$arreglo[$j][4],$arreglo[$j][5],$arreglo[$j][6]);
  //       if($ins == "Ok"){
  //         echo "Proceso ingresado: " . $arreglo[$j][0] . "\n";
  //       }
  //       else{
  //         echo "Proceso error: " . $arreglo[$j][0] . "\n";
  //       }
  //     }
  //   }
  // }
  //
  // // Lectura de archivo de centro de costo
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando centro costos") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  //
  // $rutaArchivo = $ruta . "descargas/Centro_de_costos.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arregloIni = $hojaActual->toArray();
  // $arreglo = [];
  //
  // for($i = 2; $i < count($arregloIni); $i++){
  //   $arreglo[] = $arregloIni[$i];
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
  //   $hab_int = 0;
  //   if($habilitado == true){
  //     $hab_int = 1;
  //   }
  //
  //   $sel = datoCentroCostoIngresado($item);
  //
  //   if($sel[0]['CANTIDAD'] == '0'){
  //     if($item != ""){
  //       $ins = ingresaCentroCosto($item,$nombre, $hab_int);
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
  //     $ins = updateCentroCosto($item,$nombre, $hab_int);
  //     if($ins == "Ok"){
  //       echo "Centro de costo actualizado: " . $item . "\n";
  //     }
  //     else{
  //       echo "Centro de costo error actuaizacion: " . $item . "\n";
  //     }
  //   }
  // }
  //
  // // Lectura de archivo de Empleados
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando personal") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // $rutaArchivo = $ruta . "descargas/Empleados.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arregloIni = $hojaActual->toArray();
  // $arreglo = [];
  //
  // for($i = 2; $i < count($arregloIni); $i++){
  //   $arreglo[] = $arregloIni[$i];
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
  //   $FECHA_NACIMIENTO = $arreglo[$j][5];
  //   $NACIONALIDAD = ucwords(strtolower($arreglo[$j][7]));
  //   $DOMICILIO = ucwords(strtolower(str_replace("'","",$arreglo[$j][8]) . ", " . str_replace("'","",$arreglo[$j][9]) . ", " . $arreglo[$j][10]));
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
  //
  // // Lectura de archivo de cargos
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando cargos") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // $rutaArchivo = $ruta . "descargas/Cargos.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arregloIni = $hojaActual->toArray();
  // $arreglo = [];
  //
  // for($i = 2; $i < count($arregloIni); $i++){
  //   $arreglo[] = $arregloIni[$i];
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
  //
  // // Lectura de archivo de centro de catalogo
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando catalogo") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // $rutaArchivo = $ruta . "descargas/Catalogo.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arregloIni = $hojaActual->toArray();
  // $arreglo = [];
  //
  // for($i = 2; $i < count($arregloIni); $i++){
  //   $arreglo[] = $arregloIni[$i];
  // }
  //
  // $JEAS = [];
  // $JEAS[1] = "J";
  // $JEAS[2] = 'E';
  // $JEAS[3] = 'A';
  // $JEAS[4] = 'S';
  // $JEAS[6] = 'G';
  //
  // for($j = 0; $j < count($arreglo); $j++){
  //   if($arreglo[$j][1] == "lta10"){
  //     // echo $arreglo[$j][1] . "\n";
  //     // echo $arreglo[$j][2] . "\n";
  //     // echo $arreglo[$j][3] . "\n";
  //     // echo trim(explode("-",explode(")",$arreglo[$j][7])[1])[0]) . "\n";
  //     // echo $JEAS[trim(explode("-",explode(")",$arreglo[$j][7])[1])[0])] . "\n\n";
  //
  //     $codigo = $arreglo[$j][2];
  //     $nombre = $arreglo[$j][3];
  //     if($arreglo[$j][7] !== ""){
  //       $clasificacion = $JEAS[trim(explode("-",explode(")",$arreglo[$j][7])[1])[0])];
  //     }
  //     else{
  //       $clasificacion = "";
  //     }
  //     $habilitado = trim($arreglo[$j][9]);
  //
  //     $sel = datosCatalogoIngresado($codigo);
  //     $sel[0]['CANTIDAD'];
  //
  //     if($sel[0]['CANTIDAD'] == '0'){
  //       if($codigo != ""){
  //         $ins = ingresaCatalogo($codigo,$nombre,$clasificacion, $habilitado);
  //         if($ins == "Ok"){
  //           echo "Catalogo ingresado: " . $codigo . "\n";
  //         }
  //         else{
  //           echo "Catalogo error: " . $codigo . "\n";
  //         }
  //       }
  //       else{
  //         echo "Catalogo error: " . $codigo . "\n";
  //       }
  //     }
  //     else{
  //       echo "Catalogo error: " . $codigo . "\n";;
  //     }
  //   }
  //
  //   if($arreglo[$j][1] == "lta9"){
  //     $codigo = $arreglo[$j][2];
  //     $nombre = $arreglo[$j][3];
  //     $detalle = trim($arreglo[$j][7]);
  //     $habilitado = trim($arreglo[$j][9]);
  //
  //     $sel = datosCatalogoReferencia1($codigo);
  //     $sel[0]['CANTIDAD'];
  //
  //     if($sel[0]['CANTIDAD'] == '0'){
  //       if($codigo != ""){
  //         $ins = ingresaCatalogoReferencia1($codigo,$nombre,$detalle,$habilitado);
  //         if($ins == "Ok"){
  //           echo "Referencia1 ingresado: " . $codigo . "\n";
  //         }
  //         else{
  //           echo "Referencia1 error: " . $codigo . "\n";
  //         }
  //       }
  //       else{
  //         echo "Referencia1 error: " . $codigo . "\n";
  //       }
  //     }
  //     else{
  //       echo "Referencia1 error: " . $codigo . "\n";;
  //     }
  //   }
  //
  //   if($arreglo[$j][1] == "lta4"){
  //     $codigo = $arreglo[$j][2];
  //     $nombre = $arreglo[$j][3];
  //     $detalle = trim($arreglo[$j][7]);
  //     $habilitado = trim($arreglo[$j][9]);
  //
  //     $sel = datosCatalogoReferencia2($codigo);
  //     $sel[0]['CANTIDAD'];
  //
  //     if($sel[0]['CANTIDAD'] == '0'){
  //       if($codigo != ""){
  //         $ins = ingresaCatalogoReferencia2($codigo,$nombre,$detalle,$habilitado);
  //         if($ins == "Ok"){
  //           echo "Referencia2 ingresado: " . $codigo . "\n";
  //         }
  //         else{
  //           echo "Referencia2 error: " . $codigo . "\n";
  //         }
  //       }
  //       else{
  //         echo "Referencia2 error: " . $codigo . "\n";
  //       }
  //     }
  //     else{
  //       echo "Referencia2 error: " . $codigo . "\n";;
  //     }
  //   }
  // }
  //
  // // Lectura de archivo de contratos
  // $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  // fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando contratos") or die("Error escribiendo en el archivo");
  // fclose($logFile);
  //
  // $rutaArchivo = $ruta . "descargas/Contratos.xlsx";
  // $documento = IOFactory::load($rutaArchivo);
  // $hojaActual = $documento->getSheet(0);
  //
  // $arregloIni = $hojaActual->toArray();
  // $arreglo = [];
  //
  // for($i = 2; $i < count($arregloIni); $i++){
  //   $arreglo[] = $arregloIni[$i];
  // }
  //
  // limpiarDatosContrato();
  //
  // for($j = 0; $j < count($arreglo); $j++){
  //   $dni = $arreglo[$j][1];
  //   $idempresa = $arreglo[$j][2];
  //   $idcentrocosto = $arreglo[$j][12];
  //   $idcargo = $arreglo[$j][82];
  //   $codigoCargoGenerico = $arreglo[$j][44];
  //   $codigoRef1 = $arreglo[$j][43];
  //   $codigoRef2 = $arreglo[$j][31];
  //   // $fechaTermino = convertDate($arreglo[$j][8]);
  //   // $fechaInicio = convertDate($arreglo[$j][7]);
  //   $fechaTermino = $arreglo[$j][8];
  //   $fechaInicio = $arreglo[$j][7];
  //   $causalTermino = $arreglo[$j][9];
  //   $clasificacionContrato = $arreglo[$j][3];
  //
  //   $date1 = new DateTime();
  //   $date2 = new DateTime($fechaTermino);
  //   $diff = $date2->diff($date1);
  //
  //   $ins = ingresaDatosContrato($dni,$fechaTermino,$causalTermino,$codigoCargoGenerico,$codigoRef1,$codigoRef2,$idcargo,$idcentrocosto,$fechaInicio,$clasificacionContrato,$idempresa);
  //
  //   if($ins == "Ok"){
  //     echo "Datos contrato cargados: " . $dni . " - " . $fechaInicio . "\n";
  //   }
  //   else{
  //     echo "Datos contrato no cargados: " . $dni . " - " . $fechaInicio . "\n";
  //   }
  // }
  //
  // ingresaDesvinculacion();
  // actualizaCargoGenericoPersonal();
  // actualizaACT();


  // Lectura de archivo de cargos
  $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando vacaciones") or die("Error escribiendo en el archivo");
  fclose($logFile);

  $rutaArchivo = $ruta . "descargas/Vacaciones.xlsx";
  $documento = IOFactory::load($rutaArchivo);
  $hojaActual = $documento->getSheet(0);

  $arregloIni = $hojaActual->toArray();

  for($i = 2; $i < count($arregloIni); $i++){
    $fini = $arregloIni[$i][8];

    $date1 = new DateTime();
    $date2 = new DateTime($fini);
    $diff = $date1->diff($date2);

    if($diff->days <= 370){
      if($arregloIni[$i][8] != ""){
        $idRexmas = $arregloIni[$i][0];
        $dni = $arregloIni[$i][1];
        $fini = $arregloIni[$i][8];
        $fter = $arregloIni[$i][9];

        $ins = ingresaVacacionRexmas($dni,$fini,$fter,$idRexmas);

        if($ins == "Ok"){
          echo "Vacación ingresada: " . $dni . " | " . $fini . " - " . $fter . "\n";
        }
        else{
          echo "Vacación error: " . $dni . " | " . $fini . " - " . $fter . "\n";
        }
      }
      else{
        echo "Vacio: " . $arregloIni[$i][8] . "\n";
      }
    }
    else{
      echo "No aplica \n";
    }
  }

  // Lectura de archivo de cargos
  $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Ingresando licencias") or die("Error escribiendo en el archivo");
  fclose($logFile);

  $rutaArchivo = $ruta . "descargas/Licencias.xlsx";
  $documento = IOFactory::load($rutaArchivo);
  $hojaActual = $documento->getSheet(0);

  $arregloIni = $hojaActual->toArray();

  for($i = 2; $i < count($arregloIni); $i++){
    $fini = explode("-",substr($arregloIni[$i][19],0,10));
    $fini = $fini[2] . "-" . $fini[1] . "-" . $fini[0];

    $date1 = new DateTime();
    $date2 = new DateTime($fini);
    $diff = $date1->diff($date2);

    if($diff->days <= 370){
      $idRexmas = $arregloIni[$i][0];
      $dni = $arregloIni[$i][4];
      $tipoLic = $arregloIni[$i][7];
      $fini = explode("-",substr($arregloIni[$i][19],0,10));
      $fini = $fini[2] . "-" . $fini[1] . "-" . $fini[0];
      $fter = explode("-",substr($arregloIni[$i][19],10,10));
      $fter = $fter[2] . "-" . $fter[1] . "-" . $fter[0];

      $ins = ingresaLicenciaRexmas($dni,$fini,$fter,$tipoLic,$idRexmas);
      if($ins == "Ok"){
        echo "Licencia ingresada: " . $dni . " | " . $fini . " - " . $fter . "\n";
      }
      else{
        echo "Licencia error: " . $dni . " | " . $fini . " - " . $fter . "\n";
      }
    }
    else{
      echo "No aplica \n";
    }
  }

  echo "Hora de termino: " . date('Y-m-d H:i:s') . "\n";

  $logFile = fopen($ruta . "log.txt", 'a') or die("Error creando archivo");
  fwrite($logFile, "\n" . date("d/m/Y H:i:s")." - Hora de termino") or die("Error escribiendo en el archivo");
  fclose($logFile);

  //Funciones
  function convertDate($dateValue) {
    $unixDate = ($dateValue - 25569) * 86400;
    return gmdate("Y-m-d", $unixDate);
  }

  // echo count($arreglo) . "\n";
?>
