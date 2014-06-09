<?php
 require_once "Mail.php";
 require_once 'Mail/mime.php' ;


 $from = "Lukasz Kolomanski <enquiries@klmchauffeurs.com>";
 $to = $_POST['email'];
 $subject = "KLM Chauffeurs";
$crlf = "\n";
 $mime = new Mail_mime(array('eol' => $crlf));
 $html = '<html>
<head>
<style>
.bullet:before{
  content: " \\02022 ";
}
.footer div{
  margin-top: 35px;
}

.footer div a{
  

  color: #fff !important;
}

p{
color: #fff !important;
}
</style>
</head>
<body style="min-width:600px; background:  #141718; 


  font-weight: 300 !important; ">
  <div style="border-bottom: 1px solid #359dd6;height:40px;">
    <div style="float:left">
    <h1 style="font-weight:100;color: #1abc9c;
  margin: 0px;
  font-size: 30px;
  padding-right: 30px;"><b style="color: #359dd6;">KLM</b> Chauffeurs</h1>
    </div>
    <div style="float:right; text-decoration:none">
      <a href="tel:0044 1865 580 308"><h1 style="color: #1abc9c;
  margin: 0px;
  font-weight:100;
  font-size: 30px;
  padding-right: 30px;">0044 1865 580 308</h1></a>
    </div>
  </div>
  <div style="min-height:200px;">
    <p style="color: #fff !important; font-family: HelveticaNeue; padding:10px;">



    <p>Hi '.$_POST['name'].',</p>
    <p>Thank you for booking with us. Someone will contact you shortly to arrange your journey.</p>
    <p>Kind regards,</p>
    <p style="margin:0px; padding:0px;">Lukasz Kolomanski</p>
   


    </p>
  </div>
  <div style="border-top: 1px solid #359dd6;">
    <div class="footer" style=" -moz-box-shadow:    inset 0 0 20px #000000;
   -webkit-box-shadow: inset 0 0 20px #000000;
   box-shadow:         inset 0 0 20px #000000; background:  #8E8E93 !important;
   min-height: 100px;
   border-top:  3px solid #359dd6 !important;
   text-align: center;
   font-size: 25px;">
      <div>
      <a href="http://klmchauffeurs.com/">Home</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/fleet.html">Fleet</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/airport-transfers.html">Airport Transfers</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/wedding-and-special-events.html">Special Ocassions</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/corporate.html">Corporate</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/booknow.html">Book Now</a>
      </div>
    </div>
  </div>
</body>
</html>';

 $mime->setHTMLBody($html);
 $body = $mime->get();
 $host = "smtp.klmchauffeurs.com";
 $username = "enquiries@klmchauffeurs.com";
 $password = "Lucyfer79";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);

$headers = $mime->headers($headers);

 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => 'PLAIN',
     'port'=> 25,
    
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);
  if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }


$from = "New Booking <enquiries@klmchauffeurs.com>";
 $to = "Lukasz Kolomanski <enquiries@klmchauffeurs.com>";
 $subject = "New Booking";
$crlf = "\n";
 $mime = new Mail_mime(array('eol' => $crlf));
 $html = '<html>
        <body>
        <h1>From:</h1>
        <p>'.$_POST['name'].' - '.$_POST['email'].'</p>
        <h1>Message:</h1>
        <p>'.$_POST['message'].'</p>
        </body>

 </html>';

 $mime->setHTMLBody($html);
 $body = $mime->get();
 $host = "smtp.klmchauffeurs.com";
 $username = "enquiries@klmchauffeurs.com";
 $password = "Lucyfer79";
 
 $headers = array ('From' => $from,
   'To' => $to,
   'Subject' => $subject);

$headers = $mime->headers($headers);

 $smtp = Mail::factory('smtp',
   array ('host' => $host,
     'auth' => 'PLAIN',
     'port'=> 25,
     
     'username' => $username,
     'password' => $password));
 
 $mail = $smtp->send($to, $headers, $body);;
 if (PEAR::isError($mail)) {
   echo("<p>" . $mail->getMessage() . "</p>");
  } else {
   echo("<p>Message successfully sent!</p>");
  }


 ?>