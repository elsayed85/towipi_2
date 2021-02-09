<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment\Payment;
use Illuminate\Http\Request;
use DataTables;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:payments-read'])->only('index');
    }

    public function index(Request $request)
    {
        $payments = Payment::with(['order', 'user'])->latest()->paginate(10);
        return view('admin.payments.index', get_defined_vars());
    }

    public function show(Payment $payment)
    {
        $payment->load(['order.user']);
        return view('admin.payments.show',  get_defined_vars());
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();
        return back()->withSuccess('Payment deleted succfully');
    }
}
