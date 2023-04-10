<?php
require("../classes.php");
$logbook = new logbook;
session_start();
$student_id = $_SESSION["student_id"];
$logbook->query = "SELECT * FROM students_table WHERE student_id = '$student_id'";
$student = $logbook->fetch_assoc();
$date = date("Y-m-d");
$time = time();

if(isset($_POST["page"])){
    if($_POST["page"] == "contact_us" && $_POST["action"] == "contact_us"){
        $name = $_POST["name"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $msg = $_POST["message"].". You can call my phone number at ".$phone;
        $to = "amuoladipupo@gmail.com";
        $subject = 'Message From A Student';
        $headers = array(
            'From' => $email,
            'Reply-To' => "amuoladipupo@gmail.com",
            'X-Mailer' => 'PHP/' . phpversion()
        );

        $output = mail($to, $subject, $message, $headers) ? ["status"=>true] : ["status"=>false];
        echo json_encode($output);
    }
    if($_POST["page"] == "student"){
        if($_POST["action"] == "login"){
            $mail = $_POST["mail"];
            $pass = $_POST["pass"];
            $logbook->query = "SELECT * FROM students_table WHERE students_email = '$mail'";
            $total_num = $logbook->total_rows();
            if($total_num > 0 && $total_num < 2){
                $student = $logbook->fetch_assoc();
                $student_pass = $student["password"];
                if(password_verify($pass, $student_pass)){
                    $_SESSION["student_id"] = $student["student_id"];
                    $output = ["status"=>true];
                }else{
                    $output = ["status"=>false, "message"=>"Password incorrect"];
                }
            }
            else{
                $output = ["status"=>false, "message"=>"Email does not exist"];
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "signup"){
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $phone = $_POST["phone"];
            $pass_1 = $_POST["pass_1"];
            $pass_2 = $_POST["pass_2"];

            $logbook->query = "SELECT * FROM students_table WHERE students_email = '$mail'";
            $total_rows = $logbook->total_rows();
            if($total_rows < 1){
                if($pass_1 == $pass_2){
                    $hash = password_hash($pass_1, PASSWORD_DEFAULT);
                    $logbook->query = "INSERT INTO students_table(students_name, students_email, students_phone, password) VALUES ('$name', '$mail', '$phone', '$hash')";
                    if($logbook->execute_query()){
                        $logbook->query = "SELECT * FROM students_table WHERE students_email = '$mail'";
                        $student = $logbook->fetch_assoc();
                        $_SESSION["student_id"] = $student["student_id"];
                        $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You signed up $date', 'You signed up $date at the time $time and performed some activities whose notifications and what you did will be listed below.')";
                        if($logbook->execute_query()){
                            $output = ["status"=>true];
                        }
                    }
                }else{
                    $output = ["status"=>false, "msg"=>"Your Password is incorrect"];
                }
            }else{
                $output = ["status"=>false, "msg"=>"The user already exists"];
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "institution"){
            $name = $_POST["ins_name"];
            $mail = $_POST["ins_mail"];
            $addr = $_POST["ins_addr"];
            $course = $_POST["course"];
            $faculty = $_POST["faculty"];
            $level = $_POST["level"];
            $dept = $_POST["dept"];
            $program = $_POST["program"];
            $image = $_FILES["image"]["name"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $img_arr = ["jpg", "jpeg", "png", "JPG", "PNG", "JPEG"];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $logbook->query = "SELECT * FROM institution_table WHERE student_id = '$student_id'";
            if($logbook->total_rows() == 0){
                if(in_array($ext, $img_arr)){
                    if(move_uploaded_file($tmp_name, "../images/institution/$image")){
                        $logbook->query = "INSERT INTO institution_table(student_id, institution_name, institution_email, image, address, course_of_study, level, programme, faculty, department) VALUES ('$student_id', '$name', '$mail', '$image', '$addr', '$course', '$level', '$program', '$faculty', '$dept')";
                        if($logbook->execute_query()){
                            $logbook->query = "SELECT * FROM institution_table WHERE student_id = '$student_id'";
                            $institution = $logbook->fetch_assoc();
                            $institution_id = $institution["institution_id"];
                            $logbook->query = "UPDATE students_table SET institution_id = '$institution_id' WHERE student_id = '$student_id'";
                            $logbook->execute_query();
                            $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You added your institution details', 'You added your institution details $date at the $time time of the day. Some of the other activities might be listed below')";
                            if($logbook->execute_query()){
                                $output = ["status"=>true];
                            }
                        }else{
                            $output = ["status"=> false, "message"=>"Error Uploading your info"];
                        }
                    }else{
                        $output = ["status"=> false, "message"=>"Error uploading your image"];
                    }
                }else{
                    $output = ["status"=> false, "message"=>"File is ot an image type"];
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "organization"){
            $name = $_POST["org_name"];
            $mail = $_POST["org_mail"];
            $addr = $_POST["org_addr"];
            $phone = $_POST["org_mobile"];
            $dept = $_POST["org_dept"];
            $image = $_FILES["org_image"]["name"];
            $tmp_name = $_FILES["org_image"]["tmp_name"];
            $img_arr = ["jpg", "jpeg", "png", "JPG", "PNG", "JPEG"];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $logbook->query = "SELECT * FROM organization_table WHERE student_id = '$student_id'";
            if($logbook->total_rows() == 0){
                if(in_array($ext, $img_arr)){
                    if(move_uploaded_file($tmp_name, "../images/organization/$image")){
                        $logbook->query = "INSERT INTO organization_table(student_id, organization_name, organization_email, image, address, organization_mobile, department_posted) VALUES ('$student_id', '$name', '$mail', '$image', '$addr', '$phone', '$dept')";
                        if($logbook->execute_query()){
                            $logbook->query = "SELECT * FROM organization_table WHERE student_id = '$student_id'";
                            $organization = $logbook->fetch_assoc();
                            $organization_id = $organization["organization_id"];
                            $logbook->query = "UPDATE students_table SET organization_id = '$organization_id' WHERE student_id = '$student_id'";
                            $logbook->execute_query();
                            $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You added your organization details', 'You added your institution details $date at the $time time of the day. Some of the other activities might be listed below')";
                            if($logbook->execute_query()){
                                $output = ["status"=>true];
                            }
                        }else{
                            $output = ["status"=> false, "message"=>"Error Uploading your info"];
                        }
                    }else{
                        $output = ["status"=> false, "message"=>"Error uploading your image"];
                    }
                }else{
                    $output = ["status"=> false, "message"=>"File is ot an image type"];
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "account_update"){
            $image = $_FILES["image"]["name"];
            $gender = $_POST["gender"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            if(!isset($image) || empty($image)){
                $image = $gender == "Male" ? "male.jpg" : "female.jpg";
            }else{
                $img_arr = ["jpg", "jpeg", "png", "jfif", "JPG", "PNG", "JPEG", "JFIF"];
                $ext = pathinfo($image, PATHINFO_EXTENSION);
                if(in_array($ext, $img_arr)){
                    move_uploaded_file($tmp_name, "../images/student/$image");
                }
                else{
                    $output = ["status"=>false, "message"=>"File is not an image type"];
                }
            }
            $logbook->query = "UPDATE students_table SET student_image = '$image', gender = '$gender' WHERE student_id = '$student_id'";
            if($logbook->execute_query()){
                $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You updated your profile details', 'You updated your account $date at the $time time of the day. Some of the other activities might be listed below')";
                if($logbook->execute_query()){
                    $output = ["status"=>true];
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "edit_general_info"){
            $name = $_POST["name"]; 
            $phone = $_POST["phone"];
            $addr = $_POST["addr"];
            $logbook->query = "UPDATE students_table SET students_name = '$name', students_phone = '$phone', address = '$addr' WHERE student_id = '$student_id'";
            if($logbook->execute_query()){
                $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You edited your general information', 'You successfully edited your general information  $date at the $time time of the day. Some of the other activities might be listed below')";
                if($logbook->execute_query()){
                    $output = ["status"=>true];
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "edit_password"){
            $old_pass = $_POST["old_pass"]; 
            $new_pass = $_POST["new_pass"];
            $con_pass = $_POST["con_pass"];
            if(password_verify($old_pass, $student["password"])){
                if($new_pass == $con_pass){
                    $hash = password_hash($con_pass, PASSWORD_DEFAULT);
                    $logbook->query = "UPDATE students_table SET password = '$hash' WHERE student_id = '$student_id'";  
                    if($logbook->execute_query()){
                        $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You changed your password', 'You successfully changed your password $date at the $time time of the day. Some of the other activities might be listed below')";
                        if($logbook->execute_query()){
                            $output = ["status"=>true];
                        }
                    }
                }else{
                    $output = ["status"=>false, "message"=>"Passwords not matching"];
                }
            }else{
                $output = ["status"=>false, "message"=>"Incorrect Password"];
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "change_profile_picture"){
            $image = $_FILES["image"]["name"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $img_arr = ["jpg", "jfif", "png", "jpeg", "JPG", "JFIF", "PNG", "JPEG"];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            if(in_array($ext, $img_arr)){
                if(move_uploaded_file($tmp_name, "../images/student/$image")){
                    $logbook->query = "UPDATE students_table SET student_image = '$image' WHERE student_id = '$student_id'";
                    if($logbook->execute_query()){
                        $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You changed your profile picture', 'You successfully changed your profile picture $date at the $time time of the day. Some of the other activities might be listed below')";
                        if($logbook->execute_query()){
                            $output = ["status"=>true];
                        }
                    }
                }
            }else{
                $output = ["status"=>false, "message"=>"File is not a image type"];
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "change_email_address"){
            $otp_sent = rand(123456, 999999);
            $email = $_POST["email"];
            $otp = $_POST["otp"];
            if(!isset($otp) || $otp == ''){
                if(mail($email, "OTP from mylogbook", "This is your One Time Password: ".$otp_sent."")){
                    $output = ["first"=>true];
                }
            }else{
                if($otp_sent == $otp){
                    $logbook->query = "UPDATE students_table SET students_email = '$email' WHERE student_id = '$student_id'";
                    $logbook->execute_query();
                    $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You changed your email address', 'You successfully changed your email address $date at the $time time of the day. Some of the other activities might be listed below')";
                    if($logbook->execute_query()){
                        $output = ["status"=>true];
                    }
                }
                $output = $otp == $otp_sent ? ["status"=>true] : ["status"=>false, "message"=>"Invalid or expired otp"];
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "edit_org_super_info"){
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $phone = $_POST["phone"];
            $addr = $_POST["addr"];
            $role = $_POST["role"];
            $image = $_FILES["image"]["name"];
            $tmp_name = $_FILES["image"]["tmp_name"];
            $img_arr = ["jpg", "jpeg", "png", "jfif", "JPG", "JPEG", "PNG", "JFIF"];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $logbook->query = "SELECT * FROM organization_supervisor_table WHERE student_id = '$student_id'";
            if(in_array($ext, $img_arr)){
                if(move_uploaded_file($tmp_name, "../images/org_sign/$image")){
                    if($logbook->total_rows() == 0){
                        $logbook->query = "INSERT INTO organization_supervisor_table(student_id, super_name, super_email, super_mobile, role_played, address, internship_signature_image) VALUES('$student_id', '$name', '$mail', '$phone', '$role', '$addr', '$image')";
                        if($logbook->execute_query()){
                            $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You added your organization supervisor details', 'You successfully added your organization supervisor details $date at the $time time of the day. Some of the other activities might be listed below')";
                            if($logbook->execute_query()){
                                $output = ["status"=>true, "message"=>"Organization supervisor details added successfully"];
                            }
                        }
                    }else{
                        $logbook->query = "UPDATE organization_supervisor_table SET super_name = '$name', super_email = '$mail', super_mobile = '$phone', role_played = '$role', internship_signature_image = '$image', address = '$addr' WHERE student_id = '$student_id'";
                        if($logbook->execute_query()){
                            $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You edited your organization supervisor details', 'You successfully edited your organization supervisor details $date at the $time time of the day. Some of the other activities might be listed below')";
                            if($logbook->execute_query()){
                                $output = ["status"=>true, "message"=>"Organization supervisor details edited successfully"];
                            }
                        }
                    }
                }
            }else{
                $output = ["status"=>false, "message"=>"File is not an image type"];
            }
            
            echo json_encode($output);
        }
        if($_POST["action"] == "edit_ins_super_info"){
            $name = $_POST["name"];
            $mail = $_POST["mail"];
            $phone = $_POST["phone"];
            $addr = $_POST["addr"];
            $logbook->query = "SELECT * FROM institution_supervisor_table WHERE student_id = '$student_id'";
            if($logbook->total_rows() == 0){
                $logbook->query = "INSERT INTO institution_supervisor_table(student_id, super_name, super_email, super_mobile, super_address) VALUES('$student_id', '$name', '$mail', '$phone', '$addr')";
                if($logbook->execute_query()){
                    $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You added your institution supervisor details', 'You successfully added your institution supervisor details $date at the $time time of the day. Some of the other activities might be listed below')";
                    if($logbook->execute_query()){
                        $output = ["status"=>true, "message"=>"Institution supervisor details added successfully"];
                    }
                }
            }else{
                $logbook->query = "UPDATE institution_supervisor_table SET super_name = '$name', super_email = '$mail', super_mobile = '$phone', super_address = '$addr' WHERE student_id = '$student_id'";
                if($logbook->execute_query()){
                    $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You edited your institution supervisor details', 'You successfully edited your institution supervisor details $date at the $time time of the day. Some of the other activities might be listed below')";
                    if($logbook->execute_query()){
                        $output = ["status"=>true, "message"=>"Institution supervisor details edited successfully"];
                    }
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "internship_settings"){
            $role = $_POST["role"];
            $allowance = $_POST["allowance"];
            $duration = $_POST["duration"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $todays_date = date("Y-m-d");
            if($todays_date >= $start_date){
                $output = ["status"=>false, "message"=>"You must fill out an internship starting after today"];
            }else{
                $date = new DateTime($start_date);
                $date->modify($duration);
                $normal_end_date = $date->format("Y-m-d");
                if($end_date >= $normal_end_date){
                    $logbook->query = "SELECT * FROM institution_table WHERE student_id = '$student_id'";
                    $ins_total = $logbook->total_rows();
                    $ins_array = $logbook->fetch_assoc();
                    $logbook->query = "SELECT * FROM organization_table WHERE student_id = '$student_id'";
                    $org_total = $logbook->total_rows();
                    $org_array = $logbook->fetch_assoc();
                    if($ins_total == 1 && $org_total == 1){
                        $logbook->query = "SELECT * FROM institution_supervisor_table WHERE student_id = '$student_id'";
                        $ins_super_count = $logbook->total_rows();
                        $ins_super_array = $logbook->fetch_assoc();
                        $logbook->query = "SELECT * FROM organization_supervisor_table WHERE student_id = '$student_id'";
                        $org_super_count = $logbook->total_rows();
                        $org_super_array = $logbook->fetch_assoc();
                        if($org_super_count == 1 && $ins_super_count == 1){
                            $org_super_id = $org_super_array["super_id"];
                            $ins_super_id = $ins_super_array["super_id"];
                            $ins_id = $ins_array["institution_id"];
                            $org_id = $org_array["organization_id"];
                            $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
                            if($logbook->total_rows() == 0){
                                $logbook->query = "INSERT INTO internship_table (student_id, organization_id, institution_id, institution_super_id, organization_super_id, role_played, cum_alawee, duration, start_date, end_date) VALUES('$student_id', '$org_id', '$ins_id', '$ins_super_id', '$org_super_id', '$role', '$allowance', '$duration', '$start_date', '$end_date')";
                                if($logbook->execute_query()){
                                    $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You added your internship details', 'You successfully added your internship details $date at the $time time of the day. Some of the other activities might be listed below')";
                                    if($logbook->execute_query()){
                                        $output = ["status"=>true];
                                    }
                                }
                            }else{
                                $logbook->query = "UPDATE internship_table SET organization_id = '$org_id', institution_id = '$ins_id', institution_super_id = '$ins_super_id', organization_super_id = '$org_super_id', role_played = '$role', cum_alawee = '$allowance', duration = '$duration', start_date = '$start_date', end_date = '$end_date' WHERE student_id = '$student_id'";
                                if($logbook->execute_query()){
                                    $logbook->query = "INSERT INTO notifications_table(student_id, header, body) VALUES ('$student_id', 'You edited your internship details', 'You successfully edited your internship details $date at the $time time of the day. Some of the other activities might be listed below')";
                                    if($logbook->execute_query()){
                                        $output = ["status"=>true];
                                    }
                                }
                            }
                        }else{
                            $output = ["status"=>false, "message"=>"Your organization or institution based supervisor details have not been filled"];                   
                        }
                    }else{
                        $output = ["status"=>false, "message"=>"Your organization or institution details have not been filled"];                   
                    }
                }else{
                    $output = ["status"=>false, "message"=>"Your internship duration length is greater than your end date"];                 
                }
            }
            echo json_encode($output);
        }
        if($_POST["action"] == "log_entry"){
            $title = $_POST["log_title"];
            $body = $_POST["log_body"];
            $image = $_FILES["log_image"]["name"];
            $img_tmp = $_FILES["log_image"]["tmp_name"];
            $remark = $_POST["log_remark"];
            $date = $_POST["date"];
            $img_arr = ["png", "jpg", "jpeg", "jfif", "JFIF", "PNG", "JPG", "JPEG"];
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
            $internship = $logbook->fetch_assoc();
            $int_id = $internship["internship_id"];

            if(in_array($ext, $img_arr)){
                if(move_uploaded_file($img_tmp, "../images/log_images/$image")){
                    $logbook->query = "INSERT INTO log_entries_table (student_id, internship_id, log_title, log_image, log_body, supervisor_log_remark, log_date_created) VALUES('$student_id', '$int_id', '$title', '$image', '$body', '$remark', '$date')";
                    if($logbook->execute_query()){
                        $output = ["status"=>true];
                    }else{
                        $output = ["status"=>false, "message"=>"Something is wrong"];
                    }
                }
            }else{
                $output = ["status"=>false, "message"=>"File is not an image type"];
            }
            echo json_encode($output);
        }
    }
}


?>