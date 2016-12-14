<?php
include 'includes/header.php'; //page header
?>
<div class="page-header">
    <div class="container">
        <h3>Articles By Category</h3>
<?php
//var_dump($_GET);
//exit();

//test 
//$data = $dbh->getArticlesByCategory(1);
//var_dump($data);

if (  isset($_GET['id']) && is_numeric($_GET['id'])    ){
    $id = $_GET['id'];  //this is for the category id
    //var_dump($id);
    //exit();
    $data = $dbh->getArticlesByCategory($id);
    //test 
    //var_dump($data);   
    //exit();
    
    //check for any errors ($data['error']
    if($data['error']==false){
        //no error get the data items
        $articleItems = $data['items'];
        
        //check to make sure we have some records
        if(empty($articleItems)){
            //No article pages for this category 
            echo "<h4>Unknown Category</h4>";
            echo '<div class="alert alert-warning" role="alert">
                   <p>Please select a category from the menu above</p>
                 </div>';
        }else{
            //We have some article pages for this category - display in html
            //start an unordered list
            $list = "<ul>";
            foreach($articleItems as $item){
                $cat = $item['category'];
                $id = $item['id'];
                $title = $item['title'];
                $description = $item['description'];
                
                //Add list items for each record 
                $list.="<li><span class='glyphicon glyphicon-link'></span>
                            <a href='/InClassOOPDemos/article.php?id=$id'>$title</a>                    
                            <p>$description</p>
                        </li>";
            }
            
            //finish the ul 
            $list.="</ul>";
            echo $list;
        }
    }
            
}else{
    //Missing id url param - show error
    echo '<div class="alert alert-danger" role="alert">
            <p>This page has been accessed in error!</p>
         </div>';
}
?>
    </div>
</div>

<?php include 'includes/footer.php'; //page footer