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
        $data = array(
            'title'      =>  $data['title'],
            'member_id' => $data['member_id'],
            'status_id' => $data['status_id'],
            'due_date' => $data['datetimes'],
            'category' => $data['category']
        );

        $info = $this->post->add($data);

        if ($info > 0) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
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
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
        }
    }

    public function edit_post($id, Request $data) {

        if(!$id or $id < 1)
            return redirect() -> back();

        $this -> validate($data, [
            'abc'      =>  'required'
        ]);

        $data = array(
            'status_id'      =>  $data['abc']
        );

        $where = array(
            'id'      =>  $id
        );

        $this ->post -> edit_posts($data, $where);

        return redirect()->back();

    }


    public function destroy_allPosts()
    {
        DB::table('posts')->delete();

        return redirect()->back()->with('message', 'All Posts deleted successfully.');
    }


    public function destroy_post($id)
    {
        if (!$id or $id < 1)
            return redirect()->back();

        $this->post->delete_post($id);
        return redirect()->back()->with('message', 'Post delete successfully.');
    }
}
