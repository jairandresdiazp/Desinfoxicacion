<?php
include_once("conexion.php");
include_once("Log.class.php");
include_once("seguridad.class.php");
class Perfil
{
	//atributos privados de la clase
	private $IdPerfil;
	private $NombrePerfil;
	private $cn;
	private $log;
	//constructor de la clase
	public function Perfil()
	{
		$this->cn = new datos();
		$this->log = new Log();
	}
	//INICIO
	/* geter y seter de la clase los cuales permiten un acceso seguro y un encapsulamiento rijido a cada uno de los 
	atributos de la clase */
	public function getIdPerfil() 
	{
		return $this->IdPerfil;
	}
	public function setIdPerfil($IdPerfil)
	{
		$this->IdPerfil = $IdPerfil;
	}
	public function getNombrePerfil() 
	{
		return $this->NombrePerfil;
	}
	public function setNombrePerfil($NombrePerfil)
	{
		$this->NombrePerfil = $NombrePerfil;
	}
	//fin
	//metodo encargado de registrar un nuevo login en la base de datos
	public function Nuevo()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer inserciones en la base de datos
			if(!$this->cn->leer("call SPUsuarioGet('','".hash('sha256',usuario::getUserName())."')"))
			{
				if($this->cn->ejecutar("call SPUsuarioNew('".usuario::getNombre()."','".usuario::getCorreo()."','".usuario::getFechaNacimiento()."','".hash('sha256',usuario::getUserName())."','".hash('sha256',usuario::getPass())."','".usuario::getCoeficienteDesinfoxicacion()."','".usuario::getIdPerfil()."')"))
				{
					return true;
				}
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Perfil metodo nuevo '.$e->getMessage());
		}
	}
	//metodo encargado de editar un login existente en la base de datos
	public function Editar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer modificaciones en la base de datos
			if($this->cn->modificar("call sp_consultar_usuario('".Login::getIdUSuario()."')","call sp_editar_usuario(".Login::getIdUSuario().",'".Login::getDescripcionUsuario()."','".Login::getClaveUsuario()."','".Login::getCelularUsuario()."','".Login::getCiudadUsuario()."','".Login::getDireccionUsuario()."','".Login::getCorreoUsuario()."','".Login::getEstadoUsuario()."')"))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Perfil metodo editar '.$e->getMessage());
		}
	}
	//metodo encargado de eliminar un login existente en la base de datos
	public function Eliminar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer modificaciones en la base de datos
			if($this->cn->modificar("call sp_consultar_usuario('".Login::getIdUSuario()."')","call sp_eliminar_usuario('".Login::getIdUSuario()."')"))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Perfil eliminar iniciar '.$e->getMessage());
		}
	}
	//metodo encargado de retornar todos los login existentes en la base de datos que coinsidan con un parametro de busqueda
	public function Buscar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer consultas en la base de datos
			return $this->cn->consultar("call SPPerfilGet()");
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Perfil metodo buscar '.$e->getMessage());
		}
	}
	//metodo encargado de mostrar el sigiente registro de un conjunto de datos
	public function Siguiente($result)
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer un salto al sigiente registro de un conjunto de datos
			return $this->cn->resultados($result);
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Perfil metodo siguiente '.$e->getMessage());
		}
	}
}
?>