<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{

  public function index(){
    $products = Product::with('categories')->get();
    return $products;
  }

  public function show($id){
    $product = Product::with('categories')->where('id', '=', $id)->firstOrFail();
    return $product;
  }

  public function store(Request $request){
    try {
      $product = new Product;
      $product->title = $request->input('title');
  
      $product->categories()->associate(Category::find($request->input('category')));
      $product->save();

      return $product;

    } catch (\Throwable $th) {
      throw $th;
    }

  }

  public function update(Request $request){
    try {
      $product = Product::findOrFail( $request->id);
      $product->title = $request->input('title');

      $product->categories()->associate(Category::find($request->input('category')));
      $product->save();
    
      return $product;

    } catch (\Throwable $th) {
      throw ValidationException::withMessages(["errors" => "Erro ao deletar registro, verifique e tente novamente!"]);
    }
  }

  public function destroy($id){
    try {
      $product = Product::findOrFail($id);
      if($product->delete()){
        $products = Product::with('categories')->get();
        return $products;
      }
    } catch (\Throwable $th) {
      throw $th;
    }
  }

  public function Filter(Request $request) {
    $product = Product::with('categories')->where('title', 'like', '%'.$request->title.'%')->get();
    return $product;
  }

}
