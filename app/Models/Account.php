<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Gate;

class Account extends Model implements TranslatableContract
{
    use SoftDeletes;
    use Translatable;

    public $translatedAttributes = ['name'];

    public $appends = [
        'background_color_row',
        'class_color_row',
        'actions',
        'is_leaf','leafs_count'


    ];

    /**
     * The buttons in datatable
     */
    public function getActionsAttribute()
    {
        $actions = '';

        $actions .= '<a id="' . $this->id . '"   class="createCurrencyClick " data-toggle="edite" title="' . __('admin.create') . ' ' . __('admin.currency') . '"><i class="la la-money btn btn-sm btn-outline-warning"></i> </a>';


//        if (Gate::check('update account')) {
            $actions .= '<a class="edit-table-row" id="' . $this->id . '"><i class="ft-edit btn btn-sm btn-outline-info"></i></a>';
//        }
        $actions .= '<a class="show-detail-category" id="' . $this->id . '"><i class="ft-eye btn btn-sm btn-outline-warning" style="margin: auto 8px"></i></a>';

//        if (Gate::check('delete account')) {
            $actions .= '<a class="delete" id="' . $this->id . '"><i class="ft-trash-2 btn btn-sm btn-outline-danger"></i></a>';
//        }

        return $actions;
    }

    public function getBackgroundColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'background-color: #ff041508;' : '';
    }

    public function getClassColorRowAttribute()
    {
        return $this->status != 'نشط' ? 'tr-color-red' : '';
    }


    public function getIsLeafAttribute()
    {
        $accounting_guide_sub_count = Account::where('account_id', $this->id)
//            ->where('status',1)
            ->get()
            ->count();

        return $accounting_guide_sub_count > 0 ? true : false;
    }

    public function getLeafsCountAttribute()
    {
        return $this->sub($this->id)->count();
    }

    /**
     * Get child resource.
     *
     * @param int $main_category_id .
     * @param \Illuminate\Database\Eloquent\Builder $query .
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSub($query, $account_id)
    {
        return $query->where('account_id', $account_id);
    }

    /**
     * MainCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sub()
    {
        return $this->hasMany(Account::class, 'account_id');
    }




    public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }

    public function getAccountingGuideNameAttribute()
    {
        return $this->account->name ?? '';
    }

    public function acc_report_type()
    {
        return $this->belongsTo(AccReportType::class, 'acc_report_type_id');
    }

    public function acc_type()
    {
        return $this->belongsTo(AccType::class, 'acc_type_id');
    }
}
