<?php

class VerifyProcess {

    protected function getInt($update, $index) : int {
        $value = !isset($update['message'][$index]) ?
                        0 : intval($update['message'][$index]);
        return $value;
    }

    protected function getString($update, $index) : ?string {
        $value = !isset($update['message'][$index]) ?
                        null : trim($update['message'][$index]);
        return $value;
    }

    public function process($MadelineProto, $selfId, $update)
    {
        $update_type  = $update['_'];
        $update_id    = $update['pts'];
        $update_type  = $update['_'];
        $update_id    = $update['pts'];
        $userID       = $this->getInt($update, 'from_id');
        $msgID        = $this->getInt($update, 'id');
        $msg          = $this->getString($update, 'message');
        $replyToMsgID = $this->getInt($update, 'reply_to_msg_id');
        $chatInfo     = yield $this->get_info($update);
        $chatID       = intval($chatInfo['bot_api_id']);
        $chatType     = $chatInfo['type'];
        $chatInfo     = null;

        echo 'Hi!';

        $res = json_encode($update, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|
                            JSON_UNESCAPED_SLASHES);

        yield $MadelineProto->echo('chatID: '.$chatID .' '.$update_type.' '.$update_id.PHP_EOL);
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
    }
}
