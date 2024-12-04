function addToDisplay(value) {
	const display = document.getElementById("display");
	display.value += value;
}

function clearDisplay() {
	const display = document.getElementById("display");
	display.value = "";
}

function backspace() {
	const display = document.getElementById("display");
	display.value = display.value.slice(0, -1);
}

document
	.getElementById("calculatorForm")
	.addEventListener("submit", function (e) {
		const display = document.getElementById("display");
		const hiddenInput = document.createElement("input");
		hiddenInput.type = "hidden";
		hiddenInput.name = "currentValue";
		hiddenInput.value = display.value;
		this.appendChild(hiddenInput);
	});
