<?php $title = "Print Logbook";
    require("includes/parentheader.php");
    $student_id = $_SESSION["student_id"];
    $logbook->query = "SELECT * FROM institution_table WHERE student_id = '$student_id'";
    $int = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM organization_table WHERE student_id = '$student_id'";
    $org = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM institution_supervisor_table WHERE student_id = '$student_id'";
    $int_super = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM organization_supervisor_table WHERE student_id = '$student_id'";
    $org_super = $logbook->fetch_assoc();
    $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
    $total_rows = $logbook->total_rows();
    $internship = $logbook->fetch_assoc();
    if($total_rows == 0){
        echo $logbook->redirect("settings.php?settings=internship_settings");
    }else{
        $start_date = $internship["start_date"];
        $end_date = $internship["end_date"];
        $str_end_date = strtotime($end_date);
        $str_start_date = strtotime($start_date);
        $date_diff = ceil(($str_end_date - $str_start_date)/86400);
        $check_date = new DateTime($start_date);
        $j = 1;
        for($i = 1; $i <= $date_diff; $i++){
            $date_int = $i == 1 ? "+1 day" : "+".$i." days";
            $check_date->modify($date_int);
            $log_date = $check_date->format("Y-m-d");
            if(date('l', strtotime($log_date)) != "Saturday" || date('l', strtotime($log_date)) != "Sunday"){
                $j += 1;
            }
        }
        $todays_date = date("Y-m-d");
        if($todays_date <= $end_date){
            echo $logbook->redirect("log_entry.php");
        }else{
            $logbook->query = "SELECT * FROM log_entries_table WHERE student_id = '$student_id'";
            if($logbook->total_rows() > 0 && $logbook->total_rows == $j){
                $all_entries = $logbook->fetch_all();
            }
            else{
                echo $logbook->redirect("log_entry.php");
            }
        }
    }
?>
    <main>
        <?php function logs(){ ?>
            <div class="container">
                <img src="images/institution/<?php echo $int["image"];?>" class="images" alt="Institution Image">
                <div class="d-flex justify-content-end">
                    <img src="images/organization/<?php echo $org["image"];?>" class="images" alt="Organization Image">
                </div>
                <?php foreach($all_entries as $entry){?>
                    <div class="date border-bottom"><?php echo $entry["log_date_created"];?></div>
                    <h1 class="text-center py-3 fs-1"><?php echo $entry["log_title"];?></h1>
                    <div class="text ps-2 mb-3">
                        <p class="fs-3">
                            <?php echo $entry["log_body"];?>
                        </p>
                    </div>
                    <div class="text ps-2 mb-3">
                        <img src="images/log_images/<?php echo $entry["log_image"]; ?>" alt="Log Image" class="log_image">
                    </div>

                    <div class="log_remark border-bottom">
                        <label><strong>Log Remark:</strong> <?php echo $entry["supervisor_log_remark"]; ?></label>
                    </div>
                    <div class="supervisors_signature">
                        <center>
                            <b>Internship Signature</b>    
                            <img src="images/org_sign/<?php echo $org_super["internship_signature_image"];?>" class="org_sign" alt="">
                        </center>
                    </div>
                <?php }?>
            </div>
        <?php }?>
        <?php 
            logs();
            $file = fopen("logbooks/logbook-".$student_id.".docx", "a+");
            fwrite($file, logs());
            fclose($file);
        ?>
    </main>
    <a href="logbooks/logbook-<?php echo $student_id; ?>.pdf">Check Pdf</a>
    <style>
        img.images{
            width: 140px; 
            height: 140px;
        }
        img.org_sign{
            width: 100px; 
            height: 100px;
        }
    </style>
<?php require("includes/parentfooter.php"); ?>