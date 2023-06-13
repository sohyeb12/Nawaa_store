<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <h2 class="mb-4 fs-3">New Product</h2>
    <form action="<?= route('products.store') ?>" method="post">
    <div class="form-floating mb-3">
        <input type="text" class="form-class" id="name" name="name" placeholder="Enter Name Product">
        <label for="name">Name: </label>
    </div>

    <div class="form-floating mb-3">
        <input type="text" class="form-class" id="slug" name="slug" placeholder="URL Slug">
        <label for="slug">URL Slug: </label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-class" id="description" name="description" placeholder="Description"></textarea>
        <label for="description">Description: </label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-class" id="short_description" name="short_description" placeholder="Short_description"></textarea>
        <label for="short_description">Short Description</label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-class" id="price" name="price" placeholder="Enter Price">
        <label for="price">Price: </label>
    </div>

    <div class="form-floating mb-3">
        <input type="number" class="form-class" id="compare_price" name="compare_price" placeholder="Enter Compare Price">
        <label for="compare_price">Price: </label>
    </div>
    <input type="submit" class="btn btn-primary">

    </form>  
           

</body>
</html>