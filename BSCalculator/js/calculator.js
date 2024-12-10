const display = document.querySelector("#display");
const buttons = document.querySelectorAll(".key");
const numbersButtons = document.querySelectorAll(".number");
const operatorsButtons = document.querySelectorAll(".operator");

console.log(window.location.pathname);

let currentEditable = null; // Variabile per tracciare l'elemento attualmente modificabile

if (!display) {
	throw new Error("No display found");
}

buttons.forEach((button) => {
	button.addEventListener("click", (e) => {
		if (display.textContent === "Espressione non valida") {
			display.textContent = "";
		}
	});
});

numbersButtons.forEach((button) => {
	button.addEventListener("click", (e) => {
		// Se l'ultimo carattere
		if (e.target.value in { ".": 1 }) {
			if (
				display.textContent[display.textContent.length - 1] in
				{ ".": 1 }
			) {
				display.textContent = display.textContent.slice(0, -1);
			}

			display.textContent += e.target.value;
			return;
		}

		if (e.target.value === "0") {
			if (
				(display.textContent[display.textContent.length - 1] === "0" &&
					display.textContent.length === 1) ||
				(display.textContent[display.textContent.length - 1] === "0" &&
					display.textContent[display.textContent.length - 2] in
						{ "+": 1, "-": 1, "*": 1, "/": 1 })
			) {
				return;
			}
		}

		if (e.target.value === "PI") {
			display.textContent += Math.PI;
			return;
		}

		console.log(currentEditable);

		if (currentEditable) {
			currentEditable.textContent += e.target.value;
		} else {
			display.textContent += e.target.value;
		}
	});
});

operatorsButtons.forEach((button) => {
	button.addEventListener("click", () => {
		console.log(button.value);

		if (button.value === "⌫") {
			if (display.textContent === "") {
				return;
			}
			display.textContent = display.textContent.slice(0, -1);
		}

		if (button.value === "C") {
			display.textContent = "";
		}

		// Se l'ultimo carattere è un operatore, non aggiungere un altro operatore
		if (button.value in { "+": 1, "-": 1, "*": 1, "/": 1 }) {
			if (
				display.textContent[display.textContent.length - 1] in
				{ "+": 1, "-": 1, "*": 1, "/": 1 }
			) {
				display.textContent = display.textContent.slice(0, -1);
			}

			display.textContent += button.value;
		}

		if (button.value === "x^n") {
			if (display.textContent[display.textContent.length - 1] === "^") {
				display.textContent = display.textContent.slice(0, -1);
			}
			display.textContent += "^";
		}

		if (button.value === "(") {
			display.textContent += "(";
		}

		if (button.value === ")") {
			display.textContent += ")";
		}

		if (button.value === "e") {
			display.textContent += Math.E;
		}

		if (button.value === "n√") {
			const dialog = document.querySelector(".nthSqrtDialog");
			dialog.showModal();

			const radicand = display.textContent;
			const nthSqrtInput = document.querySelector("#nthSqrtInput");
			const nthSqrtButton = document.querySelector("#exponentButton");
			const nthSqrtLabel = document.querySelector("#nthSqrtLabel");
			const nthSqrtError = document.querySelector("#nthSqrtError");

			console.log(window.location.pathname);

			nthSqrtButton.addEventListener("click", async () => {
				if (nthSqrtInput.value === "") {
					nthSqrtLabel.style.color = "red";
					nthSqrtInput.style.borderColor = "red";
					nthSqrtError.textContent = "Inserisci un valore";
					nthSqrtError.style.color = "red";
					return;
				}

				if (nthSqrtInput.value < 2) {
					nthSqrtLabel.style.color = "red";
					nthSqrtInput.style.borderColor = "red";
					nthSqrtError.textContent =
						"Inserisci un valore maggiore di 1";
					nthSqrtError.style.color = "red";
					return;
				}

				console.log(radicand, nthSqrtInput.value);

				const response = await fetch(
					`${window.location.pathname}/api/nthRoot.php`,
					{
						method: "POST",
						headers: {
							"Content-Type": "application/x-www-form-urlencoded",
						},
						body: new URLSearchParams({
							radicand,
							nthRoot: nthSqrtInput.value,
						}),
					}
				);

				const data = await response.json();
				display.textContent = data.error ? data.error : data.result;

				nthSqrtInput.value = "";
				dialog.close();
			});

			nthSqrtButton.removeEventListener("click", onNthSqrtButtonClick);
			nthSqrtButton.addEventListener("click", onNthSqrtButtonClick, {
				once: true,
			});
		}
	});
});

document.addEventListener("click", (e) => {
	if (!display.contains(e.target)) {
		currentEditable = null;
	}
});

document
	.getElementById("calculatorForm")
	// Non cambiare la callback in un arrow function perché altrimenti non è disponibile il this, quindi non venogno aggiunti gli input (lo scrivo perché è la terza volta che mi scordo)
	.addEventListener("submit", function (e) {
		if (
			display.textContent === "" &&
			e.submitter.value !== "MEM" &&
			e.submitter.value !== "STO" &&
			e.submitter.value !== "M+"
		) {
			e.preventDefault();
			return;
		}

		if (
			display.textContent[display.textContent.length - 1] in
				{ "+": 1, "-": 1, "*": 1, "/": 1 } &&
			e.submitter.value !== "MEM"
		) {
			display.textContent = "Espressione non valida";
			e.preventDefault();
			return;
		}

		const hiddenExpressionInput = document.createElement("input");
		hiddenExpressionInput.type = "hidden";
		hiddenExpressionInput.name = "currentValue";

		const hiddenOperatorInput = document.createElement("input");
		hiddenOperatorInput.type = "hidden";
		hiddenOperatorInput.name = "operator";

		console.log(`🎛️ Display content: ${display.textContent}`);

		switch (e.submitter.value) {
			case "√":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "sqrt";
				break;

			case "x^2":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "square";
				break;

			case "1/n":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "inverse";
				break;

			case "sin":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "sin";
				break;

			case "cos":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "cos";
				break;

			case "tan":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "tan";
				break;

			case "=":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "equal";
				break;

			case "n!":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "factorial";
				break;

			case "ABS":
				hiddenExpressionInput.value = display.textContent;
				hiddenOperatorInput.value = "abs";
				break;

			default:
				hiddenExpressionInput.value = display.textContent;
		}

		this.appendChild(hiddenExpressionInput);
		this.appendChild(hiddenOperatorInput);
	});
