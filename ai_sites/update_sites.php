<!DOCTYPE html>
<html lang="en">

<?php include('head.php'); 
$con = OpenCon(); 

?>

<style>
img {
    display: block;
    margin-left: auto;
    margin-right: auto;
}

form-control {
    border: 1px solid black;
}

hr {
    border-top: 1px solid black;
}
</style>

<body>
    <?php include('top-navbar.php'); 
        include('navbar.php'); ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <div class="center">
                    <img src="images/audichyalogo.png" style="align:center; width:150px" alt="Audichaya Bhawan Panch">
                    <h3 class="page-title">
                        AI Sites
                    </h3>
                </div>
            </div>
            <form action="update_sites.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="col-sm-12">
                                            <input type="file" class="form-control" name="files" id="files" value="" />
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <button type="submit" id="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                </div>

                                <?php
                            
                            if (isset($_POST['submit'])) {

                                // var_dump($_FILES);
                                $userid = $_SESSION['userid'];

                                $date = date('Y-m-d h:i:s a', time());
                                $only_date = date('Y-m-d');
                                $target_dir = '../PHPExcel/';
                                $file_name = $_FILES["files"]["name"];
                                $file_tmp = $_FILES["files"]["tmp_name"];
                                $file =  $target_dir . '/' . $file_name;


                                $status = 'open';
                                $created_by = $_SESSION['userid'];
                                $created_at = date('Y-m-d H:i:s');




                                move_uploaded_file($file_tmp = $_FILES["files"]["tmp_name"], $target_dir . '/' . $file_name);
                                include('PHPExcel/PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
                                $inputFileName = $file;

                                //  Read your Excel workbook

                                try {
                                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                                    $objPHPExcel = $objReader->load($inputFileName);
                                } catch (Exception $e) {
                                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                                        $e->getMessage());
                                }

                                $sheet = $objPHPExcel->getSheet(0);
                                $highestRow = $sheet->getHighestRow();
                                $highestColumn = $sheet->getHighestColumn();

                                //  Loop through each row of the worksheet in turn

                                for ($row = 1; $row <= $highestRow; $row++) {

                                    //  Read a row of data into an array

                                    $rowData[] = $sheet->rangeToArray(
                                        'A' . $row . ':' . $highestColumn . $row,
                                        null,
                                        true,
                                        false
                                    );

                                    //  Insert row data array into your database of choice here                      
                                }

                                $row = $row - 2;
                                $error = '0';
                                $contents = '';
                                $updatekey = 0;
                                $error_array = array();
                                
                                $atmnot_found = "";$total_atm = 0;$totalupdated_atm=0;
                                echo '<pre>';print_r($rowData);echo '</pre>';die;
                            }
                            ?>


                            </div>

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>


<?php include 'footer.php';?>