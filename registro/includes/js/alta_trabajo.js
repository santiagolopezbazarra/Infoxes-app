// Obtener los elementos del DOM
const modal = document.getElementById("modal");
const observacionesButton = document.getElementById("botonObservaciones");
const closeModalButton = document.getElementById("cerrarModal");
const saveModal = document.querySelector(".saveModal");

// Cuando el usuario haga clic en el botón de Observaciones, abrir el modal
observacionesButton.addEventListener("click", () => {
    modal.style.display = "flex"; // Mostrar el modal
});

// Cuando el usuario haga clic en el botón de cerrar (x), cerrar el modal
closeModalButton.addEventListener("click", () => {
    modal.style.display = "none"; // Ocultar el modal
});

saveModal.addEventListener("click", () => {
    modal.style.display = "none"; // Ocultar el modal
});

// Cuando el usuario haga clic fuera del contenido del modal, cerrar el modal
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none"; // Ocultar el modal
    }
});

const modalResultado = document.getElementById("modalResultado");
const closeResultadoButton = document.getElementById("closeResultado");
const mensajeResultado = document.getElementById("mensajeResultado");
const descripcionResultado = document.getElementById("descripcionResultado");

closeResultadoButton.addEventListener("click", () => {
    modalResultado.style.display = "none"; // Ocultar el modal
});

window.addEventListener("click", (event) => {
    if (event.target === modalResultado) {
        modalResultado.style.display = "none"; // Ocultar el modal
    }
});

document.addEventListener("DOMContentLoaded", function() {
    const params = new URLSearchParams(window.location.search);
    const status = params.get('status');

    if (status === 'success') {
        console.log("pasa por aqui");
        mensajeResultado.textContent = "REGISTRO COMPLETADO";
        descripcionResultado.textContent = "El registro se ha realizado con éxito"
        modalResultado.style.display = "flex";
    } else if (status === 'error') {
        mensajeResultado.textContent = "ERROR AL REGISTRAR";
        descripcionResultado.textContent = "";
        modalResultado.style.display = "flex";
    } else if (status === 'errorFichajeDentroOtro') {
        mensajeResultado.textContent = "ERROR AL REGISTRAR";
        descripcionResultado.textContent = "Las horas seleccionadas ya están registradas"
        modalResultado.style.display = "flex";
    } else if (status === 'errorFichajeSolapado') {
        mensajeResultado.textContent = "ERROR AL REGISTRAR";
        descripcionResultado.textContent = "La hora de entrada de entrada o de salida ya pertenece a un registro"
        modalResultado.style.display = "flex";
    }
});

function cargarDia(){
    let elementoFecha = document.getElementById("elementoFecha");
    
    const fechaActual = new Date();

    const dia = String(fechaActual.getDate()).padStart(2, '0'); // Obtener el día y añadir 0 si es menor a 10
    const mes = String(fechaActual.getMonth() + 1).padStart(2, '0');
    const anio = fechaActual.getFullYear();

    const fechaFormateada = `${dia}/${mes}/${anio}`;

    elementoFecha.textContent = fechaFormateada;
}