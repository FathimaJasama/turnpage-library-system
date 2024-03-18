

		<!-- *************
			************ Required JavaScript Files *************
		************* -->
		<!-- Required jQuery first, then Bootstrap Bundle JS -->
		<script src="<?=asset("assets/js/jquery.min.js")?>"></script>
		<script src="<?=asset("assets/js/bootstrap.bundle.min.js")?>"></script>
		<script src="<?=asset("assets/js/modernizr.js")?>"></script>
		<script src="<?=asset("assets/js/moment.js")?>"></script>

		<!-- *************
			************ Vendor Js Files *************
		************* -->

		<!-- Overlay Scroll JS -->
		<script src="<?=asset("assets/vendor/overlay-scroll/jquery.overlayScrollbars.min.js")?>"></script>
		<script src="<?=asset("assets/vendor/overlay-scroll/custom-scrollbar.js")?>"></script>

		<!-- News ticker -->
		<script src="<?=asset("assets/vendor/newsticker/newsTicker.min.js")?>"></script>
		<script src="<?=asset("assets/vendor/newsticker/custom-newsTicker.js")?>"></script>

		<!-- Date Range JS -->
		<script src="<?=asset("assets/vendor/daterange/daterange.js")?>"></script>
		<script src="<?=asset("assets/vendor/daterange/custom-daterange.js")?>"></script>

		<!-- Dropzone JS -->
		<script src="<?=asset("assets/vendor/dropzone/dropzone.min.js")?>"></script>

		<!-- Main Js Required -->
		<script src="<?=asset("assets/js/main.js")?>"></script>

		<script>
                // Function to display a Bootstrap alert
            function showAlert(message, alertType, id = "alert-container") {
             var alertContainer = $('#' + id);
            var alert = $('<div class="alert alert-' + alertType + ' alert-dismissible fade show" role="alert">' + message +
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                    alertContainer.html(alert);
         }
        </script>
	</body>

</html>