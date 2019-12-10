<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\User;
use App\Member;
use App\Status;
use DB;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    private $post;
    private $comment;
    private $user;
    private $member;
    private $status;
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
        $this->member = new Member();
        $this->status = new Status();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function dashboard()
    {
        $data['members'] = Member::with('comments', 'posts')->get();
        $data['statuses'] = $this->status->get_statuses();
        $data['comments']     = Comment::with('memberss')->get();
        $data['posts']     = Post::with('memberss', 'statusess')->get();


        // dd($data['members']);

        $post_memberId = DB::table('posts')->pluck('member_id');
        $countId = [];
        foreach ($post_memberId as $id) {
            array_push($countId, DB::table('comments')->where('member_id', $id)->count());
        }
        $data['counts'] = $countId;

        // dd($data['counts']);



        $cat_col = DB::table('posts')->pluck('category');
        $postsss = [];
        foreach ($cat_col as $cat) {
            array_push($postsss, DB::table('posts')->where('category', '=', $cat)->get());
        }

        $data['categories'] = $postsss;

        // dd($data['categories']);


        

        return view('pages.dashboard', $data);
    }


    // Fetch Comments Record for AJAX
    public function getComments($id)
    {
        $comments['data'] = Comment::with('memberss')->where('member_id', $id)->get();
        echo json_encode($comments);
        exit;
    }

    // Update Status
    public function updateStatus(Request $request, $id)
    {
        $status_id = $request->input('status_id');

        if ($status_id != '') {
            $data['created_at'] = new \DateTime();
            $data['status_id'] = $status_id;

            // Call updateData() method of Comment Model
            $id = $this->post->edit_posts($data, $id);
            if ($id > 0)
                return redirect('/');
        } else {
            echo 'Fill all fields.';
        }

        exit;
    }


    public function people()
    {
        return view('pages.people');
    }
}
