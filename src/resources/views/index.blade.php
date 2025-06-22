@extends('layouts/app')
{{-- レイアウトファイルの読み込み --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
{{-- index.cssの読み込み --}}
@endsection

@section('content')
{{-- フラッシュメッセージ --}}
<div class="todo__alert">
    @if(session('message'))
    {{-- 成功時のメッセージ表示 --}}
    <div class="todo__alert--success">
        {{ session('message') }}
    </div>
    @endif

    @if($errors->any())
    <div class="todo__alert--error">
        <ul>
            {{-- バリデーションエラーがある時にリスト表示 --}}
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

{{-- Todo新規作成フォーム --}}
<div class="todo__content">
    <form action="/todos" method="post" class="todo__form">
        @csrf {{-- セキュリティ対策 --}}
        {{-- 入力欄 --}}
        <input type="text" name="content" class="todo__form--box">
        {{-- 作成ボタン --}}
        <button type="submit" class="create__btn">作成</button>
    </form>

{{-- Todo一覧テーブル --}}
    <div class="todo-table">
        <table class="todo-table__inner">
            <tr class="todo-table__row">
                {{-- 見出し --}}
                <th class="todo-table__header">Todo</th>
            </tr>
            {{-- todos配列をループして1件ずつ表示 --}}
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    {{-- 編集フォーム --}}
                    {{-- 編集リクエスト用のフォーム --}}
                    <form action="/todos/update" method="post"  class="update-form">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                        {{-- 現在のTodo内容表示（編集もできる） --}}
                        <input type="text" class="update-form__box" name="content" value="{{ $todo['content'] }}">
                        {{-- 編集対象のTodo ID（見えない） --}}
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        {{-- 更新ボタン --}}
                        <div class="update-form__btn">
                            <button class="update-form__btn-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    {{-- 削除フォーム --}}
                    <form action="/todos/delete" class="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                        {{-- 削除対象のTodo ID（見えない） --}}
                        <div class="delete-form__btn">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            {{-- 削除ボタン --}}
                            <button class="delete-form__btn-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>