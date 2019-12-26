<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable     = ['name'];


    public function add($data)
    {
        $Member = Task::create($data);
        return $Member->id;
    }

    public function get_tasks()
    {
        return Task::all();
    }

    public function get_task($id)
    {
        return Task::find($id);
    }

    public function edit_tasks($data, $where)
    {
        return Task::where($where)->update($data);
    }

    public function delete_task($id)
    {
        Task::where('id', $id)->delete();
    }

    public function delete_tasks_all()
    {
        Task::truncate();
    }


    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
