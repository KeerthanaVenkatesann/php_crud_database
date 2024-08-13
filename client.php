<?php
$con=mysqli_connect("127.0.0.1","root","","phonebook");
if(isset($_POST["id"]) &&$_POST["id"]==0&&isset($_POST["name"]) && ($_POST["name"])){
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $sql="INSERT INTO phonebook(`name`,`phone`) VALUES('$name','$phone')";
    mysqli_query($con,$sql);
}
if(isset($_POST["id"]) &&$_POST["id"]!=0&&!isset($_POST["name"])){
    $id=$_POST["id"];
    $sql="SELECT * FROM phonebook WHERE id=$id";
    $result1=mysqli_query($con,$sql);
    $row1=mysqli_fetch_array($result1);
    echo json_encode($row1);
}
if(isset($_POST["id"]) &&$_POST["id"]!=0&&isset($_POST["name"]) && !empty($_POST["name"])){
    $id=$_POST["id"];
    $name=$_POST["name"];
    $phone=$_POST["phone"];
    $sql="UPDATE phonebook SET name='$name',phone='$phone' WHERE id=$id";
    mysqli_query($con,$sql);
}
?>