<?php include_once __DIR__ . '/layout/header.php'; ?>

<div class="container mt-auto">

    <h1>Products</h1>
    <div class="row">
        <?php if (!empty($data['products'])): ?>
            <?php foreach ($data['products'] as $product): ?>
                <div class="card m-3" style="width: 13rem;">
                    <div class="card-body">
                        <h5 class="card-title"><?= $product['name'] ?></h5>
                        <p class="card-text"><?= $product['description'] ?></p>
                        <p class="card-text text-danger">$<?= $product['price'] ?></p>
                        <button class="btn btn-primary order-btn" type="submit"
                                data-product="<?= htmlspecialchars($product['id']) ?>"
                               >Order Now</button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<?php include_once __DIR__ . '/layout/footer.php' ?>
