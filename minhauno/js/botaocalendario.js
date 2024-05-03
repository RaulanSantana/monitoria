const daysOfWeek = {
    'Domingo': 7,
    'Segunda-feira': 1,
    'Terça-feira': 2,
    'Quarta-feira': 3,
    'Quinta-feira': 4,
    'Sexta-feira': 5,
    'Sábado': 6
};

function exibirBotaoAcesso(diaMonitoria, elementoId) {
    const currentDay = new Date().getDay(); // Retorna de 0 a 6
    
    // Compara o dia da monitoria com o dia atual
    if (currentDay === daysOfWeek[diaMonitoria]) {
        document.getElementById(elementoId).innerHTML = '<input type="button" value="ACESSAR AULA" onclick="abrirModal()">';
    }
}
