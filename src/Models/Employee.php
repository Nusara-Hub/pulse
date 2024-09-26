<?php

declare(strict_types=1);

namespace Nusara\Pulse\Models;

use App\Traits\HandleActionExecutedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

final class Employee extends Model
{
    use HasUuids, SoftDeletes, HandleActionExecutedBy;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'pulse.employees';

    /**
     * The storage format of the model's date columns.
     *
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'created_at' => 'datetime:U',
            'updated_at' => 'datetime:U',
            'deleted_at' => 'datetime:U',
        ];
    }
}
