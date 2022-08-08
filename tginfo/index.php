<?php
    define('API_KEY', '5323578302:AAEgxkiMjhxVYL8rlsYXI1g_p7he9xCi9P0');
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
    $cid = $message->chat->id;
    $name = $message->chat->first_name;
    $tx = $message->text;
    $user = $message->from->username;

    if($tx == "/start"){
        bot('sendMessage', [
            'chat_id' => $cid,
            'text' => "Your telegram information👇\n Name: $name \n Username: @$user \n Id: $cid",
            'parse_mode' => 'markdown',
        ]);
    }
?>