<?php
   session_start();
   $mail = "carszerprojekt@gmail.com";
   $mailfrom = $_POST['email'];
   $text = $_POST['message'];
   $subject = $_POST['subject'];

   if(isset($_POST['submit'])){
      $url = "https://script.google.com/macros/s/AKfycbwsspDEmFVR6Yh3xPUbjwhIDqVjm42GhgNQsIb6bg6sS-sr3_IqEG6QzgNDFhJj-Yqc/exec";
      //$url = "https://script.google.com/macros/s/AKfycbwj3BNwGNiRVG33O8m_ToNYUa_v7-ihRAbc-2A9mWOhBwFPR-3dFOtXxkaYC2oKRU0/exec";
      $ch = curl_init($url);
      curl_setopt_array($ch, 
      [
         CURLOPT_RETURNTRANSFER => true,
         CURLOPT_FOLLOWLOCATION => true,
         CURLOPT_POSTFIELDS => http_build_query
         ([
            "recipient" => $mail,
            "subject"   => "Pytanie od: ".$mailfrom,
            "body"      => "Temat: ".$subject. "\n"."Treść: ". $text
         ])
      ]);
      $result = curl_exec($ch);
      }
      header('Location:contactOK.php');


?>
   