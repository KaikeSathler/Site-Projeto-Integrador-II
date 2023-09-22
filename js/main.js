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
    document.getElementsByClassName("trocartema")[0].classList.add("fa-sun");
    document.getElementById("iconv").src = "../img/icon/icob.png";
    document.querySelector("link[rel~='icon']").href = "../img/icon/icob.png";
  } else {
    document.documentElement.classList.add("dark");
    tema = "escuro";
    document.getElementsByClassName("trocartema")[0].classList.remove("da-sun");
    document.getElementsByClassName("trocartema")[0].classList.add("fa-moon");
    document.getElementById("iconv").src = "../img/icon/icov.png";
    document.querySelector("link[rel~='icon']").href = "../img/icon/icov.png";
  }
}

if (
  window.matchMedia &&
  window.matchMedia("(prefers-color-scheme: dark)").matches
) {
  document.documentElement.classList.add("dark");
  tema = "escuro";
  document.getElementsByClassName("trocartema")[0].classList.remove("da-sun");
  document.getElementsByClassName("trocartema")[0].classList.add("fa-moon");
  document.getElementById("iconv").src = "../img/icon/icov.png";
  document.querySelector("link[rel~='icon']").rel = "../img/icon/icov.png";
} else {
  document.documentElement.classList.remove("dark");
  tema = "claro";
  document.getElementsByClassName("trocartema")[0].classList.remove("fa-moon");
  document.getElementsByClassName("trocartema")[0].classList.add("fa-sun");
  document.getElementById("iconv").src = "../img/icon/icob.png";
}

const img = document.querySelector("img");
img.ondragstart = () => {
  return false;
};

function checkVisible(elm) {
  var rect = elm.getBoundingClientRect();
  var viewHeight = Math.max(
    document.documentElement.clientHeight,
    window.innerHeight
  );
  return !(rect.bottom < 0 || rect.top - viewHeight >= 0);
}

let elemento = document.getElementsByClassName("titulo")[0];

function aparecerTitulo() {
  if (checkVisible(elemento)) {
    elemento.classList.add("animacao-aparecer");
  } else {
    if (elemento.classList.contains("animacao-aparecer"))
      elemento.classList.remove("animacao-aparecer");
  }
}

window.onload = () => {
  aparecerTitulo();
};
