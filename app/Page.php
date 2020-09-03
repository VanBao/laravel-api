<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Page extends Model
{
    protected $guarded = [];
    protected $hidden = ['name_en','summary_en','content_en'];

    public function created_user() {
        return $this->belongsTo(User::class,'created_id','id');
    }

    public function updated_user() {
        return $this->belongsTo(User::class,'updated_id','id');
    }

    public function getAvatarAttribute($value) {
        return asset('uploads/'.$value);
    }

//    public function getNameAttribute($value) {
//        if($this->language()) {
//            return $this->name_en;
//        }
//        return $value;
//    }
//
//    public function getSummaryAttribute($value) {
//        if($this->language()) {
//            return $this->summary_en;
//        }
//        return $value;
//    }
//
//    public function getContentAttribute($value) {
//        if($this->language()) {
//            return $this->content_en;
//        }
//        return $value;
//    }
//
//    private function language() {
//        if(auth()->check() && app('request')->wantsJson()) {
//            $settings = auth()->user()->user_setting()->where('setting_code','language');
//            if($settings->exists() && $settings->first()->toArray()['value'] == 'en') {
//                return true;
//            }
//        }
//        return false;
//    }
}
