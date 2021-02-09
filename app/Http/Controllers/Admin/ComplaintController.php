<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:complaints-read'])->only(['index']);
    }

    public function index()
    {
        $complaints = Complaint::latest()->with(['product'])->paginate(10);
        return view('admin.products.complaints.index', get_defined_vars());
    }
}
