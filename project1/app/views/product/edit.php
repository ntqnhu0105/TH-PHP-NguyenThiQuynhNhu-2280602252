<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="/project1/public/css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Sửa sản phẩm</h1>
            <a href="/project1/Product/list" class="btn btn-secondary ripple-btn"><i class="fas fa-arrow-left me-2"></i>Quay lại danh sách</a>
        </div>
        <?php if (!empty($errors)): ?>
            <div class="alert alert-danger shake" role="alert" aria-live="assertive">
                <ul class="mb-0">
                    <?php foreach ($errors as $error): ?>
                        <li><i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="card form-card">
            <div class="card-body">
                <form method="post" action="/project1/Product/edit/<?php echo $product->getID(); ?>" id="editProductForm">
                    <div class="mb-4 position-relative">
                        <label for="name" class="form-label"><i class="fas fa-tag me-2"></i>Tên sản phẩm</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($product->getName(), ENT_QUOTES, 'UTF-8'); ?>" required aria-describedby="nameTooltip">
                        <span class="underline"></span>
                        <i class="fas fa-check-circle validation-icon valid" style="display: none;"></i>
                        <i class="fas fa-exclamation-circle validation-icon invalid" style="display: none;"></i>
                        <div class="tooltip-custom" id="nameTooltip">Tên sản phẩm từ 10 đến 100 ký tự.</div>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="description" class="form-label"><i class="fas fa-align-left me-2"></i>Mô tả</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required aria-describedby="descTooltip"><?php echo htmlspecialchars($product->getDescription(), ENT_QUOTES, 'UTF-8'); ?></textarea>
                        <span class="underline"></span>
                        <i class="fas fa-check-circle validation-icon valid" style="display: none;"></i>
                        <div class="tooltip-custom" id="descTooltip">Mô tả chi tiết sản phẩm.</div>
                    </div>
                    <div class="mb-4 position-relative">
                        <label for="price" class="form-label"><i class="fas fa-dollar-sign me-2"></i>Giá (VND)</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?php echo htmlspecialchars($product->getPrice(), ENT_QUOTES, 'UTF-8'); ?>" step="0.01" required aria-describedby="priceTooltip">
                        <span class="underline"></span>
                        <i class="fas fa-check-circle validation-icon valid" style="display: none;"></i>
                        <i class="fas fa-exclamation-circle validation-icon invalid" style="display: none;"></i>
                        <div class="tooltip-custom" id="priceTooltip">Giá phải lớn hơn 0.</div>
                    </div>
                    <div class="mb-4">
                        <div class="progress-bar" style="display: none;">
                            <div class="progress-fill"></div>
                        </div>
                    </div>
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="submit" class="btn btn-primary ripple-btn" aria-label="Lưu thay đổi">
                            <span class="spinner"></span>
                            <i class="fas fa-save me-2 spin-icon"></i>
                            <i class="fas fa-check success-check"></i>
                            Lưu thay đổi
                        </button>
                        <a href="/project1/Product/list" class="btn btn-secondary ripple-btn"><i class="fas fa-arrow-left me-2"></i>Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/project1/public/js/scripts.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<div id="particles-js" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -2;"></div>
    <script src="/project1/public/js/particles.js"></script>
</body>
</html>