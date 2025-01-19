<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require "connexion.php";

    $req = mysqli_query($con,"SELECT * FROM personnel WHERE id_perso = '$perso'");
    $row = mysqli_fetch_assoc($req);
    $mailer = $row["email"];
    $dear = $row["nom_perso"];
    require_once "assets/PHPMailer/src/SMTP.PHP";
    require_once "assets/PHPMailer/src/Exception.php";
    require_once "assets/PHPMailer/src/PHPMailer.php";
    $mailer = trim($mailer);
    $dear = trim(preg_replace('/[\r\n]+/', '', $dear)); //Strip breaks and trim
   
   $mail = new PHPMailer(true);
   try {
       //Server settings
       $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
       $mail->isSMTP();                                            //Send using SMTP
       $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
       $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
       $mail->Username   = 'kolatd50@gmail.com';             //SMTP username
       $mail->Password   = 'kexnjasgzcqdggqo';              //SMTP password
       $mail->SMTPSecure = 'tls';                           //Enable implicit TLS encryption
       $mail->Port= 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
       $mail->CharSet = "utf-8";                            //Recipients
       $mail->setFrom('kolatd50@gmail.com','AFRICAS SERVICES');
       $mail->addAddress($mailer,$dear);     //Add a recipient Content
       $mail->isHTML(true);                                  //Set email format to HTML
       $mail->Subject = 'Nouvelle tâche';
       $mail->Body    = 'Une nouvelle tache vous a été attribué</br>';
       $mail->SMTPDebug = 0;
       $mail->send();
       echo 'Message has been sent';
   } catch (Exception $e) {
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }

