const display = document.querySelector("#display");
const buttons = document.querySelectorAll(".key");
const numbersButtons = document.querySelectorAll(".number");
const operatorsButtons = document.querySelectorAll(".operator");

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
		debugger;
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
			display.textContent += "^";
		}

		if (button.value === "(") {
			display.textContent += "(";
		}

		if (button.value === ")") {
			display.textContent += ")";
		}

		if (button.value === "n√") {
			// creare un wrapper per la radice quadrata
			const sqrtWrapper = document.createElement("span");
			sqrtWrapper.classList.add("sqrt-wrapper");

			// creare un elemento span per l'esponente
			const exponent = document.createElement("span");
			exponent.classList.add("exponent");
			exponent.contentEditable = true;
			exponent.textContent = "";

			// imposta l'elmento attualmente modificabile
			currentEditable = exponent;

			// creare un elemento che contiene il radicando
			const radicand = document.createElement("span");
			radicand.classList.add("radicand");
			radicand.textContent = display.textContent;

			// aggiungere l'esponente e il radicando al wrapper
			sqrtWrapper.appendChild(exponent);
			sqrtWrapper.appendChild(document.createTextNode("√"));
			sqrtWrapper.appendChild(radicand);

			// sostituisci il contenuto del display con il wrapper
			try {
				while (display.firstChild) {
					display.removeChild(display.firstChild);
				}
				display.appendChild(sqrtWrapper);

				exponent.focus(); // porta il focus sull'esponente
			} catch (error) {
				console.error(
					"Errore durante la manipolazione del DOM:",
					error
				);
			}
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
			{ "+": 1, "-": 1, "*": 1, "/": 1 }
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

			default:
				hiddenExpressionInput.value = display.textContent;
		}

		this.appendChild(hiddenExpressionInput);
		this.appendChild(hiddenOperatorInput);
	});
