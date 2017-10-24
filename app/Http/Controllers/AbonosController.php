<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Abonos;

class AbonosController extends Controller
{
      function getAbonos(Request $request,$rut){
        $db = app('db');
        $results = $db->select("SELECT a.*, c.nombre_documento AS NOMBRE_DOCUMENTO, v.valor AS VALOR
                                ,DATE_FORMAT(STR_TO_DATE(FECHA_CONTABLE, '%d/%m/%Y'), '%Y')ANO
                                ,DATE_FORMAT(STR_TO_DATE(FECHA_CONTABLE, '%d/%m/%Y'), '%m')MES
                                FROM abonosfc a, ct_tipo_documento c, valorutm v
                                where knumerut=".$rut."
                                and c.empresa='03'    
                                and a.formapag=c.tipo_documento  
                                and v.mes=DATE_FORMAT(STR_TO_DATE(FECHAPAG, '%d/%m/%Y'), '%m')
                                ORDER BY ptipcred desc, nrocuota desc,DATE_FORMAT(STR_TO_DATE(fechapag, '%d/%m/%Y'), '%Y%m%d') desc
                                ");
        //and v.ano=DATE_FORMAT(STR_TO_DATE(FECHAPAG, '%d/%m/%Y'), '%Y')
        
        return response()->json([
            "contador" => count($results),
            "datos" => $results,
        ]);
       
   }
   
}
