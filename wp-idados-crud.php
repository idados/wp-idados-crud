<?php
/*
Plugin Name: wp-idados-crud
Plugin URI: http://idados.com.br/plugin/wp-idados-crud
Description: Base necessária para fazer os módulos idados-xxxx funcionarem corretamente.
Version: 0.0.1
Author: naldovieira
Author URI: http://idados.com.br
License: GPL2
Charge log: start
*/

if ( ! defined( 'ABSPATH' ) ) { exit; }

define('IDADOS_ENGINE', 'v0.0.1');
define('IDADOS_ENGINE_PATH', plugin_dir_path( __FILE__ ));

// add_filter('widget_text', 'do_shortcode');

function idados_i0001_ativar() {
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
  global $wpdb;
  global $charset_collate;
  $sql = "
  CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."i0001` (
  `i0001_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `i0001_modulo` int(11) DEFAULT NULL,
  `i0001_grupo` int(11) DEFAULT NULL,
  `i0001_origem` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_tabela` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_campo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_label` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_hidelabel` int(11) DEFAULT NULL,
  `i0001_show` int(11) DEFAULT '1',
  `i0001_ordem` int(11) DEFAULT NULL,
  `i0001_ctr_new` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_edit` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_view` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_list` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_loc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_lst` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctr_vitrine` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_dm` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_tipo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_height` int(11) DEFAULT NULL,
  `i0001_largura` int(11) DEFAULT NULL,
  `i0001_altura` int(11) DEFAULT NULL,
  `i0001_tamanho` int(11) DEFAULT NULL,
  `i0001_align` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_hidden` int(11) DEFAULT NULL,
  `i0001_black` int(11) DEFAULT NULL,
  `i0001_cls` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_style` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cls_cp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cls_view` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cls_vitrine` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_clslabel` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ctcls` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_itemcls` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_formato` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_renderer` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cmb_tp` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cmb_source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cmb_codigo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cmb_descri` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_access_pub` int(11) DEFAULT '0',
  `i0001_access_usr` int(11) DEFAULT '0',
  `i0001_access_adm` int(11) DEFAULT '0',
  `i0001_access_root` int(11) DEFAULT '0',
  `i0001_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_url_md` int(11) DEFAULT NULL,
  `i0001_url_op` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_param` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_modo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_cp_url` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_ativo` varchar(1) COLLATE utf8_unicode_ci DEFAULT 's',
  `i0001_qtd_gr` int(11) DEFAULT '0',
  `i0001_somar` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_qtd_submnu` int(11) DEFAULT '0',
  `i0001_cols` int(11) DEFAULT NULL,
  `i0001_rows` int(11) DEFAULT NULL,
  `i0001_fieldcls` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0001_url_painel` text COLLATE utf8_unicode_ci,
  `i0001_xtype` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `i0001_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `i0001_size` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`i0001_codigo`),
  UNIQUE KEY `i0001_codigo` (`i0001_codigo`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;
  ";
  dbDelta( $sql );

  //0002 - ini
  $sql = "
  CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."i0002` (
  `i0002_codigo` int(11) NOT NULL AUTO_INCREMENT,
  `i0002_i0002` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_i00021` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_titulo` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_chamada` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_painel` text COLLATE utf8_unicode_ci,
  `i0002_url_md` int(11) DEFAULT NULL,
  `i0002_url_access` int(11) DEFAULT NULL,
  `i0002_param` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_introd` text COLLATE utf8_unicode_ci,
  `i0002_conteudo` text COLLATE utf8_unicode_ci,
  `i0002_sysmenu` int(11) DEFAULT NULL,
  `i0002_ordem` int(11) DEFAULT NULL,
  `i0002_descricao` text COLLATE utf8_unicode_ci,
  `i0002_set_visivel` int(11) DEFAULT NULL,
  `i0002_restrito` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_tabela` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_open_default` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_padrao` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_access_pub` int(11) DEFAULT NULL,
  `i0002_access_usr` int(11) DEFAULT '0',
  `i0002_access_ger` int(11) DEFAULT '0',
  `i0002_access_adm` int(11) DEFAULT '0',
  `i0002_access_root` int(11) DEFAULT '6',
  `i0002_filtrar_empresa` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_filtrar_usuario` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_filtrar_filial` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_md_list` int(11) DEFAULT NULL,
  `i0002_md_new` int(11) DEFAULT NULL,
  `i0002_md_edit` int(11) DEFAULT NULL,
  `i0002_md_delete` int(11) DEFAULT NULL,
  `i0002_md_view` int(11) DEFAULT NULL,
  `i0002_open_cod` int(11) DEFAULT NULL,
  `i0002_cls` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_duplicado` varchar(1) COLLATE utf8_unicode_ci DEFAULT 'N',
  `i0002_sql_sort` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_sql_limit` int(11) DEFAULT NULL,
  `i0002_sql_dir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_de_sistema` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_ativo` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_show_title` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_show_tbar` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_html` text COLLATE utf8_unicode_ci,
  `i0002_width` int(11) DEFAULT NULL,
  `i0002_height` int(11) DEFAULT NULL,
  `i0002_renderto` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_dir` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_open` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_mdaccessini` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_open_js` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_botoes_padroes` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_reader` text COLLATE utf8_unicode_ci,
  `i0002_footer` text COLLATE utf8_unicode_ci,
  `i0002_show_context` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_show_pagin` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_show_sum` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_show_col_title` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `i0002_conexao` int(11) DEFAULT NULL,
  `i0002_user` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `i0002_grupo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `i0002_retirar_acentos` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `i0002_caixa_alta` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `i0002_grupalizar` int(11) DEFAULT '0',
  `i0002_show_cp_option` int(11) NOT NULL DEFAULT '0',
  `i0002_show_tcp_option` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`i0002_codigo`),
  UNIQUE KEY `i0002_codigo` (`i0002_codigo`)
  ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci ;
  ";
  dbDelta( $sql );

  $sql = "
  INSERT INTO `".$wpdb->prefix."i0002` (
  `i0002_codigo`, `i0002_i0002`, `i0002_tabela`, `i0002_sql_sort`, `i0002_sql_limit`, `i0002_sql_dir`, `i0002_ativo`, `i0002_retirar_acentos`, `i0002_caixa_alta`, `i0002_grupalizar`, `i0002_show_cp_option`, `i0002_show_tcp_option`
  ) VALUES (
  1, 'CAMPOS', 'i0001', 'i0001_codigo', 100, 'asc', '', '', '', 0, 0, 0
  );
  ";
  $wpdb->query($sql);

  $sql = "
  INSERT INTO `".$wpdb->prefix."i0002` (
  `i0002_codigo`, `i0002_i0002`, `i0002_tabela`, `i0002_sql_sort`, `i0002_sql_limit`, `i0002_sql_dir`, `i0002_ativo`, `i0002_retirar_acentos`, `i0002_caixa_alta`, `i0002_grupalizar`, `i0002_show_cp_option`, `i0002_show_tcp_option`
  ) VALUES (
  2, 'MODULOS', 'i0002', 'i0002_codigo', 10, 'desc', '', '', '', 0, 0, 0
  );
  ";
  $wpdb->query($sql);


  $sql = "
  delete from ".$wpdb->prefix."i0001 where i0001_modulo = 0001;
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 0, 'textfield', 'i0001_codigo', 'codigo', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 1, 'textfield', 'i0001_modulo', 'modulo', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 2, 'textfield', 'i0001_grupo', 'grupo', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 3, 'textfield', 'i0001_origem', 'origem', 's', 20, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 4, 'textfield', 'i0001_tabela', 'tabela', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 5, 'textfield', 'i0001_campo', 'campo', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 6, 'textfield', 'i0001_value', 'value', 's', 255, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 7, 'textfield', 'i0001_label', 'label', 's', 20, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 8, 'textfield', 'i0001_hidelabel', 'hidelabel', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 9, 'textfield', 'i0001_show', 'show', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 10, 'textfield', 'i0001_ordem', 'ordem', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 11, 'textfield', 'i0001_ctr_new', 'ctr new', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 12, 'textfield', 'i0001_ctr_edit', 'ctr edit', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 13, 'textfield', 'i0001_ctr_view', 'ctr view', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 14, 'textfield', 'i0001_ctr_list', 'ctr list', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 15, 'textfield', 'i0001_ctr_loc', 'ctr loc', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 16, 'textfield', 'i0001_ctr_lst', 'ctr lst', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 17, 'textfield', 'i0001_ctr_vitrine', 'ctr vitrine', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 18, 'textfield', 'i0001_dm', 'dm', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 19, 'textfield', 'i0001_tipo', 'tipo', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 20, 'textfield', 'i0001_height', 'height', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 21, 'textfield', 'i0001_largura', 'largura', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 22, 'textfield', 'i0001_altura', 'altura', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 23, 'textfield', 'i0001_tamanho', 'tamanho', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 24, 'textfield', 'i0001_align', 'align', 's', 20, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 25, 'textfield', 'i0001_hidden', 'hidden', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 26, 'textfield', 'i0001_black', 'black', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 27, 'textfield', 'i0001_cls', 'cls', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 28, 'textfield', 'i0001_style', 'style', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 29, 'textfield', 'i0001_cls_cp', 'cls cp', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 30, 'textfield', 'i0001_cls_view', 'cls view', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 31, 'textfield', 'i0001_cls_vitrine', 'cls vitrine', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 32, 'textfield', 'i0001_clslabel', 'clslabel', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 33, 'textfield', 'i0001_ctcls', 'ctcls', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 34, 'textfield', 'i0001_itemcls', 'itemcls', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 35, 'textfield', 'i0001_formato', 'formato', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 36, 'textfield', 'i0001_renderer', 'renderer', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 37, 'textfield', 'i0001_cmb_tp', 'cmb tp', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 38, 'textfield', 'i0001_cmb_source', 'cmb source', 's', 255, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 39, 'textfield', 'i0001_cmb_codigo', 'cmb codigo', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 40, 'textfield', 'i0001_cmb_descri', 'cmb descri', 's', 100, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 41, 'textfield', 'i0001_access_pub', 'access pub', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 42, 'textfield', 'i0001_access_usr', 'access usr', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 43, 'textfield', 'i0001_access_adm', 'access adm', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 44, 'textfield', 'i0001_access_root', 'access root', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 45, 'textfield', 'i0001_url', 'url', 's', 255, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 46, 'textfield', 'i0001_url_md', 'url md', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 47, 'textfield', 'i0001_url_op', 'url op', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 48, 'textfield', 'i0001_param', 'param', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 49, 'textfield', 'i0001_modo', 'modo', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 50, 'textfield', 'i0001_cp_url', 'cp url', 's', 20, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 51, 'textfield', 'i0001_ativo', 'ativo', 's', 1, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 52, 'textfield', 'i0001_qtd_gr', 'qtd gr', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 53, 'textfield', 'i0001_somar', 'somar', 's', 1, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 54, 'textfield', 'i0001_qtd_submnu', 'qtd submnu', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 55, 'textfield', 'i0001_cols', 'cols', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0001, 56, 'textfield', 'i0001_rows', 'rows', 's', 10, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 57, 'textfield', 'i0001_fieldcls', 'fieldcls', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 58, 'textfield', 'i0001_url_painel', 'url painel', 's', 1000, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 59, 'textfield', 'i0001_xtype', 'xtype', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 60, 'textfield', 'i0001_type', 'type', 's', 50, 1, 'i0001');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0001, 61, 'textfield', 'i0001_size', 'size', 's', 50, 1, 'i0001');
  ";
  $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
  $mysqli->multi_query($sql);
  $sql = "

  delete from ".$wpdb->prefix."i0001 where i0001_modulo = 0002;
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 0, 'textfield', 'i0002_codigo', 'codigo', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 1, 'textfield', 'i0002_i0002', 'i0002', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 2, 'textfield', 'i0002_i00021', 'i00021', 's', 100, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 3, 'textfield', 'i0002_titulo', 'titulo', 's', 100, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 4, 'textfield', 'i0002_chamada', 'chamada', 's', 20, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 5, 'textfield', 'i0002_url', 'url', 's', 100, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 6, 'textfield', 'i0002_painel', 'painel', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 7, 'textfield', 'i0002_url_md', 'url md', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 8, 'textfield', 'i0002_url_access', 'url access', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 9, 'textfield', 'i0002_param', 'param', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 10, 'textfield', 'i0002_introd', 'introd', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 11, 'textfield', 'i0002_conteudo', 'conteudo', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 12, 'textfield', 'i0002_sysmenu', 'sysmenu', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 13, 'textfield', 'i0002_ordem', 'ordem', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 14, 'textfield', 'i0002_descricao', 'descricao', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 15, 'textfield', 'i0002_set_visivel', 'set visivel', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 16, 'textfield', 'i0002_restrito', 'restrito', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 17, 'textfield', 'i0002_tabela', 'tabela', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 18, 'textfield', 'i0002_open_default', 'open default', 's', 20, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 19, 'textfield', 'i0002_padrao', 'padrao', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 20, 'textfield', 'i0002_access_pub', 'access pub', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 21, 'textfield', 'i0002_access_usr', 'access usr', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 22, 'textfield', 'i0002_access_ger', 'access ger', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 23, 'textfield', 'i0002_access_adm', 'access adm', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 24, 'textfield', 'i0002_access_root', 'access root', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 25, 'textfield', 'i0002_filtrar_empresa', 'filtrar empresa', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 26, 'textfield', 'i0002_filtrar_usuario', 'filtrar usuario', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 27, 'textfield', 'i0002_filtrar_filial', 'filtrar filial', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 28, 'textfield', 'i0002_md_list', 'md list', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 29, 'textfield', 'i0002_md_new', 'md new', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 30, 'textfield', 'i0002_md_edit', 'md edit', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 31, 'textfield', 'i0002_md_delete', 'md delete', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 32, 'textfield', 'i0002_md_view', 'md view', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 33, 'textfield', 'i0002_open_cod', 'open cod', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 34, 'textfield', 'i0002_cls', 'cls', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 35, 'textfield', 'i0002_duplicado', 'duplicado', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 36, 'textfield', 'i0002_sql_sort', 'sql sort', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 37, 'textfield', 'i0002_sql_limit', 'sql limit', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 38, 'textfield', 'i0002_sql_dir', 'sql dir', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 39, 'textfield', 'i0002_de_sistema', 'de sistema', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 40, 'textfield', 'i0002_ativo', 'ativo', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 41, 'textfield', 'i0002_show_title', 'show title', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 42, 'textfield', 'i0002_show_tbar', 'show tbar', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 43, 'textfield', 'i0002_html', 'html', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 44, 'textfield', 'i0002_width', 'width', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 45, 'textfield', 'i0002_height', 'height', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 46, 'textfield', 'i0002_renderto', 'renderto', 's', 20, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 47, 'textfield', 'i0002_dir', 'dir', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 48, 'textfield', 'i0002_open', 'open', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 49, 'textfield', 'i0002_mdaccessini', 'mdaccessini', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 50, 'textfield', 'i0002_open_js', 'open js', 's', 100, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 51, 'textfield', 'i0002_botoes_padroes', 'botoes padroes', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 52, 'textfield', 'i0002_reader', 'reader', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('blob', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 53, 'textfield', 'i0002_footer', 'footer', 's', 1000, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 54, 'textfield', 'i0002_show_context', 'show context', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 55, 'textfield', 'i0002_show_pagin', 'show pagin', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 56, 'textfield', 'i0002_show_sum', 'show sum', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 57, 'textfield', 'i0002_show_col_title', 'show col title', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 58, 'textfield', 'i0002_conexao', 'conexao', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 59, 'textfield', 'i0002_user', 'user', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 60, 'textfield', 'i0002_grupo', 'grupo', 's', 50, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 61, 'textfield', 'i0002_retirar_acentos', 'retirar acentos', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('string', 'textfield', 'textfield', 'textfield', 'textfield', 'label', 'label', 0002, 62, 'textfield', 'i0002_caixa_alta', 'caixa alta', 's', 1, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 63, 'textfield', 'i0002_grupalizar', 'grupalizar', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 64, 'textfield', 'i0002_show_cp_option', 'show cp option', 's', 10, 1, 'i0002');
  insert into ".$wpdb->prefix."i0001 (i0001_tipo, i0001_ctr_new, i0001_ctr_edit, i0001_ctr_loc, i0001_ctr_lst, i0001_ctr_view, i0001_ctr_list, i0001_modulo, i0001_ordem, i0001_xtype, i0001_campo, i0001_label, i0001_ativo, i0001_size, i0001_black, i0001_tabela) values ('int', 'numberfield', 'numberfield', 'numberfield', 'numberfield', 'label', 'label', 0002, 65, 'textfield', 'i0002_show_tcp_option', 'show tcp option', 's', 10, 1, 'i0002');
  ";
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    $mysqli->multi_query($sql);
//0002 - end


}
register_activation_hook( __FILE__, 'idados_i0001_ativar' );


function idados_i0001_desativar() {
  //estah agora no unistall
  global $wpdb;
  $wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0001");
  $wpdb->query( "DROP TABLE IF EXISTS ".$wpdb->prefix."i0002");
}
register_deactivation_hook( __FILE__, "idados_i0001_desativar" );

function idados_prefix($de_sistema=false){
  return $GLOBALS["wpdb"]->prefix;
}

function idados_recent($atts, $content = null){
  global $wpdb;

  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "target" => "",
    "md" => "0",
    "on_op" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{

    }
    if(!$get_url_if_op)  return '';
    if($get_url_if_op<>$on_op) return '';
  }

  $modulo_conf  = get_modulo_conf($md);

  $tabela_name = $wpdb->prefix.$modulo_conf['tabela'];
  $tabela_campo = $modulo_conf['tabela'];
  $campo_codigo  = $tabela_campo."_codigo";
  $sql = "select $campo_codigo from $tabela_name order by $campo_codigo desc limit 0, 1";
  $tb = db_exe($sql,'rows');
  if(!$tb['r']) exit;

  if (!$target) {
    return 'target';
  }
  
  if($tb['r']){
    $cod = $tb['rows'][0][$campo_codigo];
    $target = preg_replace("/__cod__/", $cod , $target);
    echo '<script type="text/javascript">';
    echo  'window.location.href = "'.$target.'"';
    echo '</script>';
    exit;
  }

}
add_shortcode("idados_recent", "idados_recent");

function idados_detalhe($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
  ), $atts));

  $df['md'] =$md;
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $cod = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $cod);
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $ret ="";
  if(!$md) {$ret = "idados view - md não especificado";}
  if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}
  $view = get_md_view($md,$cod);

  $ret = "";
  $ret .= '';
  $ret .= ' <dl class="dl-horizontal">';
  for ($i=0; $i < count($view['campo']); $i++) {
    $ret .= '<dt>'.$view['campo'][$i]['fieldLabel'].'</dt><dd>'.$view['campo'][$i]['value'].'</dd>';
  }
  $ret .= ' </dl>';

  return $ret;
}
add_shortcode("idados_detalhe", "idados_detalhe");


function idados_view($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "cnn" => '',
    "md" => '0',
    "cod" => '0',
    "style" => '',
    "un_show" => '',
    "access" => '',
    "on_op" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{

    }
    if(!$get_url_if_op)  return '';
    if($get_url_if_op<>$on_op) return '';
  }

  if($access){if(!idados_is_access($access)) return '';}

  $df['md'] =$md;
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $cod = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $cod);
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);
  $cod = preg_replace("/__pessoa_by_user__/", get_user_meta( get_current_user_id(), "pessoa_by_user", true ) , $cod);
  
  $ret ="";
  if(!$md) {$ret = "idados view - md não especificado";}
  if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}
  $view = get_md_view($md,$cod,$cnn);

  $ret = "";
  $ret .= '';
  $ret .= ' <form class="form-horizontal" action="" method="POST" style="'.$style.'">';
  for ($i=0; $i < count($view['campo']); $i++) {
    if(($un_show) && (preg_match("/".$view['campo'][$i]['name']."/i", $un_show))){

    } else{

      $ret .= ' <div class="form-group pd0" style="margin-bottom:2px;padding-right:10px;" >';
      $ret .= '   <label class="col-sm-3 control-label" style="font-style: italic;font-size: 12px;padding-right: 15px;">'.$view['campo'][$i]['fieldLabel'].': </label>';
      $ret .= '   <div class="col-sm-9 bgw_ colorb_" style="min-height:30px;font-weight: bolder;">';
      // $ret .= '     <p class="form-control-static" style="font-size: 14px;">'.$view['campo'][$i]['value'].'</p>';
      $ret .= '     '.$view['campo'][$i]['value'].' ';

  
      $ret .= '   </div>';
      $ret .= ' </div>';
    }
  }
  $ret .= ' </form>';

  return $ret;
}
add_shortcode("idados_view", "idados_view");

function idados_det($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
  ), $atts));

  $df['md'] =$md;
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $cod = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $cod);
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $ret = '';
  if(!$md) {$ret = "idados det - md não especificado";}
  if(!$cod) {$ret = "idados det - cod não especificado";}
  if($ret) {return $ret;exit;}
  $view = get_md_view($md,$cod);

  $ret = "";
  $ret .= '';
  $ret .= ' <form class="form-horizontal" action="" method="POST">';
  for ($i=0; $i < count($view['campo']); $i++) {
    $ret .= ' <div class="form-group">';
    // $ret .= '    <div class="italico f8 ">'.$view['campo'][$i]['fieldLabel'].'</div>';
    // $ret .= '   <label for="exampleInputEmail1">Email address</label></div>';
    $ret .= '   <div class="gray"><em>'.$view['campo'][$i]['fieldLabel'].'</em></div>';

    // $ret .= '    <div>';
    // $ret .= '      <p>'.$view['campo'][$i]['value'].'</p>';
    // $ret .= '    </div>';
    // $ret .= '    <div class="clear h10"></div>';
    // $ret .= '    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">';
    $ret .= '    <p class="lead text-uppercase"><strong>'.$view['campo'][$i]['value'].'</strong></p>';



    $ret .= ' </div>';
  }
  $ret .= ' </form>';

  return $ret;
}
add_shortcode("idados_det", "idados_det");

function idados_paginacao($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0'
  ), $atts));

  if(!$md) {echo "paginação - $md nao especificado";exit;}

  $total = isset($_SESSION['md'.$md.'_total']) ? $_SESSION['md'.$md.'_total'] : 0;

  $start = isset($_GET['start']) ? $_GET['start'] : 0;
  $limit = isset($_GET['limit']) ? $_GET['limit'] : 20;

  $start_preview  = $start - $limit;
  $start_next   = $start + $limit;

  if($start_preview < 0 ) $start_preview = 0;
  if($start_next > $total ) $start_next = $start_next;

  $paginas = ceil($total / $limit);
  $pagina = 1;
  if(($start+1) > $limit){
    $pagina = ceil(($start+1) / $limit) ;
  }

  $tt = $start+$limit;
  $pagina_last = $paginas * $limit;

  $limit_end = $start + $limit;
  if($limit_end > $total) $limit_end = $total;

//----ini



  $cls = "";
  $csl_last = "";
  $csl_preview = "";


  if (($pagina_last+$limit) > $total) {
    $tt = $total;

    if(($start+$limit) >= $total) {
      $csl = "disabled";
      $csl_last = "disabled";
    }
    if(!$start){
      $csl_preview = "disabled";
    }
  }
  //----end


  $qs = $_SERVER["QUERY_STRING"];


  $ret = '';
  // $ret .= '<h4>Paginação</h4>';
  // $ret .= '<div></div>';
  $ret .= '<div class="pd10">';
  $ret .= '  <a class="btn btn-primary fleft '.$csl_preview.'" href="?start=0&limit='.$limit.'>"><span class="glyphicon glyphicon-fast-backward"></span></a>';
  $ret .= '  <a class="btn btn-primary fleft '.$csl_preview.'" href="?start='.$start_preview.'&limit='.$limit.'"><span class="glyphicon glyphicon-backward"></span></a>';
  $ret .= '  <a class="btn btn-primary fleft '.$csl_last.'" href="?start='.$start_next.'&limit='.$limit.'"><span class="glyphicon glyphicon-forward"></span></a>';
  $ret .= '  <a class="btn btn-primary fleft '.$csl_last.'" href="?start='.$pagina_last.'&limit='.$limit.'"><span class="glyphicon glyphicon-fast-forward"></span></a>';
  $ret .= '  <div class="w20 h30 fleft">  </div>';
  $ret .= '  <a class="btn btn-primary  fleft'.$csl_last.'" href=""><span class=" glyphicon glyphicon-refresh"></span></a>';

  $ret .= '';




  // $ret .= '  <div class="clear"></div>';
  // $ret .= '  <div class="hide_">';
  $ret .= '   <div class="fleft pd10">';
  $ret .= '     Total de registros: '.$total.' ';
  $ret .= '   </div>';

  $ret .= '   <div class="fleft pd10 ">';
  $ret .= '     Páginas : '.$paginas.' ';
  $ret .= '   </div>';
  $ret .= '   <div class="fleft pd10">';
  $ret .= '     Página atual: '.$pagina.' ';
  $ret .= '   </div>';
  $ret .= '   <div class="fleft pd10"> ';
  $ret .= '     Mostrando de: '.$start.' a '.($start + $limit).' ';
  $ret .= '   </div>';
  $ret .= '   <div class="fleft pd10"> ';
  $ret .= '     (registros por páginas: '.$limit.') ';
  $ret .= '   </div>';
  // $ret .= '  </div>';

  $ret .= '</div>';

  return $ret;

/**/

}
add_shortcode("idados_paginacao", "idados_paginacao");




function idados_update($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "cnn" => '',
    "md" => '0',
    "cod" => '0',
    "on_op" => '',
    "target_pos_update" => '?op=view&cod=__cod__'
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
     if(!$get_url_if_op)  return '';
     if($get_url_if_op<>$on_op) return '';

    }
  }

  // if($access){if(!idados_is_access($access)) return '';}
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $target_pos_update = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_pos_update);
  $target_pos_update = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target_pos_update);
  $target_pos_update = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_pos_update);
  if(!$md) {$ret = "idados view - md não especificado";}
  if(!$cod) {$ret = "idados view - cod não especificado";}

  if(isset($_POST['duplique'])) {
    // echo 'duplique';
    if(!md_insert($md, $_REQUEST )) {echo "ERRO AO INSERIR";exit;}
      echo '<script type="text/javascript">';
      echo '    window.location.href = "?" ;';
      echo '</script>';
    exit;
  }


  $ret = md_update($md,$cod,$cnn);
  //return '--';
  if($target_pos_update){


    $ret = "";
    $url = $_SERVER["REDIRECT_URL"];
    //$url.$target_update
    $add_class = "idados";
    if(substr($url,1,6)=='idados') {
      $add_class = "i".$md."update";
      $ret .= '
      <script type="text/javascript">
        // jQuery(function(){
        // alert("'.$url.$target_pos_update.'");
        //   jQuery(".i'.$md.'update").submit(function(e){
        //     e.preventDefault();
        //     url = jQuery(this).attr("action");
        //     alert(url);
        //     jQuery.ajax({
        //       method: "POST",
        //       url: url,
        //       data: jQuery(this).serialize()
        //     })
        //   // // alert(jQuery(this).serialize());
        //     // .done(function( html ) {
        //     //   // jQuery( "#aba_ctu" ).append( html );
        //     //   jQuery( "#aba_ctu div" ).remove();
        //     //   jQuery( "#aba_ctu" ).html("ok");
        //     // });
        //     return false;
        //   })
        // });
      </script>

      ';
    }else{
      echo '<script type="text/javascript">';
      echo '    window.location.href = "'.html_entity_decode($url.$target_pos_update).'";';
      echo '</script>';
    }
  }

  return '';
}
add_shortcode("idados_update", "idados_update");

function idados_nnew($atts, $content = null) {
  //if ( !is_user_logged_in() ) return "";
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
    "restrito" => 's',
    "target_insert" => '?op=insert&pai=__pai__',
    "label_submit" => 'Salvar',
    "title" => '',
    "access" => '',
    "on_op" => '',
    "un_show" => '',
    "class" => '',
    "access_manager" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
      if(!$get_url_if_op)  return '';
      if($get_url_if_op<>$on_op) return '';
    }
  }


  // if($access){
  //   $ret = '';
  //   if(is_super_admin()) {
  //     $ret = 'true';
  //   } else {
  //     $ret = get_user_meta( get_current_user_id(), $access, true );
  //   }
  //   if(!$ret) return '';
  // }

  // if($access){if(!idados_is_access($access)) return '';}
  if($access){if(!idados_is_access($access)) return '';}


  $df['md'] =$md;
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  // $cod = preg_replace("/__cod__/", $cod , $cod);
  $target_insert = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target_insert);
  $target_insert = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_insert);
  $target_insert = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_insert);

  $ret = '';
  if(!$md) {$ret = "idados nnew - md não especificado";}
  // if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}

  // $nnew = get_md_edit($md,$cod);
  $nnew = get_md_novo($md);


  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  // if(substr($url,1,6)=='idados') {
  //   $add_class = "idados_form_ajax";
  //   $ret .= '
  //   <script type="text/javascript">
  //     jQuery(function(){
  //       //jQuery(".idados_form_ajax").submit(e){
  //       jQuery(".idados_form_ajax").submit(function(e){
  //         // alert(jQuery(this).attr("action"));
  //         jQuery.ajax({
  //           method: "POST",
  //           url: jQuery(this).attr("action"),
  //           data: jQuery(this).serialize()
  //         })
  //         .done(function( html ) {
  //           // jQuery( "#aba_ctu" ).append( html );
  //           jQuery( "#aba_ctu div" ).remove();
  //           jQuery( "#aba_ctu" ).html("ok");

  //         });
  //         return false;
  //       })
  //     });
  //   </script>
  //   ';
  // };


  $ret .= '
  <div class="'.$class.'">
  '.$title.'
  <form class="form-horizontal '.$add_class.' " action="'.$url.$target_insert.'" method="POST">';


  $ret .= '   <div class="clear:both;"></div>';
  for ($i=0; $i < count($nnew['campo']); $i++) {
    $campo = $nnew['campo'][$i]['name'];
    $value = isset($_REQUEST[$campo]) ? $_REQUEST[$campo] : '';
    if(($un_show) && (preg_match("/".$campo."/i", $un_show))){

    }else{
      
    

    $ret .= ' <div class="form-group" style="margin:0px;padding:0px;" >';
    // $ret .= '   <label class="span3 col-sm-3 col-md-3 control-label ">'.$nnew['campo'][$i]['fieldLabel'].'</label>';
    $ret .= '   <div class="span3 col-sm-3 col-md-3">'.$nnew['campo'][$i]['fieldLabel'].'</div>';
    $ret .= '   <div class="span9 col-sm-9 col-md-9" style="margin:0px;padding:0px;border: 0px solid gray;">';
    // $ret .= '     <input type="text" style="text-transform:uppercase;margin:0px;padding:0px;height:18px;padding:10px;width:90%;" name="'.$nnew['campo'][$i]['name'].'" id="'.$nnew['campo'][$i]['name'].'" class="form-control" value="'.$value.'" title="" autocomplete="off">';
    $ret .= '     <input type="text" style="" name="'.$nnew['campo'][$i]['name'].'" id="'.$nnew['campo'][$i]['name'].'" class="form-control" value="'.$value.'" title="" autocomplete="off">';
    $ret .= '   </div>';
    $ret .= '   <div class="clear:both;"></div>';
    $ret .= ' </div>';
    }
  }

  $ret .= ' <div style="min-height: 1em;"></div>';

  $ret .= ' <div class="form-group" style="margin:0px;padding:0px;" >';
  $ret .= '   <div class="span3 col-sm-3 col-md-3"></div>';
  $ret .= '   <div class="span9 col-sm-9 col-md-9" style="margin:0px;padding:0px;border: 0px solid gray;">';
  // $ret .= '     <button type="submit" class="btn btn-primary" style="padding: 10px 60px;">'.$label_submit.'</button>';
  $ret .= '   </div>';
  $ret .= ' </div>';
  

  $ret .= ' <div class="form-group" style="margin:0px;padding:0px;" >';
  $ret .= '   <div class="span3 col-sm-3 col-md-3"></div>';
  $ret .= '   <div class="span9 col-sm-9 col-md-9" style="margin:0px;padding:0px;border: 0px solid gray;">';
  $ret .= '     <button type="submit" class="btn btn-primary" style="padding: 10px 60px;">'.$label_submit.'</button>';
  $ret .= '   </div>';
  $ret .= ' </div>';

  $ret .= ' </form></div>';

  return $ret;
}
add_shortcode("idados_nnew", "idados_nnew");

include("assets/idados_functions.php");
include("assets/idados_crud.php");

function idados_ilist($atts, $content = null) {
  //if ( !is_user_logged_in() ) return "";
  // return '';
  extract(shortcode_atts(array(
    "md" => '0',
    "manut" => '0',
    "criterio" => '',
    "criterio2" => '',
    "style" => '',
    "class" => '',
    "on_op" => '',
    "title" => '',
    "access" => '',
    "un_show" => '',
    "config" => '',
    "join" => '',
    "inner" => '',
    "cnn" => '',
    "die_col" => '',
    "col_replace" => '',
    "die_sql" => '' 
  ), $atts));
  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
     if(!$get_url_if_op)  return '';
     if($get_url_if_op<>$on_op) return '';

    }
  }

  $cfg = array();
  // $cfg['un_show'] = $un_show;
  
  //$un_show ='i8200_data, i8200_hora,i8200_nasc_fundacao,i8200_cpf_cnpj, i8200_fj, i8200_sexo, i8200_rg,i8200_segmento, i8200_website, i8200_e_mail, i8200_regiao, i8200_tp_cad, i8200_ref';
  //$join = "inner join sm_i10037 on i8200_codigo=i10037_pessoa";


  $busca = isset($_GET['busca']) ? $_GET['busca'] : '';
  if($busca){
    if(is_numeric($busca)){
      do_shortcode('[idados_buscando]');
      exit;
    }

  }
//idados_buscando
//_busca_

  if($access){
    if(!idados_is_access($access)) return '';
  }

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';

  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{

    }
  //   if(!$get_url_if_op)  return '';
  //   if($get_url_if_op<>$on_op) return '';
  }

  $df['md'] = $md;
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $col  = get_md_col($md,$cnn);

  if($col_replace){
    $resplace = explode(",", $col_replace);
    foreach ($resplace as $keyc => $valuec) {
      $arrray = explode(":", $valuec);
      foreach ($col as $key => $value) {
        if ($value['dataIndex']==$arrray[0]) {
          $col[$key]['dataIndex'] = $arrray[1];
          $col[$key]['filter_type'] = 'string';
        }
      }
    }
    // $arrray = explode(":", $col_replace);
    // foreach ($col as $key => $value) {
      // if ($value['dataIndex']==$arrray[0]) {
        // echo $col[$key] = "--".$value['dataIndex']."--";
        // $col[$key]['dataIndex'] = $arrray[1];
        // $col[$key]['filter_type'] = 'string';
      // }
    // }
  }


  if($die_col){
    echo "<pre>";
    print_r($col);
    echo "<pre>";
    return '';
  }


  if(!count($col)) return '';
  $modulo_conf  = get_modulo_conf($md, $cnn);

  $tabela         = $modulo_conf['tabela'];
  $campo_codigo   = $tabela."_codigo";
  $fields         = get_fields($md, $cnn);

  $df = array();
  $df['join'] = $join;
  $df['die_col'] = $die_col;
  $df['col_replace'] = $col_replace;
  $df['die_sql'] = $die_sql;
  $df['inner'] = $inner;

  $criterio = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $criterio);
  $criterio = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $criterio);
  $criterio = preg_replace("/__prefix__/", idados_prefix(false) , $criterio);
  $criterio = preg_replace("/__pessoa_by_user__/", get_user_meta( get_current_user_id(), "pessoa_by_user", true ) , $criterio);
  //get_user_meta( get_current_user_id(), $access, true )

  //criterio="__prefix__i1052_pessoa=__cod__

  // echo 'criterio: '.$criterio;
  // die();


  $df['criterio'] = base64_encode($criterio);
  $data = get_md_rows($md, $fields, $col, $df, $cnn);
  // echo '<br><br><br><br>---';
  // echo $cnn;
  // die();

  // echo '--<h1>--'.$data['db_host'].'--</h1>--';

  if(isset($data['msg'])){
    if($data['msg']) return $data['msg'];
  }

  $_SESSION['md'.$md.'_total'] = $data['total'];

  $manut = $modulo_conf['show_cp_option'];
  if( $on_op) $manut = false;

  //paginacai -ini

  $ret = "";
  $url = $_SERVER["REDIRECT_URL"].'?';
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "idados_link_ajax";
  };


  $link       = $url.$_SERVER["QUERY_STRING"];

  $start      = isset($_GET['start']) ? $_GET['start'] : 0;//0; //isset($_GET['start']) ? $_GET['start'] : 10//
  // $limit      = $modulo_conf['limit'];//20; //por paginas ou limit
  $limit      = isset($_GET['limit']) ? $_GET['limit'] : $modulo_conf['limit'];//20; //por paginas ou limit
  $total      = $data['total'];//149;//$data['total']
  $supertotal = 0;
  $total2 = $total - $limit;
  // $supertotal = (ceil($total / $limit) * $limit) ;//100; // ceil($total / $limit)
  // die($supertotal);/

  $rfirst     = idados_addparam($link,'start',"0");//0;//idados_removeparam($link, 'start');//
  $rprevious  = idados_addparam($link,'start',($start-$limit < 0 ? 0 : $start-$limit));//0;//idados_addparam($link,'start',10)
  // $rnext      = idados_addparam($link,'start',($start+$limit > $supertotal ? ($supertotal - $limit) : ($start+$limit)));//10;//idados_addparam($link,'start',($start+10));//
  $rnext      = idados_addparam($link,'start',$start+$limit) ;
  // $rlast      = idados_addparam($link,'start',($supertotal - $limit));// $supertotal - $limit;//90;//idados_addparam($link,'start',($supertotal-10))
  $rlast      = idados_addparam($link,'start',($total2));// $supertotal - $limit;//90;//idados_addparam($link,'start',($supertotal-10))

  $limit_10   = idados_addparam($link,'limit',"10");
  $limit_25   = idados_addparam($link,'limit',"25");
  $limit_50   = idados_addparam($link,'limit',"50");
  $limit_100  = idados_addparam($link,'limit',"100");

  $ret = '';

  // $ret .= "<pre><big>";
  // $ret .= "limit: ".$limit."<br>";
  // $ret .= "rnext: ".$rnext."<br>";
  // $ret .= "supertotal: ".$supertotal."<br>";
  // $ret .= "total2: ".$total2."<br>";
  // $ret .= "total: ".$total."<br>";
  // $ret .= "</big></pre>";



  //isset($_GET['start']) ? $_GET['start'] : 0;

  //paginacao - end

  // return '';
  
  $ret .= $title;
  // if($modulo_conf['title'])
  // $ret .= '<h1>'.$modulo_conf['title'].'</h1>';
  // $ret .= '<div id="md'.$md.'ilist" class="pd10 ilist" style="width:100%">';
  //--=-- $ret .= '  '.$title;
  //--=-- $ret .= '  <div class="" style="overflow-y:auto">';
  $ret .= '  <div class="" style="overflow-y:auto">';
  $ret .= '<table style="'.$style.'" class="table table-condensed" >';

  if(($config) && (preg_match("/no_col_title/i", $config))){
  } else{

    $ret .= '<thead>';
    $ret .= '<tr>';
    $ret .= '<th style="border:1px solid;"></th>';
    for ($i=0; $i < count($col); $i++){
      if($col[$i]['ctr_list'] == 'label'){
        //if ($col[$i]['dataIndex']=="i8200_data"){
        if(($un_show) && (preg_match("/".$col[$i]['dataIndex']."/i", $un_show))){
          //if(($un_show) && (preg_match("/i".$campo."/i", $un_show))){
          //$ret .= '<th></th>';
        } else {
          $ret .= '<th style="border:1px solid;">'.$col[$i]['text'].'</th>';
        }
      }
    }
    $ret .= '</tr>';
    $ret .= '</thead>';
  }


  $ret .= '<tbody>';
  for ($i=0; $i < count($data['row']); $i++){
    $ret .= '<tr class="idados_tr">';
    //--=-- $ret .= '<td>';
    // if($manut){
    //   //$ret .= '<button type="button" class="btn btn-default btn-xs glyphicon glyphicon-arrow-right bt_cfg" data-cod="'.$data['row'][$i][$campo_codigo].'" data-md="'.$md.'" title="Editar / Excluir / Adicionar"></button>';
    //   //--=-- $ret .= '<a href="?op=view&cod='.$data['row'][$i][$campo_codigo].'" class="btn btn-default btn-xs">V</a>';
    //   //--=-- $ret .= '<a href="?op=edit&cod='.$data['row'][$i][$campo_codigo].'" class="btn btn-default btn-xs">E</a>';
    //   //--=-- $ret .= '<a href="?op=deletar&cod='.$data['row'][$i][$campo_codigo].'" class="btn btn-default btn-xs">D</a>';
    // }
    $ret .= '<td style="border:1px solid;"></td>';
    for ($c=0; $c < count($col); $c++) {  $campo = $col[$c]['dataIndex'];
      //$ircyt = $col[$c]['dataIndex'];
      //if($ircyt=='i8200_venceu') $ircytv = $col[$c]['dataIndex']
    //i8200_venceu
      
      if($col[$c]['ctr_list'] == 'label'){
        if(($un_show) && (preg_match("/".$campo."/i", $un_show))){
          //$ret .= '<td style="border:1px solid;"></td>';
        }else{
          if(($config) && (preg_match("/no_cel_url/i", $config))){
            $data['row'][$i][$campo] = strip_tags($data['row'][$i][$campo]);//'--=--';
          }
          $ret .= '<td class="irow-sit-" style="border:1px solid;">'.$data['row'][$i][$campo].'</td>';
        }
      }
    }
    $ret .= '</tr>';
  }
  $ret .= '</tbody>';
  $ret .= '</table>';
  // $ret .= '</div>---=---';
  $ret .= '</div>';
  
  // return $ret;
  // return '---';


  //show paginacao - ini
  if(($config) && (preg_match("/no_count_reg/i", $config))){
  } else {
    $ret .= '<div style="text-align:center"> ';
    // $ret .= '<small>'.$total.' registro(s).</small>';
    $ret .= '<big>'.$total.' registro(s).</big>';
    // $ret .= ' '.$total.' registro(s).';
    $ret .= '</div>';
  }
  //show paginacao - end

  // return $ret;
  //show total  - ini
  if(($config) && (preg_match("/no_sum_col/i", $config))){
  } else {
    if($total > $limit){
      $ret .= '<div style="text-align:center"> ';
      $ret .= '<a href="'.$rfirst.'" class="btn btn-link '.$add_class.'">&nbsp;&lt;&lt;&nbsp;</a>';
      $ret .= '<a href="'.$rprevious.'" class="btn btn-link '.$add_class.'">&nbsp;&lt;&nbsp;</a>';
      $ret .= '<small>&nbsp;'.$start.' a '.((($start + $limit) > $total) ? $total : ($start + $limit)).'&nbsp;</small>';
      $ret .= '<a href="'.$rnext.'" class="btn btn-link '.$add_class.'">&nbsp;&gt;&nbsp;</a>';
      $ret .= '<a href="'.$rlast.'" class="btn btn-link '.$add_class.'">&nbsp;&gt;&gt;&nbsp;</a>';
      $ret .= '</div>';
    }
  }
  //show total  - end

  //return $ret;


  if($total > $limit){
    $ret .= '<div style="text-align:center"> ';
    $ret .= 'limite ';
    $ret .= '<a href="'.$limit_10.'" class="btn btn-link '.$add_class.'">&nbsp;10&nbsp;</a>';
    $ret .= '<a href="'.$limit_25.'" class="btn btn-link '.$add_class.'">&nbsp;25&nbsp;</a>';
    $ret .= '<a href="'.$limit_50.'" class="btn btn-link '.$add_class.'">&nbsp;50&nbsp;</a>';
    $ret .= '<a href="'.$limit_100.'" class="btn btn-link '.$add_class.'">&nbsp;100&nbsp;</a>';
    $ret .= ' por pagina ';
    $ret .= '</div>';
  }
  // $ret .= '<small>'.$data['total'].' registro(s). mostrando 10 por pagina. </small>';
  // $ret .= '<div style="text-align:center;"><small>primeira - anterior - proxima - última </small></div>';

  // $ret .= '<small>'.$data['total'].' registro(s). mostrando 10 por pagina. primeira - anterior - proxima - última</small>';

  $ret .= '
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".idados_link_ajax").on("click",function(e){
          var url = jQuery(this).attr("href");
          // alert(url);
          jQuery( "#aba_ctu" ).load(url);
          return false;
        })
      });
    </script>
  ';
  return $ret;
}
add_shortcode("idados_ilist", "idados_ilist");





function idados_ilist_single($atts, $content = null) {
# necessita add na function ára ativar shortcode nos widget add_filter('widget_text', 'do_shortcode');
  //if ( !is_user_logged_in() ) return "";
  //[idados_ilist md="1030"]
  extract(shortcode_atts(array(
    "md" => '0'
  ), $atts));


  // echo '<pre>';
  // print_r($md);
  // echo '</pre>';

  $df['md'] =$md;
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $col      = get_md_col($md);
  $modulo_conf  = get_modulo_conf($md);
  $tabela     = $modulo_conf['tabela'];
  $campo_codigo   = $tabela."_codigo";
  // print_r($col);
  // if($col['msg']) return $col['msg'];

  // return '--';
  $fields = get_fields($md);
  $data = get_md_rows($md, $fields,$col);
  if($data['msg']) return $data['msg'];
  // echo "<pre>";
  // print_r($modulo_conf);
  // echo $campo_codigo;
  // echo "</pre>";

  // die();

  // die($data['total']);
  // print_r($col);
  $_SESSION['md'.$md.'_total'] = $data['total'];
  $ret = '';
  $ret .= '<div id="md'.$md.'ilist" class="pd10" style="width:100%">';
  $ret .= '  <div class="" style="overflow-y:auto">';
  $ret .= '    <table class="table table-condensed" data-total="'.$data['total'].'">';
  $ret .= '    <tbody>';
  for ($i=0; $i < count($data['row']); $i++){
    $ret .= '      <tr class="idados_tr">';
    for ($c=0; $c < count($col); $c++) {  $campo = $col[$c]['dataIndex'];
      $cls = "";
      // if(!$c) $cls = "hide";
      $ret .= '        <td class="'.$cls.'">'.$data['row'][$i][$campo].'</td>';
    }
    $ret .= '      </tr>';
  }
  $ret .= '    </tbody>';
  $ret .= '  </table>';
  $ret .= '</div>';
  return $ret;
}
add_shortcode("idados_ilist_single", "idados_ilist_single");




function idados_edit($atts, $content = null) {
  // return "--=--";
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0',
    "cnn" => '',
    "cod" => '0',
    "target_update" => '?op=update&cod=__cod__',
    "on_op" => '',
    "access" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
      if(!$get_url_if_op)  return '';
      if($get_url_if_op<>$on_op) return '';
    }
  }


  if($access){if(!idados_is_access($access)) return '';}

  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $target_update = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_update);
  $target_update = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target_update);
  $target_update = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_update);
  $ret = '';
  if(!$md) {$ret = "idados view - md não especificado";}
  if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}
  $edit = get_md_edit($md,$cod,$cnn);
  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "i".$md."update";
    $ret .= '
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".i'.$md.'update").submit(function(e){
          e.preventDefault();
          url = jQuery(this).attr("action");
          // alert(url);
          jQuery.ajax({
            method: "POST",
            url: url,
            data: jQuery(this).serialize()
          })

          .done(function( html ) {
            jQuery("#aba_ctu").load("'.$url.'?op=view&cod='.$cod.'");
          });
          return false;
        })
      });
    </script>
    ';
  };

  $ttop = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

  if($ttop=='duplicar'){
    $ret .= '
    <script type="text/javascript">
    jQuery(function(){
      jQuery("#fmdsubmit").css("visibility","hidden");
      jQuery("#fmdsubmit").remove();
      jQuery("#fmdduplique").css("visibility","visible");
      // alert(333);
    });
    </script>
    ';
  }


/*
  for ($i=0; $i < count($nnew['campo']); $i++) {
    $campo = $nnew['campo'][$i]['name'];
    $value = isset($_REQUEST[$campo]) ? $_REQUEST[$campo] : '';
    $ret .= ' <div class="form-group" style="margin:0px;padding:0px;" >';
    $ret .= '   <label class="span3 col-sm-3 col-md-3 control-label ">'.$nnew['campo'][$i]['fieldLabel'].'</label>';
    $ret .= '   <div class="span9 col-sm-9 col-md-9" style="margin:0px;padding:0px;">';
    $ret .= '     <input type="text" style="text-transform:uppercase;margin:0px;padding:0px;height:18px;padding:10px;width:90%;" name="'.$nnew['campo'][$i]['name'].'" id="'.$nnew['campo'][$i]['name'].'" class="form-control" value="'.$value.'" title="" autocomplete="off">';
    $ret .= '   </div>';
    $ret .= ' </div>';

  }

*/


  $ret .= '';
  $ret .= ' <form class="form-horizontal '.$add_class.'" action="'.$url.$target_update.'" method="POST">';
  for ($i=0; $i < count($edit['campo']); $i++) {
    $ret .= ' <div class="form-group pd0" style="margin-bottom:2px;padding-right:10px;" >';
    $ret .= '   <label class="span3 col-sm-3 col-md-3 control-label ">'.$edit['campo'][$i]['fieldLabel'].'</label>';
    $ret .= '   <div class="span9 col-sm-9 col-md-9" style="min-height:30px">';
    // $ret .= '     <input type="text" style="text-transform:uppercase;margin:0px;padding:0px;height:18px;padding:10px;width:90%;" name="'.$edit['campo'][$i]['name'].'" id="'.$edit['campo'][$i]['name'].'" class="form-control" value="'.$edit['campo'][$i]['value'].'" title="" autocomplete="off">';
    $ret .= '     <input type="text" style="" name="'.$edit['campo'][$i]['name'].'" id="'.$edit['campo'][$i]['name'].'" class="form-control" value="'.$edit['campo'][$i]['value'].'" title="" autocomplete="off">';
    $ret .= '   </div>';
    $ret .= '   <div style="clear:both;"></div>';
    $ret .= ' </div>';
  }
  
  $ret .= ' <div style="height:15px;"></div>';

  $ret .= ' <div class="form-group pd0" style="margin-bottom:2px;padding-right:10px;" >';
  // $ret .= '    <div class="col-sm-3">'.$edit['campo'][$i]['fieldLabel'].'</div>';
  $ret .= '   <div class="span3 col-sm-3"> </div>';
  $ret .= '   <div class="span9 col-sm-9">';
  $ret .= '     <button id="fmdsubmit" type="submit" class="btn btn-primary">Atualizar</button> ';
  $ret .= '     <button id="fmdduplique" type="submit" name="duplique" class="btn btn-primary" style="visibility: hidden;">Duplicar</button> ';
  $ret .= '   </div>';
  $ret .= '   <div style="clear:both;"></div>';
  $ret .= ' </div>';
  // $ret .= '  <input type="hidden" name="md" value="'.$md.'" >';
  // $ret .= '  <input type="hidden" name="op" value="edit" >';
  $ret .= ' </form>';

  return $ret;
}
add_shortcode("idados_edit", "idados_edit");




function idados_duplique($atts, $content = null) {
  // return "--=--";
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "cnn" => '',
    "md" => '0',
    "cod" => '0',
    "target_update" => '',
    "target_insert" => '?op=insert',
    "access" => ''
  ), $atts));
  if($access){if(!idados_is_access($access)) return '';}
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);
  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $target_update = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_update);
  $target_update = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target_update);
  $target_update = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_update);

  $target_insert = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_insert);
  $target_insert = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target_insert);
  $target_insert = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_insert);

  $ret = '';
  if(!$md) {$ret = "idados view - md não especificado";}
  if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}
  $edit = get_md_edit($md,$cod,$cnn);
  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "i".$md."update";
    $ret .= '
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".i'.$md.'update").submit(function(e){
          e.preventDefault();
          url = jQuery(this).attr("action");
          // alert(url);
          jQuery.ajax({
            method: "POST",
            url: url,
            data: jQuery(this).serialize()
          })

          .done(function( html ) {
            jQuery("#aba_ctu").load("'.$url.'?op=view&cod='.$cod.'");
          });
          return false;
        })
      });
    </script>
    ';
  };

  $ttop = isset($_REQUEST['op']) ? $_REQUEST['op'] : '';

  if($ttop=='duplicar'){
    $ret .= '
    <script type="text/javascript">
    jQuery(function(){
      jQuery("#fmdsubmit").css("visibility","hidden");
      jQuery("#fmdsubmit").remove();
      jQuery("#fmdduplique").css("visibility","visible");
      // alert(333);
    });
    </script>
    ';
  }





  $ret .= '';
  $ret .= ' <form class="form-horizontal '.$add_class.'" action="'.$url.$target_insert.'" method="POST">';
  for ($i=0; $i < count($edit['campo']); $i++) {
    $ret .= ' <div class="form-group pd0" style="margin-bottom:2px;padding-right:10px;" >';
    $ret .= '   <label class="col-sm-3 control-label italico f12">'.$edit['campo'][$i]['fieldLabel'].'</label>';
    $ret .= '   <div class="col-sm-9 bgw colorb" style="min-height:30px">';
    $ret .= '     <input type="text" style="text-transform:uppercase;" name="'.$edit['campo'][$i]['name'].'" id="'.$edit['campo'][$i]['name'].'" class="form-control" value="'.$edit['campo'][$i]['value'].'" title="" autocomplete="off">';
    $ret .= '   </div>';
    $ret .= ' </div>';

  }
  $ret .= ' <div class="h20" ></div>';
  $ret .= ' <div class="form-group pd0" style="margin-bottom:2px;padding-right:10px;" >';
  // $ret .= '    <div class="col-sm-3">'.$edit['campo'][$i]['fieldLabel'].'</div>';
  $ret .= '   <div class="col-sm-3"></div>';
  //$ret .= '   <button id="fmdsubmit" type="submit" class="btn btn-primary">Atualizar</button> ';
  $ret .= '   <button id="fmdduplique" type="submit" name="duplique" class="btn btn-primary" style="">Duplicar</button> ';

  $ret .= ' </div>';
  // $ret .= '  <input type="hidden" name="md" value="'.$md.'" >';
  // $ret .= '  <input type="hidden" name="op" value="edit" >';
  $ret .= ' </form>';

  return $ret;
}
add_shortcode("idados_duplique", "idados_duplique");


function idados_aba($atts, $content = null) {
  extract(shortcode_atts(array(
    "label" => 'LABEL',
    "md" => '0',
    "op" => 'ilist',
    "cod" => '',
    "on_op" => 'view',
    "criterio" => ''
  ), $atts));

  // $ret = '<hr>';
  // $ret .= $label;
  // $ret .= '<hr>';
  // return $ret;

  $vai = true;
  if($on_op) {
    $vai = false;
    $t_op = isset($_GET['op']) ? $_GET['op'] : 'empty';
    if(($on_op=='empty') && ($t_op=='empty')) $vai = true;
    if(($on_op=='view') && ($t_op=='view')) $vai = true;
    if(($on_op=='edit') && ($t_op=='edit')) $vai = true;
    if(($on_op=='deletar') && ($t_op=='deletar')) $vai = true;
    if(($on_op=='det') && ($t_op=='det')) $vai = true;
  }
  if(!$vai) return '';

  $criterio = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $criterio);
  $criterio = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $criterio);


  $labels = explode(',', $label);
  $abas = count($labels);

  $mds  = explode(',', $md);
  $ops  = explode(',', $op);

  $criterios  = explode(',', $criterio);

  $aba = isset($_GET['aba']) ? $_GET['aba'] : 0;
  $qs     = $_SERVER["QUERY_STRING"];

  $ret  = '';
  $ret .= '<ul class="nav nav-tabs" role="tablist">';
  for ($i=0; $i < $abas; $i++) {
    $ret .= '  <li role="presentation" ><a class="idados_aba" aria-controls="home" role="tab" data-toggle="tab" data-md='.$mds[$i].' href="/idados/'.$mds[$i].'/?'.$criterios[$i].'">'.$labels[$i].'</a></li>';
  }
  $ret .= '</ul>';
  $ret .= '<div id="aba_ctu">--aba--</div>';
  $ret .= '
  <script type="text/javascript">
    jQuery(function(){
      jQuery(".idados_aba").on("click",function(e){
        e.preventDefault();
          jQuery( "#aba_ctu div" ).remove() ;
          jQuery( "#aba_ctu" ).load( jQuery(this).attr("href") );
          // jQuery( "#aba_ctu" ).html( jQuery(this).attr("href") );
      });
    });
  </script>
  ';
  return $ret;

}
add_shortcode("idados_aba", "idados_aba");









function idados_busca($atts, $content = null) {
  extract(shortcode_atts(array(
    "md" => 0,
    "op" => '',
    "cod" => 0,
    "target" => '',
    "target_det" => '',
    "on_op" => '',
    "access" => '',
    "placeholder" => 'BUSCA'
  ), $atts));
  if($access){if(!idados_is_access($access)) return '';}
  $vai = true;
  if($on_op) {
    $vai = false;
    $t_op = isset($_GET['op']) ? $_GET['op'] : 'empty';
    if(($on_op=='empty') && ($t_op=='empty')) $vai = true;
  }
  if(!$vai) return '';

  $busca = isset($_GET['busca']) ? $_GET['busca'] : '';


  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "idados_form_ajax";
    $ret .= '
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".idados_form_ajax").submit(function(e){
          // alert(jQuery(this).attr("action"));
          var busca = jQuery(this).attr("action")+"?"+jQuery(this).serialize();
          // alert(jQuery(this).serialize());
          jQuery( "#aba_ctu" ).load(busca);
          // alert(busca);

          // jQuery.ajax({
          //   method: "GET",
          //   url: jQuery(this).attr("action"),
          //   data: jQuery(this).serialize()
          // })
          // .done(function( html ) {
          //   // jQuery( "#aba_ctu div" ).remove();
          //   // jQuery( "#aba_ctu" ).html("ok");
          //   // jQuery( "#aba_ctu" ).html(html);
          // });
          return false;
        })
      });
    </script>
    ';
  };

  $ret .= '<form action="'.$url.$target.'" method="GET" class="navbar-form '.$add_class.'" role="form">';
  $ret .= '  <input type="text" class="form-control " value="'.$busca.'" name="busca" placeholder="'.$placeholder.'" style="max-width:200px;text-align:center">';
  $ret .= '</form>';
  return $ret;
}
add_shortcode("idados_busca", "idados_busca");


function idados_busca_redir($atts, $content = null) {
  extract(shortcode_atts(array(
    "target_list" => '../listagem/',
    "target_det" => '../view/'
  ), $atts));

  $busca = isset($_GET['busca']) ? $_GET['busca'] : '';
  $target_list = preg_replace("/__site_url__/",site_url() , $target_list);
  $target_det = preg_replace("/__site_url__/",site_url() , $target_det);

  if(is_numeric($busca)){
    echo '<script type="text/javascript">';
    echo '    window.location.href = "'.$target_det.'?cod='.$busca.'";';
    // echo "alert('".$target_det."')";
    echo '</script>';
    exit;
  }else{
    echo '<script type="text/javascript">';
    echo '    window.location.href = "'.$target_list.'?busca='.$busca.'";';
    echo '</script>';
    exit;
  }

}
add_shortcode("idados_busca_redir", "idados_busca_redir");

function idados_busca_redir_v2($atts, $content = null) {
  extract(shortcode_atts(array(
    "target_list" => '../listagem/',
    "target_det" => '../view/'
  ), $atts));

  $busca = isset($_GET['busca']) ? $_GET['busca'] : '';
  $target_list = preg_replace("/__site_url__/",site_url() , $target_list);
  $target_det = preg_replace("/__site_url__/",site_url() , $target_det);

  // $target =
  if(is_numeric($busca)){
    $target = $target_det;
    // echo '<script type="text/javascript">';
    // echo '    window.location.href = "'.$target_det.'?cod='.$busca.'";';
    // echo '</script>';
    // exit;
  }else{
    $target = $target_list;
    // echo '<script type="text/javascript">';
    // echo '    window.location.href = "'.$target_list.'?busca='.$busca.'";';
    // echo '</script>';
    // exit;
  }
  $target = preg_replace("/__busca__/",$busca , $target);
  $target = html_entity_decode($target);
  // echo $target;
  echo '<script type="text/javascript">';
  echo '    window.location.href = "'.$target.'";';
  echo '</script>';
  exit;

}
add_shortcode("idados_busca_redir_v2", "idados_busca_redir_v2");


function idados_buscando($atts, $content = null) {
  //EH UM CLONE DA FUNCAO DE CIMA (idados_busca_redir) PARA MANTER A COMPATIBILIDADE
  extract(shortcode_atts(array(
    // "target_list" => '../listagem/',
    // "target_det" => '../view/'
    "target_list" => './',
    "target_det" => './'

  ), $atts));

  $busca = isset($_GET['busca']) ? $_GET['busca'] : '';

  $target_list = html_entity_decode($target_det);
  $target_det = html_entity_decode($target_det);

  $target_det = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_det);

  if(is_numeric($busca)){
    echo '<script type="text/javascript">';
    // echo '    window.location.href = "'.$target_det.'?cod='.$busca.'";';
    echo '    window.location.href = "'.$target_det.'?op=view&cod='.$busca.'";';
    // echo '    window.location.href = "'.$target_det.'";';
    echo '</script>';
    exit;
  }else{
    echo '<script type="text/javascript">';
    echo '    window.location.href = "'.$target_list.'?busca='.$busca.'";';
    echo '</script>';
    exit;
  }

}
add_shortcode("idados_buscando", "idados_buscando");









function idados_delete($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
    "target_pos_delete" => '?',
    "on_op" => '',
    "access" => ''
  ), $atts));

  // return "---=";

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
     if(!$get_url_if_op)  return '';
     if($get_url_if_op<>$on_op) return '';
    }
  }

  

  // if($access){
  //   $ret = '';
  //   if(is_super_admin()) {
  //     $ret = 'true';
  //   } else {
  //     $ret = get_user_meta( get_current_user_id(), $access, true );
  //   }
  //   if(!$ret) return '';
  // }

  // if($access){if(!idados_is_access($access)) return '';}

  $target_pos_delete = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_pos_delete);
  $target_pos_delete = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_pos_delete);


  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $delete = md_delete($md,$cod);


  $ret = '';
  $ret = "";
  $ret .= '';
  if($target_pos_delete){
    echo '<script type="text/javascript">';
    echo '    window.location.href = "'.html_entity_decode($target_pos_delete).'";';
    // echo  'window.location.href = "../md-detalhe/?md=1030&cod=511"';
    echo '</script>';
  }
  return $ret.'---=---';
}
add_shortcode("idados_delete", "idados_delete");




function idados_deletar($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
    "target_delete" => '?op=delete&cod=__cod__',
    "on_op" => '',
    "access" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
     if(!$get_url_if_op)  return '';
     if($get_url_if_op<>$on_op) return '';

    }
  }

  if($access){if(!idados_is_access($access)) return '';}

  $cod = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $target_delete = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_delete);
  $target_delete = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_delete);

  $ret = "";
  // $ret .= "<h1 style='color:red;'>DELETAR</h1>";
  $ret .= "<h2 style='text-align:center;'>EXCLUSÃO DE REGISTRO</h2>";
  $ret .= do_shortcode('[idados_view md='.$md.' cod=__cod__]');
  $ret .= '<div style="text-align:center;">';
  $ret .= do_shortcode('[idados_botao label="CONFIRME A EXCLUSÃO DESTE REGISTRO" target="'.$target_delete.'" class="btn btn-danger"]');
  $ret .= '</div>';

  return $ret;



}
add_shortcode("idados_deletar", "idados_deletar");






function idados_insert($atts, $content = null) {
  //if ( !is_user_logged_in() ) exit;
  extract(shortcode_atts(array(
    "cnn" => '',
    "md" => '0',
    "cod" => '0',
    "target" => '',
    "target_pos_insert" => '?',
    "on_op" => '',
    "access" => ''
  ), $atts));

  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
     if(!$get_url_if_op)  return '';
     if($get_url_if_op<>$on_op) return '';

    }
  }



  $target_pos_insert = html_entity_decode($target_pos_insert);

  if($access){if(!idados_is_access($access)) return '';}

  $md = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);

  $target_pos_insert = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target_pos_insert);
  $target_pos_insert = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target_pos_insert);

  $ret = '';
  if(!$md) {$ret = "idados insert - md não especificado";}
  // if(!$cod) {$ret = "idados view - cod não especificado";}
  if($ret) {return $ret;exit;}

  // if(!md_insert($md, $_POST)) {echo "ERRO AO INSERIR";exit;}
  if(!md_insert($md, $_REQUEST, $cnn )) {
    // echo "ERRO AO INSERIR";exit;
  }

  // echo $target_pos_insert;
  // exit;
  $ret = "";
  $ret .= '';
  if($target_pos_insert){
    echo '<script type="text/javascript">';
    echo '    window.location.href = "'.$target_pos_insert.'";';
    echo '</script>';
    exit;
  }
  return $ret;
}
add_shortcode("idados_insert", "idados_insert");




// pra ir pro idados-crud - ini
function idados_botao($atts, $content = null) {
  extract(shortcode_atts(array(
    "md" => '0',
    "cod" => '0',
    "target" => '',
    "label" => '',
    "janela" => '',//blank
    "class" => 'btn-default',
    "style" => 'btn-default',
    "on_op" => '',
    "access" => ''

  ), $atts));



  $get_url_if_op = isset($_GET['op']) ? $_GET['op'] : '';
  if($on_op) {
    if($on_op=="empty"){
      if($get_url_if_op) return '';
    }else{
      if(!$get_url_if_op)  return '';
      if($get_url_if_op<>$on_op) return '';
    }
  }


  // if($access){
  //   if(!is_super_admin()){
  //     $ret = get_user_meta( get_current_user_id(), 'role', true );
  //     if ($ret<>$access) return '';
  //   }
  // }
  if($access){if(!idados_is_access($access)) return '';}

    // $vai = true;
    // if($on_op) {
    //   $vai = false;
    //   $t_op = isset($_GET['op']) ? $_GET['op'] : 'empty';
    //   if(($on_op=='empty') && ($t_op=='empty')) $vai = true;
    //   if(($on_op=='view') && ($t_op=='view')) $vai = true;
    //   if(($on_op=='edit') && ($t_op=='edit')) $vai = true;
    //   if(($on_op=='deletar') && ($t_op=='deletar')) $vai = true;
    //   if(($on_op=='det') && ($t_op=='det')) $vai = true;
    // }
    // if(!$vai) return '';

  $target = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $target);
  $target = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $target);
  $target = preg_replace("/__qs__/",$_SERVER['QUERY_STRING'] , $target);
  $target = preg_replace("/__site_url__/",site_url() , $target);
  $target = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $target);



  $to_janela = '';
  if($janela) $to_janela = 'target="'.$janela.'"';
  return '<a style="'.$style.'" class=" '.$class.'" href="'.$target.'" '.$to_janela.' >'.$label.'</a>';

}
add_shortcode("idados_botao", "idados_botao");



function idados_crud($atts, $content = null) {
  // usage:
  // [idados_crud md=5006 op="__op__" default_op="ilist"]
  //if ( !is_user_logged_in() ) return "";
  extract(shortcode_atts(array(
    "md" => '',
    "op" => '',
    "cod" => '__cod__',
    "pai" => '__pai__',
    "default_op" => 'ilist',
    'title_nnew' => '',
    "access_nnew" => '',
    "access" => '',
    "access_manager" => '',
    "target_insert" => '?op=insert',
    "target_pos_insert" => '?',

    "target_edit" => '?op=edit&cod=__cod__',
    "target_update" => '?op=update&cod=__cod__',
    "target_pos_update" => '?op=view&cod=__cod__',
    "target_pos_delete" => '?',
    "target_pos_duplique" => '?',
    "criterio" => '',
    "bar_top" => 1,
    "busca" => 1
  ), $atts));

  if($op=='') {
    $op = isset($_GET['op']) ? $_GET['op'] : '';
    if($op=='') $op=$default_op;
  }

  if($access){if(!idados_is_access($access)) return '';}


  // if($op=='__op__') {
  if(!$md) return '--nada--';

  $md   = preg_replace("/__md__/", (isset($_GET['md']) ? $_GET['md'] : 0) , $md);
  $op   = preg_replace("/__op__/", (isset($_GET['op']) ? $_GET['op'] : $default_op) , $op);
  $cod  = preg_replace("/__cod__/", (isset($_GET['cod']) ? $_GET['cod'] : 0) , $cod);
  $cod  = preg_replace("/__ucod__/", (isset($_GET['ucod']) ? $_GET['ucod'] : 0) , $cod);
  $pai  = preg_replace("/__pai__/", (isset($_GET['pai']) ? $_GET['pai'] : 0) , $pai);


  if($access_manager){
    $se = 0;
    if(($op=='edit') || ($op=='update') || ($op=='novo') || ($op=='nnew') || ($op=='insert') || ($op=='delete') || ($op=='deletar')  || ($op=='duplicar')){
      $se = 1;
    }
    if($se){
        if(!idados_is_access($access_manager)) return '';
    }
  }

  $uur = '';
  if($cod) $uur .= '&cod='.$cod;
  if($pai) $uur .= '&pai='.$pai;

  $ret = "";
  $url = $_SERVER["REDIRECT_URL"];
  $add_class = "idados";
  if(substr($url,1,6)=='idados') {
    $add_class = "idados_ajax";
    $ret .= '
    <script type="text/javascript">
      jQuery(function(){
        jQuery(".idados_ajax").on("click",function(e){
          e.preventDefault();
          // alert(jQuery(this).attr("href"));
          jQuery( "#aba_ctu" ).load( jQuery(this).attr("href"));
        });
      });
    </script>
    ';
  };


  if($bar_top==1){
    $ret .= '<div style="text-align:center">';
    // $ret .= '--'.$_SERVER["REDIRECT_URL"].'-';


    // phpinfo();
    // die();
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="RELOAD"      target="" ]');
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="LISTAGEM"    target="'.$url.'?" ]');
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="NOVO"        target="'.$url.'?op=novo&'.$criterio.'"]');
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="EDIT"        target="'.$url.'?op=edit&cod=__cod__&pai=__pai__" on_op="view" ]');
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="DELETAR"     target="'.$url.'?op=deletar&cod=__cod__" on_op="view" access=""]');
    $ret .= do_shortcode('[idados_botao class="btn '.$add_class.'" label="DUPLICAR"    target="'.$url.'?op=duplicar&cod=__cod__" on_op="view" access=""]');
    $ret .= '</div>';
  }//class="btn-link '.$add_class.'"

  if($busca==1){
    $ret .= '<div style="text-align:center;">';
    $ret .= do_shortcode( '[idados_busca]' );
    $ret .= '</div>';

    $ret .= '<div style="min-height: 1em;"></div>';
  }

  if($op=='ilist')    $ret .= do_shortcode( '[idados_ilist md='.$md.' access_manager="'.$access_manager.'" criterio="'.$criterio.'"]' );
  if($op=='novo')     $ret .= do_shortcode( '[idados_nnew md='.$md.' target_insert="'.$target_insert.'" title="'.$title_nnew.'" access="'.$access_nnew.'" access_manager="'.$access_manager.'" target_pos_insert="'.$target_pos_insert.'"] ' );
  if($op=='insert')   $ret .= do_shortcode( '[idados_insert md='.$md.' target_pos_insert="'.$target_pos_insert.$uur.'" access_manager="'.$access_manager.'" ]' );
  if($op=='edit')     $ret .= do_shortcode( '[idados_edit md='.$md.' cod='.$cod.' target_update="'.$target_update.'" access_manager="'.$access_manager.'" ]' );
  if($op=='update')   $ret .= do_shortcode( '[idados_update md='.$md.' cod='.$cod.' target_pos_update="'.$target_pos_update.'" access_manager="'.$access_manager.'" ]' );
  if($op=='view')     $ret .= do_shortcode( '[idados_view md='.$md.' cod='.$cod.' access_manager="'.$access_manager.'" ]' );
  if($op=='det')      $ret .= do_shortcode( '[idados_detalhe md='.$md.' cod='.$cod.' access_manager="'.$access_manager.'" ]' );
  if($op=='delete')   $ret .= do_shortcode( '[idados_delete md='.$md.' cod='.$cod.' target_pos_delete="'.$target_pos_delete.'" access_manager="'.$access_manager.'" ] ' );
  if($op=='duplicar') $ret .= do_shortcode( '[idados_duplique md='.$md.' cod='.$cod.' target_update="'.$target_update.'" access_manager="'.$access_manager.'" ]' );
  // if($op=='duplicar') $ret .= do_shortcode( '[idados_edit md='.$md.' cod='.$cod.' target_pos_duplique="'.$target_pos_duplique.'" access_manager="'.$access_manager.'" ] ' );

  if($op=='deletar') {
    $ret = "<h1 style='color:red;'>DELETAR</h1>";
    $ret .= "<h2 style='color:red;'>SOLICITAÇÃO DE EXCLUSÃO DE REGISTRO</h2>";
    $ret .= do_shortcode('[idados_view md='.$md.' cod=__cod__]');
    $ret .= do_shortcode('[idados_botao label="CONFIRMAR EXCLUSÃO" target="?op=delete&cod=__cod__" class="btn btn-danger"]');


    //return do_shortcode( '[idados_deletar md='.$md.' cod='.$cod.' target_pos_delete="?" ] ' );
  }
  return $ret;
}
add_shortcode("idados_crud", "idados_crud");


function idados_is_access($grupo){
  if(is_super_admin()) return true;
  $role = get_user_meta( get_current_user_id(), 'role', true );
  if($role){
    $grupos = explode(',', $grupo);
    foreach ($grupos as $key => $value) {
      if($value==$role) return true;
    }
  }
  //if($role==$grupo) return true;
  return false;
}
//add_action( 'wp', 'idados_is_access' );


add_action( 'wp_enqueue_scripts', 'idados_vdm8piud3v_scripts', 999 );
function idados_vdm8piud3v_scripts() {
  //wp_enqueue_style( 'idados-0000-css', plugins_url('css/style.css',__FILE__ ), '1.0.0' );
  wp_enqueue_script( 'idados-0000-js', plugins_url( 'js/js.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
  // wp_enqueue_style( 'wp-idados-style', plugins_url( 'assets/css/global.css', __FILE__ ), array(), '1.0.0' );

  // wp_enqueue_style( 'wp-idados-style', plugins_url( 'assets/css/style.css', __FILE__ ), array(), '1.0.0' );

  // wp_enqueue_script( 'wp-idados-ext_all', plugins_url( 'assets/js/ext-all.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
  // wp_enqueue_script( 'wp-idados-script', plugins_url( 'assets/js/function.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
  // wp_enqueue_script( 'wp-idados-ext-lang', 'assets/js/ext-lang-pt_BR.js', array( 'jquery' ), '1.0.0', true );
  // wp_enqueue_script( 'wp-idados-validate', plugins_url('assets/js/jquery.validate.js', __FILE__ ), array( 'jquery' ), '1.0.0', true );
}

