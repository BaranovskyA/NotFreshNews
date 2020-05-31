<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title', 'content', 'user_id', 'category_list'
    ];

    public function getResult(string $category = '')
    {
        $query = [];
        if ($category) {
            $query = $query + ['category' => $category];
        }
        if (empty($query)) {
            return self::all();
        }

        return $this->where($query)->get();
    }
}
