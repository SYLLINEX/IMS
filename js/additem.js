document.addEventListener('DOMContentLoaded', function () {
    const addItem = document.getElementById('addItem');

    // Import showAlert function from main script
    function showAlert(message, callback) {
        const alertBox = document.getElementById('alert-box');
        const alertMsg = document.getElementById('alert-msg');
        
        alertMsg.textContent = message;
        alertBox.style.display = 'block';
        
        setTimeout(() => {
            alertBox.style.display = 'none';
            if (callback) callback();
        }, 1300);
    }

    addItem.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = {
            itemName: document.getElementById('item_name').value,
            itemDesc: document.getElementById('item_desc').value,
            itemCategory: document.getElementById('item_category').value,
            itemQuantity: document.getElementById('item_quantity').value
        };

        //form validation for item quantity
        if (formData.itemQuantity < 1) {
            showAlert('Quantity must be at least 1.');
            return;
        }

        fetch('/API/add_items.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('Item added successfully! Redirecting....', () => {
                    setTimeout(() => {
                        window.location.href = '/page/displayitempage.php';
                    }, 1300);
                });
                addItem.reset();
            } else {
                showAlert(data.message || 'An error occurred! Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred! Please try again.');
        });
    });
});