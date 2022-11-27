<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;

use Stripe;
use Session;
use Exception;


class ProductController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $product = Product::get();
        return view("product", compact("product"));
    }  
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function show(Product $product, Request $request)
    {
        $intent = auth()->user()->createSetupIntent();
        return view("subscription", compact("product", "intent"));
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscription(Request $request)
    { 
      $plan = Product::find($request->plan);
     //   $subscription = $request->user()->newSubscription($request->plan, $plan->stripe_plan)
     //                   ->create($request->token);

     $product_info = json_decode($request->plan_details,0);
    //  dd($request);
     Stripe\Stripe::setApiKey("sk_test_51M8dkASFhH8uiGdB9IlZaR8B3PYYFTHkLVcLiUVLKJhT9ioE628ZO1YSlM8SIedLdsPARoUFX5jUe3asthUvoSYZ005ecV4eGH");

  Stripe\Charge::create ([
        "customer" =>$request->name,
        "amount" => $product_info->price,
        "currency" => "inr",
        "source" => $request->token,
        "description" => "Test payment" ,
  ]);

    return view("subscription_success");
     
       
    }



}