
<?php
    include('connection.php');
    if(isset($POST['submit'])){
        $firstUsername = mysqli_real_escape_string($conn, $_POST['firstusername']);
        $secondUsername = mysqli_real_escape_string($conn, $_POST['secondusername']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['number']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = mysqli_real_escape_string($conn, $_POST['cpass']);

        $sql="select * from signup where firstusername= '$fisrtUsername'";
        $result = mysqli_query($conn, $sql);
        $count_firstUsername = mysqli_num_rows($result);

        $sql="select * from signup where secondusername= '$secondUsername'";
        $result = mysqli_query($conn, $sql);
        $count_secondUsername = mysqli_num_rows($result);
        
        $sql="select * from signup where email= '$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);
    
        $sql="select * from signup where number= '$phone'";
        $result = mysqli_query($conn, $sql);
        $count_phone = mysqli_num_rows($result);
    
        if($count_user == 0  & $count_email==0) {
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $result = "INSERT INTO signup (firstusername, secondusername, email, phone, password) VALUES ('$firstUsername', '$secondUsername', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: welcome.php");
                }
                else{
                    echo '<script>
                        alert("A jelszavak nem egyeznek");
                        window.location.href = "index.php";
                    </script>';
                }
            }
        }
        else{
        if ($count_user){
            echo '<script>
            window.location.href="index.php
            alert ("Username already exists
        </script>';
        }
        if ($count_email>0){
        echo '<script>
        window.location.href="index.php
        alert("Email already exists
        </script>';
        }
    }
}

?>