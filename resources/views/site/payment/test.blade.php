@extends('site.layouts.app')
@section('content')
<div id="paypal-button-container"></div>
@endsection
@section('js')
<script
    src="https://www.paypal.com/sdk/js?client-id=Abcvr7C4PGUYGc1whnO1X-uPYRaYNmspV_0qoC-MLxRkwmbvr_QAsuqUN23CZkP27GMFglkS5oBBEWOL&disable-funding=credit,card">
</script>
<script>
    window.onload = function(){
        paypal.Buttons({
            createOrder: function(data, actions) {
                // This function sets up the details of the transaction, including the amount and line item details.
                return actions.order.create({
                    application_context: {
                        brand_name: 'Laravel Book Store Demo Paypal App',
                        user_action: 'PAY_NOW',
                    },
                    purchase_units: [{
                        amount: {
                            value: '0.50'
                        }
                    }],
                });
            },

            onApprove: function(data, actions) {

                let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                // This function captures the funds from the transaction.
                return actions.order.capture().then(function(details) {
                    console.log(details, details.status == "COMPLETED")
                    if (details.status == "COMPLETED") {
                        // handel payment here
                    } else {
                        window.location.href = '/failed?reason=failedToCapture';
                    }
                });
            },

            onCancel: function(data) {
                window.location.href = '/failed?reason=userCancelled';
            }
        }).render('#paypal-button-container');
        // This function displays Smart Payment Buttons on your web page.

        function status(res) {
            if (!res.ok) {
                throw new Error(res.statusText);
            }
            return res;
        }
    }
</script>
@endsection
