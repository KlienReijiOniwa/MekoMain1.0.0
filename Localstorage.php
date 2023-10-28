<?php

use PHPMailer\PHPMailer\PHPMailer;
  $connection = mysqli_connect('localhost','root');
      mysqli_select_db($connection,'enigma_apps');
        $query = "SELECT * FROM example";
        $rows=mysqli_query($connection, $query);

    if (isset($_POST['name']) && isset($_POST['subbody'])) {
        $name = $_POST['name'];
        $subject = $_POST['subject'];
        $subbody = $_POST['subbody'];
        $mbody = $_POST['mbody'];

        foreach($rows as $row){
            send_mail($row['email'], $row['name'], $subject, $subbody, $mbody);
            
        }

    }
function send_mail($to, $name, $subject, $subbody,$mbody){

 $format = "<style>"."@import url(https://fonts.googleapis.com/css?family=Roboto:400,700,400italic,700italic&subset=latin,cyrillic);".
'body, .wrapper {background-color: #ffffff;}'.'table {border-collapse: collapse;border-spacing: 0;}'.'.spacer,'.
'.border {font-size: 1px;line-height: 1px;}'.'.spacer {width: 100%;line-height: 16px}'.'.border {background-color: #e0e0e0;width: 1px;}'.
'.padded{padding: 0 24px;}'.'strong,  {font-weight: 300;}'.'.main {box-shadow: 0 1px 12px 0 rgba(0, 0, 0, 0.12), 0 1px 12px 0 rgba(0, 0, 0, 0.24);}'.'.columns {margin: 0 auto;width: 600px;background-color: #ffffff;font-size: 14px;}'.
'.content {width: 100%;}'.'.column-bottom {font-size: 8px;line-height: 8px;}'.'.content h1 {margin-top: 0;margin-bottom: 16px;color: #212121;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 20px;line-height: 28px;}'.
'.content p{margin-top: 0;margin-bottom: 16px;color: #212121;font-family: Roboto, Helvetica, sans-serif;font-weight: 400;font-size: 16px;line-height: 24px;}'.'.content .caption {color: #616161;font-size: 12px;line-height: 20px;}'.
'.signature, {vertical-align: bottom;width: 300px;padding-top: 8px;margin-bottom: 20px;text-align: left;}'.'</style>'.
'<body>'.'<center class="wrapper">'. '<table class="top-panel center" width="602" border="0" cellspacing="0" cellpadding="0">'.
'<tbody><tr><td style="text-align:center;font-size: 30px">Enigma Apps</td></tr><tr>'.
'<td class="border" colspan="2">&nbsp;</td></tr></tbody></table>'.
'<div class="spacer">&nbsp;</div>'.'<table class="main center" width="602" border="0" cellspacing="0" cellpadding="0">'.'<tbody><tr><td class="column"><div class="column-top">&nbsp;</div>'.
     '<table class="content" border="0" cellspacing="0" cellpadding="0">'.
    '<tbody><tr><td class="padded"><h1 id="i_1">'.$name.'</h1>'.
 '<p id="i_2">'.$mbody.'</p>'.
  '<p id=i_3  ><strong>'.$subbody.'</strong></p></div></td></tr></tbody></table>'.
 '<div class="column-bottom">&nbsp;</div></td></tr></tbody></table>'.

    '<div class="spacer">&nbsp;</div>'.
    '<table class="footer center" width="602" border="0" cellspacing="0" cellpadding="0">'.
        '<tbody><tr><td class="border" colspan="2">&nbsp;</td>'.
    '</tr><tr><td class="signature" width="300"> <p> With best regards,<br> Enigma Apps<br>Sheraz Ahmad<br></p></td>'.
'</tr></tbody></table></center></body></html>';


        require_once "PHPMailer/PHPMailer.php";
        require_once "PHPMailer/SMTP.php";
        require_once "PHPMailer/Exception.php";

        $mail = new PHPMailer();

        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "prtyprops@gmail.com";
        $mail->Password = 'partyprops123';
        $mail->Port = 465; //587
        $mail->SMTPSecure = "ssl"; //tls

        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom('prtyprops@gmail.com','Enigma Apps' );
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $format;

        if ($mail->send()) {
            $status = "success";
            $response = "Email is sent!";
        } else {
            $status = "failed";
            $response = "Something is wrong: <br><br>" . $mail->ErrorInfo;
        }

        print (json_encode(array("status" => $status, "response" => $response)));
    }
    
?>