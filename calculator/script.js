const keys = document.querySelectorAll(".key");
const outputDisplay = document.querySelector(".writableDisplay");
console.log(outputDisplay);

outputDisplay.textContent = "0";

if (!outputDisplay) {
	throw new Error("No display found");
}

keys.forEach((key) => {
	const keyContent = key.textContent;

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
});
