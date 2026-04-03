<?php
    $nev="localhost";
    $unev="roli2004";
    $password="Deirfyof";
    $db_name="roli2004";
    
    $conn=new mysqli($nev, $unev, $password, $db_name);

    if (isset($_POST['name'])
    && isset($_POST['uname'])
    && isset($_POST['email'])
    && isset($_POST['pass']))
    {
        $name=$_POST['name'];
        $uname=$_POST['uname'];
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $data="name=".$name."&uname=".$uname;
        if (empty($name)) {
            $em = "A teljes nev megadasa kotelezo";
            header("Location: signup.php?error=$em&$data");
            exit;
        }else if(empty($uname)){
            $em = "A felhasznalonev megadasa kotelezo";
            header("Location: signup.php?error=$em&$data");
            exit;
        }else if(empty($email)){
            $em = "Az email megadasa kotelezo";
            header("Location: signup.php?error=$em&$data");
            exit;
        }else if(empty($pass)){
            $em = "Jelszo megadasa kotelezo";
            header("Location: signup.php?error=$em&$data");
            exit;
        } else
            {
                $pass = crypt($pass, '$2y$10$'.bin2hex(openssl_random_pseudo_bytes(22)));
                $sql = "INSERT INTO ATESTAT(Name, Username, Email, Password) VALUES (?,?,?,?)";
                $p=mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($p,"ssss",$name, $uname, $email, $pass);
                mysqli_stmt_execute($p);
                header("Location: signup.php?success=Sign up complete!");
                exit;
            }
    }else
        {
            header("Location: signup.php?error=Error");
            exit;
        }
    $conn->close();   
?>