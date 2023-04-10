<?php $title = "Contact Us";
    require("includes/parentheader.php"); ?>
    <main>
        <div class="container contact-container d-flex align-items-center justify-content-center">
            <div class="form-responsive p-3 rounded">
                <h3 class="py-2">Contact Us</h3>
                <form method="post" id="contact_us">
                    <div class="form-group mb-2">
                        <label><strong>Name: </strong></label>
                        <input type="text" name="name" id="" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Email: </strong></label>
                        <input type="email" name="email" id="" class="form-control">
                    </div>
                    <div class="form-group mb-2">
                        <label><strong>Phone: </strong></label>
                        <input type="tel" name="phone" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><strong>Message: </strong></label>
                        <textarea name="message" id="" cols="30" rows="6" class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="page" value="contact_us">
                        <input type="hidden" name="action" value="contact_us">
                    </div>
                    <div class="form-group">
                        <center><button type="submit" class="btn btn-success my-2">Submit</button></center>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        var linkId = 3;
    </script>
    <script>
        $(document).ready(function(){
            $("form#contact_us").on("submit", function(e){
                e.preventDefault();
                console.log("submitted");
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(data){
                        if(data.status){
                            alert("Your message has been sent");
                        }
                        else{
                            alert("Please try again");
                        }
                    }
                })
            })
        })
    </script>
    <?php require("includes/parentfooter.php"); ?>