<?php include __DIR__ . '/../layout/header.php' ?>


<!-- Header -->
<div class="header pt-5">
    <div class="container">
        <div class="row border-bottom">
            <div class="col-sm-6">
                <h1>Product Add</h1>
            </div>
            <div class="col-sm-6 text-end">
                <button type="button" class="btn btn-light shadow-sm mx-1 border" class="btn" onclick="document.getElementById('product_form').submit()">Save</button>
                <a href="/" type="button" class="btn btn-light shadow-sm mx-1 border" class="btn">Cancel</a>
            </div>
        </div>
    </div>
</div><!-- Header -->

<!-- Products List -->
<div class="products pt-4" id="app">
    <div class="container">

        <?php if (count($errors)) : ?>
            <div class="alert alert-danger" role="alert">
                The given data was invalid.
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li><?= $error[0] ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>


        <!-- Create Form -->
        <form action="/add-product" method="POST" id="product_form">
            <input type="hidden" name="csrf_token" value="<?= \Scandiweb\Session::csrf() ?>">

            <!-- SKU Field -->
            <div class="mb-3 row">
                <label for="sku" class="col-sm-2 col-form-label">SKU</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="sku" name="sku">
                </div>
            </div><!-- SKU Field -->

            <!-- Name Field -->
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div><!-- Name Field -->

            <!-- Price Field -->
            <div class="mb-3 row">
                <label for="price" class="col-sm-2 col-form-label">Price($)</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="price" name="price">
                </div>
            </div><!-- Price Field -->

            <!-- Type Field -->
            <div class="mb-3 row">
                <label for="type" class="col-sm-2 col-form-label">Product type</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Product type" id="productType" v-model="type" name="type">
                        <option value="book" id="Book">Book</option>
                        <option value="dvd" id="DVD">DVD</option>
                        <option value="furniture" id="Furniture">Furniture</option>
                    </select>
                </div>
            </div><!-- Type Field -->



            <div class="p-5">
                <!-- Book Attributes -->
                <div class="mb-3 row" v-if="type === 'book'">
                    <small class="form-text">Please, provide weight</small>

                    <label for="weight" class="col-sm-2 col-form-label">Weight (KG)</label>
                    <div class="col-sm-10">
                        <input name="attrs[weight]" type="text" class="form-control" id="weight">
                    </div>
                </div><!-- Book Attributes -->

                <!-- DVD Attributes -->
                <div class="mb-3 row" v-if="type === 'dvd'">
                    <small class="form-text">Please, provide size</small>

                    <label for="size" class="col-sm-2 col-form-label">Size (MB)</label>
                    <div class="col-sm-10">
                        <input name="attrs[size]" type="text" class="form-control" id="size">
                    </div>
                </div><!-- DVD Attributes -->

                <!-- Furniture Attributes -->
                <div class="furniture-attributes" v-if="type === 'furniture'">
                    <small class="form-text">Please, provide dimensions</small>

                    <div class="mb-3 row">
                        <label for="height" class="col-sm-2 col-form-label">Height (CM)</label>
                        <div class="col-sm-10">
                            <input name="attrs[height]" type="text" class="form-control" id="height">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="width" class="col-sm-2 col-form-label">Width (CM)</label>
                        <div class="col-sm-10">
                            <input name="attrs[width]" type="text" class="form-control" id="width">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="length" class="col-sm-2 col-form-label">Length (CM)</label>
                        <div class="col-sm-10">
                            <input name="attrs[length]" type="text" class="form-control" id="length">
                        </div>
                    </div>
                </div><!-- Furniture Attributes -->
            </div>


        </form><!-- Create Form -->

    </div>
</div><!-- Products List -->

<script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
<script>
    const {
        createApp,
        ref
    } = Vue

    createApp({
        setup() {
            const type = ref('')
            return {
                type
            }
        }
    }).mount('#app')
</script>

<?php include __DIR__ . '/../layout/footer.php' ?>