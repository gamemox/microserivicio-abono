<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Abonos;

class AbonosController extends Controller
{
      function getAbonos(Request $request,$rut){
        header("Access-Control-Allow-Origin: *");
        header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
        header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
        header('Access-Control-Allow-Credentials: true');            
        $db = app('db');
        $results = $db->select("SELECT A.*, C.NOMBRE_DOCUMENTO, T.DESCCRED AS NOMBRE_CREDITO,0 as DESCUENTO
                                FROM abonosfc A, ct_tipo_documento C, tipocred T
                                WHERE KNUMERUT=".$rut."
                                AND C.TIPO_DOCUMENTO=A.FORMAPAG
                                AND A.PTIPCRED=T.PTIPCRED
                                AND T.PTIPCRED=A.PTIPCRED
                                ORDER BY A.ptipcred desc, A.nrocuota desc,DATE_FORMAT(STR_TO_DATE(fechapag, '%d/%m/%Y'), '%Y%m%d') desc
                                ");
       
        
        return  json_encode($results);
       
   }
   
}
