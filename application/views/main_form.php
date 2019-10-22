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
						<input type="email" class="form-control form-control-sm" name="exampleInputEmail" id="exampleInputEmail" placeholder="Email Address">
					</div>
					<input type="hidden" name="txtsignature" id="txtsignature">

					<!-- Signature -->
					Firma
					<div id="signature">
						<canvas id="signature-pad" class="signature-pad" width="300px" height="200px"></canvas>
						<br>
						<div>
							<button type="button" class="btn btn-primary btn-sm" data-action="clear">
								<i class="fa fa-eraser" aria-hidden="true"></i>
							</button>
							<button type="button" class="btn btn-primary btn-sm" data-action="undo">
								<i class="fa fa-undo" aria-hidden="true"></i>
							</button>
						</div>
					</div>
					<br/>
					
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

<!-- Script signature pad-->
<script src="<?= base_url()?>assets/vendor/signature_pad/signature_pad.js"></script>
<!-- <script src="<?= base_url()?>assets/vendor/signature_pad/app.js"></script> -->

<style>
#signature-pad{
 width: 300px; height: 200px;
 border: 1px solid gray;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
 	//var signaturePad = new SignaturePad(document.getElementById('signature-pad'));
	var canvas = document.getElementById("signature-pad");
	var signaturePad = new SignaturePad(canvas, {
		// It's Necessary to use an opaque color when saving image as JPEG;
		// this option can be omitted if only saving as PNG or SVG
		backgroundColor: 'rgb(255, 255, 255)',
		maxWidth: 1.5,
		minWidth: 1,
	});

	// Adjust canvas coordinate space taking into account pixel ratio,
	// to make it look crisp on mobile devices.
	// This also causes canvas to be cleared.
	function resizeCanvas() {
		// When zoomed out to less than 100%, for some very strange reason,
		// some browsers report devicePixelRatio as less than 1
		// and only part of the canvas is cleared then.
		var ratio =  Math.max(window.devicePixelRatio || 1, 1);

		// This part causes the canvas to be cleared
		canvas.width = canvas.offsetWidth * ratio;
		canvas.height = canvas.offsetHeight * ratio;
		canvas.getContext("2d").scale(ratio, ratio);

		// This library does not listen for canvas changes, so after the canvas is automatically
		// cleared by the browser, SignaturePad#isEmpty might still return false, even though the
		// canvas looks empty, because the internal data of this library wasn't cleared. To make sure
		// that the state of this library is consistent with visual state of the canvas, you
		// have to clear it manually.
		signaturePad.clear();
	}

	// On mobile devices it might make more sense to listen to orientation change,
	// rather than window resize events.
	window.onresize = resizeCanvas;
	resizeCanvas();

	var clearButton = document.querySelector("[data-action=clear]");
	var undoButton = document.querySelector("[data-action=undo]");

	clearButton.addEventListener("click", function (event) {
  		signaturePad.clear();
	});

	undoButton.addEventListener("click", function (event) {
		var data = signaturePad.toData();

		if (data) {
			data.pop(); // remove the last dot or line
			signaturePad.fromData(data);
		}
	});

	document.getElementById("frm-example").addEventListener('submit', function(event) {
		document.getElementById("txtsignature").value = signaturePad.toDataURL();
	});

});
 </script>
