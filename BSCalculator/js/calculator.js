const display = document.querySelector("#display");

if (!display) {
	throw new Error("No display found");
}

document.querySelectorAll(".number").forEach((button) => {
	button.addEventListener("click", (e) => {
		display.textContent += e.target.value;
	});
});

document.querySelectorAll(".operator").forEach((button) => {
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
			display.textContent += button.value;
		}
	});
});

document
	.getElementById("calculatorForm")
	.addEventListener("submit", function (e) {
		const hiddenInput = document.createElement("input");
		hiddenInput.type = "hidden";
		hiddenInput.name = "currentValue";

		console.log(`🎛️ Display content: ${display.textContent}`);

		hiddenInput.value = display.textContent;
		this.appendChild(hiddenInput);
	});
