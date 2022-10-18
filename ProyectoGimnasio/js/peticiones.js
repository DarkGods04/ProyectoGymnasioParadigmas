document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncional)
document.getElementById("campo").addEventListener("keyup",getNombresModalidadFuncionalCriterio)

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
