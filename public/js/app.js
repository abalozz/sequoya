// namespaces
window.Sequoya = {};
window.Sequoya.playing = null;


// Módulo de audio
(function (window) {

    function Audio () {
        // constructor
    }

    Audio.prototype.play = function () {
        // body...
    }

    Audio.prototype.pause = function () {
        // body...
    }
    
    window.Sequoya.Audio = Audio;
})(window);


// Eventos
function playAudioEvents () {
    var play_buttons = document.querySelectorAll('.play');
    var i = play_buttons.length;
    while (i--) {
        play_buttons[i].addEventListener('click', function (e) {
            if (Sequoya.playing) {
                document.getElementById('song' + Sequoya.playing).pause();
            }
            
            Sequoya.playing = e.target.dataset.song;
            document.getElementById('song' + e.target.dataset.song).play();
        });
    }
}

function pauseAudioEvents () {
    var pause_buttons = document.querySelectorAll('.pause');
    var i = pause_buttons.length;
    while (i--) {
        pause_buttons[i].addEventListener('click', function (e) {
            document.getElementById('song' + e.target.dataset.song).pause();
        });
    }
}


// Cuando el contenido del DOM ha cargado...
document.addEventListener('DOMContentLoaded', function(){

    playAudioEvents();
    pauseAudioEvents();

});
