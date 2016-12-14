<div class="page-header">
    <div class="container">
        <?php
        //Get search query
            if (!empty($_GET['s'])){
                $search = $_GET['s'];
                echo "<h2>Search Results</h2>";
                echo "<div class='alert alert-success'><strong>Results for ($search): </strong>
                      </div>"; 
                //do search
                $data = $dbh->getSearch($search);
                //var_dump($data);
                if($data['error']==false){
                    //Print results   
                    $searchItems = $data['items'];
                    
                    
                    if($searchItems){//Did we find any result                        
                        $n = 1; // Counter
                        $output = "<table class='table table-striped'>
                                    <thead>
                                        <tr>
                                            <th>Page Title</th>
                                            <th>Page Description</th>
                                        </tr>
                                    </thead>
                                    <tbody>";

                        foreach ($searchItems as $item):
                            $id = $item['id'];
                            $title = $item['title'];
                            $description = $item['description'];

                            $output .= "<tr>
                                        <td>$n. <a href=\"article.php?id=$id\">$title</a></td>
                                        <td>$description</td>
                                   </tr>";     
                            // Increment the counter:
                            $n++;
                        endforeach;

                       echo $output;  
                       echo '</tbody></table></div>';
          
                } else{
                    //Nothing found
                    echo '<p class="bg-danger">No Results found!</p>';
                }
            }else{
                //Nothing to search
                echo "<h2>Search Results</h2>";
                echo '<div class="alert alert-warning"><strong>Nothing to search</strong>
                         <p>You did not provide a search value</p>
                      </div>';  
            }
        
            }    
        ?>
    </div>
</div>