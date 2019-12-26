<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;
use App\Post;
use App\Comment;
use App\User;

class TaskController extends Controller
{
    private $post;
    private $comment;
    private $user;
    private $task;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->post = new Post();
        $this->comment = new Comment();
        $this->user = new User();
        $this->task = new Task();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add_task(Request $data)
    {
        $this->validate($data, [
            'task' => ['required', 'string', 'max:255', 'min:5']
        ]);

        $data = array(
            'name'      =>  $data['task']
        );

        $id = $this->task->add($data);

        if ($id > 0)
            return redirect()->back()->with('success', 'Task Added Successfully!');
        else
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
    }

    public function destroy_task($id)
    {
        if (!$id or $id < 1) {
            return redirect()->back()->with('error', 'Error! Please try again.');
        } else {
            $this->task->delete_task($id);
            return redirect()->back()->with('success', 'Task Deleted Successfully!');
        }
    }

    public function edit_task($id, Request $data)
    {
        if (!$id or $id < 1)
            return redirect()->back()->with('error', 'Error! Please try again.');

        $this->validate($data, [
            'task'      =>  'required|min:1'
        ]);

        $data = array(
            'name'      =>  $data['task']
        );

        $where = array(
            'id'      =>  $id
        );

        $this->task->edit_tasks($data, $where);

        return redirect()->back()->with('success', 'Task Updated Successfully!');
    }
}
