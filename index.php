<?php
/**
 * Including header file.
 * Contains Navbar.
 */
require_once 'header.php';

/**
 * Session variable to show messages,
 * Like Login Successful.
 */
if(Session::exists('home')) {
    echo '<div class="alert alert-success" role="alert">' . Session::flash('home') . '</div><br>';
}

?>
<div class="container">

        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 table-bordered">
                <div class="jumbotron">
                    <img src="images/jumbotron.jpg" width="100%">
                </div>
            </div>
            <div class="col-sm-12 col-md-3 col-lg-3 col-lg-offset-1 col-md-offset-1 table-bordered">
                <p>Side bar</p>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-md-4 col-lg-4 table-bordered">
                <p>Some data here</p>
            </div>
            <div class="col-sm-6 col-md-4 col-lg-4 table-bordered">
                <p>Some data here</p>
            </div>
            <div class="col-sm-12 col-md-4 col-lg-4 table-bordered">
                <p>Some data here</p>
            </div>
        </div>

</div>
<?php
/**
 * Include Footer file
 */
require_once 'footer.php';