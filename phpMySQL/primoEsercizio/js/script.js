let popupTimeout;
const appsPopup = document.querySelector(".appPopup");
const appsLink = document.querySelector(".appsLink");
const chevronDown = document.querySelector(".chevronDown");

// Funzione per mostrare il popup e ruotare l'icona
function showPopup() {
	clearTimeout(popupTimeout);
	appsPopup.style.display = "grid";
	chevronDown.style.transform = "rotate(180deg)";
	appsPopup.classList.add("active");
}

// Funzione per nascondere il popup e ripristinare l'icona
function hidePopup() {
	popupTimeout = setTimeout(() => {
		chevronDown.style.transform = "rotate(0deg)";
		appsPopup.classList.remove("active");
		setTimeout(() => {
			if (!appsPopup.classList.contains("active")) {
				appsPopup.style.display = "none";
			}
		}, 200);
	}, 200);
}

// Eventi per la gestione del popup
appsLink.addEventListener("mouseenter", showPopup);
appsPopup.addEventListener("mouseenter", () => clearTimeout(popupTimeout));
appsLink.addEventListener("mouseleave", hidePopup);
appsPopup.addEventListener("mouseleave", hidePopup);

// Navigazione verso i link specificati
const appLinks = document.querySelectorAll(".appLink");
appLinks.forEach((appLink) => {
	appLink.addEventListener("click", () => {
		window.location.href += appLink.getAttribute("data-link");
	});
});
