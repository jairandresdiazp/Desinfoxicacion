<?php 
class log 
{
	private $path = '/logs/';
	public function __construct() 
	{
		date_default_timezone_set('America/Bogota');	
		$this->path  = $_SERVER['DOCUMENT_ROOT']  . $this->path;	
	}

	public function write($message) 
	{
		$date = new DateTime();
		$log = $this->path . $date->format('Y-m-d').".log";
		if(is_dir($this->path)) 
		{
			if(!file_exists($log)) 
			{
				$fh  = fopen($log, 'a+') or die("Fatal Error !");
				$logcontent = "Time : " . $date->
				format('H:i:s').": " . $message ."\r\n";
				fwrite($fh, $logcontent);
				fclose($fh);
			}
			else 
			{
				$this->edit($log,$date, $message);
			}
		}
		else 
		{
			if(mkdir($this->path,0777) === true) 
			{
			$this->write($message);  
			}			
		}
	}

	private function edit($log,$date,$message) 
	{
		$logcontent = "Time : " . $date->format('H:i:s').": " . $message ."\r\n";
		$logcontent = $logcontent . file_get_contents($log);
		file_put_contents($log, $logcontent);
	}
}
?>
