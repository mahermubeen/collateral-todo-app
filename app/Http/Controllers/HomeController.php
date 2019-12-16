<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\User;
use App\Member;
use App\Status;
use DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class HomeController extends Controller
{
    private $post;
    private $comment;
    private $user;
    private $member;
    private $status;

    public function __construct()
    {
        $this->middleware('auth');
        $this->post = new Post();
        $this->comment = new Comment();
        $this->user = new User();
        $this->member = new Member();
        $this->status = new Status();
    }

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

    public function dashboard()
    {
        $data['members'] = Member::with('comments', 'posts')->get();
        $data['statuses'] = $this->status->get_statuses();
        $data['comments']     = Comment::with('memberss')->get();
        $data['posts']     = Post::with('memberss', 'statusess')->get();


        $post_memberId = DB::table('posts')->pluck('member_id');
        $countId = [];
        foreach ($post_memberId as $id) {
            array_push($countId, DB::table('comments')->where('member_id', $id)->count());
        }
        $data['counts'] = $countId;


        $data1 = Post::with('memberss', 'statusess')->get();
        $data2 = $data1->toArray();
        $postsArr = [];
        foreach ($data2 as $index => $counter) {
            array_push($postsArr,  $data1[$index]->getAttributes());
        }
        $byGroup = self::group_by("category", $postsArr);
        $data['categories'] = $byGroup;
        // dd($data['categories']);


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


        $comments_arr = [];
        foreach ($post_memberId as $id) {
            array_push($comments_arr, Comment::with('memberss')->where('member_id', $id)->get());
        }
        $data['commentsNo'] = $comments_arr;

        return view('pages.dashboard', $data);
    }


    // Fetch Comments Record for AJAX
    public function getComments($id)
    {
        $comments['data'] = Comment::with('memberss')->where('member_id', $id)->latest()->get();
        echo json_encode($comments);
        exit;
    }

    // Fetch Member Record for AJAX
    public function getMember($id)
    {
        $members['data'] = Member::where('id', $id)->get();
        echo json_encode($members);
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
                return redirect('/dashboard');
        } else {
            echo 'Fill all fields.';
        }

        exit;
    }

    // Update Status
    public function updateStatus1(Request $request, $id)
    {
        $status_id = $request->input('status_id');

        if ($status_id != '') {
            $data['updated_at'] = new \DateTime();
            $data['status_id'] = $status_id;

            // Call updateData() method of Comment Model
            $id = $this->post->edit_posts($data, $id);
            if ($id > 0)
                return redirect('/dashboard');
        } else {
            echo 'Fill all fields.';
        }

        exit;
    }


    public function update_password(Request $data)
    {
        $this->validate($data, [
            'password' => 'min:3', 'required',
            'password_confirmation' => 'required_with:password|same:password|min:3'
        ]);

        $data = array(
            'password'      =>  Hash::make($data['password'])
        );

        $info = $this->user->edit_users($data);

        if ($info > 0) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
        }
    }
}
