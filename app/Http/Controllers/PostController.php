<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\User;
use App\Member;
use App\MemberPost;
use App\PostStatus;
use Illuminate\Support\Facades\DB;



class PostController extends Controller
{
    private $post;
    private $comment;
    private $member;

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
        $this->member = new Member();
    }


    public function add_post(Request $data)
    {
        $this->validate($data, [
            'task_id'      =>  'required',
            'member_id'      =>  'required',
            'status_id'      =>  'required',
            'datetimes'      =>  'required',
            'category_id'      =>  'required',
        ]);

        $data = array(
            'task_id'      =>  $data['task_id'],
            'member_id' => $data['member_id'],
            'status_id' => $data['status_id'],
            'due_date' => $data['datetimes'],
            'category_id' => $data['category_id']
        );

        $info = $this->post->add($data);

        if ($info > 0) {
            return redirect()->back()->with('success', 'Successfully Added!');
        } else {
            return redirect()->back()->with('error', 'Failed to Add Task!')->withInput();
        }
    }

    public function edit_posts(Request $data)
    {
        $this->validate($data, [
            'category'      =>  'required', 'string', 'max:255'
        ]);

        $data = array(
            'title'      =>  $data['title'],
            'member_id' => $data['member_id'],
            'status_id' => $data['status_id'],
            'due_date' => $data['datetimes'],
            'category' => $data['category']
        );

        $info = $this->post->update_posts($data, $data['category']);

        if ($info > 0) {
            return redirect()->back()->with('success', 'Successfully Updated!');
        } else {
            return redirect()->back()->with('error', 'Failed to Update Task!')->withInput();
        }
    }

    public function edit_post($id, Request $data)
    {

        if (!$id or $id < 1)
            return redirect()->back()->with('error', 'Failed to Update Task!');

        $this->validate($data, [
            'abc'      =>  'required'
        ]);

        $data = array(
            'status_id'      =>  $data['abc']
        );

        $where = array(
            'id'      =>  $id
        );

        $this->post->edit_posts($data, $where);

        return redirect()->back()->with('success', 'Successfully Updated!');
    }


    public function destroyAll_post($id)
    {
        DB::table('posts')->where('category_id', $id)->delete();

        return redirect()->back()->with('success', 'Successfully Deleted All Tasks');
    }


    public function destroy_post($id)
    {
        if (!$id or $id < 1)
            return redirect()->back()->with('error', 'Failed to Delete Task!');

        $this->post->delete_post($id);
        return redirect()->back()->with('success', 'Successfully Deleted!');
    }
}
