function updateDays() {
    // Dias da semana
    const daysOfWeek = ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'];

    // Obtém a data atual
    const currentDate = new Date();

    // Limpa o contêiner antes de adicionar os dias
    document.getElementById('daysContainer').innerHTML = '';

    // Cria o elemento para o dia atual
    const currentDayElement = document.createElement('div');
    currentDayElement.classList.add('day', 'current-day');
    currentDayElement.innerHTML = `<h3>${daysOfWeek[currentDate.getDay()]}</h3><p>${currentDate.getDate()} de ${currentDate.toLocaleString('pt-BR', { month: 'long' })}</p>`;
    document.getElementById('daysContainer').appendChild(currentDayElement);

    // Cria o elemento para cada dia restante da semana
    for (let i = 1; i < 7; i++) {
      const dayElement = document.createElement('div');
      dayElement.classList.add('day');
      
      // Calcula a data para o dia atual mais o índice
      const date = new Date(currentDate);
      date.setDate(currentDate.getDate() + i);
      
      // Formata a data como "dia de Mês"
      const options = { day: 'numeric', month: 'long' };
      const formattedDate = date.toLocaleDateString('pt-BR', options);
      
      // Adiciona o nome do dia e a data formatada
      dayElement.innerHTML = `<h3>${daysOfWeek[date.getDay()]}</h3><p>${formattedDate}</p>`;
      
      // Adiciona o dia ao contêiner
      document.getElementById('daysContainer').appendChild(dayElement);
    }
  }

  // Chama a função updateDays() para exibir os dias
  updateDays();

  // Atualiza os dias a cada segundo
  setInterval(updateDays, 1000);