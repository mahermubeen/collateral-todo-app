<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable     = ['name', 'avatar'];


    public function add($data)
    {
        $Member = Member::create($data);
        return $Member->id;
    }

    public function get_members()
    {
        return Member::all();
    }

    public function get_member($id)
    {
        return Member::find($id);
    }

    public function edit_members($data, $where)
    {
        return Member::where($where)->update($data);
    }

    public function delete_member($id)
    {
        Member::where('id', $id)->delete();
    }

    public function delete_members_all()
    {
        Member::truncate();
    }



    public function posts()
    {
        return $this -> hasMany(Post::class);
    }


    public function comments()
    {
        return $this -> hasMany(Comment::class);
    }

}
