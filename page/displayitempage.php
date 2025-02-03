<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <link rel="stylesheet" href="/css/displayitem.css">
        <link rel="stylesheet" href="/css/style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@48,400,0,0">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src = "/js/script.js" defer></script>
        <script src = "/js/displayitem.js" defer></script>
        <title>View Item</title>
    </head>
    <body>
        <?php include '../page/header.php'; ?>
    
            <div class="container-table">
                <h2> Item Listing </h2>
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
                    <!-- table header -->
                </ul>
                
                <div class="pagination">
                    <!-- table content (fetched using AJAX) -->
                </div>
            </div>
        <?php include '../page/footer.php'; ?>
    </body>
</html>