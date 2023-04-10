    <?php $title = "Get Started";
    require("includes/parentheader.php"); ?>
    <main>
        <div class="container index-container">
           <div class="col-1">
               <div>
                <p class="pt-5"><strong>EVERY STUDENT YEARNS TO LEARN</strong></p>
                    <h2>Making Every Students <br> World Better</h2>
                    <p>Replenish seasons may male hath fruit beasts were seas saw you arrie said man 
                        beast whales his void unto last session for bite. Set have great you'll male grass 
                        yielding yielding man
                    </p>
                    <?php if(!isset($_SESSION["student_id"])){?>
                        <a href="login.php" class="btn border border-dark rounded-pill p-3 login"><strong>Login</strong></a>
                        <a href="signup.php" class="btn btn-dark rounded-pill p-3 ms-2 signup"><strong>Signup</strong></a>
                    <?php }else{ ?>
                        <a href="logout.php" class="btn btn-dark rounded-pill p-3 ms-2 signup"><strong>Logout</strong></a>
                    <?php }?>
               </div>
           </div>
           <div class="col-2">
                <img src="images/parent/students-reading.png" alt="Students">
           </div>
        </div>
    </main>
    <script>
        var linkId = 1;
    </script>
    <?php require("includes/parentfooter.php"); ?>