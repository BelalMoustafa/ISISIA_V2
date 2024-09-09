<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Auth;
use Str;
class ProductController extends Controller
{
    function products() {
        $data['getRecord'] = Product::getRecord();
        $data['header_title'] = 'ISISIA - Products';
        return view('admin.products.products',$data);
    }
    function addProduct()
    {
        $data['header_title'] = 'Add Product';
        $data['categories'] = Category::all();
        return view('admin.products.create', $data);
    }
    function storeProduct(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:0,1',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $product = new Product;
        $product->title = $request->title;
        $product->status = $request->status;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->Discription = $request->description;
        $product->created_by = Auth::user()->id;

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->storeAs('public/products', $imageName);
            $product->image = $imageName;
        }
        $product->save();

        return redirect()->route('products')->with('success', 'Product added successfully');
    }

    function editProduct($id)
    {
        $data['getRecord'] = Product::getOneProduct($id);
        $data['categories'] = Category::all();
        $data['header_title'] = 'ISISIA - Products';
        return view('admin.products.edit', $data);
    }
    function updateProduct($id, Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'status' => 'required|in:0,1',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::findOrFail($id);

        if ($product->price != $request->price) {
            $product->old_price = $product->price;
        }

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(storage_path('app/public/products/' . $product->image))) {
                unlink(storage_path('app/public/products/' . $product->image));
            }

            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();
            $request->file('image')->storeAs('public/products', $imageName);
            $product->image = $imageName;
        }

        $product->title = $request->title;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->Discription = $request->description;
        $product->status = $request->status;
        $product->save();

        return redirect('admin/products')->with('success', 'Product updated successfully');
    }
    public function showProduct($id)
    {
        $product = Product::select('products.*', 'categories.name as category_name', 'categories.metaTitle as category_metaTitle', 'categories.metaDescription as category_metaDescription', 'categories.metaKeys as category_metaKeys')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->findOrFail($id);
        $data['product'] = $product;
        $data['header_title'] = $product->title;
        $data['metaTitle'] = $product->category_metaTitle;
        $data['metaDescription'] = $product->category_metaDescription;
        $data['metaKeys'] = $product->category_metaKeys;

        return view('admin.products.show', $data);
    }

    function deleteProduct($id) {
        $product = Product::getOneProduct($id);
        $product->delete();
        return redirect('admin/products')->with('success', 'Product successfully deleted');
    }
}
