<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/manageitem.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "/js/script.js" defer></script>
        <script src = "/js/displayitem.js" defer></script>
        <script src = "/js/manageitem.js" defer></script>
        <title>Manage Item</title>
    </head>
    <body>
        <?php include '../page/header.php'; ?>
        
        <main>
            <div class="container-table">
                <h2> Manage Item </h2>
                <div class="filter-container">
                    <input type="text" id="search" placeholder="Search items..." class="filter-input">
                    <select id="categoryFilter" class="filter-input">
                        <option value="">All Categories</option>
                        <option value="Keyboard">Keyboard</option>
                        <option value="Mouse">Mouse</option>
                        <option value="Monitor">Monitor</option>
                        <option value="Laptop">Laptop</option>
                        <option value="Desktop">Desktop</option>
                        <option value="Printer">Printer</option>
                        <option value="Others">Others</option>
                    </select>   
                </div>
                <ul class="responsive-table">
                    <li class="table-header">
                        <div class="col col-1">Item Name</div>
                        <div class="col col-2">Description</div>
                        <div class="col col-3">Category</div>
                        <div class="col col-4">Quantity</div>
                        <div class="col col-5">Date Added</div>
                        <div class="col col-6">Action</div>
                    </li>
                </ul>
                
                <div class="pagination">
                    <!-- table content (fetched using AJAX) -->
                </div>
            </div>
        </main>
            
        <div class="blur-bg-overlay">
            <div class="form-popup">
                <span class="close-btn material-symbols-rounded" style="color:black">Close</span>
                <div class="form-box update">

                    <h2>Update Item</h2>
                    
                    <form id="updateItem" class="item-form">
                        <input type="hidden" name="item_id" id="item_id">
                        <div class="input-group">
                            <input type="text" id="update_item_name" name="item_name" class="filter-input" required>
                            <label for ="item_name">Item Name</label>
                        </div>

                        <div class="input-group">
                            <textarea id="update_item_desc" name="item_desc" class="filter-input" required></textarea>
                            <label for ="item_desc">Item Description</label>
                        </div>

                        <div class="input-group">
                            <select id="update_item_category" name="item_category" class="filter-input" required>
                                <option value="" style="opacity: 0.5">Select Category</option>
                                <option value="Keyboard">Keyboard</option>
                                <option value="Mouse">Mouse</option>
                                <option value="Monitor">Monitor</option>
                                <option value="Laptop">Laptop</option>
                                <option value="Desktop">Desktop</option>
                                <option value="Printer">Printer</option>
                                <option value="Others">Others</option>
                            </select>
                            <label for="item_category">Category</label>
                        </div>

                        <div class="input-group">
                            <input type="number" id="update_item_quantity" name="item_quantity" class="filter-input" required>
                            <label for ="item_quantity">Quantity</label>
                        </div>

                        <button type="submit" class="submit-btn">Update Item</button>
                    </form>

                </div>
            </div>
            </div>    
        <?php include '../page/footer.php'; ?>
    </body>
</html>