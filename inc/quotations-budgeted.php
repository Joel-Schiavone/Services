<?php

	if ($usu!='0')
	{
		$filter	= 'AND (quotations.ID_usu='.$ID_usu.' OR quotations.pto_vendedor='.$ID_usu.')';
	}	


	if ($ger!='0')
	{
		   $filter = " AND quotations.ID_gcm=".$ger."";

	}	

	if ($asignado!='0')
	{
		 $filter	= 'AND quotations.pto_asignado='.$ID_usu;

	}

	if($usu=='0' AND $ger=='0' AND $asignado=='0')
	{
		$filter	= '';
	}
		$sql5	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_usu=usuarios.ID_usu 
					$filter";
		$result5	=	mysql_query($sql5);
		if ($result5) {
			$color5	= array();
			$count5	= array();
        	while ($row = mysql_fetch_assoc($result5)) {
				$color5[] =	"> " . $row['sta_color1'] . " Ds";
            	$count5[] = $row["count"];
        	}
    	}
		$sql51	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_usu=usuarios.ID_usu 
					$filter";
		$result51	=	mysql_query($sql51);
		if ($result51) {
        	while ($row = mysql_fetch_assoc($result51)) {
				$color5[] =	"> " . $row['sta_color2'] . " Ds";
            	$count5[] = $row["count"];
        	}
    	}
		$sql52	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color2 AND
					quotations.ID_sta=status.ID_sta AND
					(quotations.ID_sta='25' or quotations.ID_sta='28' or quotations.ID_sta='29' or quotations.ID_sta='30' or quotations.ID_sta='31') AND
					quotations.ID_usu=usuarios.ID_usu 
					$filter";
		$result52	=	mysql_query($sql52);
		if ($result52) {
        	while ($row = mysql_fetch_assoc($result52)) {
				$color5[] =	"< " . $row['sta_color2'] . " Ds";
            	$count5[] = $row["count"];
        	}
    	}
  echo '<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "pie2d",
        "renderAt": "chartContainerBudgeted",
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
            "label": "'.$color5[0].'",
            "value": "'.$count5[0].'",
            "color": "#00A859"

        },
        {
            "label": "'.$color5[1].'",
            "value": "'.$count5[1].'",
            "color": "#FFF212"

        },
        {
            "label": "'.$color5[2].'",
            "value": "'.$count5[2].'",
            "color": "#ED3237"

        }
       
    ]
      }

  });
revenueChart.render();
})
</script>';


?>

 <div id="chartContainerBudgeted" >FusionCharts XT will load here!</div>

