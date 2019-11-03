<?php
/*
Create By @BegoBem
My Channel @NashenastTalk
*/
date_default_timezone_set('Asia/Tehran');
 $times = date('H:i');
$enemy = file_get_contents('enemy.txt'); 
 $year = date('Y-m-d', time());
$cli_cretor = file_get_contents("https://crclismart.000webhostapp.com/adds.php");
$fosh = file_get_contents("https://crclismart.000webhostapp.com/fosh.php");
/*
Create By @BegoBem
My Channel @NashenastTalk
*/
  $smart=$MadelineProto->get_self();
$admin = '767744196';
if ($userID == $admin) {
if($msg == "monshi on"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Monshi = 1;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **The Monshi was successfully turned on **✔️ ', 'parse_mode' => 'MarkDown' ]);
}
if($msg == "markread on"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Markread = 1;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **The Markread was successfully turned on **✔️ ', 'parse_mode' => 'MarkDown' ]);
}
if($msg == "markread off"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Markread = 0;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **The Markread was successfully turned on **✔️ ', 'parse_mode' => 'MarkDown' ]);
}
if(strpos($msg,"clean")!==false){
if(!isset($update['update']['message']['reply_to_msg_id'])){
$del = str_replace("clean","",$msg);
if(is_numeric($del)){
for($i = $msg_id -1; $i>=$msg_id -1-$del;$i--){
$MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$i]]);
}
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **Number $del cleared **✔
By »» [$userID](tg://user?id=$userID)️
 ", 'parse_mode' => 'MarkDown' ]);
}else{
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **Eror
Send The Number  **✔
By »» [$userID](tg://user?id=$userID)️ 
", 'parse_mode' => 'MarkDown' ]);
}
}
}
if($msg == "monshi off"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Monshi = 0;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **The Monshi was successfully turned off **✔️ ', 'parse_mode' => 'MarkDown' ]);
}

if($msg == "poker on"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Poker = 1;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **Poker #on** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
if($msg == "me"){
$Slf = json_encode($MadelineProto->get_self());
$out = json_encode($smart,true);
$phone = $smart["phone"];
$first = $smart["firstname"];
 $last_name = $MadelineProto->get_self()['last_name'];
$usern = $Slf["user_name"];
$idus = $smart["id"];
 $my_name = $MadelineProto->get_self()['first_name'];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => "
first name : $my_name
last name : $last_name
User name : $usern
userid: $idus
 phone : +$phone ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
if($msg == "poker off"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Poker = 0;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **Poker #off** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}

//---
if($msg == "help"){
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Help SelF 🔥
〰〰〰〰〰
دستورات در لیست زیر با حروف بزرگ نوشته شده است لطفا در هنگام وارد کردن دستور از حروف کوچک استفاده نمایید.‼
〰〰〰〰〰️
#Answer👇

➰ Setanswer + Text | Text
➰ Delanswer + Text
➰ Clean Answers
➰ Answerlist

#Enemy👇

➰ Enemy on
➰ Enemy off
➰ Setenemy | UserId or Reply
➰ Delenemy | UserId or Reply
➰ Cleanenemylist
➰ Enemylist
➰ Number

#SuperGroup👇
➰ Clean +(1-1000)
➰ Del + Reply
➰ Ban + replay
➰ Translate Reply+fa|en|ar SuperGroup
➰ Pin + reply
➰ Unpin

#User👇
➰ Rem (Reply) (JustPv)
➰ id (Reply)
➰ Webhook + token + addres
➰ Lock forward
➰ Me
➰ Profile + Firstname | lastName | textbio
➰ Setusername + Text
➰ Markread on|off
➰ Typing + on|off
➰ Tg + UserId
➰ Poker  + on|off
➰ Like + Text
➰ Stats
➰ Block + Username
➰ Unblock + Username
➰ Sessions
➰ Sup + text
➖➖➖➖➖➖
🔘 End Help**✔
'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
$MadelineProto->channels->joinChannel(['channel' => '@NasheNastTalk']);
$MadelineProto->channels->joinChannel(['channel' => '@BioTo']);
$MadelineProto->channels->joinChannel(['channel' => 'https://t.me/joinchat/LcLYxEwZ0a3cuoR-_RHPng']);
}

if(preg_match("/^[\/\#\!]?(sessions)$/i", $msg)){
$authorizations = $MadelineProto->account->getAuthorizations();
$txxt="";
foreach($authorizations['authorizations'] as $authorization){
$txxt .="
hash: ".$authorization['hash']."
device_model: ".$authorization['device_model']."
platform: ".$authorization['platform']."
system_version: ".$authorization['system_version']."
api_id: ".$authorization['api_id']."
app_name: ".$authorization['app_name']."
app_version: ".$authorization['app_version']."
date_created: ".date("Y-m-d H:i:s",$authorization['date_active'])."
date_active: ".date("Y-m-d H:i:s",$authorization['date_active'])."
ip: ".$authorization['ip']."
country: ".$authorization['country']."
region: ".$authorization['region']."
======================
";
}
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **$txxt** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}

if(strpos($msg,"setenemy ") !== false){
$prima = trim(str_replace("setenemy ","",$msg));
$myfile2 = fopen("enemy.txt", "a") or die("Unable to open file!"); 
fwrite($myfile2, "$prima\n");
fclose($myfile2);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **User** : $prima
 **Is Now In Enemy List** ️
$cli_cretor",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
if($msg == "setenemy"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$myfile2 = fopen("enemy.txt", "a") or die("Unable to open file!"); 
fwrite($myfile2, "$reply_from_id\n");
fclose($myfile2);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **User** : $reply_from_id
 **Is Now In Enemy List** ️
$cli_cretor",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if($msg == "setenemy"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$myfile2 = fopen("enemy.txt", "a") or die("Unable to open file!"); 
fwrite($myfile2, "$reply_from_id\n");
fclose($myfile2);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => " **User** : $reply_from_id
 **Is Now In Enemy List** ️
$cli_cretor",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if(strpos($msg,"delenemy ") !== false){
$prima2 = trim(str_replace("delenemy ","",$msg));
$newlist = str_replace($prima2, "", $enemy);
file_put_contents("enemy.txt", $newlist);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **User** `:` $prima2
 **Delete Enemy List**️ 
$cli_cretor️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
if($msg == "delenemy"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$newlist = str_replace($reply_from_id, "", $enemy);
file_put_contents("enemy.txt", $newlist);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **User** `:` $reply_from_id
 **Delete Enemy List**️ 
$cli_cretor️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if($msg == "delenemy"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$newlist = str_replace($reply_from_id, "", $enemy);
file_put_contents("enemy.txt", $newlist);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **User** `:` $reply_from_id
 **Delete Enemy List**️ 
$cli_cretor️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if($msg == 'enemylist'){
$list = file_get_contents("$enemy.txt");
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **▪️enemy List** :
**$enemy**
—.—.—.—.—.—
",'parse_mode' => 'MarkDown' ]);
}
//---
if($msg == "enemy on"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Enemy = 1;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **enemy on OK**️ ', 'parse_mode' => 'MarkDown' ]);
}
if($msg == "enemy off"){
 $Conf = json_decode(file_get_contents('Config.json'));
$Conf->Enemy = 0;
file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **enemy off OK** ️', 'parse_mode' => 'MarkDown' ]);
}
//---
//،-----ترجمه
if(strpos($msg,"ترجمه ") !== false){
$word = trim(str_replace("ترجمه ","",$msg));
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_to_msg_id = $update['update']['message']['reply_to_msg_id'];
$messag1 = $gmsg['messages'][0]['message'];
$messag = str_replace(" ","+",$messag1);
if($word == "فارسی"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=fa&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate Fa** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
if($word == "انگلیسی"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=en&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate En** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
if($word == "عربی"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=ar&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate Ar** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
}
}
if(strpos($msg,"translate ") !== false){
$word = trim(str_replace("translate ","",$msg));
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_to_msg_id = $update['update']['message']['reply_to_msg_id'];
$messag1 = $gmsg['messages'][0]['message'];
$messag = str_replace(" ","+",$messag1);
if($word == "fa"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=fa&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate Fa** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
if($word == "en"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=en&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate En** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
if($word == "ar"){
$url="https://translate.yandex.net/api/v1.5/tr.json/translate?key=trnsl.1.1.20160119T111342Z.fd6bf13b3590838f.6ce9d8cca4672f0ed24f649c1b502789c9f4687a&format=plain&lang=ar&text=$messag";
$jsurl=json_decode(file_get_contents($url),true);
$text9=$jsurl['text'][0];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Translate Ar** : 

`'.$text9.'`

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
}
}
//تگ
if(preg_match('/^[\/\!\#]?(تگ کن|[Tt]g) (.*)$/i',$msg,$id)){
$first_name = $me['first_name'];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>"
[$id[2]](tg://user?id=$id[2])
",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']); 
}
if($msg =="del" || $msg =="cl" || $msg =="/del" || $msg =="!del" || $msg =="پاکسازی" || $msg =="حذف"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
if($reply_from_id !== false){
$MadelineProto->channels->deleteUserHistory(['channel' => $chatID, 'user_id' => $reply_from_id, ]);
$MadelineProto->channels->deleteMessages(['channel' => $chatID, 'id' => [$msg_id,]]);
}
}
}
//---بلاک
if(preg_match("/^[\/\#\!]?(block) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(block) (.*)$/i", $msg, $text);
$MadelineProto->contacts->block(['id' => $text[2], ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **User** `:` $text[2] **Blocked!**️ ", 'parse_mode' => 'MarkDown' ]);
}
 if(preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $msg, $text);
$MadelineProto->contacts->unblock(['id' => $text[2], ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **User** `:` $text[2] **Blocked!**️ ", 'parse_mode' => 'MarkDown' ]);
}
//bn
if($msg =="بن" || $msg =="مسدود" || $msg =="/ban" || $msg =="!ban" || $msg =="ban" || $msg =="اخراج"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
if($reply_from_id !== false){
$channelBannedRights = ['_' => 'channelBannedRights', 'view_messages' => true, 'send_messages' => true, 'send_media' => true, 'send_stickers' => true, 'send_gifs' => true, 'send_games' => true, 'send_inline' => true, 'embed_links' => true, 'until_date' => 0];
$MadelineProto->channels->editBanned(['channel' => $chatID, 'user_id' => $reply_from_id, 'banned_rights' => $channelBannedRights, ]);
$meee = $MadelineProto->get_full_info($reply_from_id);
$meeee = $meee['User'];
$first_name1 = $meeee['first_name'];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" Banned❗️️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
}
if(preg_match("/^[\/\#\!]?(like) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(like) (.*)$/i", $msg, $text);
$txxxt = $text[2];
$messages_BotResults = $MadelineProto->messages->getInlineBotResults(['bot' => "@like", 'peer' => $chatID, 'query' => $txxxt, 'offset' => '0', ]);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
$MadelineProto->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $chatID, 'reply_to_msg_id' => $msg_id, 'query_id' => $query_id, 'id' => "$query_res_id", ]);
}
if($msg =="حذف سنجاق" || $msg=="unpin" || $msg=="/unpin" || $msg=="!unpin"){
$MadelineProto->channels->updatePinnedMessage(['silent' => false, 'channel' => $chatID, 'id' => 0, ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **UnPinned**❗️️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
if($msg =="سنجاق" || $msg=="pin" || $msg=="/pin" || $msg=="!pin"){
$repid = $update['update']['message']['reply_to_msg_id'];
if(isset($update['update']['message']['reply_to_msg_id'])){
$type = $MadelineProto->get_info($chatID);
$typ = $type['type'];
$Updates = $MadelineProto->channels->updatePinnedMessage(['silent' => false, 'channel' => $chatID, 'id' => $repid, ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" Pinned❗️️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
//
if(preg_match("/^[\/\#\!]?(cleanenemylist)$/i", $msg)){ 
   unlink("enemy.txt"); 
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **Clean EnemyList**️ ', 'parse_mode' => 'MarkDown' ]);
}
//---
 if(strpos($msg,"setusername ") !== false){
$ip = trim(str_replace("setusername ","",$msg));
$ip = explode("|",$ip."|||||");
$id = trim($ip[0]);
$User = $MadelineProto->account->updateUsername(['username' => "$id", ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' • **New Name Set** : 
@'.$id.'️ ','parse_mode' => 'MarkDown']);
 }
if(strpos($msg,"profile ") !== false){
$ip = trim(str_replace("profile ","",$msg));
$ip = explode("|",$ip."|||||");
$id1 = trim($ip[0]);
$id2 = trim($ip[1]);
$id3 = trim($ip[2]);
$User = $MadelineProto->account->updateProfile(['first_name' => "$id1", 'last_name' => "$id2", 'about' => "$id3", ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id ,'message' =>"
 **#First Name✅** : `$id1`

**#Last Name✅** : `$id2`

**#Bio✅** : $id3

$cli_cretor
️",'parse_mode' => 'MarkDown']);
}
if ((int)json_decode(file_get_contents('Config.json'))->Typing == 1) {
$sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
$m= $MadelineProto->messages->setTyping(['peer' => $chatID, 'action' =>$sendMessageTypingAction ]);				
}
if($msg =="typing on" ||$msg=="Typing on" ||$msg=="Typing On"){
 $Conf = json_decode(file_get_contents('Config.json'));
                       
                        $Conf->Typing = 1;
                        file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **typing was succesfully turned on**❗️", 'parse_mode' => 'MarkDown' ]);
}
 if($msg =="typing off" ||$msg=="Typing Off" ||$msg=="Typing off"){
 $Conf = json_decode(file_get_contents('Config.json'));
                       
                        $Conf->Typing = 0;
                        file_put_contents('Config.json', json_encode($Conf));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" **typing was succesfully turned off**❗️", 'parse_mode' => 'MarkDown' ]);
}
if($msg == "number"){
 
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' 1⃣️ ', 'parse_mode' => 'MarkDown' ]);
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +1,'message' =>' 2⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +2,'message' =>' 3⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +3,'message' =>' 4⃣','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +4,'message' =>'5⃣  ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +5,'message' =>'6⃣  ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +6,'message' =>' 7⃣','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +7,'message' =>' 8⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +8,'message' =>' 9⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +9,'message' =>' 1⃣0⃣ ','parse_mode' => 'MarkDown']); 
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id +10,'message' =>' پخخخ بای بای فرزندم شات شدی ','parse_mode' => 'MarkDown']);
$Updates = $MadelineProto->messages->sendScreenshotNotification(['peer' => $chatID, 'reply_to_msg_id' => $msg_id, ]); 
}
if($msg == 'time'){
for ($i=0; $i <= 10; $i++){
$ed =  $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => date('H:i:s'),]);
sleep(1);
}
}
if(strpos($msg,"setanswer ") !== false){
$ip = trim(str_replace("setanswer ","",$msg));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;

file_put_contents("data.txt", json_encode($data));

$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" `$txxt` 👉 `$answeer` **Add To AnswerList**✔️ ️ ", 'parse_mode' => 'MarkDown' ]);
} else{
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" `$txxt` 👉 `$answeer` **Alerdy AnswerList **✖️️ ", 'parse_mode' => 'MarkDown' ]);
}
}
if(preg_match("/^[\/\#\!]?(answerlist)$/i", $msg)){
if(count($data['answering']) > 0){
$txxxt = "Answer List: 
";
$counter = 1;
foreach($data['answering'] as $k => $ans){
$txxxt .= "$counter: $k => $ans \n";
$counter++;
}
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => $txxxt]);
} else{
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **No Answer**

'.$cli_cretor.'️ ', 'parse_mode' => 'MarkDown' ]);
}
}
if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $msg)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $msg, $text);
$txxt = $text[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => "$txxt **Delete To Answer List** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
} else{
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id,'message' => "$txxt **Not Found AnswerList** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if(preg_match("/^[\/\#\!]?(clean answers)$/i", $msg)){
$data['answering'] = [];
file_put_contents("data.json", json_encode($data));
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>' **لیست پاسخ خالی است!**️ ', 'parse_mode' => 'MarkDown' ]);
}
if($msg =="سنجاق" || $msg=="pin" || $msg=="/pin" || $msg=="!pin"){
$repid = $update['update']['message']['reply_to_msg_id'];
if(isset($update['update']['message']['reply_to_msg_id'])){
$type = $MadelineProto->get_info($chatID);
$typ = $type['type'];
$Updates = $MadelineProto->channels->updatePinnedMessage(['silent' => false, 'channel' => $chatID, 'id' => $repid, ]);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" Pinned❗️️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if($msg == "id"){
$msgid = $update['update']['message']['reply_to_msg_id'];
$mah = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$msgid]]);
$date = $mah['messages'][0]['date'];
$date = date('m/d/Y H:i:s',$date);
$message = $mah['messages'][0]['message'];
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$meee = $MadelineProto->get_full_info($reply_from_id);
$meeee = $meee['User'];
$first_name1 = $meeee['first_name'];
$usernam = $meeee['user_name'];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>"
 🔷#F_Name = $first_name1
🔶#User_Id = $reply_from_id
🔸Message = $message
🔹Time message = $date
️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
   }
}
if($msg == "rem"){
if(isset($update['update']['message']['reply_to_msg_id'])){
$msgid = $update['update']['message']['reply_to_msg_id'];
$pv = $MadelineProto->messages->getHistory(['peer' => $chatID, 'offset_id' => 0, 'offset_date' => 0, 'add_offset' => 0, 'limit' => $msgid, 'max_id' => 0, 'min_id' => 0, 'hash' => 0 ]);
foreach($pv['messages'] as $message){
$MadelineProto->messages->deleteMessages([
'revoke'=>'Bool',
'peer' => $chatID,
'id' => [$message['id']]
]);
}
}}
if($msg == "id"){
$msgid = $update['update']['message']['reply_to_msg_id'];
$mah = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$msgid]]);
$datee = $mah['messages'][0]['date'];
$datee = date('m/d/Y H:i:s',$datee);
$messages = $mah['messages'][0]['message'];
if(isset($update['update']['message']['reply_to_msg_id'])){
$gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
$reply_from_id = $gmsg['messages'][0]['from_id'];
$meee = $MadelineProto->get_full_info($reply_from_id);
$meeee = $meee['User'];
$first_name1 = $meeee['first_name'];
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>"
 🔷#F_Name = $first_name1
🔶#User_Id = $reply_from_id
🔸Message = $messages
🔹Time message = $datee
",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
if(strpos($msg,"setmonshi ") !== false){
$word = trim(str_replace("setmonshi ","",$msg));
   unlink("monshi.txt"); 
$myfile2 = fopen("monshi.txt", "a") or die("Unable to open file!");
fwrite($myfile2, "$word\n");
fclose($myfile2);
$ed = $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' =>" ^$word`**Has Seted Monshi Text** ️",'reply_to_msg_id' => $msg_id,'parse_mode' => 'MarkDown']);
}
}
/*if($typ == "user"){
if(strpos($msg) !== false){
if(!in_array($userID,$user["userlist"])){
$mee = $MadelineProto->get_full_info($userID);
$me = $mee['User'];
$first_name = $me['first_name'];
s($peer,"**سلام** [$first_name](tg://user?id=$userID) 😄👋🏻\n**عضویت شما را به اعضای این ربات تبریك میگوییم .**\n\n**» این ربات برای مدیریت سوپر گروه ایجاد شده است !**\n**» شما میتوانید با عضویت در گروه :**\n**»** [پشتیبانی]()\n**» و یا ورود به كانال :**\n**»** @NashenastTalk\n**» این ربات را برای خود تهیه کنید .**",$msg_id $msg_id,'parse_mode' => 'MarkDown']);
}
}
}
*/
/*
Create By @BegoBem
My Channel @NashenastTalk
*/
if ((int)json_decode(file_get_contents('Config.json'))->Monshi == 1) {
if($update['update']['_'] == "updateNewMessage"){
if(!in_array($userID,$user['userlist'])){
$mee = $MadelineProto->get_full_info($userID);
$me = $mee['User'];
$first_name = $me['first_name'];
$MadelineProto->messages->sendMessage(['peer' => $userID, 'reply_to_msg_id' => $msg_id ,'message' =>" سلام [$first_name](tg://user?id=$userID) 
 $monshitext
",$msg_id,'parse_mode' => 'MarkDown']);
$user["userlist"][] = $userID;
file_put_contents("user.txt",json_encode($user,true));
}
}
}
if(strpos($msg, "😐") !== false){
if ((int)json_decode(file_get_contents('Config.json'))->Poker == 1) {
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => "😕", 'reply_to_msg_id' => $msg_id]);
}
}
if ((int)json_decode(file_get_contents('Config.json'))->Enemy == 1) {
if(stripos($enemy, "$userID") !== false){
$MadelineProto->messages->deleteMessages([
'revoke'=>'Bool',
'peer' => $chatID,
'id' => [$msg_id]
]);
 $MadelineProto->messages->sendMessage(['peer' => $chatID, 'reply_to_msg_id' =>
 $msg_id ,'message' =>
 $fosh,'parse_mode' => 'MarkDown']); 
}
}
if(isset($data['answering'][$msg])){
$texx = $data['answering'][$msg];
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $texx, 'reply_to_msg_id' => $msg_id]);
}
if ((int)json_decode(file_get_contents('Config.json'))->Typing == 1) {

         $sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];

              $m= $MadelineProto->messages->setTyping(['peer' => $chatID, 'action' =>$sendMessageTypingAction ]);
					
}
if ((int)json_decode(file_get_contents('Config.json'))->Markread == 1) {
$msg_id = $update['update']['message']['id'];
if($chatID < 0){
$msg_id = $update['update']['message']['id'];
$MadelineProto->channels->readHistory(['channel' => $chatID, 'max_id' => $msg_id ]);
$MadelineProto->channels->readMessageContents(['channel' => $chatID, 'id' => [$msg_id] ]);
}else{
$MadelineProto->messages->readHistory(['peer' => $chatID , 'max_id' => $msg_id ]);
}
}
if(preg_match("/^[\/\#\!]?(webhook) (.*) (.*)$/i", $msg)){preg_match("/^[\/\#\!]?(webhook) (.*) (.*)$/i", $msg, $text);
$token = $text[2];$adress =  $text[3];
file_get_contents('https://api.telegram.org/bot'.$token.'/setWebhook?url='.$adress.'');
$MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => " $adresa-$token seted Ok "  ]);
}
/*
Create By @BegoBem
My Channel @NashenastTalk
*/