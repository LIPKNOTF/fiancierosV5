function init(){
    var ruta = document.querySelector("[name=route]").value;

    var apiConcentrado = ruta + "/apiConcentrado";
    new Vue({
        http:{
            headers:{
                "X-CSRF-TOKEN": document
                    .querySelector("#token")
                    .getAttribute("value"),
            },
        },

        el:"#concentrado",
        data:{
            concentrados:[],
            mensaje:'Aqui es el concentrado',
        },
    });
    // fin de vue
}
window.onload = init;    