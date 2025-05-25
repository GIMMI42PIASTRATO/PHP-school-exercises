document.addEventListener("DOMContentLoaded", function () {
	const imageUpload = document.getElementById("imageUpload");
	const previewImage = document.getElementById("previewImage");
	const largeCard = document.querySelector(".largeCard");

	// Flag to track if the image was uploaded by the user
	let imageWasUploaded = false;

	// Update image preview when user selects a new image
	imageUpload.addEventListener("change", function () {
		const file = this.files[0];
		if (file) {
			imageWasUploaded = true; // Set flag when user uploads an image
			const reader = new FileReader();
			reader.addEventListener("load", function () {
				previewImage.src = reader.result;

				// Wait for image to load before extracting colors
				previewImage.onload = function () {
					updateBackgroundGradient(previewImage);
				};
			});
			reader.readAsDataURL(file);
		}
	});

	// Extract colors from the singer image when page loads with existing image
	if (previewImage && previewImage.complete) {
		updateBackgroundGradient(previewImage);
	} else if (previewImage) {
		previewImage.addEventListener("load", function () {
			updateBackgroundGradient(previewImage);
		});
	}

	function updateBackgroundGradient(imageElement) {
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
		return `rgb(${Math.floor(
			color[0] * factor
		)}, ${Math.floor(color[1] * factor)}, ${Math.floor(color[2] * factor)})`;
	}
});
