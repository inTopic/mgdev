<?php

class Sendpulse_Integration_IndexController extends Mage_Core_Controller_Front_Action
{
    public $API_USER_ID = '6db3b0a98394f0c9218d204f69415edf';
    public $API_SECRET = '571bf02fcd780bff4bc848e1c2806b78';
    public $PATH_TO_ATTACH_FILE = '/Applications/MAMP/htdocs/test.local/app/code/local/Sendpulse/Integration/src/';

    public function indexAction()
    {
        echo 'welcome to sendpulse integration test page';
        $SPApiClient = Mage::getModel('sendpulseintegration/client', $this->API_USER_ID, $this->API_SECRET);

// Get Mailing Lists list example
        var_dump($SPApiClient->listAddressBooks());

// Send mail using SMTP
        $email = array(
            'html' => '<p>Hello!</p>',
            'text' => 'text',
            'subject' => 'Mail subject',
            'from' => array(
                'name' => 'Ruslan',
                'email' => 'voronov.inc@gmail.com',
            ),
            'to' => array(
                array(
                    'name' => 'Client',
                    'email' => 'ruslanmyata@gmail.com',
                ),
            ),
//            'bcc' => array(
//                array(
//                    'name' => 'Manager',
//                    'email' => 'manager@domain.com',
//                ),
//            ),
            'attachments' => array(
                'file.txt' => file_get_contents($this->PATH_TO_ATTACH_FILE),
            ),
        );
        var_dump($SPApiClient->smtpSendMail($email));


        /*
         * Example: create new push
         */
//
//        $task = array(
//            'title' => 'Hello!',
//            'body' => 'This is my first push message',
//            'website_id' => 1,
//            'ttl' => 20,
//            'stretch_time' => 10,
//        );
// This is optional
//        $additionalParams = array(
//            'link' => 'http://yoursite.com',
//            'filter_browsers' => 'Chrome,Safari',
//            'filter_lang' => 'en',
//            'filter' => '{"variable_name":"some","operator":"or","conditions":[{"condition":"likewith","value":"a"},{"condition":"notequal","value":"b"}]}',
//        );
//        var_dump($SPApiClient->createPushTask($task, $additionalParams));

    }
}