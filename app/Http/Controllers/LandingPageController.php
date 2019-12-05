<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\User;
use App\Member;
use App\Status;
use Illuminate\Support\Facades\DB;
use MultipleIterator;
use ArrayIterator;

class LandingPageController extends Controller
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
        $this->post = new Post();
        $this->comment = new Comment();
        $this->member = new Member();
        $this->status = new Status();
    }

    public function index()
    {
        $data['members']  = $this->member->get_members();
        $data['statuses'] = $this->status->get_statuses();

        $data['posts']      = Post::with('memberss', 'statusess')->get();

        $data['comments']     = Comment::with('memberss')->get();



        // $createdDate = Comment::pluck('created_at');

        // $dateArr = [];

        // $data['created_at'] = date_format($date,"M d");

        // foreach ($createdDate as $date) {
        //     array_push($dateArr, DB::table('comments')->where('member_id', $date)->count());
        // }

        // $data['commentDate'] = $dateArr;



        $post_memberId = DB::table('posts')->pluck('member_id');

        $countId = [];

        foreach ($post_memberId as $id) {
            array_push($countId, DB::table('comments')->where('member_id', $id)->count());
        }

        $data['counts'] = $countId;

        $comments_arr = [];

        foreach ($post_memberId as $id) {
            array_push($comments_arr, Comment::with('memberss')->where('member_id', $id)->get());
        }

        $data['commentsNo'] = $comments_arr;

        // dd($data['comments']);

        // $data['postss'] = Post::with('commentss')->where('member_id', 1)->get();


        return view('index', $data);
    }

    public function index1($id)
    {
        $info['comments']     = Comment::with('memberss')->where('member_id', $id)->get();

        if ($info > 0)
            return;
    }

    // Update Status
    public function updateStatus(Request $request, $id)
    {
        $status_id = $request->input('status_id');


        if ($status_id != '') {
            $data = array('status_id' => $status_id);

            // Call updateData() method of Comment Model
            $id = $this->post->edit_posts($data, $id);
            if ($id > 0)
                return;
        } else {
            echo 'Fill all fields.';
        }

        exit;
    }
}
