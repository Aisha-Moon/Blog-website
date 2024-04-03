<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table='categories';

    static public function getRecord(){
        return self::select('categories.*')
            ->where('is_delete',0)
            ->orderBy('id','desc')
            ->paginate(3);

    }
    static public function getCategory(){
        return self::select('categories.*')
            ->where('is_delete',0)
            ->where('status',1)
            ->get();

    }

    static public function getSingle($id){
        return self::find($id);
    }
}
