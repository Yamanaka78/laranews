<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * モデルに関連づけるテーブル
     *
     * @var string
     */

     protected $table = 'categories';


     /**
      * 複数代入可能な属性
      *
      * @var array
      */

      protected $fillable = [
        'category_name',
        'created_at',
        'updated_at'
      ];


      /**
       * Postモデルとリレーション
       */

       public function posts()
       {
            return $this->hasMany(Post::class);
       }
}
