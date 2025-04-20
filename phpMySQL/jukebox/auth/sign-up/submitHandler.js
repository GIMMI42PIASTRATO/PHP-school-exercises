const form = document.querySelector("form");
const submitter = document.querySelector("button[type='submit']");

// Field
const usernameInput = document.querySelector("input[type='username']");
const emailInput = document.querySelector("input[type='text']");
const passwordInput = document.querySelector("input[type='password']");

// Output field
const usernameError = document.querySelector(".usernameError");
const emailError = document.querySelector(".emailError");
const passwordError = document.querySelector(".passwordError");
const resultMessage = document.querySelector(".result");

const BASE_URL = "../../api";

const validateData = (data) => {
	let isValid = true;

	// Reset error messages
	usernameError.textContent = "";
	emailError.textContent = "";
	passwordError.textContent = "";
	usernameInput.classList.remove("error");
	emailInput.classList.remove("error");
	passwordInput.classList.remove("error");

	// Username
	if (!data.get("username")) {
		emailError.textContent = "Username is required";
		emailInput.classList.add("error");
		isValid = false;
	} else if (data.get("username").length > 20) {
		passwordError.textContent = "Username must be at maximum 20 characters";
		passwordInput.classList.add("error");
		isValid = false;
	}

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
	} else if (data.get("password").length < 8) {
		passwordError.textContent = "Password must be at least 8 characters";
		passwordInput.classList.add("error");
		isValid = false;
	} else if (data.get("password").length > 20) {
		passwordError.textContent = "Password must be at maximum 20 characters";
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

			// Wait for 2 seconds
			// await new Promise((resolve) => setTimeout(resolve, 2000));

			// Convert FormData to JSON
			const userDataJSON = {
				email: formData.get("email"),
				password: formData.get("password"),
			};

			// Convert JSON to URLSearchParams for x-www-form-urlencoded format
			const userDataURLEncoded = new URLSearchParams();
			userDataURLEncoded.append("email", formData.get("email"));
			userDataURLEncoded.append("password", formData.get("password"));

			// Make API request to login endpoint
			const response = await fetch(`${BASE_URL}/auth/register`, {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-encoded",
				},
				body: userDataURLEncoded,
			});

			const data = await response.json();
			console.log(data);

			if (data.success) {
				// Register successful
				resultMessage.textContent = "Register successful!";
				resultMessage.classList.add("dbSuccess");

				// Redirect to dashboard after successful login
				setTimeout(() => {
					window.location.href = "../../dashboard/";
				}, 1000);
			} else {
				// Register failed
				resultMessage.textContent =
					data.message || "Login failed. Please try again.";
				resultMessage.classList.add("dbError");
			}
		} catch (error) {
			console.error("Login error:", error);
			resultMessage.textContent = "An error occurred. Please try again.";
			resultMessage.classList.add("dbError");
		} finally {
			// Reset button state
			submitter.disabled = false;
			submitter.textContent = "Log In";
		}
	}
});
