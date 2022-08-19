<?php 

header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
header("Access-Control-Allow-Origin: *");

if (!empty($_POST)) {

    if(isset($_POST['h-captcha-response']) && !empty($_POST['h-captcha-response'])) {
        $data = array(
            'secret' => "0x34980622C9524Ad1270fCa8281e4E14eF5f244AB",
            'response' => $_POST['h-captcha-response']
        );
        $verify = curl_init();
        curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
        curl_setopt($verify, CURLOPT_POST, true);
        curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
        $verifyResponse = curl_exec($verify);        
        $responseData = json_decode($verifyResponse);    
        $name = !empty($_POST['name'])? $_POST['name'] : '';
        $email = !empty($_POST['email'])? $_POST['email'] : '';
        $subjectFromForm = !empty($_POST['subject'])? $_POST['subject'] : '';
        $message = !empty($_POST['message']) ? $_POST['message'] : '';
        
        if($responseData->success) {
        
            //contact form submission code
            $to = 'contact@copernic.io';
            $subject = $subjectFromForm;
            $htmlContent = "
            <h1>Wiadomość z formularza kontaktowego strony copernic.io</h1>
            <p><b>Imię: </b>".$name."</p>
            <p><b>Email: </b>".$email."</p>
            <p><b>Wiadomość: </b><br>".$message."</p>
            ";
            // Always set content-type when sending HTML email
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            // More headers
            $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
            //send email
            @mail($to,$subject,$htmlContent,$headers);
        
        } else {
            header('HTTP/1.1 400 Bad Request');
            header('Content-Type: application/json; charset=UTF-8');
            die(json_encode(array('message' => 'Captcha verification failed')));
        }

    }
} else {
    header('HTTP/1.1 400 Bad Request');
    header('Content-Type: application/json; charset=UTF-8');
    die(json_encode(array('message' => 'Invalid data')));
}

?>