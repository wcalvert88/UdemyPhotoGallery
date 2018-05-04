<?php 
require_once("admin/includes/init.php");

if(empty($_GET['id'])) {
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

if(isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $timestamp = date("Y/m/d H:i:s");
    $new_comment = Comment::create_comment($photo->id, $author, $body, $timestamp);

    if($new_comment && $new_comment->save()) {
        
        redirect("photo.php?id={$photo->id}");
    } else {
        $message = "There was some problems saving this comment";
    }
} else {
    $author = "";
    $body = "";

}

$comments = Comment::find_comments($photo->id);

require_once("includes/header.php");
?>


            <!-- Blog Post Content Column -->
            <div class="row">
            <div class="col-lg-12">

                <!-- Blog Post -->

                <!-- Title -->
                <?php if(empty($photo->title)) {
                    $photo->title = "Image";
                } ?>
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">Wade Calvert</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path(); ?>" alt="<?php echo $photo->alternate_text; ?>">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->description; ?></p>

                <hr>

                <!-- Blog Comments -->





                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" method="post">
                    <div class="form-group">
                        <label for="author">Author</label>
                            <input type="text" name="author" class="form-control">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" name="body"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>







                <hr>

                <!-- Posted Comments -->



                <?php foreach ($comments as $comment): ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
                            <small><?php echo "commented at " . $comment->timestamp; ?></small>
                        </h4>
                        <?php echo $comment->body; ?>
                    </div>
                </div>
            <?php endforeach; ?>

                

            </div>


    <!-- Blog Sidebar Widgets Column -->
    <!-- <div class="col-md-4"> -->


    <?php //include("includes/sidebar.php"); ?>



 <!-- </div> -->
<!-- /.row -->
</div>
<?php include("includes/footer.php"); ?>
