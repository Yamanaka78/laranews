<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 追加
use App\Models\Category;
use App\Models\Post;

class TopController extends Controller
{

    private $post;
    private $category;


    public function __construct()
    {
        $this->category = new Category();
        $this->post     = new Post();
    }
    /**
     * 総合トップ画面
     */
    public function top()
    {
        // ユーザーがログイン済み
        if (Auth::check()) {
            // 認証しているユーザーを取得
            $user = Auth::user();
            // 認証しているユーザーIDを取得
            $user_id = $user->id;
        } else {
            $user_id = null;
        }

        //カテゴリーを全て取得
        $categories = $this->category->getAllCategories();
        //全ての投稿データを取得(publish_flgが公開のみ、最新更新日時をソート)
        $posts = $this->post->getPostsSortByLatestUpdate();
        return view('top', compact(
            'user_id',
            'categories',
            'posts',
        ));
    }

    /**
     * 記事詳細
     * @param int $post_id 記事ID
     * @return Response src/resources/views/article/show.blade.php
     */

     public function articleShow($post_id)
     {
         // ユーザーがログイン済み
         if (Auth::check()) {
             // 認証しているユーザーを取得
             $user = Auth::user();
             // 認証しているユーザーIDを取得
             $user_id = $user->id;
         } else {
             $user_id = null;
         }

         // カテゴリーを全て取得
         $categories = $this->category->getAllCategories();
         // 記事IDをもとに特定の記事のデータを取得
         $post = $this->post->feachPostDateByPostId($post_id);
         return view('article.show', compact(
             'user_id',
             'categories',
             'post',
         ));
     }



      /**
     * カテゴリーごとの記事
     *
     * @param int $category_id カテゴリーID
     * @return Response src/resources/views/article/category.blade.php
     */
    public function articleCategory($category_id)
    {
        // ユーザーがログイン済み
        if (Auth::check()) {
            // 認証しているユーザーを取得
            $user = Auth::user();
            // 認証しているユーザーIDを取得
            $user_id = $user->id;
        } else {
            $user_id = null;
        }
        // カテゴリーを全て取得
        $categories = $this->category->getAllCategories();
        // カテゴリーIDをもとにカテゴリーごとの記事を取得
        $posts = $this->post->getPostByCategoryId($category_id);
        return view('article.category', compact(
            'user_id',
            'categories',
            'posts',
        ));
    }
}
