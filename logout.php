<?php
    include 'includes/header.php';//header
 // Destroy the SESSION object     
    $_SESSION = array(); //destroy session variables (new empty array)
    session_destroy();   //destroy the session itself
    setcookie(session_name(),'', time()-300); //destroy session cookie
?>
    <div class="page-header">
        <div class="container">
            <h2>Logged Out</h2>
            <div class="alert alert-success">
                <p>Thank you for visiting. You are now logged out. 
                   Please come back soon!</p>
            </div>
        </div>
    </div>
<?php
    include 'includes/footer.php'; //footer