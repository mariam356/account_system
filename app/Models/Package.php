<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use OwenIt\Auditing\Contracts\Auditable;

class Package extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
//    use Translatable;
    use Notifiable;
//    use SoftDeletes;

    /**
     * The attributes that are mass translated.
     *
     * @var array
     */
//    public $translatedAttributes = ['name'];

    protected $table= "roles";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
//        'translations',
        'created_at',
        'updated_at',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'actions',
        'package_screen_actions',
        'package_user_interface_actions',
        'background_color_row'
    ];


    public function scopeScreen($query)
    {
        return $query->where('guard_name', 'screen');
    }

    public function scopeUser($query)
    {
        return $query->where('guard_name', 'user_interface');
    }

    /**
     * Get category for current resource.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function packageUserInterface()
    {
        return $this->hasMany(PackageUserInterface::class);
    }

    public function packageScreen()
    {
        return $this->hasMany(RoleHasPermission::class);
    }


    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';
                if (Gate::check('update packages')) {
        $actions .= '<a class="edit-table-row" id="' . $this->id . '" title="' . __('admin.edit') . '"><i class="ft-edit btn btn-sm btn-outline-info"></i></a>';
        }

        $actions .= '&nbsp';
        if (Gate::check('delete packages')) {
        $actions .= '<a class="delete" id="' . $this->id . '" title="' . __('admin.delete') . '"><i class="ft-trash-2 btn btn-sm btn-outline-danger"></i></a>';
        }
        return $actions;
    }

    public function getPackageScreenActionsAttribute()
    {
        $moheb = DB::table('role_has_permissions')->where('role_id',$this->id)->count();
        $actions = '';
        if (Gate::check('create package_screens')) {
            if ($moheb != 0) {
                $actions .= '<a href="' . url('encoding/package_screens/edit') . '/' . $this->id . '" class="edit-table-row" id="' . $this->id . '" title="' . __('admin.edit') . '"><i class="ft-edit color-primary" style="margin: auto 8px"></i></a>';
            }
        }
        if (Gate::check('create package_screens')) {
            if ($moheb == 0) {
                $actions .= '<a href="' . url('encoding/package_screens/create') . '/' . $this->id . '" class="create-table-row" id="' . $this->id . '" title="' . __('admin.create') . '"><i class="ft-plus-square color-info" ></i></a>';
            }
        }
        if (Gate::check('delete package_screens')) {
            if ($moheb != 0) {
                $actions .= '<a class="delete" id="' . $this->id . '" title="' . __('admin.delete') . '"><i class="ft-trash-2 color-red" style="margin: auto 8px"></i></a>';
            }
        }

        return $actions;
    }

    public function getPackageUserInterfaceActionsAttribute()
    {
        $moheb = DB::table('role_has_permissions')->where('role_id',$this->id)->count();
        $actions = '';
        if (Gate::check('create package_user_interfaces')) {
            if ($moheb != 0) {
                $actions .= '<a href="' . url('encoding/package_user_interfaces/edit') . '/' . $this->id . '" class="edit-table-row" id="' . $this->id . '" title="' . __('admin.edit') . '"><i class="ft-edit color-primary" style="margin: auto 8px"></i></a>';
            }
        }
        if (Gate::check('create package_user_interfaces')) {
            if ($moheb == 0) {
                $actions .= '<a href="' . url('encoding/package_user_interfaces/create') . '/' . $this->id . '" class="create-table-row" id="' . $this->id . '" title="' . __('admin.create') . '"><i class="ft-plus-square color-info" ></i></a>';
            }
        }
        if (Gate::check('delete package_user_interfaces')) {
            if ($moheb != 0) {
                $actions .= '<a class="delete" id="' . $this->id . '" title="' . __('admin.delete') . '"><i class="ft-trash-2 color-red" style="margin: auto 8px"></i></a>';
            }
        }

        return $actions;
    }

    public function getBackgroundColorRowAttribute()
    {
        return $this->status != 1 ? 'background-color: #ff041508;' : '';
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}
