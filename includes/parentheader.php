<?php session_start();
require("classes.php");
$logbook = new logbook; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=7">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/popper2.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <title>mylogbook || <?php echo $title; ?></title>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
            <a href="/" class="navbar-brand ps-4"><img src="images/parent/logo.png" alt="mylogbook_logo" width="70" height="90"> mylogbook</a>
            <button class="navbar-toggler me-3" data-bs-toggle="offcanvas" data-bs-target="#navCanvas"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse justify-content-end pe-4">
                <ul class="navbar-nav nav nav-pill">
                    <li class="nav-item pe-3"><a href="about.php" class="nav-link links" data-link="2"><i class="fa fa-book"></i> ABOUT</a></li>
                    <li class="nav-item pe-3"><a href="contact.php" class="nav-link links" data-link="3"><i class="fa fa-phone"></i> CONTACT</a></li>
                    <li class="nav-item pe-3"><a href="faq.php" class="nav-link links" data-link="4"><i class="fa fa-user"></i> F.A.Q</a></li>
                    <?php if(isset($_SESSION["student_id"])){ ?>
                        <li class="nav-item"><a href="logout.php" class="btn btn-secondary rounded-pill"><small>Logout</small></a></li>
                    <?php }else{?>
                        <li class="nav-item pe-3"><a href="login.php" class="nav-link btn btn-secondary rounded-pill"><small>Login</small></a></li>
                    <li class="nav-item"><a href="signup.php" class="nav-link btn border border-light rounded-pill"><small>Signup</small></a></li>
                    <?php }?>
                </ul>
            </div>
            <?php ?>
            
            <?php ?>
            <div class="offcanvas offcanvas-start bg-dark w-50" id="navCanvas">
                <div class="offcanvas-header"><button class="btn-close bg-light" data-bs-dismiss="offcanvas"></button></div>
                <ul class="mx-auto rgba">
                    <?php if(isset($_SESSION["student_id"])){?>
                        <li class="nav-item pe-3 pe-md-5"><a href="log_entry.php" class="nav-link">LOG ENTRY</a></li>
                        <li class="nav-item pe-3 pe-md-5"><a href="logbook.php" class="nav-link">LOGBOOK</a></li>
                        <li class="nav-item pe-3 pe-md-5"><a href="notifications.php" class="nav-link">NOTIFICATIONS</a></li>
                        <li class="nav-item pe-3 pe-md-5 pb-3"><a href="profile.php" class="nav-link">PROFILE</a></li>
                    <?php }?>
                    <li class="nav-item"><a href="about.php" class="nav-link links" data-link="2">ABOUT</a></li>
                    <li class="nav-item"><a href="contact.php" class="nav-link links" data-link="3">CONTACT</a></li>
                    <li class="nav-item"><a href="faq.php" class="nav-link links" data-link="4">F.A.Q</a></li>
                    <?php if(isset($_SESSION["student_id"])){ ?>
                        <li class="pt-3"><a href="logout.php" class="btn btn-secondary rounded-pill"><small>Logout</small></a></li>
                    <?php }else{?>
                        <li class="pt-3"><a href="login.php" class="btn btn-secondary rounded-pill"><small>Login</small></a></li>
                        <li class="pt-3"><a href="signup.php" class="btn border border-light rounded-pill"><small>Signup</small></a></li>
                    <?php }?>
                </ul>
            </div>
        </nav>
                    <?php if(isset($_SESSION["student_id"])){ ?>
                        <div class="d-none justify-content-center rgba d-sm-flex">
                            <ul class="nav my-1 nav-pills">
                                <li class="nav-item pe-3 pe-md-5"><a href="log_entry.php" class="nav-link">LOG ENTRY</a></li>
                                <li class="nav-item pe-3 pe-md-5"><a href="logbook.php" class="nav-link">LOGBOOK</a></li>
                                <li class="nav-item pe-3 pe-md-5"><a href="notifications.php" class="nav-link">NOTIFICATIONS</a></li>
                                <li class="nav-item pe-3 pe-md-5"><a href="profile.php" class="nav-link">PROFILE</a></li>
                            </ul>
                        </div>
                    <?php }?>
        <marquee class="pt-2">Help us to make a better future by writing your reports</marquee>
        <hr>
    </header>
    <style>
        main{
            min-height: 60vh;
        }
        div.index-container{
            display: flex;
            flex-direction: row;
        }
        div.col-1{
            width: 40%;
        }
        div.col-2{
            width: 60%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        div.contact-container div.form-responsive{
            width: 60%;
        }
        a.login:hover{
            background-color: black;
            color: white;
        }
        a.signup:hover{
            background-color: white;
            border: 1px solid black;
            color: black;
        }
        div.offcanvas a{
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        div.offcanvas a.active{
            color: brown;
        }
        .rgba{
            background-color: rgba(0,0,0,0.55);
        }
        div.rgba ul li a{
            color: rgb(240, 230, 235);
        }
        img.signature{
            border-radius: 50%;
            border: 1px solid black;
            width: 300px;
            height: 300px;
        }
        @media screen and (max-width: 750px) {
            div.col-2{
                display: none;
            }
            div.col-1{
                width: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                padding: 3vh;
            }
            div.contact-container div.form-responsive{
            width: 100%;
            }
        }
    </style>