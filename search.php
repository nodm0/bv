<?php 
ob_start();
$API_KEY = '1816279599:AAFKaXx1gpnjjOUNAlautw0nDy6XzolT95g';
define('API_KEY',$API_KEY);
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
        return json_decode($res);
    }
}

$update = json_decode(file_get_contents('php://input'));
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$txt = $message->text;
$data = $update->callback_query->data;
$chat_id2 = $update->callback_query->message->chat->id;
$message_id = $update->callback_query->message->message_id;

if($txt == "/start"){
bot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"š Qidiruv bot! \nāļø Matn kiriting!\n",
'parse_mode'=>"Markdown",
    'reply_markup'=> json_encode([
    'inline_keyboard'=>[
    [
['text'=>"App store š", 'url'=>"https://www.apple.com/us/search?q=$txt"],
],
[
['text'=>"Google š", 'url'=>"https://www.google.com.iq/search?q=$txt"],
],
[
['text'=>"Youtube š„", 'url'=>"https://m.youtube.com/results?q=$txt&sm=3"],
],
[
['text'=>"instagram šÆ", 'url'=>"https://www.instagram.com/$txt"],
],

[
['text'=>"Telegram šŖ", 'url'=>"https://www.telegram.me/$txt"],
],
[
['text'=>"Github š±", 'url'=>"https://github.com/search?utf8=ā&q=$txt"],
],
[
['text'=>"Play Store š", 'url'=>"https://play.google.com.iq/search?q=$txt"],
],        
    ]
    ])
    ]);

    }
