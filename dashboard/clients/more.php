<?php
include_once dirname(__FILE__).'/../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

if(!isset($_GET['id'])){
    header('location:'.$sys->domain().'/dashboard/clients');
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
        <title>Client Details - Velocity</title>
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
        <link rel="stylesheet" href="<?php echo  $sys->domain()?>/dashboard/css/linearicons/Web Font/style.css">
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
                                    <li class="list-inline-item">Company Name</li>
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
                    <?php
                    
                    $clients = $sys->clients();
                    foreach ($clients['company'] as $key){
                        if($key['id'] == $_GET['id']){
                            
                            ?>
                            <div class="col-md-4">
                                <div class="card" style="height:340px 
                            !important">
                                  <img class="card-img-top img-fluid"  src="http://clientzone.velocityhealth.co.za/dashboard/images/client-photos/<?php echo $key['logo']; ?>" alt="">
                                  <div class="card-body text-center">
                                      <hr>
                                    <h3 class="card-title"><?php echo $key['name']; ?></h3>
                                    
                                  </div>
                                </div>
                            </div>
                            
                         <?php
                            
                        }
                    }
                    
                    ?>   
                    <div class="col-md-8" >
                        <div class="card">
                            <div class="row card-body">
                            <div class="col-md-4">
                                <div class="card mt-4">
                                    <img class="card-img-top img-fluid"  src="http://admin.velocityhealth.co.za/dashboard/images/club cycling 2.jpg" height="40" alt="">
                                    <div class="card-body text-center">
                                        <a href="add-class.php?company=<?php echo $_GET['id']; ?>">
                                           <div class="card-block  text-center">
                                               <h4 class="card-title"><i class="fa fa-cogs"></i></h4>
                                                <h6 class="card-subtitle mb-2 text-muted">Add New Class</h6>
                                            
                                            </div>
                                        </a>
                                        
                                    </div>
                                </div>
                            </div>
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