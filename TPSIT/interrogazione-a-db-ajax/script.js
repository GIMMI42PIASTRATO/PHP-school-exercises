const pre = document.querySelector("pre");
const comuneInput = document.querySelector("#comune");

comuneInput.addEventListener("input", async (event) => {
	try {
		const response = await fetch(
			`http://localhost:8080/vittoriobussano/TPSIT/interrogazione-a-db-ajax/server/index.php?comune=${event.target.value}`,
			{}
		);
		const data = await response.json();

		console.log(data);
		pre.textContent = JSON.stringify(data, null, 2);
	} catch (error) {
		console.error("Something went wrong:", error);
	}
});

// function test(func) {
// 	// faccio mille operazioni

// 	return func();
// }

// 1. metodo
// fetch("https://google.com")
// 	.then((response) => response.json())
// 	.then((data) => console.log(data))
// 	.catch((err) => console.log("Errore:", err));
