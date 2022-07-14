<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\BaseController as AuthBaseController;
use App\Models\Checkout;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Setting;
use App\Models\State;

class OrderController extends AuthBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $order = Order::all();
        $order_product = OrderProduct::all();
        $checkout = Checkout::all();
        return $this->sendResponse(
            [
                $order,
                $order_product,
                $checkout
            ],
            "All Order Sent"
        );
    }


    public function store(Request $request)
    {
        if ($request->items && $request->checkout) {
            $totalQuanities = 0;
            $totalPrice = 0;
            $subTotalPrice = 0;
            $tax = (float)Setting::where('id', '=', '1')->get()[0]->value;
            $maxWeight = (int)Setting::where('id', '=', '2')->get()[0]->value;
            $state = State::find($request->checkout['state_id']);
            $defaultShipping = $state->default_shipping;
            $extraShipping = $state->extra_shipping;
            foreach ($request->items as $key => $value) {
                $product = Product::where('id', '=', $value['product_id'])->get()[0];
                if ($product->quantity >= $value['quantity']) {
                    $totalQuanities += $value['quantity'];
                    $subTotalPrice += ($product->discount_price ? $product->discount_price : $product->price) * $value['quantity'];
                } else {
                    return $this->sendError('', '');
                }
            }
            $totalPrice = $subTotalPrice;
            $tax = ($totalPrice / 100) * $tax;
            $totalPrice += $tax;

            $shipping = $defaultShipping;
            if ($maxWeight < $totalQuanities)
                $shipping += $extraShipping * ($totalQuanities - $maxWeight);
            $totalPrice += $shipping;

            $order = Order::create([
                'subtotal' => $subTotalPrice,
                'total' => $totalPrice,
                'tax' => $tax,
                'shipping' => $shipping,
                'order_status' => 1
            ]);
            foreach ($request->items as $key => $value) {
                $product = Product::where('id', '=', $value['product_id'])->get()[0];
                if ($product) {
                    OrderProduct::create(
                        [
                            'product_id' => $value['product_id'],
                            'quantity' => $value['quantity'],
                            'order_id' => $order->id,
                            'price' => $product->discount_price ? $product->discount_price : $product->price
                        ]
                    );
                }
                $product->quantity = $product->quantity - $value['quantity'];
                $product->save();
            }
            Checkout::create(
                [
                    'order_id' => $order->id,
                    'first_name' => $request->checkout['first_name'],
                    'last_name' => $request->checkout['last_name'],
                    'email' => $request->checkout['email'],
                    'phone' => $request->checkout['phone'],
                    'address' => $request->checkout['address'],
                    'address2' => $request->checkout['address2'],
                    'country_id' => $request->checkout['country_id'],
                    'state_id' => $request->checkout['state_id'],
                    'city_id' => $request->checkout['city_id'],
                    'zip_code' => $request->checkout['zip_code'],
                    'po_box' => $request->checkout['po_box'],
                ]
            );
            return $this->sendResponse($order, 'Order created successfully');
        }
        return $this->sendError('', '');
    }


    public function show($id)
    {
        $order = Order::find($id)->with('orderproduct')->where('id', '=', $id)->with('checkout')->where('id', '=', $id)->get()[0];

        if (is_null($order)) {
            return $this->sendError('Product not found', "asd");
        }
        return $this->sendResponse($order,  'Order found successfully');
    }


    public function update(Request $request, Order $order)
    {
    }


    public function destroy(Order $order)
    {
    }
}
