<?php
include_once dirname(__FILE__).'/../../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
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
    <title>Classes - Dashboard Velocity</title>
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

<body>
<div class="page-wrapper">

<?php include_once dirname(__FILE__).'/../../System/nav.php'; ?>

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
                        <?php

                        $curl = curl_init();

                        curl_setopt_array($curl, array(
                            CURLOPT_URL => "http://api.velocityhealth.co.za/admin/wellness/classes",
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

                        curl_close($curl);
                        $data = json_decode($response, true);

                        foreach ($data['classes'] as $key){
                            ?>

                            <div class="col-md-4">
                                <div class="card">
                                    <img class="card-img-top img-fluid" src="<?php if (!empty($key['image'])){ echo $sys->domain()."/dashboard/images/".$key['image']; }else{ ?>https://dummyimage.com/400x200/563d7c/ffffff&text=.card-img-topfff&text=Activity <?php } ?>" alt="Card image cap">
                                    <div class="card-body">
                                        <h4 class="card-title"><?php echo $key['name'];?></h4>
                                        <a href="<?php echo $sys->domain(); ?>/dashboard/wellness/classes/register?class=<?php echo  $key['id'];?>&company=<?php echo $key['company'][0]['id']; ?>" class="btn btn-primary">Register</a>
                                    </div>
                                </div>
                            </div>

                            <?php

                        }


                        ?>
                    </div>
                </div>
            </div>
        </section>


<?php include_once dirname(__FILE__).'/../../System/footer.php'; ?>