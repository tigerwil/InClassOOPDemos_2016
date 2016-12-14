<?php
  include 'includes/header.php'; //page header
?>
<div class="page-header">
    <div class="container">
        <h3>Contact Us</h3>
<?php
  //test mailing class 
   $mail = new sendMail('knowledge@programming.oultoncollege.com', 'Marc Williams', 
                        'Test PHP Mailer', '<h3>Hello</h3>', 'Hello', 
                        'knowledge@programming.oultoncollege.com', 
                        'InClass Demo', 'mwilliams@oultoncollege.com', 'Marc Williams');

   //Send the email
   $result = $mail->SendMail();
   if($result){
       //success
       header('location:mailsent.php');
   }else{
       //fail
       header('location:mailerror.php');
   }
?>
    </div>
</div>

<?php include 'includes/footer.php'; //page footer