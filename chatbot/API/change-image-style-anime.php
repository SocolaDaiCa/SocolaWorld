<?php
    $debug = true;
    require_once 'construct.php';
    $target_url = 'http://api.everfilter.me/filters/shinkai?nightscape=0';
    $urlImage = $_GET['image'];
    file_put_contents('log', $urlImage);
    $nameImageSaved = explode('?', $urlImage)[0];
    $nameImageSaved = explode('/', $nameImageSaved);
    $nameImageSaved = array_pop($nameImageSaved);
    
    $pathImageSaved = "../media/images/{$nameImageSaved}";
    file_put_contents($pathImageSaved, file_get_contents($urlImage));
    $realpath = realpath($pathImageSaved);
    $fileImage = new CURLFile($realpath);
    $post = array(
        'media' => $fileImage
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $target_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible;)");   
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Content-Type: multipart/form-data'));
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);   
    curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);  
    curl_setopt($ch, CURLOPT_TIMEOUT, 100);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $result = curl_exec ($ch);
    curl_close ($ch);
    if ($result === FALSE) {
        // echo "Error sending" . $fname . " " . curl_error($ch);
    }else{
        // echo  "Result: " . $result;
        file_put_contents($realpath, $result);
    }
    $host = 'https://chatbot.tentstudy.xyz/';
    $image = "{$host}/API/{$pathImageSaved}";
    $bot->sendImage($image);
?>