<div class="page-header">
    <div class="container">
        <h2>Login</h2>
        <?php
        if ($_POST) {
            //var_dump($_POST);
            //get post params
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Attempt login 
            $data = $dbh->checkLogin($email, $password);
            //var_dump($data);
            if ($data) {
                //get the user by email
                $data = $dbh->getUserByEmail($email);
                //var_dump($data);
                if ($data['error'] == false) {
                    $userItems = $data['items'];
                    //var_dump($userItems); 
                    foreach ($userItems as $item) {
                        $userid = $item['id'];
                        $firstname = $item['first_name'];
                        $lastname = $item['last_name'];
                        $fullname = $firstname . ' ' . $lastname;
                        $admin = $item['admin'];
                        $expired = $item['notexpired'];
                    }
                    //store data in session
                    $_SESSION['user_id'] = $userid;
                    $_SESSION['fullname'] = $fullname;
                    $_SESSION['user_not_expired'] = $expired;
                    $_SESSION['user_admin'] = $admin;

                    //var_dump($_SESSION);
                    echo '<div class="alert alert-success">                      
                      <p><strong>Welcome ' . $fullname . '</strong></p>
                      <p>You have successfully signed in!  
                      You will be automatically redirected to the home page in <span id="count">5</span> seconds...</p></div>';
                        echo "<script>
                        var delay = 5 ;
                        var url = 'index.php';
                        function countdown() {
                                setTimeout(countdown, 1000) ;
                                $('#count').html(delay);
                                delay --;
                                if (delay < 0 ) {
                                        window.location = url ;
                                        delay = 0 ;
                                }
                        }
                        countdown() ;   
                      </script>";
                      //finish page:  hide form
                        echo   '</div>
                        </div>';
                        include './includes/footer.php'; //footer
                    exit();
                    }
                } else {
                    echo '<div class="alert alert-danger"><strong>Login Failed</strong>
                             <p>Invalid credentials entered.  Please try again!</p></div>';
                }

            //}
        } //else {
            //show the form
            ?>
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-primary">
                    <div class="panel-heading">Login</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="login.php">
                            <div class="form-group">
                                <label class="col-md-4 control-label">Email</label>
                                <div class="col-md-6">
                                    <input type="email" class="form-control" 
                                           name="email" id="email"
                                           placeholder="Email address"  autofocus  autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-4 control-label">Password</label>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" 
                                           name="password" id="password"
                                           placeholder="Password"  autocomplete="off">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-success">
                                        <span class="glyphicon glyphicon-user"></span> Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-xs-4"><a href="#">Forgot Password</a></div>
                    <div class="col-md-4 col-xs-4"><a href="register.php">Not a Member</a></div>                
                </div>  
            </div>
        <?php //} ?>
    </div>
</div>