<?php

include 'plugins/verifyplugin.php';
include 'plugins/pingplugin.php';

class Plugins {

    private $verifyPlugin;
    private   $pingPlugin;

    public function __construct()
    {
        $this->verifyPlugin = new VerifyPlugin();
        $this->  pingPlugin = new PingPlugin();
    }

    public function process($MadelineProto, $selfId, $update)
    {
        $processed = $this->verifyPlugin->process($MadelineProto, $selfId, $update);
        $processed = $this->  pingPlugin->process($MadelineProto, $selfId, $update);

        /*

        //public function process1 ($MadelineProto, $selfId, $update, $args) {
        //    $this->test($MadelineProto, $update, $args->chatID, $args->userID, $args->msgID, $args->msg);
        //}

        // $chatID, $userID, $msgID, $msg
        $update_type  = $update['_'];
        $update_id    = $update['pts'];
        echo 'Hi!';

        $res = json_encode($update, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|
                            JSON_UNESCAPED_SLASHES);

        yield $MadelineProto->echo('chatID:   '.$chatID .' '.$update_type.' '.$update_id.PHP_EOL);
        yield $MadelineProto->logger('chatID: '.$chatID .' '.$update_type.' '.$update_id);

        if ($userID === 0 &&
            isset($update['message']['to_id']['_']) &&
                $update['message']['to_id']['_'] !== 'peerChannel') {
            yield $MadelineProto->logger('Missing from_id. '.$update_type.' update_id: '.$update_id);
            yield $MadelineProto->logger($res.PHP_EOL);
        }

        if ($msg === null) {
            yield $MadelineProto->logger('Missing message text. update_id: ' . $update_id);
            yield $MadelineProto->logger($res.PHP_EOL);
        }

        if ($msgID === 0) {
            yield $MadelineProto->logger('Missing message_id. update_id: ' . $update_id);
            yield $MadelineProto->logger($res.PHP_EOL);
        }
        */
    }

}