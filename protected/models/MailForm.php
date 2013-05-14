<?php
class MailForm extends CFormModel {

    //public $from;
    public $to;
    public $subject;
    public $body;

    public function rules() {
        return array(
            array('to, subject, body', 'required'),
            array('from, to, subject, body ','safe'),
        );
    }

    public function attributeLabels() {
        return array(
            //'from' => '送信人',
            'to' => '收信人',
            'subject' => '标题',
            'body' => '邮件内容',
        );
    }
}

?>

