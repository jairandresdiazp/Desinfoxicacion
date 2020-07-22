<?php
class Seguridad
{
    private $key;
    public function Seguridad()
	{
		$this->key="mwXmcZdYOg6ZwMLOlS6dW5AHnZ0xSe4QbhSl+yD7G8";
	}
    public function Encrypt($data)
    {
    $encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($this->key), $data, MCRYPT_MODE_CBC, md5(md5($this->key))));
    return $encrypted;
    }
    
    public function Decrypt($data)
    {
     $decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($this->key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($this->key))), "\0");
    return $decrypted;
    }
}
?>