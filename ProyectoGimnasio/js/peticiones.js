document.getElementById("campo").addEventListener("keyup",getNombresCliente)
document.getElementById("campo").addEventListener("keyup",getNombresIns)
document.getElementById("campo").addEventListener("keyup",getNombresActivosVariables)
document.getElementById("campo").addEventListener("keyup",getNombresClientePeso)
document.getElementById("campo").addEventListener("keyup",getNombresActivosFijos)
document.getElementById("campo").addEventListener("keyup",getNombresImpuestoVenta)
document.getElementById("campo").addEventListener("keyup",getNombresServicio)
document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncional)
document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncionalCriterio)
document.getElementById("campo").addEventListener("keyup",getNombresFacturas)


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

function getNombresCliente(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaClientes")

    if(inputCP.length > 0){

        let url= "../data/prediccionCliente.php"
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

function getNombresIns(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaInstructor")

    if(inputCP.length > 0){

        let url= "../data/prediccionInstructor.php"
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


function getNombresActivosVariables(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaActivosVariables")

    if(inputCP.length > 0){

        let url= "../data/prediccionActivosVariables.php"
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

function getNombresImpuestoVenta(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaImpuestoVenta")

    if(inputCP.length > 0){

        let url= "../data/prediccionImpuestoVenta.php"
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

    if(inputCP.length > 0){

        let url= "../data/prediccionServicio.php"
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


function getNombresModalidadFuncional(){
    let inputCP = document.getElementById("campo").value
    let lista = document.getElementById("listaModalidadFuncional")

    if(inputCP.length > 0){

        let url= "../data/prediccionModalidadFuncional.php"
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
    let lista = document.getElementById("listaModalidadfuncionalcriterio")

    if(inputCP.length > 0){

        let url= "../data/prediccionmodalidadfuncionalcriterio.php"
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


function mostrar(valor){
    document.getElementById("campo").value = valor;
}
