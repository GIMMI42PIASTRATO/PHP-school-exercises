const coverInput = document.getElementById("coverUpload");
const coverPreview = document.getElementById("previewCover");
const largeCard = document.querySelector(".largeCard");
const audioInput = document.getElementById("audioUpload");
const selectedAudioFile = document.getElementById("selectedAudioFile");

// Flag to track if the image was uploaded by the user
let coverWasUploaded = false;

// Handle cover image upload
coverInput.addEventListener("change", function () {
	const file = this.files[0];
	if (file) {
		coverWasUploaded = true; // Set flag when user uploads an image
		const reader = new FileReader();

		reader.addEventListener("load", function () {
			coverPreview.setAttribute("src", this.result);

			// Wait for image to load before extracting colors
			coverPreview.onload = function () {
				updateBackgroundGradient(coverPreview);
			};
		});

		reader.readAsDataURL(file);
	}
});

// Handle audio file selection display
audioInput.addEventListener("change", function () {
	const file = this.files[0];
	if (file) {
		selectedAudioFile.textContent = file.name;
	} else {
		selectedAudioFile.textContent = "No file selected";
	}
});

function updateBackgroundGradient(imageElement) {
	// Only update gradient if image was explicitly uploaded by user
	if (!coverWasUploaded) return;

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
