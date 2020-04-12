<?php $name = $_POST['name'];
$email = $POST['email'];
$message = $POST['message'];
$formcontent="From: $name \n Message: $message";
$recipient = "515577@lln.corlaercollege.nl";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
echo "Bedankt!";
?>