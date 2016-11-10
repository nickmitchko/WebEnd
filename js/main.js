$("#resume_btn").click(
    function () {
        $(".link.resume").show(900);
        $(this).off();
    }
);

$("#upload_btn").click(
    function () {
        $("#sc").show();
        $(this).off();

    }
);


$(document).ready(
    function () {
        initVideoStream();
    }
);

function initVideoStream() {
    var constraints = {audio: false, video: {width: 1280, height: 720}};
    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (mediaStream) {
            var video = document.querySelector('video');
            video.srcObject = mediaStream;
            video.onloadedmetadata = function (e) {
                initPicture();
                video.play();
            };
        })
        .catch(function (err) {
            console.log(err.name + ": " + err.message);
        });
}

function initPicture() {
    var canvas = document.getElementById('canvas_hidden');
    var context = canvas.getContext('2d');
    var video = document.getElementById('video-bg');

// Trigger photo take
    document.getElementById("snap").addEventListener("click", function () {
        context.drawImage(video, 0, 0, 640, 480);
        canvas.toBlob(processFrame, 'image/jpeg');
    });
    document.getElementById("auto").addEventListener("click", function () {
        setInterval(
            function () {
                context.drawImage(video, 0, 0, 640, 480);
                canvas.toBlob(processFrame, 'image/jpeg');
            },
            1000
        );

    });
}

function processFrame(blob) {
    var form = new FormData();
    form.append('file', blob);
    $.ajax({
        type: 'POST',
        url: 'upload.php',
        data: form,
        processData: false,
        contentType: false,
        success: writePicture
    });
}



function writePicture(data) {
    console.log(data);
    var canvas = document.getElementById('canvas');
    var context = canvas.getContext('2d');
    var arr = JSON.parse(data);
    context.clearRect(0,0,640, 480);
    for(var face in arr){
        if (Array.isArray(arr[face])){
            context.strokeStyle="#F4D03F";
            context.strokeRect( arr[face][3], arr[face][1], arr[face][4] - arr[face][3], arr[face][2]- arr[face][1]);
            context.font = "20px Helvetica";
            context.fillStyle = "#F4D03F";
            context.fillText("" + getEmotion(arr[face][0]), arr[face][3] + 10, arr[face][1] + 15);
        } else {
            context.font = "20px Helvetica";
            context.fillStyle = "#FF0000";
            context.fillText("Emotion Not Found" , 30, 30);
        }
    }
    if (arr.length < 1){
        context.font = "20px Helvetica";
        context.fillStyle = "#FF0000";
        context.fillText("Emotion Not Found" , 30, 30);
    }
}

var emotions = ["neutral", "anger", "happy", "disgust", "fear", "happy", "contempt", "surprise", "No Emotion"];

function getEmotion(number){
    return emotions[number];
}