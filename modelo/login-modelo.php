<?php
include_once("conexion.php");
include_once("Log.class.php");
include_once("seguridad.class.php");
class Login
{
	//atributos privados de la clase
	private $IdLogin;
	private $UserName;
	private $DisplayName;
	private $FechaNacimiento;
	private $Correo;
	private $Clave;
	private $Perfil;
	private $cn;
	private $log;
	private $seguridad;
	//constructor de la clase
	public function Login()
	{
		$this->cn = new datos();
		$this->log = new Log();
		$this->seguridad = new Seguridad();
	}
	//INICIO
	/* geter y seter de la clase los cuales permiten un acceso seguro y un encapsulamiento rijido a cada uno de los 
	atributos de la clase */
	public function getIdLogin() 
	{
		return $this->IdLogin;
	}
	public function setIdlogin($IdLogin)
	{
		$this->IdLogin = $IdLogin;
	}
	public function getUserName() 
	{
		return $this->UserName;
	}
	public function setUserName($UserName)
	{
		$this->UserName = $UserName;
	}
	public function getClave() 
	{
		return $this->Clave;
	}
	public function setClave($Clave)
	{
		$this->Clave = $Clave;
	}
	public function getPerfil() 
	{
		return $this->Perfil;
	}
	public function setPerfil($Perfil)
	{
		$this->Perfil = $Perfil;
	}
	public function getDisplayName() 
	{
		return $this->DisplayName;
	}
	public function setDisplayName($DisplayName)
	{
		$this->DisplayName = $DisplayName;
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
	//fin
	//metodo encargado verificar las credenciales de un login
	public function Iniciar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de verificar si existe o no un registro en la base de datos
			if($this->cn->leer("call SPUsuarioIniciarSesion('".$this->seguridad->Encrypt(Login::getUserName())."','".$this->seguridad->Encrypt(Login::getClave())."')")==true)
			{
				$this->cn->cerrar();
				$Usuario=$this->cn->consultar("call SPUsuarioIniciarSesion('".$this->seguridad->Encrypt(Login::getUserName())."','".$this->seguridad->Encrypt(Login::getClave())."')");
				while($row=$this->cn->resultados($Usuario))
				{
					$this->IdLogin = $row['IdUsuario'];
					$this->UserName = $row['UserName'];
					$this->DisplayName = $row['Nombre'];
					$this->Correo = $row['Correo'];
					$this->Perfil = $row['IdPerfil'];
					$this->FechaNacimiento = $row['FechaNacimiento'];
				}
				return true;
			}
			else
			{
				return false;
			}

		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Login metodo iniciar '.$e->getMessage());
		}
	}
	//metodo encargado de retornar todos los login existentes en la base de datos que coinsidan con un parametro de busqueda
	public function Buscar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer consultas en la base de datos
			return $this->cn->consultar("call SPUsuarioGet('','".$this->seguridad->Encrypt(Login::getUserName())."')");
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Login metodo buscar '.$e->getMessage());
		}
	}
	//metodo encargado de editar un login existente en la base de datos
	public function Editar()
	{
		try
		{
			if($this->cn->leer("call SPUsuarioGet('','".$this->seguridad->Encrypt(Login::getUserName())."')"))
			{
				//por medio del objeto de la clase datos llamamos el metodo encargado de hacer modificaciones en la base de datos
				if($this->cn->ejecutar("call SPUsuarioLoginUpdate('".Login::getIdLogin()."','".$this->seguridad->Encrypt(Login::getClave())."')"))
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