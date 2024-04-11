document.getElementById("logoutLink").addEventListener("click", function(event) {
    event.preventDefault(); // Impede o comportamento padrão do link

    // faz uma solicitação para o arquivo PHP que executa o logout
    fetch("logout.php")
        .then(response => {
            if (!response.ok) {
                throw new Error("Erro ao fazer logout");
            }
            // Redirecionar para a pagina de login 
            window.location.href = "login.php";
        })
        .catch(error => {
            console.error("Erro:", error);
        });
});
