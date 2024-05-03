// Função para exibir ou ocultar a prévia da foto do perfil
function togglePreviewFotoPerfil(event) {
    var input = event.target;
    var previewContainer = document.getElementById('preview-container');
    
    // Verifica se foi selecionada uma imagem para exibir a prévia
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function() {
            var previewImg = document.getElementById('preview-img');
            previewImg.src = reader.result;

            // Exibe o contêiner da prévia
            previewContainer.style.display = 'block';
        };

        reader.readAsDataURL(input.files[0]);
    } else {
        // Oculta o contêiner da prévia se não houver imagem selecionada
        previewContainer.style.display = 'none';
    }
}

// Adicionar um event listener para o input de arquivo
var inputFoto = document.getElementById('input-foto');
inputFoto.addEventListener('change', togglePreviewFotoPerfil);
