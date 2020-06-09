<?php

namespace InetStudio\SocialContest\Statuses\Models;

use OwenIt\Auditing\Auditable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InetStudio\Classifiers\Models\Traits\HasClassifiers;
use InetStudio\SocialContest\Statuses\Contracts\Models\StatusModelContract;

class StatusModel extends Model implements StatusModelContract
{
    use Auditable;
    use SoftDeletes;
    use HasClassifiers;

    const ENTITY_TYPE = 'social_contest_status';

    protected bool $auditTimestamps = true;

    protected $table = 'social_contest_statuses';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getTypeAttribute(): string
    {
        return self::ENTITY_TYPE;
    }

    public function posts(): HasMany
    {
        $postModel = resolve('InetStudio\SocialContest\Receipts\Contracts\Models\ReceiptModelContract');

        return $this->hasMany(
            get_class($postModel),
            'status_id',
            'id'
        );
    }
}
