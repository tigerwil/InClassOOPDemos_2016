<?php
  include 'includes/header.php'; //page header
?>
<div class="page-header">
    <div class="container">
        <h3>Account Activation</h3>
<?php

//Check for required activation parameters (x and y)
if (isset($_GET['x']) && isset($_GET['y'])){
    //good to go
    //Retrieve url params
    $email = $_GET['x'];
    $active = $_GET['y'];
    //var_dump($email);
    //var_dump($active);
    
    $errors = array();
    //validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email address!';
    }   
    
    //validate activation code
    if (strlen($active)!=32) {
       $errors['active'] = 'Invalid activation code!';
    }
    
    //var_dump($errors);
    if (empty($errors)) {
        //ok to proceed - update database
       $data = $dbh->activateUser($email,$active);
       //var_dump($data);
       //exit();
       if($data['error']){
           //Activation Failed 
           echo '<div class="alert alert-danger"><strong>Activation Failed</strong>
                    <p>Account activation has failed!</p>
                </div>';                

          
       }else{
           //Activation Success
           echo '<div class="alert alert-success"><strong>Account Activated</strong>
                    <p>Proceed to the login page!</p>
                    <a class="btn btn-success" href="login.php">Login</a>
                </div>';  
       }
 
        
    }else{
        //Validation Errors: Display Errors
        //var_dump($reg_errors);
        echo '<div class="alert alert-danger">';
            echo '<ul>';
                    foreach($errors as $error){
                        echo "<li>$error</li>";
                    }
            echo '</ul>';
        echo '</div> ';
    }  
         
    
}else{
    //missing
    echo '<div class="alert alert-danger"><strong>Activation Failed</strong>
            <p>This page has been accessed in error.</p>
         </div>';   
}
?>
    </div>
</div>

<?php include 'includes/footer.php'; //page footer
