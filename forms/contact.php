<?php
  // Replace with your real receiving email address
  $receiving_email_address = 'francesco.rossitto2001@proton.me';

  // Check if it's an AJAX request
  $is_ajax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
      echo $is_ajax ? 'All fields are required.' : 'All fields are required.';
      exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo $is_ajax ? 'Invalid email format.' : 'Invalid email format.';
      exit;
    }

    // Prepare email
    $to = $receiving_email_address;
    $email_subject = "Contact Form: " . $subject;
    $email_body = "Name: $name\nEmail: $email\nSubject: $subject\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";

    // Send email
    if (mail($to, $email_subject, $email_body, $headers)) {
      echo $is_ajax ? 'OK' : 'Message sent successfully!';
    } else {
      echo $is_ajax ? 'Failed to send message. Please try again.' : 'Failed to send message. Please try again.';
    }
  } else {
    echo $is_ajax ? 'Invalid request.' : 'Invalid request.';
  }
?>
