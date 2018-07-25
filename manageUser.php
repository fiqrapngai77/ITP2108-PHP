<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

if(isset($_GET['registered'])){
        $message = "User has been successfully registered";
}

if($_SESSION['accountType'] != "superadmin"){
    header("Location: cameras.php");
}
$currentPage = "User Management";


?>
<!DOCTYPE html>
<html>
    <head>
        <title>Users Management</title>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="300">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/mainStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    
    <body>
        <!--Navbar-->
        <?php
        include 'navbar.php';
        ?>
        
        <!--Content-->
        <div class="container">
            <div class="row">
                <p class="pageTitle"><?php echo $currentPage ?></p>
                
                <hr>
            </div>
            
            <!--Table showing all the cameras-->
            <div class="row">
                <a href="signUp.php"><button type="submit" class="btn btn-success">Add User</button></a>

                <br><br>
                <!--Message (if applicable)-->
                <small id="errorMessage"><?php if(isset($message)){echo $message;} ?></small>
                
                <h2>Admin Accounts</h2>
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>User ID</th>
                        <th>Account Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $currentUser = $_SESSION['currentUser'];
                        $adminUserQuery = "SELECT * FROM users WHERE accountType = 'superadmin' ";
                        $adminResultQuery = $conn->query($adminUserQuery);
                        if ($adminResultQuery->num_rows>0) {
                            // output data of each row
                            while ($adminResultRow = $adminResultQuery->fetch_assoc()) {
                                $id = $adminResultRow['ID'];
                                $name = $adminResultRow['user'];
                                ?>

                                <tr id="<?php echo $id?>" >
                                    <td><?php echo  $id?></td>
                                    <td><?php echo  $name?></td>
                                    
                                    <td>
                                   
                                        <!--Delete Button-->
                                        <button class="btn btn-danger remove">Delete</button>
                                    </td>

                                </tr>
                                <?php
                            }
                        } 
                        ?>
                    </tbody>
                </table>
                
                <br>
                
                <h2>Non-Admin Accounts</h2>
                <table class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>User ID</th>
                        <th>Account Name</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $userQuery = "SELECT * FROM users WHERE accountType != 'superadmin' ";
                        $result = $conn->query($userQuery);
                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                $id = $row['ID'];
                                $name = $row['user'];
                                ?>

                                <tr id="<?php echo $id?>" >
                                    <td><?php echo  $id?></td>
                                    <td><?php echo  $name?></td>
                                    
                                    <td>
                                   
                                        <!--Delete Button-->
                                        <button class="btn btn-danger remove">Delete</button>
                                    </td>

                                </tr>
                                <?php
                            }
                        } 
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </body>
    
    <script type="text/javascript">
        $(".remove").click(function(){
            var id = $(this).parents("tr").attr("id");


            if(confirm('Are you sure you want to remove this user from the system?'))
            {
                $.ajax({
                   url: 'deleteUser.php',
                   type: 'GET',
                   data: {ID: id},
                   error: function() {
                        alert('Something is wrong');
                   },
                   success: function() {
                        $("#"+id).remove();
                        alert("User successfully removed");  
                   }
                });
            }
        });


    </script>
</html>