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
use PHPUnit\Framework\Constraint\Attribute;

class LandingPageController extends Controller
{
    private $post;
    private $comment;
    private $user;
    private $member;
    private $status;

    public function group_by($key, $data)
    {
        $result = array();

        foreach ($data as $val) {
            if (array_key_exists($key, $val)) {
                $result[$val[$key]][] = $val;
            } else {
                $result[""][] = $val;
            }
        }

        return $result;
    }

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
        $data['members'] = Member::with('comments', 'posts')->get();
        $data['statuses'] = $this->status->get_statuses();

        $data['posts']      = Post::with('memberss', 'statusess')->get();

        $data['comments']     = Comment::with('memberss')->get();




        $post_memberId = DB::table('posts')->pluck('member_id');
        $mem = [];
        foreach ($post_memberId as $id) {
            array_push($mem, DB::table('members')->where('id', $id)->get());
        }
        $data['membersss'] = $mem;
        // dd($data['members']);


        $post_memberId = DB::table('posts')->pluck('member_id');
        $stat = [];
        foreach ($post_memberId as $id) {
            array_push($stat, DB::table('statuses')->where('id', $id)->get());
        }
        $data['statusss'] = $stat;
        // dd($data['statusss'][0][0]);


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



        $data1 = Post::with('memberss', 'statusess')->get();
        $data2 = $data1->toArray();
        $postsArr = [];
        foreach ($data2 as $index => $counter) {
            array_push($postsArr,  $data1[$index]->getAttributes());
        }
        $byGroup = self::group_by("category", $postsArr);
        $data['categories'] = $byGroup;

        // dd($data['categories']);



        return view('index', $data);
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

    // Update Status1
    public function updateStatus1(Request $request, $id)
    {
        $status_id = $request->input('status_id');

        if ($status_id != '') {
            $data['updated_at'] = new \DateTime();
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

    // Fetch Comments Record for AJAX
    public function getComments($id)
    {
        $comments['data'] = Comment::with('memberss')->where('member_id', $id)->latest()->get();
        echo json_encode($comments);
        exit;
    }
}
