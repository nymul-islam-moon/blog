<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $table = 'blogs';

    protected $fillable = [ 'created_by_id', 'updated_by_id', 'title', 'status', 'image', 'desc', 'blog_category_id' ];


    public function blog_category()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category_id');
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function updated_by()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }
}
