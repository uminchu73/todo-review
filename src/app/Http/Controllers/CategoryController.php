<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;//カテゴリモデルを読み込む
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();//全てのカテゴリを取得

        return view('category', compact('categories'));
    }

    public function store(CategoryRequest $request)
    {
        $category = $request->only(['name']);
        Category::create($category);

        return redirect('/categories')->with('message', 'カテゴリを作成しました');
    }

    public function update(CategoryRequest $request)
    {
        $category = $request->only(['name']);//更新したい内容を取得
        Category::find($request->id)->update($category);//IDで指定されたカテゴリを更新

        return redirect('/categories')->with('message', 'カテゴリを更新しました');
    }

    public function destroy(Request $request)
    {
        Category::find($request->id)->delete();//IDで指定されたカテゴリを削除

        return redirect('/categories')->with('message', 'カテゴリを削除しました');
    }
}
