<?php
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    require "PHPMailer/src/Exception.php";
    require "PHPMailer/src/PHPMailer.php";
    require "PHPMailer/src/SMTP.php";
    function sendmail($sid,$password,$name,$receiver)
    {
        $mail = new PHPMailer(true);
        try
        {
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "";
            $mail->Password = "";
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->setFrom("muthabi292@gmail.com","Muthukrishnan M");
            $mail->addAddress($receiver,$name);
            $mail->isHTML(true);
            $mail->Subject = "Student ID ";
            $mail->Body = "Hello World";
            $mail->AltBody = "";
            if($mail->send())
				echo "<script>alert('Email Sent');</script>";
			else
				echo "<script>alert('Email Failed');</script>";
        }
        catch (Exception $e)
        {
            echo "Error";
            echo $e->getMessage();
            echo $mail->ErrorInfo;
        }
    }
	
?>