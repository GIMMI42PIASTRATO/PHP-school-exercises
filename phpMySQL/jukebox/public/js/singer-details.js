const singerImage = document.getElementById("singerImage");
const largeCard = document.querySelector(".largeCard");

// Extract colors from the singer image for the background gradient when page loads
document.addEventListener("DOMContentLoaded", function () {
	if (singerImage && singerImage.complete) {
		updateBackgroundGradient();
	} else if (singerImage) {
		singerImage.addEventListener("load", updateBackgroundGradient);
	}
});

function updateBackgroundGradient() {
	try {
		const colorThief = new ColorThief();
		const palette = colorThief.getPalette(singerImage, 2);

		if (palette && palette.length >= 2) {
			const darkColor = `rgb(${palette[0][0]}, ${palette[0][1]}, ${palette[0][2]})`;
			const lightColor = `rgb(${palette[1][0]}, ${palette[1][1]}, ${palette[1][2]})`;

			// Create darker version of the first color
			const darkerColor = makeDarker(palette[0], 0.7);

			// Apply the gradient
			largeCard.style.background = `linear-gradient(to top, ${darkerColor}, ${lightColor})`;
		}
	} catch (e) {
		console.error("Error extracting colors:", e);
	}
}

function makeDarker(color, factor) {
	return `rgb(${Math.floor(color[0] * factor)}, ${Math.floor(
		color[1] * factor
	)}, ${Math.floor(color[2] * factor)})`;
}
