<form action="{{ route('payment.process') }}" method="POST">
    @csrf
    <div>
        <label for="amount">Amount</label>
        <input type="number" name="amount" id="amount" value="100" required>
    </div>

    <div>
        <label for="token">Stripe Token</label>
        <input type="text" name="token" id="token" required>
    </div>

    <div>
        <label for="payment_method">Payment Method</label>
        <select name="payment_method" id="payment_method" required>
            <option value="credit_card">Credit Card</option>
            <option value="paypal">PayPal</option>
            <option value="bank_transfer">Bank Transfer</option>
        </select>
    </div>

    <div>
        <label for="country">Country</label>
        <input type="text" name="country" id="country" required>
    </div>

    <div>
        <label for="address">Address</label>
        <textarea name="address" id="address" required></textarea>
    </div>

    <button type="submit">Pay Now</button>
</form>
