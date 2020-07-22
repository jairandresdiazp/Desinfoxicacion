<?php
include_once("seguridad.class.php");
class datos
{	
	//atributos privados de cla clase los cuales son soloa acesesibles po metodos
	private $controlador;
	private $coneccion;
	private $servidor;
	private $usuario;
	private $password;
	private $base_datos;
	private $puerto;
	private $log;
	private $LogData;
	private $seguridad;
	//constructor de la clase
	function datos()
	{
		try
		{
			$this->log = new Log();
			$this->seguridad = new Seguridad();
			$configuracion = parse_ini_file('config.ini', true);
			$configuraciongeneral = parse_ini_file('/../config.ini', true);
			if($configuraciongeneral["general"]["Azure"]==false){
				$this->controlador = $this->seguridad->Decrypt($configuracion["conexion"]["driver"]);
				$this->servidor=$this->seguridad->Decrypt($configuracion["conexion"]["host"]);
				$this->usuario=$this->seguridad->Decrypt($configuracion["conexion"]["username"]);
				$this->password=$this->seguridad->Decrypt($configuracion["conexion"]["password"]);
				$this->base_datos=$this->seguridad->Decrypt($configuracion["conexion"]["database"]);
				$this->puerto = $this->seguridad->Decrypt($configuracion["conexion"]["port"]);
				$this->LogData = $configuracion["conexion"]["log"];
			}
			else{
				$this->controlador = $this->seguridad->Decrypt($configuracion["conexionAzure"]["driver"]);
				$this->servidor=$this->seguridad->Decrypt($configuracion["conexionAzure"]["host"]);
				$this->usuario=$this->seguridad->Decrypt($configuracion["conexionAzure"]["username"]);
				$this->password=$this->seguridad->Decrypt($configuracion["conexionAzure"]["password"]);
				$this->base_datos=$this->seguridad->Decrypt($configuracion["conexionAzure"]["database"]);
				$this->puerto = $this->seguridad->Decrypt($configuracion["conexionAzure"]["port"]);
				$this->LogData = $configuracion["conexionAzure"]["log"];
			}
			$this->coneccion=new PDO ("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->base_datos",$this->usuario,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
			$this->coneccion->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo Datos '.$e->getMessage());
		}
	}
	//metodo encargado de establecer la conexion con el conjunto de datos
	private function conectado()
	{
		try
		{
			if($this->coneccion) 
			{
				return true;
			} 
			else
			{
				$this->coneccion=new PDO ("$this->controlador:host=$this->servidor;port=$this->puerto;dbname=$this->base_datos",$this->usuario,$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND=> "SET NAMES utf8"));
  				return true;
            }  
		}
		catch(PDOPDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo conectado '.$e->getMessage());
			return false;
		}
	}
	//metodo encargado de ejecutar inyecciones de codigo transac 
	public function ejecutar($sql)
	{
		try
		{
			if($this->conectado()==true)
			{
				if($this->LogData==True)
				{
					$this->log->write($sql);
				}
				$result=$this->coneccion->query($sql);
				if ($result) 
				{
					return true;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		catch(PDOPDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo ejecutar '.$e->getMessage());
			return false;
		}
	}
	//metodo encargado de retornar un conjunto de datos basados en una inyeccion de codigo transac
	public function consultar($sql)
	{
		try
		{
			if($this->conectado()==true)
			{
				if($this->LogData==True)
				{
					$this->log->write($sql);
				}
				$result=$this->coneccion->query($sql);
				return $result;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo consultar '.$e->getMessage());
		}
	}
	//metodo encargado determinar si existe un conjunto de datos basados en una inyeccion de codigo transac
	public function leer ($sql)
	{
		try
		{
			if($this->conectado()==true)
			{
				if($this->LogData==True)
				{
					$this->log->write($sql);
				}
				$result=$this->coneccion->query($sql);
				if($result)
				{
					$row=$result->fetchColumn();
					if($row>0)
					{
						return true;
					}
					else
					{
						return false;
					}
				}
				return false;
			}
			else
			{
				return false;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo leer '.$e->getMessage());
			return false;
		}
	}
	//metodo encargado de asociar un conjunto de datos a un array el cual podra ser recorrido
	//individualmente con una estructura ciclica
	public function resultados($result)
	{
		try
		{
			if($this->conectado()==true)
			{
				if($result!=NULL)
				{
					$this->array=$result->fetch();
					return $this->array;
				}
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo resultados '.$e->getMessage());
		}
	}
	//metodo encargado de cerrar la conexion con el conjunto de datos 
	public function cerrar()
	{
		try
		{
			if($this->coneccion)
			{
				$this->coneccion=null;
			}
		}
		catch(PDOException $e)
		{
			$this->log->write('Error en la clase Datos metodo cerrar '.$e->getMessage());
		}
	}
}
?>