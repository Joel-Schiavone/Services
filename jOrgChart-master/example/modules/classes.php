<?php
class login {
/*
*
* This class will be used to check user account and set the _SESSION variables
*
*/
	function checkLogin($username, $password, $empCod) {
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE usuarios.ID_emp=empresas.ID_emp AND
						usuarios.usu_username='" . $username . "' AND
						usuarios.usu_password='" . $password . "' AND
						empresas.emp_cod='" . $empCod . "'";
		$result		=	mysql_query($sql);
		$numResult	=	mysql_num_rows($result); 
		if($numResult != 0){
			$dataResult		=	mysql_fetch_assoc($result);
			if($dataResult['usu_habilitado'] != 0){
				$_SESSION['usuario'] 				=	$dataResult['usu_username'];
				$_SESSION['estado'] 				=	'conectado';
				$_SESSION['nombre'] 				=	$dataResult['usu_nombre'];
				$_SESSION['apellido'] 				=	$dataResult['usu_apellido'];
				$_SESSION['tipou'] 					=	$dataResult['ID_tpu'];
				$_SESSION['ID_usu']					=	$dataResult['ID_usu'];
				$_SESSION['ID_usu_ger']				=	$dataResult['ID_usu_ger'];
				$_SESSION['usu_email']				=	$dataResult['usu_email'];
				$_SESSION['ID_emp']					=	$dataResult['ID_emp'];
				$_SESSION['usu_clave']				=	$dataResult['usu_clave'];
				$_SESSION['emp_nombre']				=	$dataResult['emp_nombre'];
				$_SESSION['timeout']				=	time();
				header('Location: index.php');
			} else {
				header('Location: login.php?all=2');
			}
		} else {
			header('Location: login.php?all=0');
		}
	}
}

class menu {
/*
*
* This class is used to construct the menu for each system based on the user permissions
*
*/
	function getModulosBySistema($sis_cod, $ID_usu){
		$sql	=	"SELECT * FROM sistemas, modulos, formularios, permisos WHERE sistemas.ID_sis=modulos.ID_sis AND
					modulos.ID_mod=formularios.ID_mod AND
					formularios.ID_for=permisos.ID_for AND
					sistemas.sis_cod='" . $sis_cod . "' AND
					permisos.ID_usu='" . $ID_usu . "'
					GROUP BY modulos.ID_mod
					ORDER BY modulos.mod_prioridad ASC";
		$result				=	mysql_query($sql);
		$this->modBySisRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosByModulos($ID_mod){
		$sql	=	"SELECT * FROM formularios
					WHERE for_muestra='1' AND
					ID_sub='5' AND
					ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		$this->forByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function getSubmodulosByModulos($ID_mod){
		$sql	=	"SELECT * FROM submodulos
					WHERE ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		$this->subByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosBySubmodulos($ID_sub){
		$sql	=	"SELECT * FROM formularios, submodulos
					WHERE formularios.for_muestra='1' AND
					submodulos.sub_muestra='1' AND
					ID_sub='" . $ID_sub . "'";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
}

class prioridades {


	function getPrioridades(){
		$sql	=	"SELECT * FROM prioridades";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}


}

class permisos {
/*
*
* This class will be used to check the users's permission to access to the php files, and give or remove permissions.
*
*/
	function checkPermiso($ID_usu, $for_desc){
		$sql	=	"SELECT * FROM permisos, formularios
					WHERE permisos.ID_for=formularios.ID_for AND
					ID_usu='" . $ID_usu . "' AND
					formularios.for_desc='" . $for_desc . "'";
		$result				=	mysql_query($sql);
		$this->checkPerRows	=	mysql_num_rows($result);
		return $result;
	}
	function getPermisos($ID_emp, $ID_sis, $ID_mod, $ID_usu){
		if($ID_emp){
			$emp	=	"AND empresas.ID_emp='" . $ID_emp . "'";
		} else {
			$emp	=	'';
		}
		if($ID_sis){
			$sis	=	"AND sistemas.ID_sis='" . $ID_sis . "'";
		} else {
			$sis	=	'';
		}
		if($ID_mod){
			$mod	=	"AND modulos.ID_mod='" . $ID_mod . "'";
		} else {
			$mod	=	'';
		}
		if($ID_usu){
			$usu	=	"AND usuarios.ID_usu='" . $ID_usu . "'";
		} else {
			$usu	=	'';
		}
		$sql	=	"SELECT * FROM permisos, formularios, modulos, usuarios, empresas, sistemas
					WHERE permisos.ID_for = formularios.ID_for AND
					permisos.ID_usu = usuarios.ID_usu AND
					formularios.ID_mod = modulos.ID_mod AND
					permisos.ID_emp = empresas.ID_emp AND
					sistemas.ID_sis=modulos.ID_sis
					$emp
					$sis
					$usu
					$mod
					GROUP BY usuarios.usu_username, modulos.mod_desc
					ORDER BY sistemas.sis_desc, modulos.mod_desc, usuarios.usu_username ASC";
		$result			=	mysql_query($sql);
		$this->permRows	=	mysql_num_rows($result);
		return $result;
	}
	function getPermisosByUsuFor($ID_mod, $ID_usu){
		$sql	=	"SELECT * FROM permisos, formularios
					WHERE permisos.ID_for=formularios.ID_for AND
					permisos.ID_usu='" . $ID_usu ."' AND
					formularios.ID_mod='" . $ID_mod . "'";
		$result					=	mysql_query($sql);
		$this->permByUsuForRows	=	mysql_num_rows($result);
		return $result;
	}
	function getModulosByUsu($ID_usu){
		$sql	=	"SELECT * FROM sistemas, modulos, formularios, permisos
					WHERE sistemas.ID_sis=modulos.ID_sis AND
					modulos.ID_mod=formularios.ID_mod AND
					formularios.ID_for=permisos.ID_for AND
					permisos.ID_usu='". $ID_usu . "' AND
					GROUP BY modulos.ID_mod
					ORDER BY modulos.mod_prioridad ASC";
		$result				=	mysql_query($sql);
		$this->modByUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertPermisos($ID_emp, $ID_for, $ID_usu){
		$sqlCheck	=	"SELECT * FROM permisos
						WHERE permisos.ID_emp='" . $ID_emp . "' AND
						permisos.ID_usu='" . $ID_usu . "' AND
						permisos.ID_for='" . $ID_for . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkPermRows	=	mysql_num_rows($resultCheck);
		if($checkPermRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO permisos
						(ID_emp, ID_for, ID_usu)
						VALUES('" . $ID_emp . "','" . $ID_for . "','" . $ID_usu . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function dropPermisos($ID_per){
		$sql	=	"DELETE FROM permisos
					WHERE ID_per='" . $ID_per . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class formularios {
/*
*
* This class is used for query, create, update or delete registries on formularios table
*
*/
	function getFormularios(){
		$sql	=	"SELECT * FROM formularios, modulos, sistemas
					WHERE formularios.ID_mod=modulos.ID_mod AND
					modulos.ID_sis=sistemas.ID_sis
					ORDER BY sistemas.sis_desc, modulos.mod_desc, formularios.for_desc ASC";
		$result			=	mysql_query($sql);
		$this->formRows	=	mysql_num_rows($result);
		return $result;
	}
	function getFormulariosById($ID_for){
		$sql	=	"SELECT * FROM formularios, modulos, submodulos, sistemas
					WHERE formularios.ID_mod=modulos.ID_mod AND
					formularios.ID_sub=submodulos.ID_sub AND
					modulos.ID_sis=sistemas.ID_sis AND
					formularios.ID_for='" . $ID_for . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function getFormulariosByMod($ID_mod){
		$sql	=	"SELECT * FROM formularios
					WHERE formularios.ID_mod='" . $ID_mod . "'";
		$result					=	mysql_query($sql);
		$this->formByModRows	=	mysql_num_rows($result);
		return $result;
	}
	function insertFormularios($ID_mod, $ID_sub, $for_desc, $for_nombre, $for_nom_muestra, $for_muestra){
		$modulos		=	new modulos();
		$getModulosById	=	$modulos->getModulosById($ID_mod);
		$modulosById	=	mysql_fetch_assoc($getModulosById);
		$sqlCheck	=	"SELECT * FROM sistemas, modulos, formularios
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						modulos.ID_mod=formularios.ID_mod AND
						sistemas.ID_sis='" . $modulosById['ID_sis'] . "' AND
						formularios.for_desc='" . $for_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO formularios
						(ID_mod, ID_sub, for_desc, for_nombre, for_nom_muestra, for_muestra)
						VALUES('" . $ID_mod ."','" . $ID_sub ."','" . $for_desc . "','" . $for_nombre . "','" . $for_nom_muestra . "','" . $for_muestra . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function updateFormularios($ID_for, $ID_mod, $ID_sub, $for_desc, $for_nombre, $for_nom_muestra, $for_muestra){
		$modulos		=	new modulos();
		$getModulosById	=	$modulos->getModulosById($ID_mod);
		$modulosById	=	mysql_fetch_assoc($getModulosById);
		$sqlCheck	=	"SELECT * FROM sistemas, modulos, formularios
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						modulos.ID_mod=formularios.ID_mod AND
						sistemas.ID_sis='" . $modulosById['ID_sis'] . "' AND
						formularios.for_desc='" . $for_desc . "' AND
						formularios.ID_for<>'" . $ID_for . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"UPDATE formularios
						SET ID_mod='" . $ID_mod . "',
						ID_sub='" . $ID_sub . "',
						for_desc='" . $for_desc . "',
						for_nombre='" . $for_nombre . "',
						for_nom_muestra='" . $for_nom_muestra . "',
						for_muestra='" . $for_muestra . "'
						WHERE ID_for='" . $ID_for . "'";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function dropFormularios($ID_for){
		$sql	=	"DELETE FROM formularios
					WHERE formularios.ID_for='" . $ID_for . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class modulos {
/*
*
* This class is used for query, create, update or delete registries on modulos table
*
*/
	function getModulos(){
		$sql	=	"SELECT * FROM modulos, sistemas
					WHERE modulos.ID_sis=sistemas.ID_sis
					ORDER BY sistemas.sis_desc, modulos.mod_desc ASC";
		$result			=	mysql_query($sql);
		$this->modRows	=	mysql_num_rows($result);
		return $result;
	}
	function getModulosById($ID_mod){
		$sql	=	"SELECT * FROM modulos, sistemas
					WHERE modulos.ID_sis=sistemas.ID_sis AND
					modulos.ID_mod='" . $ID_mod . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function insertModulos($ID_sis, $mod_desc, $mod_nom_muestra, $mod_prioridad, $mod_muestra){
		$sqlCheck	=	"SELECT * FROM modulos
						WHERE modulos.ID_sis='" . $ID_sis . "' AND
						modulos.mod_desc='" . $mod_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkFormRows	=	mysql_num_rows($resultCheck);
		if($checkFormRows != 0){
			return 0;
		} else {
			$sql	=	"INSERT INTO modulos
						(ID_sis, mod_desc, mod_nom_muestra, mod_prioridad, mod_muestra)
						VALUES('" . $ID_sis . "','" . $mod_desc . "','" . $mod_nom_muestra . "','" . $mod_prioridad . "','" . $mod_muestra . "')";
			$insert	=	mysql_query($sql);
			return 1;
		}
	}
	function updateModulos($ID_sis, $ID_mod, $mod_desc, $mod_nom_muestra, $mod_prioridad, $mod_muestra){
		$sqlCheck	=	"SELECT * FROM sistemas, modulos
						WHERE sistemas.ID_sis=modulos.ID_sis AND
						sistemas.ID_sis='" . $ID_sis . "' AND
						modulos.mod_desc='" . $mod_desc . "' AND
						modulos.ID_mod<>'" . $ID_mod . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkModRows	=	mysql_num_rows($resultCheck);
		if($checkModRows != 0){
			return 0;
		} else {
			$sql	=	"UPDATE modulos
						SET ID_sis='" . $ID_sis . "',
						mod_desc='" . $mod_desc . "',
						mod_nom_muestra='" . $mod_nom_muestra . "',
						mod_prioridad='" . $mod_prioridad . "',
						mod_muestra='" . $mod_muestra . "'
						WHERE ID_mod='" . $ID_mod . "'";
			$update	=	mysql_query($sql);
			return 1;
		}
	}
	function dropModulos($ID_mod){
		$sql	=	"DELETE FROM modulos
					WHERE modulos.ID_mod='" . $ID_mod . "'";
		$result						=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class submodulos {

	function getSubmodulos(){
		$sql	=	"SELECT * FROM submodulos, modulos
					WHERE submodulos.ID_mod=modulos.ID_mod
					ORDER BY modulos.mod_desc, submodulos.sub_desc ASC";
		$result			=	mysql_query($sql);
		$this->subRows	=	mysql_num_rows($result);
		return $result;
	}
}
class sistemas {
/*
*
* 
*
*/
	function getSistemas(){
		$sql	=	"SELECT * FROM sistemas
					ORDER BY sistemas.sis_desc ASC";
		$result			=	mysql_query($sql);
		$this->sisRows	=	mysql_num_rows($result);
		return $result;
	}
	function getSistemasById($ID_sis){
		$sql	=	"SELECT * FROM sistemas
					WHERE
					sistemas.ID_sis='" . $ID_sis . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
}
class empresas {
/*
*
* 
*
*/
	function getEmpresas(){
		$sql	=	"SELECT * FROM empresas
					ORDER BY empresas.emp_nombre ASC";
		$result			=	mysql_query($sql);
		$this->empRows	=	mysql_num_rows($result);
		return $result;
	}
	function getEmpresasById($ID_emp){
		$sql	=	"SELECT * FROM empresas
					WHERE
					empresas.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function getParametrosEmpresa($ID_emp){
		$sql	=	"SELECT * FROM empresas_param
					WHERE empresas_param.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function generaEmpresas(){
		$sql	=	"SELECT * FROM empresas
					ORDER BY empresas.emp_nombre ASC";
		$result				=	mysql_query($sql);
		$this->genEmpRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genEmpRows;$i++){
			$emp	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $emp['ID_emp'] . '">' . $emp['emp_nombre'] . '</option>';
		}
	}
	function validateEmpresaCuitA($emp_cuit){
		$sql	=	"SELECT * FROM empresas
					WHERE empresas.emp_cuit='" . $emp_cuit . "'";
		$result				=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function validateEmpresaCuitM($emp_cuit, $ID_emp){
		$sql	=	"SELECT * FROM empresas
					WHERE empresas.emp_cuit='" . $emp_cuit . "' AND
					empresas.ID_emp<>'" . $ID_emp . "'";
		$result				=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function insertEmpresas($emp_nombre, $emp_cuit, $emp_dir, $emp_contacto, $emp_tel, $emp_mail, $emp_cod, $emp_cantusu, $emp_habilitada){
		$sql	=	"INSERT INTO empresas
					(emp_nombre, emp_cuit, emp_dir, emp_contacto, emp_tel, emp_mail, emp_cod, emp_cantusu, emp_habilitada)
					VALUES('" . $emp_nombre . "','" . $emp_cuit . "','" . $emp_dir . "','" . $emp_contacto . "','" . $emp_tel . "','" . $emp_mail . "','" . $emp_cod . "','" . $emp_cantusu . "','" . $emp_habilitada . "')";
		$insert				=	mysql_query($sql);
		$ID_emp				=	mysql_insert_id();
		$sqlAdd	=	"INSERT INTO empresas_param
					(ID_emp)
					VALUES('" . $ID_emp . "')";
		$insertAdd	=	mysql_query($sqlAdd);
		return mysql_affected_rows();
	}
	function updateEmpresas($ID_emp, $emp_nombre, $emp_cuit, $emp_dir, $emp_contacto, $emp_tel, $emp_mail, $emp_cod, $emp_cantusu, $emp_habilitada){
		$sql	=	"UPDATE empresas
					SET emp_nombre='" . $emp_nombre . "',
					emp_cuit='" . $emp_cuit . "',
					emp_dir='" . $emp_dir . "',
					emp_contacto='" . $emp_contacto . "',
					emp_tel='" . $emp_tel . "',
					emp_mail='" . $emp_mail . "',
					emp_cod='" . $emp_cod . "',
					emp_cantusu='" . $emp_cantusu . "',
					emp_habilitada='" . $emp_habilitada . "'
					WHERE ID_emp='" . $ID_emp . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	function updateParametrosEmpresas($ID_emp, $par_diatope, $par_tesorero){
		$sql	=	"UPDATE empresas_param
					SET par_diatope='" . $par_diatope . "',
					par_tesorero='" . $par_tesorero . "'
					WHERE ID_emp='" . $ID_emp . "'";
			$update	=	mysql_query($sql);
			return mysql_affected_rows();
	}
	function dropEmpresas($ID_emp){
		$sql	=	"DELETE FROM empresas
					WHERE empresas.ID_emp='" . $ID_emp . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class usuarios {
/*
*
* 
*
*/

function generarCodigo($longitud) {
 $key = '';
 $pattern = '1234567890abcdefghijklmnopqrstuvwxyz';
 $max = strlen($pattern)-1;
 for($i=0;$i < $longitud;$i++) $key .= $pattern{mt_rand(0,$max)};
 return $key;
}

	function getUsuarios(){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu
					ORDER BY empresas.emp_nombre, usuarios.usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->usuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getUsuariosById($ID_usu){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_tpu=tipo_usuarios.ID_tpu AND
					usuarios.ID_usu='" . $ID_usu . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function getUsuariosByEmail($usu_email, $ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas, tipo_usuarios WHERE usuarios.ID_emp=empresas.ID_emp AND usuarios.ID_tpu=tipo_usuarios.ID_tpu AND usuarios.usu_email='$usu_email' AND empresas.emp_cod='$ID_emp'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function getUsuariosByEmpresa($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.ID_emp='" . $ID_emp . "'
					ORDER BY usuarios.usu_apellido ASC";
		$result				=	mysql_query($sql);
		$this->usuByEmpRows	=	mysql_num_rows($result);
		return $result;
	}
	function generaUsuGer($ID_emp){
		$sql	=	"SELECT * FROM usuarios
					WHERE usuarios.ID_emp='" . $ID_emp . "'
					ORDER BY usuarios.usu_apellido ASC";
		$result				=	mysql_query($sql);
		$this->UsuGerRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->UsuGerRows;$i++){
			$usu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $usu['ID_usu'] . '">' . $usu['usu_apellido'] . ' ' . $usu['usu_nombre'] . '</option>';
		}
	}		
	function validateUsuario($usu_username, $ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE usuarios.ID_emp=empresas.ID_emp AND
					usuarios.usu_username='" . $usu_username . "' AND
					usuarios.ID_emp='" . $ID_emp . "'";
		$result		=	mysql_query($sql);
		$this->validateRows	=	mysql_num_rows($result);
		if($this->validateRows > 0){
			return 1;
		} else {
			return 0;
		}
	}
	function insertUsuario($ID_emp, $usu_username, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger, $cambia_clave, $usu_habilitado, $usu_obr){
		$sql	=	"INSERT INTO usuarios
					(ID_emp, usu_username, usu_password, usu_nombre, usu_apellido, usu_legajo, usu_cco, usu_telefono, usu_email, usu_tarjeta, ID_tpu, ID_usu_ger, usu_clave, usu_habilitado, usu_obr)
					VALUES('". $ID_emp . "','". $usu_username . "','" . $usu_password . "','" . $usu_nombre . "','" . $usu_apellido . "','" . $usu_legajo . "','" . $usu_cco . "','" . $usu_telefono . "','" . $usu_email . "','" . $usu_tarjeta . "','" . $ID_tpu . "','" . $ID_usu_ger . "','" . $cambia_clave . "','" . $usu_habilitado . "','" . $usu_obr . "')";
		$insert		=	mysql_query($sql);
		return mysql_affected_rows();
	}
	function updateUsuario($ID_usu, $usu_password, $usu_nombre, $usu_apellido, $usu_legajo, $usu_cco, $usu_telefono, $usu_email, $usu_tarjeta, $ID_tpu, $ID_usu_ger, $cambia_clave, $usu_habilitado, $usu_obr){
		$sql	=	"UPDATE usuarios
					SET usu_password='" . $usu_password ."',
					usu_nombre ='" . $usu_nombre . "',
					usu_apellido='" . $usu_apellido ."',
					usu_legajo='" . $usu_legajo ."',
					usu_telefono='" . $usu_telefono ."',
					usu_email='" . $usu_email . "',
					usu_tarjeta='" . $usu_tarjeta . "',
					ID_tpu='" . $ID_tpu . "',
					ID_usu_ger='" . $ID_usu_ger . "',
					usu_clave='" . $cambia_clave . "',
					usu_cco='" . $usu_cco . "',
					usu_habilitado='" . $usu_habilitado . "',
					usu_obr='" . $usu_obr . "'
					WHERE ID_usu='" . $ID_usu . "'";
			$update	=	mysql_query($sql);
			if(mysql_affected_rows() > 0){
				return 1;
			} else {
				return 0;
			}
	}
	function updateUsuarioRecuperaClave($ID_usu, $usu_password, $usu_clave){
		$sql	=	"UPDATE usuarios
					SET usu_password	=	'" . $usu_password ."',
					usu_clave 			=	'" . $usu_clave ."'
					WHERE ID_usu 		=	'" . $ID_usu . "'";
			$update	=	mysql_query($sql);
			if(mysql_affected_rows() > 0){
				return 1;
			} else {
				return 0;
			}
			
			
	}
	function dropUsuario($ID_usu){
		$sql	=	"DELETE FROM usuarios
					WHERE usuarios.ID_usu='" . $ID_usu . "'";
		$result	=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class tipoUsuarios {
/*
*
* 
*
*/
	function getTipoUsuarios(){
		$sql	=	"SELECT * FROM tipo_usuarios
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTipoUsuariosById($ID_tpu){
		$sql	=	"SELECT * FROM tipo_usuarios
					WHERE tipo_usuarios.ID_tpu='" . $ID_tpu . "'";
		$result	=	mysql_query($sql);
		return $result;
	}
	function generaTipoUsuarios(){
		$sql	=	"SELECT * FROM tipo_usuarios
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->tipoUsuRows;$i++){
			$tpu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tpu['ID_tpu'] . '">' . $tpu['tpu_desc'] . '</option>';
		}
	}
	function generaTipoUsuariosEmp($ID_empUsu){
		$sql	=	"SELECT * FROM tipo_usuarios WHERE
					tipo_usuarios.ID_emp='" . $ID_empUsu . "'
					ORDER BY tipo_usuarios.tpu_desc ASC";
		$result				=	mysql_query($sql);
		$this->tipoUsuRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->tipoUsuRows;$i++){
			$tpu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tpu['ID_tpu'] . '">' . $tpu['tpu_desc'] . '</option>';
		}
	}
	function insertTipoUsuarios($ID_emp, $tpu_cod, $tpu_desc){
		$sqlCheck	=	"SELECT * FROM tipo_usuarios
						WHERE tipo_usuarios.ID_emp='" . $ID_emp . "' AND
						tipo_usuarios.tpu_desc='" . $tpu_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkTpuRows	=	mysql_num_rows($resultCheck);
		if($checkTpuRows != 0){
			$sql	=	"INSERT INTO tipo_usuarios
						(ID_emp,tpu_cod,tpu_desc)
						VALUES('" . $ID_emp . "','" . $tpu_cod . "','" . $tpu_desc . "')";
			return 1;
		} else {
			return 0;
		}
	}
}
class monedas {
/*
*
* 
*
*/
	function insertMonedas($ID_emp, $ID_tmo, $mon_desc, $mon_cotizacion){
		$sql	=	"INSERT INTO monedas
					(ID_emp, ID_tmo, mon_desc, mon_cotizacion, mon_habilitado)
					VALUES('" . $ID_emp . "','" . $ID_tmo . "','" . $mon_desc  ."','" . $mon_cotizacion  ."','1')";
		$insert	=	mysql_query($sql);
		return mysql_affected_rows();
	}
}
class lugares {
/*
*
* 
*
*/
	function insertLugares($ID_emp, $lug_cod, $lug_desc, $ID_tmo, $lug_default){
		$sqlCheck	=	"SELECT * FROM lugares
						WHERE lugares.ID_emp='" . $ID_emp . "' AND
						lugares.lug_desc='" . $lug_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkLugRows	=	mysql_num_rows($resultCheck);
		if($checkLugRows != 0){
			$sql	=	"INSERT INTO lugares
						(ID_emp, lug_cod, lug_desc, ID_tmo, lug_default)
						VALUES('" . $ID_emp . "','" . $lug_cod . "','" . $lug_desc  ."','" . $ID_tmo  ."','" . $lug_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
}
class clientes {

	function getClienteById($ID_cli, $ID_emp){
		$sql	=	"SELECT * FROM clientes 
						WHERE ID_cli=$ID_cli AND
						ID_emp=$ID_emp";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}
	function getUltimoCliente(){
		$sql	=	"SELECT * FROM clientes ORDER BY ID_cli DESC LIMIT 1";
		$result				=	mysql_query($sql);
		$this->forBySubRows	=	mysql_num_rows($result);
		return $result;
	}

	function insertCliente($ID_emp, $cli_desc, $cli_clienteCostan, $cli_obs){
			$sql	=	"INSERT INTO clientes
						(ID_emp, cli_desc, cli_clienteCostan, cli_obs)
						VALUES('" . $ID_emp  ."','" . $cli_desc  ."','" . $cli_clienteCostan  ."','" . $cli_obs  ."')";
			$insert	=	mysql_query($sql);
			return 1;
	}
	function insertClientes($ID_emp, $cli_desc){
			$sql	=	"INSERT INTO clientes
						(ID_emp, cli_desc)
						VALUES('" . $ID_emp  ."','" . $cli_desc  ."')";
			$insert	=	mysql_query($sql);
			return 1;
	}
	function generaClientes($ID_emp){
		$sql	=	"SELECT * FROM clientes, empresas
					WHERE empresas.ID_emp='" . $ID_emp . "' AND
					clientes.ID_emp=empresas.ID_emp
					ORDER BY clientes.cli_desc ASC";
		$result				=	mysql_query($sql);
		$this->genCliRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->genCliRows;$i++){
			$cli	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cli['ID_cli'] . '">' . $cli['cli_desc'] . '</option>';
		}
	}
}
class tiendas {

	function insertTiendas($ID_emp, 
	  $ID_cli,
	  $ID_emp,
	  $ID_prv,
	  $ID_ciu,
	  $obr_dir,
	  $obr_nproyecto,
	  $obr_ov,
	  $obr_np,
	  $obr_ndestinatario,
	  $obr_fecmad,
	  $obr_npto,
	  $obr_contacto,
	  $obr_tel,
	  $obr_mail,
	  $obr_nsucursal,
	  $obr_desc,
	  $obr_pto,
	  $ID_zon,
	  $obr_exhibARG,
	  $obr_exhibEUR,
	  $obr_evaporadores,
	  $obr_camaras,
	  $obr_condensadores,
	  $obr_frioSTD,
	  $obr_frioESP,
	  $obr_materialesObra,
	  $obr_ingenieria,
	  $obr_manoDeObra,
	  $obr_flete,
	  $obr_fecinfrio,
	  $obr_fecfinfrio,
	  $obr_cantfrio,
	  $obr_contfrio,
	  $obr_mofrio,
	  $obr_fecinexhib,
	  $obr_fecfinexhib,
	  $obr_cantexhib,
	  $obr_contexhib,
	  $obr_moexhib,
	  $obr_fecincamaras,
	  $obr_fecfincamaras,
	  $obr_cantcamaras,
	  $obr_contcamaras,
	  $obr_mocamaras,
	  $obr_supervisor,
	  $obr_obs,
	  $obr_fecin,
	  $obr_fecinreal,
	  $obr_fecfin,
	  $obr_fecfinreal,
	  $obr_default,
	  $obr_coordenadas,
	  $obr_pais,
	  $obr_provincia,
	  $obr_ciudad,
	  $obr_codigoPostal,
	  $obr_codigoPais,
	  $obr_URL,
	  $obr_abonado)

		{
		
			$sql	=	"INSERT INTO obras 
						(ID_emp, 
						ID_cli, 
						ID_prv, 
						ID_ciu, 
						obr_dir, 
						obr_nproyecto, 
						obr_ov, 
						obr_np, 
						obr_ndestinatario, 
						obr_fecmad, 
						obr_npto, 
						obr_contacto, 
						obr_tel, 
						obr_mail, 
						obr_nsucursal, 
						obr_desc, 
						obr_pto, 
						ID_zon, 
						obr_exhibARG,
						obr_exhibEUR,
						obr_evaporadores,
						obr_camaras,
						obr_condensadores,
						obr_frioSTD,
						obr_frioESP,
						obr_materialesObra,
						obr_ingenieria,
						obr_manoDeObra,
						obr_flete,
						obr_fecinfrio, 
						obr_fecfinfrio,
						obr_cantfrio, 
						obr_contfrio, 
						obr_mofrio, 
						obr_fecinexhib, 
						obr_fecfinexhib, 
						obr_cantexhib, 
						obr_contexhib, 
						obr_moexhib, 
						obr_fecincamaras,
						obr_fecfincamaras,  
						obr_cantcamaras, 
						obr_contcamaras, 
						obr_mocamaras, 
						obr_supervisor, 
						obr_obs, 
						obr_fecin, 
						obr_fecfin, 
						obr_fecinreal, 
						obr_fecfinreal, 
						obr_default, 
						obr_coordenadas,
						obr_pais,
						obr_provincia,
						obr_ciudad,	
						obr_codigoPostal,
						obr_codigoPais,
						obr_URL,
						obr_abonado




						)

						VALUES('" . $ID_emp . "',
						'" . $ID_cli . "',
						'" . $ID_prv . "',
						'" . $ID_ciu . "',
						'" . $obr_dir . "',
						'" . $obr_nproyecto . "',
						'" . $obr_ov . "',
						'" . $obr_np . "',
						'" . $obr_ndestinatario . "',
						'" . $obr_fecmad . "',
						'" . $obr_npto . "',
						'" . $obr_contacto . "',
						'" . $obr_tel . "',
						'" . $obr_mail . "',
						'" . $obr_nsucursal . "',
						'" . $obr_desc . "',
						'" . $obr_pto . "',
						'" . $ID_zon . "',
						'" . $obr_exhibARG . "',
						'" . $obr_exhibEUR . "',
						'" . $obr_evaporadores . "',
						'" . $obr_camaras . "',
						'" . $obr_condensadores . "',
						'" . $obr_frioSTD . "',
						'" . $obr_frioESP . "',
						'" . $obr_materialesObra . "',
						'" . $obr_ingenieria . "',
						'" . $obr_manoDeObra . "',
						'" . $obr_flete . "',
						'" . $obr_fecinfrio . "',
						'" . $obr_fecfinfrio . "',
						'" . $obr_cantfrio . "',
						'" . $obr_contfrio . "',
						'" . $obr_mofrio . "',
						'" . $obr_fecinexhib . "',
						'" . $obr_fecfinexhib . "',
						'" . $obr_cantexhib . "',
						'" . $obr_contexhib . "',
						'" . $obr_moexhib . "',
						'" . $obr_fecincamaras . "',
						'" . $obr_fecfincamaras . "',
						'" . $obr_cantcamaras . "',
						'" . $obr_contcamaras . "',
						'" . $obr_mocamaras . "',
						'" . $obr_supervisor . "',
						'" . $obr_obs . "',
						'" . $obr_fecin . "',
						'" . $obr_fecfin . "',
						'" . $obr_fecinreal . "',
						'" . $obr_fecfinreal . "',
						'" . $obr_default . "',
						'" . $obr_coordenadas . "',
						'" . $obr_pais. "',
						'" . $obr_provincia. "',
						'" . $obr_ciudad. "',	
						'" . $obr_codigoPostal. "',
						'" . $obr_codigoPais. "',
						'" . $obr_URL . "',
						'" . $obr_abonado . "')";
			$insert	=	mysql_query($sql);
			
	}

	function getTiendas($ID_emp){
		$sql	=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon AND
					obras.ID_prv=provincias.ID_prv AND
					obras.ID_ciu=ciudades.ID_ciu AND
					obras.ID_emp='" . $ID_emp . "'
					ORDER BY obras.obr_desc ASC";
		$result			=	mysql_query($sql);
		$this->tieRows	=	mysql_num_rows($result);
		return $result;
	}


		function nuevogetTiendas(){
		$sql = "SELECT * FROM obras, clientes, zonas, provincias, ciudades
          WHERE obras.ID_cli=clientes.ID_cli AND
          obras.ID_zon=zonas.ID_zon AND
          obras.ID_prv=provincias.ID_prv AND
          obras.ID_ciu=ciudades.ID_ciu
          ORDER BY obras.obr_desc ASC";
    $result     = mysql_query($sql); 
		$this->tieRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasMap($ID_emp){
		$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker
            		FROM obras, clientes, empresas
		            WHERE obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    empresas.ID_emp= " . $ID_emp . "";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasById($ID_obr){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE ID_obr='" . $ID_obr . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
	function getTiendasByCli($ID_cli){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_cli='" . $ID_cli . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

		function getTiendasByZon($ID_zon){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_zon='" . $ID_zon . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function filterTiendas($ID_obr, $ID_cli, $ID_zon, $obr_coordenadas, $obr_abonado)
		{
			if($ID_obr)
			{	
				$obr	=	"AND obras.ID_obr='" . $ID_obr . "'";
			} 
			else
			{
				$obr	=	'';
			}
			if($ID_cli)
			{
				$cli	=	"AND obras.ID_cli='" . $ID_cli . "'";
			} 
			else 
			{
				$cli	=	'';
			}
			if($ID_zon)
			{
				$zon	=	"AND obras.ID_zon='" . $ID_zon . "'";
			} 
			else 
			{
				$zon	=	'';
			}
			if($obr_coordenadas=='on')
			{
				$cor	=	"AND obras.obr_coordenadas is NULL";
			} 
			else 
			{
				$cor	=	'';
			}
			if($obr_abonado=='on')
			{
				$abo	=	"AND obras.obr_abonado='1'";
			} 
			else 
			{
				$abo	=	'';
			}
		

		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon 
					$obr
					$cli
					$zon
					$cor
					$abo
					ORDER BY clientes.cli_desc DESC
					";

		$result			=	mysql_query($sql);
		$this->permRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasPorZonas($ID_zon){
		$sql	=	"SELECT * FROM obras, clientes, zonas
		 			WHERE zonas.ID_zon='" . $ID_zon . "' AND
					obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zo 	nas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
	function GetTiendasMapById($ID_obr){
		$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker 
		FROM obras, clientes, empresas 
		WHERE obras.ID_obr='".$ID_obr."' AND 
		obras.ID_cli=clientes.ID_cli AND
		 obras.obr_coordenadas<>'' AND 
		 obras.ID_emp=empresas.ID_emp";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasMapByCli($ID_cli){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker
            		FROM obras, clientes, empresas
		            WHERE clientes.ID_cli='" . $ID_cli . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}
		function getTiendasMapByZon($ID_zon){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker
            		FROM obras, clientes, empresas, zonas
		            WHERE zonas.ID_zon='" . $ID_zon . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

	function getTiendasMapByAbonado($obr_abonado){
	
$sql	=	"SELECT concat(cli_desc,' - ',obr_desc) AS Tienda, obr_coordenadas AS Coordenadas, ID_obr AS id, cli_marker AS marker
            		FROM obras, clientes, empresas, zonas
		            WHERE obras.obr_abonado='" . $obr_abonado . "' AND 
		            obras.ID_cli=clientes.ID_cli AND
        		    obras.obr_coordenadas<>'' AND 
        		    obras.ID_emp=empresas.ID_emp AND 
        		    obras.ID_zon=zonas.ID_zon";
		$result				=	mysql_query($sql);
		$this->tieMapRows	=	mysql_num_rows($result);
		return $result;
	}

	function generaTiendas($ID_emp){
		$sql	=	"SELECT * FROM obras, clientes, zonas, provincias, ciudades
		 			WHERE obras.ID_cli=clientes.ID_cli AND
					obras.ID_zon=zonas.ID_zon AND
					obras.ID_prv=provincias.ID_prv AND
					obras.ID_ciu=ciudades.ID_ciu AND
					obras.ID_emp='" . $ID_emp . "'
					ORDER BY obras.obr_desc ASC";
		$result				=	mysql_query($sql);
		$this->tiendasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->teindasRows;$i++){
			$tie	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $tie['ID_obr'] . '">' . $tie['cli_desc'] . ' - ' . $tie['obr_desc'] . '</option>';
		}
	}		

	function updateTienda(
						$ID_obr,
						$ID_cli, 
						$obr_dir, 
						$obr_nproyecto, 
						$obr_ov, 
						$obr_np, 
						$obr_ndestinatario, 
						$obr_fecmad, 
						$obr_npto, 
						$obr_contacto, 
						$obr_tel, 
						$obr_mail, 
						$obr_nsucursal, 
						$obr_desc, 
						$obr_pto, 
						$ID_zon, 
						$obr_exhibARG,
						$obr_exhibEUR,
						$obr_evaporadores,
						$obr_camaras,
						$obr_condensadores,
						$obr_frioSTD,
						$obr_frioESP,
						$obr_materialesObra,
						$obr_ingenieria,
						$obr_manoDeObra,
						$obr_flete,
						$obr_fecinfrio, 
						$obr_fecfinfrio,
						$obr_cantfrio, 
						$obr_contfrio, 
						$obr_mofrio, 
						$obr_fecinexhib, 
						$obr_fecfinexhib, 
						$obr_cantexhib, 
						$obr_contexhib, 
						$obr_moexhib, 
						$obr_fecincamaras,
						$obr_fecfincamaras,  
						$obr_cantcamaras, 
						$obr_contcamaras, 
						$obr_mocamaras, 
						$obr_supervisor, 
						$obr_obs, 
						$obr_fecin, 
						$obr_fecfin, 
						$obr_fecinreal, 
						$obr_fecfinreal, 
						$obr_coordenadas,
						$obr_pais,
						$obr_provincia,
						$obr_ciudad,	
						$obr_codigoPostal,
						$obr_codigoPais,
						$obr_URL,
						$obr_abonado){


	
		$sql	=	"UPDATE obras 
					SET 
					ID_cli				=	'" . $ID_cli . "',
					obr_dir				=	'" . $obr_dir . "',
					obr_nproyecto		=	'" . $obr_nproyecto . "',
					obr_ov				=	'" . $obr_ov . "',
					obr_np				=	'" . $obr_np . "',
					obr_ndestinatario	=	'" . $obr_ndestinatario . "',
					obr_fecmad			=	'" . $obr_fecmad . "',
					obr_npto 			=	'" . $obr_npto . "',
					obr_contacto		=	'" . $obr_contacto . "',
					obr_tel				=	'" . $obr_tel . "',
					obr_mail 			=	'" . $obr_mail . "',
					obr_nsucursal		=	'" . $obr_nsucursal . "',
					obr_desc 			=	'" . $obr_desc . "',
					obr_pto				=	'" . $obr_pto . "',
					ID_zon				=	'" . $ID_zon . "',
					obr_exhibARG		=	'" . $obr_exhibARG . "',
					obr_exhibEUR		=	'" . $obr_exhibEUR . "',
					obr_evaporadores	=	'" . $obr_evaporadores . "',
					obr_camaras			=	'" . $obr_camaras . "',
					obr_condensadores	=	'" . $obr_condensadores . "',
					obr_frioSTD			=	'" . $obr_frioSTD . "',
					obr_frioESP			=	'" . $obr_frioESP . "',
					obr_materialesObra	=	'" . $obr_materialesObra . "',
					obr_ingenieria		=	'" . $obr_ingenieria . "',
					obr_manoDeObra		=	'" . $obr_manoDeObra . "',
					obr_flete			=	'" . $obr_flete . "',
					obr_fecinfrio		=	'" . $obr_fecinfrio . "',
					obr_fecfinfrio		=	'" . $obr_fecfinfrio . "',
					obr_cantfrio		=	'" . $obr_cantfrio . "',
					obr_contfrio		=	'" . $obr_contfrio . "',
					obr_mofrio			=	'" . $obr_mofrio . "',
					obr_fecinexhib		=	'" . $obr_fecinexhib . "',
					obr_fecfinexhib		=	'" . $obr_fecfinexhib . "',
					obr_cantexhib		=	'" . $obr_cantexhib . "',
					obr_contexhib		=	'" . $obr_contexhib . "',
					obr_moexhib			=	'" . $obr_moexhib . "',
					obr_fecincamaras	=	'" . $obr_fecincamaras . "',
					obr_fecfincamaras	=	'" . $obr_fecfincamaras . "',
					obr_cantcamaras		=	'" . $obr_cantcamaras . "',
					obr_contcamaras		=	'" . $obr_contcamaras . "',
					obr_mocamaras		=	'" . $obr_mocamaras . "',
					obr_supervisor 		=	'" . $obr_supervisor . "',
					obr_obs 			=	'" . $obr_obs . "',
					obr_fecin			=	'" . $obr_fecin . "',
					obr_fecfin			=	'" . $obr_fecfin . "',
					obr_fecinreal 		=	'" . $obr_fecinreal . "',
					obr_fecfinreal		=	'" . $obr_fecfinreal . "',
					obr_coordenadas		=	'" . $obr_coordenadas . "',
					obr_pais			=	'" . $obr_pais. "',
					obr_provincia		=	'" . $obr_provincia. "',
					obr_ciudad			=	'" . $obr_ciudad. "',	
					obr_codigoPostal	=	'" . $obr_codigoPostal. "',
					obr_codigoPais		=	'" . $obr_codigoPais. "',
					obr_URL 			=	'" . $obr_URL . "',
					obr_abonado 		=	'" . $obr_abonado . "'
					WHERE ID_obr 		= 	'" . $ID_obr . "'";



				$update	=	mysql_query($sql);
				if(mysql_affected_rows() > 0){
					return 1;
				} else {
					return 0;
				}
	}
	function dropTienda($ID_obr)

	{

		$sql1	=	"SELECT * FROM registro_servicio
					 WHERE ID_obr=".$ID_obr."";
		$result1	=	mysql_query($sql1);
		$result11 	=	mysql_fetch_row($result1);
	
			$sql2="SELECT * FROM gastos 
					WHERE ID_obr=".$ID_obr."";
		$result2	=	mysql_query($sql2);	
		$result22 	=	mysql_fetch_row($result2);
			
			$sql3="SELECT * FROM gastos_tarjeta
					 WHERE ID_obr=".$ID_obr."";
		$result3	=	mysql_query($sql3);
		$result33 	=	mysql_fetch_row($result3);
			

		if	(!$result11)
		{
				if(!$result22)
				{
					if(!$result33)
					{
								$sql4	=	"DELETE FROM obras
											WHERE ID_obr='" . $ID_obr . "'";
							$result4	=	mysql_query($sql4);
							
							return 0;
							
					}
					else
					{
						return 3;
					}	
				}
				else
				{
					return 2;
				}	
			}
			else
			{
				return 1;
			}
			
			
		}
	
}
class zonas {
/*
*
* 
*
*/
	function insertZonas($ID_emp, $zon_desc, $zon_default){
		$sqlCheck	=	"SELECT * FROM zonas
						WHERE zonas.ID_emp='" . $ID_emp . "' AND
						zonas.zon_desc='" . $zon_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkZonRows	=	mysql_num_rows($resultCheck);
		if($checkZonRows != 0){
			$sql	=	"INSERT INTO zonas
						(ID_emp, zon_desc, zon_default)
						VALUES('" . $ID_emp  ."','" . $zon_desc  ."','" . $zon_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_emp='" . $ID_emp . "'
					ORDER BY zonas.zon_desc ASC";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
	function nuevaGetZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
					ORDER BY zonas.zon_desc ASC";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
		function nuevaGetZonasSinRepetir($ID_zon){
		$sql	=	"SELECT * FROM zonas 
				    WHERE ID_zon='".$ID_zon."'";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
			function nuevasGetZonasSinRepetir($ID_zon){
		$sql	=	"SELECT * FROM zonas 
		             WHERE ID_zon!='".$ID_zon."'";
		$result			=	mysql_query($sql);
		$this->zonRows	=	mysql_num_rows($result);
		return $result;
	}
	function getZonasById($ID_zon){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_zon='" . $ID_zon . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaZonas($ID_emp){
		$sql	=	"SELECT * FROM zonas
		 			WHERE zonas.ID_emp='" . $ID_emp . "'
					ORDER BY zonas.zon_desc ASC";
		$result				=	mysql_query($sql);
		$this->zonasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->zonasRows;$i++){
			$zon	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $zon['ID_zon'] . '">' . $zon['zon_desc'] . '</option>';
		}
	}		
}
class provincias {
/*
*
* 
*
*/
	function insertProvincias($prv_desc){
		$sqlCheck	=	"SELECT * FROM provincias
						WHERE provincias.prv_desc='" . $prv_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkPrvRows	=	mysql_num_rows($resultCheck);
		if($checkPrvRows != 0){
			$sql	=	"INSERT INTO provincias
						(prv_desc)
						VALUES('" . $prv_desc  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getProvincias(){
		$sql	=	"SELECT * FROM provincias
					ORDER BY provincias.prv_desc ASC";
		$result			=	mysql_query($sql);
		$this->prvRows	=	mysql_num_rows($result);
		return $result;
	}
	function getProvinciasById($ID_prv){
		$sql	=	"SELECT * FROM provincias
		 			WHERE provincias.ID_prv='" . $ID_prv . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaProvincias(){
		$sql	=	"SELECT * FROM provincias
					ORDER BY provincias.prv_desc ASC";
		$result					=	mysql_query($sql);
		$this->provinciasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->provinciasRows;$i++){
			$prv	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $prv['ID_prv'] . '">' . $prv['prv_desc'] . '</option>';
		}
	}		
}
class ciudades {
/*
*
* 
*
*/
	function insertCiudades($ciu_desc){
		$sqlCheck	=	"SELECT * FROM ciudades
						WHERE ciudades.ciu_desc='" . $ciu_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkCiuRows	=	mysql_num_rows($resultCheck);
		if($checkCiuRows != 0){
			$sql	=	"INSERT INTO ciudades
						(ciu_desc)
						VALUES('" . $ciu_desc  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
	function getCiudades(){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
					ORDER BY ciudades.ciu_desc ASC";
		$result			=	mysql_query($sql);
		$this->ciuRows	=	mysql_num_rows($result);
		return $result;
	}
	function getCiudadesById($ID_ciu){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
		 			WHERE ciudades.ID_ciu='" . $ID_ciu . "'";
		$result				=	mysql_query($sql);
		return $result;
	}
	function generaCiudades(){
		$sql	=	"SELECT * FROM ciudades, provincias
					WHERE ciudades.ID_prv=provincias.ID_prv
					ORDER BY ciudades.ciu_desc ASC";
		$result					=	mysql_query($sql);
		$this->ciudadesRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->ciudadesRows;$i++){
			$ciu	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $ciu['ID_ciu'] . '" class="' . $ciu['ID_prv'] . '">' . $ciu['ciu_desc'] . '</option>';
		}
	}		
}

class tipoGastos {
/*
*
* 
*
*/
	function insertTipoGastos($ID_emp, $tip_cuenta, $tip_desc, $tip_default){
		$sqlCheck	=	"SELECT * FROM tipo_gastos
						WHERE tipo_gastos.ID_emp='" . $ID_emp . "' AND
						tipo_gastos.top_desc='" . $tip_desc . "'";
		$resultCheck	=	mysql_query($sqlCheck);
		$checkCliRows	=	mysql_num_rows($resultCheck);
		if($checkCliRows != 0){
			$sql	=	"INSERT INTO 	
						(ID_emp, zon_desc, zon_default)
						VALUES('" . $ID_emp  ."','" . $zon_desc  ."','" . $zon_default  ."')";
			$insert	=	mysql_query($sql);
			return 1;
		} else {
			return 0;
		}
	}
}
class contratistas {
/*
*
* 
*
*/

	function getContratistas($ID_emp){
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE ID_tpu='22' AND
						empresas.ID_emp='" . $ID_emp . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }
	 
	 function getContratistasById($ID_cont){
		$sql		=	"SELECT * FROM usuarios
						WHERE usuarios.ID_usu='" . $ID_cont . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }

	function generaContratistas($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE ID_tpu='22' AND
					empresas.ID_emp='" . $ID_emp . "'
					ORDER BY usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->contratistasRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->contratistasRows;$i++){
			$cont	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
		}
	}		

}
class supervisores {
/*
*
* 
*
*/

	function getSupervisores($ID_emp){
		$sql		=	"SELECT * FROM usuarios, empresas
						WHERE ID_tpu='5' AND
						empresas.ID_emp='" . $ID_emp . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }
	 
	  function getSupervisoresById($ID_sup){
		$sql		=	"SELECT * FROM usuarios
						WHERE usuarios.ID_usu='" . $ID_sup . "'
						ORDER BY usu_apellido ASC";
		$result			=	mysql_query($sql);
		$this->contRows	=	mysql_num_rows($result);
		return $result;
	 }

	function generaSupervisores($ID_emp){
		$sql	=	"SELECT * FROM usuarios, empresas
					WHERE ID_tpu='5' AND
					empresas.ID_emp='" . $ID_emp . "'
					ORDER BY usu_apellido ASC";
		$result					=	mysql_query($sql);
		$this->supervisoresRows	=	mysql_num_rows($result);
		for($i=0;$i<$this->supervisoresRows;$i++){
			$cont	=	mysql_fetch_assoc($result);
			echo	'<option value="' . $cont['ID_usu'] . '">' . $cont['usu_apellido'] . ' ' . $cont['usu_nombre'] . '</option>';
		}
	}		

}

?>