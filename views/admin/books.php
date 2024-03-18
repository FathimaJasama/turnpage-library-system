<?php
include("../layouts/Header.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery</title>
  
</head>
<body>

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-book"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Books</h5>
        </div>
    </div>
</div>
<!-- Main header ends -->

<!-- Content wrapper start -->
<div class="content-wrapper">
<!-- book image start -->
    <div class="row gx-3">
		<div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="books/PHP And MySql programming.jpg" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>PHP And MySql programming</h4>										
				</div>
			</div>
		</div>
		<div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="books/physics.jpg" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>physics</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/Murach's MySQL.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>Murach's MySQL</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/ASP.NET Core 5 for Beginners.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>ASP.NET Core 5 for Beginners</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/WordPress for Beginners 2022 A Visual Step-by-Step Guide to Mastering WordPress.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>WordPress for Beginners 2022 A Visual Step-by-Step Guide to Mastering WordPress</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/WordPress Mastery Guide.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>WordPress Mastery Guide</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/Rich Dad Poor Dad.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>Rich Dad Poor Dad: What the Rich Teach Their Kids About Money That the Poor and Middle Class Do Not</h4>										
				</div>
			</div>
		</div>
        <div class="col-sm-2 col-6">
			<div class="card">
				<div class="card-img">
					<img src="<?=asset("books/The Girl Who Drank the Moon.jpg")?>" class="card-img-top img-fluid" alt="Google Admin" />
				</div>
				<div class="card-body">
					<h4>The Girl Who Drank the Moon</h4>										
				</div>
			</div>
		</div>
        
      
					
	</div>
                        <!--images end -->
</div>

        <!-- adding image as an order     -->


<!-- Content wrapper end -->
<?php
require_once('../layouts/Footer.php');
?>
</body>
</html>
