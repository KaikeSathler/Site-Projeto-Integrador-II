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
if (document.querySelectorAll(".frase")[0]) {
  let elemento = document.getElementsByClassName("titulo")[0];

  var tamanhoFraseAtual = 0;
  var timerEscreverFrase;
  var tamanhoFinal = document.querySelectorAll(".frase")[0].textContent.length;
  var texto = document.querySelectorAll(".frase")[0].textContent;

  async function escreverFrase() {
    if (tamanhoFraseAtual > tamanhoFinal) {
      clearInterval(timerEscreverFrase);
      return;
    }

    if (tamanhoFraseAtual == 0) {
      document.querySelectorAll(".frase")[0].textContent = "";
    } else {
      document.querySelectorAll(".frase")[0].textContent += texto.charAt(
        tamanhoFraseAtual - 1
      );
    }
    tamanhoFraseAtual++;
  }

  timerEscreverFrase = setInterval(escreverFrase, 50);
}

window.onscroll = () => {
  if (window.scrollY >= 1880) {
    document.getElementById("button-scroll").classList.add("visivel");
  } else {
    if (document.getElementById("button-scroll").classList.contains("visivel"))
      document.getElementById("button-scroll").classList.remove("visivel");
  }
};
