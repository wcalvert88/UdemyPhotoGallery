<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Admin
                <small>Subheading</small>
            </h1>
            
            <?php 

            // $user = new User();
            // $user->username = "SuaveTheThird12";
            // $user->password = "password";
            // $user->first_name = "Rick";
            // $user->last_name = "Suavo";
        
            // $user->create();

            $user = User::find_user_by_id(11);
            $user->username = "Williamson2";
            $user->password = "Williamson32";
            $user->first_name = "Williamson43";
            $user->last_name = "Williamson45";

            $user->update();

            // $user = User::find_user_by_id(3);
            // $user->delete();
            
            // $user = User::find_user_by_id(8);
            // $user->password = "justPassword";
            // $user->save();

            // $user = new User();
            // $user->username = "SUAVE";
            // $user->save();

            // $user = User::find_user_by_id(8);
            // $user->delete();
            
            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container-fluid -->