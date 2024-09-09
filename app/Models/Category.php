<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'metaTitle',
        'metaDescription',
        'metaKeys',
        'createdBy'
    ];
    static public function getRecord() {
        return Category::select('categories.*', 'users.name  as createdByName')
        ->join('users','users.id','=', 'categories.createdBy')
        ->orderBy('categories.id')->paginate(10);
    }
    static public function getOneCategory($id)
    {
        return Category::findOrFail($id);
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
