<?php
include_once("conexion.php");
include_once("Log.class.php");
include_once("seguridad.class.php");
include_once("../../lib/swift_required.php");
class SendMail
{
    private $cn;
    private $log;
    private $seguridad;
    //constructor de la clase
    public function SendMail()
    {
        $this->cn  = new datos(false);
        $this->log = new Log();
        $this->seguridad = new Seguridad();
    }
    public function Send($body, $subject, $to, $cc="")
    {
        $UserName   = "";
        $Pass       = "";
        $SendTo     = "";
        $SendToName = "";
        $Bcc         = "";
        $SMTP       = "";
        $Port       = "";
        $Conf       = $this->cn->consultar("call SPCommonEmailGet()");
        while ($row = $this->cn->resultados($Conf)) {
            $UserName   = $this->seguridad->Decrypt($row['UserName']);
            $Pass       = $this->seguridad->Decrypt($row['Pass']);
            $SendTo     = $this->seguridad->Decrypt($row['SendTo']);
            $SendToName = $this->seguridad->Decrypt($row['SendToName']);
            if($row['Bcc']!="")
            {
                $Bcc = $this->seguridad->Decrypt($row['Bcc']);
            }
            else
            {
                $Bcc="";
            }
            $SMTP       = $this->seguridad->Decrypt($row['SMTP']);
            $Port       = $this->seguridad->Decrypt($row['Port']);
        }
        // Create the SMTP configuration
        $transport = Swift_SmtpTransport::newInstance($SMTP, $Port);
        $transport->setUsername($UserName);
        $transport->setPassword($Pass);
        
        // Create the message
        $message = Swift_Message::newInstance();
        $to      = explode(";", $to);
        $message->setTo($to);
        if ($Bcc != "") {
            $message->setBcc(array(
                $Bcc
            ));
        }
        if ($cc != "") {
            $message->setCc(explode(";", $cc));
        }
        $message->setSubject($subject);
        $message->setContentType("text/html");
        $message->setBody($body);
        $message->setFrom($SendTo, $SendToName);
        
        // Send the email
        $mailer = Swift_Mailer::newInstance($transport);
        $mailer->send($message, $failedRecipients);
        
        // Show failed recipients
        return $failedRecipients;
    }
}
?>