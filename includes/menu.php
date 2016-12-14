<?php
//Call the getCategoryList method from the DbHandler class 
//and store the return array in a variable called $data
$data = $dbh->getCategoryList();
//var_dump($data);
if($data['error']==false){
    $catItems = $data['items'];
    
    foreach ($catItems as $item) {
        $catId = $item['id'];
        $category = $item['category'];
        $total = $item['total'];
        
        echo "<li><a href='/InClassOOPDemos/articlecategory.php?id=$catId'>$category <span class='badge pull-right'>$total</span></a></li>";
    }
}

