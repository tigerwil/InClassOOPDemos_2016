<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PHP OOP Demo</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">        
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php       
        
        // **************************** SESSION **************************/
        //start the session
        session_start();
        /* ************************************************************** */
        /* Autoloading Classes
         * Whenever your code tries to create a new instance of a class
         * that PHP doesn't know about, PHP automatically calls your 
         * __autoload() function, passing in the name of the class it's
         * looking for. Your function's job is to locate and include the 
         * class file, thereby loading the class. 
         */
        
        //var_dump($_SESSION);

        function __autoload($class) {
            require_once 'classes/' . $class . '.php';
        }

        //instantiate the database handler
        $dbh = new DbHandler();
        //print_r($dbh);
        //exit();
        
        //NOTE:  mwilliams:  check the path 
        //require_once __DIR__.'/../vendor/autoload.php';
        ?>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/InClassOOPDemos_2016/index.php">PHP OOP Demo</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <!--                    <li class="active"><a href="/2016_InClassOOPDemos/index.php">Home</a></li>
                                                <li><a href="/2016_InClassOOPDemos/about.php">About</a></li>
                                                <li><a href="/2016_InClassOOPDemos/contact.php">Contact</a></li>-->
                        <?php
                        //Convert above static menu to dynamic using an array 
                        //of labels and pages 
                        //to allow us to dynamically set the active menu item based on 
                        //the current page user is on 
                        $pages = array(
                            'Home' => '/InClassOOPDemos_2016/index.php',
                            'About' => '/InClassOOPDemos_2016/about.php',
                            'Contact' => '/InClassOOPDemos_2016/contact.php'
                        );
                        //Find out which page user is viewing
                        $this_page = $_SERVER['REQUEST_URI'];
                        //echo $this_page;
                        // exit();
                        //loop the array and check if array page matches this_page
                        foreach ($pages as $k => $v) {
                            echo '<li';
                            if ($this_page == $v)
                                echo ' class="active"';
                            echo '><a href="' . $v . '">' . $k . '</a></li>';
                        }
                        ?>
                        <li class="dropdown "> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Articles <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li><a href="/InClassOOPDemos_2016/articles.php">All Articles <span class='glyphicon glyphicon-list pull-right'></span></a>
                                    <?php include 'includes/menu.php' ?>                                
                            </ul>
                        </li>                     
                      
                       <li class="dropdown "> <a href="#" class="dropdown-toggle" data-toggle="dropdown">Account <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                            <?php
                            if(empty($_SESSION['user_id']) ){
                                //NON-AUTHENTICATED USER 
                            ?>
                                <li><a href="/InClassOOPDemos_2016/register.php">Register <span class='glyphicon glyphicon-user'></span></a></li>
                                <li><a href="/InClassOOPDemos_2016/login.php">Login <span class='glyphicon glyphicon-log-in'></span></a></li>                              
                          
                            <?php
                                } else{                          
                       
                                //REGISTERED USER IS LOGGED IN 
                            ?>
                                <li><a href="#">My Account <span class='glyphicon glyphicon-user'></span></a></li>
                                <li><a href="/InClassOOPDemos_2016/logout.php">Logout <span class='glyphicon glyphicon-log-out'></span></a></li>                              
                            <?php
                                }
                         ?>
                            </ul>
                        </li>
                    </ul>
                    <!-- Search Form:  note edit css to view search icon-->
                    <form method="get" action="/InClassOOPDemos_2016/search.php" class="navbar-form navbar-right">
                        <div class="right-inner-addon">
                            <i class="glyphicon glyphicon-search"></i> 
                            <input class="form-control" type="text" placeholder="Search..." id="s" name="s" />
                        </div>
                    </form>
                </div><!--/.nav-collapse -->
            </div>
        </nav>      