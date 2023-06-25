<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Product List</title>
  <link href="/assets/bootstrap.css" rel="stylesheet">
</head>

<body>

  <!-- Header -->
  <div class="header pt-5">
    <div class="container">
      <div class="row border-bottom">
        <div class="col-sm-6">
          <h1>Product List</h1>
        </div>
        <div class="col-sm-6 text-end">
          <button type="button" class="btn btn-light shadow-sm mx-1 border" class="btn">ADD</button>
          <button type="button" id="delete-product-btn" class="btn btn-light shadow-sm mx-1 border" class="btn" onclick="document.getElementById('deleteForm').submit()">MASS DELETE</button>
        </div>
      </div>
    </div>
  </div><!-- Header -->

  <!-- Products List -->
  <div class="products pt-4">
    <div class="container">

      <!-- Delete Form -->
      <form action="/products" method="POST" id="deleteForm">
        <input type="hidden" name="_method" value="DELETE">
        <input type="hidden" name="csrf_token" value="TO BE ADDED">
        <div class="row">

          <?php foreach ($products as $product) : ?>
            <!-- Single Product -->
            <div class="col-md-3 col-sm-4">
              <div class="card shadow border mb-3">
                <div class="card-body text-secondary">
                  <input class="form-check-input delete-checkbox" type="checkbox" name="products[]" value="<?= $product->id ?>">
                  <p class="card-text text-center">
                    <?= $product->sku ?><br>
                    <?= $product->name ?><br>
                    <?= $product->price ?>$<br>
                    <?= $product->attrs ?><br>
                  </p>
                </div>
              </div>
            </div><!-- Single Product -->
          <?php endforeach; ?>

        </div>
      </form><!-- Delete Form -->

    </div>
  </div><!-- Products List -->


  <!-- Footer -->
  <div class="footer border-top mt-3 py-3">
    <div class="container text-center">
      <span>Scandiweb Test assignment</span>
    </div>
  </div>
  <!-- Footer -->

  <script src="/assets/bootstrap.js"></script>
</body>

</html>