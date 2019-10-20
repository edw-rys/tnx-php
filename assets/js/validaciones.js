const letrasNumEspacio = new RegExp(/^[\w\-\s]+$/ );
const validaUrl = new RegExp(/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/ );
const imgFormat=new RegExp(/\.(jpg|png|gif)$/i);
const soloNum=new RegExp(/^[0-9]+$/);
//k
const sololetras = new RegExp(/^[\u00F1A-Za-z _]*[\u00F1A-Za-z][\u00F1A-Za-z _]*$/);

const numDecimal=new RegExp(/^(0|[1-9]\d*)(\.\d+)?$/ );
const alphareg = /^[A-Za-z]*\s()[A-Za-z]*$/g;
const emailreg = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
const expUsername=/^[a-z0-9ü][a-z0-9ü_]{3,15}$/;
const regexp_password = /^(?=.*\d)(?=.*[\u0021-\u002b\u003c-\u0040])(?=.*[A-Z])(?=.*[a-z])\S{6,16}$/;
const regexobj=/^[a-zA-Z0-9üáéíóú][a-zA-Z0-9ü+ _áéíóú-]{3,30}$/;
const regexobjPrepare=/^[a-zA-Z0-9üáéíóú][a-zA-Z0-9ü+ _.,:;áéíóú-]{3,900}$/;
function validateFormProduct(data) {
	var name = data.get("name");
	var img    = data.get("image");
	var type   =data.get("type");
	var description   =data.get("description");
	let imageAut = data.get("image-edit");
	var message=[];
	// Recolección de datos
	if(name.length==0){
		message.push("Escriba el nombre.")
	}else{
		if(!regexobjPrepare.test(name)){
			message.push("Nombre no es válido")
			
		}
	}
	if(!type && type=="0"){
		message.push("Seleccione un tipo")
	}
	// Validaciones
	if(!regexobjPrepare.test(description))
		message.push("Preparación: Caracteres no permitidos o excede la su longitud (max->900)");
	if(!imageAut){
		if(!img.name || img.name.length==0)
		message.push("Inserte una imagen");
		else if(!imgFormat.test(img.name))
		message.push("Formato de archivo no es correcto");
	}


	if(message.length==0 || !message)
		return true;
	return message;
}