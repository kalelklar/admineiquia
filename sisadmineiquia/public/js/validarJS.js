	var primernombre=document.getElementById("primernombre");
	var segundonombre = document.getElementById("segundonombre");
	var primerapellido = document.getElementById("primerapellido");
	var segundoapellido = document.getElementById("segundoapellido");
	var nit = document.getElementById("nit");
	var dui = document.getElementById("dui");
	var isss = document.getElementById("isss");
	var nup = document.getElementById("nup");
	var alerta = document.getElementById("alerta");
	var fechaApertura = document.getElementById("fechaApertura");
	var codCon = document.getElementById("codCon");
	var codAcuerdo = document.getElementById("codAcuerdo");
	var fechaAcuerdo = document.getElementById("fechaAcuerdo");
	var motivoAcuerdo = document.getElementById("motivoAcuerdo");
	var descripcionAcuerdo = document.getElementById("descripcionAcuerdo");
	var tiempoadicionalinicio = document.getElementById("tiempoadicionalinicio");
	var tiempoadicionalfin = document.getElementById("tiempoadicionalfin");


	function corregirPrimerNombre(){
		var value = primernombre.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			primernombre.value = value;
		}
	}

	function corregirSegundoNombre(){
		var value = segundonombre.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundonombre.value = value;
		}
	}


	function corregirPrimerApellido(){
		var value = primerapellido.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			primerapellido.value = value;
		}
	}

	function corregirSegundoApellido(){
		var value = segundoapellido.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundoapellido.value = value;
		}
	}

	function corregirDui() {
		var value = dui.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			switch (longitudActual){
				case 9:
					if(ultimoCaracter != '-'){
						value = value.substring(0, longitudActual - 1);
					}
					break;
				default:
					if(!/\d/.test(ultimoCaracter)){
						value = value.substring(0, longitudActual - 1);
					}
			}
			if (longitudActual > 10){
				value = value.substring(0, longitudActual - 1);
			}
			longitudActual = value.length;
			switch (longitudActual) {
				case 8:
					value += "-";
			}
			dui.value = value;
		}

	}

	function corregirNit() {
		var value = nit.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			switch (longitudActual){
				case 5:
				case 12:
				case 16:
					if(ultimoCaracter != '-'){
						value = value.substring(0,longitudActual - 1);
					}
					break;
				default:
					if(!/\d/.test(ultimoCaracter)) {
						value = value.substring(0,longitudActual - 1);
					}
			}
			if(longitudActual > 17) {
				value = value.substring(0, longitudActual - 1);
			}
			longitudActual = value.length;
			switch (longitudActual) {
				case 4:
				case 11:
				case 15:
					value += "-";
			}
			nit.value = value;
		}
	}

	function corregirIsss() {
		var value = isss.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/\d/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 9) {
				value = value.substring(0, longitudActual - 1);
			}
			isss.value = value;
		}
	}

	//Numero de AFP
	function corregirNup() {
		var value = nup.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/\d/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 12) {
				value = value.substring(0, longitudActual - 1);
			}
			nup.value = value;
		}
	}

	function corregirFecha(){
		var value = fechaApertura.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(longitudActual == 1){
				value = "";
			}

			fechaApertura.value = value;
		}
	}

	
	function corregirCodCon(){
		var value = codCon.value.toUpperCase();
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			switch (longitudActual){
				case 1:

				case 2:	
					if(!/[aA-zZ]/.test(ultimoCaracter)){
						value = value.substring(0, longitudActual - 1);
					}
				break;
				case 3:
					codCon.value += "-";
					if(!/[-]/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}

				break;
				case 4:
				case 5:
				case 6:
					if(!/\d/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}
				break;
				case 7:
				codCon.value += "-";
				if(!/[-]/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}
				break;
				case 8:
				case 9:
				case 10:
				case 11:
					if(!/\d/.test(ultimoCaracter)){
						value = value.substring(0, longitudActual - 1);
					}
				break;
			}
			if(longitudActual > 11) {
				value = value.substring(0, longitudActual - 1);
			}
			longitudActual = value.length;
			switch (longitudActual) {
				case 2:
					value += "-";
				break;
				case 6:
					value += "-";
				break;
			}
			codCon.value = value;
		}
	}

	function corregirNombreInstitucion(){
		var value = nombreinstitucion.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundonombre.value = value;
		}
	}

	function corregirTituloObtenido(){
		var value = tituloobtenido.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundonombre.value = value;
		}
	}

	function corregirTituloEstudio(){
		var value = tituloestudio.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundonombre.value = value;
		}
	}

	function corregirDireccionInstitucion(){
		var value = direccioninstitucion.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			segundonombre.value = value;
		}
	}

	
	function corregirCodAcuerdo(){
		var value = codAcuerdo.value.toUpperCase();
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			switch (longitudActual){
				case 1:

				case 2:	
					if(!/[aA-zZ]/.test(ultimoCaracter)){
						value = value.substring(0, longitudActual - 1);
					}
				break;
				case 3:
					if(!/[-]/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}
				break;
				case 4:
				case 5:
				case 6:
					if(!/\d/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}
				break;
				case 7:
				if(!/[-]/.test(ultimoCaracter)){
							value = value.substring(0, longitudActual - 1);
						}
				break;
				case 8:
				case 9:
				case 10:
				case 11:
					if(!/\d/.test(ultimoCaracter)){
						value = value.substring(0, longitudActual - 1);
					}
				break;
			}
			if(longitudActual > 11) {
				value = value.substring(0, longitudActual - 1);
			}
			longitudActual = value.length;
			switch (longitudActual) {
				case 2:
				case 6:
					value += "-";
			}
			codAcuerdo.value = value;
			longitudActual = value.length;
			switch (longitudActual) {
				case 2:
					value += "-";
				break;
				case 6:
					value += "-";
				break;
			}
			codAcuerdo.value = value;
		}
	}

	
	function corregirFechaAcuerdo(){
		var value = fechaAcuerdo.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			switch (longitudActual){
				case 3:
				case 6:
					if(ultimoCaracter != '-'){
						value = value.substring(0,longitudActual - 1);
					}
				break;
				default:
					if(!/\d/.test(ultimoCaracter)) {
						value = value.substring(0,longitudActual - 1);
					}
				}
			if(longitudActual > 10) {
				value = value.substring(0, longitudActual - 1);
			}
			longitudActual = value.length;
			switch (longitudActual) {
				case 2:
				case 5:
					value += "-";
			}

			fechaAcuerdo.value = value;
		}
	}

	function corregirMotivoAcuerdo(){
		var value = motivoAcuerdo.value;
		var longitudActual = value.length;
		if(longitudActual){
			var ultimoCaracter = value.substring(longitudActual - 1);
			if(!/[aA-zZ]/.test(ultimoCaracter)) {
				value = value.substring(0, longitudActual - 1);
			}
			if(longitudActual > 50) {
				value = value.substring(0, longitudActual - 1);
			}
			motivoAcuerdo.value = value;
		}
	}

	function corregirDescripcionAcuerdo(){
		var value = descripcionAcuerdo.value;
		var longitudActual = value.length;

		if(longitudActual > 250) {
			value = value.substring(0, longitudActual - 1);
		}

		descripcionAcuerdo.value = value;
	}

	
	



