<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <h1>Stripe Payment</h1>
    <form id="payment-form" action="{{ route('payment.process') }}" method="POST">
        {{-- @csrf --}}
        <input type="text" id="card-number" placeholder="Card Number" required><br>
        <input type="text" id="card-exp-month" placeholder="MM" required><br>
        <input type="text" id="card-exp-year" placeholder="YY" required><br>
        <input type="text" id="card-cvc" placeholder="CVC" required><br>
        <button type="submit">Pay</button>
    </form>

    <script>
        const stripe = Stripe('{{ env("STRIPE_KEY") }}');
        const form = document.getElementById('payment-form');

        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const {token, error} = await stripe.createToken({
                number: document.getElementById('card-number').value,
                exp_month: document.getElementById('card-exp-month').value,
                exp_year: document.getElementById('card-exp-year').value,
                cvc: document.getElementById('card-cvc').value,
            });

            if (error) {
                alert(error.message);
            } else {
                // Append Stripe token to form and submit
                const tokenInput = document.createElement('input');
                tokenInput.setAttribute('type', 'hidden');
                tokenInput.setAttribute('name', 'stripeToken');
                tokenInput.setAttribute('value', token.id);
                form.appendChild(tokenInput);
                form.submit();
            }
        });
    </script>
</body>
</html>
