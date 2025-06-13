<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;//add model
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    //
    // FOR MAIN PAGE
    function index()
    {
        // FETCH THE DATA
        $products = product::orderBy('created_at','desc')->get();
        // 
        return view('products.index',['products' => $products]); 
    }
    // WHEN WE CLICK ON CREATE
    function create()
    {
        return view('products.create'); 
    }
    // WHEN WE SUBMIT THE CREATE SUMBIT BUTTON
    function store(Request $request)
    {
        // FORM VALIDATION
        $validator = Validator::make($request->all(),[
            'name'=>'required | min:3',
            'sku'=>'required | unique:products,sku',//unique|table_name|column_name
            'price'=>'required | numeric',
            'status'=>'required',
            // image should be image and accepted type is jpeg,png,jpg and max size is 2mb
            'image'=>'image | mimes:jpeg,png,jpg | max:2048',
        ]);

        if($validator->fails())
        {   
            // if validator fails then
            // redirect():- redirect to this route 
            // withErrors():- to display errors
            // withInput():- do not clear input value if error comes
            return redirect(route('products.create'))->withErrors($validator)->withInput();
        }

        // MODEL:- for db connection
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();//to save the product

        // ADD IMAGE
        if($request->hasFile('image'))//To check that user selected an image or not
        {
            $image = $request->image;//get the image
            $imageName = time().'.'.$image->getClientOriginalExtension();//return the image name with extension (12315.jpg)
            $image->move(public_path('uploads.products'),$imageName);//upload the image in the specified folder with the image name
            $product->image = $imageName;//insert he image 
            $product->save();//update the image
        }

        // with():- after redirection it will display this message
        return redirect(route('products.index'))->with('success','Product created successfully');
        // ...now display this in index.bp
        // if you do not want to use with() so you can also display msgby session()
        // session()->flash('success','Product created successfully');
    }
    
    function edit($id)
    {
        $product = Product::findOrFail($id);//To check that id exist in DB or not
        // ['products'=>$products]:- to use $products in edit.blade.php
        return view('products.edit',['products'=>$product]);
    }
    
    function update($id, Request $request)
    {
        $product = Product::findOrFail($id);//To check that id exist in DB or not
        $oldImage = $product->image; //store the old image
        // FORM VALIDATION
        $validator = Validator::make($request->all(),[
            'name'=>'required | min:3',
            'sku'=>'required | unique:products,sku,'.$id,//it will exclude the current sku to match in the db(we can put the same sku while updating)
            'price'=>'required | numeric',
            'status'=>'required',
            // image should be image and accepted type is jpeg,png,jpg and max size is 2mb
            'image'=>'image | mimes:jpeg,png,jpg | max:2048',
        ]);
    
        if($validator->fails())
        {   
            // if validator fails then
            // redirect():- redirect to this route 
            // withErrors():- to display errors
            // withInput():- do not clear input value if error comes
            return redirect(route('products.edit',$product->id))->withErrors($validator)->withInput();
        }
    
        // MODEL:- for db connection
        // update the existing data
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->save();//to save the product
        
        // ADD IMAGE
        if($request->hasFile('image'))//To check that user selected an image or not
        {
            // delete old image if user update new image
            // if old image is not null and image exists in this location
            if($oldImage != null && File::exists(public_path('uploads.products' .$oldImage)))
            {
                // delete this image
                // use File fascade
                File::delete(public_path('uploads.products' .$oldImage));
            }
            // and upload new image
            $image = $request->image;//get the image
            $imageName = time().'.'.$image->getClientOriginalExtension();//return the image name with extension (12315.jpg)
            $image->move(public_path('uploads.products'),$imageName);//upload the image in the specified folder with the image name
            $product->image = $imageName;//insert he image 
            $product->save();//update the image
        }
        
        // with():- after redirection it will display this message
        return redirect(route('products.index'))->with('success','Product updated successfully');
        // ...now display this in index.bp
        // if you do not want to use with() so you can also display msgby session()
        // session()->flash('success','Product created successfully');
        
    }
    
    function destroy($id)//delete based on id
    {
        $product = Product::findOrFail($id);//To check that id exist in DB or not
        if($product->image != null && File::exists(public_path('uploads/products/' .$product->image)))
        {
            // delete this image
            // use File fascade
            File::delete(public_path('uploads/products/' .$product->image));
        }
        $product->delete();//delete from db
        return redirect(route('products.index'))->with('success','Product deleted successfully');

    }
}
