<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    //保存を許可するカラム指定
    protected $fillable = [
        'category_id',//紐づくカテゴリID
        'content'//Todoのテキスト内容
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);//このTodoのカテゴリを取得
    }

    
    public function scopeCategorySearch($query, $category_id)
    {
        if (!empty($category_id)) {
        $query->where('category_id', $category_id);
        }
    }

    public function scopeKeywordSearch($query, $keyword)
    {
        if (!empty($keyword)) {
        $query->where('content', 'like', '%' . $keyword . '%');
        }
    }

}
