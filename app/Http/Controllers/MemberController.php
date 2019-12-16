<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Member;
use App\Post;
use App\Comment;
use App\User;

class MemberController extends Controller
{
    private $post;
    private $comment;
    private $user;
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
        $this->user = new User();
        $this->member = new Member();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add_member(Request $data)
    {
        $this->validate($data, [
            'name' => ['required', 'string', 'max:255', 'min:5'],
            'avatar' => ['required', 'string']
        ]);

        $data = array(
            'name'      =>  $data['name'],
            'avatar' => $data['avatar']
        );

        $id = $this->member->add($data);

        if ($id > 0)
            return redirect()->back();
        else
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
    }

    public function destroy_member($id)
    {
        if (!$id or $id < 1) {
            return redirect()->back();
        } else {
            $this->member->delete_member($id);
            return redirect()->back()->with('message', 'Member delete successfully.');
        }
    }

    public function edit_member($id, Request $data)
    {
        if (!$id or $id < 1)
            return redirect()->back();

        $this->validate($data, [
            'name'      =>  'required|min:1',
            'avatar' => ['required', 'string']
        ]);

        $data = array(
            'name'      =>  $data['name'],
            'avatar' => $data['avatar']
        );

        $where = array(
            'id'      =>  $id
        );

        $this->member->edit_members($data, $where);

        return redirect()->back()->with('message', 'Member edited successfully!');
    }
}
