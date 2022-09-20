@extends('layouts.app')
@section('content')
    <!-- import CSS -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="page-hero page-container " id="page-hero">
                    <div class="padding d-flex">
                        <div class="page-title">
                            <h2 class="text-muted">
                                Buy Sms Units
                            </h2>

                            <div id="payment_progress" class="p-2">

                            </div>
                        </div>
                    </div>
                    <div class="page-content page-container" id="page-content">
                        <div class="padding m-t-40">
                            <form action="{{route('recharge')}}" method="post" id="recharge_units_form">
                                <label for="" class="col-md-3">Amount (KES)</label>
                                <div class="col-md-9 form-group row">
                                    <input type="text" class="form-control" required name="amount">
                                </div>
                                <label for="" class="col-md-3">Phone Number</label>
                                <div class="col-md-9 form-group row">
                                    <input type="text" class="form-control" value="{{auth()->user()->phone_number}}"
                                           name="phone_number">
                                </div>
                                <label for="" class="col-md-3">
                                    {{csrf_field()}}
                                </label>
                                <div class="col-md-9 form-group row">
                                    <button class="btn btn-primary recharge_sms_button" type="submit">Pay Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $("#recharge_units_form").on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    type: 'post',
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: $(this).serialize(),
                    success: function (msg) {
                        msg = JSON.parse(msg)
                        let checkoutRequestID = msg.CheckoutRequestID;
                        let responseCode = msg.ResponseCode;
                        if (responseCode === "0") {
                            // request sent to customer phone...
                            $("#payment_progress").html("We have sent a notification to your phone. Please enter your pin to pay.").removeClass('alert alert-danger').addClass('alert alert-success')
                            $(".recharge_sms_button").attr('disabled', 'disabled');
                            // check the status of this payment request after few seconds...
                            let timer = setInterval(function () {
                                $("#payment_progress").html('Checking payment status...').addClass('alert alert-warning').removeClass('alert-danger alert-success')
                                $.ajax({
                                    type: 'post',
                                    url: "{{route('payment-status')}}",
                                    data: {
                                        'checkoutRequestID': checkoutRequestID,
                                        'recharge': "false"
                                    },
                                    success: function (msg) {
                                        try {
                                            // msg = JSON.parse(msg);
                                            if (msg.data.Body.stkCallback.CheckoutRequestID === checkoutRequestID && msg.data.Body.stkCallback.ResultCode === 0) {
                                                $("#payment_progress").html("Updating your sms units...").addClass('alert alert-warning').removeClass('alert-success').removeClass('alert-danger')
                                                $.ajax({
                                                    type: 'POST',
                                                    url: "{{route('payment-status')}}",
                                                    data: {
                                                        'checkoutRequestID': checkoutRequestID,
                                                        'recharge': "true"
                                                    },
                                                    success: function (msg) {
                                                        if (msg.status === true) {
                                                            $("#payment_progress").html("Your sms units have been updated!").addClass('alert alert-success').removeClass('alert-warning')
                                                            $(".recharge_sms_button").removeAttr('disabled')
                                                            clearInterval(timer)
                                                        } else {
                                                            $(".recharge_sms_button").removeAttr('disabled')
                                                            $("#payment_progress").html("There was a problem updating your sms units. Please contact support with ID " + checkoutRequestID).addClass('alert alert-danger').removeClass('alert-warning')
                                                        }
                                                    },
                                                    error: function (err) {

                                                    }
                                                })
                                            } else {
                                                $("#payment_progress").html("Whoops! Something went wrong! Please contact support with this ID " + checkoutRequestID).addClass('alert alert-danger').removeClass('alert-success')
                                            }
                                        } catch (e) {

                                        }

                                    },
                                    error: function (err) {
                                        console.log(err)
                                    }
                                })
                            }, 2000);
                        } else {
                            $("#payment_progress").html(msg.errorMessage).addClass('alert alert-danger').removeClass('alert alert-success')
                        }
                    },
                    error: function (err) {

                    }
                })
            });
        });

        function toggleTime(val) {
            if (val === "now") {
                $("#timePicker").addClass('hidden')
            } else {
                $("#timePicker").removeClass('hidden')
            }
        }

        function addCustomProperty(val) {
            let text = $('#messageField').val();
            text += " {" + val + "}";
            $('#messageField').val(text);
        }
    </script>
@endsection