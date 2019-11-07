<?php //declare(strict_types=1);
/* Previous deprecated version create by @BegoBem (Channel @NashenastTalk) */

date_default_timezone_set('Asia/Tehran');
ini_set('memory_limit', '2048M');
error_reporting(E_ALL);                              // always TRUE
ini_set('ignore_repeated_errors', '1');              // always TRUE
ini_set('display_errors',         '1');              // FALSE only in production or real server
ini_set('log_errors',             '1');              // Error logging engine
ini_set('error_log',              'php_errors.log'); // Logging file path
if (file_exists('php_errors.log')) {unlink('php_errors.log');}

if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', '');
require_once 'madeline.php';

if (!file_exists('config.php')) {
    $config = '<?php' . PHP_EOL .
    '$GLOBALS["SELF_ID"]   = 157887279;' . PHP_EOL .
    '$GLOBALS["TEST_MODE"] = TRUE;' . PHP_EOL .
    '$GLOBALS["API_ID"]    = 6;' . PHP_EOL .
    '$GLOBALS["API_HASH"]  = "eb06d4abfb49dc3eeb1aeb98ae0f581e";' . PHP_EOL .
    PHP_EOL;
    var_export($config);
    file_put_contents('config.php', $config);
}
require_once 'config.php';

require_once 'handler.php';

function closeConnection($message = '✅ Bot is Running ... ')
{
    if (php_sapi_name() !== 'cli' && !isset($GLOBALS['exited'])) {
        @ob_end_clean();
        header('Connection: close');
        ignore_user_abort(true);
        ob_start();
        echo "$message";
        $size = ob_get_length();
        header("Content-Length: $size");
        header('Content-Type: text/html');
        ob_end_flush();
        flush();
    }
    $GLOBALS['exited'] = true;
}

if (!file_exists('bot.lock')) {
    touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');


class EventHandler extends \danog\MadelineProto\EventHandler
{
    private $selfId;
    private $plugins;

    public function __construct($MadelineProto)
    {
        parent::__construct($MadelineProto);
        $this->selfId = intval($GLOBALS['SELF_ID']);
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
        yield $this->plugins->process($this, $this->selfId, $update);
    }
}


$try = 1;
$locked = false;
while (!$locked) {
    $locked = flock($lock, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();
        if ($try++ >= 30) {
            \danog\MadelineProto\Logger::log('Another copy of the script is executing. Exited');
            exit;
        }
        sleep(1);
    }
}

\danog\MadelineProto\Shutdown::addCallback(static function () use ($lock) {
    if (php_sapi_name() !== 'cli') {
        $p = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls://' : 'tcp://');
        $a = fsockopen($p . $_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']
        );
        fwrite($a,
            $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".
            'Host: '. $_SERVER['SERVER_NAME']."\r\n".
            "\r\n");
    }
    flock($lock, LOCK_UN);
    fclose($lock);
    closeConnection('✅ Bot is Shutdown!');
});

closeConnection('✅ Bot Is Running ...');

if (file_exists('MadelineProto.log')) {unlink('MadelineProto.log');}
$settings['logger']['logger_level'] = \danog\MadelineProto\Logger::FATAL_ERROR;
$settings['logger']['logger']       = \danog\MadelineProto\Logger::FILE_LOGGER;
//$settings['connection_settings']['all']['test_mode'] = $GLOBALS['TEST_MODE'];
$settings['app_info']['api_id']   = $GLOBALS['API_ID'];
$settings['app_info']['api_hash'] = $GLOBALS['API_HASH'];

$MadelineProto = new \danog\MadelineProto\API('session.madeline', $settings);
$MadelineProto->async(true);

$MadelineProto->loop(function () use ($MadelineProto) {
    yield $MadelineProto->start();
    yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
