document.querySelectorAll(".tableRow").forEach((row) => {
	const hoverBackground = row.querySelector(".hoverBackground");
	const projectPath = row.getAttribute("data-path");

	row.addEventListener("click", () => {
		window.open(projectPath, "_blank");
	});

	row.addEventListener("mouseenter", () => {
		hoverBackground.style.top = "0";
	});

	row.addEventListener("mouseleave", (event) => {
		const rowRect = row.getBoundingClientRect();

		// Get the mouse position relative to the row
		const mouseY = event.clientY - rowRect.top;

		// If the mouse cursor is above the half of the row, move the hover background to -100%
		// Otherwise, move it to 100%
		if (mouseY < rowRect.height / 2) {
			hoverBackground.style.top = "-100%";
		} else {
			hoverBackground.style.top = "100%";
		}
	});
});
