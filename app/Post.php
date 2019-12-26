<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable     = ['task_id', 'member_id', 'status_id', 'due_date', 'category_id'];


    public function add($data)
    {
        $Post = Post::create($data);
        return $Post->id;
    }

    public function get_posts()
    {
        return Post::all();
    }

    public function get_post($id)
    {
        return Post::find($id);
    }

    public function edit_posts($data, $id)
    {
        return Post::where('id', $id)->update($data);
    }

    public function update_posts($data, $category)
    {
        return Post::where('category', $category)->update($data);
    }

    public function delete_post($id)
    {
        Post::where('id', $id)->delete();
    }

    public function delete_posts_all()
    {
        Post::truncate();
    }



    public function memberss()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function tasks()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }


    public function commentss()
    {
        return $this->hasMany(Comment::class);
    }

    public function statusess()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
}
