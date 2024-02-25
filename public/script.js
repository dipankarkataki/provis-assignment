document.addEventListener('DOMContentLoaded', function() {
    const myVideoPlayer = document.getElementById('myVideoPlayer');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const skipVideoBtn = document.getElementById('skipVideoBtn');
    let videoWatchDuration = null;

    playPauseBtn.addEventListener('click', function() {
        if (myVideoPlayer.paused) {
            myVideoPlayer.play();
        } else {
            myVideoPlayer.pause();
        }
        videoWatchDuration = myVideoPlayer.currentTime;

        console.log('Video watched ==> ', myVideoPlayer.duration);
        console.log('Video watched ==> ', videoWatchDuration);
    });
});