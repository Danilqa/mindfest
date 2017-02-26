if (!current_question) {
    var current_question = 0;
}
var questions;

quiz = $('.quiz');
body_text = $(".quiz").find(".body-text");
input_answer = $(".input-answer");
btn_answer = $(".btn-answer");

$.ajax({
    type: "POST",
    url: "quiz.php",
    data: {
        'getQuestions': 1,
    },
    dataType: 'JSON',
    success: function (data) {
        console.log(data);
        if (data["status"] == "OK") {
            questions = data["questions"]; 
            showCurrentQuestion();
        } else if (data["status"] == "error") {
            alert("На сервере произошла ошибка. Наша команда будем вам очень благодарна, если вы сообщите нам об этом :)");
        }
    },
});

/* =========  Функции  =======  */

function showQuestion(question) {
    body_text.html( questions[question] );
}

function showCurrentQuestion() {
    if ( questions.length > current_question) {
        body_text.html( questions[current_question] );
    } else {
        quiz.html( "<h2>Вы ответили на все вопросы! Спасибо за участие.</h2>" );
    }
}

function answerQuestion(number, answer) {
    $.ajax({
        type: "POST",
        url: "quiz.php",
        data: {
            'number': number,
            'answer': answer
        },
        dataType: 'JSON',
        success: function (data) {
            console.log(data);
            if (data["status"] == "correct") {
                current_question++;
                showCurrentQuestion();
                input_answer.val("");
                
                if ( data["finish"] ) {
                    swal({
                        title: 'Поздравляем',
                        text: 'Вы справились со всеми заданиями и теперь можете пососать у Дани',
                        type: 'success',
                        confirmButtonClass: 'btn-round btn-hover info',
                        confirmButtonText: 'Ееее! Давайте сюда его писюн',
                    }); 
                }
            } else if (data["status"] == "incorrect") {
                swal({
                    title: 'Неправильный ответ :(',
                    text: 'Попробуйте ещё раз',
                    type: 'error',
                    confirmButtonClass: 'btn-round btn-hover info',
                    confirmButtonText: 'Хорошо!',
                }); 
                console.log('0');
            } else if (data["status"] == "error") {
                alert("На сервере произошла ошибка. Наша команда будем вам очень благодарна, если вы сообщите нам об этом :)");
            }
        }
    });
}

/* =========  Работа с DOM  =======  */

btn_answer.on("click", function() {
    event.preventDefault();
    
    var answer = input_answer.val();
    answerQuestion(current_question, answer);
});