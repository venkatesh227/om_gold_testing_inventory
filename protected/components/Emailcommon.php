<?php 
class Emailcommon extends CApplicationComponent
{
    public function mailTemplate($template,$params){
        $templateDetails = EmailTemplate::model()->find("vcName='".$template."' and iStatus='1'");
        $mailContent = $templateDetails->vcContent;
        foreach($params as $key=>$value){
            $mailContent = str_replace("{{".$key."}}",$value,$mailContent);
        }

        return (object) array('subject'=>$templateDetails->vcSubject,'body'=>$mailContent);
    }

    public function sendMail($to,$subject,$message,$attachment=''){
        $smtpConfig = Yii::app()->params['SMTP_CONFIG'];
        if($smtpConfig['sendEmail'])
        {
            $mail = new YiiMailer();
            $mail->setSmtp(
                $smtpConfig['server'], //Server Details
                $smtpConfig['port'],  // Port
                $smtpConfig['type'], // Type SSL/TLS
                $smtpConfig['isType'], //SSL or TLS True or false
                $smtpConfig['userName'], // user name
                $smtpConfig['password'] // password
            );
            if($smtpConfig['isLayout']==false)
            {
                $mail->clearLayout();//if layout is already set in config
            }
            $mail->setFrom($smtpConfig['userName'], Yii::app()->name);
            $mail->setTo($to);
            $mail->setSubject($subject);
            $mail->setBody($message);
            if($attachment)
            {
                $mail->setAttachment($attachment);
            }
         
            $mail->send();
            if ($mail->send()) {
             echo "success";exit(0);  // Yii::app()->user->setFlash('test_mail','Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                
                //echo $mail->getError();exit(0);
                //Yii::app()->user->setFlash('error','Error while sending email: '.$mail->getError());
                echo "<pre>";
                print_r($mail->getError());
                exit;
            }
        }
    }
}
?>