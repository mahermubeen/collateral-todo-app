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
            var i = 0;
            i < document.querySelectorAll(".status_priority_wrapper").length;
            i++
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
        i = 0;
        i < status_priority_dropdown(id).querySelectorAll("li").length;
        i++
    ) {
        status_priority_dropdown(id)
            .querySelectorAll("li")
            [i].addEventListener("click", function() {
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

// ==== popup handling ====
//manage_pupil_popup
var popup_wrapper = document.getElementById("popup_wrapper");
var manage_pupil_btn = document.getElementById("manage_pupil_btn");
var new_pupil_btn = document.getElementById("new_pupil_btn");
var manage_pupil_popup = document.getElementById("manage_pupil_popup");
var new_pupil_popup = document.getElementById("new_pupil_popup");
var cancel_new_pupil = document.getElementById("cancel_new_pupil");
var cancel_manage_pupil = document.getElementById("cancel_manage_pupil");
var add_task_btn = document.getElementById("add_task_btn");
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
add_task_btn.addEventListener("click", function() {
    var append_child = document.querySelector(".append-child");
    if (append_child.style.display === "table-row") {
        append_child.style.display = "none";
    } else {
        append_child.style.display = "table-row";
    }
});

function loggedIn() {
    window.location.href = "./members.html";
}

function addPhoto(member) {
    document.querySelector(
        "#prof-img"
    ).style.backgroundImage = `url(${member.avatar})`;

    document.querySelector("#people-id").value = member.id;
}

function addStatus(status) {
    document.querySelector("#status-id").value = status.id;
    document.querySelector("#ss").innerText = status.name;
}

function addCommentMemberId(member) {
    document.querySelector(
        "#commentMember-img"
    ).style.backgroundImage = `url(${member.avatar})`;

    document.querySelector("#commentMember-name").innerHTML = member.name;

    document.querySelector("#commentMember-id").value = member.id;
}

$(function() {
    $('input[name="datetimes"]').daterangepicker(
        {
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


function dispatchTimer($from, $to) {
    //Set the date we're counting down to
    var countDownDate = new Date(date).getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
        );

        // Output the result in an element with id="demo"
        document.getElementById(elementId).innerHTML =
            days + "d " + hours + "h ";

        // If the count down is over, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById(elementId).innerHTML = "EXPIRED";
        }
    }, 1000);
}
