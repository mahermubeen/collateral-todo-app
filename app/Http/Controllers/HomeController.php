<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\User;
use App\Member;
use App\Status;
use DB;

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
        $data['members'] = $this->member->get_members();
        $data['statuses'] = $this->status->get_statuses();
        $data['comments']     = Comment::with('memberss')->get();

        $data['posts']     = Post::with('memberss', 'statusess')->get();

        $post_memberId = DB::table('posts')->pluck('member_id');

        $countId = [];

        foreach ($post_memberId as $id) {
            array_push($countId, DB::table('comments')->where('member_id', $id)->count());
        }

        $data['counts'] = $countId;

        return view('pages.dashboard', $data);
    }


    // Fetch Comments Record for AJAX
    public function getComments($id)
    {
        $aa = $id;

        $commentsArr = [];

        foreach ($aa as $bb) {
            array_push($commentsArr, DB::table('comments')->where('member_id', $bb)->get());
        }

        // $comNo = json_encode($commentsArr);

        // Call getuserData() method of Page Model
        $commentsNO['data'] = $commentsArr;

        return $commentsNO;
    }

    // Update Status
    public function updateStatus(Request $request, $id)
    {
        $status_id = $request->input('status_id');
        

        if ($status_id != '' ) {
            $data = array('status_id' => $status_id);

            // Call updateData() method of Comment Model
            $id = $this->post->edit_posts($data, $id);
            if($id > 0)
                return;
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
