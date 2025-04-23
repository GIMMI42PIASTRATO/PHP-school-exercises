const form = document.querySelector("form");
const submitter = document.querySelector("button[type='submit']");

// Filed
const emailInput = document.querySelector("input[type='email']");
const passwordInput = document.querySelector("input[type='password']");

// Output field
const emailError = document.querySelector(".emailError");
const passwordError = document.querySelector(".passwordError");
const resultMessage = document.querySelector(".result");

const BASE_URL = "../api";

const validateData = (data) => {
	let isValid = true;

	// Reset error messages
	emailError.textContent = "";
	passwordError.textContent = "";
	emailInput.classList.remove("error");
	passwordInput.classList.remove("error");

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

			// Convert to URLSearchParams for x-www-form-urlencoded format
			const userDataURLEncoded = new URLSearchParams();
			for (const [key, value] of formData.entries()) {
				userDataURLEncoded.append(key, value);
			}

			console.log("Form data:", Object.fromEntries(formData.entries()));
			console.log("URLEncoded data:", userDataURLEncoded.toString());

			// Make API request to register endpoint
			const response = await fetch(`${BASE_URL}/auth/login`, {
				method: "POST",
				headers: {
					"Content-Type": "application/x-www-form-urlencoded",
				},
				body: userDataURLEncoded.toString(),
			});

			const data = await response.json();
			console.log(data);

			if (data.success) {
				// Login successful
				resultMessage.textContent = "Login successful!";
				resultMessage.classList.add("dbSuccess");

				// Redirect to dashboard after successful login
				setTimeout(() => {
					window.location.href = "../dashboard";
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
			resultMessage.classList.add("dbError");
		} finally {
			// Reset button state
			submitter.disabled = false;
			submitter.textContent = "Log In";
		}
	}
});
