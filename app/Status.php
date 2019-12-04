<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable     = ['name'];


    public function add($data)
    {
        $Product = Status::create($data);
        return $Product->id;
    }

    public function get_statuses()
    {
        return Status::all();
    }

    public function get_product($id)
    {
        return Status::find($id);
    }

    public function edit_status($data, $where)
    {
        return Status::where($where)->update($data);
    }

    public function delete_product($id)
    {
        Status::where('id', $id)->delete();
    }

    public function delete_status_all()
    {
        Status::truncate();
    }


    public function posts()
    {
        return $this -> hasMany(Post::class);
    }

}
