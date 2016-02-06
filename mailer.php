<?php

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $sender = strip_tags(trim($_POST["sender"]));
        $sender = str_replace(array("\r","\n"),array(" "," "),$sender);
        $receiver = strip_tags(trim($_POST["receiver"]));
        $address = $_POST['addr'];
        $writer = $_POST['writer'];
        $emailList = array('alyssa.fromstranger@gmail.com', 'angela.fromstranger@gmail.com', 'batu.fromstranger@gmail.com',
            'faizan.fromstranger@gmail.com','grega.fromstranger@gmail.com','jiwon.fromstranger@gmail.com',
            'leo.fromstranger@gmail.com','shoya.fromstranter@gmail.com','paula.fromstranger@gmail.com',
            'sofia.fromstranger@gmail.com','willem.fromstranger@gmail.com');
        
        $writerEmail = $emailList[$writer];
        $language = $_POST["lang"];
        $message = trim($_POST["addinfo"]);
        

        // Check that data was sent to the mailer.
        if ( empty($sender) OR empty($message) ) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }

        // Set the writerEmail email address.
        // FIXME: Update this to your desired email address.
        
        //$writerEmail = "batuaytemiz@gmail.com";

        // Set the email subject.
        $subject = "From Stranger With Love Message Request";

        // Build the email content.
        $email_content = "Senders Name: $sender\n";
        $email_content .= "Recepients Name: $receiver\n";
        $email_content .= "Language: $language\n";
        $email_content .= "Address: $address\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From Stranger With Love";

        // Send the email.
        if (mail($writerEmail, $subject, $email_content, $email_headers)) {
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }

    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }

?>