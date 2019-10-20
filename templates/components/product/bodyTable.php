<?php
if(isset($data["products"])){
	foreach($data["products"] as $product){
		?>
		<div class="row-table" target-name="product-id-<?php echo $product->id?>">
			<div class="cell" data-title="Id"><?php echo $product->id; ?></div>
			<div class="cell" data-title="Usuario"><?php echo $product->name; ?></div>
			<div class="cell" data-title="Fecha de creación"><?php echo $product->description; ?></div>
			<div class="cell" data-title="Asunto"><?php echo $product->name_type; ?></div>
			<div class="cell" data-title="Fecha de ejecución"><?php echo $product->created_at; ?></div>

            <div class="cell" data-title="" style="--color-txt:#009F41"><a href="#!" onclick="showProduct(<?php echo $product->id; ?>)">Ver</a></div>
            <div class="cell" data-title="" style="--color-txt:#009F41"><a href="#!" onclick="editProduct(<?php echo $product->id; ?>)">Editar</a></div>
            <div class="cell" data-title="" style="--color-txt: red"><a onclick="deleteProduct(<?php echo $product->id; ?>, this.parentNode)" href="#!">Eliminar</a></div>
		</div>
        <?php
    }
}
?>
