<?php

namespace App\Http\Controllers\category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Auth;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    function categories() {
        $data['getRecord']= Category::getRecord();
        $data['header_title'] = 'ISISIA - Categories';
        return view('admin.categories.categories',$data);
    }
    function addCategory() {
        $data['header_title'] = 'ISISIA - Categories';
        return view('admin.categories.create', $data);
    }
    function storeCategory(Request $request) {
        $category= new Category;
        $category->name=$request->name;
        $category->status=$request->status;
        $category->metaTitle=$request->metaTitle;
        $category->metaDescription = $request->metaDescription;
        $category->metaKeys = $request->metaKeys;
        $category->createdBy = Auth::user()->id;
        $category->save();
        return redirect('admin/categories')->with('success', 'Category successfully added');
    }
    function showCategory($id)
    {
        $category = Category::select('categories.*', 'users.name as createdByName')
        ->join('users', 'users.id', '=', 'categories.createdBy')
        ->findOrFail($id);
        $products = Product::where('category_id', $id)->get();
        $data['category'] = $category;
        $data['products'] = $products;
        $data['header_title'] = $category->name;
        $data['metaTitle'] = $category->metaTitle;
        $data['metaDescription'] = $category->metaDescription;
        $data['metaKeys'] = $category->metaKeys;
        return view('admin.categories.show', $data);
    }
    function editCategory($id) {
        $data['getRecord'] = Category::getOneCategory($id);
        $data['header_title'] = 'ISISIA - Categories';
        return view('admin.categories.edit', $data);
    }
    function updateCategory(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'metaTitle' => 'required|string|max:255',
            'metaDescription' => 'nullable|string',
            'metaKeys' => 'nullable|string',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Category::findOrFail($id);
        $category->name = $request->input('name');
        $category->status = $request->input('status');
        $category->metaTitle = $request->input('metaTitle');
        $category->metaDescription = $request->input('metaDescription');
        $category->metaKeys = $request->input('metaKeys');
        $category->save();
        return redirect()->route('categories')->with('success', 'Category updated successfully');
    }
    function deleteCategory($id) {
        $category = Category::getOneCategory($id);
        $category->delete();
        return redirect('admin/categories')->with('success', 'Category successfully deleted');
    }
}
