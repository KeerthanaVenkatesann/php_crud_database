<?php
include("client.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phone book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row">
       <div class="col-12">         
            <div class="input-group mt-5">
                <input type="hidden" id="id" value="0" >
                <input type="text" id="name" class="form-control" placeholder="name">
                <input type="text" id="phone" class="form-control" placeholder="phone number">
                <button id="btn"  class="btn btn-primary">Add</button>
            </div>
            <table class="table table-bordered mt-5">
                <thead>
                    <tr>
                        <th>S.no</th>
                        <th>name</th>
                        <th>phone number</th>
                        <th>action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $sql="SELECT * FROM phonebook";
                    $query=mysqli_query($con,$sql);
                    $sno=0;
                    while($user=mysqli_fetch_array($query)){
                    ?>
                    <tr>
                        <td><?php echo ++$sno; ?></td>
                        <td><?php echo $user['name']; ?></td>
                        <td><?php echo $user['phone']; ?></td>
                        <td>
                            <button class="btn btn-primary btn_edit" item_id="<?php echo $user['id']; ?>">edit</button>
                            <button class="btn btn-danger btn_delete"  item_id="<?php echo $user['id']; ?>">delete</button>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
       </div>
   </div>
</div>
<script>
$('#btn').click(function(){
    var name=$("#name").val();
    var id=$("#id").val(); 
    var phone=$("#phone").val();
    $.ajax({
        url:'client.php',
        method:'post',
        data:{id:id,name:name,phone:phone},
        success:function(data){
            window.location.reload();
            // alert(data);
        }
    });
});
$('.btn_edit').click(function(){
    $('#btn').html('update');
    var id=$(this).attr('item_id');
    $.ajax({
        url:'client.php',
        method:'post',
        data:{id:id},
        dataType:'JSON',
        success:function(data){
            // alert(data);
            $('#id').val(data.id);
            $('#name').val(data.name);
            $('#phone').val(data.phone);
        }
    });
});

</script>
</body>
</html>
