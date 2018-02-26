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
}
