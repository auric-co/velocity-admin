<?php
include_once dirname(__FILE__).'/../../../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

if (!isset($_GET['class']) || empty($_GET['class']) || $_GET['class'] == ""){
    header('location:'.$sys->domain().'/dashboard/wellness/activities');
    exit();
}

$class = $sys->escape_data($_GET['class']);

if (!isset($_GET['company']) || empty($_GET['company']) || $_GET['company'] == ""){
    header('location:'.$sys->domain().'/dashboard/wellness/activities');
    exit();
}

$company = $sys->escape_data($_GET['company']);

global $obj;
if(isset($_GET['session']) || !empty($_GET['session']) || !$_GET['session'] == ""){
    
    $session = $_GET['session'];
    
}else{
    
    $dt = date("Y-m-d");
    $day = date('Y-m-d', strtotime('-3 day', strtotime($dt)));
    $slq = "SELECT * FROM `class_sessions` WHERE `classID`='$class' AND `dt` <= '$day' ORDER BY `dt` ASC LIMIT 0,1";
    $slqr = mysqli_query($sys->con, $slq);
    if (mysqli_num_rows($slqr) > 0){
    
      while($rss = mysqli_fetch_assoc($slqr)){
          $dt = $rss['dt'];
          $obj = $rss;
          $session = $sys->getSession($dt,$class);
          
      }
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
        <title>Class Register - Dashboard Velocity</title>
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
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            
            $('#sessions').on('change',function(){
                var session =  this.value;
                var company = $('#company').val();
                var cladd = $('#class').val();
                window.open("http://admin.velocityhealth.co.za/dashboard/wellness/classes/register/?class="+ cladd +"&company="+ company +"&session=" + session, "_self");
            });

            $('.register').click(function(){
               
                var dt = this.id;
                var reg = dt.split('.');
                var notif = "status"+reg[1];
                var el = $('.'+ notif);
                el.removeClass('fa-ellipsis-h');
                el.addClass('fa-circle-o-notch fa-spin');
                if(reg){
                    $.ajax({
                        type:'POST',
                        url:'markregister.php',
                        data:'status='+ reg[0] +'&member=' + reg[1] + '&session='+ reg[2] + '&class_id='+ reg[3],
                        success:function(data){
                           res = JSON.parse(data);
                           if(res.success == true){
                               console.log(res.attend);
                               if(res.attend == false){
                                    el.removeClass('fa-circle-o-notch fa-spin');
                                    el.addClass('fa-times text-danger');
                               }else{
                                    el.removeClass('fa-circle-o-notch fa-spin');
                                    el.addClass('fa-check text-success');
                               }
                                
                               
                           }else{
                                el.addClass('fa-times text-danger');
                                el.removeClass(' fa-circle-o-notch fa-spin');
                                
                           }
                           
                        }
                    });
                }else{
                   
                } 
            });


        });
    </script>

    </head>
    
    
    
    

<body>
<div class="page-wrapper">

<?php include_once dirname(__FILE__).'/../../../System/nav.php'; ?>

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
                    <div class="col-md-4">
                        <div class="table-data__tool">
                            <div class="table-data__tool-left">

                            </div>
                            <div class="table-data__tool-right">
                                <a href="../add_session.php?class=<?php echo $_GET['class'] ?>&company=<?php echo $_GET['company']; ?>" class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i> Add Session
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
                        <div class="row">
                            <div class="col-md-8">
                                <h3 class="title-3 m-b-30">Mark Attendance Register</h3>
                            </div>
                            <div class="col-md-4">
                                <form class="">
                                    <label for ="sessions">Choose Session</label>
                                    <input type="hidden" value="<?php echo $company ?>" id="company">
                                    <input type="hidden" value="<?php echo $class; ?>" id="class">
                                    <select id="sessions" class="form-control" class="selectpicker">
                                        <?php
                                         $dt = date("Y-m-d");
                                            $day = date('Y-m-d', strtotime('-3 day', strtotime($dt)));
                                        $slq = "SELECT * FROM `class_sessions` WHERE `classID`='$class' AND `dt` <= '$day' ORDER BY `dt` ASC LIMIT 0,6";
                                        $slqr = mysqli_query($sys->con, $slq);
                                        while($row = mysqli_fetch_assoc($slqr)){
                                            ?>
                                                 <option <?php if($session == $row['id']){ echo "selected"; } ?> value="<?php echo $row['id']; ?>"><?php echo $row['dt']; ?></option>
                                                   
                                            <?php
                                        }
                                        
                                        ?>

                                        
                                    </select>
                                </form>
                            </div>
                        </div>
                        
                        <hr>
                        <div class="table-responsive">
                            <table class="table table-data2 table-bordered" id="members">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Member #</th>
                                    <th>Points</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $curl = curl_init();

                                curl_setopt_array($curl, array(
                                    CURLOPT_URL => "http://api.velocityhealth.co.za/admin/wellness/activity/class/register/".$class."/".$company."/".$session,
                                    CURLOPT_RETURNTRANSFER => true,
                                    CURLOPT_ENCODING => "",
                                    CURLOPT_MAXREDIRS => 10,
                                    CURLOPT_TIMEOUT => 0,
                                    CURLOPT_FOLLOWLOCATION => true,
                                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                                    CURLOPT_CUSTOMREQUEST => "GET",
                                    CURLOPT_HTTPHEADER => array(
                                        "Content-Type: application/json"
                                    ),
                                ));

                                $response = curl_exec($curl);
                                $data = json_decode($response, true);
                                curl_close($curl);

                                if ($err){

                                }else{
                                    if ($data['success']) {
                                        foreach($data['members'] as $key){
                                            ?>
                                            <tr class="tr-shadow">
                                                <td> <?php echo $key['name']." ".$key['surname']; ?> </td>
                                                <td><span class="block-email"><?php echo $key['email'] ?></span></td>
                                                <td><?php echo $key['msisdn'] ?></td>
                                                <td class="desc"><?php echo  $key['member_number']; ?></td>
                                                <td><?php echo $key['points'] ?></td>
                                                
                                               <?php
                                               
                                               if($key['attend'] == '1'){
                                                   ?>
                                                   
                                                   <td>
                                                    <div class="table-data-feature">
                                                        <a href="update.php" class="item" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-ellipsis-h"></i></a>
                                                        <a href="#" class="item "><i class ="fa fa-check text-success"></i></a>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                                   
                                                   
                                                   
                                                   
                                                   <?php
                                               }elseif($key['attend'] == '2'){
                                                   ?>
                                                   
                                                    <td>
                                                    <div class="table-data-feature">
                                                        <a href="update.php?member=<?php echo $key['id'] ?>&session=" class="item" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-ellipsis-h"></i></a>
                                                        <button href="#" class="item "><i class ="fa fa-times text-danger"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                                   
                                                   
                                                   <?php
                                               }else{
                                                   
                                               
                                               ?> 
                                                <td>
                                                    <div class="table-data-feature">
                                                        <button id="1.<?php echo $key['id'].".".$session.".".$class; ?>" class="item register" data-toggle="tooltip" data-placement="top" title="Attended">
                                                            <i class="fa fa-check-circle text-success"></i>
                                                        </button>
                                                        <button id="2.<?php echo $key['id'].".".$session.".".$class; ?>" class="item register" data-toggle="tooltip" data-placement="top" title="Not Attend">
                                                            <i class="fa fa-times text-danger"></i>
                                                        </button>
                                                        <button class="item register"><i class ="fa fa-ellipsis-h status<?php echo $key['id'] ?>"></i></button>
                                                        
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php }
                                        }
                                    }
                                }



                                ?>

                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


<?php include_once dirname(__FILE__).'/../../../System/footer.php'; ?>