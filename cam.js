(function() {

    var video = document.querySelector('video'),
    canvas = document.getElementById('canvas'),
    context = canvas.getContext('2d'),
    photo = document.getElementById('photo');

    navigator.getMedia = (navigator.getUserMedia || navigator.webkitGetUserMedia ||
                         navigator.moGetUserMedia || navigator.msGetUserMedia);
    
    navigator.getMedia({
        video: true,
        audio: false
    }, function(stream){
        video.srcObject = stream;
        video.play();
    
    }, function(){
    });

    //capture image from video
    document.getElementById('capture').addEventListener('click', function(){
        console.log("Capture and save");
        context.drawImage(video, 0, 0, 400, 300);
        photo.value = canvas.toDataURL('image/png');
    });

    //insert emoji
    document.getElementById('capture1').addEventListener('click', function() {
        var img_id = document.getElementById("emos").value,
        img = document.getElementById(img_id);
        context.drawImage(img,0,0,400,300);
        photo.value = canvas.toDataURL('image/png');
    });

    document.getElementById('clear').addEventListener('click', function() {
        context.clearRect(0, 0, canvas.width, canvas.height);
    });
    
})();
