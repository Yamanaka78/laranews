{{-- src/resources/views/layouts/common.blade.php継承 --}}
@extends('layouts.common')

@include('user.parts.sidebar_user')
@section('content')
@component('components.flash-message')
@endcomponent
<div class="h-screen overflow-y-scroll">
    <div class="px-4 sm:px-4">
        <div class="flex justify-between">
            <div class="text-2xl font-bold pt-7">ゴミ箱</div>
        </div>
        <div class="py-4">
            <div class="overflow-x-auto">
                <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
                    <table class="min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    タイトル
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    投稿ID
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    カテゴリー
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    ステータス
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    最終更新日時
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-left text-sm uppercase font-normal">
                                    操作
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    PV数
                                </th>
                                <th scope="col" class="px-5 py-3 bg-white  border-b border-gray-200 text-gray-800  text-center text-sm uppercase font-normal">
                                    お気に入り数
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trash_posts as $post)
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm w-40">
                                    <a href="{{ route('post.show', ['post_id' => $post->id]) }}" class="hover:underline">
                                        <p class="text-left text-gray-900 whitespace-no-wrap">
                                            {{ $post->title }}
                                        </p>
                                    </a>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->id }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <span class="relative inline-block px-3 py-1 font-semibold text-white leading-tight">
                                        <span aria-hidden="true" class="absolute inset-0 bg-green-500 rounded-full">
                                        </span>
                                        <span class="relative">
                                            @if (isset($post->category_id))
                                                {{ $post->category->category_name }}
                                            @else
                                                カテゴリーなし
                                            @endif
                                        </span>
                                    </span>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                    <form action="{{ route('post.restore', ['post_id' => $post->id]) }}" method="POST" onSubmit="return is_restore_check()">
                                    @csrf
                                        <button type="submit" class="mr-3 text-blue-700 whitespace-no-wrap underline">
                                            投稿を復元する
                                        </button>
                                    </form>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->updated_at }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 mr-5 border-b border-gray-200 bg-white text-sm">
                                    <div class="flex">
                                        <form action="{{ route('post.delete', ['post_id' => $post->id]) }}" method="POST" onSubmit="return is_delete_check()">
                                        @csrf
                                            <button type="submit" class="underline text-red-700 whitespace-no-wrap">
                                                delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->view_counter }}
                                    </p>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <p class="text-center text-gray-900 whitespace-no-wrap">
                                        {{ $post->favorite_counter }}
                                    </p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function is_restore_check() {
        const restore = '記事を復元しますか？';
        const cancel  = 'キャンセルされました';
        // 記事を復元するをクリックした時に確認ダイアログを表示。OKで実行、キャンセルで実行しない。
        if(window.confirm(restore)){
            return true;
        } else {
            window.alert(cancel);
            return false;
        }
    }

    function is_delete_check() {
        const deleteMessage = '記事を完全に削除しますか？';
        const cancel = 'キャンセルされました';
        // deleteをクリックした時に確認ダイアログを表示。OKでdelete実行、キャンセルでdelete実行しない。
        if(window.confirm(deleteMessage)){
            return true;
        } else {
            window.alert(cancel);
            return false;
        }
    }
</script>
@endsection
