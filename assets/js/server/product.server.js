// Ejemplo de producto con el API fetch
const urlProduct = url+'product/';
/**
 * Obtiene el formulario para un nuevo producto o editarlo, se coloca en la ventana modal
 * @param {*} id  Id del producto, en caso de editar
 */
const getFormProduct =function(id) {
    let uri=id?`${urlProduct}new/${id}`:urlProduct+"new";
    console.log(uri)
    fetch(uri)
    .then(res=>res.text())
    .then(res=>{
        // console.log(res);
        if(res && res!="error"){
            activeModal(res);
        }
    })
    .catch(err=>console.log(err));
}
/**
 * Función para guardar o editar un producto
 * Se necesita el id del formulario para obtener los datos y validarlos
 */
const saveProduct=()=>{
    const formRecipe=document.getElementById("formProduct");
    var btn=formRecipe.submit;
    // Carga la animación dentro del botón de envío
    animationCharge(btn);
    if(formRecipe){
        formRecipe.addEventListener("submit",e=>{e.preventDefault();})
        let data = new FormData(formRecipe);
        setTimeout(() => {
            value = validateFormProduct(data);
            if(Array.isArray(value)){
                // error de datos
                value.forEach(element => {
                    toastr.error(element);
                });
                animationChargeRemove(btn,"Publicar");
            }else{
                fetch(urlProduct+"insert",{
                    method:"POST",
                    body:data
                })
                .then(res=>res.json())
                .then(
                    async (res)=>{
                        // console.log(res)
                        if(res.code==200){
                            toastr.success(res.message);
                            let productTable = document.getElementById("table_insert_product");
                            // Obtiene la fila del nuevo producto
                            let dataProduct = await getNewProduct(res.id);
                            if(dataProduct){
                                // Obtiene el elemento html
                                let element = getHTML(dataProduct);
                                if(!data.get("id")){
                                    // Insert new
                                    productTable.appendChild(element);
                                    
                                    addClass(element,"animated zoomInUp");
                                }else{
                                    // Edit
                                    let productReplace = document.querySelector(`[target-name="product-id-${res.id}"]`);
                                    productTable.replaceChild(element, productReplace);
                                }
                            }
                            removeModal();
                        }else{
                            toastr.error(res.message);
                        }
                        animationChargeRemove(btn,"Publicar");
                    }
                )
                .catch(err=>{
                    console.log(err);
                    animationChargeRemove(btn,"Publicar");
                    toastr.error("Ups!","Ha ocurrido un error");
                });
            }
        }, timeResponse);
        
    }
    return false;
}
/**
 * 
 * @param {*} id id del producto a editar
 */
const editProduct=(id=0 )=>{
    if(id!=0 ){
        getFormProduct(id);
    }
}
/**
 * Elimina el producto y la fila referente a la columna que se pasó por parámetro
 * @param {*} id 
 * @param {elemento} col columna donde se dio clic
 */
const deleteProduct=(id,col)=>{
    if(!id)return false;
    if(confirm('esta seguro?')){
        // Valor de la columna seleccionada guardad en auxiliar
        let aux = col.innerHTML;
        animationCharge(col);
        setTimeout(() => {
            fetch(urlProduct+"delete/"+id)
            .then(res=>res.json())
            .then(
                res=>{
                    if(res.status=="success"){
                        let item= col.parentNode;
                        toastr.success(res.message);
                        addClass(item,"animated zoomOut");
                        setTimeout(() => {
                            item.remove();
                        },400);
                    }else{
                        toastr.error(res.message);
                    }
                    animationChargeRemove(col,"Publicar");
                    col.innerHTML = aux;
                }
            )
            .catch(
                err=>{
                    toastr.error("Ups!","Ha ocurrido un error");
                    animationChargeRemove(col,"Publicar");
                    col.innerHTML = aux;
                }
            );
        }, timeResponse);
    }
}
const filterByName=(value="")=>{
    fetch(urlProduct+"query/"+value)
    .then(res=>res.text())
    .then(
        res=>{
            if(res!="null"){
                // console.log(res);
                let body=document.getElementById("table_insert_product");
                body.innerHTML=res;
            }
        }
    )
    .catch(
        err=>{
            toastr.error("Ups!","Ha ocurrido un error");
        }
    );
}
/**
 * Obtener la fila del nuevo producto creado
 * @param {*} id -> id de producto
 */
const getNewProduct = async (id)=>{
    if(!id)return false;
    let res = await fetch(urlProduct+"view/"+id+"/get");
    res = await res.text();
    // Return Promise
    return res;
}
const showProduct =(id)=>{
    if(!id)return false;
    fetch(urlProduct+"view/"+id)
    .then(res=>res.text())
    .then(
        res=>{
            if(res && res!="null"){
                activeModal(res);
            }
        }
    )
    .catch(
        err=>{
            toastr.error("Ups!","Ha ocurrido un error");
        }
    );
}