<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable     = ['comment', 'post_id', 'member_id'];


    public function add($data) {
        $Comment = Comment::create($data);
        return $Comment -> id;
    }

    public function get_comments() {
        return Comment::all();
    }

    public function get_comment($id) {
        return Comment::find($id);
    }

    public function edit_comments($data, $where) {
        return Comment::where($where) -> update($data);
    }

    public function delete_comment($id) {
        Comment::where('id', $id) -> delete();
    }


    public function memberss()
    {
        return $this -> belongsTo(Member::class, 'member_id', 'id');
    }

    public function post(){
        return $this->belongsTo(Post::class);
    }
}
