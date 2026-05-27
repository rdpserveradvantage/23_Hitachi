<!DOCTYPE html>
<html lang="en">
<?php include('head.php');	      
	?>

<style>
.table thead th,
.jsgrid .jsgrid-table thead th {
    border-top: 0;
    border-bottom-width: 1px;
    font-weight: bold;
    font-size: .9rem;
    padding: 0.4375rem;
}

.bt {
    border-top: 1px solid #1e1f33;
}

.br {
    border-right: 1px solid #282844;
}

#accordion div.card-body {
    /*	margin:4px, 4px;
			padding:4px;
			background-color: green;
			width: 500px;  
			height: 210px;
			overflow-x: hidden;
			overflow-y: scroll; */
    text-align: justify;
}
</style>
<style>
.menu-icon {
    width: 33px;
    margin-right: 7%;
}

th,
td {
    white-space: nowrap;
}
</style>
<?php include('top-navbar.php');?>
<!-- partial -->
<div class="container-fluid page-body-wrapper">

    <?php include('navbar.php');?>
    <!-- partial -->
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="col-12 grid-margin">
                <h6 class="card-title">Add User</h6>
                <?php //include('filters/sitehealth_filter.php');?>
            </div>

            <form action="insert_user.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="col-form-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="name" id="name" value=""
                                                required />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Username (Email)</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="usrname" id="usrname"
                                                value="" required />
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <label class="col-form-label">Password</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" name="pwd" id="pwd" required />
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <div class="card-body">
                                <button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <?php include('footer.php');?>
        <!-- partial -->
    </div>
    <!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>

<!-- container-scroller -->
<!-- plugins:js -->
<script src="vendors/js/vendor.bundle.base.js">
</script>
<script src="vendors/js/vendor.bundle.addons.js">
</script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="js/off-canvas.js">
</script>
<script src="js/hoverable-collapse.js">
</script>
<script src="js/misc.js">
</script>
<script src="js/settings.js">
</script>
<script src="js/todolist.js"></script>
<script src="js/chart.js"></script>
<script src="js/client_bank_circle_atmid.js"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<!-- <script src="js/networkreport_1.js"></script> -->
<script src="js/networkreport_1_new.js"></script>
<script src="js/data-table.js"></script>
<script src="js/select2.js"></script>
<!-- End custom js for this page-->
<script>
$(document).on("click", ".large-modal", function() {
    var src = $(this).data('id');
    $(".modal-body #img_src").prop('src', src);

});
</script>


</body>

</html>