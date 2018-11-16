<?php
/**
 * Created by PhpStorm.
 * User: openote
 * Date: 2018/11/16
 * Time: 16:23
 */

namespace App\Api\Transforms;


use App\Models\News;
use League\Fractal\TransformerAbstract;

class NewsTransform extends TransformerAbstract {

    public function transform(News $news) {
        return [
            'id' => $news['id'],
            'author' => $news->author,
            'title' => $news->title,
            'content' => $news->content,
            'content' => $news->is_publish
        ];
    }
}