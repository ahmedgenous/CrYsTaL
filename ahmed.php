
<?php 
/*
اول شي شباب لازم تنشاء جدوال باسم count او اي اسم انت تريده 
وثاني جدوال اسمه che ايضا تستطيع تغيره بكيفك 
*/
$servername = 'localhost'; /*يضل نفسه وذا vps يصير روت */
$dbname = 'باحث';/*هنا تخلي الاسم مال الدتا*/
$username = 'Searcherquranbot';/*يوزر */
$password = '1574472072';/*باسورد*/ 
$db = mysqli_connect($servername, $username, $password, $dbname);
ob_start();

$token = "1574472072:AAHsblUbJQQTRykvIU_k1mgDvKIdoYBrPJ4";
define("API_KEY", $token);
function bot($method,$datas=[]){
$url = "https://api.telegram.org/bot".API_KEY."/".$method;
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
$res = curl_exec($ch);
if(curl_error($ch)){
var_dump(curl_error($ch));
}else{
return json_decode($res); }}
$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$chat_id = $message->chat->id;
$text = $message->text;
$id = $message->from->id;
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id2 = $update->callback_query->message->message_id;
$MROAN = file_get_contents("MROAN.txt");
$admin="995200075";
$start="رساله البداء للبوت خليها براحتك "; 
// الباقي لا تلعب بيهن نهائيا 
if($text == "/start"){
$ch = mysqli_query($db, "SELECT * FROM count WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
bot('sendMEssage',[
'chat_id'=>$chat_id,
'text'=>"$start"
]);
}
if($id != $check['id']){
mysqli_query($db, "INSERT INTO count (id) VALUES ('$id')");
bot('sendMEssage',[
'chat_id'=>$chat_id,
'text'=>"$start"
]);
}}
if($text=="/admin"and $chat_id==$admin ){bot('sendMessage',['chat_id'=>$admin,'message_id'=>$message_id,'text'=>"مرحبا بك عزيزي ",'reply_to_message_id'=>$message->message_id,'disable_web_page_preview'=> true ,'parse_mode'=>"Markdown",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"-الإذاعه☣", 'callback_data'=>'ss'],['text'=>"- عدد المشتركين ، 🐳", 'callback_data'=>'n']],]])]);}
if($data=="hom"){bot('editMessageText',['chat_id'=>$chat_id2,'message_id'=>$message_id2,'text'=>"مرحبا بك عزيزي ",'reply_to_message_id'=>$message->message_id,'disable_web_page_preview'=> true ,'parse_mode'=>"Markdown",'reply_markup'=>json_encode(['inline_keyboard'=>[[['text'=>"- أوامر الإذاعه ، 🗣 ", 'callback_data'=>'ss'],['text'=>"- عدد المشتركين ، 🐳", 'callback_data'=>'n']],]])]);}
if($data == "n"){
$co = mysqli_query($db, "SELECT * FROM count");
$count = 0;
while($dbcount = mysqli_fetch_assoc($co)){
 $count ++;
}
bot('answerCallbackQuery',['callback_query_id'=>$update->callback_query->id,'message_id'=>$message_id,'disable_web_page_preview'=> true ,'parse_mode'=>"Markdown",'text'=>"$count",'show_alert'=>true]);}
if($data == "ss"){
file_put_contents("MROAN.txt","x");
bot('editMessageText',[ 'chat_id'=>$chat_id2, 'message_id'=>$message_id2,'text'=>'هلا بك عزيزي ارسل رسالتك وسوف يتم نشرها  البوت يدعم كافه المديا  ', 'reply_markup'=>json_encode([ 'inline_keyboard'=>[[['text'=>"التالي",'callback_data'=>'MROAN3']],      [['text'=>'🔙' ,'callback_data'=>'hom']],]])]);
}
if($data == "MROAN3"){
file_put_contents("MROAN.txt","ok");
bot('sendMessage',['chat_id'=>$chat_id2,'text'=>'ارسل رسالتك للاذاعه',]);    
}
if($text && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}} 
if($text&& $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendMessage',[
'chat_id'=>$sendToAll['id'],
'disable_web_page_preview'=> true ,'parse_mode'=>"Markdown",
'text'=>$text
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->photo  && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->photo  && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendphoto',[
'chat_id'=>$sendToAll['id'],
'photo'=>$message->photo[0]->file_id,  'caption'=>$message->caption,      'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->document && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->document && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('senddocument',[
'chat_id'=>$sendToAll['id'],
'document'=>$message->document->file_id,'caption'=>$message->caption,'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->voice && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->voice && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendvoice',[
'chat_id'=>$sendToAll['id'],
 'voice'=>$message->voice->file_id,     'caption'=>$message->caption,'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->sticker && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->sticker && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendsticker',[
'chat_id'=>$sendToAll['id'],
 'sticker'=>$message->sticker->file_id,     'caption'=>$message->caption,'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->video && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->video && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendvideo',[
'chat_id'=>$sendToAll['id'],
 'video'=>$message->video->file_id,     'caption'=>$message->caption,'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
if($message->audio && $chat_id==$admin and $MROAN=="ok" ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id != $check['id']){
 mysqli_query($db, "INSERT INTO che (id) VALUES ('$id')");
 bot('sendMessage',[
 'chat_id'=>$chat_id, 'text'=>"تم حفظ رسالتك سوف يتم تنفيذ الامر  "
]);}}
if($message->audio && $chat_id==$admin and $MROAN=="ok"  ){
$ch = mysqli_query($db, "SELECT * FROM che WHERE id = '".$id."' ");
$check = mysqli_fetch_assoc($ch);
if($id == $check['id']){
$users = mysqli_query($db, "SELECT * FROM count");
while($sendToAll = mysqli_fetch_assoc($users)){
bot('sendaudio',[
'chat_id'=>$sendToAll['id'],
 'audio'=>$message->audio->file_id,     'caption'=>$message->caption,'parse_mode'=>"Markdown",'disable_web_page_preview'=>true,
]);
}
mysqli_query($db, "DELETE FROM che WHERE id = '".$id."' ");
unlink("MROAN.txt");
}
}
