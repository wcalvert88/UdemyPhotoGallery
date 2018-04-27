<?php include("includes/header.php");
if(!$session->is_signed_in()) {
    redirect("login.php");
}

$users = User::find_all();
?>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
    <?php include("includes/top_nav.php"); ?>


        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        
    <?php include("includes/side_nav.php"); ?>


        <!-- /.navbar-collapse -->
    </nav>




    <div id="page-wrapper">
    <div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Users
                <small>Subheading</small>
            </h1>
            <div class="col-md-12">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Username</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($users as $user) : ?>
                        <tr>
                            <td><?php echo $user->id; ?></td>
                            <td>
                                <img class="admin-user-thumbnail" src="<?php echo $user->user_image; ?>" alt="" width="200px">
                            </td>
                            <td><?php echo $user->username; ?>                                <div class="action_links">
                                    <a href="delete_user.php?id=<?php echo $user->id;?>">Delete</a>
                                    <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                    <a href="view_user.php?id=<?php echo $user->id; ?>">View</a>
                                </div></td>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td>
                        </tr>

                        <?php endforeach; ?>
                    </tbody>   
                </table>

            
            
            
            </div>
        </div>
    </div>
    <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

<?php include("includes/footer.php"); ?>