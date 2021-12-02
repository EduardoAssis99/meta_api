<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{

  public function index(){
    $categories = Category::with('products')->get();
    return $categories;
  }

  public function show($id){
    $category = Category::findOrFail($id);
    return $category;
  }

  public function store(Request $request){
    try {
      $category = new Category;
      $category->title = $request->input('title');

      if( $category->save() ){
        return $category;
      }

    } catch (\Throwable $th) {
      throw ValidationException::withMessages(["errors" => "Erro ao deletar registro, verifique e tente novamente!"]);
    }
  }

  public function update(Request $request){
    try {
      $category = Category::findOrFail( $request->id);
      $category->title = $request->input('title');

      if( $category->save() ){
        return $category;
      }

    } catch (\Throwable $th) {
      throw ValidationException::withMessages(["errors" => "Erro ao deletar registro, verifique e tente novamente!"]);
    }
  }

  public function destroy($id){
    try {
      $category = Category::find($id);
      $category->delete();

      $categories = Category::paginate(15); 
      return $categories;

    } catch (\Throwable $th) {
      throw ValidationException::withMessages(["errors" => "Erro ao deletar registro, verifique e tente novamente!"]);
    }
  }

}
