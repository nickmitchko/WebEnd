/**
 * Created by nicholai on 11/11/16.
 */
var emotions = ["neutral", "anger", "happy", "disgust", "fear", "happy", "contempt", "surprise"];
var currentEmotion = "";
$(document).ready(
    function () {
        buildOptions();
        initVideoStream();
    }
);

function buildOptions() {
    var a = $('#options');
    for (var emote in emotions) {
        a.append('<li class="mdl-menu__item">'+emotions[emote]+'</li>')
    }
}

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
    $('#options li').on("click", function () {
        currentEmotion = $(this).text();
        context.drawImage(video, 0, 0, 640, 480);
        canvas.toBlob(processFrame, 'image/jpeg');
    });
}

function processFrame(blob) {
    if (currentEmotion != "") {
        var form = new FormData();
        form.append('file', blob);
        form.append('emotion', currentEmotion);
        $.ajax({
            type: 'POST',
            url: 'trainupload.php',
            data: form,
            processData: false,
            contentType: false,
            success: writePicture
        });
    }
}


function writePicture(data) {
    var dat = {message: 'Emotion ' + data + ' trained'};
    var snackbarContainer = document.querySelector('#demo-toast-example');
    snackbarContainer.MaterialSnackbar.showSnackbar(dat);
}

