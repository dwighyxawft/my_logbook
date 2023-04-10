<?php $title = "Log Entry";
    require("includes/parentheader.php");
    $logbook = new logbook;
    $logbook->user_session();
    $student_id = $_SESSION["student_id"];
    $logbook->query = "SELECT * FROM internship_table WHERE student_id = '$student_id'";
    $total_rows = $logbook->total_rows();
    $internship = $logbook->fetch_assoc();
    if($total_rows == 0){
        echo $logbook->redirect("settings.php?settings=internship_settings");
    }else{
        $start_date = $internship["start_date"];
        $end_date = $internship["end_date"];
        $todays_date = date("Y-m-d");
        if($todays_date < $start_date){
            echo '<script>alert("Your internship is yet to start. Come back the day you start your internship"); location.href = "profile.php"</script>';
        }
    }
    $num1;
?>
    <main>
        <div class="container">
            <?php function log_entry($date, $num){
                $num1 = $num;
                ?>
                <div class="logs log<?php echo $num?>">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <form method="post" class="logs" class="needs-validation" data-form="<?php echo $num; ?>">
                            <h1 class="text-center">Enter your log information for <?php echo $date;?></h1>
                            <div class="form-group my-3">
                                <label><strong>Log Title:</strong></label>
                                <input type="text" name="log_title" id="" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Remark:</strong></label>
                                <input type="text" name="log_remark" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Image:</strong></label>
                                <input type="file" name="log_image" id="" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Body:</strong></label>
                                <textarea name="log_body" minlength="60" maxlength="250" id="" cols="30" rows="6" class="form-control" required></textarea>
                            </div>
                            <input type="hidden" name="date" value="<?php echo $date; ?>">
                            <input type="hidden" name="page" value="student">
                            <input type="hidden" name="action" value="log_entry">
                            <div class="form-group mb-3">
                                <center><button class="btn btn-success"><i class="fa fa-send"></i>Submit</button></center>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            <?php }?>
            <?php function log_one_entry($date){ ?>
                <div class="log">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                        <form method="post" class="needs-validation" id="#log_entry">
                            <h1 class="text-center">Enter your log information for today</h1>
                            <div class="form-group my-3">
                                <label><strong>Log Title:</strong></label>
                                <input type="text" name="log_title" id="" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Remark:</strong></label>
                                <input type="text" name="log_remark" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Image:</strong></label>
                                <input type="file" name="log_image" id="" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label><strong>Log Body:</strong></label>
                                <textarea name="log_body" id="" minlength="60" maxlength="250" cols="30" rows="6" class="form-control" required></textarea>
                            </div>
                            <input type="hidden" name="date" value="<?php echo $date?>">
                            <input type="hidden" name="page" value="student">
                            <input type="hidden" name="action" value="log_entry">
                            <div class="form-group mb-3">
                                <center><button class="btn btn-success"><i class="fa fa-send"></i>Submit</button></center>
                            </div>
                        </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            <?php }?>
                <?php
                    if($todays_date >= $start_date){
                        $logbook->query = "SELECT * FROM log_entries_table WHERE student_id = '$student_id' ORDER BY log_date_created DESC";
                        $log_creat_count = $logbook->total_rows();
                        $log_creat_row = $logbook->fetch_assoc();
                        if($log_creat_count < 1){
                            if($todays_date > $start_date){
                                log_entry($start_date, 1);
                                $str_today = strtotime($todays_date);
                                $str_start_date = strtotime($start_date);
                                $day_diff = ceil(($str_today - $str_start_date)/86400);
                                $arr = [];
                                $arr[] = 1;
                                for($i = 1; $i <= $day_diff; $i++){
                                    $day_int = $i == 1 ? "+1 day" : "+".$i." days";
                                    $selected_date = new DateTime($start_date);
                                    $selected_date->modify($day_int);
                                    $done_date = $selected_date->format("Y-m-d");
                                    if(date("l", strtotime($done_date)) == "Monday" || date("l", strtotime($done_date)) == "Tuesday" || date("l", strtotime($done_date)) == "Wednesday" || date("l", strtotime($done_date)) == "Thursday" || date("l", strtotime($done_date)) == "Friday"){
                                        $arr[] = $i+1;
                                        log_entry($done_date, $i+1);
                                    }else{
                                        continue;
                                    }
                                }
                            }elseif($todays_date == $start_date){
                                if(date('l', strtotime($start_date)) != "Saturday" || date('l', strtotime($start_date)) != "Sunday"){
                                    log_one_entry($todays_date);
                                }
                            }
                        }else{
                            $start_date = $log_creat_row["log_date_created"];
                            if($todays_date > $start_date){
                                $arr = [];
                                $str_today = strtotime($todays_date);
                                $str_start_date = strtotime($start_date);
                                $day_diff = ceil(($str_today - $str_start_date)/86400);
                                for($i = 1; $i <= $day_diff; $i++){
                                    $day_int = $i == 1 ? "+1 day" : "+".$i." days";
                                    $selected_date = new DateTime($start_date);
                                    $selected_date->modify($day_int);
                                    $done_date = $selected_date->format("Y-m-d");
                                    if(date("l", strtotime($done_date)) == "Monday" || date("l", strtotime($done_date)) == "Tuesday" || date("l", strtotime($done_date)) == "Wednesday" || date("l", strtotime($done_date)) == "Thursday" || date("l", strtotime($done_date)) == "Friday"){
                                        $arr[] = $i;
                                        log_entry($done_date, $i);
                                    }else{
                                        continue;
                                    }
                                }
                            }
                        }
                    }
                ?>  
        </div>
    </main>
    <script>
        <?php if(isset($arr)){ ?>
            var arr = "<?php echo json_encode($arr);?>";
            console.log(arr);
            var first = arr[1];
            var last = arr[arr.length - 1];
            var logs_container = document.querySelectorAll("div.logs");
            function log_display(current, last){
                logs_container.forEach(function(log){
                    log.classList.add("d-none");
                        if(log.classList.contains("log"+current)){
                            log.classList.remove("d-none");
                        }
                })
            }
            log_display(first, last);
        <?php }?>
    </script>
    <script>
        $(document).ready(function(){
            var forms = document.querySelectorAll("form.logs");
            forms.forEach(function(form){        
                form.addEventListener("submit", function(e){
                    e.preventDefault();
                    var current = form.getAttribute("data-form");
                    var index = arr.indexOf(current);
                    console.log(index);
                    var formdata = new FormData($(this)[0]);
                    $.ajax({
                        url: "includes/ajax.php",
                        type: "post",
                        data: formdata,
                        async: false,
                        success: function(data){
                           var res = JSON.parse(data);
                            if(res.status){
                                alert("Log details added successfully");
                                log_display(arr[index+1], arr[arr.length-1]);
                            }else{
                                alert(res.message);
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                })
            })
            $("form#log_entry").on("submit", function(e){
                    e.preventDefault();
                    var formdata = new FormData($(this)[0]);
                    $.ajax({
                        url: "includes/ajax.php",
                        type: "post",
                        data: formdata,
                        async: false,
                        success: function(data){
                            res = JSON.parse(data);
                            if(res.status){
                                alert("Log details added successfully");
                                loction.href = "dashboard.php";
                            }else{
                                alert(res.message);
                            }
                        },
                        cache: false,
                        contentType: false,
                        processData: false
                    })
                })
        })
    </script>
<?php require("includes/parentfooter.php"); ?>