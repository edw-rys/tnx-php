<?php if(isset($data["product"])){ $product=$data["product"];}?>
<div class="form-clasic">
    <div class="header_">
		<div class="bottom-head txt-center">
			<!-- <h2 class="title">Nueva receta</h2> -->
			<h2 class="txt-center tittle-sty-bck bck-t-first">Agregar Producto</h2>
		</div>
	</div>
	<form id="formProduct">
	
		<div class="middle flex-center">
			<label class="txt-white">
				<input type="file" name="image" class="hidden"/>
				<div class="box-radio active" >
					<span class="icon" style="--color-txt:var(--color-second);opacity:1;transform: translateY(0px);">
                	    <i class="fas fa-camera"></i>
					</span>
					<span class="title-radio">Imagen</span>
				</div>
			</label>
		</div>
		<?php 
			if(isset($product)){
				echo "<input type='hidden' name='image-edit' value ='".$product->url_image."'>";
			}
		?>

		<?php if(isset($product) && !empty($product)){?>
            <!-- Id  -->
		    <input type="hidden" name="id" value="<?php echo $product->id?>">
		<?php } ?>
        
		<div class="flex-center">
			<span class="container-input border-botom">
				<input class="clean-slide" name="name" id="name" type="text" value="<?php echo isset($product)?$product->name:''?>"
					placeholder="Escriba el nombre de la comida" />
				<label for="name">Nombre</label>
			</span>
		</div>

        <!-- Type product -->
		<div class="flex-center flex-y m-10px">
			<label>Tipo</label>
			<select name="type" class="select border-bottom-unique">
				<option value="0">Seleccione ..</option>
				<?php
				if(isset($data["typesProduct"]) && !empty($data["typesProduct"])){
					foreach($data["typesProduct"] as $type){ ?>

				<option value="<?php echo $type->id_type;?>"
                <?php if(isset($product) && !empty($product)){if($product->type_id==$type->id_type) echo 'selected';}?>>
					<?php echo $type->name_type;?>
				</option>

				<?php }} ?>
			</select>
		</div>
        <!-- Descripción -->
		<div class="area txt-center">
			<label for="description">
				<span class="border-bottom-unique block">Descripcion</span>
			</label>
			<!-- <label class="txt-center border-bottom-unique">Breve descripción </label> -->
			<div class="flex-y">
				<textarea class="no-borde no-outline" id="description" rows="4" name="description"><?php echo isset($product)?$product->description:''?></textarea>
			</div>
		</div>

		<div class="buttons" style="display: grid;grid-template-columns: 1fr 1fr;">
			<button class="button btn-first" type="submit" name="submit" onclick="saveProduct()">Guardar</button>
			<input class="button btn-first" type="reset" name="reset" value="Limpiar">
		</div>
	</form>
</div>