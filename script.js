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
		console.log("event.clientY:", event.clientY);
		console.log("rowRect.top:", rowRect.top);
		const mouseY = event.clientY - rowRect.top;
		console.log("🖱️:", mouseY);

		// If the mouse cursor is above the half of the row, move the hover background to -100%
		// Otherwise, move it to 100%
		if (mouseY < rowRect.height / 2) {
			hoverBackground.style.top = "-100%";
		} else {
			hoverBackground.style.top = "100%";
		}
	});
});

const hero = document.querySelector(".hero");
window.addEventListener("scroll", () => {
	// decrese the opacity of the hero on scroll
	console.log("window.scrollY:", window.scrollY);
	const scroll = window.scrollY;
	hero.style.opacity = 1 - scroll / 500;
});

addEventListener("DOMContentLoaded", () => {
	const gridCols = document.querySelectorAll(".gridCol");
	const viewportHeight = window.innerHeight;
	const squareheight = 50;
	const numSquares = Math.ceil(viewportHeight / squareheight);

	gridCols.forEach((col) => {
		for (let i = 0; i < numSquares; i++) {
			const square = document.createElement("div");
			square.classList.add("square");
			col.appendChild(square);

			square.addEventListener("mouseenter", () => {
				square.style.backgroundColor = "white";
				setTimeout(() => {
					square.style.backgroundColor = "transparent";
				}, 300);
			});
		}
	});
});
