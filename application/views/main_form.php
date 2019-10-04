<?php
//var_dump($_SERVER['SERVER_NAME']);
?>

<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header py-2.5">
				<h6 class="m-0 text-primary">Form Example</h6>
			</div>
			<div class="card-body">
				<form id="frm-example" method="post" action="<?= base_url()?>index.php/main/store">
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<input type="text" class="form-control form-control-sm" name="exampleFirstName" id="exampleFirstName" placeholder="First Name">
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control form-control-sm" name="exampleLastName" id="exampleLastName" placeholder="Last Name">
						</div>
					</div>
					
					<div class="form-group">
						<input type="email" class="form-control form-control-sm" id="exampleInputEmail" id="exampleInputEmail" placeholder="Email Address">
					</div>
					
					<div class="form-group row">
						<div class="col-sm-6 mb-3 mb-sm-0">
							<input type="password" class="form-control form-control-sm" name="exampleInputPassword" id="exampleInputPassword" placeholder="Password">
						</div>
						<div class="col-sm-6">
							<input type="password" class="form-control form-control-sm" name="exampleRepeatPassword" id="exampleRepeatPassword" placeholder="Repeat Password">
						</div>
					</div>
					<button type="submit" class="btn btn-primary btn-sm btn-block">Registrar</button>
				</form>	
			
			</div>
		</div>
	</div>
</div>
<!-- Bootstrap core JavaScript-->
<script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url()?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url()?>assets/js/sb-admin-2.js"></script>
