<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService) {
        $this->productService = $productService;
    }
    public function index(){

        $groups = Group::all();

        $products = $groups->map(function ($group) {
            return [
                'group' => $group,
                'product' => $group->products()->first() 
            ];
        });

        return view('products', compact('products'));

    }
    public function product($id){
        $product = Product::find($id);
        return view('product',['product' => $product]);
    }

    public function search_product(Request $request){

        $barcode = $request->barcode;

        if ($barcode) {
            $product = Product::where('barcode', $barcode)->first();

            if ($product) {
                return view('products', ['product' => $product]);
            } else {
                return redirect()->back()->with('error', 'Product not found for the given barcode.');
            }
        } else {
            return redirect()->back()->with('error', 'Barcode cant be empty!');
        }
    }

    public function pack_product($id, Request $request) {
        $packQuantity = $request->quantity;

        $result = $this->productService->packProduct($id, $packQuantity);

        if (!$result) {
            session()->flash('error', 'The packing quantity exceeds the available quantity.');
            return redirect()->back();
        }

        return redirect(route('products'));
    }

    public function add_product(){
        return view('warehouse');
    }


    public function create_product(){
        return view('add_product');
    }

    public function new_product(Request $request){

        $response = $this->productService->new_product($request);

        if ($response['success']) {
            return redirect()->route('products')->with('success', 'Product created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create product.')->withErrors($response['errors'])->withInput();
        }
    }

    public function existing_product(){
        $groups = Group::all();
        return view('existing_product',compact('groups'));
    }

    public function add_existing_product(Request $request){
        $response = $this->productService->add_existing_product($request);
        if($response['success']){
            return redirect()->route('add.product')->with('success','Product edited successfully!');
        }else{
            return redirect()->back()->with('error','Failed to add quantity!')->withErrors($response['errors'])->withInput();
        }
    }
}
