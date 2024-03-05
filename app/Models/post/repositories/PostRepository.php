<?php

namespace App\Models\post\repositories;

use App\Models\post\Post;
use App\Repositories\BaseRepository;

class PostRepository extends BaseRepository
{
    public function __construct(Post $post)
    {
        parent::__construct($post);
    }
}
