<?php

namespace Zxg321\Zmall\Database\Ad;

use Illuminate\Database\Eloquent\Model;
//use Encore\Admin\Traits\AdminBuilder;
//use Encore\Admin\Traits\ModelTree;
class Menu extends Model
{
    //use ModelTree, AdminBuilder;
    //protected $table = 'zmall_net_menu';
    //protected $primaryKey='id';
    public $timestamps = false;//时间戳关闭 created_at 和 updated_at 字段
    //public $guarded = ['sort_order'];//黑名单属性
    //protected $casts = ['audit_list' => 'array',];
    public function __construct(array $attributes = [])
    {
        $this->setTable(config('zmall.db_prefix','zmall_').'ad_menu');
        parent::__construct($attributes);
        //$this->setParentColumn('parent_id');
        //$this->setOrderColumn('sort_order');
        //$this->setTitleColumn('title');
        //$this->where('store_id',0);
    }
    public function item()
    {
         return $this->hasMany('Zxg321\Zmall\Database\Ad\Item','menu_id','id');
    }
}
