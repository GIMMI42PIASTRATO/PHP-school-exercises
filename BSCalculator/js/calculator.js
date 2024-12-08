const display = document.querySelector("#display");
const buttons = document.querySelectorAll(".key");
const numbersButtons = document.querySelectorAll(".number");
const operatorsButtons = document.querySelectorAll(".operator");

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

		display.textContent += e.target.value;
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
	});
});

document.getElementById("calculatorForm").addEventListener("submit", (e) => {
	if (display.textContent === "") {
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

		case "x^n":

		// TODO: handle 1/0
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
