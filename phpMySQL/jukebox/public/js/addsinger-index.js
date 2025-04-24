const input = document.getElementById("imageUpload");
const preview = document.getElementById("previewImage");
const largeCard = document.querySelector(".largeCard");

// Flag to track if the image was uploaded by the user
let imageWasUploaded = false;

input.addEventListener("change", function () {
	const file = this.files[0];
	if (file) {
		imageWasUploaded = true; // Set flag when user uploads an image
		const reader = new FileReader();

		reader.addEventListener("load", function () {
			preview.setAttribute("src", this.result);

			// Wait for image to load before extracting colors
			preview.onload = function () {
				updateBackgroundGradient(preview);
			};
		});

		reader.readAsDataURL(file);
	}
});

function updateBackgroundGradient(imageElement) {
	// Only update gradient if image was explicitly uploaded by user
	if (!imageWasUploaded) return;

	try {
		const colorThief = new ColorThief();
		const palette = colorThief.getPalette(imageElement, 2);

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

// Remove the automatic gradient update on page load
// The default gradient from CSS will be used until a user uploads an image
