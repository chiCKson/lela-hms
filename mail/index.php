<?php
require_once('con/con.php'); 
require_once('class.smtp.php');
require_once('class.phpmailer.php');
function sendmail($to,$nameto,$subject,$message,$altmess)  {
  $from  = "info@ictcs.lk";
  $namefrom = "Information & Communication Technology and Computing Society";
  $mail = new PHPMailer();  
  $mail->CharSet = 'UTF-8';
  $mail->isSMTP();   // by SMTP
  $mail->SMTPAuth   = true;   // user and password
  $mail->Host       = "mail.ictcs.lk";
  $mail->Port       = 465;
  $mail->Username   = $from;  
  $mail->Password   = "Ictcsvc@2019";
  $mail->SMTPSecure = "ssl";    // options: 'ssl', 'tls' , ''  
  $mail->setFrom($from,$namefrom);   // From (origin)
     // There is also addBCC
  $mail->Subject  = $subject;
  $mail->AltBody  = $altmess;
  $mail->Body = $message;
  $mail->isHTML();   // Set HTML type
//$mail->addAttachment("attachment");  
  $mail->addAddress($to, $nameto);
  return $mail->send();
}
?>

<!DOCTYPE html>
<html lang="en" >
<head>
<script>
    location.href="../soon/index"
    </script>
  <meta charset="UTF-8">
  <title>Twists N' Turns</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" 
      type="image/png" 
      href="/img/twists.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel="stylesheet" href="./css/register.css">
</head>
<script>
function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}
</script>
<body>
<!-- partial:index.partial.html -->
<!-- multistep form -->
<form id="msform" action="/register/index" method="POST">
  <!-- progressbar -->
  <ul id="progressbar">
    <li class="active">Personal Informations</li>
    <li>Contact Informations</li>
    <li>Rationale</li>
  </ul>
  <!-- fieldsets -->
  <fieldset>
    <h2 class="fs-title">Personal Information</h2>
    <?php
  
if(isset($_POST['email'])){
    $db = new DB();
     
    
    $sub="Registered Successfully for Twists n Turns 2019";
    $msg="<html><head>";
    $msg.='<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">';
    $msg.="</head><body><center>";
    $msg.='<div style="color:grey"><img src="twistsnturns.ictcs.lk/img/twists.png" width="200px" ><br>  ';
    $msg.="Dear ".$_POST['fullName'].",<br>";
    $msg.="We recieved your registration for Twists N Turns 2019 powered by Insfra Technologies.<br>
    Please keep in mind since the seats are limited, Only few will be selected among the all regestrations.<br>";
    $msg.="You will get a ticket if you are selected, please keep in touch.<br>";
    $msg.="<span style='color:red'><strong> We are hoping to provide accommodations to those who required. Further informations will be given in future.</span> </strong><br>";
    $msg.="For further purpose please fill the following form to know about your background.<br> It will help us to conduct the event more suitable for you.<br>https://forms.gle/UFkkYghweJuteemW8 <br>Thank You!";
    $msg.='</div></center>';
    $msg.="</html>";
    $conn = $db->connect();
    if($db->newParticipant($conn,$_POST['fullName'],$_POST['nic'],$_POST['university'],$_POST['email'],
    $_POST['tshirt'],$_POST['food'],$_POST['mobile'],$_POST['github'],$_POST['linkedin'],$_POST['facebook'],$_POST['whyus'],$_POST['whyyou'],$_POST['track'])){
      sendmail($_POST['email'],$_POST['fullName'],$sub,$msg,'') ;
    }
    $db->disconnect($conn);
  
}else{
    echo '<h3 class="fs-subtitle" id="error">Your personal information to register in Twists N\' Turns</h3>';
}
?>
  
    <input type="text" id="fullName" name="fullName"  placeholder="Enter your full name" />
    <input type="text" id="nic" name="nic" placeholder="Enter your NIC" Number />
    <input type="text" id="university" name="university" placeholder="Your University" />
    <select id="tshirt" name="tshirt">
        <option value="no" >Select Tshirt Size</option>
        <option value="XS">XS</option>
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
        <option value="XXL">XXL</option>
    </select>
    <select id="food" name="food">
        <option value="no">Select Food preference</option>
        <option value="veg">Veg</option>
        <option value="non-veg">Non-Veg</option>
        
    </select>
    <select id="track" name="track">
        <option value="no">Select your Track</option>
        <option value="A">Track A - Networking & Cyber Security</option>
        <option value="B">Track B - IT Dev</option>
        <option value="C">Track C - Mobile Dev</option>
        <option value="D">Track D - AI & Big Data</option>
        <option value="E">Track E - AR,VR & WebXR</option>
    </select>
    <input type="button" name="next" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Contact Informations</h2>
    <h3 class="fs-subtitle" id="error2">Your Contact details</h3>
    <input type="text" id="email" name="email" placeholder="Email" />
    <input type="text" id="mobile" name="mobile" placeholder="Mobile Number" />
    <input type="text" id="github" name="github" placeholder="Github Profile Link" />
    <input type="text" id="linkedin" name="linkedin" placeholder="LinkedIn Profile Link" />
    <input type="text" id="facebook" name="facebook" placeholder="Facebook Profile Link" />
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="button" name="next2" class="next action-button" value="Next" />
  </fieldset>
  <fieldset>
    <h2 class="fs-title">Rationale</h2>
    <h3 class="fs-subtitle">Final Step</h3>
    <textarea  onkeyup="auto_grow(this)" style="height:50px" name="whyus" id="whyus" placeholder="Why You select this event to participate?"></textarea>
    <textarea  onkeyup="auto_grow(this)" style="height:50px" name="whyyou" id="whyyou" placeholder="Why we select you for this event?"></textarea>
    <input type="button" name="previous" class="previous action-button" value="Previous" />
    <input type="submit" name="submit" class="submit action-button" value="Submit" />
  </fieldset>
</form>
<!-- partial -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js'></script>

<script  src="./js/register.js"></script>

</body>

</html>
