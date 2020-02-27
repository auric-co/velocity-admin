<?php
include_once dirname(__FILE__).'/../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

if (!isset($_GET['member'])){
    header('location:'.$sys->domain().'/dashboard/users?error=member id not set');
    exit();
}
if (!isset($_GET['company'])){
    header('location:'.$sys->domain().'/dashboard/users?error=client id not set');
    exit();
}

$err = "";
global $details;
$member = $_GET['member'];




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
        <title>Dashboard - Velocity</title>
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
<?php include_once dirname(__FILE__).'/../System/nav.php';  ?>

    <!-- BREADCRUMB-->
    <section class="au-breadcrumb m-t-75">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="au-breadcrumb-content">
                            <div class="au-breadcrumb-left">
                                <span class="au-breadcrumb-span">You are here:</span>
                                <ul class="list-unstyled list-inline au-breadcrumb__list">
                                    <li class="list-inline-item active">
                                        <a href="<?php echo $sys->domain();?>/dashboard">Home</a>
                                    </li>
                                    <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item active">
                                        <a href="<?php echo $sys->domain();?>/dashboard/users">Clients</a>
                                    </li>
                                     <li class="list-inline-item seprate">
                                        <span>/</span>
                                    </li>
                                    <li class="list-inline-item">Edit Member</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">

                            </div>
                            <div class="table-data__tool-right">
                                <a href="more.php?id=<?php echo $_GET['company']; ?>" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Back to All Members
                                </a>
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
                            <div class="card-header">Edit Member Form</div>
                            <div class="card-body">
                                <?php
                                if (isset($_POST['save'])){
                                
                                    $name = $_POST['name'];
                                    $surname = $_POST['surname'];
                                    $email = $_POST['email'];
                                    $msisdn = $_POST['msisdn'];
                                    $age = $_POST['age'];
                                    $member = $_POST['member'] ? $_POST['member'] : $_GET['member'];
                                    $company = $_POST['company'] ? $_POST['company'] : $_GET['company'];
                                    $weight = $_POST['weight'];
                                    $height = $_POST['height'];
                                    $bmi = $_POST['bmi'];
                                    $member_number = $_POST['member_no'];
                                    
                                    
                                    
                                    
                                    
                                    $request = json_encode(
                                        array(
                                            'email' => $email,
                                            'msisdn' => $msisdn,
                                            'name' => $name,
                                            'member_number' => $member_number,
                                            'surname' => $surname,
                                            'company' => $company,
                                            'age' => $age,
                                            'weight' => $weight,
                                            'height' => $height,
                                            'bmi' => $bmi
                                        ));
                                        
                                        
                                    $curl = curl_init();
                                    curl_setopt_array($curl, array(
                                        CURLOPT_URL => "http://api.velocityhealth.co.za/admin/update/client/member/".$member,
                                        CURLOPT_RETURNTRANSFER => true,
                                        CURLOPT_ENCODING => "",
                                        CURLOPT_MAXREDIRS => 10,
                                        CURLOPT_TIMEOUT => 30,
                                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                        CURLOPT_CUSTOMREQUEST => "PATCH",
                                        CURLOPT_POSTFIELDS => $request,
                                        CURLOPT_HTTPHEADER => array(
                                            "content-type: application/json",
                                        ),
                                    ));
                                
                                    $response = curl_exec($curl);
                                    $error = curl_error($curl);
                                    $data = json_decode($response, true);
                                    curl_close($curl);
                                    if ($error){
                                        $notif = '<div class="alert alert-danger">
                                				 <a href="#" class="close" data-dismiss="alert">&times;</a>
                                				 <strong>Error!</strong> Connection error
                                			  </div>';
                                    }else{
                                        if ($data['success']){
                                            $notif = '<div class="alert alert-success">
                                				 <a href="#" class="close" data-dismiss="alert">&times;</a>
                                				 <strong>Success!</strong> Member saved Successfully
                                			  </div>';
                                        }else{
                                            if (isset($data['error']['message'])){
                                                $notif = '<div class="alert alert-danger">
                                                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                                                     <strong>Error !</strong>'.$data['error']['message'].'
                                                  </div>';
                                            }else{
                                                $notif =  '<div class="alert alert-danger">
                                				 <a href="#" class="close" data-dismiss="alert">&times;</a>
                                				 <strong>Error!</strong> Error connecting to service. Please try again later
                                			  </div>';
                                            }
                                
                                        }
                                
                                    }
                                
                                }
                                
                                $curl = curl_init();
                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => "http://api.velocityhealth.co.za/admin/member/details/".$member,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 30,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_POSTFIELDS => "",
                                    CURLOPT_HTTPHEADER => array(
                                        "content-type: application/json",
                                    ),
                                ));
                                
                                $response = curl_exec($curl);
                                $err = curl_error($curl);
                                $data = json_decode($response, true);
                                curl_close($curl);
                                if ($err){
                                    $err = '<div class="alert alert-danger">
                                			 <a href="#" class="close" data-dismiss="alert">&times;</a>
                                			 <strong>Error!</strong> Connection error
                                		  </div>';
                                }else{
                                    $details = $data['details'];
                                }
                            
                                
                                if ($err){
                                    echo $err;
                                } 
                                
                                if($notif){
                                    echo $notif;
                                }
                                ?>
                                
                                
                                
                                
                                
                                <form action="<?php echo $_SERVER['PHP_SELF'];?>?member=<?php echo $_POST['member'] ? $_POST['member'] : $_GET['member']; ?>&company=<?php echo $_POST['company'] ? $_POST['company'] : $_GET['company'] ?>" method="post" id="add">
                                    <input type="hidden" name="member" value="<?php echo $_POST['member'] ? $_POST['member'] : $_GET['member'] ?>" required>
                                    <input type="hidden" name="company" value="<?php echo $_POST['company'] ? $_POST['company'] : $_GET['company'] ?>" required>
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input type="text" class="form-control" name="name" value="<?php echo $details['name']; ?>" id="name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="surname">Surname:</label>
                                        <input type="text" class="form-control" value="<?php echo $details['surname']; ?>" name="surname" id="surname" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="member_no">Member #:</label>
                                        <input type="text" class="form-control" value="<?php echo $details['member_number']; ?>" name="member_no" id="member_no" placeholder="Member Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="msisdn">Mobile:</label>
                                        <input type="text" class="form-control" value="<?php echo $details['msisdn']; ?>" name="msisdn" id="msisdn" placeholder="Mobile Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input type="email" class="form-control"value="<?php echo $details['email']; ?>" name="email" id="email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="age">Age:</label>
                                        <input type="number" class="form-control" value="<?php echo $details['age']; ?>" name="age" id="age" placeholder="Age">
                                    </div>
                                    <div class="form-group">
                                        <label for="height">Height:</label>
                                        <input type="text" class="form-control" value="<?php echo $details['height']; ?>" name="height" id="height" placeholder="Height">
                                    </div>
                                    <div class="form-group">
                                        <label for="dt_s">Weight:</label>
                                        <input type="text" class="form-control" value="<?php echo $details['weight']; ?>" name="weight" id="weight" placeholder="Weight">
                                    </div>
                                    <div class="form-group">
                                        <label for="bmi">BMI: </label>
                                        <input type="text" class="form-control" value="<?php echo $details['bmi']; ?>" name="bmi" placeholder="BMI results">
                                    </div>
                                    <div>
                                        <input type="submit" class="btn btn-lg btn-info btn-block" name="save" value="Save">
                                    </div>
                                </form>
                            </div>
                        </div>
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