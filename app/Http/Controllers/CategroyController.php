<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Post;
use App\Comment;
use App\User;

class CategroyController extends Controller
{
    private $post;
    private $comment;
    private $user;
    private $category;
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
        $this->category = new Category();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function add_category(Request $data)
    {
        $this->validate($data, [
            'category' => ['required', 'string', 'max:255', 'min:5']
        ]);

        $data = array(
            'name'      =>  $data['category']
        );

        $id = $this->category->add($data);

        if ($id > 0)
            return redirect()->back()->with('success', 'Category Added Successfully!');
        else
            return redirect()->back()->with('error', 'Error! Please try again.')->withInput();
    }

    public function destroy_category($id)
    {
        if (!$id or $id < 1) {
            return redirect()->back()->with('error', 'Error! Please try again.');
        } else {
            $this->category->delete_category($id);
            return redirect()->back()->with('success', 'Category Deleted Successfully!');
        }
    }

    public function edit_category($id, Request $data)
    {
        if (!$id or $id < 1)
            return redirect()->back()->with('error', 'Error! Please try again.');

        $this->validate($data, [
            'category'      =>  'required|min:1'
        ]);

        $data = array(
            'name'      =>  $data['category']
        );

        $where = array(
            'id'      =>  $id
        );

        $this->category->edit_categories($data, $where);

        return redirect()->back()->with('success', 'Category Updated Successfully!');
    }
}
