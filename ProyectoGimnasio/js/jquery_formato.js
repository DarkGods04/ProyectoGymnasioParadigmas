
    $(document).ready(function(){
        $(".mascaratelefono").mask("0000-0000");
        $(".mascarapeso").mask("00.0kg");
        $(".mascaraaltura").mask("0.00cm");
        $(".mascaramonto").mask("₡0000000000000000");
        $(".mascaraimpuesto").mask("00.00%");
        $(".mascaranumcuenta").mask("AA00000000000000000000");
        $(".mascaracantidad").mask("9999");
        /*
        $(".mascaranombre").mask("AAAAAAAAAAAAAAAAAA");
        $(".mascaracorreo").mask("@gmail.com @hotmail.com @est.una.ac.cr");
        $("").mask("");
        */
    });
        
    function validarCorreo(correo){
        var cadena = /\w+@(gmail|est|una|hotmail|yahoo|outlook)+\.(com|es|org|cr|una.ac.cr|cr)+$/.test(campo.value);
        var esValido = cadena.test(correo);
        if(esValido == false){
            alert('El correo ingresado es invalido');
        }
    }

    function validarLetras(nombre){
        var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
        var esValido = cadena.test(nombre);
        if(esValido == false){
            alert('El correo ingresado es invalido');
        }
    }

    function validarLetras(apellido1){
        var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
        var esValido = cadena.test(apellido1);
        if(esValido == false){
            alert('El correo ingresado es invalido');
        }
    }

    function validarLetras(apellido2){
        var cadena = /^[a-zA-ZÀ-ÿ\s]{1,40}$/;
        var esValido = cadena.test(apellido2);
        if(esValido == false){
            alert('El correo ingresado es invalido');
        }
    }