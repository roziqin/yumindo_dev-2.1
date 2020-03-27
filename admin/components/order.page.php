
    <input type="hidden" id="defaultForm-role" name="ip-role" value="<?php echo $_SESSION['role']; ?>">
    <input type="hidden" id="defaultForm-user" name="ip-user" value="<?php echo $_SESSION['name']; ?>">
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-3 info-color text-white">
			<div class="col-md-12">
				<h2>Input Pengukuran</h2>
			</div>
		</div>
	</div>
	<main class="pt-2 pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
				<div class="row row-top">
					<div id="box-barang" class="col-md-12 tab-box-content container__load">

					</div>
				</div>
		    </div>
		</div>
	</main>

	<?php include 'partials/footer.php'; ?>
<script type="text/javascript">
	$(document).ready(function(){

		$('.container__load').load('components/content/order.content.php?kond=home');		
		
	});
</script>