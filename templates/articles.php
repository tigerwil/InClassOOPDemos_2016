<div class="page-header">
    <div class="container">
        <h2>All Articles</h2>
        <?php
        //Get All articles by calling the getArticleList method 
        //from the DbHandler class, returning array data in variable
        //$data

        $data = $dbh->getArticleList();
        //var_dump($data);

        if ($data['error'] == false) {
            //success - display data items within html table
            $articleItems = $data['items'];
            $output = "<table class='table table-striped'>
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Description</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>";

            //loop all records creating tr td combination
            foreach ($articleItems as $item):
                $id = $item['id'];
                $title = $item['title'];
                $description = $item['description'];
                $output .= "<tr><td>$title</td>
                      <td>$description</td>
                      <td><a href='article.php?id=$id'>Read Article</a> 
                          <span class='glyphicon glyphicon-eye-open'></span>
                      </td>
                  </tr>";
            endforeach;
            $output .= "</tbody></table>";

            //display final output
            echo $output;
        }
        ?>
    </div>
</div>