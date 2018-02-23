<?php

	if ($usu!='0')
	{
		$filter	= 'AND quotations.ID_usu='.$ID_usu;
	}	


	if ($ger!='0')
	{
		   $filter = " AND quotations.ID_gcm=".$_SESSION['ID_gcm']."";

	}	

	if ($asignado!='0')
	{
		 $filter	= 'AND quotations.pto_asignado='.$ID_usu;

	}

	if($usu=='0' AND $ger=='0' AND $asignado=='0')
	{
		$filter	= '';
	}


		$sql3	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='23'
					$filter";
		$result3	=	mysql_query($sql3);
		if ($result3) {
			$color3	= array();
			$count3	= array();
        	while ($row = mysql_fetch_assoc($result3)) {
				$color3[] =	"> " . $row['sta_color1'] . "Hs";
            	$count3[] = $row["count"];
        	}
    	}
		$sql31	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='23'
					$filter";
		$result31	=	mysql_query($sql31);
		if ($result31) {
        	while ($row = mysql_fetch_assoc($result31)) {
				$color3[] =	"> " . $row['sta_color2'] . "Hs";
            	$count3[] = $row["count"];
        	}
    	}
		$sql32	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color2 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='23'
					$filter";
		$result32	=	mysql_query($sql32);
		if ($result32) {
        	while ($row = mysql_fetch_assoc($result32)) {
				$color3[] =	"< " . $row['sta_color2'] . "Hs";
            	$count3[] = $row["count"];
        	}
    	}

    echo '<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "pie2d",
        "renderAt": "chartContainerAsignado",
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
            "label": "'.$color3[0].'",
            "value": "'.$count3[0].'",
            "color": "#00A859"

        },
        {
            "label": "'.$color3[1].'",
            "value": "'.$count3[1].'",
            "color": "#FFF212"

        },
        {
            "label": "'.$color3[2].'",
            "value": "'.$count3[2].'",
            "color": "#ED3237"

        }
       
    ]
      }

  });
revenueChart.render();
})
</script>';


?>

 <div id="chartContainerAsignado" >FusionCharts XT will load here!</div>

 














