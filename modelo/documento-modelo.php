<?php
include_once("conexion.php");
include_once("Log.class.php");
include_once("seguridad.class.php");
class Documento
{
	//atributos privados de la clase
	private $IdDocumento;
	private $NombreDocumento;
	private $Autores;
	private $PalabrasClave;
	private $URL;
	private $Ruta;
	private $AnoPublicacion;
	private $IdTipoDocumento;
	private $IdUsuario;
	private $cn;
	private $log;
	//constructor de la clase
	public function Documento()
	{
		$this->cn = new datos();
		$this->log = new Log();
	}
	//INICIO
	/* geter y seter de la clase los cuales permiten un acceso seguro y un encapsulamiento rijido a cada uno de los 
	atributos de la clase */
	public function getIdDocumento() 
	{
		return $this->IdDocumento;
	}
	public function setIdDocumento($IdDocumento)
	{
		$this->IdDocumento = $IdDocumento;
	}
	public function getNombreDocumento() 
	{
		return $this->NombreDocumento;
	}
	public function setNombreDocumento($NombreDocumento)
	{
		$this->NombreDocumento = $NombreDocumento;
	}
	public function getAutores() 
	{
		return $this->Autores;
	}
	public function setAutores($Autores)
	{
		$this->Autores = $Autores;
	}
	public function getPalabrasClave() 
	{
		return $this->PalabrasClave;
	}
	public function setPalabrasClave($PalabrasClave)
	{
		$this->PalabrasClave = $PalabrasClave;
	}
	public function getURL() 
	{
		return $this->URL;
	}
	public function setURL($URL)
	{
		$this->URL = $URL;
	}
	public function getRuta() 
	{
		return $this->Ruta;
	}
	public function setRuta($Ruta)
	{
		$this->Ruta = $Ruta;
	}
	public function getAnoPublicacion() 
	{
		return $this->AnoPublicacion;
	}
	public function setAnoPublicacion($AnoPublicacion)
	{
		$this->AnoPublicacion = $AnoPublicacion;
	}
	public function getIdTipoDocumento() 
	{
		return $this->IdTipoDocumento;
	}
	public function setIdTipoDocumento($IdTipoDocumento)
	{
		$this->IdTipoDocumento = $IdTipoDocumento;
	}
	public function getIdUsuario() 
	{
		return $this->IdUsuario;
	}
	public function setIdUsuario($IdUsuario)
	{
		$this->IdUsuario = $IdUsuario;
	}
	//fin
	//metodo encargado de registrar un nuevo documento en la base de datos
	public function Nuevo()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer inserciones en la base de datos
			if($this->cn->ejecutar("call SPDocumentoNew('".Documento::getNombreDocumento()."','".Documento::getAutores()."','".Documento::getPalabrasClave()."','".Documento::getURL()."','".Documento::getRuta()."','".Documento::getAnoPublicacion()."','".Documento::getIdTipoDocumento()."','".Documento::getIdUsuario()."')"))
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
			$this->log->write('Error en la clase Documento metodo nuevo '.$e->getMessage());
		}
	}
	//metodo encargado de editar un documento existente en la base de datos
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
	//metodo encargado de eliminar un documento existente en la base de datos
	public function Eliminar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer modificaciones en la base de datos
			if($this->cn->ejecutar("call SPDocumentoDelete('".Documento::getIdDocumento()."')"))
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
			$this->log->write('Error en la clase Documento metodo Eliminar '.$e->getMessage());
		}
	}
	//metodo encargado de retornar todos los documentos existentes en la base de datos que coinsidan con un parametro de busqueda
	public function Buscar()
	{
		try
		{
			//por medio del objeto de la clase datos llamamos el metodo encargado de hacer consultas en la base de datos
			return $this->cn->consultar("call SPDocumentoGet ('".Documento::getIdUsuario()."', '".Documento::getNombreDocumento()."', '".Documento::getPalabrasClave()."', '".Documento::getAutores()."', '".Documento::getAnoPublicacion()."', '".Documento::getIdTipoDocumento()."')");
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Documento metodo buscar '.$e->getMessage());
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