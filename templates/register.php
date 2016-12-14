<div class="page-header">
    <div class="container">
        <h2>Registration</h2>
        <?php
        if ($_POST) {
            //var_dump($_POST);
            /* validation start */
            //Array for storing validation errors
            $reg_errors = array();

            //1.Check for firstname (characters, apos, period, space and dash b/w 2 and 60
            /* rules:  between 2, 45 characters
              letters A-Z, case-insensitive (i)
              space, apostrophe, period, hyphen */
            if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['firstname'])) {
                $firstname = trim($_POST['firstname']);
            } else {
                $reg_errors['firstname'] = 'Please enter your first name!';
            }
            //2. Check for a last name:
            //  rules:  same as first name           
            if (preg_match('/^[A-Z \'.-]{2,45}$/i', $_POST['lastname'])) {
                $lastname = trim($_POST['lastname']);
            } else {
                $reg_errors['lastname'] = 'Please enter your last name!';
            }
            //3. Check for email (valid email address format)
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $email = trim($_POST['email']);
            } else {
                $reg_errors['email'] = 'Please enter a valid email!';
            }

            // 3.Check for a password and match against the confirmed password:
            /* rules:  Must be betwen 6 and 20 characters long with 
              at least one lowercase letter, one uppercase letter, and
              one number.
              ?=   zero-width lookahead assertion:  makes matches based upon what
              follows a character.
             */
            if (preg_match('/^(\w*(?=\w*\d)(?=\w*[a-z])(?=\w*[A-Z])\w*){6,20}$/', $_POST['password1'])) {
                if ($_POST['password1'] == $_POST['password2']) {
                    $password2 = strip_tags($_POST['password2']);
                } else {
                    $reg_errors['password2'] = 'Your password did not match the confirmed password!';
                }
            } else {
                $reg_errors['password1'] = 'Password must be between 6 and 20 characters long, with 
                   at least one lowercase letter, one uppercase letter, 
                   and one number.!';
            }


            /*  end validation    */
            if (empty($reg_errors)) {
                //Validation OK: Create User 
                //var_dump($_POST);
                //exit();
                // reading post params
                $email = $_POST['email'];
                $password = $_POST['password2'];
                $first_name = $_POST['firstname'];
                $last_name = $_POST['lastname'];
                $data = $dbh->createUser($email, $password, $first_name, $last_name);
                //var_dump($data);
                if ($data['error']==false){
                    //$message = $data['message'];
                    $active = $data['active'];
                    //var_dump($active)  ;
                    
                    //===================== NEW STUFF ========================//
                    //1.  Prepare to send email
                    $siteURL = "http://localhost:8888/InClassOOPDemos/activate.php?x=".urlencode($email)."&y=$active";
                    $replyToEmail = 'knowledge@programming.oultoncollege.com';
                    $replyToName = 'Knowledge Is Power';
                    $mailSubject = 'Knowledge Is Power Registration';                       
                    $messageTEXT = "Thank you for registering at Knowledge Is Power.\n\n
                                    To activate your account please click on this link:  "
                                   .$siteURL;
                    $messageHTML = "<p><strong>Thank you for registering at Knowledge is Power.</strong></p> 
                                    <p>To activate your account, please click on this link:</p>
                                    <a href='$siteURL'>Activate our Account</a>";
                                    
                                    
                    $fromEmail = 'knowledge@programming.oultoncollege.com';
                    $fromName = 'Knowledge Is Power';
                    $toEmail = $email;
                    $toName = $firstname.' '.$lastname;                   
                    
                    //2.  Send email
                    $mail = new sendMail($replyToEmail, $replyToName, $mailSubject, $messageHTML, $messageTEXT, $fromEmail, $fromName, $toEmail, $toName);
                    $result = $mail->SendMail();
                    if($result){
                        // MAIL SUCCESS: show html message
                        echo '<div class="alert alert-success"><strong>Account Registered</strong>
                                <p>A confirmation email has been sent to your email address.  
                                    Please click on the link in that email in order to activate 
                                    your account.
                                </p>
                              </div>';
                            
                    }else{
                        //MAIL ERROR
                    echo '<div class="alert alert-success"><strong>Account Registered</strong>
                                <p>Warning:  There was a problem sending a confirmation email to the following email: <strong>'.
                                   $email . '</strong>.</p> <p>Please contact customer support!</p>                                 
                              </div>';
                    }        
                            
                    //===================== END NEW STUFF ========================//
                    
                    
                    
                    
                }else{
                    echo '<div class="alert alert-danger"><strong>Registration Failed</strong>
                         <p>The following error has occured: '. $data['message']  .'</p></div>';   
                }
                
                 //finish page:  hide form
                echo   '</div>
                    </div>';
                include './includes/footer.php'; //footer
                exit();
                
            }else{
                //Validation Errors: Display Errors
                //var_dump($reg_errors);
                echo '<div class="alert alert-danger">';
                echo '<ul>';
                foreach($reg_errors as $error){
                    echo "<li>$error</li>";
                }
                echo '</ul>';
                echo '</div> ';
            }
        }
        ?>
        <form class="form-horizontal" role="form" method="post" action="register.php">
            <div class="form-group">
                <label for="firstname" class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="firstname" id="firstname" 
                           oninvalid="this.setCustomValidity('Please enter first name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter first name" required autofocus
                           value="<?php if (isset($_POST['firstname'])) echo $_POST['firstname']; ?>">
                </div>
            </div>  
            <div class="form-group">
                <label for="lastname" class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="lastname" id="lastname" 
                           oninvalid="this.setCustomValidity('Please enter last name')" 
                           oninput="setCustomValidity('')"
                           placeholder="Enter last name" required
                           value="<?php if (isset($_POST['lastname'])) echo $_POST['lastname']; ?>">
                </div>
            </div>            
            <div class="form-group">
                <label for="email" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" name="email" id="email" 
                           oninvalid="this.setCustomValidity('Please enter email')" 
                           oninput="setCustomValidity('')"                   
                           placeholder="Enter email" required
                           value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="password1" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password1" id="password1" 
                           oninvalid="this.setCustomValidity('Please enter password')" 
                           oninput="setCustomValidity('')" autocomplete="off"                  
                           placeholder="Enter password" required>
                </div>
            </div>
            <div class="form-group">
                <label for="password2" class="col-sm-2 control-label">Confirm Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" name="password2" id="password2" 
                           oninvalid="this.setCustomValidity('Please confirm password')" 
                           oninput="setCustomValidity('')" autocomplete="off"                 
                           placeholder="Confirm password" required>
                </div>
            </div>        
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </form>
        <?php
        //check for validation errors
        if (!empty($data['register'])) {
            ?>
            <div class="alert alert-danger alert-dismissable">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <ul>
                    <?php
                    //print_r($_POST);
                    //print_r($data['contact']);
                    $errors = $data['register'];
                    foreach ($errors as $error):
                        echo "<li>$error</li>";
                    endforeach;
                    ?>       
                </ul>
            </div>  
        <?php } ?>
    </div>
</div>    