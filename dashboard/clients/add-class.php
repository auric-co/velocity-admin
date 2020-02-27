<?php
include_once dirname(__FILE__).'/../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}


if(!isset($_GET['company']) || $_GET['company'] == "" || empty($_GET['company'])){
    header('location:'.$sys->domain().'/dashboard/clients');
    exit();
}

if (isset($_POST['save'])){

    $company = $sys->escape_data($_POST['company']);
    $name = $sys->escape_data($_POST['name']);
    $activity = $sys->escape_data($_POST['activity']);
    $venue = $sys->escape_data($_POST['venue']);
    $dt_s = $sys->dateFormat($_POST['dt_s']);
    $dt_e = $sys->dateFormat($_POST['dt_e']);
    if($company && $name && $activity && $dt_s && $dt_e && $venue ){
//
       $sql = "INSERT INTO `classes`(`id`, `co`, `name`, `location`, `type`, `dt_s`, `dt_e`, `dsc`, `thumbn`, `actv`) VALUES ('','$company','$name','$venue','$activity','$dt_s','$dt_e','','','1')";
            $insert = mysqli_query($sys->con, $sql);
            if ($insert) {
                 $err = '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Success!</strong> Class Created Successfully
                  </div>';
            }else{
                 $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Class not saved!
                  </div>';
            }
        
    } else {
        $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Data not set!
                  </div>';
    }

}





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
        <title>Add Client - Velocity</title>
        <link rel="shortcut icon" href="<?php echo $sys->domain() ?>/dashboard/images/icons/favicon.png" type="image/x-icon">

        <!-- Fontfaces CSS-->
        <link href="<?php echo $sys->domain() ?>/dashboard/css/font-face.css" rel="stylesheet" media="all">
        <link href="<?php echo $sys->domain() ?>/dashboard/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
        <link href="<?php echo $sys->domain() ?>/dashboard/vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
        <link href="<?php echo $sys->domain() ?>/dashboard/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

        <!-- Bootstrap CSS-->
        <link href="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

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
<?php include_once dirname(__FILE__).'/../System/nav.php';  ?>

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
                                        <a href="<?php echo $sys->domain() ?>/dashboard">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item active">
                                        <a href="<?php echo $sys->domain() ?>/dashboard">Clients</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Add Client</li>
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
                        <!-- DATA TABLE -->
                        <h3 class="title-5 m-b-35">Add Class</h3>
                        <div class="table-responsive table-responsive-data2">
                            <div class="card">
                                <div class="card-header">Company Class Form</div>
                                <div class="card-body">
                                    <?php
                                    if ($err){
                                        echo $err;
                                    } ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>?company=<?php echo $_GET['company']; ?>" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="company" value="<?php echo $_GET['company']; ?>">
                                        <div class="form-group">
                                            
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input type="text" name="name" id="name" <?php if(isset($_POST['name'])){ ?>value=" <?php echo $_POST['name'];} ?>" required class="form-control" placeholder="Class Tittle">
                                        </div>
                                        <div class="form-group">
                                            <label for="activity" class="control-label mb-1">Activity</label>
                                            <select name="activity" id="activity" required class="form-control">
                                                <option value="opt1">Select Activitity</option>
                                                <?php
                                                $csql = "SELECT * FROM `activitiz` WHERE 1";
                                                $cqry = mysqli_query($sys->con, $csql);
                                                if(mysqli_num_rows($cqry) != 0){
                                                    $rrs = mysqli_fetch_assoc($cqry);
                                                    do{
                                                        echo '<option value="'.$rrs['id'].'">'.$rrs['nmt'].'</option>';
                                                    }while($rrs = mysqli_fetch_assoc($cqry));
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dt_s">From:</label>
                                            <input type="date" class="form-control" name="dt_s" <?php if(isset($_POST['dt_s'])){ ?>value=" <?php echo $_POST['dt_s'];} ?>" id="dt_s" placeholder="Start Date" required>
                                        </div>
                                        <div class="from-group">
                                            <label for="dt_e">To: </label>
                                            <input type="date" class="form-control" name="dt_e" <?php if(isset($_POST['dt_e'])){ ?>value=" <?php echo $_POST['dt_e'];} ?>" id="dt_e" placeholder="End Date" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="vn">Venue</label>
                                            <select name="venue" id="vn" required class="form-control">
                                                <option>Select Location</option>
                                                <?php
                                                $csql = "SELECT * FROM `venues` WHERE 1";
                                                $cqry = mysqli_query($sys->con, $csql);
                                                if(mysqli_num_rows($cqry) != 0){
                                                    $rrs = mysqli_fetch_assoc($cqry);
                                                    do{
                                                        echo '<option value="'.$rrs['id'].'">'.$rrs['name'].'</option>';
                                                    }while($rrs = mysqli_fetch_assoc($cqry));
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        
                                        <div class="input-group">
                                            <input type="submit" class="btn btn-lg btn-info btn-block" name="save" value="Save">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END DATA TABLE -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                </div>
            </div>
        </div>
    </section>

<?php  include_once dirname(__FILE__).'/../System/footer.php'; ?>