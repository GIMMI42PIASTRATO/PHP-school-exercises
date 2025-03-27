const form = document.querySelector("form");
const submitter = document.querySelector("button[type='submit']");
const emailInput = document.querySelector("input[type='email']");
const passwordInput = document.querySelector("input[type='password']");
const emailError = document.querySelector(".emailError");
const passwordError = document.querySelector(".passwordError");
const resultMessage = document.querySelector(".result");

const validateData = (data) => {
	let isValid = true;

	// Reset error messages
	emailError.textContent = "";
	passwordError.textContent = "";

	// Email validation
	if (!data.get("email")) {
		emailError.textContent = "Email is required";
		emailInput.classList.add("error");
		isValid = false;
	} else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(data.get("email"))) {
		emailError.textContent = "Please enter a valid email address";
		emailInput.classList.add("error");
		isValid = false;
	}

	// Password validation
	if (!data.get("password")) {
		passwordError.textContent = "Password is required";
		passwordInput.classList.add("error");
		isValid = false;
	} else if (data.get("password").length < 6) {
		passwordError.textContent = "Password must be at least 6 characters";
		passwordInput.classList.add("error");
		isValid = false;
	}

	return isValid;
};

form.addEventListener("submit", async (e) => {
	e.preventDefault();
	const formData = new FormData(form, submitter);

	// Reset result message
	resultMessage.textContent = "";

	// Validate form data
	if (validateData(formData)) {
		try {
			// Show loading state
			submitter.disabled = true;
			submitter.textContent = "Loading...";

			// Convert FormData to JSON
			const userData = {
				email: formData.get("email"),
				password: formData.get("password"),
			};

			// Make API request to login endpoint
			const response = await fetch("../api/login.php", {
				method: "POST",
				headers: {
					"Content-Type": "application/json",
				},
				body: JSON.stringify(userData),
			});

			const data = await response.json();

			if (response.ok) {
				// Login successful
				resultMessage.textContent = "Login successful!";
				resultMessage.classList.add("dbSuccess");

				// Redirect to dashboard after successful login
				setTimeout(() => {
					window.location.href = "../../dashboard/";
				}, 1000);
			} else {
				// Login failed
				resultMessage.textContent =
					data.message || "Login failed. Please try again.";
				resultMessage.classList.add("dbError");
			}
		} catch (error) {
			console.error("Login error:", error);
			resultMessage.textContent = "An error occurred. Please try again.";
			resultMessage.style.color = "red";
		} finally {
			// Reset button state
			submitter.disabled = false;
			submitter.textContent = "Log In";
		}
	}
});
