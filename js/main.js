let tema = "claro";
let abertoOffCanva = false;

function abrirOffCanvas() {
  if (!abertoOffCanva) {
    document
      .getElementsByClassName("offcanvas-body")[0]
      .classList.remove("offCanvas_fechado");
    document
      .getElementsByClassName("offcanvas-body")[0]
      .classList.add("offCanvas_aberto");
    abertoOffCanva = !abertoOffCanva;
  }
}

function fecharOffCanvas() {
  if (abertoOffCanva) {
    document
      .getElementsByClassName("offcanvas-body")[0]
      .classList.remove("offCanvas_aberto");
    document
      .getElementsByClassName("offcanvas-body")[0]
      .classList.add("offCanvas_fechado");
    abertoOffCanva = !abertoOffCanva;
  }
}

function trocarTema() {
  if (tema == "escuro") {
    document.documentElement.classList.remove("dark");
    tema = "claro";
    document
      .getElementsByClassName("trocartema")[0]
      .classList.remove("fa-moon");
    document
    .getElementsByClassName("trocartema")[0]
    .classList.add("fa-sun");
    
  } else {
    document.documentElement.classList.add("dark");
    tema = "escuro";
    document.getElementsByClassName("trocartema")[0].classList.remove("da-sun");
    document.getElementsByClassName("trocartema")[0].classList.add("fa-moon");
  }
}

const img = document.querySelector("img");
img.ondragstart = () => {
  return false;
};
