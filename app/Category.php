<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable     = ['name'];


    public function add($data)
    {
        $Member = Category::create($data);
        return $Member->id;
    }

    public function get_categories()
    {
        return Category::all();
    }

    public function get_category($id)
    {
        return Category::find($id);
    }

    public function edit_categories($data, $where)
    {
        return Category::where($where)->update($data);
    }

    public function delete_category($id)
    {
        Category::where('id', $id)->delete();
    }

    public function delete_categories_all()
    {
        Category::truncate();
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
