<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    // للتخزين

    protected $fillable=[
        'name' ,
        'parent_id',
        'slug',
        'description',
        'image',
        'status',


    ];
    // ممنوع اخزن فيها
    protected $guarded=[
        'id'

    ];
    public static function rules($id=0)
    {
          return([
            'name' => "required|string|min:3|max:255|unique:categories,name,$id",
            'parent_id' =>[
            'nullable','int','exists:categories,id'
            ],
            'image' =>[
               'image' , 'max:1024000','dimensions:min_width=100,min_height=100',
            ],
            'status' =>'in:active,archived',
        ]);
    }
}
