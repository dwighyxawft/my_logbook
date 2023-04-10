<?php $title = "Signup";
    require("includes/parentheader.php"); ?>
    <style>
        small a{
            text-decoration: none;
        }
    </style>
    <main>
        <div class="container contact-container d-flex align-items-center justify-content-center">
            <div class="form-responsive p-3 rounded">
                <h3 class="py-2">Signup For Your Account</h3>
                <form method="post" id="signup">
                    <div class="form-group mb-2">
                        <label><strong>Name: </strong></label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Email: </strong></label>
                        <input type="email" name="mail" id="mail" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Phone: </strong></label>
                        <input type="tel" name="phone" id="phone" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Password: </strong></label>
                        <input type="password" name="pass_1" id="pass_1" class="form-control" required>
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Confirm Password: </strong></label>
                        <input type="password" name="pass_2" id="pass_2" class="form-control" required>
                    </div>
                    <small class="py-3 text-primary"><a href="pass_reset.php">Forgotten Password</a></small>
                    <div class="form-group">
                        <center><button type="submit" class="btn btn-success my-2"><i class="fa fa-user-plus"></i> Signup</button></center>
                    </div>
                    <center><small class="py-3">Don't have an account &nbsp;<a href="signup.php">signup here</a></small></center>
                </form>
            </div>
        </div>
    </main>
    <script>
        $(document).ready(function(){
            $("form#signup").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "https://phone-number-validator1.p.rapidapi.com/v1/validatephone",
                    type: "get",
                    headers: {
                        'X-RapidAPI-Key': '69f642d97bmshefa9563e701ffcfp1c1797jsna93ee0514870',
                        'X-RapidAPI-Host': 'phone-number-validator1.p.rapidapi.com'
                    },
                    data: {number: $("input#phone").val()},
                    dataType: "json",
                    success: function(data){
                    if(data.data.isvalid){
                        signup();
                    }else{
                        alert("Your phone number is not valid")
                    }
                    }
                })
            })
            function signup(){
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: {name: $("input#name").val(), mail: $("input#mail").val(), phone: $("input#phone").val(), pass_1: $("input#pass_1").val(), pass_2: $("input#pass_2").val(), page: "student", action: "signup"},
                    dataType: "json",
                    success: function(response){
                        if(response.status){
                            location.href = "profile.php";
                        }
                        else{
                            alert(response.msg);
                        }
                    }
                })
            }
})
    </script>
    <script>var linkId = 9;</script>
    <?php require("includes/parentfooter.php"); ?>