<header>
	<?php require_once NAVIGATION; ?>
</header>
<div class="despliegue"></div>
<!--  -->
<button class="button-new-recipe" onclick="getFormProduct()" style="margin:0 10px;padding:5px 10px">Nuevo</button>

<div class="m-20"></div>
<div class="data flex-center flex-y">
<?php 
	$fun ="filterByName";
	include_once COMPONENTS."search.php";
	?>
<div class="m-20"></div>

<!-- Table responsive -->
<div class="table-responsive" id="table_insert_product">
	<?php
        // Import header and body table
        require_once COMPONENTS."product\headerTable.php";
        require_once COMPONENTS."product\bodyTable.php";
	?>
</div>

</div>  
<div class="m-20"></div>

