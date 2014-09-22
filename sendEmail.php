<?php
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.klmchauffeurs.com';  // Specify main and backup server
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'enquiries@klmchauffeurs.com';                            // SMTP username
$mail->Password = 'Lucyfer79';
$mail->SMTPSecure = 'ssl'; 
$mail->Port = 465;
$mail->From = 'enquiries@klmchauffeurs.com';
$mail->FromName = 'Lukasz Kolomanski';
$mail->addAddress($_POST['email']);               // Name is optional
$mail->isHTML(true);
$mail->SMTPDebug = 2;
$mail->Debugoutput = 'html';

$mail->Subject = "KLM Chauffeurs";
$mail->Body = '<html>
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
        <a href="http://klmchauffeurs.com/wedding-and-special-events.html">Special Occasions</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/corporate.html">Corporate</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/booknow.html">Booking &amp; Payment</a>
      </div>
    </div>
  </div>
</body>
</html>';

if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}



$mail2 = new PHPMailer;

$mail2->isSMTP();                                      // Set mailer to use SMTP
$mail2->Host = 'smtp.klmchauffeurs.com';  // Specify main and backup server
$mail2->SMTPAuth = true;                               // Enable SMTP authentication
$mail2->Username = 'enquiries@klmchauffeurs.com';                            // SMTP username
$mail2->Password = 'Lucyfer79';
$mail2->SMTPSecure = 'ssl'; 
$mail2->Port = 465;
$mail2->From = 'enquiries@klmchauffeurs.com';
$mail2->FromName = 'Lukasz Kolomanski';
$mail2->addAddress('enquiries@klmchauffeurs.com');               // Name is optional
$mail2->isHTML(true);
$mail2->SMTPDebug = 2;
$mail2->Debugoutput = 'html';

$mail2->Subject = "New Booking";
$mail2->Body = '<html>
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



    <p>Hi Lukasz,</p>
    <p>You have a new booking from: '.$_POST['name'].' ('.$_POST['email'].'), below is their message</p>
    <p>'.$_POST['message'].'</p>
    <p>Pickup: '.$_POST['from'].'</p>
    <p>Phone: '.$_POST['phone'].'</p>
    <p>Dropoff: '.$_POST['to'].'</p>
    <p>Baggage: '.$_POST['baggage'].'</p>
    <p>Multiple Dropoff: '.$_POST['multi'].'</p>
    <p>People: '.$_POST['people'].'</p>
    <p>Pickup date: '.$_POST['pickup'].'</p>
    <p>Return date (optional): '.$_POST['return'].'</p>
    <p>Kind regards,</p>
    <p style="margin:0px; padding:0px;">Your website :)</p>
   


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
        <a href="http://klmchauffeurs.com/wedding-and-special-events.html">Special Occasions</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/corporate.html">Corporate</a>
        <span class="bullet"></span>
        <a href="http://klmchauffeurs.com/booknow.html">Booking &amp; Payment</a>
      </div>
    </div>
  </div>
</body>
</html>';

if (!$mail2->send()) {
    echo "Mailer Error: " . $mail2->ErrorInfo;
} else {
    echo "Message sent!";
}



?>