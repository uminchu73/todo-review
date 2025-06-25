<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Models\Category;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    //一覧ページを表示
    public function index()
    {
        $todos = Todo::with('category')->get();//データベースから全Todoを取り出す
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));//indexビューに渡して表示
    }

    //Todoを新規作成する処理
    public function store(TodoRequest $request)
    {
        $todo = $request->only(['category_id', 'content']);//フォームから送られたcategory_idとcontentを取り出す
        Todo::create($todo);//新しいTodoを保存する

        //一覧ページに戻ってメッセージ表示
        return redirect('/')->with('message', 'Todoを作成しました');
    }

    //Todoを更新する処理
    public function update(TodoRequest $request)
    {
        $todo = $request->only(['content']);//更新したい内容を取得
        Todo::find($request->id)->update($todo);//IDで指定されたTodoを更新

        return redirect('/')->with('message', 'Todoを更新しました');
    }

    //Todoを削除する処理
    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();//IDで指定されたTodoを削除

        return redirect('/')->with('message', 'Todoを削除しました');
    }

    public function search(Request $request)
    {
        $todos = Todo::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
        $categories = Category::all();

        return view('index', compact('todos', 'categories'));
    }
}
