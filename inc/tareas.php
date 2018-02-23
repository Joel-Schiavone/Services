
  <?php
  	
			$tasks = new tasks;
			$getTasksByIdSer=$tasks->getTasksByIdSer($ID_ser);
			$num_getTasksByIdSer=mysql_num_rows($getTasksByIdSer);
			
		if ($num_getTasksByIdSer!=0)
		{


			echo	'<table class="table table-striped">
						<tr class="info">
							<td colspan="5">
								<h4>
									<i class="material-icons" style="vertical-align: middle;">
										assignment
									</i>
									 Tareas
								</h4>
							</td>
						</tr>
						<tr class="info">
							<th style="text-align: center;">
								<i class="material-icons" style="vertical-align: middle;">
									date_range
								</i>
								Fecha
							</th>
							<th style="text-align: center;">
								<i class="material-icons" style="vertical-align: middle;">
									access_time
								</i>
								Hora
							</th>
							<th style="text-align: center;">
								<i class="material-icons" style="vertical-align: middle;">
									face
								</i>
								 Usuario
							</th>
							<th style="text-align: center;">
								<i class="material-icons" style="vertical-align: middle;">
									reorder
								</i> 
								Descripción
							</th>
							<th style="text-align: center;">
								<i class="material-icons" style="vertical-align: middle;">
									delete
								</i>
								Eliminar
							</th>
						</tr>';

			  for ($tasksCount=0; $tasksCount < $num_getTasksByIdSer; $tasksCount++) 
			  { 
			    $assoc_getTasksByIdSer=mysql_fetch_assoc($getTasksByIdSer);
			    echo	'<tr class="info">';
				echo		'<td style="text-align: center;">' . $assoc_getTasksByIdSer['tas_fecin'] . '</td>';
				echo		'<td style="text-align: center;">' . $assoc_getTasksByIdSer['tas_hourin'] . '</td>';
				echo		'<td style="text-align: center;">' . $assoc_getTasksByIdSer['usu_nombre'] . ' ' . $assoc_getTasksByIdSer['usu_apellido'] . '</td>';
				echo		'<td style="text-align: center;">' . $assoc_getTasksByIdSer['tas_desc'] . '</td>';
				echo	'</tr>';
			  }
			  	echo	'</table>';
			}	

	
		else
		{
			 				echo '<div class="alert alert-primary" role="alert">';
				 				echo '<div class="col-md-12">';
			                    	echo '<h5><i class="material-icons" style="vertical-align: middle">thumb_up</i> No se registran tareas pendinetes</h5>';
			                    echo '</div>';	

		}		
  ?>


