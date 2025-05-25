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
		selectedAudioFile.textContent = "New file selected: " + file.name;
	} else {
		selectedAudioFile.textContent = "No file selected";
	}
});

// Extract colors from the cover image when page loads
document.addEventListener("DOMContentLoaded", function () {
	if (coverPreview && coverPreview.complete) {
		updateBackgroundGradient(coverPreview);
	} else if (coverPreview) {
		coverPreview.addEventListener("load", function () {
			updateBackgroundGradient(coverPreview);
		});
	}
});

// Add this code near the beginning of your DOMContentLoaded event listener

// Get form and fields for validation
const songForm = document.querySelector("form");
const releaseDateInput = document.getElementById("releaseDate");
const durationInput = document.getElementById("duration");

// Create error message elements
const dateErrorMsg = document.createElement("div");
dateErrorMsg.className = "error-message";
dateErrorMsg.style.color = "red";
dateErrorMsg.style.fontSize = "0.9rem";
dateErrorMsg.style.marginTop = "5px";
releaseDateInput.parentNode.appendChild(dateErrorMsg);

const durationErrorMsg = document.createElement("div");
durationErrorMsg.className = "error-message";
durationErrorMsg.style.color = "red";
durationErrorMsg.style.fontSize = "0.9rem";
durationErrorMsg.style.marginTop = "5px";
durationInput.parentNode.appendChild(durationErrorMsg);

// Set max date to today
const today = new Date().toISOString().split("T")[0];
releaseDateInput.setAttribute("max", today);

// Validate date - no future dates allowed
releaseDateInput.addEventListener("change", function () {
	const selectedDate = new Date(this.value);
	const currentDate = new Date();

	// Reset the time portion for accurate date comparison
	selectedDate.setHours(0, 0, 0, 0);
	currentDate.setHours(0, 0, 0, 0);

	if (selectedDate > currentDate) {
		dateErrorMsg.textContent = "Release date cannot be in the future";
		this.setCustomValidity("Future date not allowed");
	} else {
		dateErrorMsg.textContent = "";
		this.setCustomValidity("");
	}
});

// Validate duration - between 1 second and 24 hours (86400 seconds)
durationInput.addEventListener("change", function () {
	const duration = parseInt(this.value);

	if (isNaN(duration) || duration <= 0) {
		durationErrorMsg.textContent = "Duration must be a positive number";
		this.setCustomValidity("Invalid duration");
	} else if (duration > 86400) {
		durationErrorMsg.textContent =
			"Duration cannot exceed 24 hours (86400 seconds)";
		this.setCustomValidity("Duration too long");
	} else {
		durationErrorMsg.textContent = "";
		this.setCustomValidity("");
	}
});

// Format duration as MM:SS when focus is lost
durationInput.addEventListener("blur", function () {
	const duration = parseInt(this.value);
	if (!isNaN(duration) && duration > 0) {
		const minutes = Math.floor(duration / 60);
		const seconds = duration % 60;
		durationErrorMsg.textContent = `${minutes}:${seconds
			.toString()
			.padStart(2, "0")} (mm:ss)`;
		durationErrorMsg.style.color = "#666"; // Change to non-error color
	}
});

// Additional form submission validation
songForm.addEventListener("submit", function (e) {
	// Trigger validation on both fields
	releaseDateInput.dispatchEvent(new Event("change"));
	durationInput.dispatchEvent(new Event("change"));

	// Check if the form is valid
	if (!songForm.checkValidity()) {
		e.preventDefault();
	}
});

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
	return `rgb(${Math.floor(color[0] * factor)}, ${Math.floor(
		color[1] * factor
	)}, ${Math.floor(color[2] * factor)})`;
}
