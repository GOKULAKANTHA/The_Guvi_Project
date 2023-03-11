<?php
// connect to MySQL database

$remail = $_POST['remail'];
$rpassword =$_POST['rpassword'];

if(!empty($remail) || !empty($rpassword))
{
    $host= 'localhost';
    $dbusername = 'root';
    $dbpassword = '';
    $dbname = 'guvi';


    $conn = new mysqli ($host, $dbusername, $dbpassword, $dbname);



// check connection
    if (mysqli_connect_error()) {
    die('Connect error: (' .mysqli_connect_errno() .')' . mysqli_connect_error());
    } 
    else{
        $SELECT ="SELECT remail From 
        register1 Where remail = ? Limit 1"
        ;
        $INSERT ="INSERT Into register1(remail,rpassword) values(?,?)";

        $stmt = $conn->prepare($SELECT);
        $stmt->bind_param("s",$remail);
        $stmt->execute();
        $stmt->bind_result($remail);
        $stmt->store_result();
        $rnum = $stmt->num_rows;
    
        if ($rnum==0){
            $stmt->close();
            $stmt = $conn->prepare($INSERT);
            $stmt->bind_param("ss",$remail,$rpassword);
            $stmt->execute();
            echo "<script>window.location.href='login.html';</script>";
            

        }
        else{
    
            echo "Someone already register using this email";
        
        
           
            $stmt->close();
        }
        $conn-> close();
    }
}
else{
    echo "All field are required";
    die();
}
?>
