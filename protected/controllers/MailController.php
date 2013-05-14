<?php

class MailController extends Controller {

    public function actionIndex() {
        
        $model = new MailForm();
        
        if (isset($_POST["MailForm"])){
            $model->attributes=$_POST['MailForm'];
            
            if($model->validate()) {   
                $message = new YiiMailMessage();
                
                $message->setFrom(array('ctbioscience@163.com'));
                $message->setTo(array($model->to => '收信人'));
                $message->setSubject($model->subject);
                $message->setBody($model->body);

                $sendmail = Yii::app()->mail->send($message) ;
                
                if ($sendmail) {
                    Yii::app()->user->setFlash("success", "Emails sent: OK \n" );
                    $this->refresh();
                } else {
                    Yii::app()->user->setFlash("failed", "Emails sent: NG \n");
                }
      }
        }
        
        $this->render('index', 
                array(
                    'model' => $model, 
                ));
    }
}

