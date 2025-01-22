let popupTimeout;
const appsPopup = document.querySelector(".appPopup");
const appsLink = document.querySelector(".appsLink");
// Mostra il popup quando il cursore entra nel link "Apps"

const mainLink = document.querySelector(".mainLink");
const appLinks = document.querySelectorAll(".appLink");

appsLink.addEventListener("mouseenter", () => {
	clearTimeout(popupTimeout);
	appsPopup.style.display = "grid";
});

appsPopup.addEventListener("mouseenter", () => {
	clearTimeout(popupTimeout);
});

appsLink.addEventListener("mouseleave", () => {
	popupTimeout = setTimeout(() => {
		appsPopup.style.display = "none";
	}, 200); // Ritardo di 200ms
});

appsPopup.addEventListener("mouseleave", () => {
	popupTimeout = setTimeout(() => {
		appsPopup.style.display = "none";
	}, 200);
});

appLinks.forEach((appLink) => {
	appLink.addEventListener("click", () => {
		window.location.href += appLink.getAttribute("data-link");
	});
});
