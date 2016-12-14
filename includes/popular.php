<?php

//Call the getPopularList method from the DbHandler class to return
//an array of data items to a local variable called $data

$data = $dbh->getPopularList();
//test
//var_dump($data);

//check if any errors - if no errors loop the array
if($data['error'] ==false){
    //No Error - get the data items
    $popItems = $data['items'];
    //var_dump($popItems);
    foreach($popItems as $item){
       $id = $item['page_id'];
       $title = $item['title'];
       $description = $item['description'];
       
       echo '<div class="col-6 col-sm-6 col-lg-4">';
       echo "<h4>$title</h4>";
       echo "<p>$description<p>";
       echo "<p><a class=\"btn btn-warning\" href=\"/InClassOOPDemos/article.php?id=$id\" role=\"button\">Read more &raquo;</a></p>";
       
       echo '</div>';
    }
    
}
