<?php

namespace App\Http\Controllers;

use App\Data\MpesaCallback;
use App\SmsRate;
use App\SmsTopup;
use App\SmsUnit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Safaricom\Mpesa\Mpesa;

class PaymentController extends Controller
{
    //
    public function formatPhone($phone)
    {
        if ($phone[0] == '0') {
            $phone = preg_replace("/^0/", "254", $phone);
        }

        return $phone;
    }

    public function push($phone, $amount)
    {
        // for now we add placeholder for calculating units based on the amount paid...
        $mpesa = new MPesa();
        $BusinessShortCode = "174379";
        $LipaNaMpesaPasskey = "bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919";
        $TransactionType = "CustomerPayBillOnline";
        $Amount = "1";
        $PartyA = $this->formatPhone($phone); // sending the funds
        $PartyB = "174379"; // receiving the funds, similar to bs shortcode
        $PhoneNumber = $this->formatPhone($phone);
        $CallBackURL = "https://pamoja.solutechlabs.com/payment-response";
        $AccountReference = "1837J6ek74";
        $TransactionDesc = "Test Transaction";
        $Remarks = "N/A";

        $stkPushSimulation = $mpesa->STKPushSimulation(
            $BusinessShortCode,
            $LipaNaMpesaPasskey,
            $TransactionType,
            $Amount,
            $PartyA,
            $PartyB,
            $PhoneNumber,
            $CallBackURL,
            $AccountReference,
            $TransactionDesc,
            $Remarks
        );

        return $stkPushSimulation;

    }

    public function paymentStatus(Request $request)
    {
        $requestID = $request->get('checkoutRequestID');

        $recharge = $request->get('recharge');

        $response = MpesaCallback::where('checkout_request_id', $requestID)->first();

        if (!$response) {
            return response()->json([
                'message' => 'Transaction not found',
                'data' => [],
                'status' => Response::HTTP_NOT_FOUND
            ]);
        }

        $body = json_decode($response->checkout_request_body);

        if ($recharge == "true") {
            $amountVals = ($body->Body->stkCallback->CallbackMetadata->Item[0]);
            $amount = $amountVals->Value;
            return $this->updateSmsUnits($amount, $requestID);
        }

        return response()->json([
            'message' => 'Transaction found',
            'data' => $body,
            'status' => Response::HTTP_OK
        ]);

    }

    public function updateSmsUnits($amount = null, $requestId = null)
    {
        //

        $updated = false;

        $rate = 1;

        $utilized = SmsTopup::where('checkout_request_id', $requestId)->first();

        $church_rate = SmsRate::where('church_id', auth()->user()->church_id)->first();

        if ($church_rate) {
            $rate = $church_rate->rate;
        }

        $units = $amount / $rate;

        if (!$utilized) {
            SmsTopup::create([
                'checkout_request_id' => $requestId,
                'amount' => $amount,
                'units' => $units,
                'church_id' => auth()->user()->church_id
            ]);

            // update units in units table...

            $data = [
                'church_id' => auth()->user()->church_id,
                'units' => $units
            ];

            $exists = SmsUnit::where('church_id', auth()->user()->church_id)->first();

            if (!$exists) {
                return SmsUnit::create($data);
            }

            $exists->units = $exists->units + $units;

            $exists->update();

            $updated = true;
        }

        return response()->json([
            'message' => 'Request processed successfully',
            'status' => $updated,
        ]);

    }
}
