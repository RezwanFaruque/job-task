<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    

    public function deleteCategory($id){

        $category = Category::find($id);

        $data = [];
        
        if($category){

            $products = $category->products;

            foreach ($products as $product) {

                $product->feature()->delete();
                $product->category()->detach();
                $product->delete();
            }

            $category->delete();

            $data = [
                'status' => 'success',
                'message' => 'Category and product deleted successfully!'
            ];
        }else{

            $data = [
                'status' => 'error',
                'message' => 'Category not found!'
            ];
        }


        return response()->json($data);
    }


}
