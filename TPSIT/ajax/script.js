const button = document.querySelector("button");
const responseContainer = document.querySelector(".responseContainer");

button.addEventListener("click", () => {
	const xmlHttpRequest = new XMLHttpRequest();
	xmlHttpRequest.open(
		"GET",
		"http://localhost:8080/vittoriobussano/TPSIT/ajax/server"
	);
	xmlHttpRequest.onreadystatechange = () => {
		if (xmlHttpRequest.readyState === XMLHttpRequest.DONE) {
			const statusCode = xmlHttpRequest.status;
			if (statusCode === 0 || (statusCode >= 200 && statusCode < 400)) {
				responseContainer.textContent = `${xmlHttpRequest.responseText}
                ${xmlHttpRequest.getResponseHeader("Content-Type")}`;
			} else {
				responseContainer.textContent =
					"There was an error during the request, plese try again 😭";
			}
		}
		responseContainer.textContent = xmlHttpRequest.responseText;
	};
	xmlHttpRequest.send();
});
