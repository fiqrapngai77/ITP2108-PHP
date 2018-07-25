<?php
include 'dbConnection.php';

if(!isset($_SESSION['currentUser'])){
    exit(header("Location: index.php?user=false"));
    
}

if($_SESSION['accountType'] != "superadmin"){
    header("Location: cameras.php");
}

$currentPage = "Notifications";

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Notifications</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/mainStyleSheet.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="javascript/dashboardJS.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
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
            
            <div class="row">
                <!--Table to view the fly counts for the selected company-->
                <table id="dashboardTable" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                      <tr>
                        <th>Request Type</th>
                        <th>Username</th>
                        <th>Actions</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      
                        $requestQuery = "SELECT * FROM requests";
                        $result = $conn->query($requestQuery);

                        if ($result->num_rows > 0) {
                            // output data of each row
                            while ($row = $result->fetch_assoc()) {
                                
                                ?>

                                <tr>
                                    <td><?php echo $row["requestType"] ?></td>
                                    <td><?php echo $row["username"] ?></td>
                                    <td>
                                        <form method="post" action="resetPassword.php">
                                            <input style="display: none;" name="username" value="<?php echo $row["username"] ?>"/>
                                            <button type="submit" class="btn btn-primary" >Reset Password</button>
                                        </form>
                                        
                                    </td>
                                </tr>

                                <?php
                            }
                        } else {
                            echo "0 results";
                        }
                            
                      
                
                ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </body>
    
</html>