document.addEventListener("DOMContentLoaded", () => {
	const modal = document.getElementById("confirmation-modal");
	const confirmDeleteBtn = document.getElementById("confirm-delete");
	const cancelDeleteBtn = document.getElementById("cancel-delete");
	const searchForm = document.querySelector(".search-form");
	const searchInput = searchForm.querySelector('input[type="text"]');

	let itemToDelete = {
		type: null,
		id: null,
	};

	// Add click event listeners to all delete buttons
	document.querySelectorAll(".delete-button").forEach((button) => {
		button.addEventListener("click", (e) => {
			e.stopPropagation();

			// Store the item info for deletion
			itemToDelete.type = button.dataset.type;
			itemToDelete.id = button.dataset.id;

			// Show the confirmation modal
			modal.classList.add("active");
		});
	});

	// Handle cancel button click
	cancelDeleteBtn.addEventListener("click", () => {
		modal.classList.remove("active");

		// Reset the item to delete
		itemToDelete = {
			type: null,
			id: null,
		};
	});

	// Handle confirm delete button click
	confirmDeleteBtn.addEventListener("click", async () => {
		if (itemToDelete.type && itemToDelete.id) {
			try {
				// Define the endpoint based on type
				const endpoint =
					itemToDelete.type === "singer"
						? `../api/${itemToDelete.type}s/delete/${itemToDelete.id}`
						: `../api/${itemToDelete.type}s/delete/${itemToDelete.id}`;

				const response = await fetch(endpoint, {
					method: "DELETE",
					headers: {
						"Content-Type": "application/json",
					},
				});

				const result = await response.json();

				if (result.success) {
					// Remove the card from the UI
					const cardToRemove = document.querySelector(
						`.${itemToDelete.type}-card[data-id="${itemToDelete.id}"]`
					);
					if (cardToRemove) {
						cardToRemove.remove();
					}

					// Check if there are no more cards in this column
					const container = document.querySelector(
						`.${itemToDelete.type}s-column .cards-container`
					);
					if (container.children.length === 0) {
						const noResults = document.createElement("p");
						noResults.className = "no-results";
						noResults.textContent = `No ${itemToDelete.type}s found`;
						container.appendChild(noResults);
					}
				} else {
					alert(`Error: ${result.message}`);
				}
			} catch (error) {
				console.error("Error during delete operation:", error);
				alert(
					"An error occurred while trying to delete. Please try again."
				);
			} finally {
				// Hide the modal regardless of result
				modal.classList.remove("active");

				// Reset the item to delete
				itemToDelete = {
					type: null,
					id: null,
				};
			}
		}
	});

	// Add/remove has-content class based on input value
	searchInput.addEventListener("input", function () {
		if (this.value.length > 0) {
			searchForm.classList.add("has-content");
		} else {
			searchForm.classList.remove("has-content");
		}
	});

	// Initialize state on page load
	if (searchInput.value.length > 0) {
		searchForm.classList.add("has-content");
	}

	// Handle click on the clear button (the ::after pseudo-element)
	searchForm.addEventListener("click", function (e) {
		// Approximate position check for the ::after element
		const rect = searchForm.getBoundingClientRect();
		const x = e.clientX - rect.left;
		const y = e.clientY - rect.top;

		if (
			x > rect.width - 40 &&
			y > rect.height / 2 - 20 &&
			y < rect.height / 2 + 20
		) {
			if (searchForm.classList.contains("has-content")) {
				searchInput.value = "";
				searchForm.classList.remove("has-content");
				searchInput.focus();
			}
		}
	});
});
