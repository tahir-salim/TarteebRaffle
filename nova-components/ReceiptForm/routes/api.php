<?php

use App\Libraries\NexmoLibrary;
use App\Mail\AddReceipt;
use App\Models\Customer;
use App\Models\Receipt;
use App\Models\Setting;
use App\Services\CountryService;
use App\Services\ShopService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
 */

Route::get('/init', function (Request $request, ShopService $shopService, CountryService $countryService) {
    $minPurchaseAmount = Setting::minReceiptAmount()
        ->first();

    if ($minPurchaseAmount) {
        $minPurchaseAmount = $minPurchaseAmount->value;
    }
    return [
        'shops' => $shopService->getCachedShops(),
        'countries' => $countryService->getCachedCountries(),
        'minAmount' => $minPurchaseAmount,
    ];
});

Route::post('/customer', function (Request $request) {
    $request->validate([
        'phone' => 'required|string',
    ]);
    $customer = Customer::where('phone', $request->phone)
        ->withCount(['receipts'])
        ->first();
    if ($customer) {
        $customer->raffle_entries_count = floor($customer->receipts()->sum('amount') / 100);
    }
    return [
        'data' => $customer,
    ];
});

Route::post('/create-receipt', function (Request $request) {
    $request->validate([
        'phone' => 'required|string',
        'country_id' => 'required|int',
        'nationality' => 'required_without:customer_id',
        'customer_id' => 'required_without:name',
        'name' => 'required_without:customer_id',
        'cpr' => 'required_without:customer_id',
        'email' => 'nullable|email',
        'receipts' => 'required|array',
        'receipts.*.shop_id' => 'required|int',
        'receipts.*.receipt_number' => 'required',
        'receipts.*.purchase_date' => 'required',
        'receipts.*.amount' => 'required',
    ]);

    $minPurchaseAmount = Setting::minReceiptAmount()
        ->first();

    if ($minPurchaseAmount) {
        $minPurchaseAmount = $minPurchaseAmount->value;
    }

    $uniqueReceipts = collect([]);
    foreach ($request->receipts as $re) {
        if ($minPurchaseAmount > $re['amount']) {
            return ['status' => 'error', 'message' => 'Amount should be greater than ' . $minPurchaseAmount];
        }

        if ($uniqueReceipts->where('receipt_number', $re['receipt_number'])->where('shop_id', $re['shop_id'])->count()) {
            return ['status' => 'error', 'message' => 'Receipt should be unique per shop'];
        }

        if (Receipt::where('receipt_number', $re['receipt_number'])->where('shop_id', $re['shop_id'])->count()) {
            return ['status' => 'error', 'message' => 'Receipt already exists'];
        }

        $uniqueReceipts->push($re);
    }

    if (!$request->customer_id) {
        $customer = Customer::where('phone', $request->phone)->first();
        if (!$customer) {
            $customer = new Customer();
            $customer->name = $request->name;
            $customer->cpr = $request->cpr;
            $customer->phone = $request->phone;
            $customer->country_id = $request->country_id;
            $customer->nationality = $request->nationality;
            $customer->email = $request->email;
            $customer->save();
        }
        $request->customer_id = $customer->id;
    } else {
        $customer = Customer::find($request->customer_id);
    }
    foreach ($request->receipts as $re) {
        $receipt = new Receipt();
        $receipt->customer_id = $request->customer_id;
        $receipt->shop_id = $re['shop_id'];
        $receipt->receipt_number = $re['receipt_number'];
        $receipt->purchase_date = $re['purchase_date'];
        $receipt->amount = $re['amount'];
        $receipt->created_by_user_id = Auth::id();
        $receipt->save();
    }

    $minEntryAmount = optional(Setting::minEntryAmount()->first())->value ?? 1;

    $totalAmount = (int) Receipt::where('customer_id', $request->customer_id)->sum('amount');
    $entiesCount = (int) ($totalAmount / $minEntryAmount);

    if ($request->email && config('app.allow_email_in_receipt')) {
        Mail::to($request->email)->send(new AddReceipt($customer, $totalAmount, $entiesCount));
    }

    if (config('app.allow_sms_in_receipt')) {
        NexmoLibrary::sendMessage(
            $request->phone,
            'Thank you for shopping with Manama Gold. Your total amount is BD ' . $totalAmount . ' with ' . $entiesCount . ' chance(s) to enter the weekly draw.',
            $request->customer_id
        );
    }
    // return ['status' => 'error', 'data' => $receipt];
    return ['status' => 'success', 'data' => $receipt];
});
