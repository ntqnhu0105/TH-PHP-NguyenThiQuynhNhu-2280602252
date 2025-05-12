<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="/project1/public/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Danh sách sản phẩm</h1>
            <a href="/project1/Product/add" class="btn btn-success ripple-btn" aria-label="Thêm sản phẩm mới"><i class="fas fa-plus me-2"></i>Thêm sản phẩm mới</a>
        </div>
        <div class="row" id="productList">
            <?php if (empty($products)): ?>
                <div class="col-12 fade-in">
                    <p class="text-center text-muted">Không có sản phẩm nào.</p>
                </div>
            <?php else: ?>
                <?php foreach ($products as $product): ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <div class="card product-card fade-in" style="animation-delay: <?php echo (array_search($product, $products) * 0.1); ?>s;">
                            <div class="card-body">
                                <h2 class="card-title"><?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?></h2>
                                <p class="card-text description"><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                                <p class="card-text price">
                                    <span class="price-badge pulse"><i class="fas fa-tag me-2"></i><?php echo number_format($product->getPrice(), 0, ',', '.'); ?> VND</span>
                                </p>
                                <div class="card-actions">
                                    <a href="/project1/Product/edit/<?php echo $product->getID(); ?>" class="btn btn-primary ripple-btn" aria-label="Sửa sản phẩm"><i class="fas fa-pencil-alt me-2"></i>Sửa</a>
                                    <a href="/project1/Product/delete/<?php echo $product->getID(); ?>" class="btn btn-danger ripple-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');" aria-label="Xóa sản phẩm"><i class="fas fa-trash-alt me-2"></i>Xóa</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            <?php for ($i = 0; $i < min(count($products) ?: 4, 4); $i++): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4 skeleton" style="display: none;" aria-hidden="true">
                    <div class="card product-card">
                        <div class="card-body">
                            <div class="skeleton-title"></div>
                            <div class="skeleton-text"></div>
                            <div class="skeleton-text"></div>
                            <div class="skeleton-price"></div>
                            <div class="skeleton-actions"></div>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/project1/public/js/scripts.js"></script>
    <script src="/project1/public/js/particles.js"></script>
</body>
</html>