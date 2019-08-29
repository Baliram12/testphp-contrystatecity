<?php
$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'userregistration');
$sql6="select * from citytable where stateid='".$_POST['stateid']."'";
$result6=mysqli_query($conn,$sql6);
$num=mysqli_num_rows($result6);
if($num >0){
        echo '<option value="">Select City</option>'; 
        while($row6 = $result6->fetch_assoc()){  
            echo '<option value="'.$row6['cityid'].'">'.$row6['cityname'].'</option>'; 
        } 
    }
?>