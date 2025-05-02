<?php require('partials/head.php'); ?>
<?php require('partials/nav.php'); ?>
<?php require('partials/banner.php'); ?>

<div class="container-fluid">
    <div class="row">
        <!-- Billing Address Section -->
        <div class="col-md-6 p-5 border-end">
            <h1 class="text-uppercase mb-5 border-bottom pb-2">Checkout</h1>
            <h4>Billing Address</h4>

            <form action="/order" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="total_price" value="<?= htmlspecialchars($total) ?>">

                <label class="fw-bold mt-3">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="firstname" required>

                <label class="fw-bold mt-3">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="lastname" required>

                <label class="fw-bold mt-3">Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" required>

                <label class="fw-bold mt-3">Township / State <span class="text-danger">*</span></label>
                <select class="form-select" name="city">
                    <option value="ahlone">Ahlone</option>
                    <option value="bahan">Bahan</option>
                    <option value="botataung">Botataung</option>
                    <option value="sanchaung">Sanchaung</option>
                </select>

                <label class="fw-bold mt-3">Address Details</label>
                <textarea name="address" class="form-control" rows="4" required></textarea>

                <div id="onlinePayment" style="display:none;">
                    <label class="fw-bold mt-3">Transaction No <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="transaction_no" id="transaction_no" required>
                </div>


        </div>

        <!-- Total and Payment Section -->
        <div class="col-md-6 p-5 bg-secondary bg-opacity-10">
            <h1 class="text-uppercase mb-5 border-bottom pb-2">Total</h1>
            <h4 class="m-3">Items</h4>
            <ul class="list-group">
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <?= htmlspecialchars($item['product_name']) ?> x <?= htmlspecialchars($item['quantity']) ?>
                            <span><?= htmlspecialchars($item['quantity'] * $item['product_price']) ?> MMK</span>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
                <li class="list-group-item d-flex justify-content-between">
                    Delivery <span>2000 MMK</span>
                </li>
                <li class="list-group-item d-flex justify-content-between fw-bold">
                    Total <span><?= htmlspecialchars($total) ?> MMK</span>
                </li>

                <h4 class="m-3">Pay With</h4>
                <li class="list-group-item bg-light py-3 bg-opacity-10 border-0">
                    <input class="form-check-input align-middle" type="radio" name="paymentType" id="bankTransfer" value="bankTransfer" checked>
                    <label class="form-check-label align-middle" for="bankTransfer">Bank Transfer</label>
                    <p class="bg-secondary bg-opacity-10 p-3 mt-2" id="bankTransferPara">
                        Available Bank Accounts <br>
                        <b>Bank Account - ExchangeHub4U</b><br>
                        1234567890 <br><br>
                        <b>CB Bank Account - ExchangeHub4U</b><br>
                        1234 4321 5678 9876 <br><br>
                        <b>AYA Bank Account - ExchangeHub4U</b><br>
                        9876 5432 1234 4321 <br><br>
                    </p>
                </li>
                <li class="list-group-item bg-light py-3 bg-opacity-10">
                    <input class="form-check-input align-middle" type="radio" name="paymentType" id="cashOnDeli" value="cashOnDeli">
                    <label class="form-check-label align-middle" for="cashOnDeli">Cash on Delivery</label>
                    <p class="bg-secondary bg-opacity-10 p-3 mt-2" id="cashOnDeliPara"><b>To pay cash at the delivery process</b></p>
                </li>
            </ul>
                <div class="d-grid gap-2 mt-3">
                    <input type="hidden" name="cart_id" value="<?= htmlspecialchars($cart_id) ?>">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product_id) ?>">
                    <input type="hidden" name="quantity" value="<?= htmlspecialchars($quantity) ?>">
                    <button class="btn btn-primary py-3 fw-bold" type="submit">Checkout</button>
                </div>
            </form>
        </div>


    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const bankTransferRadio = document.getElementById('bankTransfer');
    const cashOnDeliRadio = document.getElementById('cashOnDeli');
    const bankTransferPara = document.getElementById('bankTransferPara');
    const cashOnDeliPara = document.getElementById('cashOnDeliPara');
    const onlinePayment = document.getElementById('onlinePayment');
    const transactionNo = document.getElementById('transaction_no'); // Transaction number input field

    // Function to update the visibility of payment method details
    function updatePaymentMethod() {
        if (cashOnDeliRadio.checked) {
            bankTransferPara.style.display = 'none';  // Hide bank transfer details
            onlinePayment.style.display = 'none';     // Hide transaction number input
            cashOnDeliPara.style.display = 'block';   // Show cash on delivery info
            transactionNo.removeAttribute('required');  // Remove required attribute for transaction number
        } else {
            bankTransferPara.style.display = 'block'; // Show bank transfer details
            onlinePayment.style.display = 'block';    // Show transaction number input
            cashOnDeliPara.style.display = 'none';    // Hide cash on delivery info
            transactionNo.setAttribute('required', 'required');  // Add required attribute for transaction number
        }
    }

    // Add event listeners for changes in radio button selection
    bankTransferRadio.addEventListener('change', updatePaymentMethod);
    cashOnDeliRadio.addEventListener('change', updatePaymentMethod);

    // Initial call to set the correct display state
    updatePaymentMethod();
});
</script>

<?php require('partials/footer.php'); ?>
