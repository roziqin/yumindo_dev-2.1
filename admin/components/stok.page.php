
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-3 info-color text-white">
			<div class="col-md-12">
				<h2>Stok</h2>
			</div>
		</div>
	</div>
	<main class="pt-4 stok pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
				<div class="row mt-2">
					<div class="col-md-12  col-table container__load fadeIn animated">

					</div>
				</div>
		    </div>
		</div>
	</main>


	<?php include 'partials/footer.php'; ?>


<script type="text/javascript">
	$(document).ready(function(){
		$('.container__load').load('components/content/stok.content.php');
	});
</script>