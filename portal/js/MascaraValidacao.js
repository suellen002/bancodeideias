//mascara cnpj
function MascaraCNPJ(cnpj){
    if(mascaraInteiro(cnpj)==false){
        event.returnValue = false;
    }       
    return formataCampo(cnpj, '00.000.000/0000-00', event);
}

//adiciona mascara ao ddd
function MascaraDdd(ddd){  
        if(mascaraInteiro(ddd)==false){
			event.returnValue = false;
        }       
        return formataCampo(tel, '(00)', event);
}

//mascara do telefone
function MascaraTel(tel){  
        if(mascaraInteiro(ddd)==false){
            event.returnValue = false;
        }       
        return formataCampo(tel, '00000-0000', event);
}

//valida o CNPJ digitado ----- OKKKKK tudo
function ValidarCNPJ(ObjCnpj){
        var cnpj = ObjCnpj.value;
        var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
        var dig1= new Number;
        var dig2= new Number;

        exp = /\.|\-|\//g
        cnpj = cnpj.toString().replace( exp, "" ); 
        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));

        for(i = 0; i<valida.length; i++){
                dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
                dig2 += cnpj.charAt(i)*valida[i];       
        }
        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));

        if(((dig1*10)+dig2) != digito){
			document.getElementById('cnpj').value='';
            alert('CNPJ Invalido!');
		}

}