const keys = document.querySelectorAll(".key");
const outputDisplay = document.querySelector(".writableDisplay");
const expressionDisplay = document.querySelector(".expressionDisplay");

console.log(outputDisplay);

outputDisplay.textContent = "0";

if (!outputDisplay) {
	throw new Error("No display found");
}

if (!expressionDisplay) {
	throw new Error("No expression display found");
}

const submitNumber = (number) => {};

keys.forEach((key) => {
	const keyContent = key.textContent;

	// display the value of the key clicked

	if (keyContent === ".") {
		key.addEventListener("click", () => {
			if (!outputDisplay.textContent.includes(".")) {
				outputDisplay.textContent += ".";
			}
		});
	}

	if (key.classList.contains("number")) {
		key.addEventListener("click", () => {
			console.log(keyContent);

			if (keyContent === ".") {
				return;
			}

			if (outputDisplay.textContent === "0") {
				if (keyContent !== "0") {
					outputDisplay.textContent = keyContent;
				}
			} else {
				outputDisplay.textContent += keyContent;
			}
		});
	}

	if (keyContent === "C") {
		key.addEventListener("click", () => {
			outputDisplay.textContent = "0";
		});
	}

	if (keyContent === "delete") {
		key.addEventListener("click", () => {
			outputDisplay.textContent = outputDisplay.textContent.slice(0, -1);
		});
	}

	// calculate the value of the expression
	if (keyContent in { "+": 1, "-": 1, "*": 1, "/": 1 }) {
		key.addEventListener("click", () => {
			expressionDisplay.textContent +=
				outputDisplay.textContent + keyContent;
		});
	}
});
