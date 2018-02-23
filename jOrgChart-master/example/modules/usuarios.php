<?php
class usuarios  {
		 var  $cant;
		 //var  $habilitado;

	/// CONSULTAS PARA EL ABM DE LA TABLA USUARIOS
	function usuarios(){
		$sql		= "SELECT * FROM usuarios, tipo_usuarios WHERE usuarios.ID_tpu=tipo_usuarios.ID_tpu AND tipo_usuarios.ID_tpu<>'22' ORDER BY usuarios.usu_apellido ASC";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}
	
	function usuarios_id($id){
		$sql		= "SELECT ID_usu, usu_username, usu_password, usu_nombre, usu_apellido, usu_legajo, usu_telefono, usu_email, ID_tpu, usu_tarjeta, usu_cco, usu_clave, ID_usu_ger FROM usuarios WHERE ID_usu = " . $id;
		$result		= mysql_query ($sql);
		@$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}
	
	function usuarios_tpu(){
		$sql		= "SELECT * FROM usuarios, tipo_usuarios WHERE usuarios.ID_tpu=tipo_usuarios.ID_tpu AND tipo_usuarios.tpu_cod='TES'";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}
	
	function usuarios_tarjeta($usu_tarjeta){
		$sql		= "SELECT ID_usu, usu_username, usu_password, usu_nombre, usu_apellido, usu_legajo, usu_telefono, usu_email, ID_tpu, usu_tarjeta, usu_cco FROM usuarios WHERE usu_tarjeta='" . $usu_tarjeta . "'";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}

	function usuarios_tarjeta_2(){
		$sql		= "SELECT * FROM usuarios WHERE usu_tarjeta<>''";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}

	function insert_usuarios($usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger){
		$sql		= "INSERT INTO usuarios (usu_username, usu_password, usu_nombre, usu_apellido, usu_legajo, usu_cco, usu_telefono, usu_email, usu_tarjeta, ID_tpu, ID_usu_ger) VALUES('". $usu_username . "','" . $usu_password . "','" . $usu_nombre . "','" . $usu_apellido . "','" . $usu_legajo . "','" . $usu_cco . "','" . $usu_telefono . "','" . $usu_email . "','" . $usu_tarjeta . "','" . $ID_tpu . "','" . $ID_usu_ger . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	function modifica_usuarios($ID_usu, $usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger, $cambia_clave){
		$sql		= 	"UPDATE usuarios SET usu_username = '" . $usu_username . "', usu_password='" . $usu_password ."', usu_nombre ='" . $usu_nombre . "', usu_apellido='" . $usu_apellido ."', usu_legajo='" . $usu_legajo ."', usu_telefono='" . $usu_telefono ."', usu_email='" . $usu_email . "', usu_tarjeta='" . $usu_tarjeta . "', ID_tpu='" . $ID_tpu . "', ID_usu_ger='" . $ID_usu_ger . "', usu_clave='" . $cambia_clave . "', usu_cco='" . $usu_cco . "' WHERE ID_usu = " . $ID_usu;
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}

	function elimina_usuarios($id){
		$sql	=	"DELETE FROM usuarios WHERE ID_usu = " .$id;
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function usuarios_gerente($ID_usu_ger){
		$sql	=	"SELECT * FROM usuarios WHERE ID_usu_ger='" . $ID_usu_ger . "'";
		$result		=	mysql_query($sql);
		return $result;
	}
	
	function usuarios_gerente_2($ID_usu_ger){
		$sql	=	"SELECT * FROM usuarios WHERE ID_usu='" . $ID_usu_ger . "'";
		$result		=	mysql_query($sql);
		return $result;
	}

	function usu_cambia_clave($ID_usu, $pass_new){
		$sql		= 	"UPDATE usuarios SET usu_password='" . $pass_new ."', usu_clave='0' WHERE ID_usu ='" . $ID_usu . "'";
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}
	function usuarios_tesorero(){
		$sql	=	"SELECT * FROM usuarios WHERE ID_tpu='7'";
		$result		=	mysql_query($sql);
		return $result;
	}

//////////// CONSULTAS PARA TABLA TIPO USUARIOS

	function tipo_usuarios(){
		$sql		= "SELECT * FROM tipo_usuarios";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}

	function tipo_usuarios_id($ID_tpu){
		$sql		= "SELECT * FROM tipo_usuarios WHERE ID_tpu='" . $ID_tpu . "'";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}

	function insert_tipo_usuarios($tpu_cod, $tpu_desc){
		$sql		= "INSERT INTO tipo_usuarios (tpu_cod,tpu_desc) VALUES('" . $tpu_cod . "','" . $tpu_desc . "')";
		$result		= mysql_query($sql);
		if($result) {return 1;} else { return 0;};
	}
	
	function modifica_tipo_usuarios($ID_tpu, $tpu_cod, $tpu_desc){
		$sql		= 	"UPDATE tipo_usuarios SET tpu_cod='" . $tpu_cod . "', tpu_desc='" . $tpu_desc ."' WHERE ID_tpu ='" . $ID_tpu . "'";
		//echo $sql; die();
		$result		=	mysql_query($sql);
		return $result;
	}

	function elimina_tipo_usuarios($ID_tpu){
		$sql	=	"DELETE FROM tipo_usuarios WHERE ID_tpu ='" . $ID_tpu . "'";
		$result		=	mysql_query($sql);
		return $result;
	}


//////////// CONSULTAS PARA CCO

	function usuarios_cco(){
		$sql		= "SELECT usu_cco FROM usuarios GROUP BY usu_cco";
		$result		= mysql_query ($sql);
		$this->cant	=	mysql_num_rows($result);
			if ($this->cant == 0) return 0;
			return $result;
	}

	//.............................

	 function login () {
		
		$username	= mysql_real_escape_string($this->usu_username);
		$password	= mysql_real_escape_string($this->contrasena);
		$empCod		= mysql_real_escape_string($this->empCod);
		$sql	=	"SELECT * FROM usuarios, empresas
						WHERE usuarios.ID_emp=empresas.ID_emp AND
						usuarios.usu_username='" . $username . "' AND
						usuarios.usu_password='" . $password . "' AND
						empresas.emp_cod='" . $empCod . "'";
		$result	=	mysql_query($sql);
			
		//si no me devuelve nada es porque no existe el usuario, devuelve 1 y sale
		if (!mysql_num_rows($result)) return 0;
		
		//sino, si existe el usuario, me arma el array y asigna los privilegios
		$resul			=	mysql_fetch_array($result);
		
		$this->ID_usu			=	$resul['ID_usu'];
		$this->usu_username		=	$resul['usu_username'];
		$this->usu_nombre 		=	$resul['usu_nombre'];
		$this->usu_apellido 	=	$resul['usu_apellido'];
		$this->usu_tipousu		=	$resul['ID_tpu'];
		$this->ID_usu_ger		=	$resul['ID_usu_ger'];
		$this->usu_email		=	$resul['usu_email'];
		$this->ID_emp			=	$resul['ID_emp'];
		return $resul;
	}

	function validaUsuExistente2 ($id, $login){		//CHEQUEA QUE NO HAYA OTRO USUARIO CON EL MISMO NOM DE USUARIO
		$sql		=	"SELECT * FROM usuarios WHERE us_username = '" . $login . "' AND us_id <> " . $id;
		$result		=	mysql_query($sql);
		$mismo_nom	=	mysql_num_rows($result);
				
		return $mismo_nom;			//si $mismo_nom != 0 entonces existe un usuario con ese nombre de usuario
	}
		
}
?>