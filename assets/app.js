/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css'

// start the Stimulus application
import './bootstrap'

require("./flipclock/js/jquery.flipTimer")

$(document).ready(function () {
    $('.route_quiz_questions form>div:nth-child(1), .route_quiz_questions form>div:nth-child(2)').show()

    //on next button click
    $('button.next').on('click', function () {
        var thisbutton = $(this)
        var valueOfCheckedButton = thisbutton.parent().prev().find('input:checked').val()

        var questionId = thisbutton.parent().prev().find('.questioninputs').attr('data-id')
        var url = "evaluate/" + questionId

        $.ajax({
            url: url,
            success: function (result) {
                thisbutton.addClass('disabled')
                thisbutton.parent().prev().find('.questioninputs input, .questioninputs label').remove()

                if (result == valueOfCheckedButton) {
                    thisbutton.parent().prev().find('.questioninputs').append('<p class="text-success">Good answer</p>')
                } else {
                    thisbutton.parent().prev().find('.questioninputs').append('<p class="text-danger">Bad answer</p>')
                }

                setTimeout(function (){
                    thisbutton.parent().next().show().next().show()
                    thisbutton.parent().hide().prev().hide()
                }, 2000)
            }
        })
    })


    // timer
    var d = new Date()
    var month = d.getMonth() + 1
    var day = d.getDate()
    var output = d.getFullYear() + '/' +
        (month < 10 ? '0' : '') + month + '/' +
        (day < 10 ? '0' : '') + day + ' ' +
        d.getHours() + ":" + (d.getMinutes() + 5) + ":" + d.getSeconds()
    $('.route_quiz_questions .fliptimer').flipTimer({
        direction: 'down',
        date: output,
        callback: function () {
            alert("Time's up! The quiz will be restarted!")
            window.location.replace('/quiz')
        }
    })
})




