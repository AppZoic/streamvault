(function($) {
    ("use strict");

    $(window).on('load', function(event) {
        $('#loading').delay(350).fadeOut('slow');
    })

    /*====================================
        Mobile Menu
    ======================================*/
    var $offcanvasNav = $("#offcanvas-menu a");
    $offcanvasNav.on("click", function() {
        var link = $(this);
        var closestUl = link.closest("ul");
        var activeLinks = closestUl.find(".active");
        var closestLi = link.closest("li");
        var linkStatus = closestLi.hasClass("active");
        var count = 0;

        closestUl.find("ul").slideUp(function() {
            if (++count == closestUl.find("ul").length)
                activeLinks.removeClass("active");
        });
        if (!linkStatus) {
            closestLi.children("ul").slideDown();
            closestLi.addClass("active");
        }
    });

    // Sticky Menu
    function hasStickyMenu() {
        var header = document.querySelector(".header-primary");

        if (header) {
            //Sticky Menu
            window.addEventListener("scroll", function() {
                if (window.scrollY > 100) {
                    header.classList.add("sticky");
                } else {
                    header.classList.remove("sticky");
                }
            });
        }
    }
    hasStickyMenu();

    // ----- Player DOM elements via jQuery -----
    const video = $('#mainVideo')[0];

    // Check if video element exists
    if (!video) {
        console.log('Video element not found!');
        return;
    }

    const $playPause = $('#playPauseBtn');
    const $timeDisplay = $('#timeDisplay');
    const $seekSlider = $('#seekSlider');
    const $volumeBtn = $('#volumeBtn');
    const $volumeRange = $('#volumeRange');
    const $fullscreen = $('#fullscreenBtn');
    const $likeBtn = $('#likeBtn');
    const $likeCountSpan = $('#likeCount');
    const $videoTitle = $('#videoTitle');
    const $channelName = $('#channelName');

    // ----- helper functions -----
    function formatTime(seconds) {
        if (isNaN(seconds) || !isFinite(seconds) || seconds < 0) return "0:00";
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${mins}:${secs.toString().padStart(2, '0')}`;
    }

    function updateTimeUI() {
        if (!video.duration || isNaN(video.duration)) return;
        $timeDisplay.text(`${formatTime(video.currentTime)} / ${formatTime(video.duration)}`);
        $seekSlider.attr('max', video.duration);
        $seekSlider.val(video.currentTime);
    }

    function updatePlayPauseIcon(isPlaying) {
        if (isPlaying) {
            $playPause.html('<i class="fas fa-pause"></i>');
        } else {
            $playPause.html('<i class="fas fa-play"></i>');
        }
    }

    function togglePlayPause() {
        if (video.paused) {
            video.play();
        } else {
            video.pause();
        }
    }

    function updateVolumeIcon() {
        const vol = video.volume;
        if (vol === 0) {
            $volumeBtn.html('<i class="fas fa-volume-mute"></i>');
        } else if (vol < 0.4) {
            $volumeBtn.html('<i class="fas fa-volume-down"></i>');
        } else {
            $volumeBtn.html('<i class="fas fa-volume-up"></i>');
        }
    }

    function updateLikeDisplay() {
        if (currentLikes >= 1000) {
            if (currentLikes >= 1000000) {
                $likeCountSpan.text(`${(currentLikes / 1000000).toFixed(1)}M`);
            } else {
                $likeCountSpan.text(`${(currentLikes / 1000).toFixed(1)}K`);
            }
        } else {
            $likeCountSpan.text(currentLikes);
        }
    }

    // ----- event bindings using jQuery -----
    $(video).on('timeupdate', updateTimeUI);

    $(video).on('loadedmetadata', function() {
        updateTimeUI();
        $seekSlider.attr('max', video.duration);
        $timeDisplay.text(`0:00 / ${formatTime(video.duration)}`);
    });

    $(video).on('play', () => updatePlayPauseIcon(true));
    $(video).on('pause', () => updatePlayPauseIcon(false));

    $playPause.on('click', togglePlayPause);

    // seek slider
    $seekSlider.on('input', function() {
        video.currentTime = parseFloat($(this).val());
        updateTimeUI();
    });

    // volume
    $volumeRange.on('input', function() {
        video.volume = parseFloat($(this).val());
        updateVolumeIcon();
    });

    $volumeBtn.on('click', function() {
        if (video.volume > 0) {
            $(video).data('prevVolume', video.volume);
            video.volume = 0;
            $volumeRange.val(0);
        } else {
            let prev = $(video).data('prevVolume') || 0.7;
            video.volume = prev;
            $volumeRange.val(prev);
        }
        updateVolumeIcon();
    });

    // initialize volume
    video.volume = 0.7;
    $volumeRange.val(0.7);
    updateVolumeIcon();

    // fullscreen
    $fullscreen.on('click', function() {
        const wrapper = $('.video-wrapper')[0];
        if (!document.fullscreenElement) {
            if (wrapper.requestFullscreen) {
                wrapper.requestFullscreen().catch(err => console.log(err));
            } else if (wrapper.webkitRequestFullscreen) { /* Safari */
                wrapper.webkitRequestFullscreen();
            } else if (wrapper.msRequestFullscreen) { /* IE/Edge */
                wrapper.msRequestFullscreen();
            }
        } else {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
        }
    });

    // Like button logic with dynamic counter
    let liked = false;
    let currentLikes = 12000;
    updateLikeDisplay();

    $likeBtn.on('click', function() {
        liked = !liked;
        if (liked) {
            currentLikes += 100;
            $likeBtn.addClass('liked');
            $likeBtn.find('i').removeClass('far').addClass('fas');

            // If disliked was active, reset it
            if (disliked) {
                disliked = false;
                $('#dislikeBtn').removeClass('liked');
                $('#dislikeBtn').find('i').removeClass('fas').addClass('far');
            }
        } else {
            currentLikes -= 100;
            $likeBtn.removeClass('liked');
            $likeBtn.find('i').removeClass('fas').addClass('far');
        }
        updateLikeDisplay();
    });

    // Dislike button
    let disliked = false;
    $('#dislikeBtn').on('click', function() {
        disliked = !disliked;
        if (disliked) {
            $(this).addClass('liked');
            $(this).find('i').removeClass('far').addClass('fas');

            // If liked was active, reset it
            if (liked) {
                liked = false;
                currentLikes -= 100;
                updateLikeDisplay();
                $likeBtn.removeClass('liked');
                $likeBtn.find('i').removeClass('fas').addClass('far');
            }
        } else {
            $(this).removeClass('liked');
            $(this).find('i').removeClass('fas').addClass('far');
        }
    });

    // Share button alert
    $('#shareBtn').on('click', function() {
        alert('✨ Share this amazing video with your friends! (demo)');
    });

    // Handle video ended
    $(video).on('ended', function() {
        updatePlayPauseIcon(false);
    });

    // Handle video errors
    $(video).on('error', function() {
        console.error('Video failed to load');
        $timeDisplay.text('Error loading video');
    });

    // Click on video wrapper toggles play/pause
    $('.video-wrapper').on('click', function(e) {
        // Avoid conflict if click target is control button
        if ($(e.target).closest('.ctrl-btn').length || $(e.target).closest('input').length) return;
        togglePlayPause();
    });

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Spacebar
        if (e.code === 'Space' && document.activeElement !== $('input')[0]) {
            e.preventDefault();
            togglePlayPause();
        }
        // Left arrow - back 5 seconds
        if (e.code === 'ArrowLeft') {
            e.preventDefault();
            video.currentTime = Math.max(0, video.currentTime - 5);
            updateTimeUI();
        }
        // Right arrow - forward 5 seconds
        if (e.code === 'ArrowRight') {
            e.preventDefault();
            video.currentTime = Math.min(video.duration, video.currentTime + 5);
            updateTimeUI();
        }
        // F key - fullscreen
        if (e.code === 'KeyF') {
            e.preventDefault();
            $fullscreen.click();
        }
        // M key - mute
        if (e.code === 'KeyM') {
            e.preventDefault();
            $volumeBtn.click();
        }
    });

    /*====================================
        Scrool To Top JS
    ======================================*/
    $(window).on("scroll", function() {
        if ($(this).scrollTop() > 400) {
            $('.scrollToTop').addClass('show');
        } else {
            $('.scrollToTop').removeClass('show');
        }
    });

    $('.scrollToTop').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, 500);
        return false;
    });

})(jQuery, window);