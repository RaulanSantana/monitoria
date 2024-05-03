document.addEventListener("DOMContentLoaded", function() {
    var selectCurso = document.getElementById("curso");
    var selectFase = document.getElementById("fase");
    var selectDisciplina = document.getElementById("disciplina");

    // Função para buscar fases com base no curso selecionado
    function buscarFases(cursoId) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "buscar_fases.php?id_curso=" + cursoId, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                selectFase.innerHTML = xhr.responseText;  // Atualiza as opções do select
            }
        };
        xhr.send();  // Envia a requisição
    }

    // Função para buscar disciplinas com base no curso e na fase selecionados
    function buscarDisciplinas(cursoId, fase) {
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "buscar_disciplina.php?id_curso=" + cursoId + "&fase=" + fase, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                selectDisciplina.innerHTML = xhr.responseText;  // Atualiza as opções do select
            }
        };
        xhr.send();  // Envia a requisição
    }

    // Evento para quando um curso é selecionado
    selectCurso.addEventListener("change", function() {
        var cursoId = this.value;  // Obter o ID do curso selecionado
        if (cursoId) {
            buscarFases(cursoId);  // Buscar fases para este curso
            selectDisciplina.innerHTML = "<option value=''>Selecione uma fase primeiro</option>";  // Limpa o select de disciplinas
        }
    });

    // Evento para quando uma fase é selecionada
    selectFase.addEventListener("change", function() {
        var cursoId = selectCurso.value;  // Obter o ID do curso selecionado
        var fase = this.value;  // Obter a fase selecionada
        if (cursoId && fase) {
            buscarDisciplinas(cursoId, fase);  // Buscar disciplinas para este curso e fase
        }
    });
});
