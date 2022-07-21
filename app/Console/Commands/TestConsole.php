<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestConsole extends Command
{

    protected $signature = 'command:name';
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        define( 'API_ACCESS_KEY', 'YOUR SERVICE KEY');
        $registrationIds = array( $_GET['id'] );
        include "inc/func.php";

        $msg = array(
            'message'   => 'Hello world!',
            'title'     => 'Hi!',
            'vibrate'   => 1,
            'sound'     => 1,
            'largeIcon' => 'large_icon',
            'smallIcon' => 'small_icon');
        $fields = array
        (
            'to'  => '/topics/system',
            'data'  => $msg
        );
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields) );
        $result = curl_exec($ch );
        curl_close( $ch );
    }
}
