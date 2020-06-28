<?php
header("Content-Type: text/html; charset=utf-8");

	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>綿菓子学院</title>
    <link rel="stylesheet" href="bootstrap.min.css"/>
    <link rel="stylesheet" href="site.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
    <style type="text/css">
     
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light bg-white border-bottom box-shadow mb-3">
            <div class="container">
                <a class="navbar-brand" href="index.php">綿菓子学院</a>

                <div class="navbar-nav ml-auto">
                <?php
                
                if(isset($_SESSION['id'])&&$_SESSION['id']!="")
                {
                    if (isset($_GET['login'])) {
                         if($_GET['login'] == "success")
                        {
                            echo "<label class='text-success h4 mr-2'>Login success!</label>";
                        }
                    }
                	echo "<form action='logout.php' method='POST' style='padding-right: 15px; margin-right: 5px;'>
        					<button class='btn btn-primary' type='submit' name='logout-submit'>Logout</button>
        				</form>";
                }
                else
                {
                   
                	echo " <form action='login.php' method='POST' style='padding-right: 25px;'>";
                     if(isset($_GET['error']))
                    {
                        if($_GET['error'] == "emptyfields")
                        {
                            echo "<label class='text-danger h4 mr-2'>Fill in all fields!</label>";
                        }
                        elseif ($_GET['error'] == "wrong") {
                           echo "<label class='text-danger h4 mr-2'>Wrong username or password!</label>";
                        }
                    }
        				echo "<label>帳號</label>
        				<input type='text' name='mailuid' placeholder='Username/E-mail'>
        	
        				<label>密碼</label>
        				<input type='password' name='pwd' placeholder='Password'>
        				<button class='btn btn-primary' type='submit' name='login-submit' style='padding-right: 15px; padding-left: 15px; margin-left: 15px;'>Login</button>
        				</form>
        		
        				<a class='btn btn-secondary' href='signup.php' style='padding-right: 15px; margin-right: 5px;'>Signup</a>";
                }


                ?>

        		</div>

            </div>
        </nav>
    </header>

    <div class="container">
        <main role="main" class="pb-3">
        	<?php
        	if(isset($_SESSION['id'])&&$_SESSION['id']!=""){
        		if($_SESSION['id']>0&&$_SESSION['usertype']=='student'){

                    $id=$_SESSION['id'];
                    $usertype=$_SESSION['usertype'];
                    $username=$_SESSION['uid'];
                    $sid=$_SESSION['sID'];
                    $name=$_SESSION['name'];
                    $courses=$_SESSION['courses'];
                    $email=$_SESSION['email'];
                    $courses_parts = preg_split('/\s+/', $courses, -1, PREG_SPLIT_NO_EMPTY);

                    $number_of_courses=count($courses_parts);
         
                    for ($i=0;$i<$number_of_courses;$i++) {
                            if($courses_parts[$i] == "台語" || $courses_parts[$i]== "臺語"){
                                    
                                   
                            }
                    }
                   
                    echo "<div class='d-flex flex-row border rounded' style='width:40%'>";
                    echo "  <div class='p-2 w-10'>";
        			if($_SESSION['imgstatus']==0){
        				
        				$format=$_SESSION['imgformat'];
        				echo "<img src='uploads/profile".$usertype.$id."";
        				echo ".".$format."?".mt_rand()."' width='100px' height='100px'>";

                        
        			}
        			else {
        			
        				echo "<img src='uploads/profiledefault.png' width='100px' height='100px'>";
        			}
                    echo '</div>
                    <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left" >';
                    echo "<p class='h4 text-primary'>".$username."</p>";
                    echo "<p class='h5 text-info'>".$usertype."</p>";
        			echo "<p class='text-right m-0'><a class='btn btn-primary' href='profile.php'>Update Avatar</a></p>
                    </div>
                    </div>";

                    echo "<span><a class='btn btn-primary my-2' href='qrcode.php?sid=".$sid."&name=".$name."'>點名</a></span>";
              


        		}
        		elseif ($_SESSION['id']>0&&$_SESSION['usertype']=='teacher'){

                    $id=$_SESSION['id'];
                    $usertype=$_SESSION['usertype'];
                    $username=$_SESSION['uid'];
                    $courses=$_SESSION['courses'];

                    $courses_parts = preg_split('/\s+/', $courses, -1, PREG_SPLIT_NO_EMPTY);

                    $number_of_courses=count($courses_parts);
         
                    echo "<div class='d-flex flex-row border rounded' style='width:40%'>";
                    echo "  <div class='p-2 w-10'>";
                  

        			if($_SESSION['imgstatus']==0){

        				
        				$format=$_SESSION['imgformat'];
        				echo "<img src='uploads/profile".$usertype.$id."";
        				echo ".".$format."?".mt_rand()."' width='100px' height='100px'>";
        			}
        			else {
        				echo "<img src='uploads/profiledefault.png' width='100px' height='100px'>";
        			}
        			echo '</div>
                    <div class="pl-3 pt-2 pr-2 pb-2 w-75 border-left" >';
                    echo "<p class='h4 text-primary'>".$username."</p>";
                    echo "<p class='h5 text-info'>".$usertype."</p>";
                    echo "<p class='text-right m-0'><a class='btn btn-primary' href='profile.php'>Update Avatar</a></p>
                    </div>
                    </div>";

                    
                   
                    for ($i=0;$i<$number_of_courses;$i++) {
                            if($courses_parts[$i] == "台語" || $courses_parts[$i]== "臺語"){
                                    
                                echo "<span><a class='btn btn-primary my-2' href='course.php?course=Taiwanese'>臺語</a></span>";

                            }
                    }

        		}
        		
        	}
        	else {
     

        			echo "<p>
        			<h1 style='color: red;'>請先登錄或註冊</h1>
        			</p>";

        						
        		}
        	?>
        </main>
    </div>

    <footer class="border-top footer text-muted">
        <div class="container">
            &copy; 2020 - 綿飴 - <a>Privacy</a>
        </div>
    </footer>


</body>
</html>