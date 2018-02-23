<?php
if($usu!=0)
{
	$filter	=	"AND (quotations.ID_usu=$usu or quotations.pto_vendedor=$usu or quotations.pto_asignado=$usu)";
} else {
	$filter	=	"";
}


		$sql2	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecDespacho), NOW())<=status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta=20
					$filter";
		$result2	=	mysql_query($sql2);
		if ($result2) {
			$color2	= array();
			$count2	= array();
        	while ($row = mysql_fetch_assoc($result2)) {
				$color2[] =	"Menor a " . $row['sta_color1'] . " Ds";
            	$count2[] = $row["count"];
        	}
    	}
		$sql21	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecDespacho), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecDespacho), NOW())>status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta=20
					$filter";
		$result21	=	mysql_query($sql21);
		if ($result21) {
        	while ($row = mysql_fetch_assoc($result21)) {
				$color2[] =	"Menor a " . $row['sta_color2'] . " Ds";
            	$count2[] = $row["count"];
        	}
    	}
		$sql22	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecDespacho), NOW())>status.sta_color2 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta=20
					$filter";
		$result22	=	mysql_query($sql22);
		if ($result22) {
        	while ($row = mysql_fetch_assoc($result22)) {
				$color2[] =	"Mayor a " . $row['sta_color2'] . " Ds";
            	$count2[] = $row["count"];
        	}
    	}
?>
<div class="row">
   	<canvas id="instala" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("instala");
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?=json_encode($color2);?>,
        datasets : [{
        data :<?=json_encode($count2);?>,
		backgroundColor: [
			"#00A859",
			"#FFF212",
			"#ED3237"
			]
    }]
    },
});
</script>
</div>
