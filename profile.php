<?php $title = "Profile";
    require("includes/parentheader.php");
    $logbook = new logbook;
    $logbook->user_session();
    $student_id = $_SESSION["student_id"];
    $logbook->query = "SELECT * FROM students_table WHERE student_id = '$student_id'";
    $student = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM institution_table WHERE student_id = '$student_id'";
    $ins = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM organization_table WHERE student_id = '$student_id'";
    $org = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM institution_supervisor_table WHERE student_id = '$student_id'";
    $ins_super_arr = $logbook->fetch_assoc();
    $ins_super_total = $logbook->total_rows();
    $logbook->query = "SELECT * FROM organization_supervisor_table WHERE student_id = '$student_id'";
    $org_super_arr = $logbook->fetch_assoc();
    $org_super_total = $logbook->total_rows();
    $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
    $int = $logbook->fetch_assoc();
    $int_super_total = $logbook->total_rows();
    if(count($ins) == 0 || count($org) == 0){
        echo $logbook->redirect("settings.php");
    }
?>
    <main>
        <div class="container">
            <div class="row d-md-flex d-lg-flex d-none d-sm-none">
                <div class="col-md-4">
                    <div class="first-col border-end">
                        <img src="images/student/<?php echo $student["student_image"]; ?>" alt="profile-picture" class="profile-pic img-fluid">
                        <a href="settings.php?settings=account_settings&fetch=image_settings" class="link d-block">Change Profile Image</a>
                        <label class="py-2 ps-3"><strong>Institution Details</strong></label>
                        <h3 class="ps-3"><?php echo $ins["institution_name"]; ?></h3>
                        <p class="ps-3 pb-2 text"><?php echo $ins["address"]; ?></p>
                        <label class="py-2 ps-3"><strong>Organization Details</strong></label>
                        <h3 class="ps-3"><?php echo $org["organization_name"]; ?></h3>
                        <p class="ps-3 pb-2 text"><?php echo $org["address"]; ?></p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="second-col">
                        <div class="general-info">
                            <div class="groups mb-3">
                                <label><strong>Name:</strong></label>
                                <h5 class="text"><?php echo $student["students_name"];?></h5>
                            </div>
                            <div class="groups mb-3">
                                <label><strong>Phone:</strong></label>
                                <h5 class="text">+<?php echo $student["students_phone"];?></h5>
                            </div>
                            <div class="groups mb-3">
                                <label><strong>Address:</strong></label>
                                <h5 class="text">
                                    <?php if(!empty($student["address"])){
                                        echo $student["address"];
                                    }else{
                                        echo "Students address not filled";
                                    } ?>
                                </h5>
                            </div>
                            <div class="groups mb-3">
                                <a href="settings.php?settings=account_settings&fetch=general_settings" class="link">Edit general info</a>
                            </div>
                        </div>
                        <div class="email-info">
                            <div class="groups mb-3">
                                <label><strong>Email:</strong></label>
                                <h5 class="text"><?php echo $student["students_email"];?></h5>
                            </div>
                            <div class="groups mb-3">
                                <a href="settings.php?settings=account_settings&fetch=email_settings" class="link">Edit email</a>
                            </div>
                        </div>
                        <div class="org_super-info">
                            <?php if($org_super_total > 0){?>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Name:</strong></label>
                                    <h5 class="text"><?php echo $org_super_arr["super_name"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Email:</strong></label>
                                    <h5 class="text">+<?php echo $org_super_arr["super_email"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Phone Number:</strong></label>
                                    <h5 class="text">+<?php echo $org_super_arr["super_mobile"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Company Role:</strong></label>
                                    <h5 class="text"><?php echo $org_super_arr["role_played"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Residential Address:</strong></label>
                                    <h5 class="text"><?php echo $org_super_arr["address"];?></h5>
                                </div>
                            <?php }else{?>
                                <div class="groups mb-3">
                                    <label><strong>Organization Supervisor Details:</strong></label>
                                    <h5 class="text">Not Filled</h5>
                                </div>
                            <?php }?>
                                <div class="groups mb-3">
                                    <a href="settings.php?settings=org_super_settings" class="link">Edit organization supervisor details</a>
                                </div>
                        </div>
                        <div class="ins_super-info">
                            <?php if($ins_super_total > 0){?>
                                <div class="groups mb-3">
                                    <label><strong>Institution Supervisor Name:</strong></label>
                                    <h5 class="text"><?php echo $ins_super_arr["super_name"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Institution Supervisor Email:</strong></label>
                                    <h5 class="text"><?php echo $ins_super_arr["super_email"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Institution Supervisor Phone Number:</strong></label>
                                    <h5 class="text">+<?php echo $ins_super_arr["super_mobile"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Institution Supervisor Residential Address:</strong></label>
                                    <h5 class="text"><?php echo $ins_super_arr["super_address"];?></h5>
                                </div>
                            <?php }else{?>
                                <div class="groups mb-3">
                                    <label><strong>Institution Supervisor Details:</strong></label>
                                    <h5 class="text">Not filled</h5>
                                </div>
                            <?php }?>
                                <div class="groups mb-3">
                                    <a href="settings.php?settings=ins_super_settings" class="link">Edit institution supervisor details</a>
                                </div>
                        </div>
                        <div class="internship-info">
                            <?php if($int_super_total > 0){?>
                                <div class="groups mb-3">
                                    <label><strong>Internship Role:</strong></label>
                                    <h5 class="text"><?php echo $int["role_played"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Monthly Allowance:</strong></label>
                                    <h5 class="text">+<?php echo $int["cum_alawee"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Internship Duration:</strong></label>
                                    <h5 class="text">+<?php echo $int["duration"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Innternship Start Date:</strong></label>
                                    <h5 class="text"><?php echo $int["start_date"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Innternship End Date:</strong></label>
                                    <h5 class="text"><?php echo $int["end_date"];?></h5>
                                </div>
                            <?php }else{?>
                                <div class="groups mb-3">
                                    <label><strong>Internship Details:</strong></label>
                                    <h5 class="text">Not filled</h5>
                                </div>
                            <?php }?>
                                <div class="groups mb-3">
                                    <a href="settings.php?settings=internship_settings" class="link">Edit Internship Details</a>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-md-none d-lg-none">
                <div class="card">
                    <div class="card-header">
                        <center class="my-2"><a href="settings.php?settings=account_settings&fetch=image_settings" class="link"><img src="images/student/<?php echo $student["student_image"]; ?>" alt="profile-picture" class="profile-pic card-img-top"></a></center>
                    </div>
                    <div class="card-body">
                        <label class="py-2 ps-3"><strong>Institution Details</strong></label>
                        <h3 class="ps-3"><?php echo $ins["institution_name"]; ?></h3>
                        <p class="ps-3 pb-2 text"><?php echo $ins["address"]; ?></p>
                        <label class="py-2 ps-3"><strong>Organization Details</strong></label>
                        <h3 class="ps-3"><?php echo $org["organization_name"]; ?></h3>
                        <p class="ps-3 pb-2 text"><?php echo $org["address"]; ?></p>
                    </div>
                    <div class="card-footer">
                        <div class="second-col">
                            <div class="general-info">
                                <div class="groups mb-3">
                                    <label><strong>Name:</strong></label>
                                    <h5 class="text"><?php echo $student["students_name"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Phone:</strong></label>
                                    <h5 class="text">+<?php echo $student["students_phone"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <label><strong>Address:</strong></label>
                                    <h5 class="text">
                                        <?php if(!empty($student["address"])){
                                            echo $student["address"];
                                        }else{
                                            echo "Students address not filled";
                                        } ?>
                                    </h5>
                                </div>
                                <div class="groups mb-3">
                                    <a href="settings.php?settings=account_settings&fetch=general_settings" class="link">Edit general info</a>
                                </div>
                            </div>
                            <div class="email-info">
                                <div class="groups mb-3">
                                    <label><strong>Email:</strong></label>
                                    <h5 class="text"><?php echo $student["students_email"];?></h5>
                                </div>
                                <div class="groups mb-3">
                                    <a href="settings.php?settings=account_settings&fetch=email_settings" class="link">Edit email</a>
                                </div>
                            </div>
                            <div class="org_super-info">
                                <?php if($org_super_total > 0){?>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Name:</strong></label>
                                        <h5 class="text"><?php echo $org_super_arr["super_name"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Email:</strong></label>
                                        <h5 class="text">+<?php echo $org_super_arr["super_email"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Phone Number:</strong></label>
                                        <h5 class="text">+<?php echo $org_super_arr["super_mobile"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Company Role:</strong></label>
                                        <h5 class="text"><?php echo $org_super_arr["role_played"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Residential Address:</strong></label>
                                        <h5 class="text"><?php echo $org_super_arr["address"];?></h5>
                                    </div>
                                <?php }else{?>
                                    <div class="groups mb-3">
                                        <label><strong>Organization Supervisor Details:</strong></label>
                                        <h5 class="text">Not Filled</h5>
                                    </div>
                                <?php }?>
                                    <div class="groups mb-3">
                                        <a href="settings.php?settings=org_super_settings" class="link">Edit organization supervisor details</a>
                                    </div>
                            </div>
                            <div class="ins_super-info">
                                <?php if($ins_super_total > 0){?>
                                    <div class="groups mb-3">
                                        <label><strong>Institution Supervisor Name:</strong></label>
                                        <h5 class="text"><?php echo $ins_super_arr["super_name"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Institution Supervisor Email:</strong></label>
                                        <h5 class="text">+<?php echo $ins_super_arr["super_email"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Institution Supervisor Phone Number:</strong></label>
                                        <h5 class="text">+<?php echo $ins_super_arr["super_mobile"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Institution Supervisor Residential Address:</strong></label>
                                        <h5 class="text"><?php echo $ins_super_arr["super_address"];?></h5>
                                    </div>
                                <?php }else{?>
                                    <div class="groups mb-3">
                                        <label><strong>Institution Supervisor Details:</strong></label>
                                        <h5 class="text">Not filled</h5>
                                    </div>
                                <?php }?>
                                    <div class="groups mb-3">
                                        <a href="settings.php?settings=ins_super_settings" class="link">Edit institution supervisor details</a>
                                    </div>
                            </div>
                            <div class="internship-info">
                                <?php if($int_super_total > 0){?>
                                    <div class="groups mb-3">
                                        <label><strong>Internship Role:</strong></label>
                                        <h5 class="text"><?php echo $int["role_played"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Monthly Allowance:</strong></label>
                                        <h5 class="text"><?php echo $int["cum_alawee"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Internship Duration:</strong></label>
                                        <h5 class="text"><?php echo $int["duration"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Innternship Start Date:</strong></label>
                                        <h5 class="text"><?php echo $int["start_date"];?></h5>
                                    </div>
                                    <div class="groups mb-3">
                                        <label><strong>Innternship End Date:</strong></label>
                                        <h5 class="text"><?php echo $int["end_date"];?></h5>
                                    </div>
                                <?php }else{?>
                                    <div class="groups mb-3">
                                        <label><strong>Internship Details:</strong></label>
                                        <h5 class="text">Not filled</h5>
                                    </div>
                                <?php }?>
                                    <div class="groups mb-3">
                                        <a href="settings.php?settings=internship_settings" class="link">Edit Internship Details</a>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <style>
        img.profile-pic{
            width: 300px;
            height: 300px;
            border-radius: 50%;
        }
        .text{
            color: gray;
        }
        .link{
            text-decoration: none;
        } 
        @media screen and (max-width: 764px) {
            img.profile-pic{
                width: 200px;
                height: 200px;
            }
        }
    </style>
<?php require("includes/parentfooter.php"); ?>