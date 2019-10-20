<?php if(isset($data["product"])) $product = $data["product"]; ?>
<div class="showProduct">
    <div class="flex-center">
        <img src="<?php echo isset($product)?$product->url_image:'';?>" alt="">
    </div>
    <div class="grid" style="display:grid;grid-template-columns:1fr 1fr; grid-gap:20px">
        <div class="cont" style="border: 1px solid #000">
            <p>Nombre</p>
            <p class="txt-center"><?php echo isset($product)?$product->name:'';?></p>
        </div>
        <div class="cont" style="border: 1px solid #000">
            <p>Se creó</p>
            <p class="txt-center"><?php echo isset($product)?$product->created_at:'';?></p>
        </div>
        <div class="cont" style="border: 1px solid #000">
            <p>Tipo</p>
            <p class="txt-center"><?php echo isset($product)?$product->name_type:'';?></p>
        </div>
    </div> 
    <div class="" style="border: 1px solid #000;margin:10px 0;">
        <p class="" style="">Descripción</p>
        <p class="txt-center"><?php echo isset($product)?$product->description:'';?></p>
    </div>
</div>