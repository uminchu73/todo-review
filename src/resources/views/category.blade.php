@extends('layouts/app')
{{-- レイアウトファイルの読み込み --}}

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
{{-- category.cssの読み込み --}}
@endsection

@section('content')
{{-- フラッシュメッセージ --}}
<div class="category__alert">
    @if(session('message'))
    {{-- 成功時のメッセージ表示 --}}
    <div class="category__alert--success">
        {{ session('message') }}
    </div>
    @endif

    @if($errors->any())
    <div class="category__alert--error">
        <ul>
            {{-- バリデーションエラーがある時にリスト表示 --}}
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

{{-- カテゴリ新規作成フォーム --}}
<div class="category__content">
    <form action="/categories" method="post" class="category-form">
        @csrf {{-- セキュリティ対策 --}}
        {{-- 入力欄 --}}
        <div class="category-form__item">
            <input type="text" name="name" class="category-form__item--box" value="{{ old('name') }}">
        </div>
        {{-- 作成ボタン --}}
        <button type="submit" class="create__btn">作成</button>
    </form>

    {{-- Category一覧テーブル --}}
    <div class="category-table">
        <table class="category-table__inner">
            <tr class="category-table__row">
                {{-- 見出し --}}
                <th class="category-table__header">
                    <span class="category-table__header-span">Category</span>
                </th>
            </tr>
            {{-- 配列をループして1件ずつ表示 --}}
            @foreach ($categories as $category)
            <tr class="category-table__row">
                <td class="category-table__item">
                    {{-- 編集フォーム --}}
                    {{-- 編集リクエスト用のフォーム --}}
                    <form action="/categories/update" method="post"  class="update-form">
                        @method('PATCH')
                        @csrf
                        <div class="update-form__item">
                        {{-- 現在のカテゴリ内容表示（編集もできる） --}}
                        <input type="text" class="update-form__box" name="name" value="{{ $category['name'] }}">
                        {{-- 編集対象のカテゴリID（見えない） --}}
                        <input type="hidden" name="id" value="{{ $category['id'] }}">
                        </div>
                        <div class="update-form__item">
                        </div>
                        {{-- 更新ボタン --}}
                        <div class="update-form__btn">
                            <button class="update-form__btn-submit" type="submit">更新</button>
                        </div>
                    </form>
                </td>
                <td class="category-table__item">
                    {{-- 削除フォーム --}}
                    <form action="/categories/delete" class="delete-form" method="post">
                    @method('DELETE')
                    @csrf
                        {{-- 削除対象のカテゴリID（見えない） --}}
                        <div class="delete-form__btn">
                            <input type="hidden" name="id" value="{{ $category['id'] }}">
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