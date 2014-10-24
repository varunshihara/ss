<?php
require_once 'header.php';
?>


<div class="row">

    <div class="col-md-1"></div>
    <div class="col-md-10">
        <?php
        if(Session::exists('register')) {
            echo '<div class="alert alert-success" role="alert">' . Session::flash('register') . '</div><br>';
        }
        ?>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-sm-9">
                        <h3 class="panel-title">Category</h3>
                    </div>
                    <div class="col-sm-3">
                        <center>
                        <a href="#" class="btn-sm btn-danger">New</a>
                        <a href="#" class="btn-sm btn-danger">Edit</a>
                        <a href="#" class="btn-sm btn-danger">Delete</a>
                        </center>
                    </div>
                </div>
            </div>
            <div class="panel-body">

            </div>
        </div>

    </div>
    <div class="col-md-1"></div>
</div>


<?php
require_once 'footer.php';
?>