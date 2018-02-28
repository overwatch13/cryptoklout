<?php

class Email{
  function sendEmail($sendTo, $subject, $htmlMessage){
    $to=$sendTo;
    $subject=$subject;
    $message=$htmlMessage;
    // "
    // <html>
    // <header>My First HTML email is here</header>
    // <body>
    // <h1>This is the H1 tag title here</h1>
    // <p>
    // This is thetest message that I have put in a paragraph.
    // </p>
    // </body>
    // </html>";//—————-end of the message
    $headers = 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; // this will set the media type to HTML
    $headers .= 'From: CryptoKlout Email Registration <no-reply@cryptoklout.com>' . "\r\n";
    mail($to,$subject,$message,$headers);
  }

  function sendWarningToAdmin($messageIncoming){
    $message=
    "
    <html>
    <body>
    <h4>Cryptoklout error message</h4>
    <p>
    ".$messageIncoming."
    </p>
    </body>
    </html>";//—————-end of the message
    $headers = 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; // this will set the media type to HTML
    $headers .= 'From: CryptoKlout Error Message <no-reply@cryptoklout.com>' . "\r\n";
    mail("williamhowley@gmail.com","cryptoklout issue",$message,$headers);
    return "Success";
  }

  function sendConfirmationEmail($email, $hashVerificationToken){
    $register_link = "http://".$_SERVER['SERVER_NAME']."?isActive=Yes&activate=" . base64_encode($email) . "&hashVerificationToken=". $hashVerificationToken;
    $to = $email;
    $subject = "CryptoKlout User Registration Activation Email";
    $content = "Click this link to activate your CryptoKlout account. <a href='" . $register_link . "'>" . $register_link . "</a>";

    // Send out the email
    $headers = 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: CryptoKlout Email Registration <no-reply@cryptoklout.com>' . "\r\n";
    mail($to,$subject,$content,$headers); // this should be $content,
  }

  function sendForgotPasswordEmail($email, $hashVerificationToken){
    $register_link = "http://".$_SERVER['SERVER_NAME']."?forgot=Yes&id=" . base64_encode($email) . "&hashVerificationToken=". $hashVerificationToken;;
    $to = $email;
    $subject = "CryptoKlout Forgot Password Recovery";
    $content = "Click this link to reset your CryptoKlout password. <a href='" . $register_link . "'>" . $register_link . "</a>";

    // Send out the email
    $headers = 'MIME-Version: 1.0' . "\r\n". 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: CryptoKlout Forgot Password Recovery <no-reply@cryptoklout.com>' . "\r\n";
    mail($to,$subject,$content,$headers); // this should be $content,
  }
}
