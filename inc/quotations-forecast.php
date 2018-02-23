<?php

	if ($usu!='0')
	{
		$filter	= 'AND quotations.ID_usu='.$ID_usu;
	}	


	if ($ger!='0')
	{
		   $filter = ' AND quotations.ID_gcm='.$ger;
	}	

	if ($asignado!='0')
	{
		 $filter	= 'AND quotations.pto_asignado='.$asignado;
	}

	if($usu=='0' AND $ger=='0' AND $asignado=='0')
	{
		$filter	= '';
	}

	

		$sql2	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, quotations_fic, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecPresupuesto), NOW())<=status.sta_color1 AND
					quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') 
										AND (quotations_fic.fic_exhibArg != 0 OR
										quotations_fic.fic_camaras  != 0 OR
										quotations_fic.fic_frioStd  != 0 OR
										quotations_fic.fic_frioEsp  != 0 )
										AND
										ID_pto <> all (SELECT ID_pto FROM forecast)
					$filter";
		$result2	=	mysql_query($sql2);
		if ($result2) {
			$color2	= array();
			$count2	= array();
        	while ($row = mysql_fetch_assoc($result2)) {
				$color2[] =	"> " . $row['sta_color1'] . "Hs";
            	$count2[] = $row["count"];
        	}
    	}
		$sql21	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, quotations_fic, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecPresupuesto), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecIngreso), NOW())>status.sta_color1 AND
					quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND (quotations_fic.fic_exhibArg != 0 OR
										quotations_fic.fic_camaras  != 0 OR
										quotations_fic.fic_frioStd  != 0 OR
										quotations_fic.fic_frioEsp  != 0  )
										AND
										ID_pto <> all (SELECT ID_pto FROM forecast)
					$filter";
		$result21	=	mysql_query($sql21);
		if ($result21) {
        	while ($row = mysql_fetch_assoc($result21)) {
				$color2[] =	"> " . $row['sta_color2'] . "Hs";
            	$count2[] = $row["count"];
        	}
    	}
		$sql22	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, quotations_fic, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecPresupuesto), NOW())>status.sta_color2 AND
					quotations.ID_fic=quotations_fic.ID_fic AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND (quotations_fic.fic_exhibArg != 0 OR
										quotations_fic.fic_camaras  != 0 OR
										quotations_fic.fic_frioStd  != 0 OR
										quotations_fic.fic_frioEsp  != 0 )
										AND
										ID_pto <> all (SELECT ID_pto FROM forecast)
					$filter";
		$result22	=	mysql_query($sql22);
		if ($result22) {
        	while ($row = mysql_fetch_assoc($result22)) {
				$color2[] =	"< " . $row['sta_color2'] . "Hs";
            	$count2[] = $row["count"];
        	}
    	}
    echo '<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "pie2d",
        "renderAt": "chartContainerForecast",
        "width": "300",
        "height": "350",
        "dataFormat": "json",
        "dataSource":  {
          "chart": {
        "caption": "",
        "showpercentageinlabel": "1",
        "showvalues": "0",
        "showlabels": "0",
        "showlegend": "1",
        "showborder": "0"
    },
    "data": [
        {
            "label": "'.$color2[0].'",
            "value": "'.$count2[0].'",
            "color": "#00A859"

        },
        {
            "label": "'.$color2[1].'",
            "value": "'.$count2[1].'",
            "color": "#FFF212"

        },
        {
            "label": "'.$color2[2].'",
            "value": "'.$count2[2].'",
            "color": "#ED3237"

        }
       
    ]
      }

  });
revenueChart.render();
})
</script>';


?>

 <div id="chartContainerForecast" >FusionCharts XT will load here!</div>


