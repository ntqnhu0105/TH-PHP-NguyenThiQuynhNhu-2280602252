document.addEventListener('DOMContentLoaded', () => {
    // Ripple effect for buttons (shared across List, Add, Edit)
    document.querySelectorAll('.ripple-btn').forEach(btn => {
        btn.addEventListener('click', function(e) {
            const ripple = document.createElement('span');
            ripple.classList.add('ripple');
            const rect = btn.getBoundingClientRect();
            const size = Math.max(rect.width, rect.height);
            ripple.style.width = ripple.style.height = `${size}px`;
            ripple.style.left = `${e.clientX - rect.left - size / 2}px`;
            ripple.style.top = `${e.clientY - rect.top - size / 2}px`;
            btn.appendChild(ripple);
            setTimeout(() => ripple.remove(), 600);
        });
    });

    // Skeleton loading for Product Listing page
    const productList = document.querySelector('#productList');
    if (productList) {
        const skeletons = productList.querySelectorAll('.skeleton');
        const products = productList.querySelectorAll('.product-card:not(.skeleton .product-card)');
        const noProducts = productList.querySelector('.text-muted');
        if (products.length > 0 || noProducts) {
            if (products.length > 0) {
                products.forEach(product => product.style.display = 'none');
            }
            if (noProducts) {
                noProducts.parentElement.style.display = 'none';
            }
            skeletons.forEach(skeleton => skeleton.style.display = 'block');
            setTimeout(() => {
                skeletons.forEach(skeleton => {
                    skeleton.style.opacity = '0';
                    setTimeout(() => skeleton.style.display = 'none', 300);
                });
                if (products.length > 0) {
                    products.forEach(product => product.style.display = 'block');
                }
                if (noProducts) {
                    noProducts.parentElement.style.display = 'block';
                }
            }, 1500);
        }
    }

    // Form validation and submission for Add/Edit pages
    const form = document.querySelector('#addProductForm, #editProductForm');
    if (form) {
        const nameInput = form.querySelector('#name');
        const priceInput = form.querySelector('#price');
        const descriptionInput = form.querySelector('#description');

        function validateName() {
            const value = nameInput.value;
            const valid = value.length >= 10 && value.length <= 100;
            nameInput.nextElementSibling.nextElementSibling.style.display = valid ? 'block' : 'none';
            nameInput.nextElementSibling.nextElementSibling.nextElementSibling.style.display = valid ? 'none' : 'block';
            return valid;
        }

        function validatePrice() {
            const value = parseFloat(priceInput.value);
            const valid = value > 0 && !isNaN(value);
            priceInput.nextElementSibling.nextElementSibling.style.display = valid ? 'block' : 'none';
            priceInput.nextElementSibling.nextElementSibling.nextElementSibling.style.display = valid ? 'none' : 'block';
            return valid;
        }

        function validateDescription() {
            const valid = descriptionInput.value.length > 0;
            descriptionInput.nextElementSibling.nextElementSibling.style.display = valid ? 'block' : 'none';
            return valid;
        }

        // Initial validation for Edit page pre-filled values
        validateName();
        validatePrice();
        validateDescription();

        nameInput.addEventListener('input', validateName);
        priceInput.addEventListener('input', validatePrice);
        descriptionInput.addEventListener('input', validateDescription);

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (!validateName() || !validatePrice() || !validateDescription()) {
                const alert = document.createElement('div');
                alert.className = 'alert alert-danger shake';
                alert.innerHTML = '<i class="fas fa-exclamation-circle me-2"></i>Vui lòng kiểm tra các trường nhập.';
                form.parentElement.insertBefore(alert, form);
                setTimeout(() => alert.remove(), 3000);
                return;
            }

            const submitBtn = form.querySelector('button[type="submit"]');
            const spinner = submitBtn.querySelector('.spinner');
            const icon = submitBtn.querySelector('.fas.fa-plus, .fas.fa-save');
            const check = submitBtn.querySelector('.success-check');
            const progressBar = form.querySelector('.progress-bar');
            const progressFill = form.querySelector('.progress-fill');

            submitBtn.setAttribute('aria-busy', 'true');
            submitBtn.disabled = true;
            spinner.style.display = 'inline-block';
            icon.style.display = 'none';
            progressBar.style.display = 'block';
            progressFill.style.width = '0%';

            // Simulate async submission
            let progress = 0;
            const interval = setInterval(() => {
                progress += 20;
                progressFill.style.width = `${progress}%`;
                if (progress >= 100) {
                    clearInterval(interval);
                    spinner.style.display = 'none';
                    check.style.display = 'inline-block';
                    progressBar.style.display = 'none';
                    submitBtn.setAttribute('aria-busy', 'false');
                    submitBtn.disabled = false;
                    setTimeout(() => {
                        check.style.display = 'none';
                        icon.style.display = 'inline-block';
                        form.submit(); // Actual submission
                    }, 1500);
                }
            }, 300);
        });

        // Conditional tooltip toggle with accessibility
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', () => {
                const tooltip = input.nextElementSibling.nextElementSibling.nextElementSibling;
                if (!tooltip) return;
                let showTooltip = false;
                if (input.id === 'name' && (input.value === '' || input.value.length < 10 || input.value.length > 100)) {
                    showTooltip = true;
                } else if (input.id === 'price' && (input.value === '' || parseFloat(input.value) <= 0 || isNaN(parseFloat(input.value)))) {
                    showTooltip = true;
                } else if (input.id === 'description' && input.value === '') {
                    showTooltip = true;
                }
                if (showTooltip) {
                    tooltip.style.display = 'block';
                    input.setAttribute('aria-describedby', tooltip.id);
                }
            });
            input.addEventListener('blur', () => {
                const tooltip = input.nextElementSibling.nextElementSibling.nextElementSibling;
                if (tooltip) {
                    tooltip.style.display = 'none';
                    input.removeAttribute('aria-describedby');
                }
            });
            input.addEventListener('input', () => {
                const tooltip = input.nextElementSibling.nextElementSibling.nextElementSibling;
                if (!tooltip) return;
                if (input.id === 'name' && input.value.length >= 10 && input.value.length <= 100) {
                    tooltip.style.display = 'none';
                    input.removeAttribute('aria-describedby');
                } else if (input.id === 'price' && parseFloat(input.value) > 0 && !isNaN(parseFloat(input.value))) {
                    tooltip.style.display = 'none';
                    input.removeAttribute('aria-describedby');
                } else if (input.id === 'description' && input.value !== '') {
                    tooltip.style.display = 'none';
                    input.removeAttribute('aria-describedby');
                }
            });
        });
    }
});