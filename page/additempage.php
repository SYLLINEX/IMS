<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/additem.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="/js/additem.js" defer></script>
        <script src="/js/script.js" defer></script>
        <title>Add New Item</title>
    </head>

    <body>
        <?php include '../page/header.php'; ?>
        <div class="container-table">
            <h2> Add New Item </h2>
            <div class="form-container">
                <form id="addItem" class="item-form">
                    <div class="input-group">
                        <input type="text" id="item_name" name="item_name" class="filter-input" required>
                        <label for ="item_name">Item Name</label>
                    </div>

                    <div class="input-group">
                        <textarea id="item_desc" name="item_desc" class="filter-input" required></textarea>
                        <label for ="item_desc">Item Description</label>
                    </div>

                    <div class="input-group">
                        <select id="item_category" name="item_category" class="filter-input" required>
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
                        <input type="number" id="item_quantity" name="item_quantity" class="filter-input" required>
                        <label for ="item_quantity">Quantity</label>
                    </div>

                    <button type="submit" class="submit-btn">Add Item</button>
                </form>
            </div>
        </div>
        <?php include '../page/footer.php'; ?>
    </body>
</html>