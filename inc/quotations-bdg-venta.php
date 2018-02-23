<?php
if($for == 'dashboard-sales.php'){
	$filter	=	'AND quotations.ID_usu='.$ID_usu;
} else {
	$filter	=	'';
}
		$sql5	=	"SELECT sta_color1, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='25'
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
					FROM quotations, status
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())<=status.sta_color2 AND
					TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color1 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='25'
					$filter";
		$result51	=	mysql_query($sql51);
		if ($result51) {
        	while ($row = mysql_fetch_assoc($result51)) {
				$color5[] =	"> " . $row['sta_color2'] . " Ds";
            	$count5[] = $row["count"];
        	}
    	}
		$sql52	=	"SELECT sta_color2, count(quotations.ID_pto) as count
					FROM quotations, status
					WHERE TIMESTAMPDIFF(DAY, TIMESTAMP(quotations.pto_fecAsignado), NOW())>status.sta_color2 AND
					quotations.ID_sta=status.ID_sta AND
					quotations.ID_sta='25'
					$filter";
		$result52	=	mysql_query($sql52);
		if ($result52) {
        	while ($row = mysql_fetch_assoc($result52)) {
				$color5[] =	"< " . $row['sta_color2'] . " Ds";
            	$count5[] = $row["count"];
        	}
    	}
?>
<div>
   	<canvas id="presupuestado" height="250px"></canvas>
<script>
var ctx = document.getElementById("presupuestado");
var myChart = new Chart(ctx, {
    type: 'pie',
    data: {
        labels: <?=json_encode($color5);?>,
        datasets : [{
        data :<?=json_encode($count5);?>,
		backgroundColor: [
			"#00A859",
			"#FFF212",
			"#ED3257"
			]
    }]
    },
});
</script>
</div>
