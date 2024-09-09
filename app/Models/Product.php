<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'category_id',
        'created_by',
        'old_price',
        'price',
        'Discription',
        'status',
        'image'
    ];
    public static function getOneProduct($id)
    {
        return Product::findOrFail($id);
    }

    public static function getRecord()
    {
        return Product::select('products.*', 'users.name as created_by_name', 'categories.name as category_name')
        ->orderBy('products.id')
        ->join('users', 'users.id', '=', 'products.created_by')
        ->join('categories', 'categories.id', '=', 'products.category_id')
        ->paginate(5);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    public function wishlistUsers()
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }
}
