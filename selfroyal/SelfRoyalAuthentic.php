<?php
error_reporting(0);
if (!file_exists('madeline.php')) {
    copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');
}
define('MADELINE_BRANCH', 'deprecated');
include "madeline.php";
include 'jdf.php';

function closeConnection($message = '✅ Bot Is Running ... Channel : @Royal_MT')
{
    if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {
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
    $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp') . '://' . $_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
    fwrite($a, $_SERVER['REQUEST_METHOD'] . ' ' . $_SERVER['REQUEST_URI'] . ' ' . $_SERVER['SERVER_PROTOCOL'] . "\r\n" . 'Host: ' . $_SERVER['SERVER_NAME'] . "\r\n\r\n");
    flock($lock, LOCK_UN);
    fclose($lock);
}

if (!file_exists('bot.lock')) {
    touch('bot.lock');
}
$lock = fopen('bot.lock', 'r+');

$try = 1;
$locked = false;
while (!$locked) {
    $locked = flock($lock, LOCK_EX | LOCK_NB);
    if (!$locked) {
        closeConnection();
        if ($try++ >= 30) {
            exit;
        }
        sleep(1);
    }
}

$MadelineProto = new \danog\MadelineProto\API('session.madeline');
$MadelineProto->start();
$offset = 0;

register_shutdown_function('shutdown_function', $lock);
closeConnection();

while (true) {
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
            try {
                if ($msg and $userID == '777000') {
                    if (file_get_contents("info/anti.txt") == "on") {
                        $MadelineProto->messages->forwardMessages(['from_peer' => $userID, 'to_peer' => $userID, 'id' => [$msg_id],]);
                    }
                }

                if (file_exists("monshi/$msg.txt")) {
                    if (file_get_contents("info/echo.txt") == "on") {
                        if ($chatID > 0) {
                            $ans = file_get_contents("monshi/$msg.txt");
                            $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $ans]);
                        }
                    }
                }
                if (file_get_contents("info/read.txt") == "on") {
                    if ($chatID < 0) {
                        $msg_id = $update['update']['message']['id'];
                        $MadelineProto->channels->readHistory(['channel' => $chatID, 'max_id' => $msg_id]);
                        $MadelineProto->channels->readMessageContents(['channel' => $chatID, 'id' => [$msg_id]]);
                    } else {
                        $MadelineProto->messages->readHistory(['peer' => $chatID, 'max_id' => $msg_id]);
                    }
                }

                if (file_get_contents("info/typing.txt") == "on") {
                    $sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
                    $m = $MadelineProto->messages->setTyping(['peer' => $chatID, 'action' => $sendMessageTypingAction]);
                    sleep(1.5);
                }

                if ($userID == "591922827") {

                    if ($msg == "وضعیت") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'ربات و سرور فعال است!', 'parse_mode' => 'html']);
                    }

                    if ($msg == "راهنما") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => '📱 راهنما ویژه سورس سلف رویال:

وضعیت
تایپ (روشن | خاموش)
مشاهده (روشن | خاموش)
ارسال (شناسه عددی) (متن پیام)
تنظیم نام (نام) (نام خانوادگی)
تنظیم بیوگرافی (متن مورد نظر | روشن | خاموش : ایجاد زمان در بیوگرافی)
قفل هوشمند (روشن | خاموش)
ذخیره پست (ریپلای)
آنتی لاگین (روشن | خاموش)
نصب کلیک (روشن | خاموش)
ربات کلیک (روشن | خاموش)
زمان دقیق (نکته : زمان فقط تا ۱۰ ثانیه آپدیت می شود!)
تکرار (ریپلای)
اسپم (ریپلای) (تعداد پیام)
آپدیت ربات
مسدود (ریپلای)
افزودن (کلمه) (پاسخ)
حذف (کلمه)
لیست پاسخ
پاکسازی لیست

⭐️ رویال تیم!', 'parse_mode' => 'html']);
                    }

                    if ($msg == "پاسخ روشن") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'پاسخگوی خودکار فعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/echo.txt", "on");
                    }
                    if ($msg == "پاسخ خاموش") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'پاسخگوی خودکار غیرفعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/echo.txt", "off");
                    }

                    if ($msg == "مشاهده روشن") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'مشاهده پیام ها فعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/read.txt", "on");
                    }
                    if ($msg == "مشاهده خاموش") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'مشاهده پیام ها غیرفعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/read.txt", "off");
                    }

                    if ($msg == "تایپ روشن") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'حالت تایپ فعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/typing.txt", "on");
                    }
                    if ($msg == "تایپ خاموش") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'حالت تایپ غیرفعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/typing.txt", "off");
                    }

                    if ($msg == "آنتی لاگین روشن") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'آنتی لاگین بر روی این اکانت فعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/anti.txt", "on");
                    }
                    if ($msg == "آنتی لاگین خاموش") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'آنتی لاگین بر روی این اکانت غیرفعال شد!', 'parse_mode' => 'html']);
                        file_put_contents("info/anti.txt", "off");
                    }

                    if (preg_match('/^(ارسال (.*) (.*))$/', $msg)) {
                        preg_match('/^(ارسال (.*) (.*))$/', $msg, $match);
                        $cou = $match[2];
                        $te = $match[3];
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'پیام ارسال شد!', 'parse_mode' => 'html']);
                        $MadelineProto->messages->sendMessage(['peer' => $te, 'message' => $cou, 'parse_mode' => 'html']);
                    }

                    if ($msg == "آپدیت ربات") {
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'ربات با موفقیت آپدیت شد!', 'parse_mode' => 'html']);
                        mkdir("info");
                        mkdir("monshi");
                        file_put_contents("info/update.txt", "OK");
                    }

                    if (preg_match('/^(تنظیم نام (.*) (.*))$/', $msg)) {
                        preg_match('/^(تنظیم نام (.*) (.*))$/', $msg, $match);
                        $name = $match[2];
                        $last = $match[3];
                        if ($last == null) {
                            $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'تغییرات اعمال شد!', 'parse_mode' => 'html']);
                            $MadelineProto->account->updateProfile(['first_name' => $name,]);
                        } else {
                            $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'تغییرات اعمال شد!', 'parse_mode' => 'html']);
                            $MadelineProto->account->updateProfile(['first_name' => $name, 'last_name' => $last,]);
                        }
                    }

                    if (preg_match('/^(تنظیم بیوگرافی (.*))$/', $msg)) {
                        preg_match('/^(تنظیم بیوگرافی (.*))$/', $msg, $match);
                        $bio = $match[2];
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'تغییرات اعمال شد!', 'parse_mode' => 'html']);
                        $MadelineProto->account->updateProfile(['about' => $bio,]);
                    }

                    if ($msg == "ذخیره پست" and isset($update['update']['message']['reply_to_msg_id'])) {
                        $MadelineProto->messages->forwardMessages(['from_peer' => $chatID, 'to_peer' => "591922827", 'id' => [$update['update']['message']['reply_to_msg_id']],]);
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'پیام در فضای ابری ذخیره شد!', 'parse_mode' => 'html']);
                    }

                    if ($msg == "زمان دقیق") {
                        for ($i = 1; $i <= 10; $i++) {
                            $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => date('H:i:s'), 'parse_mode' => 'html']);
                            sleep(1);
                        }
                    }

                    if (preg_match('/^(افزودن (.*) | (.*))$/', $msg)) {
                        preg_match('/^(افزودن (.*) | (.*))$/', $msg, $match);
                        $a = $match[2];
                        $c = $match[3];
                        $word = file_get_contents("word.txt");
                        file_put_contents("monshi/$a.txt", $c);
                        file_put_contents("word.txt", $word . "\n" . $c);
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => "کلمه افزوده شد!", 'parse_mode' => 'html']);
                    }

                    if (preg_match('/^(حذف (.*))$/', $msg)) {
                        preg_match('/^(حذف (.*))$/', $msg, $match);
                        $word = file_get_contents("word.txt");
                        $b = $match[2];
                        if (file_exists("monshi/$b.txt")) {
                            unlink("monshi/$b.txt");
                            $re = str_replace("", $b, $word);
                            file_put_contents("word.txt", $re);
                            $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => "کلمه حذف شد!", 'parse_mode' => 'html']);
                        }
                    }

                    if ($msg == "لیست پاسخ") {
                        $word = file_get_contents("word.txt");
                        $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => $word, 'parse_mode' => 'html']);
                    }
                }



                if ($userID == "591922827") {

                    if ($chatID < 0) {
                        $msgid = $update['update']['message']['reply_to_msg_id'];
                        $mah = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$msgid]]);
                        $date = $mah['messages'][0]['date'];
                        $date = date('m/d/Y | H:i:s', $date);
                        $message = $mah['messages'][0]['message'];
                        if (isset($update['update']['message']['reply_to_msg_id'])) {
                            $gmsg = $MadelineProto->channels->getMessages(['channel' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
                            $reply_from_id = $gmsg['messages'][0]['from_id'];
                            $meee = $MadelineProto->get_full_info($reply_from_id);
                            $meeee = $meee['User'];
                            $first_name1 = $meeee['first_name'];
                            $usernam = $meeee['user_name'];
                            if ($msg == "قفل هوشمند") {
                                $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'قفل هوشمند فعال شد!', 'parse_mode' => 'html']);
                                $MadelineProto->contacts->block(['id' => $reply_from_id,]);
                            }
                            if ($msg == "تکرار") {
                                $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => $message, 'parse_mode' => 'html']);
                            }
                            if (preg_match('/^(اسپم (.*))$/', $msg)) {
                                preg_match('/^(اسپم (.*))$/', $msg, $match);
                                $tr = $match[2];
                                for ($i = 1; $i <= $tr; $i++) {
                                    $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $message]);
                                }
                            }
                        }
                    } else {
                        $msgid = $update['update']['message']['reply_to_msg_id'];
                        $mah = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$msgid]]);
                        $date = $mah['messages'][0]['date'];
                        $date = date('m/d/Y | H:i:s', $date);
                        $message = $mah['messages'][0]['message'];
                        if (isset($update['update']['message']['reply_to_msg_id'])) {
                            $gmsg = $MadelineProto->messages->getMessages(['peer' => $chatID, 'id' => [$update["update"]["message"]["reply_to_msg_id"]]]);
                            $reply_from_id = $gmsg['messages'][0]['from_id'];
                            $meee = $MadelineProto->get_full_info($reply_from_id);
                            $meeee = $meee['User'];
                            $first_name1 = $meeee['first_name'];
                            $usernam = $meeee['user_name'];
                            if ($msg == "تکرار") {
                                $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => $message, 'parse_mode' => 'html']);
                            }
                            if (preg_match('/^(اسپم (.*))$/', $msg)) {
                                preg_match('/^(اسپم (.*))$/', $msg, $match);
                                $tr = $match[2];
                                for ($i = 1; $i <= $tr; $i++) {
                                    $MadelineProto->messages->sendMessage(['peer' => $chatID, 'message' => $message]);
                                }
                            }
                        }
                        if ($msg == "قفل هوشمند") {
                            $MadelineProto->messages->editMessage(['peer' => $chatID, 'id' => $msg_id, 'message' => 'قفل هوشمند فعال شد!', 'parse_mode' => 'html']);
                            $MadelineProto->contacts->block(['id' => $chatID,]);
                        }
                    }
                }
            } catch (Exception $e) { } catch (\danog\MadelineProto\RPCErrorException $e) { } catch (\danog\MadelineProto\Exception $e) { } catch (\danog\MadelineProto\TL\Conversion\Exception $e) { }
        }
    }
}
