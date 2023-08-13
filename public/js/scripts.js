document.addEventListener("DOMContentLoaded", function () {
	// Limpar os resultados recarregando a view
	var limparResultadosButton = document.getElementById("limpar-resultados");
	if (limparResultadosButton) {
		limparResultadosButton.addEventListener("click", function () {
			location.replace(location.href);
		});
	}
});