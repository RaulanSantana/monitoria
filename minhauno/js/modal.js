// Função para abrir o modal
function abrirModal() {
    document.getElementById('modal').style.display = 'flex';
}

// Função para fechar o modal
function fecharModal() {
    document.getElementById('modal').style.display = 'none';
}

// Fechar o modal quando clicar no botão fechar (X)
//document.querySelector('.close').addEventListener('click', fecharModal);

// Fechar o modal quando clicar fora da área do modal
//window.addEventListener('click', function(event) {
   // var modal = document.getElementById('modal');
   // if (event.target == modal) {
  //      fecharModal();
  //  }
//});

function fecharSeClicarFora(event) {
    var modalContent = document.getElementById('modal-content');
    if (!modalContent.contains(event.target)) { // Se o clique não estiver no conteúdo principal
        fecharModal();
    }
}