<?php 

$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'userregistration');
$sql5="select * from statetable where countryid='".$_POST['countryid']."'";
$result5=mysqli_query($conn,$sql5);
$num=mysqli_num_rows($result5);

if($num > 0){ 
        echo '<option value="">Select State</option>'; 
        while($row5 = $result5->fetch_assoc()){  
            echo '<option value="'.$row5['stateid'].'">'.$row5['statename'].'</option>'; 
        } 
    }






?>


