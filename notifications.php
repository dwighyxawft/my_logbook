<?php $title = "Notifications";
    require("includes/parentheader.php");
    $logbook = new logbook;
    $logbook->user_session();
    $student_id = $_SESSION["student_id"];
    $logbook->query = "SELECT * FROM notifications_table WHERE student_id = '$student_id'";
    $total_rows = $logbook->total_rows();
    $notifications = $logbook->fetch_all();
?>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6 border">
                    <?php if($total_rows > 0){ ?>
                        <?php foreach($notifications as $notification){?>
                            <div class="notification my-3 border-bottom">
                                <p class="text-center px-2"><strong><?php echo $notification["body"]; ?></strong></p>
                            </div>
                        <?php }?>
                    <?php }else{?>
                        <div class="notification my-3 border-bottom">
                            <h1 class="text-center">You have no notifications yet</h1>
                        </div>
                    <?php }?>    
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </main>
<?php require("includes/parentfooter.php"); ?>