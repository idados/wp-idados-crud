<?php

function get_md_rows($md, $fields, $col, $df=array(),$cnn=""){
  global $wpdb;
  $udir = wp_upload_dir();
  $rows = array();
  $sql_ordem = '';
  $modulo_conf = get_modulo_conf($md);
  $grupo = $modulo_conf['grupo'];
  $user = $modulo_conf['user'];
  // if(!$grupo) $grupo = get_grupo_id($md);
  // if(!$user) $user = get_membro_codigo($md);
  $tabela = $modulo_conf['tabela'];
  $tabela_name = idados_prefix(true).$tabela;
  $tabela_cliente = idados_prefix(false).$tabela;
  $tabela_campo = $tabela;

  $limit = $modulo_conf['limit'];
  $sort = array();
  $start = 0;
  $wh = '';
  for ($i=0; $i < count($col); $i++) {
    $campo = $col[$i]['dataIndex'];
    $value = isset($_REQUEST[$campo]) ? $_REQUEST[$campo] : '';
    if($value){
      if($col[$i]['filter_type'] == 'date'){
        $value = strip_tags($value);
        $value = "'".date_br_mysql($value)."'";//'---';//
      }
      if($col[$i]['filter_type'] == 'string'){
        $value = "'".($value)."'";
      }
      $wh .= ' and '.$campo." = ". $value;
    }
    $campo_ini = $col[$i]['dataIndex'].'_ini_' ;
    $value_ini = isset($_REQUEST[$campo_ini]) ? $_REQUEST[$campo_ini] : '';
    if($value_ini){
      if($col[$i]['filter_type'] == 'date'){
        $value_ini = strip_tags($value_ini);
        $value_ini = "'".date_br_mysql($value_ini)."'";//'---';//
      }
      $wh .= ' and '.$campo." >= ". $value_ini;
    }
    $campo_end = $col[$i]['dataIndex'].'_end_' ;
    $value_end = isset($_REQUEST[$campo_end]) ? $_REQUEST[$campo_end] : '';
    if($value_end){
      $value_end = strip_tags($value_end);
      $value_end = "'".date_br_mysql($value_end)."'";//'---';//
      $wh .= ' and '.$campo." <= ". $value_end;
    }
  }
  // $sorts = array();
  if(isset($_REQUEST['start']) ? $_REQUEST['start'] : 0) $start = $_REQUEST['start'];
  if(isset($_REQUEST['limit']) ? $_REQUEST['limit'] : 0) $limit = $_REQUEST['limit'];
  //if(isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 0) $sorts = $_REQUEST['sort'];
  $sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : '';
  if($sort){
    $sql_ordem = 'order by '.$sort;
  }
  $filters = isset($_REQUEST['filter']) ? $_REQUEST['filter'] : null;
  if (is_array($filters)) {
      $encoded = false;
  } else {
      $encoded = true;
      $filters = json_decode($filters);
  }
  // criterio - ini
  $crit_e = array();
  $crit_cp = array();
  $crit_sql = '';
  $i=0;
  // $criterio = isset($_REQUEST['criterio']) ? $_REQUEST['criterio'] : '';
  $criterio = isset($df['criterio']) ? $df['criterio'] : '';
  if($criterio){
    $criterio = base64_decode($criterio);
    $crit_e = explode("&", $criterio);
    foreach($crit_e as $value){
      $values = explode("=", $value);
      $crit_cp[$i]['campo'] = $values[0];
      $crit_cp[$i]['value'] = $values[1];

      // if($i) $crit_sql .=", ";
      if($i) $crit_sql .=" and ";
      $operad = "=";
      // $operad = ">=";
      // $operad = "=";
      // $operad = preg_replace("/gt/i",  ">", $operad)
      $crit_sql .= $crit_cp[$i]['campo']." ".$operad." ".$crit_cp[$i]['value'];
      $i++;
    }
    $crit_sql = " AND (".$crit_sql.") ";
  }
  $rows['crit_sql'] = $crit_sql;
  // criterio - end
  $where = ' 0 = 0 ';
  $where .= $wh;
  // if(($modulo_conf['grupalizar']) && ($modulo_conf['conexao'] >=2)){
  //   $where .= ' and '.$modulo_conf['tabela']."_id_sysempresa = ".get_grupo_id($md);
  // }
  // print('<hr>');
  // die($crit_sql);
  $where .= $crit_sql;
  $where .= get_filter_fixo($md);
  $where .= get_cliterio2($df);
  $qs = '';
  // loop through filters sent by client
  if (is_array($filters)) {
      for ($i=0;$i<count($filters);$i++){
          $filter = $filters[$i];
          // assign filter data (location depends if encoded or not)
          if ($encoded) {
              $field = $filter->field;
              $value = $filter->value;
              $compare = isset($filter->comparison) ? $filter->comparison : null;
              $filterType = $filter->type;
          } else {
              $field = $filter['field'];
              $value = $filter['data']['value'];
              $compare = isset($filter['data']['comparison']) ? $filter['data']['comparison'] : null;
              $filterType = $filter['data']['type'];
          }
          switch($filterType){
              case 'string' : $qs .= " and ".$field." like '%".$value."%'"; Break;
              case 'list' :
                  if (strstr($value,',')){
                      $fi = explode(',',$value);
                      for ($q=0;$q<count($fi);$q++){
                          $fi[$q] = "'".$fi[$q]."'";
                      }
                      $value = implode(',',$fi);
                      $qs .= " and ".$field." in (".$value.")";
                  }else{
                      $qs .= " and ".$field." = '".$value."'";
                  }
              Break;
              case 'boolean' : $qs .= " and ".$field." = ".($value); Break;
              case 'numeric' :
                $value = preg_replace("/__user__/i",  get_membro_codigo($md), $value);
                  switch ($compare) {
                      case 'eq' : $qs .= " and ".$field." = ".$value; Break;
                      case 'lt' : $qs .= " and ".$field." <= ".$value; Break;
                      case 'gt' : $qs .= " and ".$field." >= ".$value; Break;
                  }
              Break;
              case 'date' :
                  switch ($compare) {
                      case 'eq' : $qs .= " and ".$field." = '".date('Y-m-d',strtotime($value))."'"; Break;
                      case 'lt' : $qs .= " and ".$field." <= '".date('Y-m-d',strtotime($value))."'"; Break;
                      case 'gt' : $qs .= " and ".$field." >= '".date('Y-m-d',strtotime($value))."'"; Break;
                  }
              Break;
          }
      }
      $where .= $qs;
  }
  // -- filters  -- end

  // tbarFilter -- ini
  $tbarFilter = isset($_REQUEST['tbarFilter']) ? $_REQUEST['tbarFilter'] : '';
  //die($tbarFilter);
  if($tbarFilter){
    $filtro = '';
    for ($i=0;$i<count($fields);$i++){
      if($fields[$i]['type']=='string'){
        if($filtro) $filtro .= ' OR ';
        $filtro .= " ".$fields[$i]['name']." LIKE '%".$tbarFilter."%' ";
      }
    }
    $where .= ' and ('.$filtro.') ';
  }
  $busca = isset($_REQUEST['busca']) ? $_REQUEST['busca'] : '';
  if($busca){
    $filtro = '';
    for ($i=0;$i<count($fields);$i++){
      // if($fields[$i]['type']=='string'){
      if(($fields[$i]['type']=='string') || ($fields[$i]['type']=='blob')){


        if($filtro) $filtro .= ' OR ';
        $filtro .= " ".$fields[$i]['name']." LIKE '%".$busca."%' ";
      }
    }
    $where .= ' and ('.$filtro.') ';
  }
  // tbarFilter -- end
  // ref_loc -- ini
  // referente a pesquisa de localizar clientes
  //select pessoa_codigo,pessoa_pessoa,pessoa_nome,pessoa_nascimento,pessoa_fones,pessoa_vigencia from pessoa   where   0 = 0  AND ( = )  limit 0, 20
  $ref_loc = isset($_REQUEST['ref_loc']) ? $_REQUEST['ref_loc'] : '';
  if($ref_loc=='undefined') $ref_loc = '';
  if($ref_loc){
    $filtro = '';
    $ff=0;
    for ($i=0;$i<count($fields);$i++){
      if($fields[$i]['type']=='string'){
        if($filtro) $filtro .= ' OR ';
        $filtro .= " ".$fields[$i]['name']." LIKE '%".$ref_loc."%' ";
        $ff++;
      }
    }
    if($ff){
      $where .= ' and ('.$filtro.') ';
    }
  }
  $i = 0;
  if($sql_ordem){ //se vem da url
  } else{
    if($modulo_conf['sql_ordem']){
      $sql_ordem = ' order by '.$modulo_conf['sql_ordem'];
      if($modulo_conf['sql_dir']){
        $sql_ordem .= ' '.$modulo_conf['sql_dir'];
      }
    }
  }
  $field = '';
  for ($i=0;$i<count($fields);$i++){
    if($i>0) $field .= ',';
    $field .= $fields[$i]["name"];
  }
  $coluna = '';
  // $inner = '';
  // $inner = $df['join'];
  $inner = $df['inner'];
  
  for ($i=0;$i<count($col);$i++){
    if($i>0) $coluna .= ',';
    $coluna .= $col[$i]["dataIndex"];
    // $inner .= $col[$i]["inner"];
  }
  // if($md==682){
  //   $limit = 100;
  // }


  $de_sistema = ($modulo_conf['de_sistema']=='s') ? true : false;
  $tabela_cliente = idados_prefix($de_sistema).$modulo_conf['tabela'];

  $sql  = "";
  $sql .= "select ";

  $sql .= $coluna." ";
  $sql .= "from ".$tabela_cliente." ";
  
  // if ($md==8208) {
  //   $sql .= " INNER JOIN wp_i8200 ON wp_i8208.i8208_pessoa = wp_i8200.i8200_codigo ";
  // } else {
  //   $sql .= $inner." ";
  // }
  $sql .= $inner." ";
  //INNER JOIN wp_i8207 ON wp_i8208.i8208_servico = wp_i8207.i8207_codigo
  $sql .= " where ";
  $sql .= " ".$where;
  $sql .= $sql_ordem." ";
  $sql .= "limit ".$start.", ".$limit;
  // $tb = db_exe($sql,'rows',$modulo_conf['conexao']);
  // echo "--n".$cnn."n--";
  // die();

  if($df['die_sql']){
    //echo "<pre>";
    print($sql);
    //echo "<pre>";
    // return '';
  }

// select 
//   i8208_codigo,
//   i8200_nome,
//   i8208_servico,
//   i8208_vigencia,
//   i8208_validade,
//   i8208_valor,
//   i8208_status 
// from wp_i8208 
// INNER JOIN wp_i8200 ON wp_i8208.i8208_pessoa = wp_i8200.i8200_codigo  
// where   0 = 0  
// order by i8208_codigo desc limit 0, 10

//tring offset 'total' in /var/www/clients/client32/web41/web/wp-content/plugins/idados-0000/idados-i0000.php 
  //on line 1204



  $tb = db_data($sql,'rows',$cnn);
  // print("<pre>");
  // print_r($tb);  
  // print("</pre>");
  $rows['row'] = array();
  $campo_codigo = $tabela_campo.'_codigo';

  if((isset($tb['r'])) && ($tb['r']))
  for ($i=0;$i<$tb['r'];$i++){
    for ($ii=0;$ii<count($fields);$ii++){
      $campo = $col[$ii]['dataIndex'];
      $rows['row'][$i][$campo] = $tb['rows'][$i][($campo)];
      if($fields[$ii]['type']=='string'){
        $rows['row'][$i][$campo] =  strip_tags( $rows['row'][$i][$campo] );
        $rows['row'][$i][$campo] = retira_acento_utf($rows['row'][$i][$campo]);//esse resolveu
        // $rows['row'][$i][$campo] = strtoupper($rows['row'][$i][$campo]);//esse resolveu
      }
      if($fields[$ii]['type']=='date'){
        $rows['row'][$i][$campo] = date_mysql_br($rows['row'][$i][$campo]);
      }
      if($fields[$ii]['type']=='blob'){
        $rows['row'][$i][$campo] = retira_acento_utf($rows['row'][$i][$campo]);//esse resolveu
      }
      if($col[$ii]['dataIndex']==$campo_codigo){
        $rows['row'][$i][$campo] = str_pad($rows['row'][$i][$campo], 6, "0", STR_PAD_LEFT);
      }
    }
  }
  //troca url - ini



  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "idados_link_ajax";
  };

  if((isset($tb['r'])) && ($tb['r']))
  for ($i=0;$i<$tb['r'];$i++){
    for ($ii=0;$ii<count($fields);$ii++){
      $url_painel = $fields[$ii]['url_painel'];
      $vai = 1;
      if($url_painel){
        $vai = idados_role_logic($url_painel);
      }
      if($vai){
        if($fields[$ii]['url']){
          $campo = $col[$ii]['dataIndex'];
          $value = $rows['row'][$i][$campo];
          $value = $fields[$ii]['url'];
          $campo_codigo = $tabela_campo.'_codigo';
          $value = html_entity_decode($value);
          $value = preg_replace("/__tcod__/i",  strip_tags($rows['row'][$i][$campo_codigo]), $value);
          $value = preg_replace("/__this_cod__/i",  $rows['row'][$i][$campo_codigo], $value);
          $value = preg_replace("/__cod__/i",  $rows['row'][$i][$campo_codigo], $value);
          $value = preg_replace("/__pai__/i",  (isset($_GET['pai']) ? $_GET['pai'] : ''), $value);
          $value = preg_replace("/__this__/i", $rows['row'][$i][$campo], $value);
          $value = preg_replace("/__ucod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $value);
          $value = preg_replace("/__site_url__/",site_url() , $value);
          $value = preg_replace("/__upload_dir__/",$udir['baseurl'] , $value);

          $value = preg_replace("/__idados_ajax_url__/",$url , $value);
          $value = preg_replace("/__idados_class_url__/",$add_class , $value);


          // $value = '--=--';
          $value = html_entity_decode($value);
          $rows['row'][$i][$campo] = $value;
          for ($iii=0;$iii<  count($fields); $iii++){
            $campoiii = strtolower($fields[$iii]["name"]);
            if (preg_match("/__".$campoiii."__/i", $value)) {
              $value = preg_replace("/__".$campoiii."__/i",   $rows['row'][$i][$campoiii]   , $value);
            }
          }
          $rows['row'][$i][$campo] = $value;
        }
      }
    }
  }

  //troca url - end
//--- TOTAL



// if ($md==8208) {
//   $inner .= " INNER JOIN wp_i8200 ON wp_i8208.i8208_pessoa = wp_i8200.i8200_codigo ";
// }



  $sql = "select count(".$col[0]["dataIndex"].") qtd ";
  $sql .= " from ".$tabela_cliente;
  $sql .= " ".$inner;
  $sql .= " where ";
  $sql .= $where;
  $tb = db_data($sql,'rows',$cnn);
  // print('<pre>');
  // print($sql);
  // print('</pre>');
  $rows['total'] = isset($tb['rows'][0]['qtd']) ? $tb['rows'][0]['qtd'] : 0;
  $somas = array();
  for ($ii=0;$ii<count($fields);$ii++){
    $somas[$ii] = '-';
      $field = strtoupper($fields[$ii]["name"]);
  }
  $rows['db_host'] = get_the_author_meta('db_host', get_current_user_id());
  return $rows;
}












function get_md_edit($md,$cod,$cnn){
  global $wpdb;
  $ret_md_edit = array();
  $campo = array();
  $rules = array();
  $ret_md_edit['campo'] = $campo;
  $ret_md_edit['rules'] = $rules;
  $modulo_conf = get_modulo_conf($md);
  $sql = "select * from ".idados_prefix(true)."i0001 where i0001_modulo = ".$md." and i0001_ativo = 's'order by i0001_ordem";
  $tb = db_exe($sql,'rows');
  $rows = $tb['rows'];
  $items = array();
  $i=0;
  $r=0;
  foreach ($rows as $row){
    $vai = select_vai($row['i0001_ctr_edit'],'edit');
    if($vai){
      $campo[$i]["inputId"]     = $row['i0001_campo'];
      $campo[$i]["type"]      = $row['i0001_tipo'];
      $campo[$i]["name"]      = $row['i0001_campo'];
      $campo[$i]["xtype"]     = strtolower($row['i0001_ctr_edit']);
      $campo[$i]["fieldLabel"]  = strtoupper(Win1252ToUtf8($row['i0001_label']));
      $campo[$i]['value']     = '';
      $campo[$i]['black']     = $row['i0001_black'];
      if($campo[$i]["xtype"]=='textfield') $campo[$i]["type"] = 'text';
      if($campo[$i]["xtype"]=='combobox'){
        $campo[$i]["type"] = 'select';
        $sql2  = "select ";
        $sql2 .= $row['i0001_cmb_codigo'].", ".$row['i0001_cmb_descri']." ";
        $sql2 .= "from ".$row['i0001_cmb_source']." ";
        $sql2 .= "order by ".$row['i0001_cmb_descri']." ";
        $sql2 .= " ;";
        $tb2 = db_exe($sql2,'rows');
        $rows2 = $tb2['rows'];
        $j = 0;
        $cmb_store = "";
        $c1 = ($row['i0001_cmb_codigo']);
        $c2 = ($row['i0001_cmb_descri']);
        foreach ($rows2 as $row2){
          $campo[$i]['store'][$j]['cod'] = $row2[$c1];
          $campo[$i]['store'][$j]['value'] = Win1252ToUtf8($row2[$c2]);
          $campo[$i]['store'][$j]['selected'] = '';
          $j++;
        }
      }
      if(!$campo[$i]['black']){
        $name = $campo[$i]["name"];
        $rules[$name]['required'] = true;
        $r++;
      }
      $i++;
    }
  }
  $tabela = $tb['rows'][0]['i0001_tabela'];
  $tabela_name = idados_prefix(true).$tb['rows'][0]['i0001_tabela'];
  $tabela_cliente = idados_prefix(false).$tb['rows'][0]['i0001_tabela'];
  $tabela_campo = $tb['rows'][0]['i0001_tabela'];

  $grupo = $modulo_conf['grupo'];
  // if(!$grupo) $grupo = get_grupo_id($md);
  $sql = "select ";
  for ($i=0;$i<count($campo);$i++){
    if($i>0) $sql .= ',';
    $sql .= $campo[$i]["name"];
  }

  $de_sistema = ($modulo_conf['de_sistema']=='s') ? true : false;
  $tabela_cliente = idados_prefix($de_sistema).$modulo_conf['tabela'];

  $sql .= ' from '.$tabela_cliente." ";
  $sql .= "where ";
  $sql .= $tabela_campo."_codigo = ".$cod." ";
  $tb = db_data($sql,'rows',$cnn);
  $r=0;
  for ($i=0;$i<count($campo);$i++){
    $ccampo = ($campo[$i]["name"]);
    $value = isset($tb['rows'][0][$ccampo]) ? $tb['rows'][0][$ccampo] : '';
    $type = $campo[$i]["type"];
    $xtype = $campo[$i]['xtype'];
    if($campo[$i]["xtype"]=='combobox'){
      for ($ii=0;$ii<count($campo[$i]["store"]);$ii++){
        if($campo[$i]["store"][$ii]['cod']==$value){
          $campo[$i]["store"][$ii]['selected'] = 'selected';
        }
      }
    }
    if(($type=='text') || ($type=='string')){
      $value = retira_acento_utf($value);
      $value = ($value);
    }
    if($type=='float'){
      $value = moeda_br($value);
    }
    if($type=='date'){
      if($value=='null'){
        $value = '';
      }else{
        $value = date_mysql_br($value);
      }
    }
    $campo[$i]["value"] = $value;
  }
  $ret_md_edit['campo'] = $campo;
  $ret_md_edit['rules'] = $rules;
  return $ret_md_edit;
}
function get_md_view($md,$cod,$cnn,$df=''){
  global $wpdb;
  $ret_md_edit = array();
  $campo = array();
  $rules = array();
  $ret_md_edit['campo'] = $campo;
  $ret_md_edit['rules'] = $rules;
  $modulo_conf = get_modulo_conf($md);
  $sql = "select * from ".idados_prefix(true)."i0001 where i0001_modulo = ".$md." and i0001_ativo = 's'order by i0001_ordem";
  $tb = db_exe($sql,'rows');
  $rows = $tb['rows'];
  $items = array();
  $i=0;
  $r=0;
  foreach ($rows as $row){


    $vai = select_vai($row['i0001_ctr_view'],'view');
    if($vai) {
      if($row['i0001_renderer']){
        // $vai = $row['i0001_renderer'];
        $vai = idados_role_logic($row['i0001_renderer']);
      }

      //i0001_renderer
    }


    if($vai){
      $campo[$i]["inputId"]   = $row['i0001_campo'];
      $campo[$i]["type"]      = $row['i0001_tipo'];
      $campo[$i]["name"]      = $row['i0001_campo'];
      $campo[$i]["xtype"]     = strtolower($row['i0001_ctr_edit']);
      $campo[$i]["fieldLabel"]  = strtoupper(Win1252ToUtf8($row['i0001_label']));
      $campo[$i]['value']     = '';
      $campo[$i]['black']     = $row['i0001_black'];
      $campo[$i]['url']       = $row['i0001_url'];
      $campo[$i]['url_painel']= $row['i0001_url_painel'];
      if($campo[$i]["xtype"]=='textfield') $campo[$i]["type"] = 'text';
      if($campo[$i]["xtype"]=='combobox'){
        $campo[$i]["type"] = 'select';
        $sql2  = "select ";
        $sql2 .= $row['i0001_cmb_codigo'].", ".$row['i0001_cmb_descri']." ";
        $sql2 .= "from ".$row['i0001_cmb_source']." ";
        $sql2 .= "order by ".$row['i0001_cmb_descri']." ";
        $sql2 .= " ;";
        $tb2 = db_exe($sql2,'rows');
        $rows2 = $tb2['rows'];
        $j = 0;
        $cmb_store = "";
        $c1 = ($row['i0001_cmb_codigo']);
        $c2 = ($row['i0001_cmb_descri']);
        foreach ($rows2 as $row2){
          $campo[$i]['store'][$j]['cod'] = $row2[$c1];
          $campo[$i]['store'][$j]['value'] = Win1252ToUtf8($row2[$c2]);
          $campo[$i]['store'][$j]['selected'] = '';
          $j++;
        }
      }
      if(!$campo[$i]['black']){
        $name = $campo[$i]["name"];
        $rules[$name]['required'] = true;
        $r++;
      }
      $i++;
    }
  }
  $tabela = $tb['rows'][0]['i0001_tabela'];
  $tabela_name = idados_prefix(true).$tb['rows'][0]['i0001_tabela'];
  $tabela_cliente = idados_prefix(false).$tb['rows'][0]['i0001_tabela'];
  $tabela_campo = $tb['rows'][0]['i0001_tabela'];
  // $grupo = $modulo_conf['grupo'];
  // if(!$grupo) $grupo = get_grupo_id($md);

  $de_sistema = ($modulo_conf['de_sistema']=='s') ? true : false;
  $tabela_cliente = idados_prefix($de_sistema).$modulo_conf['tabela'];

  $sql = "select ";
  for ($i=0;$i<count($campo);$i++){
    if($i>0) $sql .= ',';
    $sql .= $campo[$i]["name"];
  }
  $sql .= ' from '.$tabela_cliente." ";
  $sql .= "where ";
  $sql .= $tabela_campo."_codigo = ".$cod." ";

  $tb = db_data($sql,'rows',$cnn);
  // echo $cnn;
  
  // $tb = db_exe($sql,'rows');

  // echo "<pre>";
  // print_r($tb);
  // echo "</pre>";
  // die();
  
  $r=0;
  for ($i=0;$i<count($campo);$i++){
    $ccampo = ($campo[$i]["name"]);
    $value = isset($tb['rows'][0][$ccampo]) ? $tb['rows'][0][$ccampo] : '';
    $type = $campo[$i]["type"];
    $xtype = $campo[$i]['xtype'];
    if($campo[$i]["xtype"]=='combobox'){
      for ($ii=0;$ii<count($campo[$i]["store"]);$ii++){
        if($campo[$i]["store"][$ii]['cod']==$value){
          $campo[$i]["store"][$ii]['selected'] = 'selected';
        }
      }
    }
    if(($type=='text') || ($type=='string')){
      $value = retira_acento_utf($value);
      $value = ($value);
    }
    if($type=='float'){
      $value = moeda_br($value);
    }
    if($type=='date'){
      if($value=='null'){
        $value = '';
      }else{
        $value = date_mysql_br($value);
      }
    }


    $campo_codigo = $tabela_campo.'_codigo';
    if($ccampo==$campo_codigo){
      $campo[$i]["value"] = str_pad($campo[$i]["value"], 6, "0", STR_PAD_LEFT);
    }




    $campo[$i]["value"] = $value;
  }



  //troca url - ini
  $tabela = $modulo_conf['tabela'];
  $tabela_name = idados_prefix(true).$tabela;
  $tabela_cliente = idados_prefix(false).$tabela;
  $tabela_campo = $tabela;

  // echo '<pre>';
  // print_r($campo);

  $campo_codigo = $tabela_campo.'_codigo';
  for ($i=0;$i <  count($campo); $i++){
    if($campo[$i]['name'] == $campo_codigo){
      $codigo = $campo[$i]['value'];
    }
  }

  for ($i=0;$i<count($campo);$i++){
    if($campo[$i]['url']){

      $url_painel = $campo[$i]['url_painel'];
      $vai = 0;
      if($url_painel){
        $vai = idados_role_logic($url_painel);
      }
      if($vai){



        $value = $campo[$i]['url'];
        // $value = html_entity_decode($campo[$i]["value"]);
        // $value = preg_replace("/__tcod__/i",  $rows['row'][$i][$campo_codigo], $value);
        $value = preg_replace("/__cod__/i",  $codigo, $value);
        $value = preg_replace("/__this__/i", $campo[$i]["value"], $value);
        $value = preg_replace("/__pai__/i",  (isset($_GET['pai']) ? $_GET['pai'] : ''), $value);
        // $value = html_entity_decode($value);
        for ($iii=0;$iii <  count($campo); $iii++){
          $campoiii = strtolower($campo[$iii]["name"]);
          if (preg_match("/__".$campoiii."__/i", $value)) {
            $value = preg_replace("/__".$campoiii."__/i", $campo[$iii]["value"], $value);
          }
        }
        $campo[$i]["value"] = $value;
      }
    }
  }
  //troca url - end
  $ret_md_edit['campo'] = $campo;
  $ret_md_edit['rules'] = $rules;
  return $ret_md_edit;
}

function md_insert($md,$values=array(),$cnn){
  global $wpdb;
  $modulo_conf = get_modulo_conf($md);
  // $grupo = $modulo_conf['grupo'];
  // if(!$grupo) $grupo = get_grupo_id($md);
  $sql = "select * from ".idados_prefix(true)."i0001 where i0001_modulo = ".$md." and i0001_ativo = 's' order by i0001_ordem ";
  $tb = db_exe($sql,'rows');
  $rows = $tb['rows'];
  $i=0;
  $campo = array();
  foreach ($rows as $row){
    $vai = select_vai($row['i0001_ctr_new'],'novo');
    if($vai){
      $name = $row['i0001_campo'];
      if(isset($values[$name])){
        $campo[$i]['name']    = $row['i0001_campo'];
        $campo[$i]['type']    = $row['i0001_tipo'];
        $campo[$i]['value']   = isset($values[$name]) ? $values[$name] : '';
        $campo[$i]['xtype']   = strtolower($row['i0001_ctr_new']);
        $i++;
      }
    }
  }

/*
    if($vai){
      $name = $row['i0001_campo'];
      $nameU = strtoupper($name);
      $nameL = strtolower($name);
      $vai2 = false;
      // $vai2 = isset($_POST[$nameL]) ? true : false;
      $vai2 = isset($_REQUEST[$nameL]) ? true : false;
      if($vai2){
        $campo[$i]['name'] = $row['i0001_campo'];
        $campo[$i]['type']    = $row['i0001_tipo'];
        // $campo[$i]['value']   = $_POST[$name];
        $campo[$i]['value']   = $_REQUEST[$name];
        $i++;
      }
    }

*/
  $modulo_conf = get_modulo_conf($md);
  $tabela = idados_prefix(true).$modulo_conf['tabela'];
  $tabela_cliente = idados_prefix(false).$modulo_conf['tabela'];
  // $de_sistema = ($modulo_conf['i0002_de_sistema']=='s') ? true : false;
  $i_old = $i;
  for ($i=0;$i<$i_old;$i++){
    if(($campo[$i]['xtype']=="checkbox") && ($campo[$i]['type']=='string')){
      if(!$campo[$i]['value']) {
        $campo[$i]['value'] = 'N';
      } else {
        $campo[$i]['value'] = 'S';
      }
    }
    if(($campo[$i]['xtype']=="checkbox") && ($campo[$i]['type']=='int')){
      if(!$campo[$i]['value']) {
        $campo[$i]['value'] = 0;
      } else {
        $campo[$i]['value'] = 1;
      }
    }
    if($campo[$i]['type']=='date'){
      if(!$campo[$i]['value']){
        $campo[$i]['value'] = 'null';
      }else{
        $campo[$i]['value'] = date_br_php($campo[$i]['value']);
        $campo[$i]['value'] = "'".$campo[$i]['value']."'";
      }
    }
    if($campo[$i]['type']=='blob')    $campo[$i]['value'] = "'".utf8ToWin1252($campo[$i]['value'])."'";
    if($campo[$i]['type']=='string'){
      $campo[$i]['value'] = "'".($campo[$i]['value'])."'";
      $campo[$i]['value'] = retira_acento_utf($campo[$i]['value']);
      $de_sistema = $modulo_conf['de_sistema'];
    }
    if($campo[$i]['type']=='int')   {if(!$campo[$i]['value']) $campo[$i]['value'] = 0;}
    if($campo[$i]['type']=='float')   {
      if(!$campo[$i]['value']) $campo[$i]['value'] = 0;
      $campo[$i]['value'] = moeda_br_us($campo[$i]['value']);
    }
  }
  $c = $i;


  // //===== fielter add - ini =================
  // $sql = "
  // select
  //     i0005.i0005_field,
  //     i0005.i0005_type,
  //     i0005.i0005_value
  // from i0005
  // where i0005.i0005_modulo = ".$md."
  // ";
  // $tb = db_exe($sql,'rows');
  // $iii = 0;
  // $ret['filterAdd'] = $tb['rows'];
  // $achou = 0;
  // for ($i=0;$i<$tb['r'];$i++){
  //   $field  = $tb['rows'][$i]['i0005_field'];
  //   $type   = $tb['rows'][$i]['i0005_type'];
  //   $value  = $tb['rows'][$i]['i0005_value'];
  //   if($type=='string')  $value = "'".$value."'";
  //   $campo[$c]['name'] = $field;
  //   $campo[$c]['value'] = $value;
  //   $campo[$c]['type'] = $type;
  //   $c++;
  // }
  // $result_insert = array();
  // //===== fielter add - end =================
  // $modulo_conf = get_modulo_conf($md);
  // $grupo = $modulo_conf['grupo'];
  // $user = $modulo_conf['user'];
  // if(!$grupo) $grupo = get_grupo_id($md);
  // if(!$user) $user = get_membro_codigo($md);

  $de_sistema = ($modulo_conf['de_sistema']=='s') ? true : false;
  $tabela_cliente = idados_prefix($de_sistema).$modulo_conf['tabela'];
  if($md==8126){
    $tabela_cliente = idados_prefix($de_sistema).'i'.$md;
  }


  $sql = "insert into ".$tabela_cliente." ";
  $sql_insert = '';
  $sql_values = '';
  for ($i=0;$i<count($campo);$i++){
    if($i > 0){
      $sql_insert .= ",";
      $sql_values .= ",";
    }
    $sql_insert .= $campo[$i]['name'];
    $sql_values .= $campo[$i]['value'];
  }
  if(($modulo_conf['grupalizar']) && ($modulo_conf['conexao'] >=2)){
    $sql_insert .= ", ".$modulo_conf['tabela'].'_id_sysempresa ';
    $sql_insert .= ", ".$modulo_conf['tabela'].'_id_sysusuario ';
    $sql_values .= ", ".get_grupo_id($md);
    $sql_values .= ", ".get_membro_codigo($md);
  }
  $sql .= "(".$sql_insert.")";
  $sql .= " values ";
  $sql .= "(".$sql_values.")";
  // if($md==9130){
  //   print('<pre>');
  //   print($sql);
  //   print('</pre>');
  //   die();
  // }
  // $ret = db_exe($sql,'insert');
  // global $wpdb;
  // $ret = $wpdb->query($sql);
  //db_data
  $ret = db_data($sql,'insert',$cnn);
  // if($md==9130){
  //   print('<pre>');
  //   print($sql);
  //   print_r($ret);
  //   print('</pre>');
  //   die();
  // }


}
function md_update($md,$cod,$cnn){
  global $wpdb;
  $sql = "
    select
      i0001_codigo,
      i0001_ctr_edit,
      i0001_campo,
      i0001_largura,
      i0001_tipo
    from
      ".idados_prefix(true)."i0001
    where
    (
      (
        i0001_modulo = ".$md."
      )
      and
      (
        i0001_ativo = 's'
      )
    )
    order by i0001_ordem
  ";
  // echo "<pre>";
  // echo $sql;
  // echo "</pre>";
  // die();
  $tb = db_exe($sql,'rows');
  $return_update = array();
  $i=0;
  $campo = array();
  $rows = $tb['rows'];
  foreach ($rows as $row){
    $vai = select_vai($row['i0001_ctr_edit'],'edit');
    if($vai){
      $name = $row['i0001_campo'];
      $nameU = strtoupper($name);
      $nameL = strtolower($name);
      $vai2 = false;
      // $vai2 = isset($_POST[$nameL]) ? true : false;
      $vai2 = isset($_REQUEST[$nameL]) ? true : false;
      if($vai2){
        $campo[$i]['name'] = $row['i0001_campo'];
        $campo[$i]['type']    = $row['i0001_tipo'];
        // $campo[$i]['value']   = $_POST[$name];
        $campo[$i]['value']   = $_REQUEST[$name];
        $i++;
      }
    }
  }
  $modulo_conf = get_modulo_conf($md);
  $tabela = $modulo_conf['tabela'];
  $tabela_name = idados_prefix(true).$tabela;
  $tabela_cliente = idados_prefix(false).$tabela;
  $tabela_campo = $tabela;

  $i_old = $i;
  for ($i=0;$i<$i_old;$i++){
    if($campo[$i]['type']=='date'){
        $campo[$i]['value'] = date_br_php($campo[$i]['value']);
        $campo[$i]['value'] = "'".$campo[$i]['value']."'";
    }

    if($campo[$i]['type']=='blob')    $campo[$i]['value'] = "'".($campo[$i]['value'])."'";
    if($campo[$i]['type']=='string'){
      $campo[$i]['value'] = retira_acento_utf($campo[$i]['value']);
      $de_sistema = $modulo_conf['de_sistema'];
      $campo[$i]['value'] = "'".($campo[$i]['value'])."'";
    }
    if($campo[$i]['type']=='int')   {if(!$campo[$i]['value']) $campo[$i]['value'] = 0;}
    if($campo[$i]['type']=='float')   {
      if(!$campo[$i]['value']) $campo[$i]['value'] = 0;
      $campo[$i]['value'] = moeda_br_us($campo[$i]['value']);
    }
    if($campo[$i]['type']=='float')   {$campo[$i]['value'] =  moeda_br_us($campo[$i]['value']);}
  }
  $return_update['campo'] = $campo;

  $de_sistema = ($modulo_conf['de_sistema']=='s') ? true : false;
  $tabela_cliente = idados_prefix($de_sistema).$modulo_conf['tabela'];

  $sql = "update ".$tabela_cliente." set ";
  for ($i=0;$i<count($campo);$i++){
    if($i>0) $sql .=", ";
    $sql .= $campo[$i]['name'].' = '.$campo[$i]['value'];
  }
  $sql .= " where ".$tabela_campo."_codigo = ".$cod." ";
  // echo $sql;

  // echo "<pre>";
  // echo $sql;
  // echo "</pre>";
  // die();

  //$return_update['sql'] = $sql;
  // $ret = db_exe($sql,'insert',$modulo_conf['conexao']);
  //$rret = db_exe($sql,'insert',$modulo_conf['conexao']);
  // return 1;

  // $ret = $wpdb->query($sql);
  //db_data
  $ret = db_data($sql,'update',$cnn);

  // echo "<pre>";
  // print_r($ret);
  // echo "</pre>";
  // die();

  return  $ret;


}


function get_md_novo($md){
  $ret_md_novo = array();
  $campo = array();
  $rules = array();
  $ret_md_novo['campo'] = $campo;
  $ret_md_novo['rules'] = $rules;
  // $sql =  "select * from i0001 where i0001_modulo = ".$md." and i0001_ativo = 's' order by i0001_ordem";
  $rows = get_fields($md);
  // $tb = db_exe($sql,'rows');
  // $rows = $tb['rows'];

  // echo '<pre>';
  // print_r($rows);
  // die('get_md_novo');

  $i=0;
  $r=0;
  if(count($rows)){
    foreach ($rows as $row){
      $vai = select_vai($row['ctr_new'],'novo');
      if($vai){
        $campo[$i]["inputId"] = strtolower($row['name']);
        $campo[$i]["type"] = $row['tipo'];
        $campo[$i]["name"] = $row['name'];
        // $campo[$i]["ctr_new"] = $row['i0001_ctr_new'];
        $campo[$i]["value"] = '';
        $campo[$i]["cls"] = $row['cls'];
        $campo[$i]["xtype"] = strtolower($row['ctr_new']);
        $campo[$i]["fieldLabel"]  = strtoupper(Win1252ToUtf8($row['label']));
        $campo[$i]['width'] = 550;
        $campo[$i]['black'] = ($row['black']) ? true : false;
        $campo[$i]['placeholde'] = '';//novo
        if($campo[$i]["xtype"]=='textfield') $campo[$i]["type"] = 'text';
        if($campo[$i]["xtype"]=='combobox'){
          $campo[$i]["type"] = 'select';
          $sql2  = "select  ".$row['cmb_codigo'].", ".$row['cmb_descri']." ";
          $sql2 .= "from ".$row['cmb_source']." ";
          $sql2 .= "order by ".$row['cmb_descri']." ";
          $sql2 .= " ;";

          $campo[$i]["sql_combo"] = $sql2;

          $tb2 = db_data($sql2,'rows');
          $rows2 = $tb2['rows'];

          $j = 1;
          $cmb_store = "";
          $c1 = ($row['cmb_codigo']);
          $c2 = ($row['cmb_descri']);
          $campo[$i]['store'][0]['cod'] = '';
          $campo[$i]['store'][0]['value'] = '';
          $campo[$i]['store'][0]['selected'] = 'selected';
          foreach ($rows2 as $row2){
            $campo[$i]['store'][$j]['cod'] = $row2[$c1];
            $campo[$i]['store'][$j]['value'] = Win1252ToUtf8($row2[$c2]);
            $campo[$i]['store'][$j]['selected'] = '';
            $j++;
          }
        }
        if(!$campo[$i]['black']){
          $name = $campo[$i]["name"];
          $rules[$name]['required'] = true;
          $r++;
        }
        $i++;
      }
      // print_r($campo);
      // die();
    }
    $ret_md_novo['campo'] = $campo;
    $ret_md_novo['rules'] = $rules;

  }
  return $ret_md_novo;
}



function md_delete($md,$cod){
  global $wpdb;
  $modulo_conf = get_modulo_conf($md);


  $tabela = $modulo_conf['tabela'];
  $tabela_name = idados_prefix(true).$tabela;
  $tabela_cliente = idados_prefix(false).$tabela;
  $tabela_campo = $tabela;

  $sql = "delete from ".$tabela_cliente." where ".$tabela_campo."_codigo = ".$cod.";";
  return db_data($sql,'delete');
}
function get_list($mds){
  $mds = get_md_col($mds);
  $mds = get_md_rows($mds);
  return $mds;
}
function md_duplique($md,$cod,$cnn){
  $md_edit = get_md_edit($md,$cod,$cnn);
  $campos = $md_edit['campo'];

  $values = array();
  for ($i=0; $i < count($campos); $i++) {
    $campo = $campos[$i]['name'];
    $value = $campos[$i]['value'];
    $values[$campo] = $value;
  }
  md_insert($md,$values,$cnn);
  return $values;

}

function get_md_col($md){
  $sql = "
  select
    i0001_codigo,
    i0001_ctr_list,
    i0001_campo,
    i0001_tipo,
    i0001_label,
    i0001_largura,
    i0001_tabela,
    i0001_cmb_source,
    i0001_cmb_descri,
    i0001_hidden
  from ".idados_prefix(true)."i0001
  where
    (
      (i0001_modulo = ".$md.")
     and
      (i0001_ativo = 's')
    )
  order by i0001_ordem
  ";
  $tb = db_exe($sql,'rows');
  $rows = $tb['rows'];
  // echo $sql;
  // echo '<pre>';
  // print_r($rows);
  // echo '</pre>';
  // die();
  // $tabela = $rows[0]['i0001_tabela'];

  $modulo_conf = get_modulo_conf($md);
  // print('<pre>');
  // print($md);
  // print_r($modulo_conf);
  // die();
  $tabela = $modulo_conf['tabela'];
  // $tabela = 'i'.$md;

  $tabela_name = idados_prefix(true).$tabela;
  $tabela_cliente = idados_prefix(false).$tabela;
  $tabela_campo = $tabela;

  // print('<pre>');
  // print($sql);
  // print('<hr>');
  // print_r($tb);
  // print('</pre>');
  $col = array();
  $c=0;
  for ($i=0;$i<$tb['r'];$i++) {
    $vai = select_vai($rows[$i]['i0001_ctr_list'],'list');
    if($vai){
      $col[$c]["cd"]=$rows[$i]['i0001_codigo'];
      $col[$c]["codigo_name"]=$tabela.'_codigo';
      $col[$c]["text"]=Win1252ToUtf8($rows[$i]['i0001_label']);
      $col[$c]["text"] = strtoupper($col[$c]["text"]);
      $col[$c]["dataIndex"]=$rows[$i]['i0001_campo'];
      $col[$c]["width"]=$rows[$i]['i0001_largura'];
      $col[$c]["hidden"]= ($rows[$i]['i0001_hidden']==1) ? true : false;
      if($col[$c]["width"]) $col[$c]["width"] = $col[$c]["width"] * 1.5;
      $col[$c]["filter_type"]=$rows[$i]['i0001_tipo'];
      $col[$c]["filter"]['type']=$rows[$i]['i0001_tipo'];
      if($rows[$i]['i0001_tipo']=='int') {
        $col[$c]["filter_type"] = 'numeric';
        $col[$c]["filter"]['type']  = 'numeric';
      }
      $col[$c]["inner"] = '';
      $col[$c]["ctr_list"] = $rows[$i]['i0001_ctr_list'];
      if($rows[$i]['i0001_ctr_list']=='combobox'){
        $col[$c]["dataIndex"] = $rows[$i]['i0001_cmb_descri'];
        $col[$c]["type"] = 'string';
        $col[$c]["align"] = 'left';
        $col[$c]["filter_type"] = 'string';
        $col[$c]["filter"]['type']  = 'string';
        $len2 = strlen($rows[$i]['i0001_tabela']);$len2++;
        $cp_fk2 = substr($rows[$i]['i0001_campo'],$len2);
        $inner0 = $rows[$i]['i0001_cmb_source'];
        $inner1 = $rows[$i]['i0001_tabela'].".".$rows[$i]['i0001_tabela']."_".$cp_fk2;
        $inner2 = $rows[$i]['i0001_cmb_source'].".".$rows[$i]['i0001_cmb_source']."_codigo";
        $inner = "inner join ".$inner0." on (".$inner1." = ".$inner2.") ";
        $col[$c]["inner"] = $inner;
      }
      $c++;
    }
  }
  return $col;
}


function get_fields($md){
  $fields = array();
  $sql = "
  select
    i0001_codigo,
    i0001_ctr_new,
    i0001_ctr_list,
    i0001_campo,
    i0001_tipo,
    i0001_formato,
    i0001_cmb_descri,
    i0001_tabela,
    i0001_url,
    i0001_url_md,
    i0001_url_op,
    i0001_label,
    i0001_black,
    i0001_url_painel,
    i0001_cls

  from ".idados_prefix(true)."i0001 where i0001_modulo = ".$md."  and i0001_ativo = 'S' order by i0001_ordem
  ";
  $tb = db_exe($sql,'rows');
    // echo '<pre>';
    // print_r($tb);
    // echo $sql;
    // die('get_fields');

  $rows = $tb['rows'];
  $c = 0;
  for ($i=0;$i<$tb['r'];$i++){
    $vai = select_vai($rows[$i]['i0001_ctr_list'],'list');
    if($vai){
      $fields[$c]['name'] = $tb['rows'][$i]['i0001_campo'];
      $fields[$c]['type'] = $tb['rows'][$i]['i0001_tipo'];
      $fields[$c]['ctr_new'] = $tb['rows'][$i]['i0001_ctr_new'];

      $fields[$c]['url_painel'] = $tb['rows'][$i]['i0001_url_painel'];





      if($fields[$c]['type']=='date'){
        $fields[$c]['dateFormat'] = 'Y-m-d';
      }
      $fields[$c]['formato']  = $tb['rows'][$i]['i0001_formato'];
      if($rows[$i]['i0001_ctr_list']=='combobox'){
        $fields[$c]['type'] = 'string';
        $fields[$c]["name"] = $rows[$i]['i0001_cmb_descri'];
        $fields[$c]["filter"]['type']='string';
        $len2 = strlen($rows[$i]['i0001_tabela']);$len2++;
        $cp_fk2 = substr($rows[$i]['i0001_campo'],$len2);
      }
      $fields[$c]["url"]      = $rows[$i]['i0001_url'];
      $fields[$c]["url_md"]   = $rows[$i]['i0001_url_md'];
      $fields[$c]["url_op"]   = $rows[$i]['i0001_url_op'];
      $fields[$c]["cls"]   = $rows[$i]['i0001_cls'];
      $fields[$c]["tipo"]   = $rows[$i]['i0001_tipo'];
      $fields[$c]["label"]   = $rows[$i]['i0001_label'];
      $fields[$c]["black"]   = $rows[$i]['i0001_black'];
      $fields[$c]["url_vai"]    = false;
      if($fields[$c]['url_md']){
        if($fields[$c]['url_op']){
          $fields[$c]["type"]     = 'string';
          $url_op = $fields[$c]['url_op'];
          $url_access = get_access($fields[$c]['url_md']);
          $url_access_op = isset($url_access[$url_op]) ? $url_access[$url_op] : false;
          if($url_access_op) $url_vai = $fields[$c]["url_vai"] = true;
        }
      }
      $c++;
    }
  }
  return $fields;
}

function converte_iso_to_utf8( $strContent ){return mb_convert_encoding( $strContent, 'UTF-8', mb_detect_encoding( $strContent, 'UTF-8, ISO-8859-1', true ) );}
function Win1252ToUtf8($string){return  iconv("windows-1252","UTF-8",$string);}
function utf8ToWin1252($string){return  iconv("UTF-8","ASCII//TRANSLIT",$string);}
function get_logado(){$logado = false;if(isset($_SESSION["logado"])){if($_SESSION["logado"]) $logado = true;};return $logado;}
function get_membro_name(){if(isset($_SESSION["membro_name"])) return $_SESSION["membro_name"];return '';}
function get_grupo_name(){if(isset($_SESSION["grupo_name"])) return $_SESSION["grupo_name"];return '';}
function select_vai($ct,$op){
  if($op=="list"){
    if($ct=='combobox')   return true;
    if($ct=='label')    return true;
    if($ct=='label_user')   return true;
    if($ct=='hidden')   return true;
    return false;
  }
  if($op=="view"){
    if($ct=='label')    return true;
    if($ct=='hidden')   return true;
    return false;
  }
  if($op=="novo"){
    if($ct=='textfield')  return true;
    if($ct=='numberfield')  return true;
    if($ct=='datefield')  return true;
    if($ct=='combobox')   return true;
    if($ct=='textarea')   return true;
    if($ct=='htmleditor')   return true;
    if($ct=='ckeditor')   return true;
    if($ct=='radio')    return true;
    if($ct=='multcheckbox') return true;
    if($ct=='checkbox')   return true;
    if($ct=='checkbox')   return true;
    if($ct=='hidden')     return true;
    return false;
  }
  if($op=="edit"){
    // if($ct=='Label')     return true;
    if($ct=='textfield')  return true;
    if($ct=='numberfield')  return true;
    if($ct=='datefield')  return true;
    if($ct=='combobox')   return true;
    if($ct=='textarea')   return true;
    if($ct=='checkbox')   return true;
    return false;
  }
  if($op=="editu"){
    if($ct=='textfield')  return true;
    if($ct=='numberfield')  return true;
    if($ct=='datefield')  return true;
    if($ct=='combobox')   return true;
    if($ct=='textarea')   return true;
    if($ct=='checkbox')   return true;
    if($ct=='htmleditor')   return true;
    if($ct=='ckeditor')   return true;
    return false;
  }
  return false;
}
function date_fb_br($data_fb){
  if($data_fb){
    if(is_array($data_fb)){
      $ano = $data_fb[1];
      $mes = $data_fb[2];
      $dia = $data_fb[3];
    }else{
      list($ano,$mes,$dia) = explode("-", $data_fb);
    }
    return $dia."/".$mes."/".$ano;
  }else{
    return 'null';
  }
}
function moeda_br($valor){
  if(!$valor) $valor = 0;
  return number_format($valor, 2, ',', '.');
  return $valor;
}


