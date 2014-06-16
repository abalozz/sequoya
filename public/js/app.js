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

function selectPayMethodEvents () {
    var buttons = document.querySelectorAll('.pay-method');
    var i = buttons.length;
    while (i--) {
        buttons[i].addEventListener('click', function (e) {
            var buttons = document.querySelectorAll('.pay-method');
            var i = buttons.length;
            while (i--) {
                buttons[i].parentNode.parentNode.style.borderColor = null;
                buttons[i].parentNode.parentNode.style.boxShadow = null;
            }
            e.target.parentNode.parentNode.style.borderColor = '#333';
            e.target.parentNode.parentNode.style.boxShadow = '0 0 0 1px #333';
        });
    }
}


// Cuando el contenido del DOM ha cargado...
document.addEventListener('DOMContentLoaded', function(){

    playAudioEvents();
    pauseAudioEvents();
    selectPayMethodEvents();

});
