<?php
include_once("conexion.php");
include_once("Log.class.php");
include_once("seguridad.class.php");
class Usuario
{
	//atributos privados de la clase
	private $IdUsuario;
	private $Nombre;
	private $Correo;
	private $FechaNacimiento;
	private $UserName;
	private $Pass;
	private $CoeficienteDesinfoxicacion;
	private $IdPerfil;
	private $cn;
	private $log;
	private $seguridad;
	//constructor de la clase
	public function Usuario()
	{
		$this->cn = new datos();
		$this->log = new Log();
		$this->seguridad = new Seguridad();
	}
	//INICIO
	/* geter y seter de la clase los cuales permiten un acceso seguro y un encapsulamiento rijido a cada uno de los 
	atributos de la clase */
	public function getIdUsuario() 
	{
		return $this->IdUsuario;
	}
	public function setIdUsuario($IdUsuario)
	{
		$this->IdUsuario = $IdUsuario;
	}
	public function getNombre() 
	{
		return $this->Nombre;
	}
	public function setNombre($Nombre)
	{
		$this->Nombre = $Nombre;
	}
	public function getCorreo() 
	{
		return $this->Correo;
	}
	public function setCorreo($Correo)
	{
		$this->Correo = $Correo;
	}
	public function getFechaNacimiento() 
	{
		return $this->FechaNacimiento;
	}
	public function setFechaNacimiento($FechaNacimiento)
	{
		$this->FechaNacimiento = $FechaNacimiento;
	}
	public function getUserName() 
	{
		return $this->UserName;
	}
	public function setUserName($UserName)
	{
		$this->UserName = $UserName;
	}
	public function getPass() 
	{
		return $this->Pass;
	}
	public function setPass($Pass)
	{
		$this->Pass = $Pass;
	}
	public function getCoeficienteDesinfoxicacion() 
	{
		return $this->CoeficienteDesinfoxicacion;
	}
	public function setCoeficienteDesinfoxicacion($CoeficienteDesinfoxicacion)
	{
		$this->CoeficienteDesinfoxicacion = $CoeficienteDesinfoxicacion;
	}
	public function getIdPerfil() 
	{
		return $this->IdPerfil;
	}
	public function setIdPerfil($IdPerfil)
	{
		$this->IdPerfil = $IdPerfil;
	}
	//fin
	//metodo encargado de registrar un nuevo login en la base de datos
	public function Nuevo()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer inserciones en la base de datos
			if(!$this->cn->leer("call SPUsuarioGet('','".$this->seguridad->Encrypt(usuario::getUserName())."')"))
			{
				if($this->cn->ejecutar("call SPUsuarioNew('".usuario::getNombre()."','".$this->seguridad->Encrypt(usuario::getCorreo())."','".usuario::getFechaNacimiento()."','".$this->seguridad->Encrypt(usuario::getUserName())."','".$this->seguridad->Encrypt(usuario::getPass())."','".usuario::getCoeficienteDesinfoxicacion()."','".usuario::getIdPerfil()."')"))
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
			$this->log->write('Error en la clase Usuario metodo nuevo '.$e->getMessage());
		}
	}
	//metodo encargado de editar un login existente en la base de datos
	public function Editar()
	{
		try
		{
			if(!$this->cn->leer("call SPUsuarioGet('','".$this->seguridad->Encrypt(usuario::getUserName())."')"))
			{
				//por medio del objeto de la clase datos llamamos el metodo encargado de hacer modificaciones en la base de datos
				if($this->cn->ejecutar("call SPUsuarioUpdate('".usuario::getIdUsuario()."','".usuario::getNombre()."','".$this->seguridad->Encrypt(usuario::getCorreo())."','".usuario::getFechaNacimiento()."','".usuario::getIdPerfil()."')"))
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
			$this->log->write('Error en la clase Login metodo editar '.$e->getMessage());
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
			$this->log->write('Error en la clase Login eliminar iniciar '.$e->getMessage());
		}
	}
	//metodo encargado de retornar todos los login existentes en la base de datos que coinsidan con un parametro de busqueda
	public function Buscar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer consultas en la base de datos
			return $this->cn->consultar("call sp_buscar_usuario(".Login::getIdUsuario().")");
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Login metodo buscar '.$e->getMessage());
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
			$this->log->write('Error en la clase Login metodo siguiente '.$e->getMessage());
		}
	}
}
?>