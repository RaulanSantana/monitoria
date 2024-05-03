// Obtenha o modal
var modal = document.getElementById("modalaula-popup");

// Obtenha todos os botões que podem abrir o modal
var btns = document.querySelectorAll(".botaoAcessar");

// Obtenha o elemento span que fecha o modal
var span = document.querySelector(".closeaula");

// Quando o usuário clicar no botão, abra o modal
btns.forEach(btn => {
  btn.onclick = function() {
    modal.style.display = "block";
  };
});

// Quando o usuário clicar no span (x), feche o modal
span.onclick = function() {
  modal.style.display = "none";
};

/* Quando o usuário clicar em qualquer lugar fora do modal, feche-o
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};*/

window.onload = function() {
  // Adicionar o manipulador de eventos para evitar a atualização padrão do formulário
  document.getElementById("formAtividade").addEventListener("submit", function(event) {
      event.preventDefault(); // Evita a atualização da página

      // Coleta o valor do textarea
      var atividade = document.getElementById("atividadearea").value;

      // Cria uma nova instância do XMLHttpRequest para fazer a chamada AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "iniciomonitor.php", true); // Define o método POST e a URL para envio
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Define o cabeçalho para envio de formulários

      // Define a função que será executada quando o estado da solicitação mudar
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4) { // A solicitação está completa
              if (xhr.status === 200) { // A solicitação foi bem-sucedida
                  // Sucesso: Pode adicionar ações ou mensagens de sucesso aqui
                  console.log("Atividade salva com sucesso"); // Exemplo de mensagem
              } else {
                  // Erro: Trate erros ou forneça feedback ao usuário
                  console.error("Erro ao salvar atividade"); // Exemplo de mensagem de erro
              }
          }
      };

      // Envia os dados do formulário para o servidor
      xhr.send("salvaratividade=true&atividadearea=" + encodeURIComponent(atividade));
  })
}




