<?php
    if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['company']) || !isset($_POST['city']) || !isset($_POST['message']) || !isset($_POST['nop']) || !isset($_POST['papersize'])
      || strlen($_POST['name']) == 0 || strlen($_POST['email']) == 0 || strlen($_POST['phone']) == 0 || strlen($_POST['company']) == 0 || strlen($_POST['city']) == 0 || strlen($_POST['message']) == 0 || strlen($_POST['nop']) == 0 || strlen($_POST['papersize']) == 0)
    {
        echo "All fields are required!";
        die();
    }

    $emailToReceive = "digitize@infasme.com";
    $password = "Infas@123";
    
    $formName = $_POST["name"];
    $formEmail = $_POST["email"];
    $formPhone = $_POST["phone"];
    $formMessage = $_POST["message"];
    $formCompany = $_POST["company"];
    $formCity = $_POST["city"];
    $formNop = $_POST["nop"];
    $formPaper = $_POST["papersize"];

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp, $formEmail)) 
    {
        echo "Invalid Email.";
        die();
    }
    
    if(!is_numeric($formPhone)) 
    {
        echo "Invalid Phone Number.";
        die();
    }

    $emailHtml = '<header style="margin: 0; padding: 0; width: 100%; background-color: #281557">
		<img style="" src="cid:logo">
	</header>
	<section style="margin-top: 40px; overflow: visible;">
		<h2 style="Margin-top: 0; Margin-bottom: 25px;font-style: normal;font-weight: 400;color: #e31212;font-size: 30px;line-height: 38px;font-family: Helvetica,pt serif,constantia,georgia,serif;overflow-wrap: break-word; word-break: break-word; word-wrap: break-word;">
			<span style="text-overflow: ellipsis; font-weight: 500;">Form Data</span>
		</h2>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Name: '.$formName.'&nbsp;</h3>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">E-mail: '.$formEmail.'&nbsp;</h3>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Phone Number: '.$formPhone.'&nbsp;</h3>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Company: '.$formCompany.'&nbsp;</h3>
        <h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Number of Papers: '.$formNop.'&nbsp;</h3>
        <h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Papersize: '.$formPaper.'&nbsp;</h3>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">City: '.$formCity.'&nbsp;</h3>
		<h3 style="Margin-top: 0;Margin-bottom: 18px;text-align:font-style: normal;font-weight: normal;color: #281557;font-size: 24px;line-height: 26px;font-family: Avenir,sans-serif;">Message: '.$formMessage.'&nbsp;</h3>';

    
    require_once('PHPMailer/PHPMailerAutoload.php');

    // Configuring SMTP server settings
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = 'smtp-mail.outlook.com:587';
    $mail->SMTPOptions = array(
       'ssl' => array(
         'verify_peer' => false,
         'verify_peer_name' => false,
         'allow_self_signed' => true
        )
    );
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = $emailToReceive;
    $mail->Password = $password;

    // Email Sending Details
    $mail->From = $emailToReceive;
    $mail->addAddress($emailToReceive);
    $mail->AddReplyTo($emailToReceive);
    $mail->Subject = "$formName sent a contact form from DigitizeME";
    $mail->msgHTML($emailHtml);
    $mail->AddEmbeddedImage('../imgs/logo.png', 'logo');

    if (!$mail->send()) 
    {
        echo "An error occurred. Please try again later.";
    }
    else 
    {
        echo "OK";
    }
?>