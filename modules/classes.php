
<?php
class login {
/*
*
* This class will be used to check user account and set the _SESSION variables
*
*/
	function checkLogin($username, $password, $empCod) {
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE usuarios.ID_emp=empresas.ID_emp AND
						usuarios.usu_username='" . $username . "' AND
						usuarios.usu_password='" . $password . "' AND
						empresas.emp_cod='" . $empCod . "'";
		$result		=	mysql_query($sql);
		$numResult	=	mysql_num_rows($result); 
		if($numResult != 0){
			$dataResult		=	mysql_fetch_assoc($result);
			if($dataResult['usu_habilitado'] != 0){
				$_SESSION['usuario'] 				=	$dataResult['usu_username'];
				$_SESSION['estado'] 				=	'conectado';
				$_SESSION['nombre'] 				=	$dataResult['usu_nombre'];
				$_SESSION['apellido'] 				=	$dataResult['usu_apellido'];
				$_SESSION['tipou'] 					=	$dataResult['ID_tpu'];
				$_SESSION['ID_usu']					=	$dataResult['ID_usu'];
				$_SESSION['ID_gcm']					=	$dataResult['ID_gcm'];
				$_SESSION['idu']					=	$dataResult['ID_usu'];
				$_SESSION['ID_usu_ger']				=	$dataResult['ID_usu_ger'];
				$_SESSION['usu_email']				=	$dataResult['usu_email'];
				$_SESSION['ID_emp']					=	$dataResult['ID_emp'];
				$_SESSION['usu_clave']				=	$dataResult['usu_clave'];
				$_SESSION['emp_nombre']				=	$dataResult['emp_nombre'];
				$_SESSION['usu_iniciales']			=	$dataResult['usu_iniciales'];
				$_SESSION['timeout']				=	time();

				$_SESSION['timeout']				=	time();
				header('Location: index.php');
			} else {
				header('Location: login.php?all=2');
			}
		} else {
			header('Location: login.php?all=0');
		}
	}
}

class tipo_item_forecast
{

	function dropTipoItemForecast($ID_tif)
	{
		$sql="DELETE FROM tipo_item_forecast WHERE ID_tif=".$ID_tif."";
		$result = mysql_query($sql);
		return $result;
	}
	

function UpdateTipoItemForecast($ID_tif, $tif_desc)
	{
		$sql="UPDATE tipo_item_forecast 
				SET tif_desc='".$tif_desc."'
				WHERE ID_tif=".$ID_tif."";
				$result	=	mysql_query($sql);
				return $result;
	}	


	function InsertTipoItemForecast($tif_desc)
	{
		$sql	=	"INSERT INTO tipo_item_forecast
					(tif_desc)
					VALUES('". $tif_desc . "')";
		$insert		=	mysql_query($sql);
	}
	function gettipoItemForecastByIdTif()
	{
		$sql="SELECT * FROM tipo_item_forecast WHERE ID_tif<>4 AND ID_tif<>5";
		$result	=	mysql_query($sql);
				return $result;
	
	}
		function gettipoItemForecast()
	{
		$sql="SELECT * FROM tipo_item_forecast";
		$result	=	mysql_query($sql);
				return $result;
	
	}
		function gettipoItemForecastByIdTifB($ID_tif)
	{
		$sql="SELECT * FROM tipo_item_forecast WHERE ID_tif=".$ID_tif."";
		$result	=	mysql_query($sql);
				return $result;
	
	}
}

class tipo_presupuesto
{
	function getTipoPresupuestoByTppUdn($tpp_udn)
	{
		$sql = "SELECT * FROM tipo_presupuesto
				 WHERE tpp_udn='".$tpp_udn."'";
				 $result	=	mysql_query($sql);
				return $result;
	}

		function getTipoPresupuestoByIdTpp($ID_tpp)
	{
		$sql = "SELECT * FROM tipo_presupuesto
				 WHERE ID_tpp='".$ID_tpp."'";
				 $result	=	mysql_query($sql);
				return $result;
	}


}



class forecast
{
	function updateForecastByIdPto($ID_pto, $pto_fecForecast)
	{
		$fecha=$pto_fecForecast;

		$year=explode("-",$fecha);
		$fct_year = $year[0];

		$periodo=explode("-",$fecha);
		echo $fct_periodo = $periodo[1];

		$sql="UPDATE forecast 
				SET fct_periodo=".$fct_periodo.",
				fct_year=".$fct_year."
				WHERE ID_pto=".$ID_pto."";
				$result	=	mysql_query($sql);
				return $result;
	}	

	function forecastContenidoTabla($ID_itf)
	{
		$sumador                          = 0;
        $sumadorB                         = 0;

        $forecast = new forecast;
		$forecastGroupByitemFechaD=$forecast->forecastGroupByitemFecha();
        $num_forecastGroupByitemFechaD=mysql_num_rows($forecastGroupByitemFechaD);

			for ($forD=0; $forD < $num_forecastGroupByitemFechaD; $forD++) 
                { 
                    $assoc_forecastGroupByitemFechaD=mysql_fetch_assoc($forecastGroupByitemFechaD);
                    echo " <th style='text-align: center;'>";
                    $fct_periodo=$fct_periodo=$assoc_forecastGroupByitemFechaD['fct_periodo'];
                    $fct_year=$fct_year=$assoc_forecastGroupByitemFechaD['fct_year'];
                                       
						$sqlB="SELECT DISTINCT sum(forecast.fct_cantidad)suma FROM forecast, item_forecast, quotations
						WHERE forecast.ID_itf=item_forecast.ID_itf AND
						quotations.ID_pto=forecast.ID_pto AND
						item_forecast.ID_tif<>4 AND
						item_forecast.ID_itf=".$ID_itf." AND 
						forecast.fct_periodo=".$fct_periodo." AND 
						forecast.fct_year=".$fct_year." AND 
						(quotations.ID_sta=28 OR quotations.ID_sta=29 OR quotations.ID_sta=30 OR quotations.ID_sta=31) AND quotations.pto_vendedor='28'
						GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf";
						   $result	=	mysql_query($sqlB);
						   $assoc_result =mysql_fetch_assoc($result);

							echo "<form action='actions-quotation-ne.php' method='post' enctype='multipart/form-data'>";

							$sqlC="SELECT * FROM forecast, item_forecast, quotations 
							WHERE forecast.ID_itf=item_forecast.ID_itf AND
							 quotations.ID_pto=forecast.ID_pto AND 
							 item_forecast.ID_tif<>4 AND
							  item_forecast.ID_itf=".$ID_itf." AND
							   forecast.fct_periodo=".$fct_periodo." AND 
							   forecast.fct_year=".$fct_year." AND 
							   (quotations.ID_sta=28 OR
							    quotations.ID_sta=29 OR
							     quotations.ID_sta=30 OR
							      quotations.ID_sta=31)
							        GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf";
							   $resultC	=	mysql_query($sqlC);
						   $assoc_resultC =mysql_fetch_assoc($resultC);
						   $fct_validado=$assoc_resultC['fct_validado'];
                               
                                if($assoc_result['suma']!=0)
                                {
                                	if ($fct_validado!=0)
                                	 {	
                                		echo "<div style='float:right; margin-right: 50%; vertical-align: middle'>".$assoc_result['suma']."</div>";
                                		
                                		echo "<div style='float:left;'>
                                				<i class='material-icons' style='vertical-align: middle;'>done_all</i> Validado
                                				</div>";
                                	 }
                                	 else
                                	 {
                                	 		$colorFondo = "#A9E2F3";
				                            $icono      = "done";
				                            $texto = "Validar";
				                            echo "<input type='number' class='form-control'  value='".$assoc_result['suma']."' name='fct_cantidad'  id='fct_cantidadA".$fct_periodo."".$ID_itf."' style='background-color: ".$colorFondo."'>
		                                <input hidden type='text' name='ID_itf' value='".$ID_itf."'>
		                                <input hidden type='text' name='fct_periodo' value='".$fct_periodo."'>
		                                <input hidden type='text' name='fct_year' value='".$fct_year."'>
		                                <input hidden type='text' name='action' value='validarForecast'>";
		                                echo "<button class='btn btn-default' type='submit' style='margin-top:1px; width: 100%; background-color: ".$colorFondo."; display: none;' id='botonGuardarA".$fct_periodo."".$ID_itf."' name='botonGuardarA".$fct_periodo."".$ID_itf."'>
		                                  <i class='material-icons' style='vertical-align: middle'>
		                                    ".$icono."
		                                  </i> ".$texto."
		                                </button>";

		                                        echo '<script type="text/javascript">
                                    $("#fct_cantidadA'.$fct_periodo.''.$ID_itf.'").click(function()
                                    {
                                      $("#botonGuardarA'.$fct_periodo.''.$ID_itf.'").fadeIn(500);
                                      $("#fct_cantidadA'.$fct_periodo.''.$ID_itf.'").focusout(function()
                                    {
                                      $("#botonGuardarA'.$fct_periodo.''.$ID_itf.'").fadeOut(500);
                                    });
                                    });
                                  </script>'; 
                                	 }	
                                	
                                }
                                else
                                {

                                }	

                              echo "</form>";


                                           echo " </th>"; 	

                                      

                                        }

                                         return;
		}

		function forecastGroupByitemFecha()
	{
			$sql="SELECT DISTINCT  forecast.fct_periodo, forecast.fct_year FROM forecast, item_forecast, quotations WHERE forecast.ID_itf=item_forecast.ID_itf AND quotations.ID_pto=forecast.ID_pto AND item_forecast.ID_tif<>4 AND (quotations.ID_sta=28 OR quotations.ID_sta=29 OR quotations.ID_sta=30 OR quotations.ID_sta=31 OR quotations.ID_sta=25) GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf";
			$result	=	mysql_query($sql);
			return $result;
	}

			function forecastGroupByitemContenido($ID_itf)
	{
			$sql="SELECT DISTINCT  forecast.fct_periodo, forecast.fct_year FROM forecast, item_forecast, quotations 
			WHERE forecast.ID_itf=item_forecast.ID_itf AND 
			quotations.ID_pto=forecast.ID_pto AND
			 item_forecast.ID_tif<>4 AND
			 forecast.ID_itf=".$ID_itf." AND
			  (quotations.ID_sta=28 OR
			   quotations.ID_sta=29 OR
			    quotations.ID_sta=30 OR
			     quotations.ID_sta=31 OR 
			     quotations.ID_sta=25) 
			     GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf ";
			$result	=	mysql_query($sql);
			return $result;
	}


	function forecastGroupByitem()
	{
			$sql="SELECT DISTINCT item_forecast.itf_desc, forecast.ID_itf  FROM forecast, item_forecast, quotations WHERE forecast.ID_itf=item_forecast.ID_itf AND quotations.ID_pto=forecast.ID_pto AND item_forecast.ID_tif<>4 AND (quotations.ID_sta=28 OR quotations.ID_sta=29 OR quotations.ID_sta=30 OR quotations.ID_sta=31 OR quotations.ID_sta=25) GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf";
			$result	=	mysql_query($sql);
			return $result;
	}

	function forecastGroupBysumitem($ID_itf)
	{
				$sql="SELECT DISTINCT sum(forecast.fct_cantidad) FROM forecast, item_forecast, quotations
				WHERE forecast.ID_itf=item_forecast.ID_itf AND
				quotations.ID_pto=forecast.ID_pto AND
				item_forecast.ID_tif<>4 AND
				item_forecast.ID_itf=".$ID_itf." AND 
				(quotations.ID_sta=28 OR quotations.ID_sta=29 OR quotations.ID_sta=30 OR quotations.ID_sta=31 OR quotations.ID_sta=25)
				GROUP BY forecast.fct_year, forecast.fct_periodo, forecast.ID_itf";
				$result	=	mysql_query($sql);
				return $result;
	}

	function getForecastIdPtoVacio()
	{
		$sql = "SELECT * FROM forecast WHERE ID_pto=0";
		$result	=	mysql_query($sql);
			return $result;
	}

	function updateForecast($ID_itf, $fct_cantidad, $fct_periodo, $fct_year)
	{
			$sql	=	"UPDATE forecast
					SET fct_cantidad='".$fct_cantidad."'
					WHERE fct_periodo='" . $fct_periodo . "' AND fct_year='" . $fct_year . "' AND ID_itf='" . $ID_itf . "' AND ID_pto='0'";
		$result	=	mysql_query($sql);
	}

	function updateValidadoForecast($ID_itf, $fct_cantidad, $fct_periodo, $fct_year, $fct_validado)
	{
			$sql	=	"UPDATE forecast
					SET fct_validado='".$fct_validado."'
					WHERE fct_periodo='" . $fct_periodo . "' AND fct_year='" . $fct_year . "' AND ID_itf='" . $ID_itf . "' AND ID_pto<>'0'";
		$result	=	mysql_query($sql);
	}
	

	function insertForecast($ID_pto, $ID_itf, $fct_cantidad, $fct_periodo, $fct_year)
	{
		$sql	=	"INSERT INTO forecast
					(ID_pto, ID_itf, fct_cantidad, fct_periodo, fct_year)
					VALUES('". $ID_pto . "','" . $ID_itf . "','" . $fct_cantidad . "','" . $fct_periodo . "','" . $fct_year . "')";
		$insert		=	mysql_query($sql);
	}

	function insertForecastSinIdPto($ID_itf, $fct_cantidad, $fct_periodo, $fct_year)
	{
		$sql	=	"INSERT INTO forecast
					(ID_itf, fct_cantidad, fct_periodo, fct_year)
					VALUES('" . $ID_itf . "','" . $fct_cantidad . "','" . $fct_periodo . "','" . $fct_year . "')";
		$insert		=	mysql_query($sql);
	}

	function getForecastbyId()
	{
		$sql = "SELECT * FROM forecast";
		$result	=	mysql_query($sql);
		return $result;
	}

		function getForecastbyIdItf($ID_itf, $fct_periodo, $fct_year)
	{
		$sql = "SELECT * FROM forecast
		WHERE ID_itf=".$ID_itf." AND fct_periodo=".$fct_periodo." AND fct_year=".$fct_year." AND ID_pto<>'0'";
		$result	=	mysql_query($sql);
		return $result;
	}

	function getForecastbyIdItfSinPto($ID_itf, $fct_periodo, $fct_year)
	{
		$sql = "SELECT * FROM forecast
		WHERE ID_itf=".$ID_itf." AND fct_periodo=".$fct_periodo." AND fct_year=".$fct_year." AND ID_pto='0'";
		$result	=	mysql_query($sql);
		return $result;
	}

	//Recibe: year actual y mes acual
	//Busca: todos los meses (periodos) donde el year sea igual al year actual y los meses (periodos) sean mayores al mes actual
	function getForecastYearActual($fct_yearActual, $fct_periodoActual)
	{
		$sql = "SELECT DISTINCT fct_periodo, fct_year FROM forecast, item_forecast
				 WHERE forecast.ID_itf=item_forecast.ID_itf AND fct_year=".$fct_yearActual." AND ID_tif<>4 AND fct_periodo>=".$fct_periodoActual." ORDER BY fct_periodo ASC";
		$result	=	mysql_query($sql);
		return $result;
	}

	//Recibe: year actual
	//Busca: todos los meses (periodos) y year donde el year sea mayor al year actual ordenado asendentemente por periodos
	function getForecastPeriodos($fct_yearActual)
	{
		$sql = "SELECT DISTINCT fct_periodo,fct_year FROM forecast WHERE fct_year>".$fct_yearActual." ORDER BY fct_year, fct_periodo ASC";
		$result	=	mysql_query($sql);
		return $result;
	}

		//Recibe: year actual
	//Busca: todos los year donde el year sea mayor al year actual ordenado asendentemente 
	function getForecastYear($fct_yearActual)
	{
		$sql = "SELECT DISTINCT fct_year FROM forecast WHERE fct_year>".$fct_yearActual." ORDER BY fct_year ASC";
		$result	=	mysql_query($sql);
		return $result;
	}
	//Recibe: year
	//Busca: todos los periodos donde year es igual a year
	function getForecastSoloYear($fct_year)
	{
		$sql = "SELECT DISTINCT fct_periodo FROM forecast WHERE fct_year=".$fct_year." ";
		$result	=	mysql_query($sql);
		return $result;
	}


}


class item_forecast
{

		function dropItemForecast($ID_itf)
	{
	    $sql	=	"DELETE FROM item_forecast
					WHERE ID_itf='" . $ID_itf . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

function updateItemForecast($ID_itf, $ID_tif, $itf_desc, $itf_um)
	{
			$sql	=	"UPDATE item_forecast
					SET ID_tif='".$ID_tif."',
					itf_desc=		'".$itf_desc."',
					itf_um=			'".$itf_um."'
					WHERE ID_itf='" . $ID_itf . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function insertItemForecast($ID_tif, $itf_desc, $itf_um)
	{
		$sql = "INSERT INTO item_forecast
				(ID_tif, itf_desc, itf_um) VALUES ('".$ID_tif."', '".$itf_desc."', '".$itf_um."')";
				$result = mysql_query($sql);
				return mysql_affected_rows();
	}

  

	function getitemForecast()
	{
		$sql = "SELECT * FROM item_forecast, forecast 
				where item_forecast.ID_itf=forecast.ID_itf 
				GROUP BY itf_desc ORDER BY itf_desc asc";
		$result				=	mysql_query($sql);
		return $result;

	}


	function getitemForecastB()
	{
		$sql = "SELECT * FROM item_forecast";
		$result				=	mysql_query($sql);
		return $result;

	}

	function getitemForecastTodos($ID_tif)
	{
		$sql = "SELECT * FROM item_forecast WHERE ID_tif=".$ID_tif." ORDER BY ID_tif asc";
		$result				=	mysql_query($sql);
		return $result;

	}

	function forGetItemForescast($ID_pto)
	{
		$sql 			= "SELECT * FROM item_forecast";
		$result			= mysql_query($sql);
		$num_result     = mysql_num_rows($result);
        $contador		= 0;

        		echo "<ul >";
			 	   for ($xx=0; $xx<$num_result; $xx++)
                   { 
                    $assoc_getitemForecast = mysql_fetch_assoc($result);

					echo "<li  style='list-style-type: disc;'><h5><strong>".$assoc_getitemForecast['itf_desc']."</strong></h5>
					     <input hidden type='text' name='array[".$xx."][0]' value='".$assoc_getitemForecast['ID_itf']."'>
					 	 <input class='form-control' type='number' name='array[".$xx."][1]' placeholder='Cantidad...'>";
					    		
						$sqlB   	 =  "SELECT * FROM item_forecast WHERE itf_relacionado=".$assoc_getitemForecast['ID_itf']."";
						$resultB	 =	mysql_query($sqlB);
						$num_resultB =	mysql_num_rows($resultB);
						if($num_resultB!=0)
						{
						echo "<ol>";
						$contador=$contador+1;

			                for ($yy=0; $yy < $num_resultB; $yy++)
			                { 
			                $assoc_resultB = mysql_fetch_assoc($resultB);
			                            				
			                echo "<li style='list-style-type: circle;'><h6>".$assoc_resultB['itf_desc']."</h6>
			                     <input hidden type='text' name='array".$contador."[".$yy."][0]' value='".$assoc_resultB['ID_itf']."'>
			                     <input  name='array".$contador."[".$yy."][1]' placeholder='Cantidad' class='form-control'></li>";
			                }
					 	echo "<input type='hidden' name='arraycontador[".$contador."]' value='arraycontador[".$contador."]'>";
						echo "</ol>";
                        }
                   echo "</li>";
                   }
	  			echo "</ul>"; 
                  
	}

}

class menu {
/*
*
* This class is used to construct the menu for each system based on the user permissions
*
*/
	function getModulosBySistema($sis_cod, $ID_usu){
		$sql	=	"SELECT * FROM sistemas, modulos, formularios, permisos WHERE sistemas.ID_sis=modulos.ID_sis AND
					modulos.ID_mod=formularios.ID_mod AND
					formularios.ID_for=permisos.ID_for AND
					sistemas.sis_cod='" . $sis_cod . "' AND
					permisos.ID_usu='" . $ID_usu . "'
					GROUP BY modulos.ID_mod
					ORDER BY modulos.mod_prioridad ASC";
		$result				=	mysql_query($sql);
		$this->modBySisRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosByModulos($ID_mod){
		$sql	=	"SELECT * FROM formularios
					WHERE for_muestra='1' AND
					ID_sub='5' AND
					ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		$this->forByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function getSubmodulosByModulos($ID_mod){
		$sql	=	"SELECT * FROM submodulos
					WHERE ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		$this->subByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosBySubmodulos($ID_sub){
		$sql	=	"SELECT * FROM formularios, submodulos
					WHERE formularios.for_muestra='1' AND
					submodulos.sub_muestra='1' AND
					ID_sub='" . $ID_sub . "'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
}

class gerencias_comerciales
{
	function getGerencias_comerciales($ID_emp)
	{
		$sql = "SELECT * FROM gerencias_comerciales WHERE ID_emp = ".$ID_emp."";
		$result = mysql_query($sql);
				return $result;
	}

		function getGerencias_comercialesBYId($ID_gcm)
	{
		$sql = "SELECT * FROM gerencias_comerciales WHERE ID_gcm = ".$ID_gcm."";
		$result = mysql_query($sql);
				return $result;
	}

			function getGerencias_comercialesBYIdUsuB($ID_usu)
	{
		$sql = "SELECT * FROM gerencias_comerciales WHERE ID_usu = ".$ID_usu."";
		$result = mysql_query($sql);
				return $result;
	}


		function getGerencias_comercialesBYIdUsu($ID_gcm)
	{
		$sql = "SELECT * FROM gerencias_comerciales, usuarios WHERE gerencias_comerciales.ID_usu = usuarios.ID_usu AND gerencias_comerciales.ID_gcm = ".$ID_gcm."";
		$result = mysql_query($sql);
				return $result;
	}


	function insert_gerencias_comerciales()
	{
		$sql = "INSERT INTO gerencias_comerciales
				(ID_usu, gcm_desc, ID_emp) VALUES ('".$ID_usu."', '".$gcm_desc."', '".$ID_emp."')";
				$result = mysql_query($sql);
				return mysql_affected_rows();
	}

	function insertGerencias_comerciales($ID_usu, $gcm_desc)
	{
		$ID_emp=1;
		$sql = "INSERT INTO gerencias_comerciales
				(ID_usu, gcm_desc, ID_emp) VALUES ('".$ID_usu."', '".$gcm_desc."', '".$ID_emp."')";
				$result = mysql_query($sql);
				return mysql_affected_rows();
	}


	function  updateGerencias_comerciales($ID_gcm, $ID_usu, $gcm_desc)
	{
		$sql	=	"UPDATE gerencias_comerciales
					SET ID_usu='".$ID_usu."',
					gcm_desc='".$gcm_desc."'
					WHERE ID_gcm='" . $ID_gcm . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function dropGerencias_comerciales($ID_gcm)
	{
	    $sql	=	"DELETE FROM gerencias_comerciales
					WHERE ID_gcm='" . $ID_gcm . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


}

class budget_ventas
{


	

	function optionsBudgetVentas($num_getGerencias_comerciales, $getGerencias_comerciales)
	{	
			  $ID_emp                         = $_SESSION['ID_emp'];
  $gerencias_comerciales          = new gerencias_comerciales;
			  $getGerencias_comerciales       = $gerencias_comerciales->getGerencias_comerciales($ID_emp);
		  $num_getGerencias_comerciales   = mysql_num_rows($getGerencias_comerciales);
		 for ($xv=0; $xv < $num_getGerencias_comerciales; $xv++)
                         { 
                          $assoc_getGerencias_comerciales = mysql_fetch_assoc($getGerencias_comerciales);
                          echo "<option value='".$assoc_getGerencias_comerciales['ID_gcm']."'>".$assoc_getGerencias_comerciales['gcm_desc']."</option>";
                         }
                         return;
	
	   
	}


	function insertBudgetVentas($ID_gcm, $bdg_year, $bdg_monto, $bdg_tpc, $ID_tmo)
	{

		$sqlB = "SELECT * FROM budget_ventas 
				WHERE ID_gcm=$ID_gcm AND
				bdg_year=$bdg_year";
		$resultB = mysql_query($sqlB);
		$num_resultB = mysql_num_rows($resultB);

		 if ($num_resultB<1)
		  {
			$sql = "INSERT INTO budget_ventas
			(ID_gcm, bdg_year, bdg_monto, bdg_tpc, ID_tmo) VALUES ('".$ID_gcm."', '".$bdg_year."', '".$bdg_monto."', '".$bdg_tpc."', '".$ID_tmo."')";
			$result = mysql_query($sql);
			return 1;
		  }
		 else
		 {
		 	return 16;
		 }
		
	}

	function getBudgetVentas()
	{
		$sql = "SELECT * FROM budget_ventas, gerencias_comerciales 
				WHERE budget_ventas.ID_gcm=gerencias_comerciales.ID_gcm ORDER BY bdg_year DESC";
		$result = mysql_query($sql);
		return $result;	
	}

	function getBudgetVentasByYearByIdGcm($ID_gcm)
	{
		$fecha=date("Y");
		$sql = "SELECT *, (bdg_monto/bdg_tpc) AS montoB FROM budget_ventas WHERE budget_ventas.bdg_year='".$fecha."' AND budget_ventas.ID_gcm=".$ID_gcm." ORDER BY bdg_year ASC";
		$result = mysql_query($sql);
		return $result;	
	}
		function getBudgetVentasByYear()
	{
		$fecha=date("Y");
		$sql = "SELECT sum(bdg_monto/bdg_tpc) AS montoB FROM budget_ventas WHERE budget_ventas.bdg_year='".$fecha."' ORDER BY bdg_year ASC";
		$result = mysql_query($sql);
		return $result;	
	}

	function updateBudgetVentas($ID_bdg, $ID_gcm, $bdg_year, $bdg_monto, $bdg_tpc, $ID_tmo)
	{
		$sql	=	"UPDATE budget_ventas
					SET ID_gcm='".$ID_gcm."',
					bdg_year='".$bdg_year."',
					bdg_monto='".$bdg_monto."',
					bdg_tpc='".$bdg_tpc."',
					ID_tmo='".$ID_tmo."'
					WHERE ID_bdg='" . $ID_bdg . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function dropBudgetVentas($ID_bdg)
	{
	    $sql	=	"DELETE FROM budget_ventas
					WHERE ID_bdg='" . $ID_bdg . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	
}



class quotations
{
	function GetquotationsBySerCod($ser_cod)
	{
		$sql 			="SELECT * FROM quotations WHERE ser_cod='".$ser_cod."'";
		$result			= mysql_query($sql);
		return 			$result;
	}
	function GetquotationsByPtoPedidoCod($pto_pedidoCod)
	{
		$sql 			="SELECT * FROM quotations WHERE pto_pedidoCod='".$pto_pedidoCod."'";
		$result			= mysql_query($sql);
		return 			$result;
	}

	function getQuotationsByIdFic($ID_pto)
	{
		$sql 			='SELECT * FROM quotations, quotations_fic WHERE quotations.ID_fic = quotations_fic.ID_fic AND ID_pto='.$ID_pto.'';
		$result			= mysql_query($sql);
		return 			$result;
	}


	function getQuotationsByGc($ID_gcm, $ID_sta)
	{
		$sql 			= "SELECT ID_usu FROM gerencias_comerciales WHERE ID_gcm=".$ID_gcm."";
		$result 		= mysql_query($sql);
		$assoc_result 	= mysql_fetch_assoc($result);
		$ID_usu			= $assoc_result['ID_usu'];
		$sql2 			= "SELECT *,(pto_montoPresupuesto/tipoCambioPres) AS montoP, (pto_montoOV/tipoCambioVenta) AS montoV  FROM quotations, usuarios where quotations.ID_usu=usuarios.ID_usu AND (quotations.ID_usu=".$ID_usu." or usuarios.ID_usu_ger=".$ID_usu.") AND quotations.ID_sta=".$ID_sta."";
		$result2 		= mysql_query($sql2);
		return 			$result2;

	
	}
	function getQuotationsTotalidad($ID_sta)
	{
	
		
		$sql2 			= "SELECT SUM(pto_montoPresupuesto/tipoCambioPres) AS montoP, SUM(pto_montoOV/tipoCambioVenta) AS montoV FROM quotations where quotations.ID_sta=".$ID_sta."";
		$result2 		= mysql_query($sql2);
		return 			$result2;

	
	}

	function getQuotationsByIdSta($ID_sta)
	{
		$sql 			= "SELECT * FROM quotations WHERE ID_sta=".$ID_sta."";
		$result 		= mysql_query($sql);
		
		return 			$result;

	
	}

	function getQuotations($ID_pto)
	{
		$sql = "SELECT * FROM quotations, empresas, clientes, obras, usuarios, status, competidores, tipo_moneda WHERE quotations.ID_emp = empresas.ID_emp AND quotations.ID_cli = clientes.ID_cli AND quotations.ID_obr = obras.ID_obr AND quotations.ID_usu = usuarios.ID_usu AND quotations.ID_sta = status.ID_sta AND quotations.ID_com = competidores.ID_com AND quotations.ID_tipoMonedaVenta = tipo_moneda.ID_tmo AND quotations.ID_pto='".$ID_pto."'";
		$result = mysql_query($sql);
				return $result;
	}


     function getQuotationsModifyAS($ID_pto)
	{
		$sql = "SELECT * FROM quotations, tipo_presupuesto, usuarios, prioridades WHERE quotations.ID_tpp = tipo_presupuesto.ID_tpp AND quotations.ID_pri = prioridades.ID_pri AND quotations.ID_usu = usuarios.ID_usu AND quotations.ID_pto='".$ID_pto."'";
		$result = mysql_query($sql);
				return $result;
	}

	function getQuotationsUsuarios()
	{
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu, quotations.pto_vendedor   FROM quotations, usuarios WHERE  quotations.ID_usu=usuarios.ID_usu ";
				$result = mysql_query($sql);
				return $result;
	}

	function getQuotationsUsuariosVendedorDirection()
	{
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu, quotations.pto_vendedor   FROM quotations, usuarios WHERE  quotations.pto_vendedor=usuarios.ID_usu ";
				$result = mysql_query($sql);
				return $result;
	}

		function getQuotationsUsuariosHistorialNE()
	{
		$sql = "SELECT DISTINCT usuarios.ID_usu, usuarios.usu_apellido, usuarios.usu_nombre FROM quotations, usuarios WHERE quotations.ID_usu=usuarios.ID_usu  AND ID_tpp=6 order by usuarios.usu_apellido ASC";
				$result = mysql_query($sql);
				return $result;
	}

		function getQuotationsAsignadosHistorialNE()
	{
		$sql = "SELECT DISTINCT usuarios.ID_usu, usuarios.usu_apellido, usuarios.usu_nombre FROM quotations, usuarios WHERE quotations.pto_asignado=usuarios.ID_usu AND ID_tpp=6 order by usuarios.usu_apellido ASC";
				$result = mysql_query($sql);
				return $result;
	}

		function getQuotationsVendedoresHistorialNE()
	{
		$sql = "SELECT DISTINCT usuarios.ID_usu, usuarios.usu_apellido, usuarios.usu_nombre FROM quotations, usuarios WHERE quotations.pto_vendedor=usuarios.ID_usu AND ID_tpp=6 order by usuarios.usu_apellido ASC";
				$result = mysql_query($sql);
				return $result;
	}
		function getQuotationsUsuariosHistorialAS()
	{
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu FROM quotations, usuarios WHERE quotations.ID_usu=usuarios.ID_usu AND ID_tpp!=6 ORDER BY usuarios.usu_apellido ASC";
				$result = mysql_query($sql);
				return $result;
	}
		function getQuotationsAsignadosHistorialAS()
	{
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.pto_asignado FROM quotations, usuarios WHERE quotations.pto_asignado=usuarios.ID_usu AND ID_tpp!=6 ORDER BY usuarios.usu_apellido ASC";
				$result = mysql_query($sql);
				return $result;
	}
			function getQuotationsUsuariosHistorialASDia()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu FROM quotations, usuarios WHERE quotations.ID_usu=usuarios.ID_usu AND quotations.ID_cli=".$ID_cli." AND ID_tpp!=6";
				$result = mysql_query($sql);
				return $result;
	}

		function getQuotationsUsuariosSales($ID_usu)
	{
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu  FROM quotations, usuarios WHERE quotations.ID_usu=usuarios.ID_usu AND quotations.ID_usu=".$ID_usu."";
				$result = mysql_query($sql);
				return $result;
	}

			function getQuotationsAsignadosSales($ID_usu)
	{
		$sql = "SELECT DISTINCT quotations.pto_asignado, usuarios.usu_nombre, usuarios.usu_apellido FROM quotations, usuarios where quotations.pto_asignado=usuarios.ID_usu AND  (quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")";
				$result = mysql_query($sql);
				return $result;
	}

			function getQuotationsUsuariosManager($ID_gcm)
	{
		$ID_usu=$_SESSION['ID_usu'];
		$sql = "SELECT DISTINCT usuarios.usu_apellido, usuarios.usu_nombre, quotations.ID_usu FROM quotations, usuarios Where usuarios.ID_usu=quotations.ID_usu AND quotations.ID_gcm=
		".$ID_gcm." ORDER BY `ID_pto` DESC";
				$result = mysql_query($sql);
				return $result;
	}
		
	function getQuotationsClientes()
	{
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes WHERE quotations.ID_cli=clientes.ID_cli";
				$result = mysql_query($sql);
				return $result;
	}
		function getQuotationsClientesHistorialNE()
	{
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes WHERE quotations.ID_cli=clientes.ID_cli AND ID_tpp=6";
				$result = mysql_query($sql);
				return $result;
	}
		function getQuotationsClientesHistorialAS()
	{
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes WHERE quotations.ID_cli=clientes.ID_cli AND ID_tpp!=6 ORDER BY clientes.cli_desc ASC";
				$result = mysql_query($sql);
				return $result;
	}

			function getQuotationsClientesHistorialASDia()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes WHERE quotations.ID_cli=clientes.ID_cli AND quotations.ID_cli=".$ID_cli." AND ID_tpp!=6";
				$result = mysql_query($sql);
				return $result;
	}
		function getQuotationsClientesSales($ID_usu)
	{
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes WHERE quotations.ID_cli=clientes.ID_cli  AND (quotations.pto_vendedor=".$ID_usu." or quotations.ID_usu=".$ID_usu.")";
				$result = mysql_query($sql);
				return $result;
	}

			function getQuotationsClientesManager($ID_gcm)
	{
			$ID_usu=$_SESSION['ID_usu'];
		$sql = "SELECT DISTINCT clientes.cli_desc, quotations.ID_cli FROM quotations, clientes, usuarios WHERE usuarios.ID_usu=quotations.ID_usu AND quotations.ID_cli=clientes.ID_cli  AND quotations.ID_gcm=".$ID_gcm." ";
				$result = mysql_query($sql);
				return $result;
	}


		function getQuotationsStatus()
	{
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status WHERE quotations.ID_sta=status.ID_sta AND status.ser_tipo=3";
				$result = mysql_query($sql);
				return $result;
	}
			function getQuotationsStatusHistorialAS()
	{
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status WHERE quotations.ID_sta=status.ID_sta AND status.ser_tipo=2 AND quotations.ID_tpp!=6";
				$result = mysql_query($sql);
				return $result;
	}
				function getQuotationsStatusHistorialASdDia()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status WHERE quotations.ID_sta=status.ID_sta AND status.ser_tipo=2 AND quotations.ID_cli=".$ID_cli." AND quotations.ID_tpp!=6";
				$result = mysql_query($sql);
				return $result;
	}
			function getQuotationsStatusHistorialNE()
	{
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status WHERE quotations.ID_sta=status.ID_sta AND status.ser_tipo=3 AND quotations.ID_tpp=6";
				$result = mysql_query($sql);
				return $result;
	}

			function getQuotationsStatusSales($ID_usu)
	{
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status WHERE quotations.ID_sta=status.ID_sta AND status.ser_tipo=3 AND (quotations.pto_vendedor=".$ID_usu." or quotations.ID_usu=".$ID_usu.")";
				$result = mysql_query($sql);
				return $result;
	}
				function getQuotationsStatusManager($ID_gcm)
	{
			$ID_usu=$_SESSION['ID_usu'];
		$sql = "SELECT DISTINCT status.sta_desc, quotations.ID_sta FROM quotations, status, usuarios WHERE usuarios.ID_usu=quotations.ID_usu AND quotations.ID_sta=status.ID_sta AND status.ser_tipo=3 AND quotations.ID_gcm=".$ID_gcm."";
				$result = mysql_query($sql);
				return $result;
	}



			function getQuotationsTiendasByIdCli($ID_cli)
	{
		$sql = "SELECT DISTINCT obras.obr_desc, quotations.ID_obr FROM quotations, obras WHERE quotations.ID_obr=obras.ID_obr AND quotations.ID_cli=".$ID_cli." ORDER BY obras.obr_desc ASC";
				$result = mysql_query($sql);
				return $result;
	}

	function getQuotationNextId(){
		 $sql		=	"SELECT AUTO_INCREMENT AS NEXTID 
		 				FROM information_schema.tables 
		 				WHERE table_name='quotations' AND 
		 				table_schema='travel_expenses'";
		 $result	=	mysql_query($sql);
		 return $result;
	}
	function getQuotationsInserted()
	{
		   
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso  
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6'  AND
					(quotations.ID_sta='22' || quotations.ID_sta='37') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr	
					ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationsInsertedAS()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}


	  function getQuotationsInsertedASAjax($inicioAbierto)
	  {
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND 
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr order by ID_pto desc limit 0, ".$inicioAbierto."";
			$result				=	mysql_query($sql);
			return $result;
		}

		function getQuotationsInsertedASAjaxUsu($ID_usu, $inicioAbierto)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') order by quotations.ID_pto desc limit 0, ".$inicioAbierto."";
			$result				=	mysql_query($sql);
			return $result;

		}


		

		function getQuotationsInsertedASAjaxById($inicioAbierto, $ID_buscadorAbierto)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		obras.ID_obr='".$ID_buscadorAbierto."'
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

	

			function getQuotationsInsertedASAjaxByIdUsu($ID_usu, $inicioAbierto, $ID_buscadorAbierto)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND 
				 		obras.ID_obr='".$ID_buscadorAbierto."' 
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsInsertedASAjaxByIdCodigo($inicioAbierto, $ID_codigoAbierto)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' or quotations.ID_sta='23' or quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_pedidoCod=".$ID_codigoAbierto."
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

				function getQuotationsInsertedASAjaxByIdCliente($inicioAbierto, $ID_clienteAbierto)
		{
			$ID_clienteAbierto=str_replace(' ', '',$ID_clienteAbierto);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.ID_cli=".$ID_clienteAbierto."
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

			function getQuotationsInsertedASAjaxByIdAsignado($inicioAbierto, $ID_asignadoAbierto)
		{
			
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_asignado=".$ID_asignadoAbierto."
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

			function getQuotationsInsertedASAjaxByIdCodigoUsu($ID_usu, $inicioAbierto, $ID_codigoAbierto)
		{
			$ID_codigoAbierto=str_replace(' ', '',$ID_codigoAbierto);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND
				 		quotations.pto_pedidoCod='".$ID_codigoAbierto."'
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsInsertedASAjaxByIdClienteUsu($ID_usu, $inicioAbierto, $ID_clienteAbierto)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND
				 		quotations.ID_cli='".$ID_clienteAbierto."'
			order by ID_pto desc limit 0, ".$inicioAbierto."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

	function getQuotationsInsertedASIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		(quotations.ID_sta='12' || quotations.ID_sta='23' || quotations.ID_sta='17')	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."')
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	

		function getQuotationsInsertedASManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='12' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	

			function getQuotationsAceptedAS()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationsAceptedASIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND (quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."')
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	function getQuotationsAceptedASAjax($inicioAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsAceptedASAjaxUsu($ID_usu, $inicioAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND quotations.pto_asignado='".$ID_usu."' order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;


		}


		function getQuotationsAceptedASAjaxById($inicioAccepted, $ID_buscadorAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		obras.ID_obr=".$ID_buscadorAccepted."
			order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsAceptedASAjaxByIdUsu($ID_usu, $inicioAccepted, $ID_buscadorAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		obras.ID_obr='".$ID_buscadorAccepted."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}
			function getQuotationsAceptedASAjaxByIdCodigo($inicioAccepted, $ID_codigoAccepted)
		{
			$ID_codigoAccepted=str_replace(' ', '',$ID_codigoAccepted);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.pto_pedidoCod='".$ID_codigoAccepted."'
			order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsAceptedASAjaxByIdCliente($inicioAccepted, $ID_clienteAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_cli='".$ID_clienteAccepted."'
			order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

				function getQuotationsAceptedASAjaxByIdCodigoUsu($ID_usu, $inicioAccepted, $ID_codigoAccepted)
		{
			$ID_codigoAccepted=str_replace(' ', '',$ID_codigoAccepted);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND
				 		quotations.pto_pedidoCod='".$ID_codigoAccepted."'
			order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}
		

		function getQuotationsAceptedASAjaxByIdClienteUsu($ID_usu, $inicioAccepted, $ID_clienteAccepted)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND quotations.ID_cli='".$ID_clienteAccepted."' order by ID_pto desc limit 0, ".$inicioAccepted."";
		$result				=	mysql_query($sql);
		return $result;
			
		}
		
			function 	getQuotationsAceptedASManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='16' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

				function getQuotationsBudgetedAS()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
			

	function getQuotationsPresupuestadosASAjax($inicioPresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr   order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsPresupuestadosASAjaxUsu($ID_usu, $inicioPresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND (quotations.pto_asignado='".$ID_usu."' OR quotations.ID_usu='".$ID_usu."' OR quotations.pto_vendedor='".$ID_usu."') order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsPresupuestadosASAjaxById($inicioPresupuestados, $ID_buscadorPresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		obras.ID_obr=".$ID_buscadorPresupuestados."
			order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

				function getQuotationsPresupuestadosASAjaxByIdUsu($ID_usu, $inicioPresupuestados, $ID_buscadorPresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		obras.ID_obr='".$ID_buscadorPresupuestados."' AND
				 		 (quotations.ID_usu='".$ID_usu."' OR 
				 		 quotations.pto_vendedor='".$ID_usu."' OR 
				 		 quotations.pto_asignado='".$ID_usu."')
						order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsPresupuestadosASAjaxByIdCodigo($inicioPresupuestados, $ID_codigoPresupuestados)
		{
			$ID_codigoPresupuestados=str_replace(' ', '',$ID_codigoPresupuestados);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_pedidoCod=".$ID_codigoPresupuestados."
			order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

				function getQuotationsPresupuestadosASAjaxByIdCliente($inicioPresupuestados, $ID_clientePresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.ID_cli=".$ID_clientePresupuestados."
			order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsPresupuestadosASAjaxByIdCodigoUsu($ID_usu, $inicioPresupuestados, $ID_codigoPresupuestados)
		{
			$ID_codigoPresupuestados=str_replace(' ', '',$ID_codigoPresupuestados);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_pedidoCod='".$ID_codigoPresupuestados."'
			order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsPresupuestadosASAjaxByIdClienteUsu($ID_usu, $inicioPresupuestados, $ID_clientePresupuestados)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND 
				 		quotations.ID_cli='".$ID_clientePresupuestados."'
			order by ID_pto desc limit 0, ".$inicioPresupuestados."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}



				function getQuotationsBudgetedASIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='13' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu." OR quotations.pto_asignado=".$ID_usu.")
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
					function getQuotationsBudgetedASManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	function getQuotationsDespachoB()
	{

		$sql	=	"SELECT *, TIMESTAMPDIFF(DAY, registro_servicio.ser_fecEntrega, CURDATE()) AS days FROM registro_servicio, obras, clientes, status, prioridades, usuarios, zonas
		 				WHERE
						registro_servicio.ID_sta='15' AND
						registro_servicio.ID_cli=clientes.ID_cli AND
						registro_servicio.ID_obr=obras.ID_obr AND
						registro_servicio.ID_sta=status.ID_sta AND
						registro_servicio.ID_pri=prioridades.ID_pri AND
						registro_servicio.ID_usu=usuarios.ID_usu AND
						obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


	}

	function getQuotationsDespacho()
	{

		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 	WHERE 
				 (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


	}

	function getQuotationsDespachoAS()
	{
	$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
	
		return $result;
	}

	function getQuotationsDespachoASIdUsu($ID_usu)
	{
	$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND quotations.pto_asignado=".$ID_usu."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
	
		return $result;
	}

	function getQuotationsDespachoASAjax($inicioDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr   order by ID_pto desc limit 0, ".$inicioDespacho."";
		$result				=	mysql_query($sql);
		
		return $result;


		}

		function getQuotationsDespachoASAjaxUsu($ID_usu, $inicioDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND quotations.pto_asignado=".$ID_usu." order by ID_pto desc limit 0, ".$inicioDespacho."";
		$result				=	mysql_query($sql);
		
		return $result;


		}

		function getQuotationsDespachoASAjaxById($inicioDespacho, $ID_buscadorDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15'AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		obras.ID_obr=".$ID_buscadorDespacho."
			order by ID_pto desc limit 0, ".$inicioDespacho."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

		function getQuotationsDespachoASAjaxByIdUsu($ID_usu, $inicioDespacho, $ID_buscadorDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15'AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		obras.ID_obr='".$ID_buscadorDespacho."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioDespacho."";
		$result				=	mysql_query($sql);
		return $result;
			
		}

			function getQuotationsDespachoASAjaxByIdCodigo($inicioDespacho, $ID_codigoDespacho)
		{
			$ID_codigoDespacho=str_replace(' ', '',$ID_codigoDespacho);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.pto_pedidoCod='".$ID_codigoDespacho."'
				order by ID_pto desc limit 0, ".$inicioDespacho."";
			$result				=	mysql_query($sql);
			$this->quotUsuRows	=	mysql_num_rows($result);
			return $result;
		}		

			function getQuotationsDespachoASAjaxByIdCliente($inicioDespacho, $ID_clienteDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_cli=".$ID_clienteDespacho."
				order by ID_pto desc limit 0, ".$inicioDespacho."";
			$result				=	mysql_query($sql);
			$this->quotUsuRows	=	mysql_num_rows($result);
			return $result;
		}		

		function getQuotationsDespachoASAjaxByIdCodigoUsu($ID_usu, $inicioDespacho, $ID_codigoDespacho)
		{
			$ID_codigoDespacho=str_replace(' ', '',$ID_codigoDespacho);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND 
				 		quotations.pto_pedidoCod='".$ID_codigoDespacho."' 
				order by ID_pto desc limit 0, ".$inicioDespacho."";
			$result				=	mysql_query($sql);
			$this->quotUsuRows	=	mysql_num_rows($result);
			return $result;
		}		

			function getQuotationsDespachoASAjaxByIdClienteUsu($ID_usu, $inicioDespacho, $ID_clienteDespacho)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' AND
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND 
				 		quotations.ID_cli='".$ID_clienteDespacho."' 
				order by ID_pto desc limit 0, ".$inicioDespacho."";
			$result				=	mysql_query($sql);
			$this->quotUsuRows	=	mysql_num_rows($result);
			return $result;
		}		

	function getQuotationsDespachoDia()
	{
		$ID_cli=5;
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND quotations.ID_cli=".$ID_cli."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

				function getQuotationsDespachoIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	
				function getQuotationsDespachoManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='15' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

			function getQuotationsCierreAS()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	


	function getQuotationsCierreASAjax($inicioCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr    order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsCierreASAjaxUsu($ID_usu, $inicioCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND quotations.pto_asignado=".$ID_usu."  order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}


		function getQuotationsCierreASAjaxById($inicioCierre, $ID_buscadorCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		obras.ID_obr=".$ID_buscadorCierre."
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsCierreASAjaxByIdUsu($ID_usu, $inicioCierre, $ID_buscadorCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		obras.ID_obr='".$ID_buscadorCierre."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsCierreASAjaxByIdCodigo($inicioCierre, $ID_codigoCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		quotations.pto_pedidoCod=".$ID_codigoCierre."
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

				function getQuotationsCierreASAjaxByIdCliente($inicioCierre, $ID_clienteCierre)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		quotations.ID_cli=".$ID_clienteCierre."
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsCierreASAjaxByIdCodigoUsu($ID_usu, $inicioCierre, $ID_codigoCierre)
		{
			$ID_codigoCierre=str_replace(' ', '',$ID_codigoCierre);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		quotations.pto_pedidoCod='".$ID_codigoCierre."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

				function getQuotationsCierreASAjaxByIdClienteUsu($ID_usu, $inicioCierre, $ID_clienteCierre)
		{
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND 
				 		quotations.ID_cli='".$ID_clienteCierre."' 
			order by ID_pto desc limit 0, ".$inicioCierre."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}


		function getQuotationsCierreASAdministracion()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='5' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	
	
				function getQuotationsCierreASIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu." or  quotations.pto_asignado=".$ID_usu.")
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
				function getQuotationsCierreASManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='14' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

		function DeleteQuotationsAS($ID_pto)
	{
		$sql	=	"DELETE FROM quotations
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function getQuotationsRechazado()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y' '%H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='40' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

		
	function getQuotationsOtros()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y' '%H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE 
				 		quotations.ID_sta='6' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr 
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}


	function getQuotationsOtrosIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y' '%H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE quotations.ID_tpp='5' AND
				 		quotations.ID_sta='6' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND quotations.pto_asignado=".$ID_usu."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	function getQuotationsRechazadoIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y' '%H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='40' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu." OR quotations.pto_asignado=".$ID_usu.")
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
				function getQuotationsRechazadoManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y' '%H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='40' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

		function getQuotationsInstalacion()
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}



	function getQuotationsInstalacionASAjax($inicioInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr    order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsInstalacionASAjaxUsu($ID_usu, $inicioInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND quotations.pto_asignado=".$ID_usu."  order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;


		}

		function getQuotationsInstalacionASAjaxById($inicioInstalacion, $ID_buscadorInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND 
				 		obras.ID_obr=".$ID_buscadorInstalacion."
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

		function getQuotationsInstalacionASAjaxByIdUsu($ID_usu, $inicioInstalacion, $ID_buscadorInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr  AND 
				 		obras.ID_obr='".$ID_buscadorInstalacion."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}


		function getQuotationsInstalacionASAjaxByIdCodigo($inicioInstalacion, $ID_codigoInstalacion)
		{
			$ID_codigoInstalacion=str_replace(' ', '',$ID_codigoInstalacion);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_pedidoCod='".$ID_codigoInstalacion."'
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}


		function getQuotationsInstalacionASAjaxByIdCliente($inicioInstalacion, $ID_clienteInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.ID_cli='".$ID_clienteInstalacion."'
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}


		function getQuotationsInstalacionASAjaxByIdCodigoUsu($ID_usu, $inicioInstalacion, $ID_codigoInstalacion)
		{
			$ID_codigoInstalacion=str_replace(' ', '',$ID_codigoInstalacion);
			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		quotations.pto_pedidoCod='".$ID_codigoInstalacion."' AND quotations.pto_asignado=".$ID_usu."
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}

			function getQuotationsInstalacionASAjaxByIdClienteUsu($ID_usu, $inicioInstalacion, $ID_clienteInstalacion)
		{

			$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND 
				 		(quotations.ID_usu='".$ID_usu."' or quotations.pto_vendedor='".$ID_usu."' or quotations.pto_asignado='".$ID_usu."') AND
				 		quotations.ID_cli='".$ID_clienteInstalacion."'
			order by ID_pto desc limit 0, ".$inicioInstalacion."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
			
		}
					function getQuotationsInstalacionIdUsu($ID_usu)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu." OR quotations.pto_asignado=".$ID_usu.")
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
				function getQuotationsInstalacionManager($ger)
	{
		$sql	=	"SELECT *, DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida, DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso FROM quotations, clientes, obras
				 WHERE (quotations.ID_tpp='1' OR 
				 		quotations.ID_tpp='2' OR
				 		quotations.ID_tpp='3' OR
				 		quotations.ID_tpp='4' OR
				 		quotations.ID_tpp='5' OR
				 		quotations.ID_tpp='7' ) AND
				 		quotations.ID_sta='20' 	AND 
				 		quotations.ID_cli=clientes.ID_cli AND
				 		quotations.ID_obr=obras.ID_obr AND
				 		quotations.ID_gcm=".$ger."
				 		ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	
	function getQuotationsByIdEmp($ID_emp)
	{
		   
		$sql	=	"SELECT * FROM quotations
					WHERE ID_emp=".$ID_emp."";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

		function getQuotationsInsertedEstimator()
	{
		   $ID_usu                         = $_SESSION['ID_usu'];
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu = usuarios.ID_usu AND
					quotations.ID_tpp='6'  AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.pto_asignado='".$ID_usu."'
					ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getQuotationsDirection()
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso 
					   FROM quotations, quotations_fic, clientes, obras WHERE quotations.ID_fic=quotations_fic.ID_fic AND quotations.ID_cli=clientes.ID_cli AND quotations.ID_obr=obras.ID_obr AND quotations.pto_fecPedidoDescDirector<>'0000-00-00 00:00:00' AND quotations.pto_fecDescCostos<>'0000-00-00 00:00:00' AND quotations.pto_fecDescDirector='0000-00-00 00:00:00' ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationscostos()
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso  
					  FROM quotations, quotations_fic, clientes, obras WHERE quotations.ID_fic=quotations_fic.ID_fic AND quotations.ID_cli=clientes.ID_cli AND quotations.ID_obr=obras.ID_obr AND quotations.pto_fecPedidoDescDirector<>'0000-00-00 00:00:00' AND quotations.pto_fecDescCostos='0000-00-00 00:00:00' AND quotations.pto_fecDescDirector='0000-00-00 00:00:00' ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

		function getQuotationsVendidos()
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso  
					  FROM quotations, quotations_fic, clientes, obras 
						WHERE quotations.ID_fic=quotations_fic.ID_fic
							 AND quotations.ID_cli=clientes.ID_cli 
							 AND quotations.ID_obr=obras.ID_obr 
							 AND quotations.pto_fecVenta<>'0000-00-00 00:00:00'
							 AND quotations.ID_sta=33 
							 AND quotations.pto_cerrado=0
							 ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
			function getCostoQuotations()
	{
		$sql	=	"SELECT * FROM quotations, quotations_fic, clientes, obras WHERE quotations.ID_fic=quotations_fic.ID_fic AND quotations.ID_cli=clientes.ID_cli AND quotations.ID_obr=obras.ID_obr AND quotations.pto_fecPedidoDescDirector<>'0000-00-00 00:00:00' AND quotations.pto_fecDescCostos='0000-00-00 00:00:00' AND quotations.pto_fecDescDirector='0000-00-00 00:00:00' ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}



	function getQuotationsAssigned()
	{
		$sql	=	"SELECT * ,	
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr
					ORDER BY quotations.pto_fecAsignado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	function QuotationsAssignAS($ID_pto, $pto_pedidoCod, $pto_fecAceptado, $ID_sta)
	{
		$sql	=	"UPDATE quotations
					SET pto_pedidoCod   ='".$pto_pedidoCod."',
						pto_fecAceptado ='".$pto_fecAceptado."',
						ID_sta 			='".$ID_sta."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function UpdateQuotationsSerCod($ID_pto, $ser_cod)
	{
		$sql	=	"UPDATE quotations
					SET ser_cod   ='".$ser_cod."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


		function QuotationsQuotateAS($ID_pto, $ID_tipoMonedaPres, $tipoCambioPres, $pto_montoPresupuesto, $pto_fecPresupuesto, $ID_sta, $pto_diasEntrega, $pto_numero)
	{
		$sql	=	"UPDATE quotations
					SET ID_tipoMonedaPres    ='".$ID_tipoMonedaPres."',
						tipoCambioPres 		 ='".$tipoCambioPres."',
						pto_montoPresupuesto ='".$pto_montoPresupuesto."',
						pto_fecPresupuesto	 ='".$pto_fecPresupuesto."',
						ID_sta 				 ='".$ID_sta."',
						pto_diasEntrega		 ='".$pto_diasEntrega."',
						pto_numero			 ='".$pto_numero."'
					 	WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}




	function QuotationsSaleAS($ID_pto, $pto_OC, $pto_OV, $pto_proyecto, $pto_fecEntrega, $ID_tipoMonedaVenta, $tipoCambioVenta, $pto_montoOV, $ID_sta, $pto_fecVenta)
	{
		$sql	=	"UPDATE quotations
					SET pto_OC    			 ='".$pto_OC."',
						pto_OV 		         ='".$pto_OV."',
						pto_proyecto         ='".$pto_proyecto."',
						pto_fecEntrega	     ='".$pto_fecEntrega."',
						ID_tipoMonedaVenta 	 ='".$ID_tipoMonedaVenta."',
						tipoCambioVenta 	 ='".$tipoCambioVenta."',
						pto_montoOV 		 ='".$pto_montoOV."',
						ID_sta 				 ='".$ID_sta."',
						pto_fecVenta 		 ='".$pto_fecVenta."'
					 	WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function QuotationsDespachoAS($ID_pto, $pto_remito, $ID_sta, $pto_fecDespacho)
	{
		$sql	=	"UPDATE quotations
					SET pto_remito    			 ='".$pto_remito."',
						pto_fecDespacho 		 ='".$pto_fecDespacho."',
						ID_sta 				 	 ='".$ID_sta."'
					 	WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function QuotationsInstalacionAS($ID_pto, $ID_sta, $pto_fecInstalacion)
	{
		$sql	=	"UPDATE quotations
					SET pto_fecInstalacion 		 ='".$pto_fecInstalacion."',
						ID_sta 				 	 ='".$ID_sta."'
					 	WHERE ID_pto 			 ='".$ID_pto."'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	  function QuotationsCierreASAdministrativo($ID_pto, $ID_sta)
	  {
		$sql	=	"UPDATE quotations
					SET ID_sta 				 ='".$ID_sta."'
					 	WHERE ID_pto 		 ='".$ID_pto."'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();

		//UTILIZADO POR:
						//SERVICES:
									//dashboard back office AS
									//actions-quotations-as.php -> $action=='delete'
	}

		function QuotationsCierreAS($ID_pto, $ID_sta, $pto_fecModif, $pto_cerrado)
	{
		$sql	=	"UPDATE quotations
					SET pto_cerrado 		 ='".$pto_cerrado."',
						pto_fecModif 		 ='".$pto_fecModif."',
						ID_sta 				 ='".$ID_sta."'
					 	WHERE ID_pto 		 ='".$ID_pto."'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


	function getQuotationsAssignedEstimator()
	{

		   $ID_usu                         = $_SESSION['ID_usu'];
		   $sql	  =	"SELECT * ,	
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu = usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.pto_asignado='".$ID_usu."'
					ORDER BY quotations.pto_fecAsignado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}



	function getQuotationsAccepted()
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado 
					 FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='24' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr 
					ORDER BY quotations.pto_fecAceptado ASC";
		$result				=	mysql_query($sql);
		return $result;
	}
		function getQuotationsAcceptedEstimator()
	{
			   $ID_usu                         = $_SESSION['ID_usu'];
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu = usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='24' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.pto_asignado='".$ID_usu."'
					ORDER BY quotations.pto_fecAceptado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}




	function getQuotationsBudgeted()
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado,
					 DATE_FORMAT(pto_fecPresupuesto, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPresupuesto
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr
					ORDER BY quotations.pto_fecPresupuesto ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}

	function getQuotationsBudgetedByCliente()
	{
		$sql	=	"SELECT * FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='25' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr
					ORDER BY quotations.pto_fecPresupuesto ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getQuotationsBudgetedEstimator($asignado)
	{

					$sql			=	"SELECT * FROM quotations, quotations_fic, clientes, obras
										WHERE quotations.ID_fic=quotations_fic.ID_fic AND
										quotations.ID_tpp='6' AND
										(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
										quotations.ID_cli=clientes.ID_cli AND
										quotations.ID_obr=obras.ID_obr AND
										quotations.pto_asignado=$asignado
										ORDER BY quotations.pto_fecPresupuesto ASC";
					$result 		=	mysql_query($sql);
					return $result;		
			
	}
	function getQuotationsEstimatorByIdPtoForecas()
	{
		$ID_usu                         = $_SESSION['ID_usu'];

					$sql			=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado,
					 DATE_FORMAT(pto_fecPresupuesto, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPresupuesto
					  FROM quotations, quotations_fic, clientes, obras, usuarios
										WHERE quotations.ID_fic=quotations_fic.ID_fic AND
										quotations.ID_usu=usuarios.ID_usu AND
										quotations.ID_tpp='6' AND
										(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
										quotations.ID_cli=clientes.ID_cli AND
										quotations.ID_obr=obras.ID_obr AND
										quotations.pto_asignado=".$ID_usu." AND (quotations_fic.fic_exhibArg != 0 OR
										quotations_fic.fic_camaras  != 0 OR
										quotations_fic.fic_frioStd  != 0 OR
										quotations_fic.fic_frioEsp  != 0 )
										AND
										ID_pto <> all (SELECT ID_pto FROM forecast)
										
										ORDER BY quotations.pto_fecPresupuesto ASC";
					$result 		=	mysql_query($sql);
					return $result;
					
			
	}

	function getQuotationsInsertedIdUsu($ID_usu)
	{
		$sql	=	"SELECT  *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso
					   FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					(quotations.ID_sta='22' || quotations.ID_sta='37') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")
					ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}			
		function getQuotationsInsertedIdUsuManager($ger)
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso   
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='22' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_gcm=$ger
					ORDER BY quotations.pto_fecIngreso ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}



	function getQuotationsAssignedIdUsu($ID_usu)
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")
					ORDER BY quotations.pto_fecAsignado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationsAssignedIdUsuEstimator($ID_usu)
	{
		$sql	=	"SELECT * FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_usu=$ID_usu
					ORDER BY quotations.pto_fecAsignado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationsAssignedIdUsuManager($ger)
	{
		$sql	=	"SELECT * ,	
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='23' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_gcm=$ger
					ORDER BY quotations.pto_fecAsignado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}








	function getQuotationsAcceptedIdUsu($ID_usu)
	{
		$sql	=	"SELECT * ,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='24' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")
					ORDER BY quotations.pto_fecAceptado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
		function getQuotationsAcceptedIdUsuEstimator($ID_usu)
	{
		$sql	=	"SELECT * FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='24' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_usu=$ID_usu
					ORDER BY quotations.pto_fecAceptado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
			function getQuotationsAcceptedIdUsuManager($ger)
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado 
					 FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					quotations.ID_sta='24' AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_gcm=$ger
					ORDER BY quotations.pto_fecAceptado ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}





	function getQuotationsBudgetedIdUsu($ID_usu)
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado,
					 DATE_FORMAT(pto_fecPresupuesto, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPresupuesto
					  FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
						(quotations.ID_usu=".$ID_usu." OR quotations.pto_vendedor=".$ID_usu.")
					ORDER BY quotations.pto_fecPresupuesto ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getQuotationsBudgetedIdUsuEstimator($ID_usu)
	{
		$sql	=	"SELECT * FROM quotations, quotations_fic, clientes, obras
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_tpp='6' AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_usu=$ID_usu
					ORDER BY quotations.pto_fecPresupuesto ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getQuotationsBudgetedIdUsuManager($ger)
	{
		$sql	=	"SELECT *,
					 DATE_FORMAT(pto_fecRequerida, '%d-%m-%Y') as pto_fecRequerida,
					 DATE_FORMAT(pto_fecIngreso, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecIngreso,
					 DATE_FORMAT(pto_fecAsignado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAsignado,
					 DATE_FORMAT(pto_fecEntregaEstimada, '%d-%m-%Y') as pto_fecEntregaEstimada,
					 DATE_FORMAT(pto_fecAceptado, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecAceptado,
					 DATE_FORMAT(pto_fecPresupuesto, '%d-%m-%Y ' ' %H:%i:%s') as pto_fecPresupuesto
					  FROM quotations, quotations_fic, clientes, obras, usuarios
					WHERE quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_tpp='6' AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_cli=clientes.ID_cli AND
					quotations.ID_obr=obras.ID_obr AND
					quotations.ID_gcm=".$ger."
					ORDER BY quotations.pto_fecPresupuesto ASC";
		$result				=	mysql_query($sql);
		$this->quotUsuRows	=	mysql_num_rows($result);
		return $result;
	}





	function getUltimoQuotationsByIdEmp($ID_emp)
	{

		$sql	=	"SELECT * FROM quotations
					WHERE ID_emp='" . $ID_emp . "' ORDER BY ID_pto DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;

	}
	function getUltimoQuotationsByIdpto()
	{

		$sql	=	"SELECT * FROM quotations ORDER BY ID_pto DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;

	}

	function getQuotationsByIdMasTipoMoneda($ID_pto)
	{

		$sql	=	"SELECT * FROM quotations, tipo_moneda WHERE quotations.ID_tipoMonedaPres=tipo_moneda.ID_tmo AND ID_pto='" . $ID_pto . "'";
		$result				=	mysql_query($sql);
		return $result;

	}

	function getQuotationsById($ID_pto)
	{

		$sql	=	"SELECT * FROM quotations, quotations_fic, obras WHERE quotations.ID_fic=quotations_fic.ID_fic AND quotations.ID_obr=obras.ID_obr AND ID_pto='" . $ID_pto . "'";
		$result				=	mysql_query($sql);

		return $result;

	}
	function getQuotationsByIdPto($ID_pto)
	{

		$sql	=	"SELECT * FROM quotations WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);

		return $result;

	}


	function dropQuotations($ID_pto)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta='27',
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function dropQuotationsAS($ID_pto)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta='27',
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


	// Acciones ejecutadas a quotations desde Dashboard Ventas y Back Office

	function lostQuotations($ID_pto, $ID_com, $ID_mot)
	{
		$pto_fecPerdida=date("Y-m-d H:i:s");

		$sql	=	"UPDATE quotations
					SET ID_sta='34',
					pto_fecAsignado='".$fecha."',
					pto_fecPerdida='" . $pto_fecPerdida . "',
					ID_com='" . $ID_com . "',
					ID_mot='" . $ID_mot . "'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


	function assignQuotations($ID_pto, $pto_fecEntregaEstimada, $pto_asignado, $pto_ayudaOt)
	{	
		$fecha=date("Y-m-d H:i:s");

		$sql	=	"UPDATE quotations
					SET ID_sta='23',
					pto_fecAsignado='".$fecha."',
					pto_fecEntregaEstimada='" . $pto_fecEntregaEstimada . "',
					pto_asignado='" . $pto_asignado."',
					pto_fecModif='".$fecha."',
					pto_ayudaOt='".$pto_ayudaOt."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}



	function bloquearQuotations($ID_pto, $pto_fecBloqueo)
	{	

		$sql	=	"UPDATE quotations
					SET ID_sta='37',
					pto_fecBloqueo='".$pto_fecBloqueo."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
		function desbloquearQuotations($ID_pto, $pto_fecBloqueo)
	{	

		$sql	=	"UPDATE quotations
					SET ID_sta='22',
					pto_fecBloqueo='".$pto_fecBloqueo."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function acceptQuotations($ID_pto, $pto_fecEntregaEstimada)
	{
				

		$sql	=	"UPDATE quotations
					SET ID_sta='24',
					pto_fecAceptado='".date("Y-m-d H:i:s")."',
					pto_fecModif='".date("Y-m-d H:i:s")."',
					pto_fecEntrega='".$pto_fecEntregaEstimada."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function rejectQuotations($ID_pto)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta='22',
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function quotateQuotations($ID_pto, $ID_tipoMonedaPres, $tipoCambioPres, $pto_montoPresupuesto, $ID_usu, $pto_pedidoCod)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta='25',
					ID_tipoMonedaPres=$ID_tipoMonedaPres,
					tipoCambioPres=$tipoCambioPres, 
					pto_fecPresupuesto='".date("Y-m-d H:i:s")."',
					pto_montoPresupuesto=$pto_montoPresupuesto,
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);

		
	}

	function quitateQuotationsInsertAdjuntos($ID_usu, $ID_pto, $adj_ruta,$pto_pedidoCod)
	{
		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'1',
					'".$ID_pto."', 
					'quotations', 
					'".$adj_ruta."', 
					'".$pto_pedidoCod."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}

		function QuotationsASInsertAdjuntos($ID_usu, $ID_pto, $adj_ruta,$pto_pedidoCod)
	{
		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'3',
					'".$ID_pto."', 
					'quotations', 
					'".$adj_ruta."', 
					'".$pto_pedidoCod."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}
	function saleQuotations($ID_pto, $ID_tipoMonedaVenta, $tipoCambioVenta, $pto_montoOV, $ID_usu, $pto_pedidoCod, $pto_fecVenta)
	{

		$sql	=	"UPDATE quotations
					SET ID_sta='33',
					ID_tipoMonedaVenta=$ID_tipoMonedaVenta,
					tipoCambioVenta=$tipoCambioVenta, 
					pto_fecVenta='".$pto_fecVenta."',
					pto_montoOV=$pto_montoOV,
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);

	}

function cargarObrQuotations($ID_pto, $ID_obr, $obr_nproyecto, $obr_np, $obr_fecmad, $obr_npto, $monto_pll, $tipoCambioPll, $ID_tipoMonedaPll, $pto_fecEntrega)
	{

		$sql	=	"UPDATE obras
					SET obr_nproyecto='".$obr_nproyecto."',
					obr_np='".$obr_np."',
					obr_fecmad='".$obr_fecmad."',
					obr_npto='".$obr_npto."'
					WHERE ID_obr='" . $ID_obr . "'";
		$result	=	mysql_query($sql);

		$pto_cerrado= 1;
		$sql2	=	"UPDATE quotations
					SET pto_cerrado='".$pto_cerrado."',
						monto_pll='".$monto_pll."',
					tipoCambioPll='".$tipoCambioPll."',
					ID_tipoMonedaPll='".$ID_tipoMonedaPll."',
					pto_fecEntrega='".$pto_fecEntrega."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result2	=	mysql_query($sql2);
	}


function pedidoDirectionQuotations($ID_pto, $pto_fecPedidoDescDirector, $adj_ruta, $pto_pedidoCod)
	{

		$ID_usu					=	$_SESSION['ID_usu'];
		$nombre =  "Pedido descuento";

		$sql	=	"UPDATE quotations
					SET pto_fecPedidoDescDirector='".$pto_fecPedidoDescDirector."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);

		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'3',
					'".$ID_pto."', 
					'quotations', 
					'".$adj_ruta."', 
					'".$nombre."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}
	function directionQuotations($ID_pto, $pto_fecDescDirector, $adj_ruta, $pto_pedidoCod)
	{							

		$sql	=	"UPDATE quotations
					SET pto_fecDescDirector='".$pto_fecDescDirector."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		$ID_usu					=	$_SESSION['ID_usu'];
		$nombre =  "Plan. con desc. Director";

		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'5',
					'".$ID_pto."', 
					'quotations', 
					'".$adj_ruta."', 
					'".$nombre."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}
		function modifCostoQuotations($ID_pto, $pto_fecDescCostos, $adj_ruta, $pto_pedidoCod)

	{

		$sql	=	"UPDATE quotations
					SET pto_fecDescCostos='".$pto_fecDescCostos."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
		$ID_usu	=	$_SESSION['ID_usu'];
		$nombre = 	"Pedido descuento Costo";
		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'4',
					'".$ID_pto."', 
					'quotations', 
					'".$adj_ruta."', 
					'".$nombre."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}
	
	function statusQuotations($ID_pto, $ID_sta, $pto_fecForecast)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta=$ID_sta,
				    pto_fecForecast='".$pto_fecForecast."',
				    pto_fecEntrega='".$pto_fecForecast."',
				    pto_fecEntregaEstimada='".$pto_fecForecast."',
					pto_fecModif='".date("Y-m-d H:i:s")."'
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
	}
		function changeStatusQuotations($ID_pto, $ID_sta, $ID_mot)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta=".$ID_sta.",
					ID_mot=".$ID_mot."
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
	}
			function DevolverQuotations($ID_pto, $ID_sta, $pto_asignado)
	{
		$sql	=	"UPDATE quotations
					SET ID_sta=$ID_sta,
					pto_asignado=$pto_asignado
					WHERE ID_pto='" . $ID_pto . "'";
		$result	=	mysql_query($sql);
	}
	function ModifQuotations($ID_pto, $pto_desc, $pto_pedidoCod)
	{
		$sqlGet	=	"SELECT * FROM quotations
							WHERE ID_pto='" . $ID_pto . "'";
			$resultGet				=	mysql_query($sqlGet);
			$assoc_resultGet = mysql_fetch_assoc($resultGet);


		$sql	=	"UPDATE quotations
							SET ID_sta='36',
							pto_fecModif='".date("Y-m-d H:i:s")."'
							WHERE ID_pto='" . $ID_pto . "'";
				$result	=	mysql_query($sql);
			
	 $ID_obr						=	$assoc_resultGet['ID_obr'];		
	 $ID_emp						=	$assoc_resultGet['ID_emp'];		
	 $ID_cli						=	$assoc_resultGet['ID_cli'];
 	 $ID_pri						=	'0';
 	 $ID_usu						=	$_SESSION['ID_usu'];
	 $ID_tpp						=	'6';
	 $ID_sta						=	'22';
	 $ID_mot						=	'0';
	 $ID_fic						=	$assoc_resultGet['ID_fic'];
	 $ID_com 						=    $assoc_resultGet['ID_com'];
	 $pto_fecIngreso				=	date("Y-m-d")." ".date("h:i:s");
	 $pto_fecRequerida				=	date("Y-m-d")." ".date("h:i:s");
	 $pto_fecAsignado				=	'00-00-00 00:00:00';
	 $pto_fecEntregaEstimada		=	'00-00-00 00:00:00';
	 $pto_fecAceptado				=	'00-00-00 00:00:00';
	 $pto_fecPresupuesto			=	'00-00-00 00:00:00';
	 $pto_fecEntrega				=	'00-00-00 00:00:00';
	 $pto_fecVenta					=	'00-00-00 00:00:00';
	 $pto_fecDespacho				=	'00-00-00 00:00:00';
	 $pto_fecInstalacion			=	'00-00-00 00:00:00';
	 $pto_presupuestoRelacionado	=	$assoc_resultGet['ID_pto'];
	 $pto_pedidoCod					=	$pto_pedidoCod;
	 $pto_asignado					=	'0';
     $pto_desc						=	$pto_desc;
	 $pto_contacto					=	'0';
	 $pto_mail						=	'0';
	 $pto_proyecto					=	'0';
	 $pto_OV						=	'0';
	 $pto_OC						=	'0';
	 $pto_remito					=	'0';
	 $pto_montoPresupuesto			=	'0';
	 $pto_fecModif 					=	date("Y-m-d")." ".date("h:i:s");
	 $pto_montoOV					=	'0';
	 $pto_cerrado					=	'0'; 
	 $ID_tipoMonedaVenta			=	'0'; 
	 $ID_tipoMonedaPres				=	'0'; 
	 $tipoCambioVenta				=	'0'; 
	 $tipoCambioPres				=	'0'; 
	 $pto_fecDescGerente			=	'0000-00-00 00:00:00';
	 $pto_fecDescDirector			=	'0000-00-00 00:00:00';
	 $pto_fecDescCostos				=	'0000-00-00 00:00:00';
	 $pto_fecPedidoDescDirector		=	'0000-00-00 00:00:00';
		
	
		$sqlInsert	=	"INSERT INTO quotations
						(ID_emp,
	  ID_cli,
	  ID_obr,
	  ID_pri,
	  ID_usu,
	  ID_tpp,
	  ID_sta,
	  ID_mot,
	  ID_fic,
	  ID_com,
	  pto_fecIngreso,
	  pto_fecRequerida,
	  pto_fecAsignado,
	  pto_fecEntregaEstimada,
	  pto_fecAceptado,
	  pto_fecPresupuesto,
	  pto_fecEntrega,
	  pto_fecVenta,
	  pto_fecDespacho,
	  pto_fecInstalacion,
	  pto_presupuestoRelacionado,
	  pto_pedidoCod,
	  pto_asignado,
	  pto_desc,
	  pto_contacto,
	  pto_mail,
	  pto_proyecto,
	  pto_OV,
	  pto_OC,
	  pto_remito,
	  pto_montoPresupuesto,
	  pto_montoOV,
	  pto_fecModif,
	  pto_cerrado,
	  ID_tipoMonedaVenta,
	  ID_tipoMonedaPres,
	  tipoCambioVenta,
	  tipoCambioPres,
	    pto_fecDescGerente,
	  pto_fecDescDirector,
	  pto_fecDescCostos,
	  pto_fecPedidoDescDirector)
					VALUES('".$ID_emp."',
	  '".$ID_cli."',
	  '".$ID_obr."',
	  '".$ID_pri."',
	  '".$ID_usu."',
	  '".$ID_tpp."',
	  '".$ID_sta."',
	  '".$ID_mot."',
	  '".$ID_fic."',
	  '".$ID_com."',
	  '".$pto_fecIngreso."',
	  '".$pto_fecRequerida."',
	  '".$pto_fecAsignado."',
	  '".$pto_fecEntregaEstimada."',
	  '".$pto_fecAceptado."',
	  '".$pto_fecPresupuesto."',
	  '".$pto_fecEntrega."',
	  '".$pto_fecVenta."',
	  '".$pto_fecDespacho."',
	  '".$pto_fecInstalacion."',
	  '".$pto_presupuestoRelacionado."',
	  '".$pto_pedidoCod."',
	  '".$pto_asignado."',
	  '".$pto_desc."',
	  '".$pto_contacto."',
	  '".$pto_mail."',
	  '".$pto_proyecto."',
	  '".$pto_OV."',
	  '".$pto_OC."',
	  '".$pto_remito."',
	  '".$pto_montoPresupuesto."',
	  '".$pto_montoOV."',
	  '".$pto_fecModif."',
	  '".$pto_cerrado."',
	  '".$ID_tipoMonedaVenta."',
	  '".$ID_tipoMonedaPres."',
	  '".$tipoCambioVenta."',
	  '".$tipoCambioPres."',
	  '".$pto_fecDescGerente."',
	  '".$pto_fecDescDirector."',
	  '".$pto_fecDescCostos."',
	  '".$pto_fecPedidoDescDirector."'
)";
		$result	=	mysql_query($sqlInsert);
		return mysql_affected_rows();

		
	}

	function ultimoquotations()
	{

		$sql=	"SELECT * FROM quotations ORDER BY ID_pto DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;
	}

	// Fin Acciones

	function updateQuotations(
	  $ID_pto, 
	  $ID_emp,
	  $ID_cli,
	  $ID_obr,
	  $ID_pri,
	  $ID_usu,
	  $ID_tpp,
	  $ID_sta,
	  $ID_mot,
	  $ID_fic,
	  $ID_com,
	  $pto_fecIngreso,
	  $pto_fecRequerida,
	  $pto_fecAsignado,
	  $pto_fecEntregaEstimada,
	  $pto_fecAceptado,
	  $pto_fecPresupuesto,
	  $pto_fecEntrega,
	  $pto_fecVenta,
	  $pto_fecDespacho,
	  $pto_fecInstalacion,
	  $pto_presupuestoRelacionado,
	  $pto_pedidoCod,
	  $pto_asignado,
	  $pto_desc,
	  $pto_contacto,
	  $pto_mail,
	  $pto_proyecto,
	  $pto_OV,
	  $pto_OC,
	  $pto_remito,
	  $pto_montoPresupuesto,
	  $pto_montoOV,
	  $pto_cerrado,
	  $ID_tipoMonedaVenta,
	  $ID_tipoMonedaPres,
	  $tipoCambioVenta,
	  $tipoCambioPres,
	  $pto_fecDescGerente,
	  $pto_fecDescDirector,
	  $pto_fecDescCostos,
	  $pto_fecPedidoDescDirector)
	{
		$sql	=	"UPDATE quotations
					SET ID_emp='" . $ID_emp . "',
					  ID_cli='".$ID_cli."',
					  ID_obr='".$ID_obr."',
					  ID_pri='".$ID_pri."',
					  ID_usu='".$ID_usu."',
					  ID_tpp='".$ID_tpp."',
					  ID_sta='".$ID_sta."',
					  ID_mot='".$ID_mot."',
					  ID_fic='".$ID_fic."',
					  ID_com='".$ID_com."',
					  pto_fecIngreso='".$pto_fecIngreso."',
					  pto_fecRequerida='".$pto_fecRequerida."',
					  pto_fecAsignado='".$pto_fecAsignado."',
					  pto_fecEntregaEstimada='".$pto_fecEntregaEstimada."',
					  pto_fecAceptado='".$pto_fecAceptado."',
					  pto_fecPresupuesto='".$pto_fecPresupuesto."',
					  pto_fecEntrega='".$pto_fecEntrega."',
					  pto_fecVenta='".$pto_fecVenta."',
					  pto_fecDespacho='".$pto_fecDespacho."',
					  pto_fecInstalacion='".$pto_fecInstalacion."',
					  pto_presupuestoRelacionado='".$pto_presupuestoRelacionado."',
					  pto_pedidoCod='".$pto_pedidoCod."',
					  pto_asignado='".$pto_asignado."',
					  pto_desc='".$pto_desc."',
					  pto_contacto='".$pto_contacto."',
					  pto_mail='".$pto_mail."',
					  pto_proyecto='".$pto_proyecto."',
					  pto_OV='".$pto_OV."',
					  pto_OC='".$pto_OC."',
					  pto_remito='".$pto_remito."',
					  pto_montoPresupuesto='".$pto_montoPresupuesto."',
					  pto_montoOV='".$pto_montoOV."',
					  pto_fecModif='".date("Y-m-d H:i:s")."',
					  pto_cerrado='".$pto_cerrado.",
	  				  ID_tipoMonedaVenta='".$ID_tipoMonedaVenta."',
	  				  ID_tipoMonedaPres='".$ID_tipoMonedaPres."',
	  				  tipoCambioVenta='".$tipoCambioVenta."',
	  				  tipoCambioPres='".$tipoCambioPres."',
	  				  	pto_fecDescGerente='".$pto_fecDescGerente."',
	  					pto_fecDescDirector='".$pto_fecDescDirector."',
	  					pto_fecDescCostos='".$pto_fecDescCostos."',
	  					pto_fecPedidoDescDirector='".$pto_fecPedidoDescDirector."'
					WHERE ID_pto='" . $ID_pto . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

function updateQuotationIdFicByIdpto($ID_pto, $ID_fic)
{
		$sql	=	"UPDATE quotations
					SET ID_fic='".$ID_fic."'
					WHERE ID_pto='" . $ID_pto . "'";
			$update	=	mysql_query($sql);
}


function updateQuotationsFecReqIdComPtodes($ID_pto, $ID_com, $pto_fecRequerida, $pto_desc, $pto_vendedor)
	{
		$sql	=	"UPDATE quotations
					SET ID_com='".$ID_com."', 
						pto_fecRequerida='".$pto_fecRequerida."',
					    pto_desc='".$pto_desc."', 
					    pto_vendedor='".$pto_vendedor."'
					    WHERE ID_pto='" . $ID_pto . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}


	function insertQuotations($ID_emp,
	  $ID_cli,
	  $ID_obr,
	  $ID_pri,
	  $ID_usu,
	  $ID_tpp,
	  $ID_sta,
	  $ID_mot,
	  $ID_fic,
	  $ID_com,
	  $ID_art,
	  $pto_fecIngreso,
	  $pto_fecRequerida,
	  $pto_fecAsignado,
	  $pto_fecEntregaEstimada,
	  $pto_fecAceptado,
	  $pto_fecPresupuesto,
	  $pto_fecEntrega,
	  $pto_fecVenta,
	  $pto_fecDespacho,
	  $pto_fecInstalacion,
	  $pto_presupuestoRelacionado,
	  $pto_pedidoCod,
	  $pto_asignado,
	  $pto_desc,
	  $pto_contacto,
	  $pto_mail,
	  $pto_proyecto,
	  $pto_OV,
	  $pto_OC,
	  $pto_remito,
	  $pto_montoPresupuesto,
	  $pto_montoOV,
	  $pto_cerrado,
	  $ID_tipoMonedaVenta,
	  $ID_tipoMonedaPres,
	  $tipoCambioVenta,
	  $tipoCambioPres,
	  $pto_fecDescGerente,
	  $pto_fecDescDirector,
	  $pto_fecDescCostos,
	  $pto_fecPedidoDescDirector,
	  $ID_gcm,
	  $pto_vendedor)
	{
		$sql	=	"INSERT INTO quotations
						(ID_emp,
	  ID_cli,
	  ID_obr,
	  ID_pri,
	  ID_usu,
	  ID_tpp,
	  ID_sta,
	  ID_mot,
	  ID_fic,
	  ID_com,
	  ID_art,
	  pto_fecIngreso,
	  pto_fecRequerida,
	  pto_fecAsignado,
	  pto_fecEntregaEstimada,
	  pto_fecAceptado,
	  pto_fecPresupuesto,
	  pto_fecEntrega,
	  pto_fecVenta,
	  pto_fecDespacho,
	  pto_fecInstalacion,
	  pto_presupuestoRelacionado,
	  pto_pedidoCod,
	  pto_asignado,
	  pto_desc,
	  pto_contacto,
	  pto_mail,
	  pto_proyecto,
	  pto_OV,
	  pto_OC,
	  pto_remito,
	  pto_montoPresupuesto,
	  pto_montoOV,
	  pto_cerrado,
	  ID_tipoMonedaVenta,
	  ID_tipoMonedaPres,
	  tipoCambioVenta,
	  tipoCambioPres,
	  pto_fecDescGerente,
	  pto_fecDescDirector,
	  pto_fecDescCostos,
	  pto_fecPedidoDescDirector,
	  ID_gcm,
	  pto_vendedor)
					VALUES('".$ID_emp."',
	  '".$ID_cli."',
	  '".$ID_obr."',
	  '".$ID_pri."',
	  '".$ID_usu."',
	  '".$ID_tpp."',
	  '".$ID_sta."',
	  '".$ID_mot."',
	  '".$ID_fic."',
	  '".$ID_com."',
	  '".$ID_art."',
	  '".$pto_fecIngreso."',
	  '".$pto_fecRequerida."',
	  '".$pto_fecAsignado."',
	  '".$pto_fecEntregaEstimada."',
	  '".$pto_fecAceptado."',
	  '".$pto_fecPresupuesto."',
	  '".$pto_fecEntrega."',
	  '".$pto_fecVenta."',
	  '".$pto_fecDespacho."',
	  '".$pto_fecInstalacion."',
	  '".$pto_presupuestoRelacionado."',
	  '".$pto_pedidoCod."',
	  '".$pto_asignado."',
	  '".$pto_desc."',
	  '".$pto_contacto."',
	  '".$pto_mail."',
	  '".$pto_proyecto."',
	  '".$pto_OV."',
	  '".$pto_OC."',
	  '".$pto_remito."',
	  '".$pto_montoPresupuesto."',
	  '".$pto_montoOV."',
	  '".$pto_cerrado."',
	  '".$ID_tipoMonedaVenta."',
	  '".$ID_tipoMonedaPres."',
	  '".$tipoCambioVenta."',
	  '".$tipoCambioPres."',
	  '".$pto_fecDescGerente."',
	  '".$pto_fecDescDirector."',
	  '".$pto_fecDescCostos."',
	  '".$pto_fecPedidoDescDirector."',
	  '".$ID_gcm."',
	  '".$pto_vendedor."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function insertQuotationAs($ID_tpp, $pto_contacto, $pto_telefono, $pto_mail, $pto_asignado, $ID_pri, $ID_sta, $pto_desc, $ID_obr, $ID_cli, $ID_emp, $ID_usu, $pto_fecIngreso, $pto_pedidoCod, $ser_cod)
	{
		$sql	=	"INSERT INTO quotations
					(ID_tpp, pto_contacto, pto_telefono, pto_mail, pto_asignado, ID_pri, ID_sta, pto_desc, ID_obr, ID_cli, ID_emp, ID_usu, pto_fecIngreso, pto_pedidoCod, ser_cod)
					VALUES('".$ID_tpp."', '".$pto_contacto."', '".$pto_telefono."', '".$pto_mail."', '".$pto_asignado."', '".$ID_pri."', '".$ID_sta."', '".$pto_desc."', '".$ID_obr."', '".$ID_cli."', '".$ID_emp."', '".$ID_usu."', '".$pto_fecIngreso."', '".$pto_pedidoCod."', '".$ser_cod."')";
		$insert		=	mysql_query($sql);
	}

function updateQuotationAs($ID_tpp, $pto_contacto, $pto_telefono, $pto_mail, $pto_asignado, $ID_pri, $pto_desc, $ID_pto)
	{
		$sql="UPDATE quotations
				SET ID_tpp 			='".$ID_tpp."',
				pto_contacto 		='".$pto_contacto."',
				pto_telefono 		='".$pto_telefono."',
				pto_mail 			='".$pto_mail."',
				pto_asignado 		='".$pto_asignado."',
				ID_pri 				='".$ID_pri."',
				pto_desc 			='".$pto_desc."'
				WHERE ID_pto 		=".$ID_pto."";
				$result	=	mysql_query($sql);
				return $result;
	}

}

class quotations_numeracion 
{
	function GetUltimoQuotationsNumeracion($qno_tipo)
	{
		$sql = "SELECT * FROM quotations_numeracion WHERE qno_tipo='".$qno_tipo."'";
		$result	=	mysql_query($sql);
		return $result;
	}

	function UpdateUltimoQuotationsNumeracion($ID_qno, $qno_ultimo)
	{
		$sql="UPDATE quotations_numeracion 
				SET qno_ultimo 	='".$qno_ultimo."'
				WHERE ID_qno=".$ID_qno."";
		$result	=	mysql_query($sql);
		return $result;
	}

}
	


class quotations_fic
{			 	 
	 function getUltimoQuotations_ficByIdPto()
	{
		$sql	=	"SELECT * FROM quotations_fic ORDER BY ID_fic DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;
	}

	function getQuotations_ficById($ID_fic)
	{

		$sql	=	"SELECT * FROM quotations_fic
					WHERE ID_fic='" . $ID_fic . "'";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;

	}

	function dropQuotations_fic($ID_fic)
	{
		$sql	=	"DELETE FROM quotations_fic
					WHERE ID_fic='" . $ID_fic . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function updateQuotations_fic($ID_fic,
			$fic_exhibArg,
			$fic_exhibEur,
			$fic_estudioEpic,
			$fic_moExh,
			$fic_camaras,
			$fic_moCam,
			$fic_evaporadores, 			
			$fic_condensadores,
			$fic_frioStd,
			$fic_frioEsp,
			$fic_moFri,
			$fic_materialesObra,
			$fic_ingenieria,
			$fic_mediosElevacion,
			$fic_flete,
			$fic_viaticos,
			$fic_incoternm,
			$fic_supervisionObra,
			$fic_puerto,
			$fic_gasRefTn,
			$fic_gasRefBt,
			$fic_valvulaElectronicaTn,
			$fic_valvulaElectronicaBt,
			$fic_tensionFaseFrec,
			$fic_tempMaxExterna,
			$fic_relevamiento,
			$fic_condClimatica,
			$fic_climaMarino,
			$fic_nivelDescuento,
			$fic_formatoPto)
	{
		$sql	=	"UPDATE quotations_fic
					SET fic_exhibArg='".$fic_exhibArg."',
			fic_exhibEur='".$fic_exhibEur."',
			fic_estudioEpic='".$fic_estudioEpic."',
			fic_moExh='".$fic_moExh."',
			fic_camaras='".$fic_camaras."',
			fic_moCam='".$fic_moCam."',
			fic_evaporadores ='".$fic_evaporadores."',
			fic_condensadores='".$fic_condensadores."',
			fic_frioStd='".$fic_frioStd."',
			fic_frioEsp='".$fic_frioEsp."',
			fic_moFri='".$fic_moFri."',
			fic_materialesObra='".$fic_materialesObra."',
			fic_ingenieria='".$fic_ingenieria."',
			fic_mediosElevacion='".$fic_mediosElevacion."',
			fic_flete='".$fic_flete."',
			fic_viaticos='".$fic_viaticos."',
			fic_incoternm='".$fic_incoternm."',
			fic_supervisionObra='".$fic_supervisionObra."',
			fic_puerto='".$fic_puerto."',
			fic_gasRefTn='".$fic_gasRefTn."',
			fic_gasRefBt='".$fic_gasRefBt."',
			fic_valvulaElectronicaTn='".$fic_valvulaElectronicaTn."',
			fic_valvulaElectronicaBt='".$fic_valvulaElectronicaBt."',
			fic_tensionFaseFrec='".$fic_tensionFaseFrec."',
			fic_tempMaxExterna='".$fic_tempMaxExterna."',
			fic_relevamiento='".$fic_relevamiento."',
			fic_condClimatica='".$fic_condClimatica."',
			fic_climaMarino='".$fic_climaMarino."',
			fic_nivelDescuento='".$fic_nivelDescuento."',
			fic_formatoPto='".$fic_formatoPto."'
					WHERE ID_fic='" . $ID_fic . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}


	function insertQuotations_fic(
			$ID_art,
			$fic_cod,
			$fic_exhibArg,
			$fic_exhibEur,
			$fic_estudioEpic,
			$fic_moExh,
			$fic_camaras,
			$fic_moCam,
			$fic_evaporadores, 
			$fic_condensadores,
			$fic_frioStd,
			$fic_frioEsp,
			$fic_moFri,
			$fic_materialesObra,
			$fic_ingenieria,
			$fic_mediosElevacion,
			$fic_flete,
			$fic_viaticos,
			$fic_incoternm,
			$fic_supervisionObra,
			$fic_puerto,
			$fic_gasRefTn,
			$fic_gasRefBt,
			$fic_valvulaElectronicaTn,
			$fic_valvulaElectronicaBt,
			$fic_tensionFaseFrec,
			$fic_tempMaxExterna,
			$fic_relevamiento,
			$fic_condClimatica,
			$fic_climaMarino,
			$fic_nivelDescuento,
			$fic_formatoPto)
	{
		$sql	=	"INSERT INTO quotations_fic
						(ID_art,
			fic_cod,
			fic_exhibArg,
			fic_exhibEur,
			fic_estudioEpic,
			fic_moExh,
			fic_camaras,
			fic_moCam,
			fic_evaporadores, 			
			fic_condensadores,
			fic_frioStd,
			fic_frioEsp,
			fic_moFri,
			fic_materialesObra,
			fic_ingenieria,
			fic_mediosElevacion,
			fic_flete,
			fic_viaticos,
			fic_incoternm,
			fic_supervisionObra,
			fic_puerto,
			fic_gasRefTn,
			fic_gasRefBt,
			fic_valvulaElectronicaTn,
			fic_valvulaElectronicaBt,
			fic_tensionFaseFrec,
			fic_tempMaxExterna,
			fic_relevamiento,
			fic_condClimatica,
			fic_climaMarino,
			fic_nivelDescuento,
			fic_formatoPto)
		VALUES(
	    	'".$ID_art."',
			'".$fic_cod."',
			'".$fic_exhibArg."',
			'".$fic_exhibEur."',
			'".$fic_estudioEpic."',
			'".$fic_moExh."',
			'".$fic_camaras."',
			'".$fic_moCam."',
			'".$fic_evaporadores."', 			
			'".$fic_condensadores."',
			'".$fic_frioStd."',
			'".$fic_frioEsp."',
			'".$fic_moFri."',
			'".$fic_materialesObra."',
			'".$fic_ingenieria."',
			'".$fic_mediosElevacion."',
			'".$fic_flete."',
			'".$fic_viaticos."',
			'".$fic_incoternm."',
			'".$fic_supervisionObra."',
			'".$fic_puerto."',
			'".$fic_gasRefTn."',
			'".$fic_gasRefBt."',
			'".$fic_valvulaElectronicaTn."',
			'".$fic_valvulaElectronicaBt."',
			'".$fic_tensionFaseFrec."',
			'".$fic_tempMaxExterna."',
			'".$fic_relevamiento."',
			'".$fic_condClimatica."',
			'".$fic_climaMarino."',
			'".$fic_nivelDescuento."',
			'".$fic_formatoPto."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}


}

class status
{
	function dropStatus($ID_sta)
	{
		$sql="DELETE FROM status WHERE ID_sta=".$ID_sta."";
		$result = mysql_query($sql);
		return $result;
	}
	

function UpdateStatus($ID_sta, $sta_desc, $ser_tipo)
	{
		$sql="UPDATE status 
				SET sta_desc='".$sta_desc."',
				ser_tipo='".$ser_tipo."'
				WHERE ID_sta=".$ID_sta."";
				$result	=	mysql_query($sql);
				return $result;
	}	


	function InsertStatus($sta_desc, $ser_tipo)
	{
		$sql	=	"INSERT INTO status
					(sta_desc, ser_tipo)
					VALUES('". $sta_desc . "', '". $ser_tipo . "')";
		$insert		=	mysql_query($sql);
	}
	function getStatus()
	{
		$sql="SELECT * FROM status";
		$result	=	mysql_query($sql);
				return $result;
	
	}

	function getStatusById($ID_sta)
	{
		$sql = "SELECT * FROM status WHERE ID_sta=$ID_sta";
		$result		=	mysql_query($sql);
		return $result;
	}

	function getStatusBySerTipo($ser_tipo)
	{
		$sql    = "SELECT * FROM status WHERE ser_tipo='".$ser_tipo."'";
		$result	=  mysql_query($sql);
		return $result;
	}
}

class BDRD
{

	function insertArticulosBdrd($ID_tar, $art_numBDRD, $art_tipBDRD, $art_desc, $art_linea, $art_planBDRD, $art_plano, $art_planoDxf, $art_obs, $art_factBDRD, $art_regDate, $art_usuReg, $art_nota){
		$sql	=	"INSERT INTO articulos
					(ID_tar, art_numBDRD, art_tipBDRD, art_desc, art_linea, art_planBDRD, art_plano, art_planoDxf, art_obs, art_factBDRD, art_regDate, art_usuReg, art_nota)
					VALUES('". $ID_tar . "','" . $art_numBDRD . "','" . $art_tipBDRD . "','" . $art_desc . "','" . $art_linea . "','" . $art_planBDRD . "','" . $art_plano . "','" . $art_planoDxf . "','" . $art_obs . "','" . $art_factBDRD . "','" . $art_regDate . "','" . $art_usuReg . "','" . $art_nota . "')";
		$insert		=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function updateArticulosBdrd($ID_art, $art_numBDRD, $art_tipBDRD, $art_desc, $art_linea, $art_planBDRD, $art_plano, $art_planoDxf, $art_obs, $art_factBDRD, $art_modDate, $art_usuMod, $art_nota){
		if($art_planBDRD == ''){
			$planBDRD	=	'';
		} else {
			$planBDRD	=	"art_planBDRD='" . $art_planBDRD . "',";
		}
		if($art_plano == ''){
			$plano		=	'';
		} else {
			$plano		=	"art_plano='" . $art_plano . "',";
		}
		if($art_planoDxf == ''){
			$planoDxf		=	'';
		} else {
			$planoDxf		=	"art_planoDxf='" . $art_planoDxf . "',";
		}
		if($art_obs == ''){
			$obs		=	'';
		} else {
			$obs		=	"art_obs='" . $art_obs . "',";
		}
		$sql	=	"UPDATE articulos
					SET art_numBDRD='" . $art_numBDRD . "',
					art_tipBDRD='" . $art_tipBDRD ."',
					art_desc='" . $art_desc ."',
					art_linea='" . $art_linea ."',
					$planBDRD
					$plano
					$planoDxf
					$obs
					art_factBDRD='" . $art_factBDRD . "',
					art_modDate='" . $art_modDate . "',
					art_usuMod='" . $art_usuMod . "',
					art_nota='" . $art_nota . "'
					WHERE ID_art='" . $ID_art . "'";
			$update	=	mysql_query($sql);
			if(mysql_affected_rows() > 0){
				return 1;
			} else {
				return 0;
			}
	}

	function getArticulosBdrd($art_planBDRD)
	{
		$sql = "SELECT * FROM articulos 
				WHERE art_planBDRD='".$art_planBDRD."'";
				$result			  =	mysql_query($sql);
				return $result;
	}

}

class especiales
{


	function ProximoId($tabla)
	{
		$sql		= "SELECT AUTO_INCREMENT AS NEXTID FROM information_schema.tables WHERE table_name = '".$tabla."' AND table_schema='travel_expenses'";
		$result		= mysql_query($sql);
			return $result;
	}

function CartelDeUltimo($ID_tabla, $Fila_ID, $tabla)
{	
	
	 $sql="SELECT * FROM ".$tabla."  ORDER BY ".$Fila_ID." DESC LIMIT 1";
	 $result			=	mysql_query($sql);
	 $assoc_result 		= 	mysql_fetch_assoc($result);
	 $Varibale 			=	$assoc_result[$Fila_ID];

	 if($Varibale==$ID_tabla)
	 {
	 	 echo "<script>
                 function blink()
                  {
                  $('#Destacado').fadeTo(100, 0.1).fadeTo(200, 1.0).fadeTo(100, 0.1).fadeTo(200, 1.0).fadeTo(100, 0.1).fadeTo(200, 1.0);
                  }
                  setInterval(blink, 2200);

                  </script>";
                  echo "<img id='Destacado' src='../images/nuevo.png' style='width: 50px; float: right; >";
	 }
                
       return;            

}

function registro_presupuesto_nextid(){
		 $sql		=	"SELECT AUTO_INCREMENT AS NEXTID FROM information_schema.tables WHERE table_name = 'quotations' AND table_schema='travel_expenses'";
		 $result	=	mysql_query($sql);
		 return $result;
	 }


	//Funcion utilizada para mostrar en un select 10 años posteriores al actual 

	function listaYear($predeterminado)
	{	
		$yearActual=date("Y");
		$yearRestado = $yearActual-1;

		echo "<select style='margin: 10px; width: 90%;' class='form-control' name='year' id='year'>";
			echo "<option selected disabled>".$predeterminado."</option>";
			for ($i=0; $i < 10 ; $i++) { 
				$yearRestado = $yearRestado + 1;
				echo "<option>";
					echo $yearRestado;
				echo "</option>";
			}
		echo "</select>";
		return;
	}

	function getDescFechaByNuemero($num)
	{
		$mes=0;
		if($num==1)
		{
			$mes='Enero';
		}
		if($num==2)
		{
			$mes='Febrero';
		}
		if($num==3)
		{
			$mes='Marzo';
		}
		if($num==4)
		{
			$mes='Abril';
		}
		if($num==5)
		{
			$mes='Mayo';
		}
		if($num==6)
		{
			$mes='Junio';
		}
		if($num==7)
		{
			$mes='Julio';
		}
		if($num==8)
		{
			$mes='Agosto';
		}
		if($num==9)
		{
			$mes='Septiembre';
		}
		if($num==10)
		{
			$mes='Octubre';
		}
		if($num==11)
		{
			$mes='Noviembre';
		}
		if($num==12)
		{
			$mes='Diciembre';
		}

		return $mes;
	}
		function getDescFechaByNuemeroDosDigitos($num)
	{
		if($num==01)
		{
			$mes='Enero';
		}
		if($num==02)
		{
			$mes='Febrero';
		}
		if($num==03)
		{
			$mes='Marzo';
		}
		if($num==04)
		{
			$mes='Abril';
		}
		if($num==05)
		{
			$mes='Mayo';
		}
		if($num==06)
		{
			$mes='Junio';
		}
		if($num==07)
		{
			$mes='Julio';
		}
		if($num==08)
		{
			$mes='Agosto';
		}
		if($num==09)
		{
			$mes='Septiembre';
		}
		if($num==10)
		{
			$mes='Octubre';
		}
		if($num==11)
		{
			$mes='Noviembre';
		}
		if($num==12)
		{
			$mes='Diciembre';
		}

		return $mes;
	}
	function getAlerta($ID_ale)
	{
		$sql = "SELECT * FROM alertas
				WHERE ID_ale=".$ID_ale."";
				$result				=	mysql_query($sql);
				return $result;
	}

	function generateRandomString($length = 10)
	 { 
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length); 
	} 

	function generarCodigo($longitud) {
		 $key = '';
		 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
		 $max = strlen($pattern)-1;
		 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
		 return $key;
		}
}

class adjuntos 

{
	function getAdjuntosById($ID_adj)
	{

		$sql	=	"SELECT * FROM adjuntos
					WHERE ID_adj='" . $ID_adj . "'";
		$result				=	mysql_query($sql);
		return $result;

	}

	function getAdjuntosByAdjIdRelacion($adj_idRelacion, $adj_tablaRelacion)
	{

		$sql	=	"SELECT * FROM adjuntos
					WHERE adj_tablaRelacion='" . $adj_tablaRelacion . "' AND
					adj_idRelacion='" . $adj_idRelacion . "'";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;

	}

		function getAdjuntosByTipo($adj_tipo, $adj_idRelacion)
	{

		$sql	=	"SELECT *, DATE_FORMAT(adj_fecha, '%d-%m-%Y ' ' %H:%i:%s') as adj_fecha FROM adjuntos
					WHERE adj_tipo ='".$adj_tipo."' AND adj_idRelacion ='".$adj_idRelacion."'";
		$result				=	mysql_query($sql);
		return $result;

	}

			function getAdjuntosUltimoByTipo($adj_tipo)
	{

		$sql	=	"SELECT * FROM adjuntos
					WHERE adj_tipo ='".$adj_tipo."' ORDER BY ID_adj DESC LIMIT 1";
		$result				=	mysql_query($sql);
		return $result;

	}

	function generaBotonPresupuesto($adj_idRelacion, $adj_tablaRelacion)
	{

		$sql	=	"SELECT * FROM adjuntos
					WHERE adj_tablaRelacion='" . $adj_tablaRelacion . "' AND
					adj_idRelacion='" . $adj_idRelacion . "' AND
					adj_tipo='1'";
		 $result	=	mysql_query($sql);
		 $genComRows	=	mysql_num_rows($result);
		return $array = array("0" => $genComRows, "1" => $result,);
	
	}

	function dropAdjuntos($ID_adj)
	{
		$sql	=	"DELETE FROM adjuntos
					WHERE ID_adj='" . $ID_adj . "'";
		$result	=	mysql_query($sql);
		return $result;
	
	}

	function insertAdjuntos($ID_usu, $adj_idRelacion, $adj_tablaRelacion, $adj_ruta, $adj_desc, $adj_fecha)
	{
		$sql	=	"INSERT INTO adjuntos
						(ID_usu, adj_idRelacion, adj_tablaRelacion, adj_ruta, adj_desc, adj_fecha)
						VALUES('".$ID_usu."', '".$adj_idRelacion."', '".$adj_tablaRelacion."', '".$adj_ruta."', '".$adj_desc."', '".$adj_fecha."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

		function insertAdjuntosSisco($ID_usu, $adj_tipo, $adj_idRelacion, $adj_tablaRelacion, $adj_ruta, $adj_desc, $adj_fecha)
	{
		$sql	=	"INSERT INTO adjuntos
						(ID_usu, adj_tipo, adj_idRelacion, adj_tablaRelacion, adj_ruta, adj_desc, adj_fecha)
						VALUES('".$ID_usu."', '".$adj_tipo."', '".$adj_idRelacion."', '".$adj_tablaRelacion."', '".$adj_ruta."', '".$adj_desc."', '".$adj_fecha."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function updateAdjuntos($ID_adj, $ID_usu, $adj_tipo, $adj_idRelacion, $adj_tablaRelacion, $adj_ruta, $adj_desc, $adj_fecha)
	{
		$sql	=	"UPDATE SET 
						ID_usu 				=".$ID_usu.",
						adj_tipo			=".$adj_tipo.",
						adj_idRelacion		=".$adj_idRelacion.",
						adj_tablaRelacion	=".$adj_tablaRelacion.",
						adj_ruta			=".$adj_ruta.",
						adj_desc			=".$adj_desc.",
						adj_fecha			=".$adj_fecha."
						WHERE ID_adj=".$ID_adj."";
						
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
}

class prioridades {


	function getPrioridades(){
		$sql	=	"SELECT * FROM prioridades";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getPrioridadesById($ID_pri){
		$sql	=	"SELECT * FROM prioridades WHERE ID_pri=".$ID_pri."";
		$result				=	mysql_query($sql);
		return $result;
	}



}

class competidores
{
	function GetCompetidores($ID_emp)
	{
		$sql	=	"SELECT * FROM competidores
					WHERE ID_emp=$ID_emp
					ORDER BY com_nombre ASC";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function GetCompetidoresById($ID_com)
	{
			$sql	=	"SELECT * FROM competidores
					    WHERE ID_com='".$ID_com."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function generaCompetidores($ID_emp){
		$sql	=	"SELECT * FROM competidores
					WHERE ID_emp=$ID_emp
					ORDER BY com_nombre ASC";
		$result				=	mysql_query($sql);
		$this->genComRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genComRows;$i++){
			$com	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $com['ID_com'] . '">' . $com['com_nombre'] . '</option>';
		}
	}


	function insertCompetidor($com_nombre, $ID_emp)
	{
		$sql	=	"INSERT INTO competidores
					(com_nombre, ID_emp)
					VALUES('". $com_nombre . "','" . $ID_emp . "')";
		$insert		=	mysql_query($sql);
	}

}

class obras_sector
{

	function getObras_sectorById_obr ($ID_obr){
		$sql	=	"SELECT * FROM obras_sector
					 	WHERE ID_obr='".$ID_obr."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getObras_sectorById ($ID_sec){
		$sql	=	"SELECT * FROM obras_sector
					 	WHERE ID_sec='".$ID_sec."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function insertSector($ID_obr, $sec_desc)
	{
		$sql	=	"INSERT INTO obras_sector
						(ID_obr, sec_desc)
						VALUES('".$ID_obr."', '".$sec_desc."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function updateSector($ID_sec, $ID_obr, $sec_desc)
	{
		$sql	=	"UPDATE obras_sector
					SET ID_obr='" . $ID_obr . "',
					sec_desc='" . $sec_desc . "'
					WHERE ID_sec='" . $ID_sec . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	function dropSector($ID_sec)
	{
		$sql="SELECT * FROM obras_sistema WHERE ID_sec='".$ID_sec."'";
		$sql1=mysql_query($sql);
		$sql2=mysql_num_rows($sql1);
		if($sql2==0)
		{
			$sql4			=	"DELETE FROM obras_sector
							WHERE ID_sec='" . $ID_sec . "'";
			$result4		=	mysql_query($sql4);
			return 2;
		}
		else
		{
		    return 3;
		}

		
	}
	function getUltimoSectorByIdObr($ID_obr)
	{

		$sql	=	"SELECT * FROM obras_sector
					WHERE ID_obr='" . $ID_obr . "' ORDER BY ID_sec DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;

	}

}

class obras_sistema
{

	function getobras_sistemaById ($ID_sis){
		$sql	=	"SELECT * FROM obras_sistema
					 	WHERE ID_sis='".$ID_sis."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function getobras_sistemaById_obr ($ID_obr){
		$sql	=	"SELECT * FROM obras_sistema
					 	WHERE ID_obr='".$ID_obr."' ORDER BY ID_sec DESC";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function getobras_sistemaById_sec ($ID_obr, $ID_sec){
		$sql	=	"SELECT * FROM obras_sistema
					 	WHERE ID_obr='".$ID_obr."' AND ID_sec='".$ID_sec."' ORDER BY ID_sec DESC";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertSistema($ID_obr, $ID_sec, $sis_desc)
	{
		$sql	=	"INSERT INTO obras_sistema
						(ID_obr, ID_sec, sis_desc)
						VALUES('".$ID_obr."', '".$ID_sec."', '".$sis_desc."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function updateSistema($ID_sis, $ID_obr, $ID_sec, $sis_desc)
	{
		$sql	=	"UPDATE obras_sistema
					SET ID_obr='" . $ID_obr . "',
					 ID_sec='" . $ID_sec . "',
					sis_desc='" . $sis_desc . "'
					WHERE ID_sis='" . $ID_sis . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function dropSistema($ID_sis)
	{
		$sql="SELECT * FROM equipos_obras WHERE ID_sis='".$ID_sis."'";
		$sql1=mysql_query($sql);
		$sql2=mysql_num_rows($sql1);
		if($sql2==0)
		{
			$sql4			=	"DELETE FROM obras_sistema
							WHERE ID_sis='" . $ID_sis . "'";
			$result4		=	mysql_query($sql4);
			return 2;
		}
		else
		{
		    return 3;
		}
	}

}
class tipo_equipos
{

		function getTipo_equiposById ($ID_tpe){
		$sql	=	"SELECT * FROM tipo_equipos
					 	WHERE ID_tpe='".$ID_tpe."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getTipo_equiposById_emp ($ID_emp){
		$sql	=	"SELECT * FROM tipo_equipos
					 	WHERE ID_emp='".$ID_emp."' ORDER BY ID_tpe DESC";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function insertTipo_equipos($ID_emp, $tpe_desc)
	{
		$sql	=	"INSERT INTO tipo_equipos
						(ID_emp, tpe_desc)
						VALUES('".$ID_emp."', '".$tpe_desc."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

}
class equipos_obras
{
	function getEquipos_obrasById ($ID_equ){
		$sql	=	"SELECT * FROM equipos_obras
					 	WHERE ID_equ='".$ID_equ."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

		function getUltimoEquipos_obrasById_sis ($ID_sis){
		$sql	=	"SELECT * FROM equipos_obras
					 	WHERE ID_sis='".$ID_sis."' ORDER BY ID_equ DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getEquipos_obrasById_sis ($ID_sis){
		$sql	=	"SELECT * FROM equipos_obras
					 	WHERE ID_sis='".$ID_sis."'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertEquipos_obras($ID_obr, $ID_sec, $ID_sis, $ID_tpe, $equ_cod, $equ_desc, $equ_detalles)
	{
		$sql	=	"INSERT INTO equipos_obras
						(ID_obr, ID_sec, ID_sis, ID_tpe, equ_cod, equ_desc, equ_detalles)
						VALUES('".$ID_obr."', '".$ID_sec."', '".$ID_sis."', '".$ID_tpe."', '".$equ_cod."', '".$equ_desc."', '".$equ_detalles."')";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
		function updateEquipos_obras($ID_equ, $ID_obr, $ID_sec, $ID_sis, $ID_tpe, $equ_cod, $equ_desc, $equ_detalles)
	{
		$sql	=	"UPDATE equipos_obras
						SET ID_obr='".$ID_obr."', 
						ID_sec='".$ID_sec."', 
						ID_sis='".$ID_sis."', 
						ID_tpe='".$ID_tpe."', 
						equ_cod='".$equ_cod."', 
						equ_desc='".$equ_desc."',
						equ_detalles='".$equ_detalles."'
						WHERE ID_equ='".$ID_equ."'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

			function dropEquipo($ID_equ)
	{
			$sql			=	"DELETE FROM equipos_obras
							WHERE ID_equ='" . $ID_equ . "'";
			$result		=	mysql_query($sql);
			return mysql_affected_rows();
	}

}

class access_control
{
	function getAccessControlByIdUsu($ID_usu)
	{
		$sql			=	"SELECT *,DATE_FORMAT(acc_datein, '%d-%m-%Y') as acc_datein FROM access_control WHERE ID_usu='" . $ID_usu . "' ORDER BY ID_acc DESC LIMIT 5";
		$result		=	mysql_query($sql);
		return $result;
	}


}

class permisos {
/*
*
* This class will be used to check the users's permission to access to the php files, and give or remove permissions.
*
*/
	function checkPermiso($ID_usu, $for_desc){
		$sql	=	"SELECT * FROM permisos, formularios
					WHERE permisos.ID_for=formularios.ID_for AND
					ID_usu='" . $ID_usu . "' AND
					formularios.for_desc='" . $for_desc . "'";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;
	}
	function getPermisos($ID_emp, $ID_sis, $ID_mod, $ID_usu){
		if($ID_emp){
			$emp	=	"AND empresas.ID_emp='" . $ID_emp . "'";
		} else {
			$emp	=	'';
		}
		if($ID_sis){
			$sis	=	"AND sistemas.ID_sis='" . $ID_sis . "'";
		} else {
			$sis	=	'';
		}
		if($ID_mod){
			$mod	=	"AND modulos.ID_mod='" . $ID_mod . "'";
		} else {
			$mod	=	'';
		}
		if($ID_usu){
			$usu	=	"AND usuarios.ID_usu='" . $ID_usu . "'";
		} else {
			$usu	=	'';
		}
		$sql	=	"SELECT * FROM permisos, formularios, modulos, usuarios, empresas, sistemas
					WHERE permisos.ID_for = formularios.ID_for AND
					permisos.ID_usu = usuarios.ID_usu AND
					formularios.ID_mod = modulos.ID_mod AND
					permisos.ID_emp = empresas.ID_emp AND
					sistemas.ID_sis=modulos.ID_sis
					$emp
					$sis
					$usu
					$mod
					GROUP BY usuarios.usu_username, modulos.mod_desc
					ORDER BY sistemas.sis_desc, modulos.mod_desc, usuarios.usu_username ASC";
		$result			=	mysql_query($sql);
		$this->permRows	=	mysql_num_rows($result);
		return $result;
	}
	function getPermisosByUsuFor($ID_mod, $ID_usu){
		$sql	=	"SELECT * FROM permisos, formularios
					WHERE permisos.ID_for=formularios.ID_for AND
					permisos.ID_usu='" . $ID_usu ."' AND
					formularios.ID_mod='" . $ID_mod . "'";
		$result					=	mysql_query($sql);
		$this->permByUsuForRows	=	mysql_num_rows($result);
		return $result;
	}
	function getModulosByUsu($ID_usu){
		$sql	=	"SELECT * FROM sistemas, modulos, formularios, permisos
					WHERE sistemas.ID_sis=modulos.ID_sis AND
					modulos.ID_mod=formularios.ID_mod AND
					formularios.ID_for=permisos.ID_for AND
					permisos.ID_usu='". $ID_usu . "' AND
					GROUP BY modulos.ID_mod
					ORDER BY modulos.mod_prioridad ASC";
		$result				=	mysql_query($sql);
		$this->modByUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertPermisos($ID_emp, $ID_for, $ID_usu){
		$sqlCheck	=	"SELECT * FROM permisos
						WHERE permisos.ID_emp='" . $ID_emp . "' AND
						permisos.ID_usu='" . $ID_usu . "' AND
						permisos.ID_for='" . $ID_for . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkPermRows	=	mysql_num_rows($resultCheck);
		if($checkPermRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO permisos
						(ID_emp, ID_for, ID_usu)
						VALUES('" . $ID_emp . "','" . $ID_for . "','" . $ID_usu . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function dropPermisos($ID_per){
		$sql	=	"DELETE FROM permisos
					WHERE ID_per='" . $ID_per . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class formularios {
/*
*
* This class is used for query, create, update or delete registries on formularios table
*
*/
	function getFormularios(){
		$sql	=	"SELECT * FROM formularios, modulos, sistemas
					WHERE formularios.ID_mod=modulos.ID_mod AND
					modulos.ID_sis=sistemas.ID_sis
					ORDER BY sistemas.sis_desc, modulos.mod_desc, formularios.for_desc ASC";
		$result			=	mysql_query($sql);
		$this->formRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosById($ID_for){
		$sql	=	"SELECT * FROM formularios, modulos, submodulos, sistemas
					WHERE formularios.ID_mod=modulos.ID_mod AND
					formularios.ID_sub=submodulos.ID_sub AND
					modulos.ID_sis=sistemas.ID_sis AND
					formularios.ID_for='" . $ID_for . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
		function getFormulariosByDesc($for_desc){

		$ID_sis=9;
		$sql	=	"SELECT * FROM formularios, modulos, submodulos, sistemas
					WHERE formularios.ID_mod=modulos.ID_mod AND
					formularios.ID_sub=submodulos.ID_sub AND
					modulos.ID_sis=sistemas.ID_sis AND
					formularios.for_desc='" . $for_desc . "' AND modulos.ID_sis='" . $ID_sis . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function getFormulariosByMod($ID_mod){
		$sql	=	"SELECT * FROM formularios
					WHERE formularios.ID_mod='" . $ID_mod . "'";
		$result					=	mysql_query($sql);
		$this->formByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertFormularios($ID_mod, $ID_sub, $for_desc, $for_nombre, $for_nom_muestra, $for_muestra){
		$modulos		=	new modulos();
		$getModulosById	=	$modulos->getModulosById($ID_mod);
		$modulosById	=	mysql_fetch_assoc($getModulosById);
		$sqlCheck	=	"SELECT * FROM sistemas, modulos, formularios
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						modulos.ID_mod=formularios.ID_mod AND
						sistemas.ID_sis='" . $modulosById['ID_sis'] . "' AND
						formularios.for_desc='" . $for_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO formularios
						(ID_mod, ID_sub, for_desc, for_nombre, for_nom_muestra, for_muestra)
						VALUES('" . $ID_mod ."','" . $ID_sub ."','" . $for_desc . "','" . $for_nombre . "','" . $for_nom_muestra . "','" . $for_muestra . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function updateFormularios($ID_for, $ID_mod, $ID_sub, $for_desc, $for_nombre, $for_nom_muestra, $for_muestra){
		$modulos		=	new modulos();
		$getModulosById	=	$modulos->getModulosById($ID_mod);
		$modulosById	=	mysql_fetch_assoc($getModulosById);
		$sqlCheck	=	"SELECT * FROM sistemas, modulos, formularios
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						modulos.ID_mod=formularios.ID_mod AND
						sistemas.ID_sis='" . $modulosById['ID_sis'] . "' AND
						formularios.for_desc='" . $for_desc . "' AND
						formularios.ID_for<>'" . $ID_for . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"UPDATE formularios
						SET ID_mod='" . $ID_mod . "',
						ID_sub='" . $ID_sub . "',
						for_desc='" . $for_desc . "',
						for_nombre='" . $for_nombre . "',
						for_nom_muestra='" . $for_nom_muestra . "',
						for_muestra='" . $for_muestra . "'
						WHERE ID_for='" . $ID_for . "'";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function dropFormularios($ID_for){
		$sql	=	"DELETE FROM formularios
					WHERE formularios.ID_for='" . $ID_for . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class modulos {
/*
*
* This class is used for query, create, update or delete registries on modulos table
*
*/
	function getModulos(){
		$sql	=	"SELECT * FROM modulos, sistemas
					WHERE modulos.ID_sis=sistemas.ID_sis
					ORDER BY sistemas.sis_desc, modulos.mod_desc ASC";
		$result			=	mysql_query($sql);
		$this->modRows	=	mysql_num_rows($result);
		return $result;
	}
	function getModulosById($ID_mod){
		$sql	=	"SELECT * FROM modulos, sistemas
					WHERE modulos.ID_sis=sistemas.ID_sis AND
					modulos.ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function insertModulos($ID_sis, $mod_desc, $mod_nom_muestra, $mod_prioridad, $mod_muestra){
		$sqlCheck	=	"SELECT * FROM modulos
						WHERE modulos.ID_sis='" . $ID_sis . "' AND
						modulos.mod_desc='" . $mod_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO modulos
						(ID_sis, mod_desc, mod_nom_muestra, mod_prioridad, mod_muestra)
						VALUES('" . $ID_sis . "','" . $mod_desc . "','" . $mod_nom_muestra . "','" . $mod_prioridad . "','" . $mod_muestra . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function updateModulos($ID_sis, $ID_mod, $mod_desc, $mod_nom_muestra, $mod_prioridad, $mod_muestra){
		$sqlCheck	=	"SELECT * FROM sistemas, modulos
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						sistemas.ID_sis='" . $ID_sis . "' AND
						modulos.mod_desc='" . $mod_desc . "' AND
						modulos.ID_mod<>'" . $ID_mod . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkModRows	=	mysql_num_rows($resultCheck);
		if($checkModRows != 0){
			return 0;
		} else {
			$sql	=	"UPDATE modulos
						SET ID_sis='" . $ID_sis . "',
						mod_desc='" . $mod_desc . "',
						mod_nom_muestra='" . $mod_nom_muestra . "',
						mod_prioridad='" . $mod_prioridad . "',
						mod_muestra='" . $mod_muestra . "'
						WHERE ID_mod='" . $ID_mod . "'";
			$update	=	mysql_query($sql);
			return 1;
		}
	}
	function dropModulos($ID_mod){
		$sql	=	"DELETE FROM modulos
					WHERE modulos.ID_mod='" . $ID_mod . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class submodulos {

	function getSubmodulos(){
		$sql	=	"SELECT * FROM submodulos, modulos
					WHERE submodulos.ID_mod=modulos.ID_mod
					ORDER BY modulos.mod_desc, submodulos.sub_desc ASC";
		$result			=	mysql_query($sql);
		$this->subRows	=	mysql_num_rows($result);
		return $result;
	}
}
class motivos_rechazo {

	function getMotivosRechazoIdEmp($ID_emp){
		$sql	=	"SELECT * FROM motivos_rechazo
					WHERE ID_emp=$ID_emp AND mot_tipo='1'
					ORDER BY mot_desc ASC";
		$result			=	mysql_query($sql);
		$this->motRows	=	mysql_num_rows($result);
		return $result;
	}
	function generaMotivosRechazo($ID_emp){
		$sql	=	"SELECT * FROM motivos_rechazo
					WHERE ID_emp=$ID_emp AND mot_tipo='1'
					ORDER BY mot_desc ASC";
		$result				=	mysql_query($sql);
		$this->genMotRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genMotRows;$i++){
			$mot	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $mot['ID_mot'] . '">' . $mot['mot_desc'] . '</option>';
		}
	}
		function getMotivosRechazoIdMot($ID_mot){
		$sql	=	"SELECT * FROM motivos_rechazo
					WHERE ID_mot=$ID_mot AND mot_tipo='1'
					ORDER BY mot_desc ASC";
		$result			=	mysql_query($sql);
		$this->motRows	=	mysql_num_rows($result);
		return $result;
	}

	function getMotivosRechazoIdmot2($ID_emp){
		$sql	=	"SELECT * FROM motivos_rechazo
					WHERE ID_emp=$ID_emp AND mot_tipo='2'
					ORDER BY mot_desc ASC";
		$result			=	mysql_query($sql);
		$this->motRows	=	mysql_num_rows($result);
		return $result;
	}
}
class sistemas {
/*
*
* 
*
*/
	function getSistemas(){
		$sql	=	"SELECT * FROM sistemas
					ORDER BY sistemas.sis_desc ASC";
		$result			=	mysql_query($sql);
		$this->sisRows	=	mysql_num_rows($result);
		return $result;
	}
	function getSistemasById($ID_sis){
		$sql	=	"SELECT * FROM sistemas
					WHERE ID_sis='" . $ID_sis . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
}
class empresas {
/*
*
* 
*
*/
	function getEmpresas(){
		$sql	=	"SELECT * FROM empresas
					ORDER BY empresas.emp_nombre ASC";
		$result			=	mysql_query($sql);
		$this->empRows	=	mysql_num_rows($result);
		return $result;
	}
	function getEmpresasById($ID_emp){
		$sql	=	"SELECT * FROM empresas
					WHERE
					empresas.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function getParametrosEmpresa($ID_emp){
		$sql	=	"SELECT * FROM empresas_param
					WHERE empresas_param.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function generaEmpresas(){
		$sql	=	"SELECT * FROM empresas
					ORDER BY empresas.emp_nombre ASC";
		$result				=	mysql_query($sql);
		$this->genEmpRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genEmpRows;$i++){
			$emp	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $emp['ID_emp'] . '">' . $emp['emp_nombre'] . '</option>';
		}
	}
	function validateEmpresaCuitA($emp_cuit){
		$sql	=	"SELECT * FROM empresas
					WHERE empresas.emp_cuit='" . $emp_cuit . "'";
		$result				=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function validateEmpresaCuitM($emp_cuit, $ID_emp){
		$sql	=	"SELECT * FROM empresas
					WHERE empresas.emp_cuit='" . $emp_cuit . "' AND
					empresas.ID_emp<>'" . $ID_emp . "'";
		$result				=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function insertEmpresas($emp_nombre, $emp_cuit, $emp_dir, $emp_contacto, $emp_tel, $emp_mail, $emp_cod, $emp_cantusu, $emp_habilitada){
		$sql	=	"INSERT INTO empresas
					(emp_nombre, emp_cuit, emp_dir, emp_contacto, emp_tel, emp_mail, emp_cod, emp_cantusu, emp_habilitada)
					VALUES('" . $emp_nombre . "','" . $emp_cuit . "','" . $emp_dir . "','" . $emp_contacto . "','" . $emp_tel . "','" . $emp_mail . "','" . $emp_cod . "','" . $emp_cantusu . "','" . $emp_habilitada . "')";
		$insert				=	mysql_query($sql);
		$ID_emp				=	mysql_insert_id();
		$sqlAdd	=	"INSERT INTO empresas_param
					(ID_emp)
					VALUES('" . $ID_emp . "')";
		$insertAdd	=	mysql_query($sqlAdd);
		return mysql_affected_rows();
	}
	function updateEmpresas($ID_emp, $emp_nombre, $emp_cuit, $emp_dir, $emp_contacto, $emp_tel, $emp_mail, $emp_cod, $emp_cantusu, $emp_habilitada){
		$sql	=	"UPDATE empresas
					SET emp_nombre='" . $emp_nombre . "',
					emp_cuit='" . $emp_cuit . "',
					emp_dir='" . $emp_dir . "',
					emp_contacto='" . $emp_contacto . "',
					emp_tel='" . $emp_tel . "',
					emp_mail='" . $emp_mail . "',
					emp_cod='" . $emp_cod . "',
					emp_cantusu='" . $emp_cantusu . "',
					emp_habilitada='" . $emp_habilitada . "'
					WHERE ID_emp='" . $ID_emp . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	function updateParametrosEmpresas($ID_emp, $par_diatope, $par_tesorero){
		$sql	=	"UPDATE empresas_param
					SET par_diatope='" . $par_diatope . "',
					par_tesorero='" . $par_tesorero . "'
					WHERE ID_emp='" . $ID_emp . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	function dropEmpresas($ID_emp){
		$sql	=	"DELETE FROM empresas
					WHERE empresas.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class usuarios {

	 function vendedores(){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_tpu='11' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);

   			 $num_ven                          = mysql_num_rows($result);

		  for($aVendedores=0; $aVendedores<$num_ven; $aVendedores++)
                      {
                        $ven      = mysql_fetch_assoc($result);
                        echo  '<option value="' . $ven['ID_usu'] . '">' . $ven['usu_apellido'] . ' ' . $ven['usu_nombre'] . '</option>';

                      }
		    return;
	 }

 function getUsuariosByIdTpu($ID_tpu){
		 $sql		=	"SELECT * FROM usuarios WHERE ID_tpu='".$ID_tpu."' ORDER BY usu_apellido ASC";
		 $result	=	mysql_query($sql);
		 return $result;
		}

function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}

	function getUsuariosVendedores(){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND
					 (tipo_usuarios.ID_tpu=2 OR 
					tipo_usuarios.ID_tpu=8 OR
					tipo_usuarios.ID_tpu=9 )
					ORDER BY usuarios.usu_nombre, usuarios.usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->usuRows	=	mysql_num_rows($result);
		return $result;
	}


	function getUsuarios(){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND 
					 tipo_usuarios.ID_tpu!=24
					ORDER BY usuarios.usu_nombre, usuarios.usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->usuRows	=	mysql_num_rows($result);
		return $result;
	}

		function getUsuariosByIdUsuGer($ID_usu){
		$sql	=	"SELECT * FROM usuarios
					WHERE ID_usu_ger=".$ID_usu."";
		$result			=	mysql_query($sql);
		$this->usuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getUsuariosById($ID_usu){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND
					usuarios.ID_usu='" . $ID_usu . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function genereaUsuariosNomApe($ID_usu){
		$sql	=	"SELECT * FROM usuarios
					WHERE ID_usu=".$ID_usu."";
		$result	=	mysql_query($sql);
		$usuId  =	mysql_fetch_assoc($result);
		return 	$usuId['usu_apellido']." ".$usuId['usu_nombre'];
	}

	function generaUsuariosPresupuestistas($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND
					usuarios.ID_emp=$ID_emp AND
					tipo_usuarios.ID_tpu='27'
					ORDER BY usuarios.usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->UsuPresupRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->UsuPresupRows;$i++){
			$usu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $usu['ID_usu'] . '">' . $usu['usu_apellido'] . ' ' . $usu['usu_nombre'] . '</option>';
		}
		}

		function generaUsuariosVendedoresInternos($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND
					usuarios.ID_emp=$ID_emp AND
					tipo_usuarios.ID_tpu='8'
					ORDER BY usuarios.usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->UsuPresupRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->UsuPresupRows;$i++){
			$usu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $usu['ID_usu'] . '">' . $usu['usu_apellido'] . ' ' . $usu['usu_nombre'] . '</option>';
		}

		
	}
	function getUsuariosByEmail($usu_email, $ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios WHERE usuarios.ID_emp=empresas.ID_emp AND usuarios.ID_tpu=tipo_usuarios.ID_tpu AND usuarios.usu_email='$usu_email' AND empresas.emp_cod='$ID_emp'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function getUsuariosByEmpresa($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_emp='" . $ID_emp . "'
					ORDER BY usuarios.usu_apellido ASC";
		$result				=	mysql_query($sql);
		$this->usuByEmpRows	=	mysql_num_rows($result);
		return $result;
	}
	function generaUsuGer($ID_emp){
		$sql	=	"SELECT * FROM usuarios
					WHERE usuarios.ID_emp='" . $ID_emp . "'
					ORDER BY usuarios.usu_apellido ASC";
		$result				=	mysql_query($sql);
		$this->UsuGerRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->UsuGerRows;$i++){
			$usu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $usu['ID_usu'] . '">' . $usu['usu_apellido'] . ' ' . $usu['usu_nombre'] . '</option>';
		}
	}		
	function validateUsuario($usu_username, $ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.usu_username='" . $usu_username . "' AND
					usuarios.ID_emp='" . $ID_emp . "'";
		$result		=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function insertUsuario($ID_emp, $usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger, $cambia_clave, $usu_habilitado, $usu_obr){
		$sql	=	"INSERT INTO usuarios
					(ID_emp, usu_username, usu_password, usu_nombre, usu_apellido, usu_legajo, usu_cco, usu_telefono, usu_email, usu_tarjeta, ID_tpu, ID_usu_ger, usu_clave, usu_habilitado, usu_obr)
					VALUES('". $ID_emp . "','". $usu_username . "','" . $usu_password . "','" . $usu_nombre . "','" . $usu_apellido . "','" . $usu_legajo . "','" . $usu_cco . "','" . $usu_telefono . "','" . $usu_email . "','" . $usu_tarjeta . "','" . $ID_tpu . "','" . $ID_usu_ger . "','" . $cambia_clave . "','" . $usu_habilitado . "','" . $usu_obr . "')";
		$insert		=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function updateUsuario($ID_usu, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger, $usu_habilitado, $usu_obr){
		$sql	=	"UPDATE usuarios
					SET usu_password='" . $usu_password ."',
					usu_nombre ='" . $usu_nombre . "',
					usu_apellido='" . $usu_apellido ."',
					usu_legajo='" . $usu_legajo ."',
					usu_telefono='" . $usu_telefono ."',
					usu_email='" . $usu_email . "',
					usu_tarjeta='" . $usu_tarjeta . "',
					ID_tpu='" . $ID_tpu . "',
					ID_usu_ger='" . $ID_usu_ger . "',
					usu_cco='" . $usu_cco . "',
					usu_habilitado='" . $usu_habilitado . "',
					usu_obr='" . $usu_obr . "'
					WHERE ID_usu='" . $ID_usu . "'";
			$update	=	mysql_query($sql);
			if(mysql_affected_rows() > 0){
				return 1;
			} else {
				return 0;
			}
	}
	function updateUsuarioRecuperaClave($ID_usu, $usu_password, $usu_clave){
		$sql	=	"UPDATE usuarios
					SET usu_password	=	'" . $usu_password ."',
					usu_clave 			=	'" . $usu_clave ."'
					WHERE ID_usu 		=	'" . $ID_usu . "'";
			$update	=	mysql_query($sql);
			if(mysql_affected_rows() > 0){
				return 1;
			} else {
				return 0;
			}
			
			
	}
	function dropUsuario($ID_usu){
		$sql	=	"DELETE FROM usuarios
					WHERE usuarios.ID_usu='" . $ID_usu . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function optionUsuarios($id)
	{

		$usuarios = new usuarios;
		$getUsuarios  = $usuarios->getUsuarios() ;
		$num_getUsuarios = mysql_num_rows($getUsuarios);

		$getUsuariosById = $usuarios->getUsuariosById($id);
		$assoc_getUsuariosById = mysql_fetch_assoc($getUsuariosById);

		      echo "<select style='margin: 10px; width: 90%;' name='ID_usu'  class='form-control' id='ID_usu'>";
		       echo "<option selected value='".$id."'>".$assoc_getUsuariosById['usu_nombre']." ".$assoc_getUsuariosById['usu_apellido']."</option>";
               for ($x=0; $x < $num_getUsuarios; $x++)
               { 
                    $assoc_getUsuarios=mysql_fetch_assoc($getUsuarios);
                  echo "<option value='".$assoc_getUsuarios['ID_usu']."'>".$assoc_getUsuarios['usu_nombre']." ".$assoc_getUsuarios['usu_apellido']."</option>";
                }
           echo "</select>";

	}
}
class tipoUsuarios {
/*
*
* 
*
*/
	function getTipoUsuarios(){
		$sql	=	"SELECT * FROM tipo_usuarios
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTipoUsuariosById($ID_tpu){
		$sql	=	"SELECT * FROM tipo_usuarios
					WHERE tipo_usuarios.ID_tpu='" . $ID_tpu . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function generaTipoUsuarios(){
		$sql	=	"SELECT * FROM tipo_usuarios
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->tipoUsuRows;$i++){
			$tpu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tpu['ID_tpu'] . '">' . $tpu['tpu_desc'] . '</option>';
		}
	}
	function generaTipoUsuariosEmp($ID_empUsu){
		$sql	=	"SELECT * FROM tipo_usuarios WHERE
					tipo_usuarios.ID_emp='" . $ID_empUsu . "'
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->tipoUsuRows;$i++){
			$tpu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tpu['ID_tpu'] . '">' . $tpu['tpu_desc'] . '</option>';
		}
	}
	function insertTipoUsuarios($ID_emp, $tpu_cod, $tpu_desc){
		$sqlCheck	=	"SELECT * FROM tipo_usuarios
						WHERE tipo_usuarios.ID_emp='" . $ID_emp . "' AND
						tipo_usuarios.tpu_desc='" . $tpu_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkTpuRows	=	mysql_num_rows($resultCheck);
		if($checkTpuRows != 0){
			$sql	=	"INSERT INTO tipo_usuarios
						(ID_emp,tpu_cod,tpu_desc)
						VALUES('" . $ID_emp . "','" . $tpu_cod . "','" . $tpu_desc . "')";
			return 1;
		} else {
			return 0;
		}
	}
}
class monedas {
/*
*
* 
*
*/
	function insertMonedas($ID_emp, $ID_tmo, $mon_desc, $mon_cotizacion){
		$sql	=	"INSERT INTO monedas
					(ID_emp, ID_tmo, mon_desc, mon_cotizacion, mon_habilitado)
					VALUES('" . $ID_emp . "','" . $ID_tmo . "','" . $mon_desc  ."','" . $mon_cotizacion  ."','1')";
		$insert	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function generaMonedasIdEmp($ID_emp){
		$sql	=	"SELECT * FROM monedas, tipo_moneda
					WHERE monedas.ID_tmo=tipo_moneda.ID_tmo AND
					monedas.mon_habilitado=1 AND
					monedas.ID_emp=$ID_emp
					ORDER BY tipo_moneda.tmo_desc ASC";
		$result				=	mysql_query($sql);
		$this->monRows		=	mysql_num_rows($result);
		for($i=0;$i<$this->monRows;$i++){
			$mon	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $mon['ID_mon'] . '">' . $mon['tmo_desc'] . ' ('.$mon['mon_desc'].' / '.$mon['mon_cotizacion'].')</option>';
		}
	}
}
class tipo_moneda {

	function getTipo_moneda()
	{
		$sql="SELECT * FROM tipo_moneda";
			$result				=	mysql_query($sql);
		return $result;
	}
		function getTipo_monedaById($ID_tmo)
	{
		$sql="SELECT * FROM tipo_moneda WHERE ID_tmo=".$ID_tmo."";
			$result				=	mysql_query($sql);
		return $result;
	}
}
class lugares {
/*
*
* 
*
*/
	function insertLugares($ID_emp, $lug_cod, $lug_desc, $ID_tmo, $lug_default){
		$sqlCheck	=	"SELECT * FROM lugares
						WHERE lugares.ID_emp='" . $ID_emp . "' AND
						lugares.lug_desc='" . $lug_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkLugRows	=	mysql_num_rows($resultCheck);
		if($checkLugRows != 0){
			$sql	=	"INSERT INTO lugares
						(ID_emp, lug_cod, lug_desc, ID_tmo, lug_default)
						VALUES('" . $ID_emp . "','" . $lug_cod . "','" . $lug_desc  ."','" . $ID_tmo  ."','" . $lug_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
}






class registro_servicio
{


	

	function getRegistroServiciosHistorialNEClientesUserDia($ID_usu)
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT clientes.cli_desc, clientes.ID_cli FROM registro_servicio, clientes WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ser_asig=".$ID_usu." AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}

		function getRegistroServiciosHistorialNEClientesUser($ID_usu)
	{
		
		$sql = "SELECT DISTINCT clientes.cli_desc, clientes.ID_cli FROM registro_servicio, clientes WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ser_asig=".$ID_usu."";
				$result = mysql_query($sql);
				return $result;
	}

		function getRegistroServiciosHistorialNEClientesUserDiaBackOffice()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT clientes.cli_desc, clientes.ID_cli FROM registro_servicio, clientes WHERE registro_servicio.ID_cli=clientes.ID_cli AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}




	function getRegistroServiciosHistorialEstadosUser($ID_usu)
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT status.ID_sta, status.sta_desc FROM registro_servicio, status WHERE registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ser_tipo='1' AND registro_servicio.ser_asig=".$ID_usu." AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}

		function getRegistroServiciosHistorialEstadosDia()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT status.ID_sta, status.sta_desc FROM registro_servicio, status WHERE registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ser_tipo='1' AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}

		function getRegistroServiciosHistorialNETiendasUser($ID_cli, $ID_usu)
	{
		$sql = "SELECT DISTINCT obras.obr_desc, registro_servicio.ID_obr FROM registro_servicio, obras WHERE registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_cli=".$ID_cli." AND ser_asig=".$ID_usu."";
				$result = mysql_query($sql);
				return $result;
	}

	function getRegistroServiciosHistorialPrioridadUser($ID_usu)
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT prioridades.ID_pri, prioridades.pri_desc FROM registro_servicio, prioridades WHERE registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ser_asig=".$ID_usu." AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}

		function getRegistroServiciosHistorialPrioridadDia()
	{
		$ID_cli=5;
		$sql = "SELECT DISTINCT prioridades.ID_pri, prioridades.pri_desc FROM registro_servicio, prioridades WHERE registro_servicio.ID_pri=prioridades.ID_pri AND registro_servicio.ID_cli=".$ID_cli."";
				$result = mysql_query($sql);
				return $result;
	}

	function getRegistroServiciosHistorialNETiendas($ID_cli)
	{
		$sql = "SELECT DISTINCT obras.obr_desc, registro_servicio.ID_obr FROM registro_servicio, obras WHERE registro_servicio.ID_obr=obras.ID_obr AND registro_servicio.ID_cli=".$ID_cli." ORDER BY obr_desc ASC";
				$result = mysql_query($sql);
				return $result;
	}

	function UpdateRegistroServicioByFcYCostoMp($ID_ser, $ser_fc, $ser_costomp)
	{
		$ID_ser 		=	$_POST['ID_ser'];
		$ser_fc 		=	$_POST['ser_fc'];
		$ser_costomp 	=	$_POST['ser_costomp'];
		$ID_sta 		= 	5;

		$sql	=	"UPDATE registro_servicio
					SET ID_sta='".$ID_sta."',
					ser_fc='".$ser_fc."',
					ser_costomp='".$ser_costomp."'
					WHERE ID_ser='" . $ID_ser . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function UpdateRegistroServiciosBySerCod($ser_cod, $ID_sta)
	{
		
		$sql	=	"UPDATE registro_servicio
					SET ID_sta='".$ID_sta."'
					WHERE ser_cod='" . $ser_cod . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

		function UpdateRegistroServiciosIdStaBySIdSer($ID_ser, $ID_sta)
	{
		
		$sql	=	"UPDATE registro_servicio
					SET ID_sta='".$ID_sta."'
					WHERE ID_ser='" . $ID_ser . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function UpdateRegistroServiciosSerCod($ser_cod, $ID_ser)
	{
		
		$sql	=	"UPDATE registro_servicio
					SET ser_cod='".$ser_cod."'
					WHERE ID_ser='".$ID_ser."'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function getRegistroServiciosHistorialNEClientes()
	{
		$sql = "SELECT DISTINCT clientes.cli_desc, clientes.ID_cli FROM registro_servicio, clientes WHERE registro_servicio.ID_cli=clientes.ID_cli ORDER BY cli_desc ASC";
				$result = mysql_query($sql);
				return $result;
	}

	function getRegistroServiciosHistorialEstados()
	{
		$sql = "SELECT DISTINCT status.ID_sta, status.sta_desc FROM registro_servicio, status WHERE registro_servicio.ID_sta=status.ID_sta AND registro_servicio.ser_tipo='1'";
				$result = mysql_query($sql);
				return $result;
	}

	function getRegistroServiciosHistorialPrioridad()
	{
		$sql = "SELECT DISTINCT prioridades.ID_pri, prioridades.pri_desc FROM registro_servicio, prioridades WHERE registro_servicio.ID_pri=prioridades.ID_pri";
				$result = mysql_query($sql);
				return $result;
	}

	function getRegistroServiciosHistorialAsignados()
	{
		$oOpe     = new operaciones();
    $contratistas = $oOpe->contratistas();
    $num_cont   = mysql_num_rows($contratistas);
    $supervisores = $oOpe->supervisores();
    $num_sup    = mysql_num_rows($supervisores);

		 echo  '<option value="0" >No Asignar</option>';
                            for($a=0; $a<$num_cont; $a++){
                              $cont     = mysql_fetch_assoc($contratistas);
                              echo  '<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
                            }
                            for($x=0; $x<$num_sup; $x++){
                              $sup      = mysql_fetch_assoc($supervisores);
                              echo  '<option value="' . $sup['ID_usu'] . '">' . $sup['usu_apellido'] . ' ' . $sup['usu_nombre'] . '</option>';
                            }
	}




	function optionPrioridades()
	{
		$oOpe     = new operaciones();
		 $prioridades  = $oOpe->prioridades();
    $num_pri    = mysql_num_rows($prioridades);
		  for($f=0; $f<$num_pri; $f++){
                                    $pri      = mysql_fetch_assoc($prioridades);
                                    echo  '<option value="'.$pri['ID_pri'].'">' . $pri['pri_desc'] . '</option>';
                                  }
	}	
	function optionResponsables()
	{
		$oOpe     = new operaciones();
    $contratistas = $oOpe->contratistas();
    $num_cont   = mysql_num_rows($contratistas);
    $supervisores = $oOpe->supervisores();
    $num_sup    = mysql_num_rows($supervisores);

		 echo  '<option value="0" >No Asignar</option>';
                            for($a=0; $a<$num_cont; $a++){
                              $cont     = mysql_fetch_assoc($contratistas);
                              echo  '<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
                            }
                            for($x=0; $x<$num_sup; $x++){
                              $sup      = mysql_fetch_assoc($supervisores);
                              echo  '<option value="' . $sup['ID_usu'] . '">' . $sup['usu_apellido'] . ' ' . $sup['usu_nombre'] . '</option>';
                            }

                           
	}

	function insert_registro_servicio($ID_ser, $ser_firma)
	{
		$sql	=	"UPDATE registro_servicio
					SET ser_firma='" . $ser_firma . "'
					WHERE ID_ser='" . $ID_ser . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function insert_registro_servicioNuevo($ID_cli, $ID_obr, $ID_usu, $ser_tipo, $ser_cod, $ser_fecin, $ser_hourin, $ID_sta, $ID_pri)
	{
		$sql		= "INSERT INTO registro_servicio (ID_cli, ID_obr, ID_usu, ser_tipo, ser_cod, ser_fecin, ser_hourin, ID_sta, ID_pri) VALUES('" . $ID_cli. "', '" . $ID_obr . "', '" . $ID_usu . "', '" . $ser_tipo . "', '" . $ser_cod . "','" . $ser_fecin . "','" . $ser_hourin . "','" . $ID_sta . "','" . $ID_pri . "')";
		$result		= mysql_query($sql);
		return mysql_affected_rows();
	}

	function insert_registro_servicioNuevoB($ID_cli, $ID_obr, $ID_sta, $ID_pri, $ID_usu, $ser_tipo, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_fecin, $ser_hourin, $ser_recCli, $ser_cod, $ID_emp)
	{
		$sql		= "INSERT INTO registro_servicio 
						(ID_cli, ID_obr, ID_usu, ser_tipo, ser_cod, ser_fecin, ser_hourin, ID_sta, ID_pri, ser_asig, ser_desc, ser_contacto, ser_telefono, ser_mail, ser_recCli, ID_emp) 
						VALUES
						('" . $ID_cli. "', '" . $ID_obr . "', '" . $ID_usu . "', '" . $ser_tipo . "', '" . $ser_cod . "','" . $ser_fecin . "','" . $ser_hourin . "','" . $ID_sta . "','" . $ID_pri . "','" . $ser_asig . "','" . $ser_desc . "','" . $ser_contacto . "','" . $ser_telefono . "','" . $ser_mail . "','" . $ser_recCli . "','" . $ID_emp . "')";
		$result		= mysql_query($sql);
		return mysql_affected_rows();
	}

	function insert_registro_servicioNuevoDesdeQuotationsAS($ID_cli, $ID_obr, $ID_usu, $ser_tipo, $ser_cod, $ser_fecin, $ser_hourin, $ID_staB, $ID_pri, $pto_pedidoCod, $ser_desc, $ser_telefono, $ser_mail, $ser_contacto)
	{
		$sql 	= "INSERT INTO registro_servicio (ID_cli, ID_obr, ID_usu, ser_tipo, ser_cod, ser_fecin, ser_hourin, ID_sta, ID_pri, pto_pedidoCod, ser_desc, ser_telefono, ser_mail, ser_contacto) VALUES('" . $ID_cli. "', '" . $ID_obr . "', '" . $ID_usu . "', '" . $ser_tipo . "', '" . $ser_cod . "','" . $ser_fecin . "','" . $ser_hourin . "','" . $ID_staB . "','" . $ID_pri . "','" . $pto_pedidoCod . "','" . $ser_desc . "','" . $ser_telefono . "','" . $ser_mail . "','" . $ser_contacto . "')";
		$result		= mysql_query($sql);
		return mysql_affected_rows();
	}



	function getUltimoRegistroServicio()
	{
		$sql		= "SELECT * FROM registro_servicio ORDER BY ID_ser DESC LIMIT 1";
		$result		= mysql_query($sql);
		return $result;
	}



	 	function insert_registro_servicioB($ID_pto, $ID_emp, $ID_cli, $ID_obr, $ID_sta, $ID_pri, $ID_usu, $ser_tipo, $ser_cod, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_fecin, $ser_hourin)
	 	{
		        $sql = "INSERT INTO registro_servicio (ID_pto, ID_emp, ID_cli, ID_obr, ID_sta, ID_pri, ID_usu, ser_tipo, ser_cod, ser_desc, ser_contacto, ser_telefono, ser_mail, ser_fecin, ser_hourin) VALUES('" . $ID_pto . "', '" . $ID_emp . "', '" . $ID_cli . "','" . $ID_obr . "','" . $ID_sta . "','" . $ID_pri . "','" . $ID_usu . "', '".$ser_tipo."', '" . $ser_cod . "', '" . $ser_desc . "','" . $ser_contacto . "','" . $ser_telefono . "','" . $ser_mail . "','" . $ser_fecin . "','" . $ser_hourin . "')";
				$result		= mysql_query($sql);
					return mysql_affected_rows();
		}




		function dropRegistroServicio($ID_ser)
		{
		$sql	=	"DELETE FROM registro_servicio 
					WHERE ID_ser='" . $ID_ser . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	    }


	    function updateRegisterServices($ID_ser, $ID_sta, $ID_pri, $ser_asig, $ser_desc, $ser_contacto, $ser_telefono, $ser_mail, $ser_recCli)
	    {
	    	$sql	=	"UPDATE registro_servicio 
					SET ID_pri='" . $ID_pri . "',
					ID_sta='" . $ID_sta . "',
					ser_asig=".$ser_asig.",
					ser_desc='" . $ser_desc . "',
					ser_contacto='" . $ser_contacto . "',
					ser_telefono='" . $ser_telefono . "',
					ser_mail='" . $ser_mail . "',
					ser_recCli='" . $ser_recCli . "'
					WHERE ID_ser='" . $ID_ser . "' ";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	    }



	        function updateRegisterServicesContactos($ID_ser, $ser_contacto, $ser_telefono, $ser_mail)
	    {
	    	$sql	=	"UPDATE registro_servicio 
					SET 
					ser_contacto='" . $ser_contacto . "',
					ser_telefono='" . $ser_telefono . "',
					ser_mail='" . $ser_mail . "'
					WHERE ID_ser='" . $ID_ser . "' ";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	    }

	     function updateRegisterServicesStatus($ID_ser, $ID_sta)
	    {
	    	$sql	=	"UPDATE registro_servicio 
					SET ID_sta='" . $ID_sta . "'
					WHERE ID_ser='" . $ID_ser . "' ";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	    }

	    function actionAsignar($ID_ser, $ser_asig)
	    {
	    	$sql	=	"UPDATE registro_servicio 
					SET ser_asig=".$ser_asig."
					WHERE ID_ser='" . $ID_ser . "' ";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	    }

		function GetRegistroServicioByIdPto($ID_pto)
		{
			$sql = "SELECT * FROM registro_servicio WHERE ID_pto=".$ID_pto."";
					$result		= mysql_query($sql);
					return $result;
		}

				function GetRegistroServicioByIdser($ID_ser)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			 ID_ser=".$ID_ser."";
					$result		= mysql_query($sql);
					return $result;
		}

			function GetRegistroServicioByIdserB($codigo)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			 ser_cod=".$codigo."";
					$result		= mysql_query($sql);
					return $result;
		}

					function GetRegistroServicioByIdserForTecnicos($ID_ser)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			(usuarios.ID_usu=registro_servicio.ser_asig or usuarios.ID_usu=registro_servicio.ID_usu) 
			 AND ID_ser=".$ID_ser."";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioBySerCod($ser_cod)
		{
			$sql = "SELECT * FROM registro_servicio WHERE 
			 ser_cod=".$ser_cod."";
					$result		= mysql_query($sql);
					return $result;
		}
		function GetRegistroServicioAbiertoAjax($inicioAbierto)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1 order by ID_ser desc limit 0, ".$inicioAbierto."";
					$result		= mysql_query($sql);
					return $result;


		}

				function GetRegistroServicioAbiertoAjaxById($inicioAbierto, $ID_buscadorAbierto)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1 AND 
			obras.ID_obr=".$ID_buscadorAbierto."
			order by ID_ser desc limit 0, ".$inicioAbierto."";
					$result		= mysql_query($sql);
					return $result;


		}

					function getQuotationsInsertedAjaxByIdCodigo($inicioAbierto, $ID_codigoAbierto)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1 AND 
			registro_servicio.ser_cod=".$ID_codigoAbierto." 
			order by ID_ser desc limit 0, ".$inicioAbierto."";
					$result		= mysql_query($sql);
					return $result;


		}

				function getQuotationsInsertedAjaxByIdCliente($inicioAbierto, $ID_clienteAbierto)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1 AND 
			registro_servicio.ID_cli='".$ID_clienteAbierto."' 
			order by ID_ser desc limit 0, ".$inicioAbierto."";
					$result		= mysql_query($sql);
					return $result;


		}


		function GetRegistroServicioAbierto()
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1 ";
					$result		= mysql_query($sql);
					return $result;
		}
		function GetRegistroServicioAbiertoInicial()
		{
			
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=1";
					$result		= mysql_query($sql);
					return $result;
		}
	
	
	function GetRegistroServicioAbiertoDia($ID_cli)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_cli=".$ID_cli." AND
			 registro_servicio.ID_sta=1";
					$result		= mysql_query($sql);
					return $result;
		}
		

			function GetRegistroServicioAsignado()
		{
			$hoy=date('Ymd');
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=2 AND ser_fecin BETWEEN '20161230' and '".$hoy."' ORDER BY ID_ser ASC LIMIT 30";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioAsignadoInicial()
		{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=2 ";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioAsignadoDia($ID_cli)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig  AND registro_servicio.ID_cli=".$ID_cli." AND
			 ID_sta=2 ORDER BY ID_ser DESC ";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioUltimo()
		{
			$sql = "SELECT max(ID_ser) as ID_ser FROM registro_servicio";
			$result		= mysql_query($sql);
			return $result;
		}

		function GetRegistroServicioAsignadoAjax($inicioAsignado)
		{
			
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 order by ID_ser desc limit 0, ".$inicioAsignado."";
					$result		= mysql_query($sql);
					return $result;
		}
		function GetRegistroServicioAsignadoAjaxById($inicioAsignado, $ID_buscadorAsignado)
		{
			
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 AND
			 obras.ID_obr='".$ID_buscadorAsignado."'
			 order by ID_ser desc limit 0, ".$inicioAsignado."";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioAsignadoAjaxByIdCodigo($inicioAsignado, $ID_codigoAsignado)
		{
			$ID_codigoAsignado=str_replace(' ', '',$ID_codigoAsignado);       
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 AND
			registro_servicio.ser_cod='".$ID_codigoAsignado."'
			order by registro_servicio.ID_ser desc limit 0, ".$inicioAsignado."";
					$result		= mysql_query($sql);
					return $result;
		}
		
		function GetRegistroServicioAsignadoAjaxByIdCliente($inicioAsignado, $ID_clienteAsignado)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 AND
			registro_servicio.ID_cli='".$ID_clienteAsignado."'
			order by registro_servicio.ID_ser desc limit 0, ".$inicioAsignado."";
					$result		= mysql_query($sql);
					return $result;
		}


		function GetRegistroServicioAsignadoASAjax($inicioAsignadoAS)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=2 order by ID_ser desc limit 0, ".$inicioAsignadoAS."";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioAsignadoAjaxASById($inicioAsignadoAS, $ID_buscadorAsignadoAS)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 AND obras.ID_obr='".$ID_buscadorAsignadoAS."'
			order by registro_servicio.ID_ser desc limit 0, ".$inicioAsignadoAS."";
					$result		= mysql_query($sql);
					return $result;
		}
		
			function GetRegistroServicioAsignadoPorUsuarios($ID_usu)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 (ID_sta=2 or ID_sta=1) AND ser_asig=".$ID_usu." ORDER BY ID_ser DESC ";
					$result		= mysql_query($sql);
					return $result;
		}

	function GetRegistroServicioAsignadoById($ID_ser)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=2 AND ID_ser=".$ID_ser." ORDER BY ID_ser DESC LIMIT 5";
					$result		= mysql_query($sql);
					return $result;
		}

		   function GetRegistroServicioPendientes()
		{
			$hoy=date('Ymd');
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			 ID_sta=4 AND ser_fecin BETWEEN '20161230' and '".$hoy."' ORDER BY ID_ser DESC LIMIT 30";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioPendienteInicial()
		{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			 ID_sta=4";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioPendienteAjax($inicioPendiente)
			{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=4 order by ID_ser desc limit 0, ".$inicioPendiente."";
					$result		= mysql_query($sql);
					return $result;
			}

			function getQuotationsPendienteAjaxByIdCodigo($inicioPendiente, $ID_codigoPendiente)
			{
			$ID_codigoPendiente=str_replace(' ', '',$ID_codigoPendiente);	
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=4 AND 
			 registro_servicio.ser_cod='".$ID_codigoPendiente."'
			 order by ID_ser desc limit 0, ".$inicioPendiente."";
					$result		= mysql_query($sql);
					return $result;
			}

				function getQuotationsPendienteAjaxByIdCliente($inicioPendiente, $ID_clientePendiente)
			{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=4 AND 
			 registro_servicio.ID_cli='".$ID_clientePendiente."'
			 order by ID_ser desc limit 0, ".$inicioPendiente."";
					$result		= mysql_query($sql);
					return $result;
			}


			function GetRegistroServicioPendienteAjaxById($inicioPendiente, $ID_buscadorPendiente)
			{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			 ID_sta=4 AND 
			 obras.ID_obr='".$ID_buscadorPendiente."'
			 order by ID_ser desc limit 0, ".$inicioPendiente."";
					$result		= mysql_query($sql);
					return $result;
			}

				   function GetRegistroServicioPendientesDia($ID_cli)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND registro_servicio.ID_cli=".$ID_cli." AND
			 ID_sta=4 ORDER BY ID_ser DESC LIMIT 5";
					$result		= mysql_query($sql);
					return $result;
		}

		  function GetRegistroServicioPendientesPorUsuarios($ID_usu)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ser_asig='".$ID_usu."' AND 
			 registro_servicio.ID_sta=4";
					$result		= mysql_query($sql);
					return $result;
		}


		   function GetRegistroServicioRepuestos()
		{
			$hoy=date('Ymd');
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			
			 ID_sta=6 AND ser_fecin BETWEEN '20161230' and '".$hoy."' ORDER BY ID_ser DESC LIMIT 30";
					$result		= mysql_query($sql);
					return $result;
		}

			   function GetRegistroServicioRepuestosIdUsu($ID_usu)
		{
			$hoy=date('Ymd');
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
 		    quotations.pto_asignado=".$ID_usu." AND
			 ID_sta=6 AND ser_fecin BETWEEN '20161230' and '".$hoy."' ORDER BY ID_ser DESC LIMIT 30";
					$result		= mysql_query($sql);
					return $result;
		}

			function GetRegistroServicioRepuestoInicial()
		{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			
			 ID_sta=6";
					$result		= mysql_query($sql);
					return $result;
		}

		function GetRegistroServicioRepuestoAjax($inicioRepuesto)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=6 order by ID_ser desc limit 0, ".$inicioRepuesto."";
					$result		= mysql_query($sql);
					return $result;

			}

			function GetRegistroServicioRepuestoAjaxByIdCodigo($inicioRepuesto, $ID_codigoRepuesto)
			{
				$ID_codigoRepuesto=str_replace(' ', '',$ID_codigoRepuesto);
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=6 AND
			 registro_servicio.ser_cod='".$ID_codigoRepuesto."'
			  order by ID_ser desc limit 0, ".$inicioRepuesto."";
					$result		= mysql_query($sql);
					return $result;

			}

			function GetRegistroServicioRepuestoAjaxByIdCliente($inicioRepuesto, $ID_clienteRepuesto)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=6 AND
			 registro_servicio.ID_cli='".$ID_clienteRepuesto."'
			  order by ID_ser desc limit 0, ".$inicioRepuesto."";
					$result		= mysql_query($sql);
					return $result;

			}


			function GetRegistroServicioRepuestoAjaxById($inicioRepuesto, $ID_buscadorRepuesto)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			 ID_sta=6 AND 
			 obras.ID_obr='".$ID_buscadorRepuesto."'
			 order by ID_ser desc limit 0, ".$inicioRepuesto."";
					$result		= mysql_query($sql);
					return $result;

			}

   function GetRegistroServicioRepuestosDia($ID_cli)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_cli='".$ID_cli."' AND 
			 ID_sta=6 ORDER BY ID_ser DESC LIMIT 5";
					$result		= mysql_query($sql);
					return $result;
		}



		   function GetRegistroServicioRepuestosPorUsuarios($ID_usu)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ser_asig='".$ID_usu."' AND 
			 ID_sta=6";
					$result		= mysql_query($sql);
					return $result;
		}
		
			function GetRegistroServicioCerrados()
		{
			$hoy=date('Ymd');
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11 AND 
			registro_servicio.ser_fecin BETWEEN '20161230' and '".$hoy."' ORDER BY ID_ser DESC LIMIT 30";
					$result		= mysql_query($sql);
					return $result;
		}



				function GetRegistroServicioCerradoInicial()
		{

			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11";
					$result		= mysql_query($sql);
					return $result;
				
			
		}

		    function GetRegistroServicioCerradoAjax($inicioCerrado)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11 order by ID_ser desc limit 0, ".$inicioCerrado."";
					$result		= mysql_query($sql);
					return $result;

			}

			function getQuotationsCerradoAjaxByIdCodigo($inicioCerrado, $ID_codigoCerrado)
			{
				$ID_codigoCerrado=str_replace(' ', '',$ID_codigoCerrado);
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_Servicio.ID_sta=11 AND
			registro_servicio.ser_cod='".$ID_codigoCerrado."'
			  order by ID_ser desc limit 0, ".$inicioCerrado."";
					$result		= mysql_query($sql);
					return $result;

			}

					function getQuotationsCerradoAjaxByIdCliente($inicioCerrado, $ID_clienteCerrado)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11 AND
			registro_servicio.ID_cli='".$ID_clienteCerrado."'
			  order by ID_ser desc limit 0, ".$inicioCerrado."";
					$result		= mysql_query($sql);
					return $result;

			}

					function GetRegistroServicioCerradoAjaxById($inicioCerrado, $ID_buscadorCerrado)
			{
				$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11 AND
			 obras.ID_obr='".$ID_buscadorCerrado."'
			  order by ID_ser desc limit 0, ".$inicioCerrado."";
					$result		= mysql_query($sql);
					return $result;

			}


			function GetRegistroServicioCerradosDia($ID_cli)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ser_asig AND
			registro_servicio.ID_sta=11 AND
			registro_servicio.ID_cli='".$ID_cli."'";
					$result		= mysql_query($sql);
					return $result;
		}

			function GetRegistroServicioCerradosPorUsuarios($ID_usu)
		{
			$sql = "SELECT * FROM registro_servicio, clientes, obras, prioridades, usuarios WHERE 
			clientes.ID_cli=registro_servicio.ID_cli AND
			obras.ID_obr=registro_servicio.ID_obr AND
			prioridades.ID_pri=registro_servicio.ID_pri AND
			usuarios.ID_usu=registro_servicio.ID_usu AND
			registro_servicio.ID_sta=11 AND
			registro_servicio.ID_usu='".$ID_usu."'";
					$result		= mysql_query($sql);
					return $result;
		}
		
}



class tipo_objetivos
{

		function getTipoObjetivosSinRepetir($ID_pri)
		{
			$sql	=	"SELECT * FROM tipo_objetivos 
					    WHERE ID_pri='".$ID_pri."'";
			$result			=	mysql_query($sql);
			$this->zonRows	=	mysql_num_rows($result);
			return $result;
		}

		function getTipoObjetivosByID_cli()
		{
			$sql	=	"SELECT * FROM tipo_objetivos";
			$result				=	mysql_query($sql);
			$this->forBySubRows	=	mysql_num_rows($result);
			return $result;
		}

		function getTipoObjetivosByID_cliB($ID_cli)
		{
			$sql	=	"SELECT * FROM tipo_objetivos where ID_cli ='" . $ID_cli . "' ";
			$result				=	mysql_query($sql);
			$this->forBySubRows	=	mysql_num_rows($result);
			return $result;
		}


function updateTipoObjetivos($ID_tob, $tob_desc)
	{
		$sql	=	"UPDATE tipo_objetivos
					SET tob_desc='" . $tob_desc . "'
					WHERE ID_tob='" . $ID_tob . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function dropTipoObjetivos($ID_tob){
		$sql	=	"DELETE FROM tipo_objetivos
					WHERE ID_tob='" . $ID_tob . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function insertTipoObjetivos($tob_desc)
	{
		$sql	=	"INSERT INTO tipo_objetivos
					(
					ID_tob, 
					tob_desc) 
						VALUES(NULL, '" . $tob_desc  ."')";
			$insert	=	mysql_query($sql);
			return mysql_affected_rows();
	}

}

class clientes_obj
{
		function getClientesObjByID_cli($ID_cli)
		{
			$sql="SELECT * FROM clientes_obj, tipo_objetivos, prioridades
			where tipo_objetivos.ID_tob=clientes_obj.ID_tob AND clientes_obj.ID_pri=prioridades.ID_pri AND  clientes_obj.ID_cli='".$ID_cli."'";
			$result = mysql_query($sql);
			return $result;
		}



function updateClientesObj($ID_obj, $ID_tob, $ID_cli, $ID_pri, $obj_plazo, $obj_valor, $obj_obs, $obj_cumplido, $obj_fechaCumplido)
	{


		$sql	=	"UPDATE clientes_obj
					SET 
					ID_tob				='" . $ID_tob				. "',
					ID_cli 				='" . $ID_cli 				. "',
					ID_pri 				='" . $ID_pri 				. "',
					obj_plazo 			='" . $obj_plazo 			. "',
					obj_valor 			='" . $obj_valor 			. "',
					obj_obs 			='" . $obj_obs 				. "',
					obj_cumplido 		='" . $obj_cumplido 		. "',
					obj_fechaCumplido	='" . $obj_fechaCumplido 	. "'
					WHERE ID_obj=" . $ID_obj . "";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function dropClientesObj($ID_obj){
		$sql	=	"DELETE FROM clientes_obj
					WHERE ID_obj='" . $ID_obj . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
				


	function insertClientesObj($ID_tob, $ID_cli, $ID_pri, $obj_plazo, $obj_valor, $obj_obs, $obj_cumplido, $obj_fechaCumplido)
	{
		$sql	=	"INSERT INTO clientes_obj
					(	
						 ID_tob,
						 ID_cli,
						 ID_pri,
						 obj_plazo,
						 obj_valor,
						 obj_obs,
						 obj_cumplido,
						 obj_fechaCumplido
					 ) 
						VALUES('" . $ID_tob  ."', '" . $ID_cli  ."', '" . $ID_pri  ."', '" . $obj_plazo  ."', '" . $obj_valor  ."', '" . $obj_obs  ."', '" . $obj_cumplido  ."', '" . $obj_fechaCumplido  ."')";
			$insert	=	mysql_query($sql);
			return mysql_affected_rows();
	}

}


class clientesOrganizacion
{
	function getClientesOrganizacion(){
		$sql	=	"SELECT * FROM clientes_organizacion";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function getClientesOrganizacionByID_cli($ID_cli){
		$sql	=	"SELECT * FROM clientes_organizacion 
						WHERE ID_cli=" . $ID_cli . "";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getClientesOrganizacionByID_org($ID_org){
		$sql	=	"SELECT * FROM clientes_organizacion 
						WHERE ID_org=$ID_org";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function getClientesOrganizacionByDepCero($ID_cli){
		$sql	=	"SELECT * FROM clientes_organizacion 
						WHERE ID_cli=$ID_cli and org_dependencia=0";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}	
	function getClientesOrganizacionByDep($ID_cli, $ID_org){
		$sql	=	"SELECT * FROM clientes_organizacion 
						WHERE ID_cli=$ID_cli and org_dependencia=" . $ID_org . "";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}	
	function generaClientesOrganizacionID_cli($ID_cli){
		$sql	=	"SELECT * FROM clientes_organizacion WHERE
					clientes_organizacion.ID_cli='" . $ID_cli . "'
					ORDER BY clientes_organizacion.org_nombre ASC";
		$result				=	mysql_query($sql);
		$this->cliOrgRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->cliOrgRows;$i++){
			$cliOrg	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cliOrg['ID_org'] . '">' . $cliOrg['org_nombre'] . ' / ' . $cliOrg['org_puesto'] . '</option>';
		}
	}
	function updateclientesOrganizacion($ID_org, $ID_cli, $org_nombre, $org_dependencia, $org_puesto, $org_mail,  $org_tel, $org_obs)
	{
		$sql	=	"UPDATE clientes_organizacion
					SET org_nombre='" . $org_nombre . "',
					org_dependencia='" . $org_dependencia . "',
					org_puesto='" . $org_puesto . "',
					org_mail='" . $org_mail . "',
					org_tel='" . $org_tel . "',
					org_obs='" . $org_obs . "'
					WHERE ID_org=$ID_org";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function dropClientesOrganizacion($ID_org){
		$sql	=	"DELETE FROM clientes_organizacion
					WHERE ID_org='" . $ID_org . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function insertClientesOrganizacion($ID_cli, $org_nombre, $org_dependencia, $org_puesto, $org_mail,  $org_obs, $org_tel)
	{
		$sql	=	"INSERT INTO clientes_organizacion
					(
					ID_org, 
					ID_cli,
					org_nombre,
					org_dependencia,
					org_puesto,
					org_mail,			
					org_obs,
					org_tel) 
						VALUES(NULL, '" . $ID_cli  ."', '" . $org_nombre  ."','" . $org_dependencia  ."','" . $org_puesto ."','" . $org_mail  ."','" . $org_obs  ."','" . $org_tel  ."')";
			$insert	=	mysql_query($sql);
			return mysql_affected_rows();
	}
}

class clientes {
		function BuscadorDeClientes()
	{
		$sql = "SELECT clientes.cli_desc, clientes.ID_cli FROM clientes ORDER BY cli_desc asc";
				$result = mysql_query($sql);
				return $result;
	}

function updateclientes($ID_cli, $cli_desc, $cli_clienteCostan, $cli_obs)
	{
		$sql	=	"UPDATE clientes
					SET cli_desc='" . $cli_desc . "',
					cli_clienteCostan='" . $cli_clienteCostan . "',
					cli_obs='" . $cli_obs . "'
					WHERE ID_cli=$ID_cli";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	

	function getClienteById($ID_cli){
		$sql	=	"SELECT * FROM clientes 
						WHERE ID_cli='" . $ID_cli . "'";
		$result				=	mysql_query($sql);
		
		return $result;
	}
	function getClienteByIdObr($ID_obr)
	{
		$sql	=	"SELECT * FROM clientes, obras WHERE clientes.ID_cli=obras.ID_cli AND ID_obr='".$ID_obr."'";
		$result				=	mysql_query($sql);
		
		return $result;
	}
		function getClientes($ID_emp){
		$sql	=	"SELECT * FROM clientes
					WHERE ID_emp='" . $ID_emp . "'
					ORDER BY cli_desc ASC";
		$result				=	mysql_query($sql);
		$this->cliRows	=	mysql_num_rows($result);
		return $result;
	}
	function getUltimoCliente(){
		$sql	=	"SELECT * FROM clientes ORDER BY ID_cli DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function insertCliente($ID_emp, $cli_desc, $cli_clienteCostan, $cli_obs){
			$sql	=	"INSERT INTO clientes
						(ID_emp, cli_desc, cli_clienteCostan, cli_obs)
						VALUES('" . $ID_emp  ."','" . $cli_desc  ."','" . $cli_clienteCostan  ."','" . $cli_obs  ."')";
			$insert	=	mysql_query($sql);
			return 1;
	}
	function generaClientes($ID_emp)
	{
		$sql	=	"SELECT * FROM clientes, empresas
					WHERE empresas.ID_emp='" . $ID_emp . "' AND
					clientes.ID_emp=empresas.ID_emp
					ORDER BY clientes.cli_desc ASC";
		$result				=	mysql_query($sql);
		$this->genCliRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genCliRows;$i++){
			$cli	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cli['ID_cli'] . '">' . $cli['cli_desc'] . '</option>';
		}
	}
	function dropClientes($ID_cli)
	{
		$sql=mysql_num_rows(mysql_query("SELECT * FROM obras
					 						WHERE ID_cli=".$ID_cli.""));
		if($sql==0)
		{
			$sql4			=	"DELETE FROM clientes
						 			WHERE ID_cli=" . $ID_cli . "";
			$result4		=	mysql_query($sql4);
			return 1;
		}
		else
		{
		    return 2;
		}
			
	}
}
class tiendas {

		function getUltimoTienda(){
		$sql	=	"SELECT * FROM obras ORDER BY ID_obr DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

		function getTiendaById($ID_obr){
		$sql	=	"SELECT * FROM obras WHERE ID_obr=".$ID_obr."";
		$result				=	mysql_query($sql);
		return $result;
	}


	function insertTiendas($ID_emp, 
	  $ID_cli,
	  $ID_emp,
	  $ID_prv,
	  $ID_ciu,
	  $obr_dir,
	  $obr_nproyecto,
	  $obr_ov,
	  $obr_np,
	  $obr_ndestinatario,
	  $obr_fecmad,
	  $obr_npto,
	  $obr_contacto,
	  $obr_tel,
	  $obr_mail,
	  $obr_nsucursal,
	  $obr_desc,
	  $obr_pto,
	  $ID_zon,
	  $obr_exhibARG,
	  $obr_exhibEUR,
	  $obr_evaporadores,
	  $obr_camaras,
	  $obr_condensadores,
	  $obr_frioSTD,
	  $obr_frioESP,
	  $obr_materialesObra,
	  $obr_ingenieria,
	  $obr_manoDeObra,
	  $obr_flete,
	  $obr_fecinfrio,
	  $obr_fecfinfrio,
	  $obr_cantfrio,
	  $obr_contfrio,
	  $obr_mofrio,
	  $obr_fecinexhib,
	  $obr_fecfinexhib,
	  $obr_cantexhib,
	  $obr_contexhib,
	  $obr_moexhib,
	  $obr_fecincamaras,
	  $obr_fecfincamaras,
	  $obr_cantcamaras,
	  $obr_contcamaras,
	  $obr_mocamaras,
	  $obr_supervisor,
	  $obr_obs,
	  $obr_fecin,
	  $obr_fecinreal,
	  $obr_fecfin,
	  $obr_fecfinreal,
	  $obr_default,
	  $obr_coordenadas,
	  $obr_pais,
	  $obr_provincia,
	  $obr_ciudad,
	  $obr_codigoPostal,
	  $obr_codigoPais,
	  $obr_URL,
	  $obr_abonado)

		{
		
			$sql	=	"INSERT INTO obras 
						(ID_emp, 
						ID_cli, 
						ID_prv, 
						ID_ciu, 
						obr_dir, 
						obr_nproyecto, 
						obr_ov, 
						obr_np, 
						obr_ndestinatario, 
						obr_fecmad, 
						obr_npto, 
						obr_contacto, 
						obr_tel, 
						obr_mail, 
						obr_nsucursal, 
						obr_desc, 
						obr_pto, 
						ID_zon, 
						obr_exhibARG,
						obr_exhibEUR,
						obr_evaporadores,
						obr_camaras,
						obr_condensadores,
						obr_frioSTD,
						obr_frioESP,
						obr_materialesObra,
						obr_ingenieria,
						obr_manoDeObra,
						obr_flete,
						obr_fecinfrio, 
						obr_fecfinfrio,
						obr_cantfrio, 
						obr_contfrio, 
						obr_mofrio, 
						obr_fecinexhib, 
						obr_fecfinexhib, 
						obr_cantexhib, 
						obr_contexhib, 
						obr_moexhib, 
						obr_fecincamaras,
						obr_fecfincamaras,  
						obr_cantcamaras, 
						obr_contcamaras, 
						obr_mocamaras, 
						obr_supervisor, 
						obr_obs, 
						obr_fecin, 
						obr_fecfin, 
						obr_fecinreal, 
						obr_fecfinreal, 
						obr_default, 
						obr_coordenadas,
						obr_pais,
						obr_provincia,
						obr_ciudad,	
						obr_codigoPostal,
						obr_codigoPais,
						obr_URL,
						obr_abonado




						)

						VALUES('" . $ID_emp . "',
						'" . $ID_cli . "',
						'" . $ID_prv . "',
						'" . $ID_ciu . "',
						'" . $obr_dir . "',
						'" . $obr_nproyecto . "',
						'" . $obr_ov . "',
						'" . $obr_np . "',
						'" . $obr_ndestinatario . "',
						'" . $obr_fecmad . "',
						'" . $obr_npto . "',
						'" . $obr_contacto . "',
						'" . $obr_tel . "',
						'" . $obr_mail . "',
						'" . $obr_nsucursal . "',
						'" . $obr_desc . "',
						'" . $obr_pto . "',
						'" . $ID_zon . "',
						'" . $obr_exhibARG . "',
						'" . $obr_exhibEUR . "',
						'" . $obr_evaporadores . "',
						'" . $obr_camaras . "',
						'" . $obr_condensadores . "',
						'" . $obr_frioSTD . "',
						'" . $obr_frioESP . "',
						'" . $obr_materialesObra . "',
						'" . $obr_ingenieria . "',
						'" . $obr_manoDeObra . "',
						'" . $obr_flete . "',
						'" . $obr_fecinfrio . "',
						'" . $obr_fecfinfrio . "',
						'" . $obr_cantfrio . "',
						'" . $obr_contfrio . "',
						'" . $obr_mofrio . "',
						'" . $obr_fecinexhib . "',
						'" . $obr_fecfinexhib . "',
						'" . $obr_cantexhib . "',
						'" . $obr_contexhib . "',
						'" . $obr_moexhib . "',
						'" . $obr_fecincamaras . "',
						'" . $obr_fecfincamaras . "',
						'" . $obr_cantcamaras . "',
						'" . $obr_contcamaras . "',
						'" . $obr_mocamaras . "',
						'" . $obr_supervisor . "',
						'" . $obr_obs . "',
						'" . $obr_fecin . "',
						'" . $obr_fecfin . "',
						'" . $obr_fecinreal . "',
						'" . $obr_fecfinreal . "',
						'" . $obr_default . "',
						'" . $obr_coordenadas . "',
						'" . $obr_pais. "',
						'" . $obr_provincia. "',
						'" . $obr_ciudad. "',	
						'" . $obr_codigoPostal. "',
						'" . $obr_codigoPais. "',
						'" . $obr_URL . "',
						'" . $obr_abonado . "')";
			$insert	=	mysql_query($sql);
			
	}

	function getTiendas($ID_emp){
		$sql	=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon AND
					obras.ID_prv=provincias.ID_prv AND
					obras.ID_ciu=ciudades.ID_ciu AND
					obras.ID_emp='" . $ID_emp . "'
					ORDER BY obras.obr_desc ASC";
		$result			=	mysql_query($sql);
		$this->tieRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasByIdEmp($ID_emp){
		$sql	=	"SELECT * FROM obras
					WHERE ID_emp='" . $ID_emp . "'";
		$result			=	mysql_query($sql);
		$this->tieRows	=	mysql_num_rows($result);
		return $result;
	}


		function nuevogetTiendas(){
		$sql = "SELECT * FROM obras, clientes, zonas, provincias, ciudades
          WHERE obras.ID_cli=clientes.ID_cli AND
          obras.ID_zon=zonas.ID_zon AND
          obras.ID_prv=provincias.ID_prv AND
          obras.ID_ciu=ciudades.ID_ciu
          ORDER BY obras.obr_desc ASC";
    $result     = mysql_query($sql); 
		$this->tieRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasMap($ID_emp){
		$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker, clientes.ID_cli
            		FROM obras, clientes, empresas
		            WHERE obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    empresas.ID_emp= " . $ID_emp . "";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasById($ID_obr){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE ID_obr='" . $ID_obr . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

	
	function getTiendasByCli($ID_cli){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_cli='" . $ID_cli . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

		function getTiendasByZon($ID_zon){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_zon='" . $ID_zon . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function filterTiendas($ID_obr, $ID_cli, $ID_zon, $obr_coordenadas, $obr_abonado)
		{
			if($ID_obr)
			{	
				$obr	=	"AND obras.ID_obr='" . $ID_obr . "'";
			} 
			else
			{
				$obr	=	'';
			}
			if($ID_cli)
			{
				$cli	=	"AND obras.ID_cli='" . $ID_cli . "'";
			} 
			else 
			{
				$cli	=	'';
			}
			if($ID_zon)
			{
				$zon	=	"AND obras.ID_zon='" . $ID_zon . "'";
			} 
			else 
			{
				$zon	=	'';
			}
			if($obr_coordenadas=='on')
			{
				$cor	=	"AND obras.obr_coordenadas is NULL";
			} 
			else 
			{
				$cor	=	'';
			}
			if($obr_abonado=='on')
			{
				$abo	=	"AND obras.obr_abonado='1'";
			} 
			else 
			{
				$abo	=	'';
			}
		

		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon 
					$obr
					$cli
					$zon
					$cor
					$abo
					ORDER BY clientes.cli_desc DESC
					";

		$result			=	mysql_query($sql);
		$this->permRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasPorZonas($ID_zon){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE zonas.ID_zon='" . $ID_zon . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zo 	nas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
	function GetTiendasMapById($ID_obr){
		$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker, clientes.ID_cli 
		FROM obras, clientes, empresas 
		WHERE obras.ID_obr='".$ID_obr."' AND 
		obras.ID_cli=clientes.ID_cli AND
		 obras.obr_coordenadas<>'' AND 
		 obras.ID_emp=empresas.ID_emp";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasMapByCli($ID_cli){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker, clientes.ID_cli
            		FROM obras, clientes, empresas
		            WHERE clientes.ID_cli='" . $ID_cli . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasMapByZon($ID_zon){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker, clientes.ID_cli
            		FROM obras, clientes, empresas, zonas
		            WHERE zonas.ID_zon='" . $ID_zon . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

	function getTiendasMapByAbonado($obr_abonado){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker, clientes.ID_cli
            		FROM obras, clientes, empresas, zonas
		            WHERE obras.obr_abonado='" . $obr_abonado . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

	function generaTiendas($ID_emp){
		$sql	=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon AND
					obras.ID_prv=provincias.ID_prv AND
					obras.ID_ciu=ciudades.ID_ciu AND
					obras.ID_emp='" . $ID_emp . "'
					ORDER BY obras.obr_desc ASC";
		$result				=	mysql_query($sql);
		$this->tiendasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->teindasRows;$i++){
			$tie	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tie['ID_obr'] . '">' . $tie['cli_desc'] . ' - ' . $tie['obr_desc'] . '</option>';
		}
	}		

	function updateTienda(
						$ID_obr,
						$ID_cli, 
						$obr_dir, 
						$obr_nproyecto, 
						$obr_ov, 
						$obr_np, 
						$obr_ndestinatario, 
						$obr_fecmad, 
						$obr_npto, 
						$obr_contacto, 
						$obr_tel, 
						$obr_mail, 
						$obr_nsucursal, 
						$obr_desc, 
						$obr_pto, 
						$ID_zon, 
						$obr_exhibARG,
						$obr_exhibEUR,
						$obr_evaporadores,
						$obr_camaras,
						$obr_condensadores,
						$obr_frioSTD,
						$obr_frioESP,
						$obr_materialesObra,
						$obr_ingenieria,
						$obr_manoDeObra,
						$obr_flete,
						$obr_fecinfrio, 
						$obr_fecfinfrio,
						$obr_cantfrio, 
						$obr_contfrio, 
						$obr_mofrio, 
						$obr_fecinexhib, 
						$obr_fecfinexhib, 
						$obr_cantexhib, 
						$obr_contexhib, 
						$obr_moexhib, 
						$obr_fecincamaras,
						$obr_fecfincamaras,  
						$obr_cantcamaras, 
						$obr_contcamaras, 
						$obr_mocamaras, 
						$obr_supervisor, 
						$obr_obs, 
						$obr_fecin, 
						$obr_fecfin, 
						$obr_fecinreal, 
						$obr_fecfinreal, 
						$obr_coordenadas,
						$obr_pais,
						$obr_provincia,
						$obr_ciudad,	
						$obr_codigoPostal,
						$obr_codigoPais,
						$obr_URL,
						$obr_abonado){


	
		$sql	=	"UPDATE obras 
					SET 
					ID_cli				=	'" . $ID_cli . "',
					obr_dir				=	'" . $obr_dir . "',
					obr_nproyecto		=	'" . $obr_nproyecto . "',
					obr_ov				=	'" . $obr_ov . "',
					obr_np				=	'" . $obr_np . "',
					obr_ndestinatario	=	'" . $obr_ndestinatario . "',
					obr_fecmad			=	'" . $obr_fecmad . "',
					obr_npto 			=	'" . $obr_npto . "',
					obr_contacto		=	'" . $obr_contacto . "',
					obr_tel				=	'" . $obr_tel . "',
					obr_mail 			=	'" . $obr_mail . "',
					obr_nsucursal		=	'" . $obr_nsucursal . "',
					obr_desc 			=	'" . $obr_desc . "',
					obr_pto				=	'" . $obr_pto . "',
					ID_zon				=	'" . $ID_zon . "',
					obr_exhibARG		=	'" . $obr_exhibARG . "',
					obr_exhibEUR		=	'" . $obr_exhibEUR . "',
					obr_evaporadores	=	'" . $obr_evaporadores . "',
					obr_camaras			=	'" . $obr_camaras . "',
					obr_condensadores	=	'" . $obr_condensadores . "',
					obr_frioSTD			=	'" . $obr_frioSTD . "',
					obr_frioESP			=	'" . $obr_frioESP . "',
					obr_materialesObra	=	'" . $obr_materialesObra . "',
					obr_ingenieria		=	'" . $obr_ingenieria . "',
					obr_manoDeObra		=	'" . $obr_manoDeObra . "',
					obr_flete			=	'" . $obr_flete . "',
					obr_fecinfrio		=	'" . $obr_fecinfrio . "',
					obr_fecfinfrio		=	'" . $obr_fecfinfrio . "',
					obr_cantfrio		=	'" . $obr_cantfrio . "',
					obr_contfrio		=	'" . $obr_contfrio . "',
					obr_mofrio			=	'" . $obr_mofrio . "',
					obr_fecinexhib		=	'" . $obr_fecinexhib . "',
					obr_fecfinexhib		=	'" . $obr_fecfinexhib . "',
					obr_cantexhib		=	'" . $obr_cantexhib . "',
					obr_contexhib		=	'" . $obr_contexhib . "',
					obr_moexhib			=	'" . $obr_moexhib . "',
					obr_fecincamaras	=	'" . $obr_fecincamaras . "',
					obr_fecfincamaras	=	'" . $obr_fecfincamaras . "',
					obr_cantcamaras		=	'" . $obr_cantcamaras . "',
					obr_contcamaras		=	'" . $obr_contcamaras . "',
					obr_mocamaras		=	'" . $obr_mocamaras . "',
					obr_supervisor 		=	'" . $obr_supervisor . "',
					obr_obs 			=	'" . $obr_obs . "',
					obr_fecin			=	'" . $obr_fecin . "',
					obr_fecfin			=	'" . $obr_fecfin . "',
					obr_fecinreal 		=	'" . $obr_fecinreal . "',
					obr_fecfinreal		=	'" . $obr_fecfinreal . "',
					obr_coordenadas		=	'" . $obr_coordenadas . "',
					obr_pais			=	'" . $obr_pais. "',
					obr_provincia		=	'" . $obr_provincia. "',
					obr_ciudad			=	'" . $obr_ciudad. "',	
					obr_codigoPostal	=	'" . $obr_codigoPostal. "',
					obr_codigoPais		=	'" . $obr_codigoPais. "',
					obr_URL 			=	'" . $obr_URL . "',
					obr_abonado 		=	'" . $obr_abonado . "'
					WHERE ID_obr 		= 	'" . $ID_obr . "'";



				$update	=	mysql_query($sql);
				if(mysql_affected_rows() > 0){
					return 1;
				} else {
					return 0;
				}
	}
	function dropTienda($ID_obr)

	{

		$sql1	=	"SELECT * FROM registro_servicio
					 WHERE ID_obr=".$ID_obr."";
		$result1	=	mysql_query($sql1);
		$result11 	=	mysql_fetch_row($result1);
	
			$sql2="SELECT * FROM gastos 
					WHERE ID_obr=".$ID_obr."";
		$result2	=	mysql_query($sql2);	
		$result22 	=	mysql_fetch_row($result2);
			
			$sql3="SELECT * FROM gastos_tarjeta
					 WHERE ID_obr=".$ID_obr."";
		$result3	=	mysql_query($sql3);
		$result33 	=	mysql_fetch_row($result3);
			

		if	(!$result11)
		{
				if(!$result22)
				{
					if(!$result33)
					{
								$sql4	=	"DELETE FROM obras
											WHERE ID_obr='" . $ID_obr . "'";
							$result4	=	mysql_query($sql4);
							
							return 0;
							
					}
					else
					{
						return 3;
					}	
				}
				else
				{
					return 2;
				}	
			}
			else
			{
				return 1;
			}
			
			
		}
	
}
class zonas {
/*
*
* 
*
*/
	function insertZonas($ID_emp, $zon_desc, $zon_default){
		$sqlCheck	=	"SELECT * FROM zonas
						WHERE zonas.ID_emp='" . $ID_emp . "' AND
						zonas.zon_desc='" . $zon_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkZonRows	=	mysql_num_rows($resultCheck);
		if($checkZonRows != 0){
			$sql	=	"INSERT INTO zonas
						(ID_emp, zon_desc, zon_default)
						VALUES('" . $ID_emp  ."','" . $zon_desc  ."','" . $zon_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_emp='" . $ID_emp . "'
					ORDER BY zonas.zon_desc ASC";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
	function nuevaGetZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
					ORDER BY zonas.zon_desc ASC";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
		function nuevaGetZonasSinRepetir($ID_zon){
		$sql	=	"SELECT * FROM zonas 
				    WHERE ID_zon='".$ID_zon."'";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
			function nuevasGetZonasSinRepetir($ID_zon){
		$sql	=	"SELECT * FROM zonas 
		             WHERE ID_zon!='".$ID_zon."'";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
	function getZonasById($ID_zon){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_zon='" . $ID_zon . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_emp='" . $ID_emp . "'
					ORDER BY zonas.zon_desc ASC";
		$result				=	mysql_query($sql);
		$this->zonasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->zonasRows;$i++){
			$zon	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $zon['ID_zon'] . '">' . $zon['zon_desc'] . '</option>';
		}
	}		
}
class provincias {
/*
*
* 
*
*/
	function insertProvincias($prv_desc){
		$sqlCheck	=	"SELECT * FROM provincias
						WHERE provincias.prv_desc='" . $prv_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkPrvRows	=	mysql_num_rows($resultCheck);
		if($checkPrvRows != 0){
			$sql	=	"INSERT INTO provincias
						(prv_desc)
						VALUES('" . $prv_desc  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getProvincias(){
		$sql	=	"SELECT * FROM provincias
					ORDER BY provincias.prv_desc ASC";
		$result			=	mysql_query($sql);
		$this->prvRows	=	mysql_num_rows($result);
		return $result;
	}
	function getProvinciasById($ID_prv){
		$sql	=	"SELECT * FROM provincias
		 			WHERE provincias.ID_prv='" . $ID_prv . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaProvincias(){
		$sql	=	"SELECT * FROM provincias
					ORDER BY provincias.prv_desc ASC";
		$result					=	mysql_query($sql);
		$this->provinciasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->provinciasRows;$i++){
			$prv	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $prv['ID_prv'] . '">' . $prv['prv_desc'] . '</option>';
		}
	}		
}
class ciudades {
/*
*
* 
*
*/
	function insertCiudades($ciu_desc){
		$sqlCheck	=	"SELECT * FROM ciudades
						WHERE ciudades.ciu_desc='" . $ciu_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkCiuRows	=	mysql_num_rows($resultCheck);
		if($checkCiuRows != 0){
			$sql	=	"INSERT INTO ciudades
						(ciu_desc)
						VALUES('" . $ciu_desc  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getCiudades(){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
					ORDER BY ciudades.ciu_desc ASC";
		$result			=	mysql_query($sql);
		$this->ciuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getCiudadesById($ID_ciu){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
		 			WHERE ciudades.ID_ciu='" . $ID_ciu . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaCiudades(){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
					ORDER BY ciudades.ciu_desc ASC";
		$result					=	mysql_query($sql);
		$this->ciudadesRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->ciudadesRows;$i++){
			$ciu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $ciu['ID_ciu'] . '" class="' . $ciu['ID_prv'] . '">' . $ciu['ciu_desc'] . '</option>';
		}
	}		
}

class tasks
{

		function getregistro_servicio_tas($ID_tas)
	{

		$sql	=	"SELECT * FROM tasks WHERE ID_tas=".$ID_tas."";
		$result				=	mysql_query($sql);
		return $result;

	}

	function TareaInsertAdjuntos($ID_usu, $id, $adj_ruta, $ser_cod)
	{
		$sql2	=	"INSERT INTO adjuntos
					(ID_usu,
					adj_tipo,
					adj_idRelacion, 
					adj_tablaRelacion, 
					adj_ruta, 
					adj_desc, 
					adj_fecha)
					VALUES('".$ID_usu."',
					'1',
					'".$id."', 
					'tasks', 
					'".$adj_ruta."', 
					'".$ser_cod."', 
					'".date("Y-m-d H:i:s")."')";
		$result2=	mysql_query($sql2);
	}

	function getUltimoregistro_servicio_tas()
	{

		$sql	=	"SELECT * FROM tasks  ORDER BY ID_tas DESC LIMIT 1";
		$result				=	mysql_query($sql);
		return $result;

	}
		function insert_registro_servicio_tas($ID_tas, $tas_firma)
	{
		$sql	=	"UPDATE tasks
					SET tas_firma='" . $tas_firma . "'
					WHERE ID_tas='" . $ID_tas . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}

	function insertTask($ID_ser, $ID_usu, $tas_fecin, $tas_hourin, $tas_desc, $tas_tipo)
	{
		$sql	 =	"INSERT INTO tasks
					(ID_ser, ID_usu, tas_fecin, tas_hourin, tas_desc, tas_tipo)
					VALUES('".$ID_ser."', '".$ID_usu."', '".$tas_fecin."', '".$tas_hourin."', '".$tas_desc."', '".$tas_tipo."')";
		$insert		=	mysql_query($sql);
	}

	function deleteTask($ID_tas)
	{
			$sql="DELETE FROM tasks WHERE ID_tas=".$ID_tas."";
		$result = mysql_query($sql);
		return $result;
	}


	function getTasksByIdSer($ID_ser)
	{
		$sql="SELECT * FROM tasks, usuarios, registro_servicio WHERE usuarios.ID_usu=tasks.ID_usu AND registro_servicio.ID_ser=tasks.ID_ser AND registro_servicio.ID_ser=".$ID_ser."";
		$result			=	mysql_query($sql);	
		return $result;
	}


}


class tipoGastos {
/*
*
* 
*
*/
	function insertTipoGastos($ID_emp, $tip_cuenta, $tip_desc, $tip_default){
		$sqlCheck	=	"SELECT * FROM tipo_gastos
						WHERE tipo_gastos.ID_emp='" . $ID_emp . "' AND
						tipo_gastos.top_desc='" . $tip_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkCliRows	=	mysql_num_rows($resultCheck);
		if($checkCliRows != 0){
			$sql	=	"INSERT INTO 	
						(ID_emp, zon_desc, zon_default)
						VALUES('" . $ID_emp  ."','" . $zon_desc  ."','" . $zon_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
}
class contratistas {
/*
*
* 
*
*/

	function getContratistas($ID_emp){
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE ID_tpu='22' AND
						empresas.ID_emp='" . $ID_emp . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }
	 
	 function getContratistasById($ID_cont){
		$sql		=	"SELECT * FROM usuarios
						WHERE usuarios.ID_usu='" . $ID_cont . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }

	function generaContratistas($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE ID_tpu='22' AND
					empresas.ID_emp='" . $ID_emp . "'
					ORDER BY usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->contratistasRows	=	mysql_num_rows($result);
		echo "<option value=''>Seleccionar</option>";
		for($i=0;$i<$this->contratistasRows;$i++){
			$cont	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
		}
	}		

}
class supervisores {
/*
*
* 
*
*/

	function getSupervisores($ID_emp){
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE ID_tpu='5' AND
						empresas.ID_emp='" . $ID_emp . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }
	 
	  function getSupervisoresById($ID_sup){
		$sql		=	"SELECT * FROM usuarios
						WHERE usuarios.ID_usu='" . $ID_sup . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }

	function generaSupervisores($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE ID_tpu='5' AND
					empresas.ID_emp='" . $ID_emp . "'
					ORDER BY usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->supervisoresRows	=	mysql_num_rows($result);
		echo "<option value=''>Seleccionar</option>";
		for($i=0;$i<$this->supervisoresRows;$i++){
			$cont	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
		}
	}		

}

class questions
{
	function getQuestionsAnterior($ID_ser, $ID_qts)
	{

		$sql="SELECT * FROM questions, answers where questions.ID_qts=answers.ID_qts AND (questions.qts_siguiente1=".$ID_qts." or questions.qts_siguiente2=".$ID_qts.") and answers.ID_ser=".$ID_ser."";
		$result					=	mysql_query($sql);
		return $result;
	}

	function getQuestionsMafre($ID_cli, $qts_madre)
	{
		$sql="SELECT * FROM questions WHERE ID_cli='".$ID_cli."' AND qts_madre='1'";
		$result					=	mysql_query($sql);
		return $result;
	}

		function getQuestionsMadre($ID_cli, $ID_qts)
	{
		$sql="SELECT ID_qts FROM questions WHERE ID_cli='".$ID_cli."' AND qts_madre='1' AND ID_qts=".$ID_qts."";
		$result					=	mysql_query($sql);
		$num_result  			=   mysql_num_rows($result);
		if ($num_result!=0)
		{
			$varMadre="si";
		}
		else
		{
			$varMadre="no";
		}
		return $varMadre;
	}
	function getQuestions($ID_cli)
	{
		$sql="SELECT * FROM questions WHERE ID_cli='".$ID_cli."' AND qts_madre='0'";
		$result					=	mysql_query($sql);
		return $result;
	}
		function getQuestionsSoloID($ID_cli)
	{
		$sql="SELECT distinct ID_cli FROM questions";
		$result					=	mysql_query($sql);
		return $result;
	}

}

class answers
{
	function getAnswers($ID_ser)
	{
		$sql="SELECT * FROM answers, questions WHERE questions.ID_qts=answers.ID_qts AND ID_ser=".$ID_ser."";
		$result					=	mysql_query($sql);
		return $result;
	}

	function getAnswersUltima($ID_ser)
	{
		$sql="SELECT * FROM answers, questions WHERE questions.ID_qts=answers.ID_qts AND ID_ser=".$ID_ser." ORDER BY ID_aws DESC LIMIT 1";
		$result					=	mysql_query($sql);
		return $result;
	}

	

	function insertAnswers($aws_desc, $ID_qts, $ID_ser)
	{
			$sql	=	"INSERT INTO answers
					(aws_desc, ID_qts, ID_ser)
					VALUES('". $aws_desc . "', '". $ID_qts . "', '". $ID_ser . "')";
		$insert		=	mysql_query($sql);
	}

	function dropAnswersByIdSer($ID_ser)
	{
				$sql	=	"DELETE FROM answers
					WHERE ID_ser='" . $ID_ser . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}

	function dropAnswersByIdSerUltima($ID_ser)
	{
				$sql	=	"DELETE FROM answers
					WHERE ID_ser='" . $ID_ser . "' ORDER BY ID_aws DESC LIMIT 1";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
	
}

?>