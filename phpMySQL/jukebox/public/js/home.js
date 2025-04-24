// Add subtle parallax effect to the waves
document.addEventListener("DOMContentLoaded", () => {
	const waves = document.querySelectorAll(".wave");

	window.addEventListener("mousemove", (e) => {
		const x = e.clientX / window.innerWidth;
		const y = e.clientY / window.innerHeight;

		waves.forEach((wave, index) => {
			const factor = (index + 1) * 5;

			wave.style.transform = `skewY(-12deg) translate(${x * factor}px, ${
				y * factor
			}px)`;
		});
	});

	// Add random subtle movement to waves even without mouse movement
	setInterval(() => {
		if (!window.mouseHasMoved) {
			waves.forEach((wave, index) => {
				const randomX = (Math.random() - 0.5) * 10;
				const randomY = (Math.random() - 0.5) * 10;
				const factor = (index + 1) * 2;

				wave.style.transform = `skewY(-12deg) translate(${
					randomX * factor
				}px, ${randomY * factor}px)`;
			});
		}
	}, 3000);

	// Track if mouse has moved
	window.mouseHasMoved = false;
	window.addEventListener("mousemove", () => {
		window.mouseHasMoved = true;

		// Reset after some time of no movement
		clearTimeout(window.mouseResetTimer);
		window.mouseResetTimer = setTimeout(() => {
			window.mouseHasMoved = false;
		}, 3000);
	});
});
