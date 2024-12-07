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

document
	.getElementById("calculatorForm")
	.addEventListener("submit", function (e) {
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

		const hiddenInput = document.createElement("input");
		hiddenInput.type = "hidden";
		hiddenInput.name = "currentValue";

		console.log(`🎛️ Display content: ${display.textContent}`);

		switch (e.submitter.value) {
			case "√":
				hiddenInput.value = `sqrt(${display.textContent})`;
				break;

			case "x^2":
				hiddenInput.value = `(${display.textContent})**2`;
				break;

			// TODO: handle 1/0
			case "1/n":
				hiddenInput.value = `1/(${display.textContent})`;
				break;

			case "sin":
				hiddenInput.value = `sin(${display.textContent})`;
				break;

			case "cos":
				hiddenInput.value = `cos(${display.textContent})`;
				break;

			case "tan":
				hiddenInput.value = `tan(${display.textContent})`;
				break;

			default:
				hiddenInput.value = display.textContent;
		}

		this.appendChild(hiddenInput);
	});
