<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="copyright">
                    <p>Velocity Health © <?php echo date('Y'); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- END PAGE CONTAINER-->
</div>

</div>

<!-- Jquery JS-->
<script src="<?php echo $sys->domain()  ?>/dashboard/vendor/jquery-3.2.1.min.js"></script>
<!-- Bootstrap JS-->
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-4.1/popper.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-4.1/bootstrap.min.js"></script>
<!-- Vendor JS       -->
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/slick/slick.min.js">
</script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/wow/wow.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/animsition/animsition.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
</script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/counter-up/jquery.waypoints.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/counter-up/jquery.counterup.min.js">
</script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/circle-progress/circle-progress.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/chartjs/Chart.bundle.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/select2/select2.min.js">
</script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/vector-map/jquery.vmap.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/vector-map/jquery.vmap.min.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/vector-map/jquery.vmap.sampledata.js"></script>
<script src="<?php echo $sys->domain() ?>/dashboard/vendor/vector-map/jquery.vmap.world.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script src="http://clientzone.velocityhealth.co.za/js/js-xlsx-master/dist/xlsx.full.min.js"></script>
<script src="http://clientzone.velocityhealth.co.za/js/FileSaver.js-master/dist/FileSaver.min.js"></script>
<script src="http://clientzone.velocityhealth.co.za/js/canvas-toBlob.js-master/canvas-toBlob.js"></script>
<!-- Main JS-->
<script src="<?php echo $sys->domain() ?>/dashboard/js/main.js"></script>
<script>
    $(document).ready(function() {
        $('#members').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );

        $('#clients').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'excel', 'pdf', 'print'
            ]
        } );
    } );
</script>
</body>

</html>
<!-- end document-->
