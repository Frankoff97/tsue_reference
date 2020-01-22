<?php  session_start();
        switch ($_SESSION['category']) {
                case 'offer':
                case 'non_offer':
                        $password='offer@123';
                        if(isset($_POST['password'])){
                                if($_POST['password']==$password){
                                        $_SESSION['block']='on';
                                        $_SESSION['tab_name']='Xodim';
                                        $_SESSION['tab_names']='Sobiq xodim';
                                        header("Location: edit.php");
                                }
                                else{
                                       $route=$_SESSION['category'];
                                       header("Location: /?route=$route");
                                }
                        }
                        break;
                case 'student':
                case 'non_student':
                        $password='student@123';
                        if(isset($_POST['password'])){
                                if($_POST['password']==$password){
                                        $_SESSION['block']='on';
                                        $_SESSION['tab_name']='Talaba';
                                        $_SESSION['tab_names']='Sobiq Talaba';
                                        header("Location: edit.php");
                                }
                                else{
                                       $route=$_SESSION['category'];
                                       header("Location: /?route=$route");
                                }
                        }
                        break;
                case 'soldier_026':
                case 'soldier_028':
                        $password='soldier@123';
                        if(isset($_POST['password'])){
                                if($_POST['password']==$password){
                                        $_SESSION['block']='on';
                                        $_SESSION['tab_name']='soldier_026';
                                        $_SESSION['tab_names']='soldier_028';
                                        header("Location: edit.php");
                                }
                                else{
                                       $route=$_SESSION['category'];
                                       header("Location: /?route=$route");
                                }
                        }
                        break;
                
              
        }
        

        
?>
