// var modal = document.getElementById("modal");
// var btn = document.getElementById("open-modal");
// var span = document.getElementsByClassName("close")[0];

// btn.onclick = function () {
//     modal.style.display = "block";
// };

// span.onclick = function () {
//     modal.style.display = "none";
// };

// window.onclick = function (event) {
//     if (event.target == modal) {
//         modal.style.display = "none";
//     }
// };
// limitador de texto inputs
const nombreInput = document.getElementById("#");
nombreInput.addEventListener("input", capitalizarInput);

function capitalizarInput() {
    this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, "");
    this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1);
}

// limitador de texto numeros
const precioInput = document.getElementById("#");
const cantidadInput = document.getElementById("#");
precioInput.addEventListener("input", limitarCaracteres);
cantidadInput.addEventListener("input", limitarCaracteres);

function limitarCaracteres() {
    this.value = this.value.replace(/[^0-9]/g, "");
}
