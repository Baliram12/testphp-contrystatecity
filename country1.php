<!DOCTYPE html>
<html>
<head>
	<title>form</title>
	<script src="jquery.min.js"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
 <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

</head>
<body>
<?php 
    session_start();
    $conn =mysqli_connect('localhost', 'root', '');
    mysqli_select_db($conn,'userregistration');
    $sql = "select * from usertable ";
   $result = mysqli_query($conn,$sql);
    ?>
    <?php 
    function pre_r($array){
        echo'<pre>';
        print_r($array);
        echo'<pre>';
    }
    ?>
    <h2>Registration Form</h2>
    <form method="post" action="country1.php">
    Name:<input type="text" name="Name"><br><br>
    Phone:<input type="text" name="Phone"><br><br>
    Email:<input type="text" name="Email"><br><br>

    Date of Birth:<input type="date" id="start" name="Dob"min="1970-01-01" max="2019-12-31"><br><br>
    Country:<select name="country" id="countrybaliram">
    <option value="">Select </option>
    <?php 
    $sql4 = "select * from countrytable ";
    $result4 = mysqli_query($conn,$sql4);
    if($result4->num_rows > 0){ 
        while($row4 = $result4->fetch_assoc()){  
            echo '<option value="'.$row4['countryid'].'">'.$row4['countryname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
    ?>
</select>
State:<select  id="statename" name="state"><option value=""> Select </option>
        

</select>
    City:<select id="cityname" name="city"><option value="">Select</option>
        

</select><br><br>



Address:<input type="text" name="Address"><br><br>
<button type="submit" name="submit" value="submit">Submit</button>
<button type="submit"><a href="country1.php"> Clear </a></button>

<?php
$conn=mysqli_connect('localhost','root','');
mysqli_select_db($conn,'usercountry');
$sql = "select * from countrytable";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($conn){

    //echo"Sucessfully Connected";
}
else{

    echo"connection failed";
}
$Servername = "localhost";
$conn =mysqli_connect('localhost', 'root', '');
mysqli_select_db($conn,'userregistration');
if(isset($_POST['submit'])){
$name = $_POST['Name'];
$phone = $_POST['Phone'];
$email = $_POST['Email'];
$dob = $_POST['Dob'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$address = $_POST['Address'];
$sql = "select * from usertable where email = '$email' ";
$result = mysqli_query($conn,$sql);
$num = mysqli_num_rows($result);
if($num == 1){
    //echo"Email Already";
}
else
{
    $reg = "insert into usertable(name,phone,email,dob,country,state,city,address) values ('$name','$phone','$email','$dob','$country','$state','$city','$address')";
    mysqli_query($conn,$reg);
    //echo"Data is insert into Table Successful";
}
}
$name="";
$phone="";
$email="";
$dob="";
$country="";
$state="";
$city="";
$address="";
if (isset($_GET['edit'])) {
         $id = $_GET['edit'];
         $sql = "SELECT * FROM usertable WHERE id=$id";
         $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
            $name = $row['name'];
            $phone =$row['phone'];
            $email =$row['email'];
            $dob = $row['dob'];
            $country = $row['country'];
            $state = $row['state'];
            $city = $row['city'];
            $address = $row['address'];
        }
  if(isset($_REQUEST['update'])){
    $id = $_REQUEST['update'];
    $name=$_REQUEST['name'];
    $phone=$_REQUEST['phone'];
    $email=$_REQUEST['email'];
    $dob=$_REQUEST['dob'];
    $country=$_REQUEST['country'];
    $state=$_REQUEST['state'];
    $city=$_REQUEST['city'];
    $address=$_REQUEST['address'];
    $sql = "UPDATE usertable SET name='$name', phone='$phone',email='$email',dob='$dob',country='$country',state='$state',city='$city',address='$address' WHERE id='$id'";
    mysqli_query($conn,$sql);
  }

  if(isset($_REQUEST['Delete'])){
    $id = $_REQUEST['Delete'];
    $sql="DELETE FROM usertable WHERE id='$id'";
    mysqli_query($conn,$sql);

  

}
?>






 <h2>Table Record Here</h2>
        <table>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Dob</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
       
       <?php


$sql6="select countrytable.*,usertable.*,statetable.*,citytable.*
from  usertable 
inner join countrytable 
on usertable.country=countrytable.countryid
inner join statetable 
on usertable.state=statetable.stateid
inner join citytable on usertable.city=citytable.cityid";
$result6 = mysqli_query($conn,$sql6);
  while($row3 = mysqli_fetch_assoc($result6)) { ?>
         <tr>
         <td><?php echo $row3['id'];?></td>
         <td><?php echo $row3['name'];?></td>
         <td><?php echo $row3['phone'];?></td>
         <td><?php echo $row3['email'];?></td>
         <td ><?php echo $row3['dob'];?></td>
         <td><?php echo $row3['countryname'];?></td>
         <td><?php echo $row3['statename'];?></td>
         <td><?php echo $row3['cityname'];?></td>
         <td><?php echo $row3['address'];?></td>
         <td><a href="edit.php?edit=<?php echo $row3['id'];?>"> Edit </a></td>
         <td ><a href="?Delete=<?php echo $row3['id'];?>"> Delete </a></td>
        </tr>
        <?php } ?>
        </table>
        </form>
        </body>
        </html>
       

<script>
$(document).ready(function(){


    $('#countrybaliram').change(function(){
        var countryid = $(this).val();
        if(countryid!='')
        {
            $.ajax({
            type:'POST',
            url:'ajaxData.php',
            data: {'countryid':countryid},
            success:function(data){

                $('#statename').html(data);
                
        }
            }); 
        }
    });


$('#statename').change(function(){
    var stateid = $(this).val();
     if(stateid!='')
        {
            $.ajax({
            type:'POST',
            url:'ajax.php',
            data: {'stateid':stateid},
            success:function(data){
                
                $('#cityname').html(data);
        }
            }); 
        }

});


});


</script>


   	

