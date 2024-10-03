<?php

declare(strict_types=1);

namespace Nusara\Pulse\Models;

use App\Traits\HandleActionExecutedBy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

final class Placement extends Model
{
    use HasUuids, SoftDeletes, HandleActionExecutedBy;

    /**
     * The database table associated with the model.
     *
     * @var string
     */
    protected $table = 'pulse.placements';

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

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    //join joblevel
    public function joblevel()
    {
        return $this->belongsTo(JobLevel::class, 'job_level_id');
    }

    //join jobtitle
    public function jobtitle()
    {
        return $this->belongsTo(JobTitle::class, 'job_title_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function supervisor()
    {
        return $this->belongsTo(Employee::class, 'supervisor_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
}
