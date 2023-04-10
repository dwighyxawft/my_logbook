<?php   $title = "Settings"; require("includes/parentheader.php");
        $logbook = new logbook;
        $logbook->user_session();
        $student_id = $_SESSION["student_id"];
        $logbook->query = "SELECT * FROM students_table WHERE student_id = '$student_id'";
        $student = $logbook->fetch_assoc();
        $logbook->query = "SELECT * FROM organization_supervisor_table WHERE student_id = '$student_id'";
        $org_super_details = $logbook->total_rows() == 1 ? $logbook->fetch_assoc() : false;
        $logbook->query = "SELECT * FROM institution_supervisor_table WHERE student_id = '$student_id'";
        $ins_super_details = $logbook->total_rows() == 1 ? $logbook->fetch_assoc() : false;
        $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
        $internship = $logbook->total_rows() == 1 ? $logbook->fetch_assoc() : false;
?>
    <main>
        <div class="settings container">
            <?php if($student["institution_id"] == 0){?>
                    <div class="row institution rows" data-display="1" id="ins_div">
                        <div class="col-md-2"></div>
                        <div class="col">
                            <div class="container" id="institution_settings">
                            <form method="post" enctype="multipart/form-data" id="institution_form" class="needs-validation">
                                <h1 class="title py-3">Add Your Institution Details</h1>
                                <div class="form-group mb-2">
                                    <label><strong>Institution Name:</strong></label>
                                    <input type="text" name="ins_name" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Institution Email:</strong></label>
                                    <input type="email" name="ins_mail" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Institution Address:</strong></label>
                                    <input type="text" name="ins_addr" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Course Of Study:</strong></label>
                                    <input type="text" name="course" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Faculty:</strong></label>
                                    <input type="text" name="faculty" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Department:</strong></label>
                                    <input type="text" name="dept" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Institution Image:</strong></label>
                                    <input type="file" name="image" id="" class="form-control" required>
                                </div>
                                <input type="hidden" name="page" value="student">
                                <input type="hidden" name="action" value="institution">
                                <div class="form-group mb-2">
                                    <label><strong>Programme:</strong></label>
                                    <select name="program" id="" class="form-control form-select">
                                        <option value="Bsc">Bachelor Of Science</option>
                                        <option value="Hnd">Higher National Diploma</option>
                                        <option value="Ong">Ordinary National Diploma</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Year Of Study:</strong></label>
                                    <select name="level" id="" class="form-control form-select">
                                        <option value="1">First Year</option>
                                        <option value="2">Second Year</option>
                                        <option value="3">Third Year</option>
                                        <option value="4">Fourth Year</option>
                                        <option value="5">Fifth Year</option>
                                    </select>
                                </div>
                                <div class="form-group mb-2">
                                    <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                </div>

                            </form>
                        </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
            <?php }?>
            <?php if($student["organization_id"] == 0){ ?>
                    <div class="row organization rows" data-display="2" id="org_div">
                        <div class="col-md-2"></div>
                        <div class="col">
                            <div class="container" id="organization_settings">
                            <form method="post" enctype="multipart/form-data" id="organization_form" class="needs-validation">
                                <h1 class="title py-3">Add Your Organization Details</h1>
                                <div class="form-group mb-2">
                                    <label><strong>Organization Name:</strong></label>
                                    <input type="text" name="org_name" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Organization Email:</strong></label>
                                    <input type="email" name="org_mail" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Organization Address:</strong></label>
                                    <input type="text" name="org_addr" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Organization Mobile:</strong></label>
                                    <input type="tel" name="org_mobile" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Department:</strong></label>
                                    <input type="text" name="org_dept" id="" class="form-control" required>
                                </div>
                                <div class="form-group mb-2">
                                    <label><strong>Organization Image:</strong></label>
                                    <input type="file" name="org_image" id="" class="form-control" required>
                                </div>
                                <input type="hidden" name="page" value="student">
                                <input type="hidden" name="action" value="organization">
                                <div class="form-group mb-2">
                                    <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                </div>

                            </form>
                        </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
            <?php }?>
            <?php if(!isset($student["student_image"]) || !isset($student["gender"])){ ?>
                        <div class="row student_settings rows" data-display="3" id="set_div">
                            <div class="col-md-2"></div>
                            <div class="col">
                                <div class="container" id="student_settings">
                                <form method="post" enctype="multipart/form-data" id="complete_settings" class="needs-validation">
                                    <h1 class="title py-3">Complete Your Profile</h1>
                                    <div class="form-group mb-2">
                                        <label><strong>Student Image:</strong></label>
                                        <input type="file" name="image" id="" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="account_update">
                                    <div class="form-group mb-2">
                                        <label><strong>Student Gender:</strong></label>
                                        <select name="gender" id="" class="form-control form-select">
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>

                                </form>
                            </div>
                            </div>
                            <div class="col-md-2"></div>
                        </div>
            <?php }?>
        </div>
        <?php if($student["institution_id"] != 0 || $student["organization_id"] != 0 || (!empty($student["student_image"]) || !empty($student["gender"]))){?>
            <div class="container account_settings">
                <div class="general_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="general_settings" class="needs-validation">
                                    <h1 class="text-center py-3">Edit Your General Information</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Name: </strong></label>
                                        <input type="text" name="name" value="<?php echo $student["students_name"];?>" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Phone: </strong></label>
                                        <input type="tel" name="phone" value="<?php echo $student["students_phone"];?>" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Address: </strong></label>
                                        <input type="text" name="addr" value="<?php echo $student["address"];?>" id="" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="edit_general_info">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
                <div class="password_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="change_password" class="needs-validation">
                                    <h1 class="text-center py-3">Edit Your Password</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Old Password: </strong></label>
                                        <input type="password" name="old_pass" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>New Password: </strong></label>
                                        <input type="password" name="new_pass" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Confirm Password: </strong></label>
                                        <input type="password" name="con_pass" id="" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="edit_password">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
                <div class="image_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="profile_picture" class="needs-validation">
                                    <h1 class="text-center py-3">Change Profile Picture</h1>
                                    <div class="input-group mb-3">
                                        <input type="hidden" name="page" value="student">
                                        <input type="hidden" name="action" value="change_profile_picture">
                                        <input type="file" name="image" id="" class="form-control">
                                        <button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
                <div class="email_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="change_email" class="needs-validation">
                                    <h1 class="text-center py-3">Change Email Address</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Email:</strong></label>
                                        <input type="email" name="email" value="<?php echo $student["students_email"];?>" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3 d-none">
                                        <label><strong>OTP:</strong></label>
                                        <input type="number" name="otp" id="otp" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="change_email_address">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container org_super_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="org_super_info" class="needs-validation">
                                    <h1 class="text-center py-3">Edit Organization Supervisor's settings</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Name: </strong></label>
                                        <input type="text" value="<?php echo $org_super_details["super_name"];?>" name="name" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Email: </strong></label>
                                        <input type="email" value="<?php echo $org_super_details["super_email"];?>" name="mail" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Phone: </strong></label>
                                        <input type="tel" value="<?php echo $org_super_details["super_mobile"];?>" name="phone" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Address: </strong></label>
                                        <input type="text" value="<?php echo $org_super_details["address"];?>" name="addr" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Company Role: </strong></label>
                                        <input type="text" value="<?php echo $org_super_details["role_played"];?>" name="role" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Supervisor Signature Image: </strong></label>
                                        <input type="file" name="image" id="" class="form-control">
                                        <?php if($org_super_details){ ?>
                                            <center><img src="images/org_sign/<?php echo $org_super_details["internship_signature_image"];?>" alt="Signature Image" class="img-fluid signature mt-4"></center>
                                        <?php }?>
                                    </div>
                                    
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="edit_org_super_info">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div> 
                            <div class="col-md-3"></div>
                        </div>
                    </div>
            </div>
            <div class="container ins_super_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="ins_super_info" class="needs-validation">
                                    <h1 class="text-center py-3">Edit Institution Supervisor's settings</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Name: </strong></label>
                                        <input type="text" value="<?php echo $ins_super_details["super_name"];?>" name="name" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Email: </strong></label>
                                        <input type="email" value="<?php echo $ins_super_details["super_email"];?>" name="mail" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Phone: </strong></label>
                                        <input type="tel" value="<?php echo $ins_super_details["super_mobile"];?>" name="phone" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Address: </strong></label>
                                        <input type="text" value="<?php echo $ins_super_details["address"];?>" name="addr" id="" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="edit_ins_super_info">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
            </div>
            <div class="container internship_settings setting">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-6">
                                <form method="post" id="internship" class="needs-validation">
                                    <h1 class="text-center py-3">Edit Internship settings</h1>
                                    <div class="form-group mb-3">
                                        <label><strong>Role in Company</strong></label>
                                        <input type="text" value="<?php echo $internship["role_played"]; ?>" name="role" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Company Allowance</strong></label>
                                        <input type="text" value="<?php echo $internship["cum_alawee"]; ?>" name="allowance" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Internship Duration</strong></label>
                                        <select name="duration" id="" class="form-control form-select">
                                            <option disabled>Select your internship duration</option>
                                            <option value="+2 weeks">2 weeks</option>
                                            <option value="+3 months">3 months</option>
                                            <option value="+6 months">6 months</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Internship Start Date</strong></label>
                                        <input type="date" value="<?php echo $internship["start_date"]; ?>" name="start_date" id="" class="form-control">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label><strong>Internship End Date</strong></label>
                                        <input type="date" value="<?php echo $internship["end_date"]; ?>" name="end_date" id="" class="form-control">
                                    </div>
                                    <input type="hidden" name="page" value="student">
                                    <input type="hidden" name="action" value="internship_settings">
                                    <div class="form-group mb-3">
                                        <center><button type="submit" class="btn btn-success"><i class="fa fa-send"></i> Submit</button></center>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3"></div>
                        </div>
                    </div>
            </div>
        <?php }?>
    </main>
        <?php
           function display_div(){
                global $student;
                if(($student["institution_id"] == 0 && $student["organization_id"] == 0) && (empty($student["student_image"]) || empty($student["gender"]))){
                    return 1;
                }else if(($student["institution_id"] != 0 && $student["organization_id"] == 0) && (empty($student["student_image"]) || empty($student["gender"]))){
                    return 2;
                }else if(($student["institution_id"] != 0 && $student["organization_id"] != 0) && (empty($student["student_image"]) || empty($student["gender"]))){
                    return 3;
                }else if(($student["institution_id"] != 0 && $student["organization_id"] != 0) && (!empty($student["student_image"]) && !empty($student["gender"]))){
                    return false;
                }
           }
        ?>



    <script>
        var rows = document.querySelectorAll("div.rows");
        var active_div = "<?php echo display_div(); ?>";
        rows.forEach(function(row){
            row.classList.add("d-none");
            if(active_div){
                if(row.getAttribute("data-display") == active_div){
                    row.classList.remove("d-none");
                }
            }
        })
    </script>
    <script>
        var settings = document.querySelectorAll(".setting");
        settings.forEach(function(setting){
            setting.classList.add("d-none");
            var url_string = window.location.href;
            var url = new URL(url_string);
            var paramValue = url.searchParams.get("settings");
            var secondValue;
            if(paramValue == "account_settings"){
                secondValue = url.searchParams.get("fetch");
                if(setting.classList.contains(secondValue)){
                    setting.classList.remove("d-none");
                }
            }else{
                if(setting.classList.contains(paramValue)){
                    setting.classList.remove("d-none");
                }
            }
        })
    </script>
    <script>
       $(document).ready(function(){
            var organization_form = $("#organization_form");
            var complete_settings = $("#complete_settings");
            var form_data;
            console.log("logging")
            $("form#institution_form").on("submit", function(e){
                e.preventDefault();
                form_data = new FormData($(this)[0]);
                $.ajax({
                        url: "includes/ajax.php",
                        type: "post",
                        async: false,
                        data: form_data,
                        success: function(data){
                            res = JSON.parse(data);
                            if(res.status){
                                alert("Institution details uploaded successfully");
                                $("div#ins_div").addClass("d-none");
                                $("div#org_div").removeClass("d-none");
                            }
                            else{
                                alert(res.message);
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    })
            })
            organization_form.on("submit", function(e){
                e.preventDefault();
                form_data = new FormData($(this)[0]);
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    async: false,
                    data: form_data,
                    success: function(data){
                        res = JSON.parse(data);
                        if(res.status){
                            console.log("Organization details has been uploaded successfully");
                            $("div#org_div").addClass("d-none");
                            $("div#set_div").removeClass("d-none");
                        }
                        else{
                            alert(res.message);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
            complete_settings.on("submit", function(e){
                e.preventDefault();
                form_data = new FormData($(this)[0]);
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    async: false,
                    data: form_data,
                    success: function(data){
                        res = JSON.parse(data);
                        if(res.status){
                            alert("Your details have been uploaded");
                            location.href = "profile.php";
                        }
                        else{
                            alert(res.message);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
            $("form#general_settings").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json", 
                    success: function(data){
                        console.log(data);
                        if(data.status){
                            alert("Account details updated successfully");
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    }
                })
            })
            $("form#change_password").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json", 
                    success: function(data){
                        if(data.status){
                            alert("Account details updated successfully");
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    }
                })
            })
            $("form#profile_picture").on("submit", function(e){
                e.preventDefault();
                form_data = new FormData($(this)[0]);
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: form_data,
                    async: false, 
                    success: function(res){
                        data = JSON.parse(res);
                        if(data.status){
                            alert("Profile Image Updated successfully");
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
            $("form#change_email").on("submit", function(e){
                e.preventDefault();
                    $.ajax({
                        url: "includes/ajax.php",
                        type: "post",
                        data: $(this).serialize(),
                        dataType: "json", 
                        success: function(data){
                            if(data.first){
                                $("input#otp").removeClass("d-none");
                                $("input#otp").attr("required", true);
                                if($("input#otp").val().length == 6){
                                    $(this).submit();
                                }
                            }else if(data.status){
                                alert("Your email has been updated sucessfully");
                                location.href = "profile.php"
                            }
                            else{
                                alert(data.message);
                            }
                        }
                    })
            })
            $("form#org_super_info").on("submit", function(e){
                e.preventDefault();
                form_data = new FormData($(this)[0]);
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: form_data,
                    async: false, 
                    success: function(res){
                        data = JSON.parse(res);
                        if(data.status){
                            alert("Organization based supervisor details updated successfully");
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                })
            })
            $("form#ins_super_info").on("submit", function(e){
                e.preventDefault();
                console.log("submitted");
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json", 
                    success: function(data){
                        if(data.status){
                            alert("Institution based supervisor details updated successfully");
                            location.href = "profile.php";
                        }
                        else{
                            alert(data.message);
                        }
                    }
                })
            })
            $("form#internship").on("submit", function(e){
                e.preventDefault();
                $.ajax({
                    url: "includes/ajax.php",
                    type: "post",
                    data: $(this).serialize(),
                    dataType: "json", 
                    success: function(data){
                        if(data.status){
                            alert("Institution based supervisor details updated successfully");
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