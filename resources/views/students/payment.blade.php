<!DOCTYPE html>
<html>
<head>
    <title>Stripe Payment</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form id="payment-form">
        <div id="card-element">
            <!-- بطاقة الدفع ستظهر هنا -->
        </div>
        <button type="submit">Pay</button>
    </form>

    <script>
        var stripe = Stripe('pk_test_51PFwYcEWuyFumFN8CuqDZh6dW2iZBG9PoV4rAHcfuUT63jLNurngeclmNZ2oDZ7fsQWqCYA0E31h05LyXgA5J9xw00y9AAjPWR'); // استخدم المفتاح العام الخاص بـ Stripe
        var clientSecret = '{{ $clientSecret }}'; // العميل السري الذي حصلت عليه من الخادم

        var elements = stripe.elements();
        var card = elements.create('card');
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.confirmCardPayment(clientSecret, {
                payment_method: {
                    card: card,
                    billing_details: {
                        name: 'Customer Name' // يمكنك الحصول على الاسم من النموذج الخاص بك
                    }
                }
            }).then(function(result) {
                if (result.error) {
                    // عرض الخطأ للمستخدم
                    console.error('Payment error:', result.error.message);
                } else {
                    // إذا كان الدفع ناجحًا، إعادة توجيه المستخدم
                    if (result.paymentIntent.status === 'succeeded') {
                        window.location.href = '{{ $successUrl }}';
                    }
                }
            });
        });
    </script>
</body>
</html>
