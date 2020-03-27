
	<div class="container-fluid p-0 header-admin fadeIn animated">
		<div class="row header-content pt-3 pb-0 info-color text-white">
			<div class="col-md-12">
				<h2 class=" border-bottom border-white mb-0 pb-2">Barang</h2>
			</div>
			<div class="col-md-12 pl-0 pr-0 ">
				<ul class="nav">
				    <li class="nav-item">
				      <a class="nav-link waves-light active show" id="item">Item</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link waves-light" id="model">Model</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link waves-light" id="jenis">Jenis</a>
				    </li>
				</ul>
			</div>
		</div>
	</div>
	
	<main class="pt-4 produk pl-md-3 pr-md-3 mr-0">
		<div class="main-wrapper">
		    <div class="container-fluid">
		    	<div class="card">
		    		<div class="card-body">
						<div class="row mt-2">
							<div class="col-md-12 container__load fadeIn animated">
								
							</div>
						</div>
					</div>
				</div>
		    </div>
		</div>
	</main>


	<?php include 'partials/footer.php'; ?>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.nav-link').click(function(){
				var menu = $(this).attr('id');
				if(menu == "model"){
					$('.container__load').load('components/content/model.content.php');						
				}else if(menu == "jenis"){
					$('.container__load').load('components/content/jenis.content.php');						
				}else if(menu == "item"){
					$('.container__load').load('components/content/item.content.php');						
				}
			});
	 
	 
			$('.container__load').load('components/content/item.content.php');					
	 
		});
	</script>


