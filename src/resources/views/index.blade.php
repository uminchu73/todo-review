@extends('layouts/app')
{{-- レイアウトファイルの読み込み --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
{{-- cssファイルの読み込み --}}
@endsection

@section('content')
{{-- フラッシュメッセージ --}}
<div class="todo__alert">
    @if(session('message'))
    <div class="todo__alert--success">
        {{ session('message') }}
    </div>
    @endif
    @if($errors->any())
    <div class="todo__alert--error">
        <ul>
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

            {{-- 一つ目のTodo --}}
            @foreach ($todos as $todo)
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    {{-- Todoを編集するフォーム --}}
                    <form action="/todos/update" method="post"  class="update-form">
                        @method('PATCH')
                        @csrf
                        {{-- 編集用の入力欄 --}}
                        <div class="update-form__item">
                        <input type="text" class="update-form__box" name="content" value="{{ $todo['content'] }}">{{-- todoの中身を表示して編集もできる --}}
                        <input type="hidden" name="id" value="{{ $todo['id'] }}">
                        </div>
                        {{-- 更新ボタン --}}
                        <div class="update-form__btn">
                            <button class="update-form__btn-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    {{-- Todoを削除するフォーム --}}
                    <form action="/todos/delete" class="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                        {{-- 削除ボタン --}}
                        <div class="delete-form__btn">
                            <input type="hidden" name="id" value="{{ $todo['id'] }}">
                            <button class="delete-form__btn-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>

</div>