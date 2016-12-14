<div class="page-header">
    <div class="container">
    
<?php
    //Only authorized users
    // Determine is user is logged in and if account is valid 
    if (isset($_SESSION['user_not_expired'])&& isset($_SESSION['user_id'])){
        $userid = $_SESSION['user_id']; 
    } else {
          $userid = "";
    }
    
    //Conditions:
    
    if($userid ==""){   
       //USER NOT LOGGED IN? 
         echo '<h2>Articles</h2>
               <div class="alert alert-danger"><strong>Members Only</strong>
               <p>You must be logged in as a registered user to view
                  this content! <br><a href="/InclassOOPDemos/login.php">Login</a> | 
                                <a href="/InclassOOPDemos/register.php">Register</a>
               </p>
               </div>';
    }else if ($_SESSION['user_not_expired']){
       //Account in good standing:  not expired
     //make sure we have valid url parameter 
    if (   (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) {
        //get single article for particular id
        $id = $_GET['id'];
        //populate local variable called $data with single article 
        //by calling the getArticle method in the DbHandler class
        $data = $dbh->getArticle($id);
        //var_dump($data);
        if($data['error']==false){
            $articleItems = $data['items'];
            if(empty($articleItems)){
                //no article with that id
                echo '<h3>No article</h3>';
                
            }else{
                //display article info
                foreach($articleItems as $item):
                    $title = $item['title'];
                    $description = $item['description'];
                    $content = $item['content'];
                    echo "<h2>$title</h2>";
                    echo "<p>$description</p>";
                    echo $content;
                endforeach;
                
            }
        }
                
    }else{
        echo "<h3>This page has been accessed in error.</h3>";
    }       
        
        
    
    }else {
        //Account expired 
        echo '<h2>Articles</h2>
               <div class="alert alert-danger"><strong>Members Only</strong>
               <p>Thank you for your interest in this
                  content, but your account is no longer current!</p>
               </div>';        
    }      


  
?>
    </div>
</div>