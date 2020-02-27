<?php
   include_once dirname(__FILE__).'/../../System/System.php';
    $sys = new System();
    
    if(!$sys->checkLoginState()){
        $sys->deleteCookie();
        header('location:'.$sys->domain());
        exit();
    }
    
    $err = "";
    
    if(isset($_POST['save'])){
        $dur = $sys-> escape_data($_POST['duration']);
        $tm_s = $sys->timeFormat($_POST['time']);
        $day =  $sys-> escape_data($_POST['day']);
        $classID =  $sys-> escape_data($_POST['class']);
        $dt = ''; // create intervals 
        $tm_e = date('H:i',strtotime('+'.$dur.' hour',strtotime($tm_s))); //add duration
        if($day && $tm_s && $dur && $tm_e ){
            $fs = "SELECT * FROM `classes` WHERE `id`= '$classID'";
            $fqr = mysqli_query($sys->con, $fs);
            if(mysqli_num_rows($fqr) != 0){
                $frs = mysqli_fetch_assoc($fqr);
                $step  = 1;
                $unit  = 'W';
                $start = new DateTime($frs['dt_s']);
                $end   = new DateTime($frs['dt_e']);
    
                $start->modify($day); // Move to first occurence
    
                $interval = new DateInterval("P{$step}{$unit}");
                $period   = new DatePeriod($start, $interval, $end);
    
                foreach ($period as $date) {
                    $dt =  $date->format('Y-m-d');
                    $csql = "SELECT * FROM  `class_sessions` WHERE `classID` = '$classID' AND `tm_s` = '$tm_s' AND `tm_e` = '$tm_e' AND  `dt` = '$dt' ";
                    $ccqry = mysqli_query($sys->con, $csql);
                    
                    if(mysqli_num_rows($ccqry) == 0){
                         $sql = "INSERT INTO `class_sessions`(`id`, `classID`, `tm_s`, `tm_e`, `dt`) VALUES ('','$classID','$tm_s','$tm_e','$dt')";
                        $insert = mysqli_query($sys->con, $sql);
                    }
                    
                    
                   
                }
                if ($insert) {
                    $err = '<div class="alert alert-success">
                         <a href="#" class="close" data-dismiss="alert">&times;</a>
                         <strong>Success!</strong> Sessions Saved
                      </div>';
                }else{
                    $err = '<div class="alert alert-danger">
                         <a href="#" class="close" data-dismiss="alert">&times;</a>
                         <strong>Error !</strong> Sessions could not saved
                      </div>';
                }
            }
            
        }else{
             $err = '<div class="alert alert-danger">
                         <a href="#" class="close" data-dismiss="alert">&times;</a>
                         <strong>Error !</strong> Data not set. Could not Proceed
                      </div>';
        }
    }
    

?>


?>
<!DOCTYPE html>
<html lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags-->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Add Class Sessions -  Velocity</title>
    <link rel="shortcut icon" href="<?php echo $sys->domain() ?>/dashboard/images/icons/favicon.png" type="image/x-icon">

    <!-- Fontfaces CSS-->
    <link href="<?php echo $sys->domain() ?>/dashboard/css/font-face.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">
    <link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />
    <!-- Vendor CSS-->
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/wow/animate.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/slick/slick.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">
    <link href="<?php echo $sys->domain() ?>/dashboard/vendor/vector-map/jqvmap.min.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="<?php echo $sys->domain() ?>/dashboard/css/theme.css" rel="stylesheet" media="all">

</head>

<body class="animsition">
<div class="page-wrapper">

<?php include_once dirname(__FILE__).'/../../System/nav.php'; ?>

        <!-- BREADCRUMB-->
        <section class="au-breadcrumb m-t-75">
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="au-breadcrumb-content">
                                <div class="au-breadcrumb-left">
                                    <span class="au-breadcrumb-span">You are here:</span>
                                    <ul class="list-unstyled list-inline au-breadcrumb__list">
                                        <li class="list-inline-item active">
                                            <a href="<?php echo $sys->domain(); ?>/dashboard">Home</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item active">
                                            <a href="<?php echo $sys->domain(); ?>/dashboard/wellness">Wellness</a>
                                        </li>
                                        <li class="list-inline-item seprate">
                                            <span>/</span>
                                        </li>
                                        <li class="list-inline-item">Classes</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END BREADCRUMB-->
        <hr>

        <section>
            <div class="section__content section__content--p30">
                <div class="container-fluid">
                    <div class="row">
                       <div class="col-md-12">
                           <div class="card">
                               <div class="card-header">Add Class Sessions</div>
                               <?php if($err){ echo $err; } ?>
                               <div class="card-body">
                                   <form action="<?php echo $_SESSION['PHP_SELF'] ?>?class=<?php echo $_GET['class']; ?>&company=<?php echo $_GET['company']; ?>" method="post" id="add">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mg-b-pro-edt">
                                                            <label for="day">Session Day</label>
                                                            <select name="day" id="day" required class="form-control">
                                                                <option>Select Day</option>
                                                                <option value="Sunday">Sunday</option>
                                                                <option value="Monday">Monday</option>
                                                                <option value="Tuesday">Tuesday</option>
                                                                <option value="Wednesday">Wednesday</option>
                                                                <option value="Thursday">Thursday</option>
                                                                <option value="Friday">Friday</option>
                                                                <option value="Saturday">Saturday</option>
                                                            </select>
                                                            <input type="hidden" name="class" value="<?php echo $_GET["class"]; ?>"/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label for="time">Time</label>
                                                            <input type="time" name="time" id="time"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label  for="duration">Duration (# of hours)</label>
                                                            <input type="number" name="duration" id="duration"  class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="text-center ">
                                                    <input type="submit" name="save"  class="btn btn-success" value="Save"/>
                                                    <button type="reset" class="btn btn-danger">Discard</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </section>


<?php include_once dirname(__FILE__).'/../../System/footer.php'; ?>
