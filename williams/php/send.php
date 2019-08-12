<?php

// -- Include the required files --
require 'includes.php';
require 'mailer/PHPMailerAutoload.php';

// -- Testing configuration --
$TESTING = is_posted("TEST");
$TEST_EMAIL = "nk9@williams.edu";

// -- Configure the to-email address possibilities --
$student_help_address = "stchelp@williams.edu";
$faculty_help_address = "desktop@williams.edu";

// -- Get the sent data --
$student_or_faculty = is_posted("sof");
$file_url = is_posted("url");
$content = is_posted("c");
$captcha = is_posted("g-recaptcha-response");

// -- Verify the captcha --
if($captcha) {

    $service_url = 'https://www.google.com/recaptcha/api/siteverify';
    $curl = curl_init($service_url);
    $curl_post_data = array(
        'secret' => '6LfwXBcUAAAAAOSnyTL9EJ50hF-_-qeZ1Wjdme4b',
        'response' => "$captcha"
    );
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occurred during curl exec. Additional info: ' . var_export($info));
    }
    curl_close($curl);
    $decoded = json_decode($curl_response);
    if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
        die('error occurred: ' . $decoded->response->errormessage);
    }
    // -- Check if the capcha was correct --
    if(get_object_vars($decoded)["success"]){

        // -- Verify the required information was sent --
        if($student_or_faculty && $content && $file_url){

            // -- Decide which email to send to --
            if(!$TESTING){

                if(strtolower($student_or_faculty) == "faculty"){
                    $to = $faculty_help_address;
                }
                else{
                    $to = $student_help_address;
                }

            }
            else{

                $to = $TEST_EMAIL;

            }

            $mail = new PHPMailer;

            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = 'mailgate.williams.edu';                // Specify main and backup SMTP servers
            $mail->SMTPAuth = false;                              // Disable SMTP authentication
            $mail->Port = 25;                                     // TCP port to connect to

            $mail->setFrom('noreply@purplehelp.williams.edu', 'Mailer');
            $mail->addAddress($to);                               // Add a recipient

            $mail->addAttachment($file_url);                      // Add attachments
            $mail->isHTML(true);                                  // Set email format to HTML

            $mail->Subject = 'New PurpleHelp Issue.';
            $mail->Body    = $content;
            $mail->AltBody = $content;

            if(!$mail->send()) {
                
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                
            }
            else {
                
                echo 'Message has been sent';
                
            }

        }
        else{
            echo "Insufficient data!";
        }

    }
    else{
        
        echo "Invalid Captcha!";
        
    }
}
