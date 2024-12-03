document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to all "View Details" buttons
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const order = JSON.parse(this.dataset.order); // Get the order data from the button's data-order attribute
            const orderId = order.order_id; // Extract the order_id

            // Fetch order details via AJAX
            fetch('../actions/fetch_order_details_action.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ order_id: orderId }) // Send only the order_id
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    const orderDetails = data.data;

                    // Populate modal with fetched order details
                    const detailsHTML = orderDetails.map(detail => `
                        <p><strong>Service:</strong> ${detail.service_name}</p>
                        <p><strong>Price:</strong> GHS ${detail.service_price}</p>
                        <p><strong>Writer:</strong> ${detail.writer_name}</p>
                        <p><strong>Quantity:</strong> ${detail.qty}</p>
                    `).join('');
                    document.getElementById('modalContent').innerHTML = detailsHTML;

                    // Show modal and overlay
                    document.getElementById('modalOverlay').classList.remove('hidden');
                    document.getElementById('orderModal').classList.remove('hidden');
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error fetching order details:', error);
            });
        });
    });

    // Close modal when clicking on close button
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('orderModal').classList.add('hidden');
    });

    // Close modal when clicking on the overlay
    document.getElementById('modalOverlay').addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.add('hidden');
        document.getElementById('orderModal').classList.add('hidden');
    });
});
