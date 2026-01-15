<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use OwenIt\Auditing\Contracts\Auditable;

class ModelHasRole extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;

    /**
     * @var string
     */
    protected $table = 'model_has_roles';

    /**
     * @var bool
     */

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'enterprise_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $appends = [

        'package_name',
        'enterprise_name',
        'actions'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'created_at',
//        'updated_at',
    ];

    protected $fillable = [
        'role_id',
        'enterprise_id',
        'model_type',
        'model_id',
        'guard_name',
        'status',
        'package_start',
        'package_end',
    ];



    /**
     * Get last resource.
     *
     * @return bool
     */
    public function getActiveAttribute()
    {
        return $this->end_date >= Carbon::now() ? true : false;
    }

    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';
//        if (Gate::check('delete package_enterprises')) {
            $actions .= '<a class="delete" data-model-id="' . $this->enterprise_id . '" data-role="' . $this->role_id . '"><i class="ft-trash-2 btn btn-sm btn-outline-danger"></i></a>';
//        }
//        $actions .= '<a class="show-detail-advertisement" id="' . $this->enterprise_id . '"><i class="ft-eye btn btn-sm btn-outline-warning" style="margin: auto 8px"></i></a>';
//        if (Gate::check('update package_enterprises')) {
//            $actions .= '<a class="edit-table-row" id="' . $this->id . '"><i class="ft-edit color-primary"></i></a>';
//        }

        return $actions;
    }



    /**
     * Get category for current resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function package()
    {
        return $this->belongsTo(Package::class, 'role_id');
    }

    /**
     * Get category for current resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function enterprise()
    {
        return $this->belongsTo(Enterprise::class);
    }

    public function getPackageNameAttribute()
    {
        return $this->package->name;
    }

    public function getEnterpriseNameAttribute()
    {
        return $this->enterprise->enterprise_name;
    }
}
