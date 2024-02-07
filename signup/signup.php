
<?php
    include('connection.php');
    if(isset($POST['submit'])){
        $firstUsername = $_POST['firstUser'];
        $secondUsername = $_POST['seconduser'];
        $email = $_POST['email'];
        $phone = $_POST['number'];
        $password = $_POST['password'];
        $password = $_POST['cpass'];

        $sql="select * from signup where firstuser= '$fisrtUsername'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql="select * from signup where seconduser= '$secondUsername'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);
        
        $sql="select * from signup where email= '$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);
    
        $sql="select * from signup where number= '$phone'";
        $result = mysqli_query($conn, $sql);
        $count_phone = mysqli_num_rows($result);
    
        if($count_user == 0 & $count_email==0 ) {
            if($password == $cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $result = "INSERT INTO signup (firstUsername, secondUsername, email, phone, password) VALUES ('$firstUsername', '$secondUsername', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    header("Location: welcome.php");
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