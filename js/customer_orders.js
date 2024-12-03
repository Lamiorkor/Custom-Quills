document.addEventListener('DOMContentLoaded', function () {
    // Add event listener to all "View Details" buttons
    document.querySelectorAll('.view-details-btn').forEach(btn => {
        btn.addEventListener('click', function () {
            const order = JSON.parse(this.dataset.order);

            // Update modal content with order details
            document.getElementById('modalInvoice').textContent = order.invoice_no;
            document.getElementById('modalDate').textContent = order.date_ordered;
            document.getElementById('modalReceiveBy').textContent = order.receive_by_date;
            document.getElementById('modalAmount').textContent = order.total_amount;
            document.getElementById('modalStatus').textContent = order.order_status;

            // Show modal
            document.getElementById('modalOverlay').classList.add('active');
            document.getElementById('orderModal').classList.add('active');
        });
    });

    // Close modal when the close button is clicked
    document.getElementById('closeModal').addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.remove('active');
        document.getElementById('orderModal').classList.remove('active');
    });

    // Close modal when clicking on the overlay
    document.getElementById('modalOverlay').addEventListener('click', () => {
        document.getElementById('modalOverlay').classList.remove('active');
        document.getElementById('orderModal').classList.remove('active');
    });

    document.querySelectorAll('.cancel-order-btn').forEach(button => {
        button.addEventListener('click', function () {
            const orderId = this.getAttribute('data-order-id');
            if (confirm("Are you sure you want to cancel this order?")) {
                fetch("../actions/cancel_order_action.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({ order_id: orderId }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success") {
                        alert("Order cancelled successfully.");
                        location.reload();
                    } else {
                        alert("Failed to cancel order: " + data.message);
                    }
                });
            }
        });
    });
    
});
