/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

require("./flipclock/js/jquery.flipTimer")

$(document).ready(function() {
    $('.route_quiz_questions form>div:nth-child(1), .route_quiz_questions form>div:nth-child(2)').show();

    $('button.next').click(function (){
        $(this).parent().next().show().next().show()
        $(this).parent().hide().prev().hide()
    })

    var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear() + '/' +
        (month<10 ? '0' : '') + month + '/' +
        (day<10 ? '0' : '') + day + ' ' +
        d.getHours() + ":" + (d.getMinutes()+5) + ":" + d.getSeconds();

    $('.route_quiz_questions .fliptimer').flipTimer({
        direction: 'down',
        date: output,
        callback: function() {
            alert("Time's up! The quiz will be restarted!");
            window.location.replace('/quiz')
        }
    });
});




