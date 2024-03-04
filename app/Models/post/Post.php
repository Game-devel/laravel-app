<?php
declare(strict_types=1);

namespace App\Models\post;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @mixin Builder
 *
 * @property int $id
 * @property int $user_id
 * @property int $dummy_post_id
 * @property string $title
 * @property string $body
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @property User $user
 */
class Post extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'user_id',
        'dummy_post_id'
    ];

    public static function create(int $userId, int $dummyPostId): self
    {
        $post = new static();
        $post->user_id = $userId;
        $post->dummy_post_id = $dummyPostId;
        return $post;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
