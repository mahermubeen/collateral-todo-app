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
        $data['members']  = $this->member->get_members();
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




        // $postsss = [];
        // foreach ($cat_col as $cat) {
        //     array_push($postsss, DB::table('posts')->where('category', '=', $cat)->get());
        // }


        // $data['categories'] = "SELECT  id, title, member_id ,status_id , due_date, posts.category
        // FROM posts
        // INNER JOIN(
        // SELECT category
        // FROM posts
        // GROUP BY category
        // HAVING COUNT(title) >1
        // )temp ON posts.category= temp.category";

        // $cat_col = DB::table('posts')->pluck('category');

        // $postsss = [];
        // foreach ($cat_col as $cat) {
        //     array_push(
        //         $postsss,
        //         DB::table('posts')
        //             ->select(['title', 'category'])
        //             ->join('posts', 'category', '=', $cat)
        //             ->groupBy('category')
        //             ->get()
        //     );
        // }

        // $data['categories'] =  DB::select('id','title','member_id','status_id','due_date','posts.category')
        //     ->from('posts')
        //     ->join('posts', 'category', '=', $cat)
        //     ->groupBy('category')
        //     ->get();
        $post_id = DB::table('posts')->pluck('id');
        $data1 = Post::with('memberss', 'statusess')->get();
        $postsArr = [];
        foreach ($post_id as $id) {
            array_push($postsArr,  $data1[$id - 1]->getAttributes());
        }
        $byGroup = self::group_by("category", $postsArr);
        $data['categories'] = $byGroup;
        // dd($data['categories']);

        // $data1 = Post::with('memberss', 'statusess')->get();
        // $data = $data1[$id]->getAttributes();
        // dd($data);

        return view('index', $data);
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

    // Fetch Comments Record for AJAX
    public function getComments($id)
    {
        $comments['data'] = Comment::with('memberss')->where('member_id', $id)->get();
        echo json_encode($comments);
        exit;
    }
}
