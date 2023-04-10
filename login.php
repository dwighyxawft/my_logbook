<?php $title = "Login";
    require("includes/parentheader.php"); ?>
    <style>
        small a{
            text-decoration: none;
        }
    </style>
    <main>
        <div class="container contact-container d-flex align-items-center justify-content-center">
            <div class="form-responsive p-3 rounded">
                <h3 class="py-2">Login To Your Account</h3>
                <form method="post" id="login">
                    <div class="form-group mb-2">
                        <label><strong>Email: </strong></label>
                        <input type="email" name="mail" id="" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Password: </strong></label>
                        <input type="password" name="pass" id="" class="form-control">
                    </div>
                    <small class="py-3 text-primary"><a href="pass_reset.php">Forgotten Password</a></small>
                    <div class="form-group">
                        <input type="hidden" name="page" value="student">
                        <input type="hidden" name="action" value="login">
                    </div>
                    <div class="form-group">
                        <center><button type="submit" class="btn btn-success my-2"><i class="fa fa-sign-in"></i>Login</button></center>
                    </div>
                    <center><small class="py-3">Don't have an account &nbsp;<a href="signup.php">signup here</a></small></center>
                </form>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function(){
            $("form#login").on("submit", function(e){
                e.preventDefault();
                console.log("submitted");
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            alert("You are logged in " + data.message);
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    }
                })
            })
        })
    </script>
<?php require("includes/parentfooter.php"); ?>