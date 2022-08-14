<?php 
session_start();
    if(isset($_POST['Username'])){
//connection
include("condb.php");
//ຮັບຄ່າ user & password ຈາກຟອມ
 $Username = $_POST['Username'];
 $Password = md5($_POST['Password']);
//query 
 $sql="SELECT * FROM user Where Username='".$Username."' and Password='".$Password."' ";

 $result = mysqli_query($con,$sql);
				
  if(mysqli_num_rows($result)==1){
  $row = mysqli_fetch_array($result);

    $_SESSION["UserID"] = $row["ID"];
    $_SESSION["User"] = $row["Firstname"]." ".$row["Lastname"];
    $_SESSION["Userlevel"] = $row["Userlevel"];

    if($_SESSION["Userlevel"]=="A"){ //ຖ້າເປັນ admin ໃຫ້ກະໂດດໄປໜ້າ admin_page.php

    Header("Location: admin_page.php");

    }

    if ($_SESSION["Userlevel"]=="M"){  //ຖ້າເປັນ member ໃຫ້ກະໂດດໄປໜ້າ user_page.php

        Header("Location: user_page.php");

    }

}else{
echo "<script>";
    echo "alert(\" user ຫຼື  password ບໍ່ຖືກຕ້ອງ\");"; 
    echo "window.history.back()";
echo "</script>";

        }
}else{


    Header("Location: form.php"); //user & password incorrect back to login again
}
?>