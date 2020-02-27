<?php
include_once dirname(__FILE__).'/../System/System.php';
$sys = new System();

if(!$sys->checkLoginState()){
    $sys->deleteCookie();
    header('location:'.$sys->domain());
    exit();
}

if (isset($_POST['save'])){

    $email = $_POST['email'];
    $name = $_POST['name'];
    $msisdn = $_POST['msisdn'];

    $target_dir = "../../../clientzone.velocityhealth.co.za/dashboard/images/client-photos/";
    $target_file = $target_dir  . basename($_FILES["file"]["name"]);
    $uploadOk =1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["file"]["tmp_name"]);

    if($check !== false) {

        $uploadOk = 1;
        // Check if file already exists
        if (file_exists($target_file)) {

            $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Sorry, file already exists!
                  </div>';
            $uploadOk = 0;
        }
        // Check file size
        // Should also check if image dimensions fit for our display, template dimensions should be like this 486 width 648.
        if ($_FILES["file"]["size"] > 5000000) {

            $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Sorry, your file is too large!
                  </div>';
            $uploadOk = 0;
        }
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

            $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Sorry, only JPG, JPEG, PNG & GIF files are allowed!
                  </div>';
            $uploadOk = 0;
        }
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> Sorry, your file was not uploaded!
                  </div>';
            // if everything is ok, try to upload file
        } else {
            $basename = bin2hex(random_bytes(8));
            $filename = sprintf('%s.%0.8s', $basename, $imageFileType);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_dir.$filename)) {

                $sys->setToken($sys->getUserToken());
                $sys->setName($name);
                $sys->setEmail($email);
                $sys->setMsisdn($msisdn);
                $sys->setThumbnail($filename);
               $add =  $sys->addClient();

               if ($add['success']){
                   $err = '<div class="alert alert-success">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Success!</strong> Client added successfully
                  </div>';
               }else{
                   if ($add['error']['message']){
                       $err = '<div class="alert alert-danger">
                         <a href="#" class="close" data-dismiss="alert">&times;</a>
                         <strong>Error!</strong> '.$add['error']['message'].'
                      </div>';
                   }else{
                       $err = '<div class="alert alert-success">
                             <a href="#" class="close" data-dismiss="alert">&times;</a>
                             <strong>Success!</strong> Internal Server error.
                          </div>';
                   }

               }
            } else {
                $err = '<div class="alert alert-danger">
                         <a href="#" class="close" data-dismiss="alert">&times;</a>
                         <strong>Error!</strong> Sorry, there was an error uploading your file!
                      </div>';
            }
        }
    } else {
        $err = '<div class="alert alert-danger">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                     <strong>Error!</strong> File is not an image!
                  </div>';
        $uploadOk = 0;
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
                        <h3 class="title-5 m-b-35">Add Client</h3>
                        <div class="table-responsive table-responsive-data2">
                            <div class="card">
                                <div class="card-header">Company Form</div>
                                <div class="card-body">
                                    <?php
                                    if ($err){
                                        echo $err;
                                    } ?>
                                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name" class="control-label mb-1">Name</label>
                                            <input id="name" name="name" type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="cc-email" class="control-label mb-1">Email</label>
                                            <input id="cc-email" name="email" type="email" class="form-control" required>
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="msisdn" class="control-label mb-1">Mobile</label>
                                            <input id="msisdn" name="msisdn" type="text" class="form-control">
                                        </div>
                                        <div class="form-group has-success">
                                            <label for="file" class="control-label mb-1">Logo</label>
                                            <input id="file" name="file" type="file" class="form-control" accept="image/*" required>
                                        </div>
                                        <div>
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