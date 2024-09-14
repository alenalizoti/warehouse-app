<?php

namespace App\Services;


use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;
use Illuminate\Http\UploadedFile;
class ProductService {

    public function add_existing_product(Request $request){
        $validator = Validator::make($request->all(),[
            'group_id' => 'required|integer|min:0',
            'quantity' => 'required|integer|min:0'
        ]);

        if ($validator->fails()){
            return ['success' => false, 'errors' => $validator->errors()->toArray()];
        }

        $group_id = $request->group_id;
        $group = Group::find($group_id);
        $group->quantity += $request->quantity;
        $group->save();

        $existingProduct = Product::where('group_id',$group_id)->first();

        for($i=0; $i < $request->quantity; $i++){
            $product = new Product();
            $product->name = $existingProduct->name;
            $product->price = $existingProduct->price;
            $product->description = $existingProduct->description;
            $product->image = $existingProduct->image;
            $product->group_id = $group->id;
            $product->barcode = Str::random(9);

            $product->save();
        }

        return ['success' => true];
    }
    public function new_product(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|max:2048',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0'
        ],[
            'name.required' => 'Product Name is required.',
            'name.string' => 'Product Name must be a string.',
            'name.max' => 'Product Name must not exceed 255 characters.',
            'price.required' => 'Product Price is required.',
            'price.numeric' => 'Product Price must be a number.',
            'price.min' => 'Product Price must be at least 0.',
            'quantity.required' => 'Product Quantity is required.',
            'quantity.integer' => 'Product Quantity must be an integer.',
            'quantity.min' => 'Product Quantity must be at least 0.'
        ]);
    
    
        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()->toArray()];
        }
    

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $ext = $image->getClientOriginalExtension();
            $name = Str::slug($request->name);
            $imageName = $name . '_' . time() . '.' . $ext;
            $imagePath = $image->storeAs('/images', $imageName); 

            $location = public_path('/images');
            $image->move($location, $imageName);
        }
    
        
        $group = new Group();
        $group->model = $request->name;
        $group->quantity = $request->quantity;
        $group->save();

        for ($i = 0; $i < $request->quantity; $i++) {
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->image = $imagePath; 
            $product->group_id = $group->id;
            $product->barcode = Str::random(9);
            $product->save();
        }


        return ['success' => true, 'product' => $product];
    }
    public function packProduct($id, $quantity) {
        $product = Product::find($id);

        if ($quantity > $product->group->quantity) {
            return false; 
        }

        $product->group->quantity -= $quantity;
        $product->group->save();

        Product::destroy($id);

        if ($product->group->quantity === 0) {
            $product->group->delete();
        }

        for ($i = 1; $i < $quantity; $i++) {
            $nextProduct = Product::where('group_id', $product->group_id)->first();
    
            if ($nextProduct) {
                Product::destroy($nextProduct->id);
            } else {
                break; 
            }
        }

        return true;
    }
}