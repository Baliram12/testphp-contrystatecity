<?php require_once 'edit.php'; ?>

<!DOCTYPE html>
<html>
<head>
  <title>edit</title>
</head>
<body>
   <?php 
  $conn =mysqli_connect('localhost', 'root', '');
    mysqli_select_db($conn,'userregistration');
    $sql = "select * from usertable WHERE id=$_GET[edit]";
    $result = mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    
    ?>
  <h2>Please Edit Here</h2>
  <form method="post" action="">
    Name:<input type="text" name="name" value="<?php echo $row['name']; ?>"><br><br>
    Phone:<input type="text" name="phone" value="<?php echo $row['phone']; ?>"><br><br>
    Email:<input type="text" name="email" value="<?php echo $row['email']; ?>"><br><br>
    Date of Birth:<input type="date"  value="<?php echo $row['dob']; ?>" name="dob"min="1970-01-01" max="2019-12-31"><br><br>

    
     Country:<select name="country" id="countrybaliram">
    <option value="<?php echo $row['country']; ?>">Select </option>
    <?php 
    if($result->num_rows > 0){ 
        while($row = $result->fetch_assoc()){  
            echo '<option value="'.$row['countryid'].'">'.$row['countryname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
    ?>
</select>
    State:<select  id="statename" name="state"><option value="<?php echo $row['country']; ?>"> Select </option>
        <?php
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){

                echo'<option value="'.$row['stateid'].'">'.$row['statename'].'</option>';
            }
        }else{
            echo'<option value="">State not available</option>';
        }



        ?>

</select>City:<select id="cityname" name="city"><option value="<?php echo $row['country']; ?>">Select</option>

<?php
if($result->num_rows >0){
    echo'<option value="'.$row['cityid'].'">'.$row['cityname'].'</option>';
}
else{
    echo'<option value="">City not available</option>';
}
?>
</select><br><br>
    Address:<input type="text"  name="address"value="<?php echo $row['address']; ?>"><br><br>
    <button type="submit" name="update" value="<?php echo $_GET['edit']; ?>">Update</button>

  </form>

</body>
</html>