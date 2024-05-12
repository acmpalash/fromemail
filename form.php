<?php
$errors=[];
$errorMessage='';
// print_r($_POST);
if(!empty($_POST))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $website=$_POST['website'];
    $subject=$_POST['subject'];
    $msg=$_POST['message'];
    if(empty($name))
    {
        $errors[]="Name is Empty";
    }else{
        $name=valid_input($_POST["name"]);
        // To Name Check spelling and space
        if(!preg_match("/^[A-Za-z-' ]*$/",$_POST['name']))
        {
            $errors[]="only Letter and Spaces allowed";
        }
    }
    if(empty($email))
    {
        $errors[]='Email is Empty';
    } else {
        $email=valid_input($_POST["email"]);
        // To Name Check spelling and space
        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            $errors[]="Not a Valid Email";
        }
    }
    if(empty($website))
    {
        $errors[]="Name is URL";
    }else{
        $website=valid_input($_POST["website"]);
        // To Name Check spelling and space
        if(!filter_var($website, FILTER_VALIDATE_URL))
        {
            $errors[]="Not a valid URL";
        }
    }
    if(empty($subject))
    {
        $errors[]="Subject is Empty";
    }
    if(empty($msg))
    {
        $errors[]="Message is Empty";
    }
    if(empty($errors))
    {
        $to="acmdevorg@gmail.com";
        $sub=$subject . "New mail from Contact Form";
        $headers=['From'=>$email, 'Reply-To'=>$email, 'content-type'=>'text/html'];
        $bodyParagraph=["Name:{$name}<br>","Email:{$email}<br>","Message:",$msg]; 
        $body=join(PHP_EOL, $bodyParagraph);
        if(mail($to,$sub,$body,$headers))
        {
            $errorMessage="Message Send";
        } else 
        {
            $errorMessage= "Message Not Send, Please Try Again";
        }
    } else
    {
        $allErrors=join('<br>',$errors);
    $errorMessage="<p style='color: blue;'>{$allErrors}</p>";
    // echo $errorMessage;
    }
    
}
function valid_input($data)
{
    $data=trim($data);
    $data=stripcslashes($data);
    $data=htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  
    <title>Form Mail in PHP</title>
    <style>
        body{
            color: #000;
            background: #ff8000;
            font-family: "Roboto", sans-serif;
        }
        .contact-form
        {
            padding: 50px;
            margin: 30px auto;

        }
        .contact-form h1
        {
            font-size: 42px;
            font-family: 'pacifico', sans-sarif;
            margin: 0 0 50px;
            text-align: center;
        }
        .contact-form .form-group{
            margin-bottom: 20px;
        } 
        .contact-form .form-control, .contact-form .btn {
            min-height: 40px;
            border-radius: 2px;
        }
        .contact-form .form-control{
            border-color: #e2c705;
        }
        .contact-form .form-control:focus
        {
            border-color: #d8b012;
            box-shadow: 0 0 8px #dcae10;
        }
        .contact-form .btn-primary, .contact-form .btn-primary:active
        {
            min-width: 250px;
            color: #ff8000;
            background: #000 !important;
            margin-top: 20px;
            border: none;
        }
        .contact-form .btn-primary:hover
        {
            color: #fff;
        }
        .contact-form .btn-primary i {
            margin-right: 5px;
        }
        .contact-form lable {
            opacity: 0.9;
        }
        .contact-form textarea {
            resize: vertical;
        }
        .bs-example {
            margin: 20px;
        }
    </style>
</head>
<body>
    <div class="container-lg">
        <div class="row">
            <div class="col-md-8 mix-auto">
                <div class="contact-form">
                    <h1>Get In Touch</h1>
                    <?php
                    echo ((!empty($errorMessage))? $errorMessage: '');
                    ?>
                                           
                    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="">
                                    <lable for="name">Name</lable>
                                    <input type="text" name="name" id="name" placeholder="Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="">
                                    <lable for="email">E-Mail</lable>
                                    <input type="email" name="email" id="email" placeholder="Email" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="">
                                        <lable for="website">Website</lable>
                                        <input type="text" name="website" id="website" placeholder="Website" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="">
                                        <lable for="subject">Subject</lable>
                                        <input type="text" name="subject" id="subject" placeholder="Subject" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                        <lable for="message">Message</lable>
                                        <textarea class="form-control" name="message" id="message" rows="5" ></textarea>
                                    </div>
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" name="send" value="send-message"> 
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>   
        <?php 
        
        ?> 
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script>

</body>
</html>