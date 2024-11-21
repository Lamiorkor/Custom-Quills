// Get the Add Service Modal elements
const addServiceModal = document.getElementById('addServiceModal');
const addServiceBtn = document.getElementById('addServiceBtn');

// Get the Edit Service Modal elements
const editServiceModal = document.getElementById('editServiceModal');
const editButtons = document.querySelectorAll('.editBtn');

// Get close buttons (for both modals)
const closeButtons = document.querySelectorAll('.close');

// Show Add Service Modal
addServiceBtn.addEventListener("click", () => {
    addServiceModal.style.display = "block"; // Show the Add Service modal
});

// Close modals when 'x' is clicked
closeButtons.forEach(btn => {
    btn.addEventListener('click', () => {
        addServiceModal.style.display = "none";
        editServiceModal.style.display = "none";
    });
});

// Show Edit Service Modal and Pre-fill data
editButtons.forEach(button => {
    button.addEventListener('click', function() {
        const serviceID = this.getAttribute('data-service');
        const serviceName = this.getAttribute('data-service-name');
        const serviceCategory = this.getAttribute('data-service-category');
        const servicePrice = this.getAttribute('data-service-price');
        const serviceDesc = this.getAttribute('data-service-desc');
        const serviceKeywords = this.getAttribute('data-service-keywords');

        // Pre-fill the form with service data
        document.getElementById('editServiceID').value = serviceID;
        document.getElementById('editServiceName').value = serviceName;
        document.getElementById('editServiceCategory').value = serviceCategory;
        document.getElementById('editServicePrice').value = servicePrice;
        document.getElementById('editServiceDesc').value = serviceDesc;
        document.getElementById('editServiceKeywords').value = serviceKeywords;

        // Show the Edit Service modal
        editServiceModal.style.display = "block";
    });
});

// Close modals when clicking outside of them
window.addEventListener('click', (event) => {
    if (event.target === addServiceModal) {
        addServiceModal.style.display = "none";
    } else if (event.target === editServiceModal) {
        editServiceModal.style.display = "none";
    }
});
