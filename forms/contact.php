<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // إعدادات البريد
  $to = "info@tabee-edu.com"; // ✅ بريدك الحقيقي
  $subject = htmlspecialchars($_POST['subject']);
  $name = htmlspecialchars($_POST['name']);
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $message = htmlspecialchars($_POST['message']);

  // إعداد ترويسة الرسالة
  $headers = "From: " . $email . "\r\n";
  $headers .= "Reply-To: " . $email . "\r\n";
  $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

  // نص الرسالة
  $email_body = "You have received a new message from your website contact form:\n\n";
  $email_body .= "Name: $name\n";
  $email_body .= "Email: $email\n\n";
  $email_body .= "Message:\n$message\n";

  // الإرسال
  if (mail($to, $subject, $email_body, $headers)) {
    echo "Your message has been sent. Thank you!";
  } else {
    http_response_code(500);
    echo "Sorry, something went wrong. Please try again later.";
  }
} else {
  http_response_code(403);
  echo "There was a problem with your submission. Please try again.";
}
?>
