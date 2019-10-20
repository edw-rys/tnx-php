/**
 * 
 * @param {*} element elimina el primer nodo de un elemento
 */
function eliminarNodos(element){
	while(element.hasChildNodes){
		element.removeChild(element.firstChild);
	}
}

/**
 * Añade un input tipo texto con las siguiente reglas
 * <li>
 * 	<input class="input-txt border-bottom-unique no-outline">
 * </li>
 * @param {string} _name 
 */
function addLiInput(_name){
	var li=document.createElement("li");
	var input=createElement("input",{"type":"text","class":"input-txt border-bottom-unique no-outline","name":_name});
	li.classList="space-around flex";
	li.appendChild(input);
	return li;
}
/**
 * Añade un elemento lista 
 * Contiene un input y un botón de tash
 * @param {*} _id id del contenedor
 */
function addElementLi(_id, nameInput){
	var node=document.getElementById(_id);
	var li=addLiInput(nameInput);
	li.appendChild(trash());
	node.appendChild(li);
	// Animación de entrada
	addClass(li, "animated zoomIn");
}
/**
 * Crea un elemento botón para eliminar un elemento padre que lo contendrá
 */
function trash(){
	var btn=createElement("button",{"type":"button","onclick":"removeCampFather(this)"});
	var icon=createElement("img",{"src":"assets/img/icons/trash-alt-regular.svg","width":"20"});
	btn.appendChild(icon);
	return btn;
}

// var socialNetwork=["facebook","instagram","twitter","Pinterest"];
/**
 * Elimina un elemento, padre del elemento nodo que se pasa por parámetro
 * @param {*} children 
 */
function removeCampFather(children){
	children=children.parentNode;
	nodes=children.parentNode;
	addClass(children,"animated zoomOut");
	setTimeout(() => {
		nodes.removeChild(children);
	}, 400);
}