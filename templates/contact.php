<div class="page-header">
    <div class="container">
        <h2>Contact Us</h2>
        <?php
        //ob_start();
        if ($_POST) {
           //var_dump($_POST) ;
            /*  Validation Start */
            //Array for storing validation errors
            $email_errors = array();
            
            //1.check for firstname (characters, apos, period, space and dash b/w 2 and 60
            if(preg_match('/^[A-Z \'.-]{2,60}$/i', $_POST['firstname'])){
                $firstname = trim($_POST['firstname']);
            }else{
                $email_errors['firstname'] = 'Please enter your firstname!';
            }
            
            //2.check for firstname (characters, apos, period, space and dash b/w 2 and 60
            if(preg_match('/^[A-Z \'.-]{2,60}$/i', $_POST['lastname'])){
                $lastname = trim($_POST['lastname']);
            }else{
                $email_errors['lastname'] = 'Please enter your lastname!';
            }            
            
            //3.check for email (valid email address format)
            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                $email  = trim($_POST['email']);
            }else{
                $email_errors['email'] = 'Please enter a valid email!';
            }
            
            //3.check for message (characters, apos, comma, dash, question mark, space
            //                     b/w 2 and 500 
            if(preg_match('/^[A-Z \',.-?]{2,500}$/i', $_POST['message'])){
                $message = trim($_POST['message']);
            }else{
                $email_errors['message']='Please enter a valid message!';
            } 
            
            
            /* Validation End */  
            if(empty($email_errors)){
                $fullname = $firstname.' '.$lastname;
                
                $messageHTML = "<p><strong>Message From:</strong>  $fullname</p>
                                <p><strong>Email:</strong> <a href='mailto:$email'>$email</a></p>
                                <p><strong>Message:</strong> $message</p>";
                
                $messageTEXT = "Message From:  $fullname\n
                                Email: $email\n
                                Message: $message\n";
                    
                //test mailing class 
                 $mail = new sendMail($email, $fullname, 
                                      'Website Inquiry', $messageHTML, $messageTEXT, 
                                      'knowledge@programming.oultoncollege.com', 
                                      $fullname, 'mwilliams@oultoncollege.com', 'Marc Williams');

                 //Send the email
                 $result = $mail->SendMail();
                 if($result){
                     //success
                     header('location:mailsent.php');
                 }else{
                     //fail
                     header('location:mailerror.php');
                 }                
            }else{
                //Validation Errors: Display Errors
                //var_dump($email_errors);
                echo '<div class="alert alert-danger">';
                echo '<ul>';
                foreach($email_errors as $error){
                    echo "<li>$error</li>";
                }
                echo '</ul>';
                echo '</div> ';
            }
            
           
        }
        ?>
        <form class="form-horizontal" role="form" method="post" action="contact.php">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name*</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstname" id="firstname" 
                           oninvalid="this.setCustomValidity('Please enter first name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter first name" required autofocus
                           value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                </div>
            </div>  
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">Last Name*</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastname" id="lastname" 
                           oninvalid="this.setCustomValidity('Please enter last name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter last name" required
                           value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                </div>
            </div>            
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email*</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" 
                           oninvalid="this.setCustomValidity('Please enter email')" 
                           oninput="setCustomValidity('')"                   
                           placeholder="Enter email" required
                           value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
            </div>

            <div class="form-group">
                <label for="message" class="col-sm-2 control-label">Message*</label>
                <div class="col-sm-10">                
                    <textarea class="form-control" rows="6" name="message" id="message"
                               oninvalid="this.setCustomValidity('Please enter message')" 
                               accesskey=""oninput="setCustomValidity('')"                   
                              placeholder="Enter your message" required></textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

