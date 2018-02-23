<?php
class operaciones {

//////////////// CONSULTAS PARA CALCULO DE CUENTA CORRIENTE

	 function total_gastos($ID_usu){
		 if($ID_usu == 0){
			 $usuario	=	"";
		 } else {
			 $usuario	=	"AND gastos.ID_usu='" . $ID_usu . "'";
		 }
		 
		$sql		=	"SELECT SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE gastos.ID_mon=monedas.ID_mon AND gastos.gas_aprobado='1' $usuario";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function total_gastos_completo(){
		$sql		=	"SELECT gastos.ID_usu, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE gastos.ID_mon=monedas.ID_mon AND gastos.gas_aprobado='1' GROUP BY gastos.ID_usu";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function total_gastos_completo_id($ID_usu){
		$sql		=	"SELECT gastos.ID_usu, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE gastos.ID_mon=monedas.ID_mon AND gastos.gas_aprobado='1' AND gastos.ID_usu='" . $ID_usu . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function total_cuenta_corriente($ID_usu){
		 if($ID_usu == 0){
			 $usuario	=	"";
		 } else {
			 $usuario	=	"AND cuenta_corriente.ID_usu='" . $ID_usu . "'";
		 }

		$sql		=	"SELECT SUM(cuenta_corriente.cta_importe*monedas.mon_cotizacion) AS total_cuenta_corriente FROM cuenta_corriente, monedas WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND cuenta_corriente.cta_transferido='1' $usuario";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function total_cuenta_corriente_periodo($ID_usu, $cta_month, $cta_year){
		 if($ID_usu == 0){
			 $usuario	=	"";
		 } else {
			 $usuario	=	"AND cuenta_corriente.ID_usu='" . $ID_usu . "'";
		 }
		 
		 if($cta_month == 0){
			 $periodo	=	"";
		 } else {
			 $periodo	=	"AND cuenta_corriente.cta_month='" . $cta_month . "'";
		 }
		$sql		=	"SELECT SUM(cuenta_corriente.cta_importe*monedas.mon_cotizacion) AS total_cuenta_corriente FROM cuenta_corriente, monedas WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND cuenta_corriente.cta_transferido='1' AND cuenta_corriente.cta_year='" . $cta_year . "' $usuario $periodo";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function cuenta_corriente_id($ID_cta){
		$sql		=	"SELECT * FROM cuenta_corriente, monedas, tipo_moneda WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND cuenta_corriente.ID_cta='" . $ID_cta . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function cuenta_corriente_usu($ID_usu){
		$sql		=	"SELECT * FROM cuenta_corriente, monedas, tipo_moneda WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND cuenta_corriente.cta_transferido='0' AND cuenta_corriente.ID_usu='" . $ID_usu . "' ORDER BY cuenta_corriente.cta_fecha_pedido ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function cuenta_corriente_usu_apro($ID_usu){
		$sql		=	"SELECT * FROM cuenta_corriente, monedas, tipo_moneda WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND cuenta_corriente.cta_transferido='0' AND cuenta_corriente.ID_usu='" . $ID_usu . "' AND cuenta_corriente.cta_aprobado='0' ORDER BY cuenta_corriente.cta_fecha_pedido ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function cuenta_corriente_aprobada(){
		$sql		=	"SELECT * FROM cuenta_corriente, monedas, tipo_moneda WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND cuenta_corriente.cta_transferido='0' AND cuenta_corriente.cta_aprobado='1' ORDER BY cuenta_corriente.cta_fecha_pedido ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_cuenta_corriente($ID_usu, $ID_mov, $cta_fecha_pedido, $ID_mon, $cta_importe, $cta_motivo, $cta_aprobado, $cta_transferido, $cta_fecha_transferido, $cta_month, $cta_year){
		$sql		= "INSERT INTO cuenta_corriente (ID_usu, ID_mov, cta_fecha_pedido, ID_mon, cta_importe, cta_motivo, cta_aprobado, cta_transferido, cta_fecha_transferido, cta_month, cta_year) VALUES('" . $ID_usu  ."','" . $ID_mov . "','" . $cta_fecha_pedido . "','" . $ID_mon  ."','" . $cta_importe  ."','" . $cta_motivo  ."','" . $cta_aprobado  ."','" . $cta_transferido  ."','" . $cta_fecha_transferido  ."','" . $cta_month  ."','" . $cta_year  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function cuenta_corriente_aprueba($ID_cta){
		$sql		= "UPDATE cuenta_corriente SET cta_aprobado='1' WHERE ID_cta='" . $ID_cta  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	function cuenta_corriente_confirm($ID_cta, $ID_mon, $cta_importe, $cta_fecha_transferido, $cta_month, $cta_year){
		$sql		= "UPDATE cuenta_corriente SET ID_mon='" . $ID_mon . "', cta_importe='" . $cta_importe . "', cta_fecha_transferido='" . $cta_fecha_transferido . "', cta_month='" . $cta_month . "', cta_year='" . $cta_year . "', cta_transferido='1' WHERE ID_cta='" . $ID_cta  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function cuenta_corriente_modif($ID_cta, $ID_mon, $cta_importe, $cta_motivo){
		$sql		= "UPDATE cuenta_corriente SET ID_mon='" . $ID_mon . "', cta_importe='" . $cta_importe . "', cta_motivo='" . $cta_motivo . "' WHERE ID_cta='" . $ID_cta  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function cuenta_corriente_elim($ID_cta){
		$sql		=	"DELETE FROM cuenta_corriente WHERE ID_cta='" . $ID_cta . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function cuenta_corriente_gastos($ID_usu, $gas_month, $gas_year){
		 if($gas_month != ""){
		 if($ID_usu == 0){
			 $usuario	=	"";
		 } else {
			 $usuario	=	"AND gastos.ID_usu='" . $ID_usu . "'";
		 }

		 if($gas_month == 0){
			 $periodo	=	"";
		 } else {
			 $periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		 }
		$sql		=	"SELECT gastos.gas_month, gastos.gas_year, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE gastos.ID_mon=monedas.ID_mon AND gastos.gas_aprobado='1' AND gastos.gas_year='" . $gas_year . "' $usuario $periodo";
		$result		=	mysql_query($sql);
		return $result;
		 }
	}

	 function cuenta_corriente_detalle($ID_usu, $cta_month, $cta_year){
		 if($ID_usu == 0){
			 $usuario	=	"";
		 } else {
			 $usuario	=	"AND cuenta_corriente.ID_usu='" . $ID_usu . "'";
		 }

		 if($cta_month == 0){
			 $periodo	=	"";
		 } else {
			 $periodo	=	"AND cuenta_corriente.cta_month='" . $cta_month . "'";
		 }
		$sql		=	"SELECT cuenta_corriente.ID_usu, cuenta_corriente.cta_fecha_pedido, cuenta_corriente.cta_fecha_transferido, cuenta_corriente.cta_motivo, (cuenta_corriente.cta_importe*monedas.mon_cotizacion) AS total_cuenta_corriente, tipo_movimiento.mov_desc FROM cuenta_corriente, monedas, tipo_movimiento WHERE cuenta_corriente.ID_mon=monedas.ID_mon AND cuenta_corriente.ID_mov=tipo_movimiento.ID_mov AND cuenta_corriente.cta_transferido='1' AND cuenta_corriente.cta_year='" . $cta_year . "' $usuario $periodo ORDER BY cuenta_corriente.cta_fecha_transferido DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA GASTOS

	 function gastos($ID_usu, $gas_month, $gas_year){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}
		$sql		=	"SELECT * FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, obras, clientes WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_obr=obras.ID_obr AND obras.ID_cli=clientes.ID_cli AND gastos.ID_usu='" . $ID_usu . "' AND gastos.gas_year='" . $gas_year . "' $periodo ORDER BY gastos.gas_month DESC, gastos.gas_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}
	 function informe_gastos($ID_usu, $gas_month, $gas_year, $ID_tip, $usu_cco, $ID_tpu){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}
		if($ID_tip == 0){
			$tipo_gasto	=	"";
		} else {
			$tipo_gasto	=	"AND gastos.ID_tip='" . $ID_tip . "'";
		}
		if($usu_cco == ''){
			$cco		=	"";
		} else {
			$cco		=	"AND usuarios.usu_cco='" . $usu_cco . "'";
		}
		if($ID_usu == 0){
			$usu		=	"";
		} else {
			$usu		=	"AND usuarios.ID_usu='" . $ID_usu . "'";
		}
		if($ID_tpu == 0){
			$tpu		=	"";
		} else {
			$tpu		=	"AND usuarios.ID_tpu='" . $ID_tpu . "'";
		}

		$sql		=	"SELECT * FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu=usuarios.ID_usu AND gastos.gas_year='" . $gas_year . "' $periodo $tipo_gasto $cco $usu $tpu ORDER BY gastos.gas_month DESC, gastos.gas_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables($gas_month, $gas_year){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}

		$sql		=	"SELECT tipo_gastos.tip_cuenta, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_cuenta FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu=usuarios.ID_usu AND gastos.gas_aprobado='1' AND gastos.gas_year='" . $gas_year . "' $periodo GROUP BY tipo_gastos.tip_cuenta";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables_nap($gas_month, $gas_year){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}

		$sql		=	"SELECT tipo_gastos.tip_cuenta, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_cuenta FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu=usuarios.ID_usu AND gastos.gas_aprobado='0' AND gastos.gas_year='" . $gas_year . "' $periodo GROUP BY tipo_gastos.tip_cuenta";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables_detalle($gas_month, $gas_year, $tip_cuenta){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}

		$sql		=	"SELECT usuarios.usu_cco, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_cco FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu=usuarios.ID_usu AND gastos.gas_aprobado='1' AND gastos.gas_year='" . $gas_year . "' AND tipo_gastos.tip_cuenta='" . $tip_cuenta . "' $periodo GROUP BY usuarios.usu_cco";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables_detalle_nap($gas_month, $gas_year, $tip_cuenta){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}

		$sql		=	"SELECT usuarios.usu_cco, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_cco FROM gastos, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu=usuarios.ID_usu AND gastos.gas_aprobado='0' AND gastos.gas_year='" . $gas_year . "' AND tipo_gastos.tip_cuenta='" . $tip_cuenta . "' $periodo GROUP BY usuarios.usu_cco";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function gastos_id($ID_gas){
		$sql		=	"SELECT * FROM gastos WHERE ID_gas='" . $ID_gas . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_gastos($ID_usu, $gas_fecharegistro, $gas_fecha, $gas_month, $gas_year, $ID_tip, $ID_lug, $ID_obr, $ID_mon, $gas_importe, $gas_papel, $gas_obs){
		$sql		= "INSERT INTO gastos (ID_usu, gas_fecharegistro, gas_fecha, gas_month, gas_year, ID_tip, ID_lug, ID_obr, ID_mon, gas_importe, gas_papel, gas_obs) VALUES('" . $ID_usu  ."','" . $gas_fecharegistro . "','" . $gas_fecha  ."','" . $gas_month . "','" . $gas_year  ."','" . $ID_tip . "','" . $ID_lug . "','" . $ID_obr  ."','" . $ID_mon  ."','" . $gas_importe  ."','" . $gas_papel  ."','" . $gas_obs  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}	

	function gastos_modif($ID_gas, $gas_fecha, $ID_tip, $ID_lug, $ID_obr, $ID_mon, $gas_importe, $gas_papel, $gas_obs){
		$sql		= "UPDATE gastos SET gas_fecha='" . $gas_fecha  ."', ID_tip='" . $ID_tip . "', ID_lug='" . $ID_lug . "', ID_obr='" . $ID_obr . "', ID_mon='" . $ID_mon  ."', gas_importe='" . $gas_importe  ."', gas_papel='" . $gas_papel  ."', gas_obs='" . $gas_obs  ."' WHERE ID_gas='" . $ID_gas  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}	

	 function gastos_elim($ID_gas){
		$sql		=	"DELETE FROM gastos WHERE ID_gas='" . $ID_gas . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA APROBACION DE GASTOS

	 function total_gastos_aprueba($ID_usu, $gas_month, $gas_year){
		$sql		=	"SELECT SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE  gastos.ID_mon=monedas.ID_mon AND gastos.ID_usu='" . $ID_usu . "' AND gastos.gas_month='" . $gas_month . "' AND gastos.gas_year='" . $gas_year . "' AND gastos.gas_aprobado='0'";
		$result		=	mysql_query($sql);
		return $result;
	}
	
	 function total_gastos_aprueba_no($ID_usu, $gas_month, $gas_year){
		$sql		=	"SELECT SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, monedas WHERE  gastos.ID_mon=monedas.ID_mon AND gastos.ID_usu='" . $ID_usu . "' AND gastos.gas_month='" . $gas_month . "' AND gastos.gas_year='" . $gas_year . "' AND gastos.gas_aprobado='1'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function gastos_aprueba_masivo($ID_usu, $gas_month, $gas_year){
		$sql		= "UPDATE gastos SET gas_aprobado='1' WHERE ID_usu='" . $ID_usu  ."' AND gas_month='" . $gas_month  ."' AND gas_year='" . $gas_year  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function gastos_aprueba_detalle_confirma($ID_gas){
		$sql		= "UPDATE gastos SET gas_aprobado='1' WHERE ID_gas='" . $ID_gas  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function gastos_aprueba_detalle($ID_usu, $gas_month, $gas_year){
		$sql		= "SELECT gastos.ID_gas, gastos.gas_fecha, gastos.gas_month, gastos.gas_year, tipo_gastos.tip_desc, lugares.lug_desc, (gastos.gas_importe*monedas.mon_cotizacion) AS gas_importe, tipo_moneda.tmo_desc FROM gastos, tipo_gastos, lugares, monedas, tipo_moneda WHERE gastos.ID_tip=tipo_gastos.ID_tip AND gastos.ID_lug=lugares.ID_lug AND gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_usu='" . $ID_usu . "' AND gastos.gas_month='" . $gas_month . "' AND gastos.gas_year='" . $gas_year . "' AND gastos.gas_aprobado='0' ORDER BY gastos.gas_month DESC, gastos.gas_fecha DESC";
		$result		= mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS GASTOS TARJETA

	 function gastos_tarjeta($ID_usu, $gta_month, $gta_year){

		$sql		=	"SELECT * FROM gastos_tarjeta, tipo_gastos, lugares, tipo_moneda, monedas, obras, clientes WHERE gastos_tarjeta.ID_tip=tipo_gastos.ID_tip AND gastos_tarjeta.ID_lug=lugares.ID_lug AND gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_obr=obras.ID_obr AND obras.ID_cli=clientes.ID_cli AND gastos_tarjeta.ID_usu='" . $ID_usu . "' AND gastos_tarjeta.gta_year='" . $gta_year . "' AND gastos_tarjeta.gta_month='" . $gta_month . "' ORDER BY gastos_tarjeta.gta_month DESC, gastos_tarjeta.gta_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_gastos_tarjeta($ID_usu, $gta_month, $gta_year, $ID_tip, $usu_cco, $ID_tpu){

		if($ID_tip == 0){
			$tipo_gasto	=	"";
		} else {
			$tipo_gasto	=	"AND gastos_tarjeta.ID_tip='" . $ID_tip . "'";
		}
		if($usu_cco == ''){
			$cco		=	"";
		} else {
			$cco		=	"AND usuarios.usu_cco='" . $usu_cco . "'";
		}
		if($ID_usu == 0){
			$usu		=	"";
		} else {
			$usu		=	"AND usuarios.ID_usu='" . $ID_usu . "'";
		}
		if($ID_tpu == 0){
			$tpu		=	"";
		} else {
			$tpu		=	"AND usuarios.ID_tpu='" . $ID_tpu . "'";
		}

		$sql		=	"SELECT * FROM gastos_tarjeta, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos_tarjeta.ID_tip=tipo_gastos.ID_tip AND gastos_tarjeta.ID_lug=lugares.ID_lug AND gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_usu=usuarios.ID_usu AND gastos_tarjeta.gta_year='" . $gta_year . "' AND gastos_tarjeta.gta_month='" . $gta_month . "' $tipo_gasto $cco $usu $tpu ORDER BY usuarios.usu_apellido ASC, gastos_tarjeta.gta_month DESC, gastos_tarjeta.gta_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables_tarjeta($gta_month, $gta_year){

		$sql		=	"SELECT tipo_gastos.tip_cuenta, SUM(gastos_tarjeta.gta_importe*monedas.mon_cotizacion) AS total_cuenta FROM gastos_tarjeta, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos_tarjeta.ID_tip=tipo_gastos.ID_tip AND gastos_tarjeta.ID_lug=lugares.ID_lug AND gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_usu=usuarios.ID_usu AND gastos_tarjeta.gta_year='" . $gta_year . "' AND gastos_tarjeta.gta_month='" . $gta_month . "' GROUP BY tipo_gastos.tip_cuenta";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_cuentas_contables_tarjeta_detalle($gta_month, $gta_year, $tip_cuenta){

		$sql		=	"SELECT usuarios.usu_cco, SUM(gastos_tarjeta.gta_importe*monedas.mon_cotizacion) AS total_cco FROM gastos_tarjeta, tipo_gastos, lugares, tipo_moneda, monedas, usuarios WHERE gastos_tarjeta.ID_tip=tipo_gastos.ID_tip AND gastos_tarjeta.ID_lug=lugares.ID_lug AND gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_usu=usuarios.ID_usu AND gastos_tarjeta.gta_year='" . $gta_year . "' AND gastos_tarjeta.gta_month='" . $gta_month . "' AND tipo_gastos.tip_cuenta='" . $tip_cuenta . "' GROUP BY usuarios.usu_cco";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function gastos_tarjeta_id($ID_gta){

		$sql		=	"SELECT gastos_tarjeta.ID_gta, gastos_tarjeta.gta_fecha, gastos_tarjeta.gta_month, gastos_tarjeta.gta_year, tipo_gastos.tip_desc, lugares.lug_desc, tipo_moneda.tmo_desc, gastos_tarjeta.gta_importe, gastos_tarjeta.gta_obs FROM gastos_tarjeta, tipo_gastos, lugares, tipo_moneda, monedas WHERE gastos_tarjeta.ID_tip=tipo_gastos.ID_tip AND gastos_tarjeta.ID_lug=lugares.ID_lug AND gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_gta='" . $ID_gta . "' ORDER BY gastos_tarjeta.gta_month DESC, gastos_tarjeta.gta_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function gastos_tarjeta_completa($ID_usu, $gta_month, $gta_year){

		$sql		=	"SELECT gastos_tarjeta.ID_gta, gastos_tarjeta.gta_fecha, gastos_tarjeta.gta_month, gastos_tarjeta.gta_year, tipo_moneda.tmo_desc, gastos_tarjeta.gta_importe, gastos_tarjeta.gta_obs FROM gastos_tarjeta, tipo_moneda, monedas WHERE gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_usu='" . $ID_usu . "' AND gastos_tarjeta.gta_year='" . $gta_year . "' AND gastos_tarjeta.gta_month='" . $gta_month . "' AND gastos_tarjeta.gta_completado='0' ORDER BY gastos_tarjeta.gta_month DESC, gastos_tarjeta.gta_fecha DESC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_gastos_tarjeta($ID_usu, $gta_month, $gta_year, $gta_comprobante, $gta_fecha, $ID_mon, $gta_importe, $gta_obs){
		$sql		= "INSERT INTO gastos_tarjeta (ID_usu, gta_month, gta_year, gta_comprobante, gta_fecha, ID_mon, gta_importe, gta_obs) VALUES('" . $ID_usu  ."','" . $gta_month . "','" . $gta_year  ."','" . $gta_comprobante . "','" . $gta_fecha  ."','" . $ID_mon . "','" . $gta_importe . "','" . $gta_obs  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	function gastos_tarjeta_completa_confirma($ID_gta, $ID_tip, $ID_lug, $ID_obr){
		if($ID_obr == ''){
			$ID_obr	=	0;
		}
		$sql		= "UPDATE gastos_tarjeta SET gta_completado='1', ID_tip='" . $ID_tip . "', ID_lug='" . $ID_lug . "', ID_obr='" . $ID_obr . "' WHERE ID_gta='" . $ID_gta  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function gastos_tarjeta_modif($ID_gta, $ID_tip, $ID_lug, $ID_obr){
		$sql		= "UPDATE gastos_tarjeta SET gta_completado='1', ID_tip='" . $ID_tip . "', ID_lug='" . $ID_lug . "', ID_obr='" . $ID_obr . "' WHERE ID_gta='" . $ID_gta  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS RESUMEN GASTOS TARJETA

	function insert_resumen_gastos_tarjeta($gta_month, $gta_year){
		$sql		= "INSERT INTO resumen_gastos_tarjeta (res_month, res_year) VALUES('" . $gta_month . "','" . $gta_year  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function resumen_gastos_tarjeta($gta_month, $gta_year){
		$sql		=	"SELECT * FROM resumen_gastos_tarjeta WHERE res_month='" . $gta_month . "' AND res_year='" . $gta_year . "'";
		$result		=	mysql_query($sql);
		return $result;
	}
	
//////////////// CONSULTAS PARA LA TABLA LUGARES

	 function lugares(){
		 $sql		=	"SELECT * FROM lugares";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function lugares_default(){
		 $sql		=	"SELECT * FROM lugares WHERE lugares.lug_default='1'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function lugares_id($ID_lug){
		 $sql		=	"SELECT * FROM lugares WHERE ID_lug='" . $ID_lug . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	function insert_lugares($lug_cod, $lug_desc, $ID_tmo){
		$sql		= "INSERT INTO lugares (lug_cod, lug_desc, ID_tmo) VALUES('" . $lug_cod . "','" . $lug_desc  ."','" . $ID_tmo  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_lugares($ID_lug){
		 $sql		=	"SELECT * FROM gastos WHERE ID_lug='" . $ID_lug . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function lugares_elim($ID_lug){
		$sql		=	"DELETE FROM lugares WHERE ID_lug='" . $ID_lug . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function lugares_modif($ID_lug, $lug_cod, $lug_desc, $ID_tmo){
		$sql		= "UPDATE lugares SET lug_cod='" . $lug_cod . "', lug_desc='" . $lug_desc . "', ID_tmo='" . $ID_tmo . "' WHERE ID_lug='" . $ID_lug  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA LA TABLA TIPO DE GASTOS

	 function tipo_gastos(){
		 $sql		=	"SELECT * FROM tipo_gastos";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function tipo_gastos_default(){
		 $sql		=	"SELECT * FROM tipo_gastos WHERE tipo_gastos.tip_default='1' ORDER BY tipo_gastos.tip_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function tipo_gastos_id($ID_tip){
		 $sql		=	"SELECT * FROM tipo_gastos WHERE ID_tip='" . $ID_tip . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_tipo_gastos($tip_cuenta, $tip_desc){
		$sql		= "INSERT INTO tipo_gastos (tip_cuenta, tip_desc) VALUES('" . $tip_cuenta . "','" . $tip_desc  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_tipo_gastos($ID_tip){
		 $sql		=	"SELECT * FROM gastos WHERE ID_tip='" . $ID_tip . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function tipo_gastos_elim($ID_tip){
		$sql		=	"DELETE FROM tipo_gastos WHERE ID_tip='" . $ID_tip . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function tipo_gastos_modif($ID_tip, $tip_cuenta, $tip_desc){
		$sql		= "UPDATE tipo_gastos SET tip_cuenta='" . $tip_cuenta . "', tip_desc='" . $tip_desc . "' WHERE ID_tip='" . $ID_tip  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA LA TABLA CLIENTES

	 function clientes(){
		 $sql		=	"SELECT * FROM clientes ORDER BY cli_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function clientes_id($ID_cli){
		 $sql		=	"SELECT * FROM clientes WHERE ID_cli='" . $ID_cli . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_clientes($ID_emp, $cli_desc){
		$sql		= "INSERT INTO clientes (ID_emp, cli_desc) VALUES('" . $ID_emp  ."','" . $cli_desc  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_clientes($ID_cli){
		 $sql		=	"SELECT * FROM obras WHERE ID_cli='" . $ID_cli . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function clientes_elim($ID_cli){
		$sql		=	"DELETE FROM clientes WHERE ID_cli='" . $ID_cli . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function clientes_modif($ID_cli, $cli_desc){
		$sql		= "UPDATE clientes SET cli_desc='" . $cli_desc . "' WHERE ID_cli='" . $ID_cli  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA LA TABLA OBRAS

	 function obras(){
		 $sql		=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades WHERE obras.ID_cli=clientes.ID_cli AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu ORDER BY clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_default(){
		 $sql		=	"SELECT * FROM obras, clientes WHERE obras.ID_cli=clientes.ID_cli AND obras.obr_default='1'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_id($ID_obr){
		 $sql		=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades WHERE obras.ID_obr='" . $ID_obr . "' AND obras.ID_cli=clientes.ID_cli AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_filter($ID_obr, $ID_cli){
		if($ID_obr == 0){
			$obra		=	"";
		} else {
			$obra		=	"AND obras.ID_obr='" . $ID_obr . "'";
		}
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND clientes.ID_cli='" . $ID_cli . "'";
		}
		 $sql		=	"SELECT * FROM obras, clientes WHERE obras.ID_cli=clientes.ID_cli $obra $cliente ORDER BY obras.obr_default ASC, clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function busca_obras($ID_obr, $ID_cli, $ID_zon, $obr_nsucursal){
		if($ID_obr == 0){
			$obra		=	"";
		} else {
			$obra		=	"AND obras.ID_obr='" . $ID_obr . "'";
		}
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND clientes.ID_cli='" . $ID_cli . "'";
		}
		if($ID_zon == 0){
			$zona		=	"";
		} else {
			$zona		=	"AND zonas.ID_zon='" . $ID_zon . "'";
		}
		if($obr_nsucursal == ''){
			$sucursal	=	"";
		} else {
			$sucursal	=	"AND obras.obr_nsucursal='" . $obr_nsucursal . "'";
		}
		 $sql		=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades WHERE obras.ID_cli=clientes.ID_cli AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu $obra $cliente $zona $sucursal ORDER BY obras.obr_default ASC, clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function busca_obras2($ID_obr, $ID_cli, $ID_zon, $obr_nproyecto){
		if($ID_obr == 0){
			$obra		=	"";
		} else {
			$obra		=	"AND obras.ID_obr='" . $ID_obr . "'";
		}
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND clientes.ID_cli='" . $ID_cli . "'";
		}
		if($ID_zon == 0){
			$zona		=	"";
		} else {
			$zona		=	"AND zonas.ID_zon='" . $ID_zon . "'";
		}
		if($obr_nproyecto == ''){
			$proyecto	=	"";
		} else {
			$proyecto	=	"AND obras.obr_nproyecto='" . $obr_nproyecto . "'";
		}
		 $sql		=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades WHERE obras.ID_cli=clientes.ID_cli AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu $obra $cliente $zona $proyecto ORDER BY obras.obr_default ASC, clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function informe_obras_kpi($ID_cli, $contr, $supe){
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND clientes.ID_cli='" . $ID_cli . "'";
		}
		if($contr == 0){
			$contratista	=	"";
		} else {
			$contratista	=	"AND (obras.obr_contfrio='" . $contr . "' OR obras.obr_contexhib='" . $contr . "' OR obras.obr_contcamaras='" . $contr . "')";
		}
		if($supe == 0){
			$supervisor 	=	"";
		} else {
			$supervisor		=	"AND obras.obr_supervisor='" . $supe . "'";
		}
		
		 $sql		=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades WHERE obras.ID_cli=clientes.ID_cli AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND obras.obr_fecfinreal<>'0000-00-00' $cliente $contratista $supervisor ORDER BY obras.obr_default ASC, clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_obras($ID_cli, $ID_prv, $ID_ciu, $obr_dir, $obr_nproyecto, $obr_ov, $obr_np, $obr_ndestinatario, $obr_fecmad, $obr_npto, $obr_contacto, $obr_tel, $obr_mail, $obr_nsucursal, $obr_desc, $obr_pto, $ID_zon, $obr_fecinfrio, $obr_fecfinfrio, $obr_cantfrio, $obr_contfrio, $obr_mofrio, $obr_fecinexhib, $obr_fecfinexhib, $obr_cantexhib, $obr_contexhib, $obr_moexhib, $obr_fecincamaras, $obr_fecfincamaras, $obr_cantcamaras, $obr_contcamaras, $obr_mocamaras, $obr_supervisor, $obr_obs, $obr_fecin, $obr_fecfin, $obr_fecinreal, $obr_fecfinreal, $obr_default){
		$sql		= "INSERT INTO obras (ID_cli, ID_prv, ID_ciu, obr_dir, obr_nproyecto, obr_ov, obr_np, obr_ndestinatario, obr_fecmad, obr_npto, obr_contacto, obr_tel, obr_mail, obr_nsucursal, obr_desc, obr_pto, ID_zon, obr_fecinfrio, obr_fecfinfrio, obr_cantfrio, obr_contfrio, obr_mofrio, obr_fecinexhib, obr_fecfinexhib, obr_cantexhib, obr_contexhib, obr_moexhib, obr_fecincamaras, obr_fecfincamaras, obr_cantcamaras, obr_contcamaras, obr_mocamaras, obr_supervisor, obr_obs, obr_fecin, obr_fecfin, obr_fecinreal, obr_fecfinreal, obr_default) VALUES('" . $ID_cli . "','" . $ID_prv . "','" . $ID_ciu . "','" . $obr_dir . "','" . $obr_nproyecto . "','" . $obr_ov . "','" . $obr_np . "','" . $obr_ndestinatario . "','" . $obr_fecmad . "','" . $obr_npto . "','" . $obr_contacto . "','" . $obr_tel . "','" . $obr_mail . "','" . $obr_nsucursal . "','" . $obr_desc . "','" . $obr_pto . "','" . $ID_zon . "','" . $obr_fecinfrio . "','" . $obr_fecfinfrio . "','" . $obr_cantfrio . "','" . $obr_contfrio . "','" . $obr_mofrio . "','" . $obr_fecinexhib . "','" . $obr_fecfinexhib . "','" . $obr_cantexhib . "','" . $obr_contexhib . "','" . $obr_moexhib . "','" . $obr_fecincamaras . "','" . $obr_fecfincamaras . "','" . $obr_cantcamaras . "','" . $obr_contcamaras . "','" . $obr_mocamaras . "','" . $obr_supervisor . "','" . $obr_obs . "','" . $obr_fecin . "','" . $obr_fecfin . "','" . $obr_fecinreal . "','" . $obr_fecfinreal . "','" . $obr_default . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_obras($ID_obr){
		 $sql		=	"SELECT * FROM gastos WHERE ID_obr='" . $ID_obr . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function valida_obras2($ID_obr){
		 $sql		=	"SELECT * FROM registro_servicio WHERE ID_obr='" . $ID_obr . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_elim($ID_obr){
		$sql		=	"DELETE FROM obras WHERE ID_obr='" . $ID_obr . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function obras_modif($ID_obr, $ID_cli, $ID_prv, $ID_ciu, $obr_dir, $obr_nproyecto, $obr_ov, $obr_np, $obr_ndestinatario, $obr_fecmad, $obr_npto, $obr_contacto, $obr_tel, $obr_mail, $obr_nsucursal, $obr_desc, $obr_pto, $ID_zon, $obr_fecinfrio, $obr_fecfinfrio, $obr_cantfrio, $obr_contfrio, $obr_mofrio, $obr_fecinexhib, $obr_fecfinexhib, $obr_cantexhib, $obr_contexhib, $obr_moexhib, $obr_fecincamaras, $obr_fecfincamaras, $obr_cantcamaras, $obr_contcamaras, $obr_mocamaras, $obr_supervisor, $obr_obs, $obr_fecin, $obr_fecfin, $obr_fecinreal, $obr_fecfinreal){
		$sql		= "UPDATE obras SET ID_cli='" . $ID_cli . "', ID_prv='" . $ID_prv . "', ID_ciu='" . $ID_ciu . "', obr_dir='" . $obr_dir . "', obr_nproyecto='" . $obr_nproyecto . "', obr_ov='" . $obr_ov . "', obr_np='" . $obr_np . "', obr_ndestinatario='" . $obr_ndestinatario . "', obr_fecmad='" . $obr_fecmad . "', obr_npto='" . $obr_npto . "', obr_contacto='" . $obr_contacto . "', obr_tel='" . $obr_tel . "', obr_mail='" . $obr_mail . "', obr_nsucursal='" . $obr_nsucursal . "', obr_desc='" . $obr_desc . "', obr_pto='" . $obr_pto . "', ID_zon='" . $ID_zon . "', obr_fecinfrio='" . $obr_fecinfrio . "', obr_fecfinfrio='" . $obr_fecfinfrio . "', obr_cantfrio='" . $obr_cantfrio . "', obr_contfrio='" . $obr_contfrio . "', obr_mofrio='" . $obr_mofrio . "', obr_fecinexhib='" . $obr_fecinexhib . "', obr_fecfinexhib='" . $obr_fecfinexhib . "', obr_cantexhib='" . $obr_cantexhib . "', obr_contexhib='" . $obr_contexhib . "', obr_moexhib='" . $obr_moexhib . "', obr_fecincamaras='" . $obr_fecincamaras . "', obr_fecfincamaras='" . $obr_fecfincamaras . "', obr_cantcamaras='" . $obr_cantcamaras . "', obr_contcamaras='" . $obr_contcamaras . "', obr_mocamaras='" . $obr_mocamaras . "', obr_supervisor='" . $obr_supervisor . "', obr_obs='" . $obr_obs . "', obr_fecin='" . $obr_fecin . "', obr_fecfin='" . $obr_fecfin . "', obr_fecinreal='" . $obr_fecinreal . "', obr_fecfinreal='" . $obr_fecfinreal . "' WHERE ID_obr='" . $ID_obr  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	 function informe_obras_efec($gas_month, $gas_year, $ID_obr_gas){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos.gas_month='" . $gas_month . "'";
		}
		$sql		=	"SELECT *, SUM(gastos.gas_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos, tipo_moneda, monedas, obras, clientes WHERE gastos.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos.ID_obr=obras.ID_obr AND obras.ID_cli=clientes.ID_cli AND gastos.gas_year='" . $gas_year . "' AND obras.ID_obr='" . $ID_obr_gas . "' $periodo GROUP BY obras.obr_desc ORDER BY clientes.cli_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	 function informe_obras_tarj($gas_month, $gas_year, $ID_obr_gas){
		if($gas_month == 0){
			$periodo	=	"";
		} else {
			$periodo	=	"AND gastos_tarjeta.gta_month='" . $gas_month . "'";
		}
		$sql		=	"SELECT *, SUM(gastos_tarjeta.gta_importe*monedas.mon_cotizacion) AS total_gastos FROM gastos_tarjeta, tipo_moneda, monedas, obras, clientes WHERE gastos_tarjeta.ID_mon=monedas.ID_mon AND monedas.ID_tmo=tipo_moneda.ID_tmo AND gastos_tarjeta.ID_obr=obras.ID_obr AND obras.ID_cli=clientes.ID_cli AND gastos_tarjeta.gta_year='" . $gas_year . "' AND obras.ID_obr='" . $ID_obr_gas . "' $periodo GROUP BY obras.obr_desc ORDER BY clientes.cli_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA LA TABLA ZONAS

	 function zonas(){
		 $sql		=	"SELECT * FROM zonas";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function zonas_id($ID_zon){
		 $sql		=	"SELECT * FROM zonas WHERE ID_zon='" . $ID_zon . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

//////////////// CONSULTAS PARA LA TABLA TIPO DE MOVIMIENTOS

	 function tipo_movimiento(){
		 $sql		=	"SELECT * FROM tipo_movimiento";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

//////////////// CONSULTAS PARA LA TABLA MONEDAS

	 function monedas($ID_emp){
		 $sql		=	"SELECT * FROM monedas, tipo_moneda, empresas WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND monedas.ID_emp=empresas.ID_emp AND empresas.ID_emp='" . $ID_emp . "' AND monedas.mon_habilitado='1'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function monedas_des(){
		 $sql		=	"SELECT monedas.ID_mon, monedas.mon_desc, monedas.mon_cotizacion, monedas.mon_habilitado, tipo_moneda.tmo_desc FROM monedas, tipo_moneda WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND monedas.mon_habilitado='0'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function monedas_id($ID_mon){
		 $sql		=	"SELECT monedas.ID_mon, monedas.mon_desc, monedas.mon_cotizacion, monedas.mon_habilitado, tipo_moneda.tmo_desc, tipo_moneda.ID_tmo FROM monedas, tipo_moneda WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND monedas.mon_habilitado='1' AND monedas.ID_mon='" . $ID_mon . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function monedas_lugar($ID_lug){
		 $sql		=	"SELECT monedas.ID_mon, monedas.mon_desc, monedas.mon_cotizacion, monedas.mon_habilitado, tipo_moneda.tmo_desc FROM monedas, tipo_moneda, lugares WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND monedas.mon_habilitado='1' AND lugares.ID_tmo=tipo_moneda.ID_tmo AND lugares.ID_lug='" . $ID_lug . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function monedas_tmo($ID_tmo){
		 $sql		=	"SELECT monedas.ID_mon, monedas.mon_desc, monedas.mon_cotizacion, monedas.mon_habilitado, tipo_moneda.tmo_desc FROM monedas, tipo_moneda WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND monedas.mon_habilitado='1' AND tipo_moneda.ID_tmo='" . $ID_tmo . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function monedas_tmoEmp($ID_emp, $ID_tmo){
		 $sql		=	"SELECT monedas.ID_mon, monedas.mon_desc, monedas.mon_cotizacion, monedas.mon_habilitado, tipo_moneda.tmo_desc 
		 				FROM monedas, tipo_moneda 
						WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND
						monedas.mon_habilitado='1' AND
						monedas.ID_emp='" . $ID_emp . "' AND
						tipo_moneda.ID_tmo='" . $ID_tmo . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_monedas($ID_tmo, $mon_desc, $mon_cotizacion){
		$sql		= "INSERT INTO monedas (ID_tmo, mon_desc, mon_cotizacion, mon_habilitado) VALUES('" . $ID_tmo . "','" . $mon_desc  ."','" . $mon_cotizacion  ."','1')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function monedas_deshabilita($ID_tmo){
		$sql		= "UPDATE monedas SET mon_habilitado='0' WHERE ID_tmo='" . $ID_tmo  ."' AND mon_habilitado='1'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function monedas_modif($ID_mon, $ID_tmo, $mon_desc, $mon_cotizacion){
		$sql		= "UPDATE monedas SET ID_tmo='" . $ID_tmo . "', mon_desc='" . $mon_desc . "', mon_cotizacion='" . $mon_cotizacion . "' WHERE ID_mon='" . $ID_mon  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


////////////////////// CONSULTAS A LA TABLA TIPO MONEDAS

	 function tipo_monedas(){
		 $sql		=	"SELECT * FROM tipo_moneda";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function tipo_monedas_id($ID_tmo){
		 $sql		=	"SELECT * FROM tipo_moneda WHERE ID_tmo='" . $ID_tmo . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

////////////////////// CONSULTAS A LA TABLA PERMISOS

	function permisos($usu, $for){
		$sql		=	"SELECT * FROM permisos, formularios WHERE
permisos.ID_for=formularios.ID_for AND permisos.ID_usu='" . $usu ."' AND formularios.for_desc='" . $for . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function perm(){
		$sql		=	"SELECT permisos.ID_per, permisos.ID_usu, permisos.ID_for, permisos.per_permite, formularios.ID_mod, formularios.for_desc, usuarios.usu_username FROM permisos, formularios, usuarios WHERE permisos.ID_for=formularios.ID_for AND permisos.ID_usu=usuarios.ID_usu ORDER BY usuarios.usu_username, formularios.ID_mod ASC";
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function elimina_permisos($ID_per){
		$sql		=	"DELETE FROM permisos WHERE ID_per=" . $ID_per;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_permisos($ID_usu, $ID_for){
		$sql		= "INSERT INTO permisos (ID_usu, ID_for, per_permite) VALUES('" . $ID_usu ."','" . $ID_for . "',1)";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function perm_valida($ID_usu, $ID_for){
		$sql		=	"SELECT * FROM permisos WHERE ID_for=" . $ID_for . " AND ID_usu=" . $ID_usu;
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

////////////////////// CONSULTAS A LA TABLA FORMULARIOS

	function formularios(){
		$sql		=	"SELECT * FROM formularios ORDER BY ID_mod, for_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function formularios_id($ID_for){
		$sql		=	"SELECT * FROM formularios WHERE ID_for=" . $ID_for;
		$result		=	mysql_query($sql);
		return $result;
	}

	function formularios_id_mod($ID_mod){
		$sql		=	"SELECT * FROM formularios WHERE ID_mod=" . $ID_mod;
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function elimina_formularios($ID_for){
		$sql		=	"DELETE FROM formularios WHERE ID_for=" . $ID_for;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_formularios($ID_mod, $for_desc){
		$sql		= "INSERT INTO formularios (ID_mod, for_desc) VALUES('" . $ID_mod ."','" . $for_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function modifica_formularios($ID_for, $ID_mod, $for_desc){
		$sql		= 	"UPDATE formularios SET ID_mod='" . $ID_mod . "', for_desc='" . $for_desc . "' WHERE ID_for=" . $ID_for;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function formulario_valida($ID_mod, $for_desc){
		$sql		=	"SELECT * FROM formularios WHERE ID_mod='" . $ID_mod . "' AND for_desc='" . $for_desc . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}
////////////////////// CONSULTAS A LA TABLA Tipos de Servicio

	function tipo_servicio(){
		$sql		=	"SELECT * FROM tipo_servicio ORDER BY tse_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function tipo_servicio_id($ID_tse){
		$sql		=	"SELECT * FROM tipo_servicio WHERE ID_tse=" . $ID_tse;
		$result		=	mysql_query($sql);
		return $result;
	}

	function elimina_tipo_servicio($ID_tse){
		$sql		=	"DELETE FROM tipo_servicio WHERE ID_tse=" . $ID_tse;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_tipo_servicio($tse_desc, $tse_um){
		$sql		= "INSERT INTO tipo_servicio (tse_desc, tse_um) VALUES('" . $tse_desc . "','" . $tse_um . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function modifica_tipo_servicio($ID_tse, $tse_desc, $tse_um){
		$sql		= 	"UPDATE tipo_servicio SET tse_desc='" . $tse_desc . "', tse_um='" . $tse_um . "' WHERE ID_tse=" . $ID_tse;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function tipo_servicio_valida($tse_desc){
		$sql		=	"SELECT * FROM tipo_servicio WHERE tse_desc='" . $tse_desc . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

	function tipo_servicio_valida_elim($ID_tse){
		$sql		=	"SELECT * FROM rel_sertse WHERE ID_tse='" . $ID_tse . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

////////////////////// CONSULTAS A LA TABLA Estados

	function estados($ser_tipo){
		$sql			=	"SELECT * FROM status WHERE ser_tipo='" . $ser_tipo . "' ORDER BY sta_desc ASC";
		$result			=	mysql_query($sql);
		return $result;
	}

	function estados_abm(){
		$sql			=	"SELECT * FROM status";
		$result			=	mysql_query($sql);
		return $result;
	}
	
	function estados_id($ID_sta){
		$sql		=	"SELECT * FROM status WHERE ID_sta=" . $ID_sta;
		$result		=	mysql_query($sql);
		return $result;
	}

	function elimina_estados($ID_sta){
		$sql		=	"DELETE FROM status WHERE ID_sta=" . $ID_sta;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_estados($sta_desc, $ser_tipo){
		$sql		= "INSERT INTO status (sta_desc, ser_tipo) VALUES('" . $sta_desc . "','" . $ser_tipo . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function modifica_estados($ID_sta, $sta_desc){
		$sql		= 	"UPDATE status SET sta_desc='" . $sta_desc . "' WHERE ID_sta=" . $ID_sta;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function estados_valida($sta_desc, $ser_tipo){
		$sql		=	"SELECT * FROM status WHERE sta_desc='" . $sta_desc . "' AND ser_tipo='" . $ser_tipo . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

	function estados_valida_elim($ID_sta){
		$sql		=	"SELECT * FROM registro_servicio WHERE ID_sta='" . $ID_sta . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

////////////////////// CONSULTAS A LA TABLA Prioridades

	function prioridades(){
		$sql		=	"SELECT * FROM prioridades ORDER BY pri_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function prioridades_id($ID_pri){
		$sql		=	"SELECT * FROM prioridades WHERE ID_pri=" . $ID_pri;
		$result		=	mysql_query($sql);
		return $result;
	}

	function elimina_prioridades($ID_pri){
		$sql		=	"DELETE FROM prioridades WHERE ID_pri=" . $ID_pri;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_prioridades($pri_desc){
		$sql		= "INSERT INTO prioridades (pri_desc) VALUES('" . $pri_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function modifica_prioridades($ID_pri, $pri_desc){
		$sql		= 	"UPDATE prioridades SET pri_desc='" . $pri_desc . "' WHERE ID_pri=" . $ID_pri;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function prioridades_valida($pri_desc){
		$sql		=	"SELECT * FROM prioridades WHERE pri_desc='" . $pri_desc . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

	function prioridades_valida_elim($ID_pri){
		$sql		=	"SELECT * FROM registro_servicio WHERE ID_pri='" . $ID_pri . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}
	
////////////////////// CONSULTAS A LA TABLA MODULOS

	function modulos(){
		$sql		=	"SELECT * FROM modulos";
		$result		=	mysql_query($sql);
		return $result;
	}

	function modulos_id($ID_mod){
		$sql		=	"SELECT * FROM modulos WHERE ID_mod=" . $ID_mod;
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function elimina_modulos($ID_mod){
		$sql		=	"DELETE FROM modulos WHERE ID_mod=" . $ID_mod;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_modulos($mod_desc){
		$sql		= "INSERT INTO modulos (mod_desc) VALUES('" . $mod_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function modifica_modulos($ID_mod, $mod_desc){
		$sql		= 	"UPDATE modulos SET mod_desc='" . $mod_desc . "' WHERE ID_mod=" . $ID_mod;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}

	function modulo_valida($mod_desc){
		$sql		=	"SELECT * FROM modulos WHERE mod_desc='" . $mod_desc . "'";
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}

////////////////////// CONSULTAS A LA TABLA Ciudades

	function ciudades(){
		$sql		=	"SELECT * FROM ciudades ORDER BY ciu_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function ciudades_id($ID_ciu){
		$sql		=	"SELECT * FROM ciudades WHERE ID_ciu=" . $ID_ciu;
		$result		=	mysql_query($sql);
		return $result;
	}	

	function insert_ciudades($ID_prv, $ciu_desc){
		$sql		= "INSERT INTO ciudades (ID_prv, ciu_desc) VALUES('" . $ID_prv . "','" . $ciu_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function ciudades_prv($ID_prv){
		$sql		=	"SELECT * FROM ciudades WHERE ID_prv=" . $ID_prv;
		$result		=	mysql_query($sql);
		return $result;
	}	

	function ciudades_obr($ID_obr){
		$sql		=	"SELECT * FROM obras, ciudades WHERE obras.ID_ciu=ciudades.ID_ciu AND ID_obr='" . $ID_obr . "' GROUP BY ciudades.ID_ciu ORDER BY ciudades.ciu_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

////////////////////// CONSULTAS A LA TABLA Provincias

	function provincias(){
		$sql		=	"SELECT * FROM provincias ORDER BY prv_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}

	function provincias_id($ID_prv){
		$sql		=	"SELECT * FROM provincias WHERE ID_prv=" . $ID_prv;
		$result		=	mysql_query($sql);
		return $result;
	}	

	function provincias_obr($ID_obr){
		$sql		=	"SELECT * FROM obras, provincias WHERE obras.ID_prv=provincias.ID_prv AND ID_obr='" . $ID_obr . "' GROUP BY provincias.ID_prv ORDER BY provincias.prv_desc ASC";
		$result		=	mysql_query($sql);
		return $result;
	}	

//////////////// CONSULTAS PARA LA TABLA REGISTRO SERVICIOS

	 function registro_servicio(){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_tipo='1' ORDER BY clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_servicio_asig(){
		 $sql		=	"SELECT usuarios.ID_usu, usuarios.usu_nombre, usuarios.usu_apellido FROM registro_servicio, usuarios WHERE registro_servicio.ser_asig=usuarios.ID_usu AND registro_servicio.ser_tipo='1' GROUP BY usuarios.ID_usu ORDER BY usuarios.usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_servicio_dia($ser_fecin){
		 $sql		=	"SELECT * FROM registro_servicio WHERE ser_fecin='". $ser_fecin . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_servicio_filter($ID_cli, $ID_obr, $ser_asig, $ID_sta, $ser_cod){
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND registro_servicio.ID_cli='" . $ID_cli . "'";
		}
		if($ID_obr == 0){
			$obra		=	"";
		} else {
			$obra		=	"AND registro_servicio.ID_obr='" . $ID_obr . "'";
		}
		if($ser_asig == 0){
			$asig		=	"";
		} else {
			$asig		=	"AND registro_servicio.ser_asig='" . $ser_asig . "'";
		}
		$count_ID_sta	=	count($ID_sta);
		if($count_ID_sta == 0){
			$status		=	"";
		} else {
			if($count_ID_sta == 1){
				for($w=0;$w<$count_ID_sta;$w++){
					$status		=	"AND registro_servicio.ID_sta='" . @$ID_sta[$w] . "'";
				}
			} else {
					$estado="AND (registro_servicio.ID_sta='" . $ID_sta[0] . "'";
				for($w=1;$w<$count_ID_sta;$w++){
					$estado.=" OR registro_servicio.ID_sta='" . $ID_sta[$w] . "'";
				}
				$estado2	=	")";
				$status		=	$estado . $estado2;
			}
		}
		if($ser_cod == ''){
			$codigo		=	"";
		} else {
			$codigo		=	"AND registro_servicio.ser_cod='" . $ser_cod . "'";
		}
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_tipo='1' $cliente $obra $asig $codigo $status ORDER BY registro_servicio.ser_cod DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_servicio_filter_usu($ser_asig){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_asig='". $ser_asig . "' ORDER BY registro_servicio.ser_cod DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_servicio_id($ID_ser){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_ser='" . $ID_ser . "' AND registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_registro_servicio($ID_cli, $ID_obr, $ID_sta, $ID_pri, $ID_usu, $ser_cod, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_fecin, $ser_hourin){
		$sql		= "INSERT INTO registro_servicio (ID_cli, ID_obr, ID_sta, ID_pri, ID_usu, ser_tipo, ser_cod, ser_asig, ser_desc, ser_contacto, ser_telefono, ser_mail, ser_fecin, ser_hourin) VALUES('" . $ID_cli . "','" . $ID_obr . "','" . $ID_sta . "','" . $ID_pri . "','" . $ID_usu . "', '1', '" . $ser_cod . "','" . $ser_asig . "','" . $ser_desc . "','" . $ser_contacto . "','" . $ser_telefono . "','" . $ser_mail . "','" . $ser_fecin . "','" . $ser_hourin . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_registro_servicio($ID_ser){
		 $sql		=	"SELECT * FROM registro_servicio WHERE ID_ser='" . $ID_ser . "' AND ser_cerrado='1'";
		 $result	=	mysql_query($sql);
		 $num		=	mysql_num_rows($result);
		 return $num;
	 }

	 function registro_servicio_elim($ID_ser){
		$sql		=	"DELETE FROM registro_servicio WHERE ID_ser='" . $ID_ser . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function registro_servicio_modif($ID_ser, $ID_pri, $ID_sta, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_asig){
		$sql		= "UPDATE registro_servicio SET ID_pri='" . $ID_pri . "', ID_sta='" . $ID_sta . "', ser_desc='" . $ser_desc . "', ser_contacto='" . $ser_contacto . "', ser_telefono='" . $ser_telefono . "', ser_mail='" . $ser_mail . "', ser_asig='" . $ser_asig . "' WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_servicio_pendiente($ID_ser){
		$sql		= "UPDATE registro_servicio SET ID_sta='4' WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_servicio_cierra($ID_ser, $ser_solucion, $ser_persconforme, $ser_conforme, $ser_hs, $ser_costo, $ser_fecout, $ser_hourout, $ser_cerrado){
		$sql		= "UPDATE registro_servicio SET ID_sta='5', ser_solucion='" . $ser_solucion . "', ser_persconforme='" . $ser_persconforme . "', ser_conforme='" . $ser_conforme . "', ser_hs='" . $ser_hs . "', ser_costo='" . $ser_costo . "', ser_fecout='" . $ser_fecout . "', ser_hourout='" . $ser_hourout . "', ser_cerrado='" . $ser_cerrado . "' WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_servicio_cierra2($ID_ser, $ser_fc, $ser_costomp){
		$sql		= "UPDATE registro_servicio SET ser_fc='" . $ser_fc . "', ser_costomp='" . $ser_costomp . "', ser_cerradodef='1' WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
//////////////// CONSULTAS PARA LA TABLA REGISTRO SERVICIOS

	 function registro_presupuesto(){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_tipo='2' ORDER BY clientes.cli_desc ASC, obras.obr_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_asig(){
		 $sql		=	"SELECT usuarios.ID_usu, usuarios.usu_nombre, usuarios.usu_apellido FROM registro_servicio, usuarios WHERE registro_servicio.ser_asig=usuarios.ID_usu AND registro_servicio.ser_tipo='2' GROUP BY usuarios.ID_usu ORDER BY usuarios.usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_dia(){
		 $sql		=	"SELECT * FROM registro_servicio";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_nextid(){
		 $sql		=	"SELECT AUTO_INCREMENT AS NEXTID FROM information_schema.tables WHERE table_name = 'registro_servicio'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_filter($ID_usu, $ID_cli, $ID_obr, $ser_asig, $ID_sta, $ser_cod){
		if($ID_usu == 0){
			$usu	=	"";
		} else {
			$usu	=	"AND registro_servicio.ser_asig='" . $ID_usu . "'";
		}
		if($ID_cli == 0){
			$cliente	=	"";
		} else {
			$cliente	=	"AND registro_servicio.ID_cli='" . $ID_cli . "'";
		}
		if($ID_obr == 0){
			$obra		=	"";
		} else {
			$obra		=	"AND registro_servicio.ID_obr='" . $ID_obr . "'";
		}
		if($ser_asig == 0){
			$asig		=	"";
		} else {
			$asig		=	"AND registro_servicio.ser_asig='" . $ser_asig . "'";
		}
		$count_ID_sta	=	count($ID_sta);
		if($count_ID_sta == 0){
			$status		=	"";
		} else {
			if($count_ID_sta == 1){
				for($w=0;$w<$count_ID_sta;$w++){
					$status		=	"AND registro_servicio.ID_sta='" . @$ID_sta[$w] . "'";
				}
			} else {
					$estado="AND (registro_servicio.ID_sta='" . $ID_sta[0] . "'";
				for($w=1;$w<$count_ID_sta;$w++){
					$estado.=" OR registro_servicio.ID_sta='" . $ID_sta[$w] . "'";
				}
				$estado2	=	")";
				$status		=	$estado . $estado2;
			}
		}
		if($ser_cod == ''){
			$codigo		=	"";
		} else {
			$codigo		=	"AND registro_servicio.ser_cod='" . $ser_cod . "'";
		}
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_tipo='2' $usu $cliente $obra $asig $codigo $status ORDER BY registro_servicio.ser_cod DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_filter_usu($ser_asig){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_usu=usuarios.ID_usu AND obras.ID_zon=zonas.ID_zon AND obras.ID_prv=provincias.ID_prv AND obras.ID_ciu=ciudades.ID_ciu AND registro_servicio.ser_asig='". $ser_asig . "' ORDER BY registro_servicio.ser_cod DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_id($ID_ser){
		 $sql		=	"SELECT * FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades, tipo_presupuesto, monedas, tipo_moneda
		 				WHERE
		 				registro_servicio.ID_ser='" . $ID_ser . "' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu AND
						registro_servicio.ID_tpp=tipo_presupuesto.ID_tpp AND
						registro_servicio.ID_mon=monedas.ID_mon AND
						monedas.ID_tmo=tipo_moneda.ID_tmo";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_registro_presupuesto($ID_emp, $ID_cli, $ID_obr, $ID_sta, $ID_pri, $ID_usu, $ser_cod, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_PTOadjunto, $ser_fecin, $ser_hourin, $ID_tpp, $ID_mon){
		$sql		=	"INSERT INTO registro_servicio (ID_emp,ID_cli, ID_obr, ID_sta, ID_pri, ID_usu, ser_tipo, ser_cod, ser_asig, ser_desc, ser_contacto, ser_telefono, ser_mail, ser_PTOadjunto, ser_fecin, ser_hourin, ID_tpp, ID_mon) 
						VALUES('" . $ID_emp . "','" . $ID_cli . "','" . $ID_obr . "','" . $ID_sta . "','" . $ID_pri . "','" . $ID_usu . "', '2', '" . $ser_cod . "','" . $ser_asig . "','" . $ser_desc . "','" . $ser_contacto . "','" . $ser_telefono . "','" . $ser_mail . "','" . $ser_PTOadjunto . "','" . $ser_fecin . "','" . $ser_hourin . "','" . $ID_tpp . "','" . $ID_mon . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function valida_registro_presupuesto($ID_ser){
		 $sql		=	"SELECT * FROM registro_servicio WHERE ID_ser='" . $ID_ser . "' AND ser_cerrado='1'";
		 $result	=	mysql_query($sql);
		 $num		=	mysql_num_rows($result);
		 return $num;
	 }

	 function registro_presupuesto_elim($ID_ser){
		$sql		=	"DELETE FROM registro_servicio WHERE ID_ser='" . $ID_ser . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function registro_presupuesto_modif($ID_ser, $ID_pri, $ID_sta, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_asig, $ser_PTOadjunto){
		$sql		=	"UPDATE registro_servicio
						SET ID_pri='" . $ID_pri . "',
						ID_sta='" . $ID_sta . "',
						ser_desc='" . $ser_desc . "',
						ser_contacto='" . $ser_contacto . "',
						ser_telefono='" . $ser_telefono . "',
						ser_mail='" . $ser_mail . "',
						ser_asig='" . $ser_asig . "',
						ser_PTOadjunto='" . $ser_PTOadjunto . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_modif_usu($ID_ser, $ser_PTOnumero, $ID_mon, $ser_PTOmonto, $ser_pto, $ser_fecEstimada){
		$sql		=	"UPDATE registro_servicio
						SET ser_PTOnumero='" . $ser_PTOnumero . "',
						ID_mon='" . $ID_mon . "',
						ser_PTOnumero='" . $ser_PTOnumero . "',
						ser_PTOmonto='" . $ser_PTOmonto . "',
						ser_pto='" . $ser_pto . "',
						ser_fecEstimada='" . $ser_fecEstimada . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_presupuesta($ID_ser, $ser_PTOnumero, $ser_pto, $ser_fecEstimada, $ser_PTOmonto, $ID_mon){
		$sql		=	"UPDATE registro_servicio
						SET ser_PTOnumero='" . $ser_PTOnumero . "',
						ID_sta='13',
						ser_pto='" . $ser_pto . "',
						ID_mon='" . $ID_mon . "',
						ser_PTOmonto='" . $ser_PTOmonto . "',
						ser_fecPresupuesto='" . date('Y') . "-" . date('m') . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s') . "',
						ser_fecEstimada='" . $ser_fecEstimada . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_venta($ID_ser, $ser_OC, $ser_OV, $ser_proyecto, $ser_fecEntrega, $tpp_despacho, $ser_OVmonto){
		if($tpp_despacho == 1){
			$ID_sta	=	15;
		} else {
			$ID_sta	=	14;
		}
		$sql		=	"UPDATE registro_servicio
						SET ser_OC='" . $ser_OC . "',
						ID_sta='" . $ID_sta . "',
						ser_OV='" . $ser_OV . "',
						ser_OVmonto='" . $ser_OVmonto . "',
						ser_proyecto='" . $ser_proyecto . "',
						ser_fecVenta='" . date('Y') . "-" . date('m') . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s') . "',
						ser_fecEntrega='" . $ser_fecEntrega . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_despacho($ID_ser, $ser_remito, $ser_fecDespacho, $tpp_instalacion){
		if($tpp_instalacion == 1){
			$ID_sta	=	20;
		} else {
			$ID_sta	=	14;
		}
		$sql		=	"UPDATE registro_servicio
						SET ID_sta='" . $ID_sta . "',
						ser_remito='" . $ser_remito . "',
						ser_fecDespacho='" . $ser_fecDespacho . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_cierre($ID_ser, $ser_docsFacturacion){
		$sql		=	"UPDATE registro_servicio
						SET ID_sta='18',
						ser_docsFacturacion='" . $ser_docsFacturacion . "',
						ser_fecout='" . date('Y') . "-" . date('m') . "-" . date('d') . "',
						ser_hourout='" . date('H') . ":" . date('i') . ":" . date('s') . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_reasigna($ID_ser, $ser_asig){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='17',
						ser_asig='" . $ser_asig . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_acepta($ID_ser){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='16',
						ser_fecAcepta='" . date('Y') . "-" . date('m') . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s') . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_descarta($ID_ser){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='21'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_instalacion($ID_ser){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='14',
						ser_fecInstalacion='" . date('Y') . "-" . date('m') . "-" . date('d') . " " . date('H') . ":" . date('i') . ":" . date('s') . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_rechaza($ID_ser){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='12'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	function registro_presupuesto_rechazado($ID_ser, $ID_mot){
		$sql		=	"UPDATE registro_servicio 
						SET ID_sta='19',
						ID_mot='" . $ID_mot . "',
						ser_fecout='" . date('Y') . "-" . date('m') . "-" . date('d') . "',
						ser_hourout='" . date('H') . ":" . date('i') . ":" . date('s') . "'
						WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function registro_presupuesto_recibidos($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecin, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades 
		 				WHERE registro_servicio.ID_sta='12' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_pendientes_acep($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(HOUR, TIMESTAMP(registro_servicio.ser_fecin, registro_servicio.ser_hourin), NOW()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades 
		 				WHERE registro_servicio.ID_sta='17' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_presupuesto_pendientes_presup($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(HOUR, registro_servicio.ser_fecAcepta, NOW()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades 
		 				WHERE registro_servicio.ID_sta='16' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function registro_presupuesto_presupuestados($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecPresupuesto, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades, monedas, tipo_moneda
		 				WHERE registro_servicio.ID_sta='13' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu AND
						monedas.ID_mon=registro_servicio.ID_mon AND
						tipo_moneda.ID_tmo=monedas.ID_tmo
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function registro_presupuesto_pendientes_despacho($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecEntrega, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades 
		 				WHERE
						registro_servicio.ID_sta='15' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 function registro_presupuesto_pendientes_instala($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecAcepta, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades 
		 				WHERE
						registro_servicio.ID_sta='20' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 function registro_presupuesto_pendientes_cierre($ID_usu){
		if($ID_usu == 0){
			$usu	=	'';
		} else {
			$usu	=	'AND registro_servicio.ser_asig="' . $ID_usu . '"';
		}
		$sql		=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecAcepta, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas, provincias, ciudades, tipo_presupuesto
		 				WHERE
						registro_servicio.ID_sta='14' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon AND
						obras.ID_prv=provincias.ID_prv AND
						obras.ID_ciu=ciudades.ID_ciu AND
						registro_servicio.ID_tpp=tipo_presupuesto.ID_tpp
						$usu
						ORDER BY days DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function registro_presupuesto_pendiente($ID_ser){
		$sql		= "UPDATE registro_servicio SET ID_sta='4' WHERE ID_ser='" . $ID_ser  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA REL_SERTSE

	function insert_rel_sertse($ID_ser, $ID_tse, $rst_reqmat, $rst_cant){
		$sql		= "INSERT INTO rel_sertse (ID_ser, ID_tse, rst_reqmat, rst_cant) VALUES('" . $ID_ser . "','" . $ID_tse . "','" . $rst_reqmat . "','" . $rst_cant . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA TASKS

	 function tasks($ID_ser){
		 $sql		=	"SELECT * FROM tasks, usuarios WHERE tasks.ID_usu=usuarios.ID_usu AND tasks.ID_ser='" . $ID_ser . "' ORDER BY tasks.tas_fecin ASC, tasks.tas_hourin ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_tasks($ID_ser, $ID_usu, $tas_fecin, $tas_hourin, $tas_desc){
		$sql		= "INSERT INTO tasks (ID_ser, ID_usu, tas_fecin, tas_hourin, tas_desc) VALUES('" . $ID_ser . "','" . $ID_usu . "','" . $tas_fecin . "','" . $tas_hourin . "','" . $tas_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function tasks_elim($ID_tas){
		$sql		=	"DELETE FROM tasks WHERE ID_tas='" . $ID_tas . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA TIPO PRESUPUESTO

	 function tipo_presupuesto($ID_emp){
		 $sql		=	"SELECT * FROM tipo_presupuesto WHERE tipo_presupuesto.ID_emp='" . $ID_emp . "' ORDER BY tipo_presupuesto.tpp_udn ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_tipo_presupuesto($ID_emp, $tpp_cod, $tpp_desc, $tpp_prep, $tpp_udn){
		$sql		=	"INSERT INTO tipo_presupuesto
						(ID_emp, tpp_cod, tpp_desc, tpp_prep, tpp_udn) 
						VALUES('" . $ID_emp . "','" . $tpp_cod . "','" . $tpp_desc . "','" . $tpp_prep . "','" . $tpp_udn . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function tipo_presupuesto_elim($ID_tpp){
		$sql		=	"DELETE FROM tipo_presupuesto WHERE ID_tpp='" . $ID_tpp . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA MOTIVO RECHAZO

	 function motivos_rechazo($ID_emp){
		 $sql		=	"SELECT * FROM motivos_rechazo WHERE motivos_rechazo.ID_emp='" . $ID_emp . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function insert_motivos_rechazo($ID_emp, $mot_desc){
		$sql		=	"INSERT INTO motivos_rechazo
						(ID_emp, mot_desc) 
						VALUES('" . $ID_emp . "','" . $mot_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

	 function motivos_rechazo_elim($ID_mot){
		$sql		=	"DELETE FROM motivos_rechazo WHERE ID_mot='" . $ID_mot . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////////// CONSULTAS PARA RELACION SERVICO / TIPO SERVICIO

	 function rel_sertse($ID_ser){
		 $sql		=	"SELECT * FROM rel_sertse, registro_servicio, tipo_servicio WHERE rel_sertse.ID_ser=registro_servicio.ID_ser AND rel_sertse.ID_tse=tipo_servicio.ID_tse AND rel_sertse.ID_ser='" . $ID_ser . "' ORDER BY tipo_servicio.tse_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

//////////////// CONSULTAS PARA CONTRATISTAS Y SUPERVISORES Y VENDEDORES

	 function contratistas(){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_tpu='22' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function contratistas_id($cont){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_usu='" . $cont . "' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function vendedores(){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_tpu='11' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function vendedores_id($ven){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_usu='" . $ven . "' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function contratistas_filter($cont){
		 if($cont != 0){
			 $filter	=	'ID_usu=' . $cont . '';
		 } else {
			 $filter	=	'ID_tpu="22"';
		 }
		 $sql		=	"SELECT * FROM usuarios WHERE $filter ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	function elimina_contratistas($ID_usu){
		$sql		=	"DELETE FROM usuarios WHERE ID_usu=" . $ID_usu;
		$result		=	mysql_query($sql);
		return $result;
	}

	function insert_contratistas($usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_telefono, $usu_email){
		$sql		= "INSERT INTO usuarios (usu_username, usu_password, usu_nombre, usu_apellido, usu_telefono, usu_email, ID_tpu, ID_usu_ger) VALUES('". $usu_username . "','" . $usu_password . "','" . $usu_nombre . "','" . $usu_apellido . "','" . $usu_telefono . "','" . $usu_email . "','22','68')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	function modifica_contratistas($ID_usu, $usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_telefono, $usu_email){
		$sql		= 	"UPDATE usuarios SET usu_username = '" . $usu_username . "', usu_password='" . $usu_password ."', usu_nombre ='" . $usu_nombre . "', usu_apellido='" . $usu_apellido ."', usu_telefono='" . $usu_telefono ."', usu_email='" . $usu_email . "' WHERE ID_usu = " . $ID_usu;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}

	 function valida_contratistas($ID_usu){
		 $sql		=	"SELECT * FROM resgitro_servicio WHERE ser_asig='" . $ID_usu . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function valida_contratistas2($ID_usu){
		 $sql		=	"SELECT * FROM obras WHERE obr_contfrio='" . $ID_usu . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function valida_contratistas3($ID_usu){
		 $sql		=	"SELECT * FROM obras WHERE obr_contexhib='" . $ID_usu . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function valida_contratistas4($ID_usu){
		 $sql		=	"SELECT * FROM obras WHERE obr_contcamaras='" . $ID_usu . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function supervisores(){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_tpu='5' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function supervisores_id($sup){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_usu='" . $sup . "' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function sup_cont_id($id){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_usu='" . $id . "' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function ven_id($id){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_usu='" . $id . "' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

//////////////// CONSULTAS PARA LA TABLA EQUIPOS

	 function equipos_obr_filter($ID_obr, $ID_sec, $ID_sis, $equ_cod){
		 if($ID_sec == 0){
			 $sector	=	"";
		 } else {
			 $sector	=	"AND equipos_obras.ID_sec='" . $ID_sec . "'";
		 }
		 if($ID_sis == 0){
			 $sistema	=	"";
		 } else {
			 $sistema	=	"AND equipos_obras.ID_sis='" . $ID_sis . "'";
		 }
		 if($equ_cod == ''){
			 $codigo	=	"";
		 } else {
			 $codigo	=	"AND equipos_obras.equ_cod='" . $equ_cod . "'";
		 }
		 $sql		=	"SELECT * FROM equipos_obras, obras, obras_sector, obras_sistema, tipo_equipos
		 				WHERE equipos_obras.ID_obr=obras.ID_obr AND
						equipos_obras.ID_tpe=tipo_equipos.ID_tpe AND
						equipos_obras.ID_sec=obras_sector.ID_sec AND
						equipos_obras.ID_sis=obras_sistema.ID_sis AND
						obras.ID_obr='" . $ID_obr . "'
						$sector
						$sistema
						$codigo
						ORDER BY obras_sector.sec_desc ASC, obras_sistema.sis_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 
	 function equipos_obr($ID_obr){
		 $sql		=	"SELECT * FROM equipos_obras, obras, obras_sector, obras_sistema, tipo_equipos
		 				WHERE equipos_obras.ID_obr=obras.ID_obr AND
						equipos_obras.ID_tpe=tipo_equipos.ID_tpe AND
						equipos_obras.ID_sec=obras_sector.ID_sec AND
						equipos_obras.ID_sis=obras_sistema.ID_sis AND
						obras.ID_obr='" . $ID_obr . "'
						ORDER BY obras_sector.sec_desc ASC, obras_sistema.sis_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function equipos_id($ID_equ){
		 $sql		=	"SELECT * FROM equipos_obras, obras, obras_sector, obras_sistema, tipo_equipos, clientes
		 				WHERE equipos_obras.ID_obr=obras.ID_obr AND
						equipos_obras.ID_tpe=tipo_equipos.ID_tpe AND
						equipos_obras.ID_sec=obras_sector.ID_sec AND
						equipos_obras.ID_sis=obras_sistema.ID_sis AND
						obras.ID_cli=clientes.ID_cli AND
						equipos_obras.ID_equ='" . $ID_equ . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_equipos($ID_obr, $ID_sec, $ID_sis, $ID_tpe, $equ_cod, $equ_desc, $equ_detalles){
		$sql		=	"INSERT INTO equipos_obras
					 	(ID_obr, ID_sec, ID_sis, ID_tpe, equ_cod, equ_desc, equ_detalles)
						VALUES('" . $ID_obr  ."','" . $ID_sec  ."','" . $ID_sis  ."','" . $ID_tpe  ."','" . $equ_cod  ."','" . $equ_desc  ."','" . $equ_detalles  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


	function dropEquipos($ID_equ){
		$sql	=	"DELETE FROM equipos_obras
					WHERE equipos_obras.ID_equ='" . $ID_equ . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function equipos_modif($ID_equ, $ID_sec, $ID_sis, $ID_tpe, $equ_cod, $equ_desc, $equ_detalles){
		$sql		=	"UPDATE equipos_obras
						SET ID_tpe='" . $ID_tpe . "',
						ID_sec='" . $ID_sec . "',
						ID_sis='" . $ID_sis . "',
						equ_cod='" . $equ_cod . "',
						equ_desc='" . $equ_desc . "',
						equ_detalles='" . $equ_detalles . "'
						WHERE ID_equ='" . $ID_equ  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA LA TABLA TIPO EQUIPOS

	 function tipo_equipos($ID_emp){
		 $sql		=	"SELECT * FROM tipo_equipos
		 				WHERE ID_emp='" . $ID_emp . "'
		 				ORDER BY tpe_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function tipo_equipos_id($ID_tpe){
		 $sql		=	"SELECT * FROM tipo_equipos
		 				WHERE tipo_equipos.ID_tpe='" . $ID_tpe . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_tipo_equipos($ID_emp, $tpe_desc){
		$sql		=	"INSERT INTO tipo_equipos
					 	(ID_emp, tpe_desc)
						VALUES('" . $ID_emp  ."','" . $tpe_desc  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


	function dropTipoEquipos($ID_tpe){
		$sql	=	"DELETE FROM tipo_equipos
					WHERE tipo_equipos.ID_tpe='" . $ID_tpe . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function tipo_equipos_modif($ID_tpe, $tpe_desc){
		$sql		=	"UPDATE tipo_equipos
						SET tpe_desc='" . $tpe_desc . "'
						WHERE ID_tpe='" . $ID_tpe  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
//////////////// CONSULTAS PARA LA TABLA REGISTRO MTO

	 function registro_mto_equ($ID_equ){
		 $sql		=	"SELECT * FROM registro_mto, obras, equipos_obras, usuarios
		 				WHERE registro_mto.ID_obr=obras.ID_obr AND
						registro_mto.ID_equ=equipos_obras.ID_equ AND
						registro_mto.ID_usu=usuarios.ID_usu AND
						registro_mto.ID_equ='" . $ID_equ . "'
		 				ORDER BY registro_mto.mto_fecha DESC, registro_mto.mto_hora DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	 function registro_mto($ID_obr){
		 $sql		=	"SELECT * FROM registro_mto, obras, equipos_obras, usuarios
		 				WHERE registro_mto.ID_obr=obras.ID_obr AND
						registro_mto.ID_equ=equipos_obras.ID_equ AND
						registro_mto.ID_usu=usuarios.ID_usu AND
						registro_mto.ID_obr='" . $ID_obr . "'
		 				ORDER BY registro_mto.mto_fecha DESC, registro_mto.mto_hora DESC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function registro_mto_id($ID_mto){
		 $sql		=	"SELECT * FROM registro_mto, equipos_obras
		 				WHERE registro_mto.ID_equ=equipos_obras.ID_equ AND
						registro_mto.ID_mto='" . $ID_mto . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_registro_mto($ID_emp, $ID_obr, $ID_equ, $ID_usu, $mto_fecha, $mto_hora, $mto_descTareas, $mto_descRepuestos){
		$sql		=	"INSERT INTO registro_mto
					 	(ID_emp, ID_obr, ID_equ, ID_usu, mto_fecha, mto_hora, mto_descTareas, mto_descRepuestos)
						VALUES('" . $ID_emp  ."','" . $ID_obr  ."','" . $ID_equ  ."','" . $ID_usu  ."','" . $mto_fecha  ."','" . $mto_hora  ."','" . $mto_descTareas  ."','" . $mto_descRepuestos  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


	function dropRegistroMto($ID_mto){
		$sql	=	"DELETE FROM registro_mto
					WHERE registro_mto.ID_mto='" . $ID_mto . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function registro_mto_modif($ID_mto, $mto_descTareas, $mto_descRepuestos){
		$sql		=	"UPDATE registro_mto
						SET mto_descTareas='" . $mto_descTareas . "',
						mto_descRepuestos='" . $mto_descRepuestos . "'
						WHERE ID_mto='" . $ID_mto  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

//////////////// CONSULTAS PARA LA TABLA OBRAS SECTOR

	 function obras_sector($ID_obr){
		 $sql		=	"SELECT * FROM obras_sector
		 				WHERE ID_obr='" . $ID_obr . "'
		 				ORDER BY sec_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_sector_id($ID_sec){
		 $sql		=	"SELECT * FROM obras_sector
		 				WHERE obras_sector.ID_sec='" . $ID_sec . "'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_obras_sector($ID_obr, $sec_desc){
		$sql		=	"INSERT INTO obras_sector
					 	(ID_obr, sec_desc)
						VALUES('" . $ID_obr  ."','" . $sec_desc  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


	function dropObrasSector($ID_sec){
		$sql	=	"DELETE FROM obras_sector
					WHERE obras_sector.ID_sec='" . $ID_sec . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function obras_sector_modif($ID_sec, $sec_desc){
		$sql		=	"UPDATE obras_sector
						SET sec_desc='" . $sec_desc . "'
						WHERE ID_sec='" . $ID_sec  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
//////////////// CONSULTAS PARA LA TABLA OBRAS SISTEMA

	 function obras_sistema($ID_obr){
		 $sql		=	"SELECT * FROM obras_sistema, obras_sector
		 				WHERE obras_sistema.ID_obr='" . $ID_obr . "' AND
						obras_sistema.ID_sec=obras_sector.ID_sec
		 				ORDER BY sec_desc ASC, sis_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function sistemaBySec($ID_sec){
		 $sql		=	"SELECT * FROM obras_sistema, obras_sector
		 				WHERE obras_sistema.ID_sec='" . $ID_sec . "' AND
						obras_sistema.ID_sec=obras_sector.ID_sec
		 				ORDER BY sec_desc ASC, sis_desc ASC";
		 $result	=	mysql_query($sql);
		 return $result;
	 }

	 function obras_sistema_id($ID_sis){
		 $sql		=	"SELECT * FROM obras_sistema, obras_sector
		 				WHERE obras_sistema.ID_sis='" . $ID_sis . "' AND
						obras_sistema.ID_sec=obras_sector.ID_sec";
		 $result	=	mysql_query($sql);
		 return $result;
	 }
	
	function insert_obras_sistema($ID_obr, $ID_sec, $sis_desc){
		$sql		=	"INSERT INTO obras_sistema
					 	(ID_obr, ID_sec, sis_desc)
						VALUES('" . $ID_obr  ."','" . $ID_sec  ."','" . $sis_desc  ."')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}


	function dropObrasSistema($ID_sis){
		$sql	=	"DELETE FROM obras_sistema
					WHERE obras_sistema.ID_sis='" . $ID_sis . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function obras_sistema_modif($ID_sis, $ID_sec, $sis_desc){
		$sql		=	"UPDATE obras_sistema
						SET ID_sec='" . $ID_sec . "',
						sis_desc='" . $sis_desc . "'
						WHERE ID_sis='" . $ID_sis  ."'";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}

};?>