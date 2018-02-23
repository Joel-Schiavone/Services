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


		$sql4	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE CURDATE()<DATE(quotations.pto_fecEntregaEstimada) AND
					quotations.ID_sta=status.ID_sta AND.
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='24'
					$filter";
		$result4	=	mysql_query($sql4);
		if ($result4) {
			$color4	= array();
			$count4	= array();
        	while ($row = mysql_fetch_assoc($result4)) {
				$color4[] =	"OK";
            	$count4[] = $row["count"];
        	}
    	}
		$sql41	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE CURDATE()=DATE(quotations.pto_fecEntregaEstimada) AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='24'
					$filter";
		$result41	=	mysql_query($sql41);
		if ($result41) {
        	while ($row = mysql_fetch_assoc($result41)) {
				$color4[] =	"Entrega Hoy";
            	$count4[] = $row["count"];
        	}
    	}
		$sql42	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status, usuarios
					WHERE CURDATE()>DATE(quotations.pto_fecEntregaEstimada) AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_usu=usuarios.ID_usu AND
					quotations.ID_sta='24'
					$filter";
		$result42	=	mysql_query($sql42);
		if ($result42) {
        	while ($row = mysql_fetch_assoc($result42)) {
				$color4[] =	"Vencido";
            	$count4[] = $row["count"];
        	}
    	}
    echo '<script type="text/javascript">
  FusionCharts.ready(function(){
    var revenueChart = new FusionCharts({
        "type": "pie2d",
        "renderAt": "chartContainerAceptados",
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
            "label": "'.$color4[0].'",
            "value": "'.$count4[0].'",
            "color": "#00A859"

        },
        {
            "label": "'.$color4[1].'",
            "value": "'.$count4[1].'",
            "color": "#FFF212"

        },
        {
            "label": "'.$color4[2].'",
            "value": "'.$count4[2].'",
            "color": "#ED3237"

        }
       
    ]
      }

  });
revenueChart.render();
})
</script>';


?>

 <div id="chartContainerAceptados" >FusionCharts XT will load here!</div>

 
