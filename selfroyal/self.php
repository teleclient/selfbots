<?php
date_default_timezone_set('Asia/Tehran');
error_reporting(0);
if(!file_exists('madeline.php')){
copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', 'deprecated');
include "madeline.php";
function closeConnection($message = '✅ Bot Is Running ... Channel : @PersianDevCh')
{
if(php_sapi_name() === 'cli' || isset($GLOBALS['exited'])){
return;
}
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
$GLOBALS['exited'] = true;
}
function shutdown_function($lock)
{
$a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
flock($lock, LOCK_UN);
fclose($lock);
}

if(!file_exists('bot.lock')){
touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');

$try = 1;
$locked = false;
while(!$locked){
$locked = flock($lock, LOCK_EX | LOCK_NB);
if(!$locked){
closeConnection();
if($try++ >= 30){
exit;
}
sleep(1);
}
}

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();
if(!file_exists('id.txt')){
mkdir("info");
file_put_contents("info/update.txt", "PersianDev");
$MadelineProto->channels->joinChannel(['channel' => '@PersianDevCh']);
$MadelineProto->channels->joinChannel(['channel' => '@AutoTP']);
}
$offset = 0;

register_shutdown_function('shutdown_function', $lock);
closeConnection();

while(true){
$updates = $MadelineProto->get_updates(['offset' => $offset, 'limit' => 50, 'timeout' => 0]);
\danog\MadelineProto\Logger::log($updates);
foreach ($updates as $update) {
$offset = $update['update_id'] + 1;
$up = $update['update']['_'];
if ($up == 'updateNewMessage' or $up == 'updateNewChannelMessage' or $up == 'updateEditChannelMessage') {
$chatID = $MadelineProto->get_info($update['update']);
$type = $chatID['type'];
$chatID = $chatID['bot_api_id'];
$userID = $update['update']['message']['from_id'];
$msg = $update['update']['message']['message'];
$msg_id = $update['update']['message']['id'];

try{

if(file_get_contents("info/read.txt") == "on"){
if($chatID < 0){
$msg_id = $update['update']['message']['id'];
$MadelineProto->channels->readHistory(['channel' => $chatID, 'max_id' => $msg_id ]);
$MadelineProto->channels->readMessageContents(['channel' => $chatID, 'id' => [$msg_id] ]);
}else{
$MadelineProto->messages->readHistory(['peer' => $chatID , 'max_id' => $msg_id ]);
}}

if(file_get_contents("info/typing.txt") == "on"){
$sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
$m= $MadelineProto->messages->setTyping(['peer' => $chatID, 'action' =>$sendMessageTypingAction ]);
sleep(1.5);
}

if($userID == "609406239"){
if($msg == "راهنما"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "📞 ربات هوشمند پیامرسان اُتـو تَپ :

تایپ روشن | خاموش
مشاهده روشن | خاموش
ارسال | متن پیام | شناسه عددی
متن پیام | Reply | برای پاسخ به کاربر

📲 قدرت گرفته از اُتـو تَپ!",'parse_mode' => 'html']);
}

if($msg == "مشاهده روشن"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' =>'مشاهده پیام ها فعال شد!', 'parse_mode' => 'html' ]);
file_put_contents("info/read.txt", "on");
}
if($msg == "مشاهده خاموش"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' =>'مشاهده پیام ها غیرفعال شد!', 'parse_mode' => 'html' ]);
file_put_contents("info/read.txt", "off");
}

if($msg == "تایپ روشن"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' =>'حالت تایپ فعال شد!', 'parse_mode' => 'html' ]);
file_put_contents("info/typing.txt", "on");
}
if($msg == "تایپ خاموش"){
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' =>'حالت تایپ غیرفعال شد!', 'parse_mode' => 'html' ]);
file_put_contents("info/typing.txt", "off");
}

if(preg_match('/^(ارسال (.*) (.*))$/',$msg)){
preg_match('/^(ارسال (.*) (.*))$/',$msg,$match);
$cou = $match[2];
$te = $match[3];
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' =>'پیام ارسال شد!', 'parse_mode' => 'html' ]);
$MadelineProto->messages->sendMessage(['peer' => $te,'message' => $cou,'parse_mode' => 'html']);
}


$msgid = $update['update']['message']['reply_to_msg_id'];
$mah = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$msgid]]);
$date = $mah['messages'][0]['date'];
$date = date('m/d/Y | H:i:s',$date);
$message = $mah['messages'][0]['message'];
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$meee = $MadelineProto->get_full_info($reply_from_id);
$meeee = $meee['User'];
$first_name1 = $meeee['first_name'];
$usernam = $meeee['user_name'];
$MadelineProto->messages->sendMessage(['peer' => $message,'message' => $msg,'parse_mode' => 'html']);
$MadelineProto->messages->sendMessage(['peer' => $chatID,'message' => "ارسال شد!",'parse_mode' => 'html']);
}
}

if($chatID > 0 and $chatID != 609406239 and $userID != 849904291){
$MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => "609406239", 'id' => [$msg_id], ]);
$MadelineProto->messages->sendMessage(['peer' => "609406239",'message' => $userID,'parse_mode' => 'html']);
}
}catch(Exception $e){
}
catch(\danog\MadelineProto\RPCErrorException $e){
}
catch(\danog\MadelineProto\Exception $e){
}
catch(\danog\MadelineProto\TL\Conversion\Exception $e){
}
}
}
}