
<!--Inicio: Genera codigo-->
<?php 
			//Trae ultimo numero del codigo desde la tabla dedicada quotations_numeracion
			$quotations_numeracion = new quotations_numeracion;
			$GetUltimoQuotationsNumeracion  		=  $quotations_numeracion->GetUltimoQuotationsNumeracion($qno_tipo);
			$assoc_GetUltimoQuotationsNumeracion    =  mysql_fetch_assoc($GetUltimoQuotationsNumeracion);
			$NEXTID						 			=  $assoc_GetUltimoQuotationsNumeracion['qno_ultimo']+1;

			//Cuenta la cantidad de decimales para mantener siempre 4 numeros en el codigo final
			$number						 			=  strlen($NEXTID);
			if($number==1)
			{
				$pref	=	'0000';
			} elseif($number==2) 
			{
				$pref	=	'000';
			} elseif($number==3)
			{
				$pref	=	'00';
			} elseif($number==4) 
			{
				$pref	=	'0';
			} else
			{
				$pref	=	'';
			}
		//Fin: Genera codigo	

			//genera el codigo anteponiendo el tipo de codigo y el año sumado a la cantidad de ceros resultantes y al ultimo numero extraido de la funcion anterior sumandole uno 
 		echo $fic_cod = 'NE'.date('y').'-'.$pref.$NEXTID;

 		//modifica la tabla quotation_numeracion incrementando en uno el valor de qnu_ultimo 
		$qnu_ultimo								=  $NEXTID;
		$ID_qno 								=  $assoc_GetUltimoQuotationsNumeracion['ID_qno'];
 		$UpdateUltimoQuotationsNumeracion = $quotations_numeracion->UpdateUltimoQuotationsNumeracion($ID_qno, $qnu_ultimo);
 

?>
<!--Fin: Genera codigo-->