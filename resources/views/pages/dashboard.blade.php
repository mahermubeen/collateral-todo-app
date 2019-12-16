<html lang="en">

<head>
    <title>Collateral</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/93264cdd63.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <script type="text/javascript" src="http://www.datejs.com/build/date.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script src="js/moment.js"></script>
    <script src="js/moment-with-locales.js"></script>
    <script src="js/moment-timezone.min.js"></script>
    <style>
        HTML CSS JSResult body {
            margin: 0;
            padding: 0;
        }

        canvas {
            width: 100%;
            height: 100%;
        }
    </style>

</head>

<body>
    <header class="bg-white">
        <div class="container px-3 py-8 flex justify-center items-center mx-auto">
            <a href="{{url('/')}}">
                <img class="h-20" src="images/logo.png" />
            </a>
        </div>
    </header>
    <!-- <canvas id="confeti" width="300" height="300" class="active animated rotateIn">ssgsgsdgdsg</canvas> -->
    <div class="container mx-auto pt-16">
        <div class="flex justify-end mb-6">
            @if (Auth::check())
            <div class="bg-white-600 border border-purple-600 cursor-pointer mr-3 outline-none px-4 py-2 rounded signOut-btn text-center text-purple-600 text-white">
                <a class="" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                    Logout

                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
            @endif
            @if(count($posts) > 0)
            <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="delete_popup_wrapper1">
                <div class="center bg-white p-8 rounded-lg activepopup">
                    <div class="w-full">
                        <p class="text-lg pb-6">Are you sure to delete all tasks ?</p>
                        <div class="flex justify-center mb-4">
                            <a class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32" id="delete_pupil_btn" href="{{ url('/destroy/posts') }}">Yes</a>

                            <button class="px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4 cancel_delete_btn1">
                                No
                            </button>
                        </div>
                    </div>
                </div>
            </div>


            <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="manage_tasks_wrapper">
                <div class="center bg-white p-8 rounded-lg activepopup">
                    <div class="w-full">
                        <p class="text-lg pb-6">Manage your Tasks</p>
                        <form>
                            <input class="w-full border border-purple-600 rounded-lg mb-2 py-2 px-4" placeholder="Enter Task Name" type="text" />
                            <select class="appearance-none text-gray-500 w-full border border-purple-600 rounded-lg mb-6 py-2 px-4">
                                <option>Choose Category</option>
                                <option>Category 1</option>
                                <option>Category 2</option>
                            </select>
                        </form>
                        <div class="flex justify-center mb-4">
                            <a class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32">Add</a>
                            <a class="rounded px-4 py-2 text-center bg-red-600 text-white cursor-pointer ml-3 w-32">Delete</a>
                            <button class="px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4" id="cancel_manage_tasks">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="manage_categories_wrapper">
                <div class="center bg-white p-8 rounded-lg activepopup">
                    <div class="w-full">
                        <p class="text-lg pb-6">Manage your Categories</p>
                        <form>
                            <input class="w-full border border-purple-600 rounded-lg mb-2 py-2 px-4" placeholder="Enter Category Name" type="text" />
                            <select class="appearance-none text-gray-500 w-full border border-purple-600 rounded-lg mb-6 py-2 px-4">
                                <option>Choose Category</option>
                                <option>Category 1</option>
                                <option>Category 2</option>
                            </select>
                        </form>
                        <div class="flex justify-center mb-4">
                            <a class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32">Add</a>
                            <a class="rounded px-4 py-2 text-center bg-red-600 text-white cursor-pointer ml-3 w-32">Delete</a>

                            <button class="px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4" id="cancel_manage_categories">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="pass_popup_wrapper">
                <div class="center bg-white p-8 rounded-lg activepopup">
                    <form class="w-full" action="{{ url('/update/password') }}" method="POST">
                        @csrf
                        <p>New Password</p>
                        <input class="bg-gray-200 h-full mb-8 px-3 py-3 rounded-lg text-sm w-full" type="password" name="password" placeholder="*****" autocomplete="off" />
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <p>Confirm Password</p>
                        <input class="bg-gray-200 h-full mb-8 px-3 py-3 rounded-lg text-sm w-full" type="password" name="password_confirmation" placeholder="*****" autocomplete="off" />
                        @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="flex justify-center mb-4">
                            <button class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32" type="submit">
                                Submit
                            </button>
                            <a class="text-center cursor-pointer px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4" id="cancel_pass_popup">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <a class="rounded px-4 py-2 text-center border border-purple-600 text-purple-600 mr-3 bg-white-600 text-white outline-none cursor-pointer" id="change-pass">Change Password</a>
            <a class="rounded px-4 py-2 text-center border text-white-600 mr-3 bg-purple-600 text-white outline-none cursor-pointer" id="manage_tasks">Manage Tasks</a>
            <a class="rounded px-4 py-2 text-center border text-white-600 mr-auto bg-purple-600 text-white outline-none cursor-pointer" id="manage_categories">Manage Categories</a>
            <a class="bg-red-800 cursor-pointer delete_btn1 mr-3 outline-none px-2 py-2 rounded text-white">Delete All</a>

            @endif
            <button class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer outline-none" id="manage_pupil_btn">Manage People
            </button>

        </div>

        <form method="POST" class="flex flex-no-wrap mb-10" action="{{ url('/post/add') }}" autocomplete="off">
            @csrf
            <h2 class="flex font-semibold text-lg text-purple-600 w-64">Add Group</h2>
            <input name="category" required type="text" class="bg-gray-200 h-full px-1 px-3 py-3 rounded-lg text-sm w-full" placeholder="Enter Group Name" />

            <button type="submit" class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32">
                Add
            </button>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </form>

        @if(count($categories) > 0)
        @foreach($categories as $key => $category)
        <h2 class="text-2xl uppercase">
            {{ $key }}
        </h2>
        <table class="mb-10 w-full">
            <thead>
                <tr>
                    <th width="20%" class="text-purple-600 text-xl text-left">Tasks</th>
                    <th width="5%">Team</th>
                    <th width="20%">Status</th>
                    <th width="20%">Timeline</th>
                    <th width="20%">Time Tracking</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($category as $aa => $post)
                @if($post['title'] != null && $members->find($post['member_id'])->avatar != null)
                <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="delete_popup_wrapper">
                    <div class="center bg-white p-8 rounded-lg activepopup">
                        <div class="w-full">
                            <p class="text-lg pb-6">Are you sure to delete this Task ?</p>
                            <div class="flex justify-center mb-4">
                                <a class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3 w-32" id="delete_pupil_btn" href="{{ url('/destroy/post/'. $post['id'] ) }}">Yes</a>

                                <button class="px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4" id="cancel_delete_btn">
                                    No
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="comment_wrapper">
                    <div class="center bg-white p-8 comment-popup align-left">
                        <div class="flex justify-end cross-div">
                            <i class="fa fa-times text-lg cursor-pointer text-gray-700" aria-hidden="true" style="font-size: 1.5em"></i>
                        </div>
                        <form method="POST" class="full-width mb-10" action="{{ url('/comment/add/'.$post['id']) }}" id="Update_section">
                            @csrf
                            <div class="flex justify-center items-center">
                                <a href="#" class="text-lg text-purple-600">
                                    <div class="h-12 w-12 bg-cover rounded-full mx-auto" style="background-image: url('https://collateralmanagement.org/wp-content/uploads/2019/10/Sebastian-2.jpg')"></div>
                                    <p class="ml-2 flex self-center">Sebastian Larrazabal</p>
                                </a>
                            </div>
                            <div class="mt-10 " id="Update_section">
                                <div href="#" style="display: grid; grid-template-columns: max-content 1fr;" class="flex text-gray-500x my-4">
                                    <div class="h-full bg-cover rounded-full mx-auto bg-gray-300 relative pic-wrapper" id="commentMember-img" style="background-image: url('images/person.jpeg'); width: 40px; height: 40px;">
                                        <ul class="absolute top-0 mt-12 shadow-xl -mr-2 right-0 w-48 bg-white dropdown z-50 capitalize hidden status_priority_dropdown rounded-lg" style="left:0;">
                                            @if(count($members) > 0)
                                            @foreach($members as $member)
                                            <li value="{{ $member -> id }}" onclick="addCommentMemberId({{$member}})" style="display: grid; grid-template-columns: max-content 1fr;" class="border-b border-gray-300 text-green-600 h-12 flex flex-start items-center px-4 cursor-pointer">
                                                <span class=" rounded-full bg-cover block" style="background-image: url('{{ $member -> avatar }}'); width: 30px;height: 30px;"></span>
                                                <p class="ml-3">{{ $member -> name }}</p>
                                            </li>
                                            @endforeach
                                            @endif
                                        </ul>
                                        <input name="member_id" value="" id="commentMember-id" type="text" class="hidden" />
                                    </div>
                                    <p class="ml-2 flex self-center" id="commentMember-name">Select Member</p>
                                </div>
                                <textarea type="text" name="comment" rows="4" class="w-full py-3 px-6 border border-gary-600 rounded-lg text-sm text-black outline-none focus:border-purple-600 overflow-hidden" placeholder="Write an Update..."></textarea>
                                <div class="flex justify-between items-center mb-10 mt-4">
                                    <button type="submit" class="rounded px-8  py-2 text-center bg-purple-600 text-white cursor-pointer justify-between outline-none">
                                        Comment
                                    </button>
                                    <a href="#" class="text-sm block text-right text-gray-500 hover:text-purple-600">Write updates via
                                        email <i class="fa fa-envelope ml-1" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div>
                        </form>

                        <div id="comments_article">

                        </div>
                    </div>
                </div>

                <tr class="bg-gray-100 border-b border-gray-100">
                    <td value="{{ $members->find($post['member_id'])->id }}" data-link="{{ url('/getComments/'. $members->find($post['member_id'])->id ) }}" data-token="{{ csrf_token() }}" class="bg-gray-300 text-purple-600 flex border-0 border-b-1 border-purple-600 border-l-8 flex justify-between items-center chat-container memberId">
                        {{ $post['title'] }}
                        <div class="relative chat-wrapper cursor-pointer">
                            <i class="text-3xl <?php
                                                if ($members->find($post['member_id'])->comments->count() > 0) {
                                                    echo "text-blue-700";
                                                }
                                                ?> text-gray-500 chat-icon far fa-comment"></i>
                            <div class="w-4 h-4 rounded-full text-xs <?php
                                                                        if ($members->find($post['member_id'])->comments->count() > 0) {
                                                                            echo "bg-blue-700";
                                                                        }
                                                                        ?> bg-gray-500 text-white absolute bottom-0 right-0 pointer-events-none">
                                {{ $members->find($post['member_id'])->comments->count() }}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="h-full bg-cover rounded-full mx-auto relative pic-wrapper" style="background-image: url('{{ $members->find($post['member_id'])->avatar }}'); width: 40px">
                        </div>
                    </td>
                    <td class="text-white relative cursor-pointer status_priority_wrapper status_priority_wrapper{{ $post['id']-1 }}
                        <?php
                        if ($statuses->find($post['status_id'])->name === 'Not Started') {
                            echo 'bg-blue-600';
                        } else if ($statuses->find($post['status_id'])->name === 'Done') {
                            echo 'bg-green-600';
                        } else if ($statuses->find($post['status_id'])->name === 'Working On it') {
                            echo 'bg-yellow-600';
                        } else if ($statuses->find($post['status_id'])->name === 'Stuck') {
                            echo 'bg-red-600';
                        }
                        ?>      
                        " onclick="handleDropdown({{ $post['id']-1 }})">
                        <p class="text-white" id="status_value">{{ $statuses->find($post['status_id'])->name }}</p>
                        <ul class="absolute top-0 mt-12 shadow-xl ml-20 left-0 w-48 bg-white dropdown z-50 hidden status_priority_dropdown">
                            @if(count($statuses) > 0)
                            @foreach($statuses as $status)
                            <li id="status_id_li" value="{{ $post['id'] }}" type="{{ $status->id }}" data-link="{{ url('/updateStatus/'. $post['id'] ) }}" data-token="{{ csrf_token() }}" class="border-b border-gray-300 py-3 flex flex-start items-center px-4 
                                <?php if ($status->name === 'Done') {
                                    echo 'text-green-600';
                                }
                                if ($status->name === 'Working On it') {
                                    echo 'text-yellow-600';
                                }
                                if ($status->name === 'Stuck') {
                                    echo 'text-red-600';
                                }
                                if ($status->name === 'Not Started') {
                                    echo 'text-blue-600';
                                } ?>">
                                <span class="w-4 h-4 rounded-full block mr-3 
                                    <?php if ($status->name === 'Done') {
                                        echo 'bg-green-600';
                                    }
                                    if ($status->name === 'Working On it') {
                                        echo 'bg-yellow-600';
                                    }
                                    if ($status->name === 'Stuck') {
                                        echo 'bg-red-600';
                                    }
                                    if ($status->name === 'Not Started') {
                                        echo 'bg-blue-600';
                                    } ?>"></span>
                                <p value="{{ $status -> id }}">{{ $status -> name }}</p>
                                <input type="text" class="hidden" id="status_id_input" name="status_id" />
                            </li>
                            @endforeach
                            @endif
                        </ul>
                    </td>
                    <td>
                        <span class="block mx-auto rounded-full h-6 w-6/7 bg-black overflow-hidden relative">
                            <div class="bg-purple-600 h-full z-0 relative" <?php

                                                                            if ($statuses->find($post['status_id'])->name === "Done") {
                                                                                echo 'style="width: 100%"';
                                                                            } else if ($statuses->find($post['status_id'])->name === "Not Started") {
                                                                                echo 'style="width: 0%"';
                                                                            } else {
                                                                                $startDate = $post['created_at'];
                                                                                $startOf = strtotime($startDate);

                                                                                $endDate = $post['due_date'];
                                                                                $endOf = strtotime($endDate);

                                                                                $end = \Carbon\Carbon::parse($endOf);
                                                                                $now = \Carbon\Carbon::parse($startOf);
                                                                                $hoursLeft = $end->diffInHours($now);


                                                                                $width = $hoursLeft / 100;

                                                                                echo 'style="width: ' . $width . '%"';
                                                                            }
                                                                            ?>>
                            </div>
                            <div class="text-center text-white text-sm z-0 center w-full">
                                <?php
                                $startDate = $post['created_at'];
                                $date = new DateTime($startDate);
                                $startOf = $date->format('M d');

                                $endDate = $post['due_date'];
                                $date1 = new DateTime($endDate);
                                $endOf = $date1->format('M d');

                                echo $startOf . " - " . $endOf;
                                ?>
                            </div>
                        </span>
                    </td>
                    @if($statuses->find($post['status_id'])->name === "Not Started")
                    <td></td>
                    @else
                    <td class="text-gray-600 times text-sm" id="time_done" value="{{ $post['updated_at'] }}">
                        <?php
                        if ($statuses->find($post['status_id'])->name === "Done") {
                            $startDate = $post['created_at'];
                            $startOf = strtotime($startDate);

                            $endDate = $post['updated_at'];
                            $endOf = strtotime($endDate);

                            $end = \Carbon\Carbon::parse($endOf);
                            $now = \Carbon\Carbon::parse($startOf);
                            $length = $end->diffInHours($now);

                            if ($length <= 0) {
                                $length = $end->diffInMinutes($now);
                                echo $length . " minutes";
                            } else if ($length > 24) {
                                $length = $end->diffInDays($now);
                                echo $length . " days";
                            } else {
                                echo $length . " hours";
                            }
                        } else {
                            echo \Carbon\Carbon::createFromTimeStamp(strtotime($post['created_at']))->diffForHumans();
                        }
                        ?>
                    </td>
                    @endif
                    <td>
                        <button class="bg-red-800 cursor-pointer mx-auto px-5 py-2 rounded text-white delete_btn">
                            Delete
                        </button>
                    </td>
                </tr>
                @else
                <form method="POST" action="{{ url('/post/update') }}" autocomplete="off">
                    @csrf
                    <tr class="bg-gray-100 border-b border-gray-100 append-child relative" id="tr-child">
                        <td class="bg-gray-300 flex text-purple-600 border-0 border-b-1 border-purple-600 border-l-8 justify-between items-center">
                            <input name="title" required class="h-full px-1 text-sm px-3 w-full rounded-lg" placeholder="Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </td>
                        <td width="5%">
                            <div class="h-full bg-cover rounded-full mx-auto bg-gray-300 relative pic-wrapper" id="prof-img-{{ $post['id']  }}" style="background-image: url('images/person.jpeg'); width: 40px">
                                <ul class="absolute top-0 mt-12 shadow-xl -mr-2 right-0 w-48 bg-white dropdown z-50 capitalize hidden status_priority_dropdown rounded-lg" style="left:0;">
                                    @if(count($members) > 0)
                                    @foreach($members as $dd => $member)
                                    <li value="{{ $member -> id }}" onclick="addPhoto({{$member}}, {{ $post['id'] }})" style="display: grid; grid-template-columns: max-content 1fr;" class="border-b border-gray-300 text-green-600 h-12 flex flex-start items-center px-4 cursor-pointer">
                                        <span class=" rounded-full bg-cover block" style="background-image: url('{{ $member -> avatar }}'); width: 30px;height: 30px;"></span>
                                        <p class="ml-3">{{ $member -> name }}</p>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <input name="member_id" value="" id="people-id-{{ $post['id'] }}" type="text" class="hidden" />
                            </div>
                        </td>
                        <td width="20%" class="bg-blue-600 text-white relative cursor-pointer status_priority_wrapper status_priority_wrapper{{ $post['id']+=19}}" onclick="handleDropdown({{ $post['id']}})">
                            <p class="text-white" id="ss{{ $post['id'] }}">Not Started</p>
                            <ul class="absolute top-0 mt-12 shadow-xl ml-16 left-0 w-48 bg-white dropdown z-50 hidden status_priority_dropdown">
                                @if(count($statuses) > 0)
                                @foreach($statuses as $status)
                                <li onclick="addStatus({{$status}}, {{ $post['id'] }})" class="border-b border-gray-300 py-3 flex flex-start items-center px-4 
                                <?php if ($status->name === 'Done') {
                                    echo 'text-green-600';
                                }
                                if ($status->name === 'Working On it') {
                                    echo 'text-yellow-600';
                                }
                                if ($status->name === 'Stuck') {
                                    echo 'text-red-600';
                                }
                                if ($status->name === 'Not Started') {
                                    echo 'text-blue-600';
                                } ?>">
                                    <span class="w-4 h-4 rounded-full block mr-3 
                                    <?php if ($status->name === 'Done') {
                                        echo 'bg-green-600';
                                    }
                                    if ($status->name === 'Working On it') {
                                        echo 'bg-yellow-600';
                                    }
                                    if ($status->name === 'Stuck') {
                                        echo 'bg-red-600';
                                    }
                                    if ($status->name === 'Not Started') {
                                        echo 'bg-blue-600';
                                    } ?>"></span>
                                    <p value="{{ $status -> id }}">{{ $status -> name }}</p>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            <input name="status_id" value="4" id="status-id{{ $post['id'] }}" type="text" class="hidden" />
                        </td>
                        <td width="20%">
                            <span class="block mx-auto rounded-full h-6 w-6/7 bg-black overflow-hidden relative">
                                <div class="bg-purple-600 w-0 h-full z-10 relative"></div>
                                <div class="datePicker">
                                    <input type="text" class="text-center text-white text-sm z-20 bg-transparent" id="datepicker1-{{ str_replace(' ', '', $key)  }}" disabled size="10" />
                                    <input name="datetimes" type="text" class="text-center text-white text-sm z-20  bg-transparent text-left -ml-20 pl-16" id="datepicker-{{ str_replace(' ', '', $key)  }}" size="9">
                                </div>
                                <p class="center text-white z-50">-</p>
                            </span>
                        </td>
                        <td width="20%">
                            <input name="category" required type="text" class="h-full px-1 text-sm px-3 w-full rounded-lg hidden" value="{{ $post['category'] }}" placeholder="Category" />
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </td>
                        <td>
                            <button type="submit" class="bg-red-800 cursor-pointer mx-auto px-5 py-2 rounded text-white">Add</button>
                        </td>
                    </tr>
                </form>
                @endif
                <script>
                    $(function() {
                        // $("#datepicker").datepicker();
                        var startDate = new Date();

                        $("#datepicker-{{ str_replace(' ', '', $key)  }}")
                            .datepicker()
                            .datepicker("setDate", startDate);
                        $("#datepicker1-{{ str_replace(' ', '', $key)  }}")
                            .datepicker()
                            .datepicker("setDate", startDate);
                    });
                </script>
                @endforeach

                @if($category[0]['title'] != null)
                <form method="POST" action="{{ url('/post/add') }}" autocomplete="off">
                    @csrf
                    <tr class="bg-gray-100 border-b border-gray-100 append-child relative" id="tr-child">
                        <td class="bg-gray-300 flex text-purple-600 border-0 border-b-1 border-purple-600 border-l-8 justify-between items-center">
                            <input name="title" class="h-full px-1 text-sm px-3 w-full rounded-lg" placeholder="Title">
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </td>
                        <td>
                            <div class="h-full bg-cover rounded-full mx-auto bg-gray-300 relative pic-wrapper" id="prof-img-{{ $post['id']  }}" style="background-image: url('images/person.jpeg'); width: 40px">
                                <ul class="absolute top-0 mt-12 shadow-xl -mr-2 right-0 w-48 bg-white dropdown z-50 capitalize hidden status_priority_dropdown rounded-lg" style="left:0;">
                                    @if(count($members) > 0)
                                    @foreach($members as $dd => $member)
                                    <li value="{{ $member -> id }}" onclick="addPhoto({{$member}}, {{ $post['id']  }})" style="display: grid; grid-template-columns: max-content 1fr;" class="border-b border-gray-300 text-green-600 h-12 flex flex-start items-center px-4 cursor-pointer">
                                        <span class=" rounded-full bg-cover block" style="background-image: url('{{ $member -> avatar }}'); width: 30px;height: 30px;"></span>
                                        <p class="ml-3">{{ $member -> name }}</p>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                                <input name="member_id" value="" id="people-id-{{ $post['id']  }}" type="text" class="hidden" />
                            </div>
                        </td>
                        <td class="bg-blue-600 text-white relative cursor-pointer status_priority_wrapper status_priority_wrapper{{ $post['id']+=7 }}" onclick="handleDropdown({{ $post['id'] }})">
                            <p class="text-white" id="ss{{ $post['id'] }}">Not Started</p>
                            <ul class="absolute top-0 mt-12 shadow-xl ml-16 left-0 w-48 bg-white dropdown z-50 hidden status_priority_dropdown">
                                @if(count($statuses) > 0)
                                @foreach($statuses as $status)
                                <li onclick="addStatus({{$status}}, {{ $post['id'] }})" class="border-b border-gray-300 py-3 flex flex-start items-center px-4 
                                <?php if ($status->name === 'Done') {
                                    echo 'text-green-600';
                                }
                                if ($status->name === 'Working On it') {
                                    echo 'text-yellow-600';
                                }
                                if ($status->name === 'Stuck') {
                                    echo 'text-red-600';
                                }
                                if ($status->name === 'Not Started') {
                                    echo 'text-blue-600';
                                } ?>">
                                    <span class="w-4 h-4 rounded-full block mr-3 
                                    <?php if ($status->name === 'Done') {
                                        echo 'bg-green-600';
                                    }
                                    if ($status->name === 'Working On it') {
                                        echo 'bg-yellow-600';
                                    }
                                    if ($status->name === 'Stuck') {
                                        echo 'bg-red-600';
                                    }
                                    if ($status->name === 'Not Started') {
                                        echo 'bg-blue-600';
                                    } ?>"></span>
                                    <p value="{{ $status -> id }}">{{ $status -> name }}</p>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                            <input name="status_id" value="4" id="status-id{{ $post['id'] }}" type="text" class="hidden" />
                        </td>
                        <td>
                            <span class="block mx-auto rounded-full h-6 w-6/7 bg-black overflow-hidden relative">
                                <div class="bg-purple-600 w-0 h-full z-10 relative"></div>
                                <div class="datePicker">
                                    <input type="text" class="text-center text-white text-sm z-20 bg-transparent" id="datepicker1-{{ str_replace(' ', '', $key)  }}" disabled size="10" />
                                    <input name="datetimes" type="text" class="text-center text-white text-sm z-20  bg-transparent text-left -ml-20 pl-16" id="datepicker-{{ str_replace(' ', '', $key) }}" size="9">
                                </div>
                                <p class="center text-white z-50">-</p>
                            </span>
                        </td>
                        <td>
                            <input name="category" type="text" class="h-full px-1 text-sm px-3 w-full rounded-lg hidden" value="{{ $post['category'] }}" placeholder="Category" />
                            @error('category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </td>
                        <td>
                            <button type="submit" class="bg-red-800 cursor-pointer mx-auto px-5 py-2 rounded text-white">Add</button>
                        </td>
                    </tr>
                </form>
                @else

                @endif
                <script>
                    $(function() {
                        // $("#datepicker").datepicker();
                        var startDate = new Date();

                        $("#datepicker-{{ str_replace(' ', '', $key)  }}")
                            .datepicker()
                            .datepicker("setDate", startDate);
                        $("#datepicker1-{{ str_replace(' ', '', $key)  }}")
                            .datepicker()
                            .datepicker("setDate", startDate);
                    });
                </script>

            </tbody>

        </table>
        @endforeach
        @else
        <div class="bg-gray-100 border-b border-gray-100"> </div>
        @endif

        <div class="flex justify-end mb-4">
            <a class="rounded px-4 py-2 text-center bg-white-600 border border-purple-600 ml-3 text-purple-600 cursor-pointer justify-between outline-none mt-8" href="{{url('/')}}">Go Back</a>
        </div>
    </div>

    <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="popup_wrapper">
        <div class="center bg-white p-8 container rounded-lg hidden activepopup" id="manage_pupil_popup">
            <div>
                <div class="flex justify-end mb-4">
                    <button class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer ml-3" id="new_pupil_btn">Add
                        New People
                    </button>
                    <button class="px-4 py-2 text-md border border-gray-600 text-gray-600 rounded outline-none w-32 ml-4" id="cancel_manage_pupil">
                        Close
                    </button>
                </div>
                <table class="w-full">
                    <thead>
                        <tr>
                            <th width="60%" class="text-purple-600 text-xl text-left">Name</th>
                            <th>People</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(count($members) > 0)
                        @foreach($members as $member)
                        <tr value="{{ $member->id }}" class="bg-gray-100 border-b border-gray-100">
                            <td class="bg-gray-300 text-purple-600 flex border-0 border-b-1 border-purple-600 border-l-8 flex justify-between items-center">
                                {{ $member -> name }}
                            </td>
                            <td>
                                <div class="h-full bg-cover rounded-full mx-auto" style="background-image: url('{{ $member->avatar }}'); width: 40px"></div>
                            </td>
                            <td>
                                <button class="bg-red-800 cursor-pointer mx-auto px-5 py-2 rounded text-white">
                                    <a href="{{ url('/member/destroy/'.$member -> id) }}">Delete</a>
                                </button>
                                <button class="cursor-pointer text-center bg-yellow-600 cursor-pointer mx-auto px-5 py-2 rounded text-white edit_member_btn">
                                    Edit

                                </button>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="center bg-white p-8 container rounded-lg hidden edit_member_wrapper" style="display: none;">
            <div class="flex justify-end cross-div1">
                <i class="fa fa-times text-lg cursor-pointer text-gray-700 edit_popup_cross" aria-hidden="true" style="font-size: 1.5em"></i>
            </div>

            <div id="edit_member_popup">
            </div>
        </div>


        <div class="center bg-white p-8 container rounded-lg hidden" id="new_pupil_popup" style="display: none;">
            <form method="POST" action="{{ url('/member/add') }}" autocomplete="off">
                @csrf
                <div class="mt-8 ">
                    <h1 class="text-xl text-purple-600 mb-3 text-lg font-bold mb-6 outline-none">Add New Person</h1>
                    <div class="w-full">
                        <input class="shadow w-full text-md mb-6 p-3" name="name" type="text" placeholder="Enter Name">
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <input class="shadow w-full text-md mb-6 p-3" type="text" name="avatar" placeholder="Enter URL">
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="px-4 py-2 text-md bg-purple-600 text-white rounded-lg outline-none w-32">
                                Add
                            </button>
                            <a class="text-center cursor-pointer px-4 py-2 text-md border border-gray-600 text-gray-600 rounded-lg outline-none w-32 ml-4" id="cancel_new_pupil">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>




    <script>
        // ==== popup handling ====
        //manage_pupil_popup
        var popup_wrapper = document.getElementById("popup_wrapper");

        var delete_btn1 = document.querySelector(".delete_btn1");
        var cancel_delete_btn1 = document.querySelector(".cancel_delete_btn1");
        var delete_popup_wrapper1 = document.getElementById("delete_popup_wrapper1");

        var pass_popup_wrapper = document.getElementById("pass_popup_wrapper");
        var manage_pupil_btn = document.getElementById("manage_pupil_btn");
        var new_pupil_btn = document.getElementById("new_pupil_btn");
        var manage_pupil_popup = document.getElementById("manage_pupil_popup");
        var new_pupil_popup = document.getElementById("new_pupil_popup");
        var cancel_new_pupil = document.getElementById("cancel_new_pupil");
        var cancel_manage_pupil = document.getElementById("cancel_manage_pupil");
        manage_pupil_btn.addEventListener("click", function() {
            popup_wrapper.style.display = "block";
            manage_pupil_popup.style.display = "block";
            manage_pupil_popup.classList.add("activepopup");
        });
        new_pupil_btn.addEventListener("click", function() {
            manage_pupil_popup.style.display = "none";
            new_pupil_popup.style.display = "block";
            new_pupil_popup.classList.add("activepopup");
        });
        cancel_new_pupil.addEventListener("click", function() {
            manage_pupil_popup.style.display = "block";
            new_pupil_popup.style.display = "none";
        });

        cancel_manage_pupil.addEventListener("click", function() {
            popup_wrapper.style.display = "none";
            manage_pupil_popup.style.display = "none";
            new_pupil_popup.style.display = "none";
        });


        delete_btn1.addEventListener("click", function() {
            delete_popup_wrapper1.style.display = "block";
        });
        var edit_member_btn = document.querySelectorAll(".edit_member_btn");
        var edit_member_wrapper = document.querySelector(".edit_member_wrapper");
        var manage_pupil_popup = document.getElementById("manage_pupil_popup");
        var edit_popup_cross = document.querySelector(".edit_popup_cross");
        var edit_member_popup = document.querySelector("#edit_member_popup");

        for (var i = 0; i < edit_member_btn.length; i++) {

            edit_member_btn[i].addEventListener("click", function() {
                manage_pupil_popup.style.display = "none";
                edit_member_wrapper.style.display = "block";
                edit_member_wrapper.classList.add("activepopup");

                var aa = $(this);
                var member_id = aa[0].parentNode.parentNode.attributes[0].value;

                $.ajax({
                    url: "getMember/" + member_id,
                    type: "get",
                    dataType: "json",
                    success: function(response) {
                        var len = 0;

                        if (response["data"] != null) {
                            len = response["data"].length;
                        }

                        if (len > 0) {
                            console.log(response["data"]);
                            var member_avatar = response["data"][0].avatar;
                            var member_name = response["data"][0].name;

                            var tr_str =
                                "<form method='POST' action='/member/edit/" +
                                member_id +
                                "' autocomplete='off'>" +
                                "<div class='mt-8'>" +
                                "<h1 class='text-xl text-purple-600 mb-3 text-lg font-bold mb-6 outline-none'>Edit Member" +
                                "</h1>" +
                                "<div class='w-full'>" +
                                "<input class='shadow w-full text-md mb-6 p-3' name='name' type='text' value='" +
                                member_name +
                                "' placeholder='Enter Name'>" +
                                "<input class='shadow w-full text-md mb-6 p-3' type='text' name='avatar' value='" +
                                member_avatar +
                                "' placeholder='Enter URL'>" +
                                "<div class='flex justify-center mt-4'>" +
                                "<button type='submit' class='px-4 py-2 text-md bg-purple-600 text-white rounded-lg outline-none w-32'>Update" +
                                "</button>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "</form>";

                            $("#edit_member_popup").append(tr_str);
                        } else {
                            var tr_str =
                                "<div class='flex justify-between items-center'>" +
                                "<p>Sorry, No Data Available!</p>" +
                                "</div>";

                            $("#edit_member_popup").append(tr_str);
                        }
                    }
                });
            });
        }

        edit_popup_cross.addEventListener("click", function() {
            edit_member_popup.innerHTML = " ";
            manage_pupil_popup.style.display = "block";
            edit_member_wrapper.style.display = "none";
        });
        var delete_btn = document.querySelectorAll(".delete_btn");
        var cancel_delete_btn = document.getElementById("cancel_delete_btn");
        var delete_popup_wrapper = document.getElementById("delete_popup_wrapper");
        for (var i = 0; i < delete_btn.length; i++) {
            delete_btn[i].addEventListener("click", function() {
                delete_popup_wrapper.style.display = "block";
            });
        }
        cancel_delete_btn.addEventListener("click", function() {
            delete_popup_wrapper.style.display = "none";
        });


        $(function() {
            $('input[name="datetimes"]').daterangepicker({
                    startDate: moment().startOf("hour"),
                    endDate: moment()
                        .startOf("hour")
                        .add(32, "hour"),
                    locale: {
                        format: "MMM DD/YY"
                    }
                },
                function(start, end, label) {
                    var years = moment().diff(start, "date");
                    alert("You are " + years + " years old!");
                }
            );
        });
        var comment_wrapper = document.getElementById("comment_wrapper");
        var comment_wrapper_cross = comment_wrapper.querySelector(".fa-times");
        var comments = document.querySelectorAll(".chat-container");
        for (var i = 0; i < comments.length; i++) {
            comments[i].addEventListener("click", function() {
                comment_wrapper.style.display = "block";
            });
        }
        comment_wrapper_cross.addEventListener("click", function() {
            comment_wrapper.style.display = "none";
            document.querySelector('#comments_article').innerHTML = " ";
        });
        cancel_delete_btn1.addEventListener("click", function() {
            delete_popup_wrapper1.style.display = "none";
        });
    </script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script src="js/index.js"></script>
    <script src="http://momentjs.com/downloads/moment.js"></script>

    <script src="https://momentjs.com/downloads/moment-timezone-with-data-10-year-range.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <!--AJAX Script -->
    <script type='text/javascript'>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Update status
            $(document).on("click", "#status_id_li", function() {
                var aa = $(this);

                var post_id = aa[0].parentNode.lastElementChild.attributes[1].nodeValue;
                var status_id = aa[0].attributes[2].value;
                var status_value = aa[0].childNodes[3].innerHTML;

                if (status_value === "Done") {
                    $.ajax({
                        url: 'updateStatus1/' + post_id,
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            status_id: status_id
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                } else {
                    $.ajax({
                        url: 'updateStatus/' + post_id,
                        type: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            status_id: status_id
                        },
                        success: function(response) {
                            location.reload();
                        }
                    });
                }
            });

            //Fetch comments function 
            $(document).on("click", ".memberId", function() {
                var url = $(this).attr("data-link");

                //add it to your data
                var data = {
                    _token: $(this).data('token'),
                    testdata: 'testdatacontent'
                }
                var aa = $(this);


                var member_id = aa[0].attributes[0].nodeValue;

                $.ajax({
                    url: 'getCommentss/' + member_id,
                    type: 'get',
                    dataType: 'json',
                    success: function(response) {

                        var len = 0;

                        if (response['data'] != null) {

                            len = response['data'].length;
                        }

                        if (len > 0) {
                            for (var i = 0; i < len; i++) {


                                var member_avatar = response['data'][i].memberss.avatar;
                                var member_name = response['data'][i].memberss.name;

                                var comt_date = response['data'][i].created_at;
                                comt_date = moment().format("MMM DD");

                                var comment_body = response['data'][i].comment;


                                var tr_str = "<article class='mb-10 p-6 border border-gary-600 rounded-lg m-bottom'>" +
                                    "<div class='flex justify-between items-center'>" +
                                    "<a href='#' class='flex text-gray-500 hover:text-purple-600'>" +
                                    '<div class="h-12 w-12 bg-cover rounded-full mx-auto" style="background-image: url' + "('" + member_avatar + "')" + '">' +
                                    "</div>" +
                                    "<p class='ml-2 flex self-center'>" + member_name + "</p>" +
                                    "</a>" +
                                    "<select class='select appearance-none py-1 pl-6 pr-8 outline-none text-gray-500 cursor-pointer'>" +
                                    "<option>" + comt_date + "</option>" +
                                    "</select>" +
                                    "</div>" +
                                    "<p class='text-base pt-6'>" + comment_body + "</p>" +
                                    "</article>";

                                $("#comments_article").append(tr_str);

                            }
                        } else {
                            var tr_str = "<div class='flex justify-between items-center'>" +
                                "<p>Sorry, No Comments Available!</p>" +
                                "</div>";

                            $("#comments_article").append(tr_str);
                        }

                    }
                });
            });
        })
    </script>
    <script>
        var manage_tasks = document.getElementById("manage_tasks");
        var cancel_manage_tasks = document.getElementById("cancel_manage_tasks");
        var manage_tasks_wrapper = document.getElementById("manage_tasks_wrapper");

        var manage_categories = document.getElementById("manage_categories");
        var cancel_manage_categories = document.getElementById("cancel_manage_categories");
        var manage_categories_wrapper = document.getElementById("manage_categories_wrapper");

        manage_tasks.addEventListener('click', function() {
            manage_tasks_wrapper.style.display = "block";
        })
        cancel_manage_tasks.addEventListener('click', function() {
            manage_tasks_wrapper.style.display = "none";
        })


        manage_categories.addEventListener('click', function() {
            manage_categories_wrapper.style.display = "block";
        })
        cancel_manage_categories.addEventListener('click', function() {
            manage_categories_wrapper.style.display = "none";
        })
    </script>

    <!-- animation script -->
    <script>
        var COLORS, Confetti, NUM_CONFETTI, PI_2, canvas, confetti, context, drawCircle, drawCircle2, drawCircle3, i, range, xpos;
        NUM_CONFETTI = 40;
        COLORS = [
            [235, 90, 70],
            [97, 189, 79],
            [242, 214, 0],
            [0, 121, 191],
            [195, 119, 224]
        ];
        PI_2 = 2 * Math.PI;
        canvas = document.getElementById("confeti");
        context = canvas.getContext("2d");
        window.w = 0;
        window.h = 0;
        window.resizeWindow = function() {
            window.w = canvas.width = window.innerWidth;
            return window.h = canvas.height = window.innerHeight
        };
        window.addEventListener("resize", resizeWindow, !1);
        window.onload = function() {
            return setTimeout(resizeWindow, 0)
        };
        range = function(a, b) {
            return (b - a) * Math.random() + a
        };
        drawCircle = function(a, b, c, d) {
            context.beginPath();
            context.moveTo(a, b);
            context.bezierCurveTo(a - 17, b + 14, a + 13, b + 5, a - 5, b + 22);
            context.lineWidth = 2;
            context.strokeStyle = d;
            return context.stroke()
        };
        drawCircle2 = function(a, b, c, d) {
            context.beginPath();
            context.moveTo(a, b);
            context.lineTo(a + 6, b + 9);
            context.lineTo(a + 12, b);
            context.lineTo(a + 6, b - 9);
            context.closePath();
            context.fillStyle = d;
            return context.fill()
        };
        drawCircle3 = function(a, b, c, d) {
            context.beginPath();
            context.moveTo(a, b);
            context.lineTo(a + 5, b + 5);
            context.lineTo(a + 10, b);
            context.lineTo(a + 5, b - 5);
            context.closePath();
            context.fillStyle = d;
            return context.fill()
        };
        xpos = 0.9;
        document.onmousemove = function(a) {
            return xpos = a.pageX / w
        };
        window.requestAnimationFrame = function() {
            return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame || function(a) {
                return window.setTimeout(a, 5)
            }
        }();
        Confetti = function() {
            function a() {
                this.style = COLORS[~~range(0, 5)];
                this.rgb = "rgba(" + this.style[0] + "," + this.style[1] + "," + this.style[2];
                this.r = ~~range(2, 6);
                this.r2 = 2 * this.r;
                this.replace()
            }
            a.prototype.replace = function() {
                this.opacity = 0;
                this.dop = 0.03 * range(1, 4);
                this.x = range(-this.r2, w - this.r2);
                this.y = range(-20, h - this.r2);
                this.xmax = w - this.r;
                this.ymax = h - this.r;
                this.vx = range(0, 2) + 8 * xpos - 5;
                return this.vy = 0.7 * this.r + range(-1, 1)
            };
            a.prototype.draw = function() {
                var a;
                this.x += this.vx;
                this.y += this.vy;
                this.opacity +=
                    this.dop;
                1 < this.opacity && (this.opacity = 1, this.dop *= -1);
                (0 > this.opacity || this.y > this.ymax) && this.replace();
                if (!(0 < (a = this.x) && a < this.xmax)) this.x = (this.x + this.xmax) % this.xmax;
                drawCircle(~~this.x, ~~this.y, this.r, this.rgb + "," + this.opacity + ")");
                drawCircle3(0.5 * ~this.x, ~this.y, this.r, this.rgb + "," + this.opacity + ")");
                return drawCircle2(1.5~~this.x, 1.5~~this.y, this.r, this.rgb + "," + this.opacity + ")")
            };
            return a
        }();
        confetti = function() {
            var a, b, c;
            c = [];
            i = a = 1;
            for (b = NUM_CONFETTI; 1 <= b ? a <= b : a >= b; i = 1 <= b ? ++a : --a) c.push(new Confetti);
            return c
        }();
        window.step = function() {
            var a, b, c, d;
            requestAnimationFrame(step);
            context.clearRect(0, 0, w, h);
            d = [];
            b = 0;
            for (c = confetti.length; b < c; b++) a = confetti[b], d.push(a.draw());
            return d
        };
        step();;
    </script>
</body>

</html>