<?php declare(strict_types=1);

class EventHandler extends \danog\MadelineProto\EventHandler
{
    private $MadelineProto;
    private $USER_ID;

    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
        $this->MadelineProto = $MadelineProto;
        $this->USER_ID       = intval($GLOBALS['SELF_ID']);
    }

    public function onUpdateEditChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewChannelMessage($update)
    {
        yield $this->onUpdateNewMessage($update);
    }

    public function onUpdateNewMessage($update)
    {
        $res = json_encode($update, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|
                                    JSON_UNESCAPED_SLASHES);
        $update_type = $update['_'];
        $update_id   = $update['pts'];

        yield $this->echo($update_type.' '.$update_id.PHP_EOL);

        $userID = intval(!isset($update['message']['from_id']) ?
                            0 : $update['message']['from_id']);
        if($userID === 0 &&
            isset($update['message']['to_id']['_']) &&
                  $update['message']['to_id']['_'] !== 'peerChannel')
        {
            yield $this->logger('Missing from_id. update_id: ' . $update_id);
            yield $this->echo  ('Missing from_id. ' . $update_type .
                                ' update_id: ' . $update_id . PHP_EOL);
            yield $this->echo($res.PHP_EOL);
        }

        $msg = !isset($update['message']['message']) ?
                        null : trim($update['message']['message']);
        if ($msg === null) {
            yield $this->logger('Missing message text. update_id: ' . $update_id);
        }

        $msgID = !isset($update['message']['id']) ? 0 : intval($update['message']['id']);
        if ($msgID === 0) {
            yield $this->logger('Missing message_id. update_id: ' . $update_id);
        }

        $replyToMsgId = !isset($update['message']['reply_to_msg_id']) ?
                        0 : intval($update['message']['reply_to_msg_id']);

        $chatInfo = yield $this->get_info($update);
        $chatID   = intval($chatInfo['bot_api_id']);
        $chatType = $chatInfo['type'];
        $val      = json_encode($chatInfo, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|
                                           JSON_UNESCAPED_SLASHES);
        yield $this->logger($val, \danog\MadelineProto\Logger::FATAL_ERROR);

        //$chatInfo = $MadelineProto->get_info($update['update']);
        //$chatType = $chatInfo['type'];
        //$chatID   = $chatInfo['bot_api_id'];
        //$userID   = $update['update']['message']['from_id'];
        //$msg      = $update['update']['message']['message'];
        //$msg_id   = $update['update']['message']['id'];

        require 'plugin.php';
    }
}


/*
while (true) {
    $updates = $MadelineProto->get_updates(['offset' => $offset, 'limit' => 50, 'timeout' => 0]);
    \danog\MadelineProto\Logger::log($updates);
    foreach ($updates as $update) {
        $offset = $update['update_id'] + 1;
        $up     = $update['update']['_'];
        if ($up == 'updateNewMessage'        ||
            $up == 'updateNewChannelMessage' ||
            $up == 'updateEditChannelMessage')
        {
            $chatInfo = $MadelineProto->get_info($update['update']);
            $chatType = $chatID['type'];
            $chatID = $chatID['bot_api_id'];
            $userID = $update['update']['message']['from_id'];
            $msg    = $update['update']['message']['message'];
            $msg_id = $update['update']['message']['id'];
            try {
                require 'plugin.php';
            }
            catch (Exception                                    $e) { }
            catch (\danog\MadelineProto\RPCErrorException       $e) { }
            catch (\danog\MadelineProto\Exception               $e) { }
            catch (\danog\MadelineProto\TL\Conversion\Exception $e) { }
        }
    }
}
*/