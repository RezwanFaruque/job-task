<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Feature;
use App\Models\Category;
use App\Models\CategoryProduct;
use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{



    public function index(){

        $products = Product::with([
            'category',
            'feature'
        ])->orderBy('id','DESC')->get();

        $data = [
            'status' => 'success',
            'data' => $products,
        ];

        return response()->json($data);
    }

    public function storeProduct(Request $request){
        
      
        $request->validate([
            'title' => 'required',
            'categories' => 'required',
            'features' => 'required',
            'image' => 'required|image'
        ]);

        
        return DB::transaction(function() use ($request) {
           
            $features = explode(',',$request->features);
            $categories = explode(',',$request->categories);
    
    
            $product = new Product();
    
            $product->name = $request->title;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
    
                // Generate a unique name for the file
                $imageName = time().'.'.$image->getClientOriginalExtension();
    
                // Save the file to the public/images directory
                $image->move(public_path('images'), $imageName);
    
                $path = '/images/'.$imageName;
    
               $product->image = $path;
            }
    
            $product->save();

            

            foreach ($features as $key => $feature) {
               
                $product->feature()->create([
                    'description' => $feature
                ]);
            }
    
    
            $product->category()->sync($categories);


            $data = [
                'status' => 'success',
                'message' => 'Product saved successfully'
            ];


            return response()->json($data);

        });

    }

    public function editProduct($id){


        $product = Product::with(['category', 'feature'])->find($id);

        if($product){

            $data = [
                'status' => 'success',
                'data' => $product
            ];
        }else{

            $data = [
                'status' => 'error',
                'message' => 'Product not found'
            ];
        }


        return response()->json($data);

    }


    public function getCategory(){

        $categories = Category::all();

        $data = [
            'status' => 'success',
            'data' => $categories,
        ];

        return response()->json($data);

    }


    public function updateProduct(Request $request,$id){


        $product = Product::find($id);

        $data = [];

        if($product){
            $product->name = $request->title;

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imagePath = public_path($product->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
    
                // Generate a unique name for the file
                $imageName = time().'.'.$image->getClientOriginalExtension();
    
                // Save the file to the public/images directory
                $image->move(public_path('images'), $imageName);
    
                $path = '/images/'.$imageName;
    
                $product->image = $path;
            }


            $product->update();


            $data = [
                'status' => 'success',
                'message' => 'Product updated successfully!'
            ];

            return response()->json($data);

        }
    }
}
