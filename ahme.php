<?php
//Code by - ahmed 
ob_start();
$API_KEY = '1574472072:AAHsblUbJQQTRykvIU_k1mgDvKIdoYBrPJ4';
$chname = "Ahmed";
$chlink = "https://t.me/gcgcf_bot";
$ch = "@ahmedhassanalfaid";
$sudo = 1586868531;
define('API_KEY',$API_KEY);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url); curl_setopt($ch,CURLOPT_RETURNTRANSFER,true); curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{return json_decode($res);}}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$fn = $message->from->first_name;
$uss = $message->from->username;
$bot = file_get_contents("bot.txt");
$info = json_decode(file_get_contents('info.json'),true);
$us = file_get_contents("users.txt");
$uscr = explode("\n",$us);
//////////////////////
$urlset = "https://bnmbnm66.000webhostapp.com/bots/$from_id/bot.php";
$chjoin = "• اهلا بك ؛ [$fn](t.me/$uss)
• عليك الاشتراك في [القناه]($chlink) اولا ، 🔽";
$start = "• اهلا بك في بوت صنع بوت تواصل ، 🏷";
$sendcr = "• الان قم بأرسال التوكن الخاص بك ، ☑
• يمكنك الحصول عليه من خلال @BotFather";
$sendstope = "• جاري الصنع ، 🔄";
$sendcant = "• عذرأ ، ⚠
• هذه التوكن مستخدم او غير موجود ، 🔖";
$sendnotcr = "• لا يمكنك صناعه اكثر من بوت ، ⚠";
$sendnobot = "• اصنع بوت اولا ، ⚠";
$senddonedel = "• تم حذف البوت بنجاح ، ✅";
$home = "• الصفحه الرئيسيه ، 📃";
$create = "• صنع بوت ، 🔖";
$rem = "• حذف بوت ، ⚠";
$infobot = "• معلومات بوتي ، 📋";
//////////////////////
$join = file_get_contents("https://api.telegram.org/bot".API_KEY."/getChatMember?chat_id=$ch&user_id=".$from_id);
if($message && (strpos($join,'"status":"left"') or strpos($join,'"Bad Request: USER_ID_INVALID"') or strpos($join,'"status":"kicked"'))!== false){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$chjoin",
'reply_to_message_id'=>$msid,
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_markup' => json_encode(['inline_keyboard' => [
[['text' => "$chname", 'url' => "$chlink"]],]])
]);return false;}
if($message && !in_array($from_id,$info["users"])){
$info['users'][] = "$from_id";
file_put_contents('info.json', json_encode($info));}
if($text == "/start" or $text == "$home"){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$start",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$create"],["text"=>"$rem"]],
[["text"=>"$infobot"]],
],])]);
$info['step']["$from_id"] = "off";
file_put_contents('info.json', json_encode($info));}
if($text == "$create" && !in_array($from_id,$uscr)){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendcr",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);
$info['step']["$from_id"] = "sendtoken";
file_put_contents('info.json', json_encode($info));return false;}
if($text == "$create" && in_array($from_id,$uscr)){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendnotcr",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);}
if($text && $info['step']["$from_id"] == "sendtoken"){
$gettoken = json_decode(file_get_contents("https://api.telegram.org/bot$text/getWebhookInfo"))->ok;
if($gettoken == "true"){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendstope",
'reply_to_message_id'=>$msid,]);
mkdir("bots");
mkdir("bots/$from_id");
file_put_contents("bots/$from_id/bot.php",'<?php
$token = "'.$text.'";
$id = "'.$from_id.'";
'.$bot);
file_get_contents("https://api.telegram.org/bot$text/setwebhook?url=$urlset");
$info['info']["$from_id"] = "$text";
file_put_contents('info.json', json_encode($info));
file_put_contents('users.txt',"\n".$from_id);
$url = json_decode(file_get_contents("https://api.telegram.org/bot$text/getme"))->result;
$user = $url->username;
$name = $url->first_name;
bot('sendmessage',[
'chat_id'=>$sudo[0],
'text'=>"• تم صناعه بوت من قبل ، 🔽
- الاسم ؛ $fn
- المعرف ؛ @$uss
- التوكن ؛ $text",
]);
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"• تم صناعه البوت ، ☑
• [$name](t.me/$user)",
'parse_mode'=>"MarkDown",
'disable_web_page_preview'=>true,
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);
$info['step']["$from_id"] = "off";
file_put_contents('info.json', json_encode($info));}
elseif($gettoken !== "true"){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendcant",
'reply_to_message_id'=>$msid,]);
$info['step']["$from_id"] = "off";
file_put_contents('info.json', json_encode($info));}}
if($text == "$rem"){
if(!in_array($from_id,$uscr)){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendnobot",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);
}
if(in_array($from_id,$uscr)){
$token = $info['info']["$from_id"];
$url = json_decode(file_get_contents("https://api.telegram.org/bot$token/getWebhookInfo"))->result->url;
file_get_contents("https://https://api.telegram.org/bot$token/deletewebhook?url=$url");
unlink("bots/$from_id/bot.php");
$info['info']["$from_id"] = "nobot";
$de = str_replace("\n".$from_id,"",$us);
file_put_contents('users.txt',$de);
file_put_contents('info.json', json_encode($info));
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$senddonedel",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);}}
if($text == "$infobot"){
if(in_array($from_id,$uscr)){
$token = $info['info']["$from_id"];
$url = json_decode(file_get_contents("https://api.telegram.org/bot$token/getMe"))->result;
$id = $url->id;
$user = $url->username;
$name = $url->first_name;
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"• معلومات بوتك ، 🔽
الاسم ؛ $name
الايدي ؛ $id
التوكن ؛ $token
المعرف ؛ @$user",
'reply_to_message_id'=>$msid,'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);}
if(!in_array($from_id,$uscr)){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$sendnobot",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$home"]],
],])]);}}
$cus = count($info["users"]);
$ccus = count($uscr);
$sendtext = "• ارسل النص ، 📭";
$sendfwd = "• ارسل الرساله ، 📭";
$donesend = "تم الارسال ، 📬";
$fwdtext = "• توجيه للكل ، ↪";
$sendtext = "• ارسال للكل ، 📮";
$stast = "• اهلا بك عزيزي المطور ، 🔱
عدد الاعضاء ؛ $cus
عدد البوتات المصنوعه ؛ $ccus";
if($text == "/stats" && in_array($from_id,$sudo)){
bot('sendMessage', [
'chat_id'=>$chat_id,
'text'=>"$stast",
'reply_to_message_id'=>$msid,
'reply_markup'=>json_encode([
'resize_keyboard'=>true,
'keyboard'=>[
[["text"=>"$fwdtext"],["text"=>"$sendtext"]],
],])]);
}
if($text == $fwdtext && in_array($from_id,$sudo)){
$info["step"] = "fwd";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$sendfwd",]);return false;}
if($text == $sendtest&& in_array($from_id,$sudo)){
$info["step"] = "send";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$sendtext",]);return false;}
if($info['step'] == "send" && in_array($from_id,$sudo)){
$mbs = $info['users'];
foreach($mbs as $mb){
$url = file_get_contents("https://api.telegram.org/bot$API_KEY/sendMessage?chat_id=".$mb."&parse_mode=markdown&disable_web_page_preview=true&text=".urlencode($text));}
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donesend"]);}
if($info['step'] == "fwd" && in_array($from_id,$sudo)){
$mbs = $info['users'];
foreach($mbs as $mb){
bot('forwardMessage',[
'chat_id'=>$mb,
'from_chat_id'=>$chat_id,
'message_id'=>$message->message_id]);}
$info["step"] = "off";
file_put_contents("info.json", json_encode($info));
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"$donesend"]);}
