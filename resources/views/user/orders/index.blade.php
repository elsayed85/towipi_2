@extends('site.layouts.app')

@section('content')
<section class="user-profile user-orders mt-5">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-3">
                @include('user.partials.sidebar')
            </div>
            <div class="col-12 col-md-8">
                <div class="p-3 border rounded">
                    <div class="mb-4 border-bottom pb-3">
                        <span class="d-flex align-items-center justify-content-between flex-wrap">
                            <span>Purchasing date: Jan 20, 2021</span>
                            <span>payment method: PayPal</span>
                        </span>
                        <span class="d-flex align-items-center justify-content-between flex-wrap">
                            <span>Order number:#125636</span>
                            <span>Total: EGP 380</span>
                        </span>
                    </div>
                    <ul class="list-unstyled steps-process d-flex align-items-center justify-content-between flex-wrap">
                        <li class="finished-step">
                            <span>
                                1
                            </span>
                            <br>
                            Order
                            placed
                        </li>
                        <li class="finished-step">
                            <span>
                                2
                            </span>
                            <br>
                            Confirmed
                        </li>
                        <li class="finished-step">
                            <span>
                                3
                            </span>
                            <br>
                            Ready for shipping
                        </li>
                        <li>
                            <span>
                                4
                            </span>
                            <br>
                            Shipped
                        </li>
                        <li>
                            <span>
                                5
                            </span>
                            <br>
                            Delivered
                        </li>
                    </ul>

                    <div class="table-responsive">
                        <table class="table table-borderless cart-items-list">
                            <thead>
                                <tr>
                                    <th scope="col"> Photo</th>
                                    <th scope="col">Details</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="product-photo">
                                            <img src="{{ asset('img/cart/thumbinal.png') }}" alt="dummy">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-details">
                                            <h6 class="font-12 text-capitalize main-color font-weight-bold">
                                                Mickey and Minnie mouse cupcake <br> topper and wrapper
                                            </h6>
                                            <form action="">
                                                <label class="mb-0">Rate this product:</label>
                                                <select name="rate" id="rate" class="form-control mb-2 mt-2">
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Star</option>
                                                    <option value="3">3 Star</option>
                                                    <option value="4">4 Star</option>
                                                    <option value="5">5 Star</option>
                                                </select>
                                                <div class="form-group">
                                                    <textarea class="form-control  " id="note" rows="2"></textarea>
                                                </div>
                                                <button class="btn btn-sm btn-danger font-11 rounded-pill">Rate</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions ">
                                            <a href="#" class="mb-1 btn btn-sm btn-secondary font-10 rounded-pill mr-2">
                                                FILE A COMPLAINT
                                            </a>
                                            <br>
                                            <a href="#" class=" btn btn-sm btn-secondary font-10 rounded-pill">
                                                RETURN ITEM
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="product-photo">
                                            <img src="{{ asset('img/cart/thumbinal.png') }}" alt="dummy">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="product-details">
                                            <h6 class="font-12 text-capitalize main-color font-weight-bold">
                                                Mickey and Minnie mouse cupcake <br> topper and wrapper
                                            </h6>
                                            <form action="">
                                                <label class="mb-0">Rate this product:</label>
                                                <select name="rate" id="rate" class="form-control mb-2 mt-2">
                                                    <option value="1">1 Star</option>
                                                    <option value="2">2 Star</option>
                                                    <option value="3">3 Star</option>
                                                    <option value="4">4 Star</option>
                                                    <option value="5">5 Star</option>
                                                </select>
                                                <div class="form-group">
                                                    <textarea class="form-control  " id="note" rows="2"></textarea>
                                                </div>
                                                <button class="btn btn-sm btn-danger font-11 rounded-pill">Rate</button>
                                            </form>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions ">
                                            <a href="#" class="mb-1 btn btn-sm btn-secondary font-10 rounded-pill mr-2">
                                                FILE A COMPLAINT
                                            </a>
                                            <br>
                                            <a href="#" class=" btn btn-sm btn-secondary font-10 rounded-pill">
                                                RETURN ITEM
                                            </a>
                                        </div>
                                    </td>
                                </tr>



                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
