document.getElementById("campo").addEventListener("keyup",getNombresCliente)
document.getElementById("campo").addEventListener("keyup",getNombresClienteDesactivados)
document.getElementById("campo").addEventListener("keyup",getNombresClientePeso)
document.getElementById("campo").addEventListener("keyup",getNombresInstructor)
document.getElementById("campo").addEventListener("keyup",getNombresActivosFijos)
document.getElementById("campo").addEventListener("keyup",getNombresActivosVariables)
document.getElementById("campo").addEventListener("keyup",getNombresImpuestoVenta)
document.getElementById("campo").addEventListener("keyup",getNombresPagoPeridiocidad)
document.getElementById("campo").addEventListener("keyup",getNombresPagoMetodo)
document.getElementById("campo2").addEventListener("keyup",getNombresPagoMetodo)
document.getElementById("campo").addEventListener("keyup",getNombresServicio)
document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncional)
document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncionalCriterio)
document.getElementById("campo").addEventListener("keyup",getNombresFacturas)
document.getElementById("campo").addEventListener("keyup",getNombresEjercicios)
document.getElementById("campo").addEventListener("keyup", getNombresPeridiocidades)
document.getElementById("campo2").addEventListener("keyup", getNombresPeridiocidades)
document.getElementById("campo").addEventListener("keyup", getNombresGruposMusculares)
document.getElementById("campo2").addEventListener("keyup", getNombresGruposMusculares)
document.getElementById("campo").addEventListener("keyup", getNombresMedidasIsometricas)

function getNombresGruposMusculares() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listarGruposMusculares")
    let inputCP2 = document.getElementById("campo2").value
    let lista2 = document.getElementById("listarGruposMusculares2")

    if (inputCP2.length > 0) {

        let url = "../data/prediccionGruposMusculares.php"
        let formData = new FormData()

        formData.append("campo2", inputCP2)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista2.style.display = 'block'
                lista2.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista2.style.display = 'none'
    }

    if (inputCP.length > 0) {

        let url = "../data/prediccionGruposMusculares.php"
        let formData = new FormData()

        formData.append("campo", inputCP)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}


function getNombresPeridiocidades() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listarPagoPeridiocidad")
    let inputCP2 = document.getElementById("campo2").value
    let lista2 = document.getElementById("listarPagoPeridiocidad2")

    if (inputCP2.length > 0) {

        let url = "../data/prediccionPagoPeridiocidad.php"
        let formData = new FormData()

        formData.append("campo2", inputCP2)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista2.style.display = 'block'
                lista2.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista2.style.display = 'none'
    }

    if (inputCP.length > 0) {

        let url = "../data/prediccionPagoPeridiocidad.php"
        let formData = new FormData()

        formData.append("campo", inputCP)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresPagoMetodo() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listarPagoMetodos")
    let inputCP2 = document.getElementById("campo2").value
    let lista2 = document.getElementById("listarPagoMetodos2")

    if (inputCP2.length > 0) {

        let url = "../data/prediccionPagoMetodo.php"
        let formData = new FormData()

        formData.append("campo2", inputCP2)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista2.style.display = 'block'
                lista2.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista2.style.display = 'none'
    }

    if (inputCP.length > 0) {

        let url = "../data/prediccionPagoMetodo.php"
        let formData = new FormData()

        formData.append("campo", inputCP)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresFacturas() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaFacturas")

    if (inputCP.length > 0) {

        let url = "../data/prediccionFactura.php"
        let formData = new FormData()

        formData.append("campo", inputCP)
        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }

}

function getNombresCliente() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaClientes")

    if (inputCP.length > 0) {

        let url = "../data/prediccionCliente.php"
        let formData = new FormData()
        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresClienteDesactivados() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaClientesDesactivados")

    if (inputCP.length > 0) {

        let url = "../data/prediccionRecuperarCliente.php"
        let formData = new FormData()
        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresClientePeso(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaClientePeso")

    if(inputCP.length > 0){

        let url= "../data/prediccionClientePeso.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }
}

function getNombresInstructor(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaInstructor")

    if (inputCP.length > 0) {

        let url = "../data/prediccionInstructor.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresActivosFijos(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaActivosFijos")

    if(inputCP.length > 0){
        let url= "../data/prediccionActivosFijos.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }
}

function getNombresActivosVariables() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaActivosVariables")

    if (inputCP.length > 0) {

        let url = "../data/prediccionActivosVariables.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}


function getNombresClientePeso() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaClientePeso")

    if (inputCP.length > 0) {

        let url = "../data/prediccionClientePeso.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}


function getNombresActivosFijos() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaActivosFijos")

    if (inputCP.length > 0) {
        let url = "../data/prediccionActivosFijos.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresImpuestoVenta() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaImpuestoVenta")

    if (inputCP.length > 0) {

        let url = "../data/prediccionImpuestoVenta.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresPagoPeridiocidad(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaPagoPeridiocidad")

    if(inputCP.length > 0){

        let url= "../data/prediccionPagoPeridiocidad.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }
}

function getNombresServicio(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaServicio")

    if (inputCP.length > 0) {

        let url = "../data/prediccionServicio.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }
}

function getNombresModalidadFuncional() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaModalidadFuncional")

    if (inputCP.length > 0) {

        let url = "../data/prediccionModalidadFuncional.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    }else {
    lista.style.display = 'none'
    }

}

function getNombresModalidadFuncionalCriterio(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaModalidadFuncionalCriterio")

    if(inputCP.length > 0){

        let url= "../data/prediccionModalidadFuncionalCriterio.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }

}

function getNombresFacturas(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaFacturas")

    if(inputCP.length > 0){

        let url= "../data/prediccionFactura.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }

}


function getNombresEjercicios(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaEjercicios")

    if(inputCP.length > 0){

        let url= "../data/prediccionEjercicio.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }
}




function getNombresModalidadFuncionalCriterio() {
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaModalidadFuncionalCriterio")

    if (inputCP.length > 0) {

        let url = "../data/prediccionModalidadFuncionalCriterio.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
            .then(data => {
                lista.style.display = 'block'
                lista.innerHTML = data
            })
            .catch(err => console.log(err))

    } else {
        lista.style.display = 'none'
    }

}


function getNombresMedidasIsometricas(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaMedida")

    if(inputCP.length > 0){

        let url= "../data/prediccionMedidaIsometrica.php"
        let formData = new FormData()

        formData.append("campo", inputCP)

        fetch(url, {
            method: "POST",
            body: formData,
            mode: "cors"
        }).then(Response => Response.json())
        .then(data => {
            lista.style.display = 'block'
            lista.innerHTML = data
        })
        .catch(err => console.log(err))

    }else {
        lista.style.display = 'none'
    }
}


function mostrar(valor) {
    document.getElementById("campo").value = valor;
}

function mostrarCampo2(valor) {
    document.getElementById("campo2").value = valor;
}
