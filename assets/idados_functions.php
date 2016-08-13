<?php 
function idados_gera_senha($tamanho = 8, $maiusculas = true, $numeros = true, $simbolos = false){
  $lmin = 'abcdefghijklmnopqrstuvwxyz';
  $lmai = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $num = '1234567890';
  $simb = '!@#$%*-';
  $retorno = '';
  $caracteres = '';
  $caracteres .= $lmin;
  if ($maiusculas) $caracteres .= $lmai;
  if ($numeros) $caracteres .= $num;
  if ($simbolos) $caracteres .= $simb;
  $len = strlen($caracteres);
  for ($n = 1; $n <= $tamanho; $n++) {
    $rand = mt_rand(1, $len);
    $retorno .= $caracteres[$rand-1];
  }
  return $retorno;
}

function arrayToObject($d) {
  if (is_object($d)) {
    $d = get_object_vars($d);
  }
  if (is_array($d)) {
    return array_map(__FUNCTION__, $d);
  }
  else {
    return $d;
  }
}

function get_filter_fixo($md){
  return '';
  $erro='';
  $ret = "";
  $sql = "
  select 
    i0003_comparison,
    i0003_type,
    i0003_value,
    i0003_field
  from ".idados_prefix(true)."i0003
  where 
  (
    (i0003_modulo = ".$md.")
    and
    (i0003_ativo = 's')
  )
  ";
  $f=0;
  $filter = array();
  $tb = db_exe($sql,'rows');
  $rows = $tb['rows'];
  foreach ($rows as $row){
    $filter[$f]['data']['type']       = $row['i0003_type'];
    $filter[$f]['data']['value']      = $row['i0003_value'];
    $filter[$f]['field']          = $row['i0003_field'];
    $filter[$f]['data']['comparison']   = $row['i0003_comparison'];
    $f++;
  }
  for ($i=0;$i<$f;$i++){
    if($filter[$i]['data']['value']=='_0_')     $filter[$i]['data']['value'] = 0;
    if($filter[$i]['data']['value']=='__md__')    $filter[$i]['data']['value'] = $md;
    if($filter[$i]['data']['value']=='__usr__')     $filter[$i]['data']['value'] = get_membro_codigo();
    
    if($filter[$i]['data']['value']=='__cx__')    $filter[$i]['data']['value'] = $_SESSION["cx"];//$cx;
    if($filter[$i]['data']['value']=='_dia_')     $filter[$i]['data']['value'] = date("j");
    if($filter[$i]['data']['value']=='_sem_')     $filter[$i]['data']['value'] = date("W");
    if($filter[$i]['data']['value']=='_sem_add1_')  $filter[$i]['data']['value'] = (date("W")+1);
    if($filter[$i]['data']['value']=='_mes_')     $filter[$i]['data']['value'] = date("n");
    if($filter[$i]['data']['value']=='_hoje_')    $filter[$i]['data']['value'] = date("Y-m-d");
    if($filter[$i]['data']['value']=='_uddmp_'){
      $filter[$i]['data']['value'] = date("Y-m-d",mktime (0, 0, 0, (date("m")) , 0, date("Y")));
    }
    if($filter[$i]['data']['value']=='_udm_'){
      $filter[$i]['data']['value'] = date("Y-m-d",mktime (0, 0, 0, (date("m")+1) , 0, date("Y")));
    }

    if($filter[$i]['data']['value']=='_pdm_'){
      $filter[$i]['data']['value'] = date("Y-m-d",mktime (0, 0, 0, (date("m")) , 0, date("Y")));
    }
    if($filter[$i]['data']['value']=='_mes_add1_') {
      $calcula = date("n");
      $calcula++;
      if($calcula==13){
        $calcula = '1';
      }
      $filter[$i]['data']['value'] = $calcula;
    }
    if($filter[$i]['data']['value']=='_ano_')     $filter[$i]['data']['value'] = date("Y");
  }
  
  $qs = '';
  $where = "";
  if (is_array($filter)) {
    for ($i=0;$i<$f;$i++){
      switch($filter[$i]['data']['type']){
        case 'string' : 
          switch ($filter[$i]['data']['comparison']) {
            case 'ig' : $qs .= " AND ".$filter[$i]['field']." = '".$filter[$i]['data']['value']."'"; Break; //igual
            case 'eq' : $qs .= " AND ".$filter[$i]['field']." LIKE '%".$filter[$i]['data']['value']."%'"; Break;//contem
          }
          Break;
        case 'list' :
          if (strstr($filter[$i]['data']['value'],',')){
            $fi = explode(',',$filter[$i]['data']['value']);
            for ($q=0;$q<count($fi);$q++){
              $fi[$q] = "'".$fi[$q]."'";
            }
            $filter[$i]['data']['value'] = implode(',',$fi);
            $qs .= " AND ".$filter[$i]['field']." IN (".$filter[$i]['data']['value'].")";
          }else{
            $qs .= " AND ".$filter[$i]['field']." = '".$filter[$i]['data']['value']."'";
          }
        Break;
        case 'boolean' : 
          if($filter[$i]['data']['value']=='true'){
            $qs .= " AND ".$filter[$i]['field']." = 1"; 
          }
          if($filter[$i]['data']['value']=='false'){
            $qs .= " AND ".$filter[$i]['field']." = 0"; 
          }
        Break;
        case 'numeric' :
          switch ($filter[$i]['data']['comparison']) {
            case 'ne' : $qs .= " AND ".$filter[$i]['field']." != ".$filter[$i]['data']['value']; Break;
            case 'eq' : $qs .= " AND ".$filter[$i]['field']." = ".$filter[$i]['data']['value']; Break;
            case 'lt' : $qs .= " AND ".$filter[$i]['field']." < ".$filter[$i]['data']['value']; Break;
            case 'gt' : $qs .= " AND ".$filter[$i]['field']." > ".$filter[$i]['data']['value']; Break;
            case 'mi' : $qs .= " AND ".$filter[$i]['field']." >= ".$filter[$i]['data']['value']; Break;
          }
        Break;
        case 'date' :
          switch ($filter[$i]['data']['comparison']) {
            case 'ne' : $qs .= " AND ".$filter[$i]['field']." != '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break;
            case 'eq' : $qs .= " AND ".$filter[$i]['field']." = '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break;
            case 'lt' : $qs .= " AND ".$filter[$i]['field']." < '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break;
            case 'gt' : $qs .= " AND ".$filter[$i]['field']." > '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break;
            case 'ii' : $qs .= " AND ".$filter[$i]['field']." >= '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break; //maior ou igual
            case 'mi' : $qs .= " AND ".$filter[$i]['field']." <= '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; Break; //menor ou igual
          }
        Break;
      }
    }
    $where .= $qs;
  } 
  return $where;    
}
function get_start($mds){
  $start = 0;
  return $start;
}
function retira_acento_utf($str, $enc = "UTF-8"){
  $acentos = array(
    'A' => '/&Agrave;|&Aacute;|&Acirc;|&Atilde;|&Auml;|&Aring;/',
    'a' => '/&agrave;|&aacute;|&acirc;|&atilde;|&auml;|&aring;/',
    'C' => '/&Ccedil;/',
    'c' => '/&ccedil;/',
    'E' => '/&Egrave;|&Eacute;|&Ecirc;|&Euml;/',
    'e' => '/&egrave;|&eacute;|&ecirc;|&euml;/',
    'I' => '/&Igrave;|&Iacute;|&Icirc;|&Iuml;/',
    'i' => '/&igrave;|&iacute;|&icirc;|&iuml;/',
    'N' => '/&Ntilde;/',
    'n' => '/&ntilde;/',
    'O' => '/&Ograve;|&Oacute;|&Ocirc;|&Otilde;|&Ouml;/',
    'o' => '/&ograve;|&oacute;|&ocirc;|&otilde;|&ouml;/',
    'U' => '/&Ugrave;|&Uacute;|&Ucirc;|&Uuml;/',
    'u' => '/&ugrave;|&uacute;|&ucirc;|&uuml;/',
    'Y' => '/&Yacute;/',
    'y' => '/&yacute;|&yuml;/',
    'a.' => '/&ordf;/',
    'o.' => '/&ordm;/'
  );
  return preg_replace($acentos,array_keys($acentos),htmlentities($str,ENT_NOQUOTES, $enc));
}

function retira_acento($string){
  return $string;
  $a = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr';
  $b = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
  $string = utf8_decode($string);
  $string = strtr($string, ($a), $b); //substitui letras acentuadas por "normais"
  return ($string); //finaliza, gerando uma saída para a funcao
}
function remover_caracter($string) {
    $string = preg_replace("/[áàâãä]/", "A", $string);
    $string = preg_replace("/[ÁÀÂÃÄ]/", "A", $string);
    $string = preg_replace("/[éèê]/", "E", $string);
    $string = preg_replace("/[ÉÈÊ]/", "E", $string);
    $string = preg_replace("/[íì]/", "I", $string);
    $string = preg_replace("/[ÍÌ]/", "I", $string);
    $string = preg_replace("/[óòôõö]/", "O", $string);
    $string = preg_replace("/[ÓÒÔÕÖ]/", "O", $string);
    $string = preg_replace("/[úùü]/", "U", $string);
    $string = preg_replace("/[ÚÙÜ]/", "U", $string);
    $string = preg_replace("/ç/", "C", $string);
    $string = preg_replace("/Ç/", "C", $string);
    // $string = preg_replace("/[][><}{)(:;,!?*%~^`&#@]/", "", $string);
    // $string = preg_replace("/ /", "_", $string);
    return $string;
}

function date_br_fb($data_br){
  if($data_br){
    if(is_array($data_br)){
      $ano = $data_br[3];
      $mes = $data_br[2];
      $dia = $data_br[1];
    }else{
      @list($dia,$mes,$ano) = explode("/", $data_br); 
    }
    $vai = true;
    if(!is_numeric($ano)) $vai = false;
    if(!is_numeric($mes)) $vai = false;
    if(!is_numeric($dia)) $vai = false;
    if($ano=='00') $vai = false;
    if($mes=='00') $vai = false;
    if($dia=='00') $vai = false;
    if($vai){
      if(!checkdate($mes, $dia, $ano)) $vai = false;
    }
    if(strlen($ano)<>4) $vai = false;
    
    if($vai){
      return "'".$ano."-".$mes."-".$dia."'";
    }else{
      return 'null';
    }
  }else{
    return 'null';
  }
}

function get_cliterio2($df){
  $criterio2 = isset($df['criterio2']) ? $df['criterio2'] : '';
  return '';
}

function date_br_php($data_br){
  if($data_br){
    if(is_array($data_br)){
      $ano = $data_br[3];
      $mes = $data_br[2];
      $dia = $data_br[1];
    }else{
      @list($dia,$mes,$ano) = explode("/", $data_br); 
    }
    $vai = true;
    if(!is_numeric($ano)) $vai = false;
    if(!is_numeric($mes)) $vai = false;
    if(!is_numeric($dia)) $vai = false;
    if($ano=='00') $vai = false;
    if($mes=='00') $vai = false;
    if($dia=='00') $vai = false;
    if($vai){
      if(!checkdate($mes, $dia, $ano)) $vai = false;
    }
    if(strlen($ano)<>4) $vai = false;
    
    if($vai){
      return $ano."-".$mes."-".$dia;
    }else{
      return 'null';
    }
  }else{
    return 'null';
  }
}
function date_mysql_br($data){
  $ex = explode("-", $data);
  if(count($ex)==3){
    list($dia,$mes,$ano) = explode("-", $data);
    return $ano."/".$mes."/".$dia;
  }else{
    return $data;
  }
}
function date_br_mysql($data){
  return substr($data,6,4) ."-" .substr($data,3,2) . '-' .substr($data,0,2);
}
function get_submod($md){
  $sql = "
  select 
      i0004_codigo, 
      i0004_nome, 
      i0004_submodulo,
      i0004_op,
      i0004_filtro
  from ".idados_prefix(true)."i0004
  where
      i0004_modulo = ".$md."
      and
      i0004_ativo = 's'
  ";
  $tb = db_exe($sql,'rows',1);
  $rows = $tb['rows'];
  $submod = array();
  for ($i=0;$i<$tb['r'];$i++){
    $submod[$i]['codigo'] = $tb['rows'][$i]['i0004_codigo'];
    $submod[$i]['label'] = $tb['rows'][$i]['i0004_nome'];
    $submod[$i]['md'] = $tb['rows'][$i]['i0004_submodulo'];
    $submod[$i]['op'] = $tb['rows'][$i]['i0004_op'];
    $submod[$i]['ft'] = $tb['rows'][$i]['i0004_filtro'];
  }
  return $submod;
}


function moeda_br_us($valor){
  $valor = preg_replace('/,/', '.',$valor);
  return $valor;
}

function get_modulo_conf($md){
  $sql = "
  select
    i0002_i0002,
    i0002_titulo,
    i0002_url,
    i0002_renderto,
    i0002_tabela,
    i0002_sql_limit,
    i0002_show_tbar,
    i0002_show_context,
    i0002_show_pagin,
    i0002_show_sum,
    i0002_width,
    i0002_height,
    i0002_sql_sort,
    i0002_sql_dir,
    i0002_open_js,
    i0002_descricao,
    i0002_introd,
    i0002_show_pagin,
    i0002_show_col_title,
    i0002_conexao,
    i0002_de_sistema,
    i0002_access_root,
    i0002_grupo,
    i0002_user,

    i0002_retirar_acentos,
    i0002_caixa_alta,

    i0002_grupalizar,
    i0002_show_cp_option

  from ".idados_prefix(true)."i0002
    where i0002_codigo = ".$md."
    ;
  ";
  $ret = array();
  // $ret['sql']         = $sql;
  // print('<pre>');
  // print($sql);
  // die();
  $tb = db_exe($sql,'rows');
  // $ret['tb'] = $tb;
  if($tb['r']){
    $ret['retirar_acentos']   = converte_iso_to_utf8($tb['rows'][0]['i0002_retirar_acentos']);
    $ret['caixa_alta']      = converte_iso_to_utf8($tb['rows'][0]['i0002_caixa_alta']);
    $ret['modulo']        = converte_iso_to_utf8($tb['rows'][0]['i0002_i0002']);
    $ret['title']         = converte_iso_to_utf8($tb['rows'][0]['i0002_titulo']);
    $ret['url']         = converte_iso_to_utf8($tb['rows'][0]['i0002_url']);
    $ret['renderto']      = converte_iso_to_utf8($tb['rows'][0]['i0002_renderto']);
    $ret['sql_ordem']       = $tb['rows'][0]['i0002_sql_sort'];
    $ret['sql_dir']       = $tb['rows'][0]['i0002_sql_dir'];
    $ret['tabela']        = $tb['rows'][0]['i0002_tabela'];
    $ret['width']         = (int) $tb['rows'][0]['i0002_width']; if(!$ret['width']) $ret['width'] = 800;
    $ret['height']        = (int) $tb['rows'][0]['i0002_height']; if(!$ret['height']) $ret['height'] = 600;
    $ret['limit']         = ($tb['rows'][0]['i0002_sql_limit']) ? $tb['rows'][0]['i0002_sql_limit'] : 20;
    $ret['show_tbar']       = ($tb['rows'][0]['i0002_show_tbar']=='S') ? true : false;
    $ret['show_context']    = ($tb['rows'][0]['i0002_show_context']=='S') ? true : false;
    $ret['show_pagin']      = ($tb['rows'][0]['i0002_show_pagin']=='S') ? true : false;
    $ret['show_sum']      = ($tb['rows'][0]['i0002_show_sum']=='S') ? true : false;
    $ret['open_js']       = $tb['rows'][0]['i0002_open_js'];
    $ret['descricao']       = converte_iso_to_utf8($tb['rows'][0]['i0002_descricao']);
    $ret['introd']        = converte_iso_to_utf8($tb['rows'][0]['i0002_introd']);
    $ret['show_pagin']      = $tb['rows'][0]['i0002_show_pagin'];
    $ret['show_col_title']    = $tb['rows'][0]['i0002_show_col_title'];
    $ret['de_sistema']      = $tb['rows'][0]['i0002_de_sistema'];
    $ret['access_root']     = $tb['rows'][0]['i0002_access_root'];
    $ret['grupo']       = (int) $tb['rows'][0]['i0002_grupo'];
    $ret['user']        = (int) $tb['rows'][0]['i0002_user'];
    $ret['conexao']       = (int) $tb['rows'][0]['i0002_conexao'];
    $ret['grupalizar']      = (int) $tb['rows'][0]['i0002_grupalizar'];
    if($ret['de_sistema']=='s'){
      $ret['conexao'] = 1;
    }else{
      $ret['conexao'] = 2;
    }
    $ret['show_cp_option']      = (int) $tb['rows'][0]['i0002_show_cp_option'];
  }
  return $ret;
}

function db_exe($sql,$op='rows',$conn=1){
  $ret = array();
  // if ($conn > 1) {
  //   return $ret;
  // }
  // return $ret;

  if($op=='rows'){
    //$row = $wpdb->get_results($sql, 'ARRAY_A');
    $rr = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');
    $ret['rows'] = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');
    $rows['total'] = count($rr);
    $ret['r'] = $rows['total'];
    $ret['sql'] = $sql;
    return $ret;
  }
  return $GLOBALS['wpdb']->query($sql);
}

function mysqli_no_grupo($cod){
  $sql = "select i0007_db_host, i0007_db_name, i0007_db_user, i0007_db_pass from wp_i0007 where i0007_codigo = ".$cod;
  $tb = db_exe($sql);
  if($tb['r']){
    $mysqli = new mysqli($tb['rows'][0]['i0007_db_host'], $tb['rows'][0]['i0007_db_user'], $tb['rows'][0]['i0007_db_pass'], $tb['rows'][0]['i0007_db_name']);
    // if (mysqli_connect_errno()) {
    //   return false;
    //   //trigger_error(mysqli_connect_error());
    // }
  }
  // print("<pre>");
  // print_r($tb);
  // print("</pre>");

  
  return $mysqli;
}

function db_datax($sql,$op='rows',$cnn){
  return db_exe($sql,$op,$cnn);
}
function db_data($sql,$op='rows',$cnn){
  $ret = array();



  if ($cnn) {
    $mysqli = new mysqli("localhost", "ideiafixa", "Q4SO6FNEPWIU0RgS", "ideiafixa");      
    $result = mysqli_query($mysqli, $sql);
    if($op=='rows'){
      while($row = $result->fetch_array(MYSQLI_ASSOC)){
        $rows[] = $row;
      }
      $ret['rows']  = $rows;
      $ret['total'] = count($ret['rows']);
      $ret['r']     = $ret['total'];
      $ret['sql']   = $sql;
      return $ret;
    }
  }

  if ( is_user_logged_in() ) {
    $user_id = get_current_user_id();
    $idados_user_grupo = get_user_meta($user_id,  'idados_user_grupo', true );
    if ($idados_user_grupo) {

      $mysqli = mysqli_no_grupo($idados_user_grupo);
      $result = mysqli_query($mysqli, $sql);
      if($op=='rows'){
        $rows = array();
        if($result)
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
          $rows[] = $row;
        }

        $ret['rows']  = $rows;
        $ret['total'] = count($ret['rows']);
        $ret['r']     = $ret['total'];
        $ret['sql']   = $sql;
        return $ret;
      }

    }

  }
  
  if($op=='rows'){
    //$row = $wpdb->get_results($sql, 'ARRAY_A');
    $rr = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');
    $ret['rows'] = $GLOBALS['wpdb']->get_results($sql, 'ARRAY_A');
    $rows['total'] = count($rr);
    $ret['r'] = $rows['total'];
    $ret['sql'] = $sql;
    return $ret;
  }
  return $GLOBALS['wpdb']->query($sql);

}

function object_to_array($data){
  if ((! is_array($data)) and (! is_object($data))) return 'xxx'; //$data;
  $result = array();
  $data = (array) $data;
  foreach ($data as $key => $value) {
      if (is_object($value)) $value = (array) $value;
      if (is_array($value)) 
      $result[$key] = object_to_array($value);
      else
          $result[$key] = $value;
  }
  return $result;
}


function idados_addparam($querystring, $ParameterName, $ParameterValue){
    $queryStr = null; 
    $paramStr = null;
    if (strpos($querystring, '?') !== false)
        list($queryStr, $paramStr) = explode('?', $querystring);
    else if (strpos($querystring, '=') !== false)
        $paramStr = $querystring;
    else
        $queryStr = $querystring;
    $paramStr = $paramStr ? '&' . $paramStr : '';
    $paramStr = preg_replace ('/&' . $ParameterName . '(\[\])?=[^&]*/', '', $paramStr);
    if(is_array($ParameterValue)) {
        foreach($ParameterValue as $key => $val) {
            $paramStr .= "&" . urlencode($ParameterName) . "[]=" . urlencode($val);
        }
    } else {
        $paramStr .= "&" . urlencode($ParameterName) . "=" . urlencode($ParameterValue);
    }
    $paramStr = ltrim($paramStr, '&');
    return $queryStr ? $queryStr . '?' . $paramStr : $paramStr;
}

function idados_removeparam($querystring, $ParameterName){
  $paramStr = '';
  $queryStr = '';
    if (strpos($querystring, '?') !== false)
        list($queryStr, $paramStr) = explode('?', $querystring);
    else if (strpos($querystring, '=') !== false)
        $paramStr = $querystring;
    else
        $queryStr = $querystring;
    $paramStr = $paramStr ? '&' . $paramStr : '';
    $paramStr = preg_replace ('/&' . $ParameterName . '(\[\])?=[^&]*/', '', $paramStr);
    $paramStr = ltrim($paramStr, '&');
    return $queryStr ? $queryStr . '?' . $paramStr : $paramStr;
}


function idados_header(){
?>  

<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Title Page</title>

    <!-- Bootstrap CSS -->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
<?php 
}

function idados_footer(){
?>  


    <!-- jQuery -->
    <script src="//code.jquery.com/jquery.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
  </body>
</html>
<?php 
}

