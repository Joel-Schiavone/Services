<?php
if($ID_usu == 0){
	$usu	=	'';
} else {
	$usu	=	'AND quotations.pto_asignado="' . $ID_usu . '"';
}
		$sql2	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecIngreso), NOW())<=status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='13'
					$usu";
		$result2	=	mysql_query($sql2);
		if ($result2) {
			$color2	= array();
			$count2	= array();
        	while ($row = mysql_fetch_assoc($result2)) {
				$color2[] =	"Menor a " . $row['sta_color1'] . " Hs";
            	$count2[] = $row["count"];
        	}
    	}
		$sql21	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecIngreso), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecIngreso), NOW())>status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='13'
					$usu";
		$result21	=	mysql_query($sql21);
		if ($result21) {
        	while ($row = mysql_fetch_assoc($result21)) {
				$color2[] =	"Menor a " . $row['sta_color2'] . " Hs";
            	$count2[] = $row["count"];
        	}
    	}
		$sql22	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(HOUR, TIMESTAMP(quotations.pto_fecIngreso), NOW())>status.sta_color2 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='13'
					$usu";
		$result22	=	mysql_query($sql22);
		if ($result22) {
        	while ($row = mysql_fetch_assoc($result22)) {
				$color2[] =	"Mayor a " . $row['sta_color2'] . " Hs";
            	$count2[] = $row["count"];
        	}
    	}
?>
<div class="row">
   	<canvas id="venta" width="400" height="400"></canvas>
<script>
var ctx = document.getElementById("venta");
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
