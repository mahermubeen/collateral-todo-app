<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Comment;
use App\Member;

class CommentController extends Controller
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
        $this->post = new Post();
        $this->comment = new Comment();
        $this->member = new Member();
    }

    public function add_comment(Request $data, $id)
    {

        $this->validate($data, [
            'comment' => ['required', 'string', 'max:255'],
            'member_id' => ['required']
        ]);

        $data = array(
            'comment'      =>  $data['comment'],
            'member_id' => $data['member_id'],
            'post_id' => $id
        );

        $info = $this->comment->add($data);

        if ($info > 0) {
            return redirect()->back();
        } else {
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
        }
    }
}
