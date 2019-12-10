<!DOCTYPE html>
<html>

<head>
    <title>Colllateral</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/ico" href="{{ asset('images/carguru-logo.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="{{ asset('https://kit.fontawesome.com/b11236bde2.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/93264cdd63.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>

<body>
    <header class="bg-white">
        <div class="container px-3 py-8 flex justify-center items-center mx-auto">
            <a href="{{url('/')}}">
                <img class="h-20" src="images/logo.png" />
            </a>
        </div>
    </header>
    <div class="container mx-auto py-16">
        <div class="flex justify-end">
            @if (Auth::check())
            <div class="mb-6 signOut-btn rounded px-4 py-2 text-center border border-purple-600 text-purple-600 mr-auto bg-white-600 text-white outline-none cursor-pointer">
                <a class="" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">
                    Logout

                    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </a>
            </div>
            @endif
            @if (Auth::check())
            <div class="flex mb-6 " id="loggedIn_btns">
                <!-- <a class="rounded px-4 py-2 text-center bg-purple-600 text-white cursor-pointer justify-between outline-none" href="{{ url('/people') }}" id="check_pupil_btn">Check People</button> -->

                <a class="rounded px-4 py-2 text-center bg-purple-600 border border-purple-600 ml-3 text-white text-white-600 cursor-pointer justify-between outline-none" href="{{ url('/dashboard') }}">Add New</a>
            </div>
            @else
            <div class="flex mb-6" id="loggedOut_btns">
                <a class="rounded px-8 ml-3 py-2 text-center bg-purple-600 text-white cursor-pointer justify-between outline-none" href="{{ url('login') }}">Sign In</a>
            </div>
            @endif
        </div>


        @if(count($categories) > 0)
        @foreach($categories as $key => $category)
        <h2 class="text-2xl uppercase">
            {{ $key }}
        </h2>
        <table class="mb-10 w-full">
            <thead>
                <tr>
                    <th width="25%" class="text-purple-600 text-xl text-left">This Week's Status</th>
                    <th width="5%">People</th>
                    <th width="15%">Status</th>
                    <th width="15%">Timeline</th>
                    <th>Time Tracking</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

                @foreach($category as $key => $post)
                <div class="fixed w-screen h-screen fixed top-0 left-0 z-50 bg-popup hidden" id="comment_wrapper">
                    <div class="center bg-white p-8 comment-popup align-left">
                        <div class="flex justify-end cross-div">
                            <i class="fa fa-times text-lg cursor-pointer text-gray-700" aria-hidden="true" style="font-size: 1.5em"></i>
                        </div>
                        <form method="POST" class="full-width mb-10" action="{{ url('/comment/add/'.$post['id']) }}" id="Update_section">
                            @csrf
                            <div class="mt-10 " id="Update_section">
                                <div href="#" style="display: grid; grid-template-columns: max-content 1fr;" class="flex text-gray-500x my-4">
                                    <div class="h-full bg-cover rounded-full mx-auto bg-gray-300 relative pic-wrapper" id="commentMember-img" style="background-image: url('images/persn.jpeg'); width: 40px; height: 40px;">
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
                            <i class="text-3xl text-gray-500 chat-icon far fa-comment"></i>
                            <div class="w-4 h-4 rounded-full text-xs bg-gray-500 text-white absolute bottom-0 right-0 pointer-events-none">
                                {{ $members[$post['member_id']-1]->comments->count() }}
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
                        <p class="text-white" id="statusValue{{ $post['id'] }}">{{ $statuses->find($post['status_id'])->name }}</p>
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
                                                                            $startDate = $post['created_at'];
                                                                            $startOf = new DateTime($startDate);

                                                                            $endDate = $post['due_date'];
                                                                            $endOf = new DateTime($endDate);

                                                                            $daysLeft = $startOf->diff($endOf)->format("%d");

                                                                            $width = ($daysLeft / 100);

                                                                            echo 'style="width: ' . $width . '%"';
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
                    <td class="text-gray-600 times text-sm">
                        {{ $post['updated_at'] }}
                    </td>
                    @endif
                    <td>
                        <button class="bg-red-800 cursor-pointer mx-auto px-5 py-2 rounded text-white">

                            <a href="{{ url('/post/destroy/'.$post['id']) }}">Delete</a>
                        </button>
                    </td>
                </tr>

                @endforeach
            </tbody>

        </table>
        @endforeach
        @else
        <div class="bg-gray-100 border-b border-gray-100"> </div>
        @endif
    </div>




    <script>
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
    </script>

    <script src="js/index.js"></script>

    <!--AJAX Script -->
    <script type='text/javascript'>
        $(document).ready(function() {
            document.querySelectorAll('.times').forEach((node) => {
                node.innerHTML = moment(node.innerHTML).fromNow()
            });
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            // Update status
            $(document).on("click", "#status_id_li", function() {
                var url = $(this).attr("data-link");

                //add it to your data
                var data = {
                    _token: $(this).data('token'),
                    testdata: 'testdatacontent'
                }
                var aa = $(this);

                var post_id = aa[0].parentNode.lastElementChild.attributes[1].nodeValue;

                var status_id = aa[0].attributes[2].value;

                if (status_id != '') {
                    $.ajax({
                        url: 'updateStatuss/' + post_id,
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
                    alert('Fill all fields');
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

</body>

</html>