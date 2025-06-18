@extends('layouts/app')
{{-- レイアウトファイルの読み込み --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
{{-- cssファイルの読み込み --}}
@endsection

@section('content')
{{-- フラッシュメッセージ --}}
<div class="todo__alert">
    <div class="todo__alert--success">
        Todoを作成しました
    </div>
</div>

{{-- Todo新規作成フォーム --}}
<div class="todo__content">
    <form action="" class="todo__form">
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
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    {{-- Todoを編集するフォーム --}}
                    <form action="" class="update-form">
                        {{-- 編集用の入力欄 --}}
                        <div class="update-form__item">
                            <input type="text" class="update-form__box" name="content" value="test">
                        </div>
                        {{-- 更新ボタン --}}
                        <div class="update-form__btn">
                            <button class="update-form__btn-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    {{-- Todoを削除するフォーム --}}
                    <form action="" class="delete-form">
                        {{-- 削除ボタン --}}
                        <div class="delete-form__btn">
                            <button class="delete-form__btn-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
            {{-- 二つ目のTodo --}}
            <tr class="todo-table__row">
                <td class="todo-table__item">
                    <form action="" class="update-form">
                        <div class="update-form__item">
                            <input type="text" class="update-form__box" name="content" value="test2">
                        </div>
                        <div class="update-form__btn">
                            <button class="update-form__btn-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="todo-table__item">
                    <form action="" class="delete-form">
                        <div class="delete-form__btn">
                            <button class="delete-form__btn-submit" type="submit">削除</button>
                        </div>
                    </form>
                </td>
            </tr>
        </table>
    </div>

</div>