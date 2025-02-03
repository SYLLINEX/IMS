/* alert box functions */
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

document.addEventListener('DOMContentLoaded', () => {
    loadPage(1);
    
    const blurOverlay = document.querySelector('.blur-bg-overlay');
    const formPopup = document.querySelector('.form-popup');
    const formClose = document.querySelector('.form-popup .close-btn');
    const updateForm = document.querySelector('.form-box.update');

    // Hide form initially
    formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');

    // Close button functionality
    formClose.addEventListener('click', (e) => {
        e.preventDefault();
        document.body.classList.remove('show-popup');
        formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');
    });

    // Close on overlay click
    blurOverlay.addEventListener('click', (e) => {
        if (e.target === blurOverlay) {
            document.body.classList.remove('show-popup');
            formPopup.querySelectorAll('.form-box').forEach((form) => form.style.display = 'none');
        }
    });
});



function updateTable(items) {
    const tableBody = document.querySelector('.responsive-table');
    let html = `
        <li class="table-header">
            <div class="col col-1">Item Name</div>
            <div class="col col-2">Description</div>
            <div class="col col-3">Category</div>
            <div class="col col-4">Quantity</div>
            <div class="col col-5">Date Added</div>
            <div class="col col-6">Action</div>
        </li>
    `;

    items.forEach(item => {
        html += `
            <li class="table-row">
                <div class="col col-1" data-label="Item Name">${item.item_name}</div>
                <div class="col col-2" data-label="Description">${item.item_desc}</div>
                <div class="col col-3" data-label="Category">${item.item_category}</div>
                <div class="col col-4" data-label="Quantity">${item.item_quantity}</div>
                <div class="col col-5" data-label="Date Added">${item.date_added}</div>
                <div class="col col-6" data-label="Action">
                    <button class="edit-btn" id="edit-btn" data-id="${item.id}" data-item='${JSON.stringify(item)}'>
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="delete-btn" data-id="${item.id}">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </li>
        `;
    });
    
    tableBody.innerHTML = html;
    
    // Add event listeners
    document.querySelectorAll('.delete-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const itemId = this.getAttribute('data-id');
            deleteItem(itemId);
        });
    });

    document.querySelectorAll('.edit-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Edit button clicked'); // Debug line
            const item = JSON.parse(this.getAttribute('data-item'));
            showUpdateForm(item);
        });
    });
}

function showUpdateForm(item) {
    console.log('Opening form for item:', item);

    const formPopup = document.querySelector('.form-popup');
    const updateForm = document.querySelector('.form-box.update');

    // Show popup
    document.body.classList.add('show-popup');
    updateForm.style.display = 'block';

    // Populate form fields
    document.getElementById('item_id').value = item.id;
    document.getElementById('update_item_name').value = item.item_name;
    document.getElementById('update_item_desc').value = item.item_desc;
    document.getElementById('update_item_category').value = item.item_category;
    document.getElementById('update_item_quantity').value = item.item_quantity;
}

function deleteItem(itemId) {
    if (confirm('Are you sure you want to delete this item?')) {
        fetch('/API/delete_items.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: itemId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showAlert('Item deleted successfully!');
                loadPage(1);
            } else {
                showAlert(data.message || 'Error deleting item');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showAlert('An error occurred while deleting the item');
        });
    }
}

// Add event listener for update form submission
document.getElementById('updateItem').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = {
        itemId: document.getElementById('item_id').value,
        itemName: document.getElementById('update_item_name').value,
        itemDesc: document.getElementById('update_item_desc').value,
        itemCategory: document.getElementById('update_item_category').value,
        itemQuantity: document.getElementById('update_item_quantity').value
    };

    // Validate quantity
    if (formData.itemQuantity < 1) {
        showAlert('Quantity must be at least 1');
        return;
    }
    if (formData.itemName.length < 1) {
        showAlert('Item name is required');
        return;
    }
    if (formData.itemCategory.length < 1) {
        showAlert('Item category is required');
        return;
    }
    if (formData.itemDesc.length < 1) {
        showAlert('Item description is required');
        return;
    }
    
    fetch('/API/update_items.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            showAlert('Item updated successfully!');
            document.body.classList.remove('show-popup');
            loadPage(currentFilters.page);
        } else {
            showAlert(data.message || 'Error updating item');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showAlert('An error occurred while updating the item');
    });
});