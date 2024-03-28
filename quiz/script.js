
const parametrosDaURL = new URLSearchParams(window.location.search);
$.getJSON("/data/quizzes.json", function (listQuizzes) { // Função da biblioteca jQuery que carrega o JSON e carrega na variável "quizData"
  let currentQuestion = 0; // Variável que armazena o índice da pergunta atual
  let score = 0; // Variável que armazena a pontuação do usuário
  let quizData = listQuizzes[parametrosDaURL.get("quiz")]; // As perguntas em si
  if(parametrosDaURL.size == 0) {
    quizData = listQuizzes[0];
  } else if(typeof quizData == "undefined") {
    document.write("Este quiz não existe!");
    return console.error("Este quiz não existe!");
  }
  const quizContainer = document.getElementById('quiz-container'); // Elemento HTML que contém o quiz
  const nextBtn = document.getElementById('next-btn'); // Botão "Próxima pergunta"
  const scoreDisplay = document.getElementById('score'); // Elemento HTML que exibe a pontuação
  let imagemElement = null;

  function loadQuestion() {
    const question = quizData[currentQuestion]; // Obtém os dados da pergunta atual do arquivo JSON
    document.getElementById("pergunta").innerText =  currentQuestion+1 + ") " + question.pergunta;
    if(question.imagem) {
      imagemElement = document.createElement("img");
      imagemElement.className = "w-[200px] table m-auto my-4"
      imagemElement.src = `/img/quizzes/quiz1/${question.imagem}`;
      document.getElementById("pergunta").insertAdjacentElement("afterend", imagemElement);
    }
    question.alternativas.forEach((alternativa, index) => {
      document.getElementById(`opcao-${index+1}`).nextElementSibling.innerHTML = alternativa.opcao;
      document.getElementById(`opcao-${index+1}`).value = index;
    });
  }

  function nextQuestion() {
    const selectedOption = document.querySelector('input[name="opcao"]:checked'); // Obtém a opção selecionada pelo usuário
    if (selectedOption) {
      if(imagemElement !== null) imagemElement.remove()
      const selectedOptionIndex = parseInt(selectedOption.value); // Obtém o índice da opção selecionada
      const currentQuestionData = quizData[currentQuestion]; // Obtém os dados da pergunta atual do arquivo JSON
      if (currentQuestionData.alternativas[selectedOptionIndex].correta) {
        score++; // Incrementa a pontuação se a opção selecionada for correta
      }
      currentQuestion++; // Passa para a próxima pergunta
      selectedOption.checked = false; // Desmarca a opção selecionada
    }
    if (currentQuestion < quizData.length) {
      loadQuestion(); // Carrega a próxima pergunta
    } else {
      showScore(); // Exibe a pontuação final quando todas as perguntas foram respondidas
    }
  }

  function showScore() {
    document.getElementById("pergunta").remove()
    const respostasCertas = score;
    const respostasErradas = quizData.length - respostasCertas;
    const form = document.createElement("form");
    form.action = "sucesso.php";
    form.method = "post";
    //
    const acertosInput = document.createElement("input");
    acertosInput.name = "acertos";
    acertosInput.value = respostasCertas;
    acertosInput.type = "number";
    //
    const errosInput = document.createElement("input");
    errosInput.name = "erros";
    errosInput.value = respostasErradas;
    errosInput.type = "number";
    //
    const quizId = document.createElement("input");
    quizId.name = "quizid";
    quizId.value = parametrosDaURL.get("quiz") ?? 0;
    quizId.type = "number";
    //
    const buttonSumit = document.createElement("button")
    buttonSumit.type = "submit";
    document.body.insertAdjacentElement("beforeend", form);
    form.appendChild(acertosInput);
    form.appendChild(errosInput)
    form.appendChild(buttonSumit);
    form.appendChild(quizId);
    buttonSumit.click();
  }

  loadQuestion(); // Carrega a primeira pergunta do quiz
  document.getElementById("next-btn").addEventListener("click", nextQuestion)
})


