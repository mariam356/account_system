<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Gate;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable , HasRoles;
    protected $guard_name = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'full_name',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'actions',
        'image_path',
        'branch_name'



    ];

    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';
        if (Gate::check('update user')) {
        $actions .= '<a class="edit-table-row" id="' . $this->id . '" ><i class="la la-pencil-square success"></i></a>';
        }

        $actions .= '&nbsp';
        if (Gate::check('delete user')) {
        $actions .= '<a class="delete" id="' . $this->id . '"><i class="la la-trash danger"></i></a>';
        }

        return $actions;
    }

    public function getBackgroundColorRowAttribute()
    {
        return /*$this->end_date < Carbon::now() || */ $this->status != 'نشط' ? 'background-color: #ff041508;' : '';
    }

    public function getClassColorRowAttribute()
    {
        return /*$this->end_date < Carbon::now() || */ $this->status != 'نشط' ? 'tr-color-red' : '';
    }

    public function getImagePathAttribute()
    {
        return asset('storage/' . $this->image);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class,'branch_id');
    }
    public function getBranchNameAttribute()
    {
        return $this->branch->name ?? '';
    }
}
