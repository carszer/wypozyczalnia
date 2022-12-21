<?php 
session_start();
    require_once "connect.php";
    $poloczenie = new mysqli($host,$db_user,$db_pass,$db_name);  
    if($poloczenie->connect_errno!=0)   
    {
    echo "Error: ".$poloczenie->connect_errno." Opis: ".$poloczenie->connect_error;
    }else{
          $email = $_POST['mail'];
          $subject = "Kod odzyskiwania hasła";
          $sql = "SELECT * from users where email='$email'"; 
                if($rezultat = @$poloczenie->query($sql)){
                    $zalogowane = $rezultat->num_rows;
                    if($zalogowane>0)
                    {
                     $_SESSION['resetowany'] = true;
                     unset($_SESSION['error']);
                     $kod = mt_rand(100000,999999);
                     $sql2="UPDATE users SET kod='$kod' WHERE email='$email'";
                     $rezultat2 = @$poloczenie->query($sql2); 
                     
                     if(isset($_POST['submit'])){
                        $url = "https://script.google.com/macros/s/AKfycbwj3BNwGNiRVG33O8m_ToNYUa_v7-ihRAbc-2A9mWOhBwFPR-3dFOtXxkaYC2oKRU0/exec";
                        $ch = curl_init($url);
                        curl_setopt_array($ch, 
                        [
                           CURLOPT_RETURNTRANSFER => true,
                           CURLOPT_FOLLOWLOCATION => true,
                           CURLOPT_POSTFIELDS => http_build_query
                           ([
                              "recipient" => $_POST['mail'],
                              "subject"   => $subject,
                              "body"      => "Twój kod odzyskiwania hasła do carszer to: ".$kod
                           ])
                        ]);
                        $result = curl_exec($ch);
                        }


                     $rezultat->free_result();     
                     header('Location:changePass.php');
                     }else{
                        $_SESSION['error'] = 'nie ma takiego maila w bazie';    
                        header('Location: recoverPass.php');
                    }
                }
                $poloczenie->close();  
               }
?>

<?php
/*
   if(isset($_POST['submit'])){
   $url = "https://script.google.com/macros/s/AKfycbwj3BNwGNiRVG33O8m_ToNYUa_v7-ihRAbc-2A9mWOhBwFPR-3dFOtXxkaYC2oKRU0/exec";
   $ch = curl_init($url);
   curl_setopt_array($ch, 
   [
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_POSTFIELDS => http_build_query
      ([
         "recipient" => $_POST['email'],
         "subject"   => $_POST['subject'],
         "body"      => $_POST['body']
      ])
   ]);
   $result = curl_exec($ch);
   }
*/
?>
   