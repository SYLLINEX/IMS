let currentFilters = {
    page: 1,
    search: '',
    category: '',
    sort: '',
    order: 'ASC'
};

document.addEventListener('DOMContentLoaded', function() {
    loadPage(1);

    document.querySelector('.pagination').addEventListener('click', function(e) {
        e.preventDefault();
        if (e.target.classList.contains('page-link')) {
            const page = e.target.getAttribute('data-page');
            loadPage(page);
        }
    });

    // filter listener
    document.getElementById('search').addEventListener('input', debouce(function(e) {
        currentFilters.search = e.target.value;
        currentFilters.page = 1;
        loadFilteredData();
    }, 300));

    document.getElementById('categoryFilter').addEventListener('change', function(e) {
        currentFilters.category = e.target.value;
        currentFilters.page = 1;
        loadFilteredData();
    });

    // sort listener for the table headers
    document.querySelectorAll('.responsive-table').addEventListener('click', function(e) {
        if (e.target.closet('.col')) {
            const col = e.target.closest('.col').getAttribute('data-sort');
            if (col) {
                currentFilters.sort = col;
                currentFilters.order = currentFilters.order === 'ASC' ? 'DESC' : 'ASC';
                loadFilteredData();
            }
        }
    })
});

function loadFilteredData() {
    const parameters = new URLSearchParams(currentFilters);
    fetch(`/API/fetch_items.php?${parameters.toString()}`)
        .then(response => response.json())//parse the response as JSON
        .then(data => {
            updateTable(data.items);
            updatePagination(data.current_page, data.total_pages);
        })
        .catch(error => console.error('Error:', error));
}

// debounce helper functon
function debouce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        }
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

//load page function
function loadPage(page) {
    currentFilters.page = page;
    loadFilteredData();
}

function updateTable(items) {
    const tableBody = document.querySelector('.responsive-table');
    let html = `
        <li class="table-header">
            <div class="col col-1">Item Name</div>
            <div class="col col-2">Item Description</div>
            <div class="col col-3">Item Category</div>
            <div class="col col-4">Item Quantity</div>
            <div class="col col-5">Date Added</div>
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
            </li>
        `;
    });
    tableBody.innerHTML = html;
}

function updatePagination(currentPage, totalPages) {
    const pagination = document.querySelector('.pagination');
    let html = '';
    
    if (currentPage > 1) {
        html += `<a href="#" class="page-link" data-page="${currentPage-1}">❬</a>`;
    }
    
    for (let i = 1; i <= totalPages; i++) {
        html += `
            <a href="#" class="page-link ${i == currentPage ? 'active' : ''}" 
               data-page="${i}">${i}</a>
        `;
    }
    
    if (currentPage < totalPages) {
        html += `<a href="#" class="page-link" data-page="${currentPage+1}">❭</a>`;
    }
    
    pagination.innerHTML = html;
}

