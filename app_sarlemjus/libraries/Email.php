<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Email
{

	// function notif()
	// {
	// 	use PHPMailer\PHPMailer\PHPMailer;
	// 	use PHPMailer\PHPMailer\SMTP;
	// 	use PHPMailer\PHPMailer\Exception;

	// 	require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
	// 	require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
	// 	require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

	// 	// passing true in constructor enables exceptions in PHPMailer
	// 	$mail = new PHPMailer(true);

	// 	try {
	// 		// Server settings
	// 		$mail->SMTPDebug = SMTP::DEBUG_SERVER; // for detailed debug output
	// 		$mail->isSMTP();
	// 		$mail->Host = 'smtp.gmail.com';
	// 		$mail->SMTPAuth = true;
	// 		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
	// 		$mail->Port = 587;

	// 		$mail->Username = 'example@gmail.com'; // YOUR gmail email
	// 		$mail->Password = 'YOUR_GMAIL_PASSWORD'; // YOUR gmail password

	// 		// Sender and recipient settings
	// 		$mail->setFrom('example@gmail.com', 'Sender Name');
	// 		$mail->addAddress('phppot@example.com', 'Receiver Name');
	// 		$mail->addReplyTo('example@gmail.com', 'Sender Name'); // to set the reply to

	// 		// Setting the email content
	// 		$mail->IsHTML(true);
	// 		$mail->Subject = "Send email using Gmail SMTP and PHPMailer";
	// 		$mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
	// 		$mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';

	// 		$mail->send();
	// 		echo "Email message sent.";
	// 	} catch (Exception $e) {
	// 		echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
	// 	}
	// }

	// $config = Array(
	// 	'protocol' => 'smtp',
	// 	'smtp_host' => 'ssl://smtp.googlemail.com',
	// 	'smtp_port' => 465,
	// 	'smtp_user' => 'xxx',
	// 	'smtp_pass' => 'xxx',
	// 	'mailtype'  => 'html', 
	// 	'charset'   => 'iso-8859-1'
	// 	);
	// 	$this->load->library('email', $config);
	// 	$this->email->set_newline("\r\n");
		
	// 	// Set to, from, message, etc.
		
	// 	$result = $this->email->send();

	function send($to, $subject, $message, $from = null, $nama = null)
	{

		$ci = &get_instance();
		$ci->load->library('email');

		$message = $this->viewEmail($message);

		$config['protocol']		= "smtps";
		$config['smtp_host'] 	= "ssl://smtp.gmail.com";
		$config['smtp_port'] 	= "465";
		$config['smtp_user'] 	= "noreply.dev.std@gmail.com";
		$config['smtp_pass'] 	= "Yogi@jowo";
		$config['charset'] 		= "utf-8";
		$config['mailtype'] 	= "html";
		$config['newline'] 		= "\r\n";
		$config['wordwrap'] 	= TRUE;

		$ci->email->initialize($config);

		if ($from != null) {
			$ci->email->from($from, $nama);
		} else {
			$ci->email->from('noreply.dev.std@gmail.com', 'noreply.dev.std@gmail.com');
		}

		$ci->email->to($to);
		$ci->email->subject($subject);
		$ci->email->message($message);

		if ($ci->email->send()) {
			return true;
		} else {
			return false;
		}
	}


	function viewEmail($message)
	{

		return "
	<!doctype html>
<html xmlns='http://www.w3.org/1999/xhtml' xmlns:v='urn:schemas-microsoft-com:vml' xmlns:o='urn:schemas-microsoft-com:office:office'>

	<head>
		<!-- NAME: 1 COLUMN -->
		<!--[if gte mso 15]>
		<xml>
			<o:OfficeDocumentSettings>
			<o:AllowPNG/>
			<o:PixelsPerInch>96</o:PixelsPerInch>
			</o:OfficeDocumentSettings>
		</xml>
		<![endif]-->
		<meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
		<title>*|MC:SUBJECT|*</title>

    <style type='text/css'>
		p{
			margin:10px 0;
			padding:0;
		}
		table{
			border-collapse:collapse;
		}
		h1,h2,h3,h4,h5,h6{
			display:block;
			margin:0;
			padding:0;
		}
		img,a img{
			border:0;
			height:auto;
			outline:none;
			text-decoration:none;
		}
		body,#bodyTable,#bodyCell{
			height:100%;
			margin:0;
			padding:0;
			width:100%;
		}

		#outlook a{
			padding:0;
		}

		img{
			-ms-interpolation-mode:bicubic;
		}

		table{
			mso-table-lspace:0pt;
			mso-table-rspace:0pt;
		}

		.ReadMsgBody{
			width:100%;
		}

		.ExternalClass{
			width:100%;
		}

		p,a,li,td,blockquote{
			mso-line-height-rule:exactly;
		}

		a[href^=tel],a[href^=sms]{
			color:inherit;
			cursor:default;
			text-decoration:none;
		}

		p,a,li,td,body,table,blockquote{
			-ms-text-size-adjust:100%;
			-webkit-text-size-adjust:100%;
		}

		.ExternalClass,.ExternalClass p,.ExternalClass td,.ExternalClass div,.ExternalClass span,.ExternalClass font{
			line-height:100%;
		}

		a[x-apple-data-detectors]{
			color:inherit !important;
			text-decoration:none !important;
			font-size:inherit !important;
			font-family:inherit !important;
			font-weight:inherit !important;
			line-height:inherit !important;
		}

		#bodyCell{
			padding:10px;

		}

		.templateContainer{
			max-width:600px !important;
		}

		a.mcnButton{
			display:block;
		}

		.mcnImage{
			vertical-align:bottom;
		}

		.mcnTextContent{

			word-break:break-word;

		}

		.mcnTextContent img{

			height:auto !important;

		}

		.mcnDividerBlock{

			table-layout:fixed !important;

		}

	/*

	@tab Page

	@section Background Style

	@tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.

	*/

		body,#bodyTable{

			/*@editable*/background-color:#FAFAFA;

		}

	/*

	@tab Page

	@section Background Style

	@tip Set the background color and top border for your email. You may want to choose colors that match your company's branding.

	*/

		#bodyCell{

			/*@editable*/border-top:0;

		}

	/*

	@tab Page

	@section Email Border

	@tip Set the border for your email.

	*/

		.templateContainer{

			/*@editable*/border:0;

		}

	/*

	@tab Page

	@section Heading 1

	@tip Set the styling for all first-level headings in your emails. These should be the largest of your headings.

	@style heading 1

	*/

		h1{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:26px;

			/*@editable*/font-style:normal;

			/*@editable*/font-weight:bold;

			/*@editable*/line-height:32px;

			/*@editable*/letter-spacing:normal;

			/*@editable*/text-align:left;

		}

	/*

	@tab Page

	@section Heading 2

	@tip Set the styling for all second-level headings in your emails.

	@style heading 2

	*/

		h2{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:22px;

			/*@editable*/font-style:normal;

			/*@editable*/font-weight:bold;

			/*@editable*/line-height:30px;

			/*@editable*/letter-spacing:normal;

			/*@editable*/text-align:left;

		}

	/*

	@tab Page

	@section Heading 3

	@tip Set the styling for all third-level headings in your emails.

	@style heading 3

	*/

		h3{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:20px;

			/*@editable*/font-style:normal;

			/*@editable*/font-weight:bold;

			/*@editable*/line-height:26px;

			/*@editable*/letter-spacing:normal;

			/*@editable*/text-align:left;

		}

	/*

	@tab Page

	@section Heading 4

	@tip Set the styling for all fourth-level headings in your emails. These should be the smallest of your headings.

	@style heading 4

	*/

		h4{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:18px;

			/*@editable*/font-style:normal;

			/*@editable*/font-weight:bold;

			/*@editable*/line-height:24px;

			/*@editable*/letter-spacing:normal;

			/*@editable*/text-align:left;

		}

	/*

	@tab Preheader

	@section Preheader Style

	@tip Set the background color and borders for your email's preheader area.

	*/

		#templatePreheader{

			/*@editable*/background-color:#FAFAFA;

			/*@editable*/border-top:0;

			/*@editable*/border-bottom:0;

			/*@editable*/padding-top:9px;

			/*@editable*/padding-bottom:9px;

		}

	/*

	@tab Preheader

	@section Preheader Text

	@tip Set the styling for your email's preheader text. Choose a size and color that is easy to read.

	*/

		#templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{

			/*@editable*/color:#656565;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:12px;

			/*@editable*/line-height:18px;

			/*@editable*/text-align:left;

		}

	/*

	@tab Preheader

	@section Preheader Link

	@tip Set the styling for your email's preheader links. Choose a color that helps them stand out from your text.

	*/

		#templatePreheader .mcnTextContent a,#templatePreheader .mcnTextContent p a{

			/*@editable*/color:#656565;

			/*@editable*/font-weight:normal;

			/*@editable*/text-decoration:underline;

		}

	/*

	@tab Header

	@section Header Style

	@tip Set the background color and borders for your email's header area.

	*/

		#templateHeader{

			/*@editable*/background-color:#FFFFFF;

			/*@editable*/border-top:0;

			/*@editable*/border-bottom:0;

			/*@editable*/padding-top:9px;

			/*@editable*/padding-bottom:0;

		}

	/*

	@tab Header

	@section Header Text

	@tip Set the styling for your email's header text. Choose a size and color that is easy to read.

	*/

		#templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:16px;

			/*@editable*/line-height:24px;

			/*@editable*/text-align:left;

		}

	/*

	@tab Header

	@section Header Link

	@tip Set the styling for your email's header links. Choose a color that helps them stand out from your text.

	*/

		#templateHeader .mcnTextContent a,#templateHeader .mcnTextContent p a{

			/*@editable*/color:#2BAADF;

			/*@editable*/font-weight:normal;

			/*@editable*/text-decoration:underline;

		}

	/*

	@tab Body

	@section Body Style

	@tip Set the background color and borders for your email's body area.

	*/

		#templateBody{

			/*@editable*/background-color:#FFFFFF;

			/*@editable*/border-top:0;

			/*@editable*/border-bottom:2px solid #EAEAEA;

			/*@editable*/padding-top:0;

			/*@editable*/padding-bottom:9px;

		}

	/*

	@tab Body

	@section Body Text

	@tip Set the styling for your email's body text. Choose a size and color that is easy to read.

	*/

		#templateBody .mcnTextContent,#templateBody .mcnTextContent p{

			/*@editable*/color:#202020;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:16px;

			/*@editable*/line-height:24px;

			/*@editable*/text-align:left;

		}

	/*

	@tab Body

	@section Body Link

	@tip Set the styling for your email's body links. Choose a color that helps them stand out from your text.

	*/

		#templateBody .mcnTextContent a,#templateBody .mcnTextContent p a{

			/*@editable*/color:#2BAADF;

			/*@editable*/font-weight:normal;

			/*@editable*/text-decoration:underline;

		}

	/*

	@tab Footer

	@section Footer Style

	@tip Set the background color and borders for your email's footer area.

	*/

		#templateFooter{

			/*@editable*/background-color:#FAFAFA;

			/*@editable*/border-top:0;

			/*@editable*/border-bottom:0;

			/*@editable*/padding-top:9px;

			/*@editable*/padding-bottom:9px;

		}

	/*

	@tab Footer

	@section Footer Text

	@tip Set the styling for your email's footer text. Choose a size and color that is easy to read.

	*/

		#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{

			/*@editable*/color:#656565;

			/*@editable*/font-family:Helvetica;

			/*@editable*/font-size:12px;

			/*@editable*/line-height:18px;

			/*@editable*/text-align:center;

		}

	/*

	@tab Footer

	@section Footer Link

	@tip Set the styling for your email's footer links. Choose a color that helps them stand out from your text.

	*/

		#templateFooter .mcnTextContent a,#templateFooter .mcnTextContent p a{

			/*@editable*/color:#656565;

			/*@editable*/font-weight:normal;

			/*@editable*/text-decoration:underline;

		}

	@media only screen and (min-width:768px){

		.templateContainer{

			width:600px !important;

		}



}	@media only screen and (max-width: 480px){

		body,table,td,p,a,li,blockquote{

			-webkit-text-size-adjust:none !important;

		}



}	@media only screen and (max-width: 480px){

		body{

			width:100% !important;

			min-width:100% !important;

		}



}	@media only screen and (max-width: 480px){

		#bodyCell{

			padding-top:10px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImage{

			width:100% !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnShareContent,.mcnCaptionTopContent,.mcnCaptionBottomContent,.mcnTextContentContainer,.mcnBoxedTextContentContainer,.mcnImageGroupContentContainer,.mcnCaptionLeftTextContentContainer,.mcnCaptionRightTextContentContainer,.mcnCaptionLeftImageContentContainer,.mcnCaptionRightImageContentContainer,.mcnImageCardLeftTextContentContainer,.mcnImageCardRightTextContentContainer{

			max-width:100% !important;

			width:100% !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnBoxedTextContentContainer{

			min-width:100% !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageGroupContent{

			padding:9px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnCaptionLeftContentOuter .mcnTextContent,.mcnCaptionRightContentOuter .mcnTextContent{

			padding-top:9px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageCardTopImageContent,.mcnCaptionBlockInner .mcnCaptionTopContent:last-child .mcnTextContent{

			padding-top:18px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageCardBottomImageContent{

			padding-bottom:9px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageGroupBlockInner{

			padding-top:0 !important;

			padding-bottom:0 !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageGroupBlockOuter{

			padding-top:9px !important;

			padding-bottom:9px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnTextContent,.mcnBoxedTextContentColumn{

			padding-right:18px !important;

			padding-left:18px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcnImageCardLeftImageContent,.mcnImageCardRightImageContent{

			padding-right:18px !important;

			padding-bottom:0 !important;

			padding-left:18px !important;

		}



}	@media only screen and (max-width: 480px){

		.mcpreview-image-uploader{

			display:none !important;

			width:100% !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Heading 1

	@tip Make the first-level headings larger in size for better readability on small screens.

	*/

		h1{

			/*@editable*/font-size:22px !important;

			/*@editable*/line-height:28px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Heading 2

	@tip Make the second-level headings larger in size for better readability on small screens.

	*/

		h2{

			/*@editable*/font-size:20px !important;

			/*@editable*/line-height:26px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Heading 3

	@tip Make the third-level headings larger in size for better readability on small screens.

	*/

		h3{

			/*@editable*/font-size:18px !important;

			/*@editable*/line-height:24px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Heading 4

	@tip Make the fourth-level headings larger in size for better readability on small screens.

	*/

		h4{

			/*@editable*/font-size:16px !important;

			/*@editable*/line-height:22px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Boxed Text

	@tip Make the boxed text larger in size for better readability on small screens. We recommend a font size of at least 16px.

	*/

		.mcnBoxedTextContentContainer .mcnTextContent,.mcnBoxedTextContentContainer .mcnTextContent p{

			/*@editable*/font-size:14px !important;

			/*@editable*/line-height:22px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Preheader Visibility

	@tip Set the visibility of the email's preheader on small screens. You can hide it to save space.

	*/

		#templatePreheader{

			/*@editable*/display:block !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Preheader Text

	@tip Make the preheader text larger in size for better readability on small screens.

	*/

		#templatePreheader .mcnTextContent,#templatePreheader .mcnTextContent p{

			/*@editable*/font-size:14px !important;

			/*@editable*/line-height:22px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Header Text

	@tip Make the header text larger in size for better readability on small screens.

	*/

		#templateHeader .mcnTextContent,#templateHeader .mcnTextContent p{

			/*@editable*/font-size:16px !important;

			/*@editable*/line-height:24px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Body Text

	@tip Make the body text larger in size for better readability on small screens. We recommend a font size of at least 16px.

	*/

		#templateBody .mcnTextContent,#templateBody .mcnTextContent p{

			/*@editable*/font-size:16px !important;

			/*@editable*/line-height:24px !important;

		}



}	@media only screen and (max-width: 480px){

	/*

	@tab Mobile Styles

	@section Footer Text

	@tip Make the footer content text larger in size for better readability on small screens.

	*/

		#templateFooter .mcnTextContent,#templateFooter .mcnTextContent p{

			/*@editable*/font-size:14px !important;

			/*@editable*/line-height:22px !important;

		}



}</style></head>

    <body>

        <center>

            <table align='center' border='0' cellpadding='0' cellspacing='0' height='100%' width='100%' id='bodyTable'>

                <tr>

                    <td align='center' valign='top' id='bodyCell'>

                        <!-- BEGIN TEMPLATE // -->

						<!--[if gte mso 9]>

						<table align='center' border='0' cellspacing='0' cellpadding='0' width='600' style='width:600px;'>

						<tr>

						<td align='center' valign='top' width='600' style='width:600px;'>

						<![endif]-->

                        <table border='0' cellpadding='0' cellspacing='0' width='100%' class='templateContainer'>

                            <tr>

                                <td valign='top' id='templatePreheader'></td>

                            </tr>

                            <tr>

                                <td valign='top' id='templateHeader'><table class='mcnImageBlock' style='min-width:100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnImageBlockOuter'>

            <tr>

                <td style='padding:9px' class='mcnImageBlockInner' valign='top'>

                    <table class='mcnImageContentContainer' style='min-width:100%;' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

                        <tbody><tr>

                            <td class='mcnImageContent' style='padding-right: 9px; padding-left: 9px; padding-top: 0; padding-bottom: 0; text-align:center;' valign='top'>                                                                                                      

                                    

                                

                            </td>

                        </tr>

                    </tbody></table>

                </td>

            </tr>

    </tbody>

</table><table class='mcnTextBlock' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnTextBlockOuter'>

        <tr>

            <td class='mcnTextBlockInner' valign='center'>

                

                <table class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

                    <tbody><tr>

                        

                        <td class='mcnTextContent' style='padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;' valign='center'>

							<center>

                            <div style='text-align: center;'><span style='font-size:12px'><span style='font-family:tahoma,verdana,segoe,sans-serif'><strong>Sekolah Bisnis Online sekolahbisnisfjs.com</strong></span></span></div>

				</center>

                        </td>

                    </tr>

                </tbody></table>

                

            </td>

        </tr>

    </tbody>

</table><table class='mcnDividerBlock' style='min-width:100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnDividerBlockOuter'>

        <tr>

            <td class='mcnDividerBlockInner' style='min-width:100%; padding:18px;'>

                <table class='mcnDividerContent' style='min-width: 100%;border-top: 2px solid #EAEAEA;' border='0' cellpadding='0' cellspacing='0' width='100%'>

                    <tbody><tr>

                        <td>

                            <span></span>

                        </td>

                    </tr>

                </tbody></table>

            </td>

        </tr>

    </tbody>

</table></td>

                            </tr>

                            <tr>

                                <td valign='top' id='templateBody'><table class='mcnTextBlock' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnTextBlockOuter'>

        <tr>

            <td class='mcnTextBlockInner' valign='top'>

                

                <table class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='600'>

                    <tbody><tr>

                        

                        <td class='mcnTextContent' style='padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;' valign='top'>" . $message . "</td>

                    </tr>

                </tbody></table>

                

            </td>

        </tr>

    </tbody>

</table></td>

                            </tr>

                            <tr>

                                <td valign='top' id='templateFooter'><table class='mcnDividerBlock' style='min-width:100%;' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnDividerBlockOuter'>

        <tr>

            <td class='mcnDividerBlockInner' style='min-width: 100%; padding: 10px 18px 25px;'>

                <table class='mcnDividerContent' style='min-width: 100%;border-top: 2px solid #EEEEEE;' border='0' cellpadding='0' cellspacing='0' width='100%'>

                    <tbody><tr>

                        <td>

                            <span></span>

                        </td>

                    </tr>

                </tbody></table>

            </td>

        </tr>

    </tbody>

</table><table class='mcnTextBlock' border='0' cellpadding='0' cellspacing='0' width='100%'>

    <tbody class='mcnTextBlockOuter'>

        <tr>

            <td class='mcnTextBlockInner' valign='center'>

                <center>

                <table class='mcnTextContentContainer' align='left' border='0' cellpadding='0' cellspacing='0' width='100%'>

                    <tbody><tr>

                        

                        <td class='mcnTextContent' style='padding-top:9px; padding-right: 18px; padding-bottom: 9px; padding-left: 18px;' valign='center'>

							<center>

                            <span style='font-family:tahoma,verdana,segoe,sans-serif'><strong>SEKOLAH BISNIS ONLINE FITRA JAYA SALEH</strong><br>

Copyright © sekolahbisnisfjs.com, All rights reserved.</span><br>

&nbsp; <a href='http://www.sekolahbisnisfjs.com/'>www.sekolahbisnisfjs.com</a>

							</center>

                        </td>

                    </tr>

                </tbody></table>

                </center>

            </td>

        </tr>

    </tbody>

</table></td>

                            </tr>
                        </table>
						</td>
						</tr>
						</table>
						<![endif]-->
                    </td>
                </tr>
            </table>
        </center>
    </body>
</html>

";
	}
}
