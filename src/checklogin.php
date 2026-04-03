<?php
    session_start();
    $nev="localhost";
    $unev="roli2004";
    $password="Deirfyof";
    $db_name="roli2004";
    
    $conn=new mysqli($nev, $unev, $password, $db_name);

    if (isset($_POST['uname'])
    && isset($_POST['pass']))
    {
        $uname=$_POST['uname'];
        $pass=$_POST['pass'];
        $data="uname=".$uname;
        if(empty($uname)){
            $em = "Username is required";
            header("Location: login.php?error=$em&$data");
            exit;
        }else if(empty($pass)){
            $em = "Password is required";
            header("Location: login.php?error=$em&$data");
            exit;
        } else
            {
                $sql = "SELECT * FROM ATESTAT WHERE Username=?";
                $p = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($p, "s", $uname);
                mysqli_stmt_execute($p);
                mysqli_stmt_store_result($p);
                if (mysqli_stmt_num_rows($p) == 1) {
                    mysqli_stmt_bind_result($p, $id, $name, $username, $email, $password2, $f);
                    mysqli_stmt_fetch($p);
                    if ($username == $uname) {
                        if (crypt($pass, $password2) == $password2) {
                            $_SESSION['ID']=$id;
                            $_SESSION['name']=$name;
                            $_SESSION['uname']=$username;
                            $_SESSION['loggedin']=true;
                            header("Location: main.php");
                            exit;
                        } else {
                            $em = "Username or Password is incorrect!";
                            header("Location: login.php?error=$em&$data");
                            exit;
                        }
                    } else {
                        $em = "Username or Password is incorrect!";
                        header("Location: login.php?error=$em&$data");
                        exit;
                    }
                } else {
                    $em = "Username or Password is incorrect!";
                    header("Location: login.php?error=$em&$data");
                    exit;
                } 
            }
    }else
        {
            header("Location: login.php?error=Error");
            exit;
        }
    $conn->close();   
?>