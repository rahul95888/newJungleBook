<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;

class Pop extends Model
{
    use SoftDeletes;
    protected $table = 'pops';
    protected $fillable = [
        'pop_uid',
        'title',
        'commodity_uid',
        'section_uid',
        'image',
        'audio',
        'content',
        'created_by',
        'created_ip',
        'modifed_by',
        'modifed_ip',
        'deleted_by',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->id();
            $model->created_ip = Request::ip();
        });
        static::updating(function ($model) {
            $model->modifed_by = auth()->id();
            $model->modifed_ip = Request::ip();
        });
    }

    public function commodity()
    {
        return $this->hasOne(Commodity::class, 'commodity_uid', 'commodity_uid');
    }

    public function section()
    {
        return $this->hasOne(Section::class, 'section_uid', 'section_uid');
    }
}
