<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Parse Webpage Task</title>
    <meta name="description" content="Parse Webpage Task">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
	<style>
		.login-form {width: 400px;margin: 5% auto;}
		.login-form .form-row {margin-top: 10px;display: block;}
		.prodimg { text-align: center;border-bottom: 1px solid #f2ecec;padding: 5px 0; }
		.prodimg img{object-fit: contain;width: 100%;height: auto;}
		.prodname { font-weight: 500;padding: 10px;text-align: center; }
		.prodprice { font-weight: 500; padding: 10px; color: red; text-align: center; }
	</style>
</head>
<body>

	<div class="container">
		<div class="card login-form">
			<div class="card-body">
				<h3 class="card-title text-center">Get product details</h3>
				<?php echo form_open_multipart("", array("id"=>"form_validation",'data-toggle'=> "validator"));?>
				<div class="form-row">
					<div class="col-md-12">
						<label>Product URL</label>
						<input type="text" name="product_url" class="form-control" placeholder="Enter Product URL" required>
					</div>
				</div>
				<div class="form-row text-right">
					<button class="btn btn-primary" type="submit">Submit</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		
		
		<div class="row">
			<?php if(!empty($getproduct)){ foreach($getproduct as $product){?>
			<div class="col-md-3" style="border:1px solid #ddd;margin: 2px;">
				<div class="prodimg"><img src="<?php echo $product->product_img;?>" alt="<?php echo $product->product_name;?>"></div>
				<div class="prodname"><?php echo $product->product_name;?></div>
				<div class="prodprice">$ <?php echo $product->product_price;?></div>
			</div>
			<?php } } else {?>
			<div class="col-md-12">
				<p class="text-center">No product found</p>
			</div>
			<?php } ?>
		</div>
	</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>
