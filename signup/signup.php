
<?php
    include('connection.php');
    if(isset($POST['submit'])){
        $firstUsername = mysqli_real_escape_string($conn, $_POST['firstusername']);
        $secondUsername = mysqli_real_escape_string($conn, $_POST['secondusername']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['number']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
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
    

        
    }

?>