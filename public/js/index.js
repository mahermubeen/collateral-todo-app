var change_pass_btn = document.getElementById("change-pass");
        var cancel_pass_popup = document.getElementById("cancel_pass_popup");
        cancel_pass_popup.addEventListener("click", function() {
            pass_popup_wrapper.style.display = "none";
        });
        change_pass_btn.addEventListener("click", function() {
            pass_popup_wrapper.style.display = "block";
        });

        var manage_tasks = document.getElementById("manage_tasks");
        var cancel_manage_tasks = document.getElementById("cancel_manage_tasks");
        var manage_tasks_wrapper = document.getElementById("manage_tasks_wrapper");

        var manage_categories = document.getElementById("manage_categories");
        var cancel_manage_categories = document.getElementById(
            "cancel_manage_categories"
        );
        var manage_categories_wrapper = document.getElementById(
            "manage_categories_wrapper"
        );

        manage_tasks.addEventListener("click", function() {
            manage_tasks_wrapper.style.display = "block";
        });
        cancel_manage_tasks.addEventListener("click", function() {
            manage_tasks_wrapper.style.display = "none";
        });

        manage_categories.addEventListener("click", function() {
            manage_categories_wrapper.style.display = "block";
        });
        cancel_manage_categories.addEventListener("click", function() {
            manage_categories_wrapper.style.display = "none";
        });

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


        // delete_btn1.addEventListener("click", function() {
        //     delete_popup_wrapper1.style.display = "block";
        // });
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
        cancel_delete_btn1.addEventListener("click", function() {
            delete_popup_wrapper1.style.display = "none";
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
            document.querySelector("#comments_article").innerHTML = " ";
        });

        function addCommentMemberId(member) {
            document.querySelector(
                "#commentMember-img"
            ).style.backgroundImage = `url(${member.avatar})`;

            document.querySelector("#commentMember-name").innerHTML = member.name;

            document.querySelector("#commentMember-id").value = member.id;
        }

        function status_priority_dropdown(id) {
            return document.querySelector(
                `.status_priority_wrapper${id} > .status_priority_dropdown`
            );
        }

        var recent_id;

        function handleDropdown(id) {
            if (recent_id === id) {
                // for()
                if (status_priority_dropdown(id).style.display === "block") {
                    status_priority_dropdown(id).style.display = "none";
                } else {
                    status_priority_dropdown(id).style.display = "block";
                }
                console.log("yes");
            } else {
                for (
                    var i = 0; i < document.querySelectorAll(".status_priority_wrapper").length; i++
                ) {
                    document.querySelectorAll(".status_priority_wrapper ul")[
                        i
                    ].style.display = "none";
                }
                status_priority_dropdown(id).style.display = "block";
            }

            var status_priority_wrapper = document.querySelector(
                `.status_priority_wrapper${id}`
            );
            var i = 0;
            for (
                i = 0; i < status_priority_dropdown(id).querySelectorAll("li").length; i++
            ) {
                status_priority_dropdown(id)
                    .querySelectorAll("li")[i].addEventListener("click", function() {
                        var text = this.innerText;
                        if (text == "Done") {
                            status_priority_wrapper.style.backgroundColor = "#48bb77";
                            status_priority_wrapper.childNodes[1].innerText = "Done";
                        } else if (text == "Stuck") {
                            status_priority_wrapper.style.backgroundColor = "#f56464";
                            status_priority_wrapper.childNodes[1].innerText = "Stuck";
                        } else if (text == "Working On it") {
                            status_priority_wrapper.style.backgroundColor = "#d69e2e";
                            status_priority_wrapper.childNodes[1].innerText =
                                "Working On it";
                        } else if (text == "Not Started") {
                            status_priority_wrapper.style.backgroundColor = "#3182ce";
                            status_priority_wrapper.childNodes[1].innerText =
                                "Not Started";
                        }
                    });
            }
            recent_id = id;
        }

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
                                comt_date = moment().tz('America/New_York').format('MMM DD ha');

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

        function addPhoto(member, key) {
            console.log("hello", key);
            document.querySelector(
                "#prof-img-" + key
            ).style.backgroundImage = `url(${member.avatar})`;

            document.querySelector("#people-id-" + key).value = member.id;
        }