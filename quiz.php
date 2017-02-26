<?
if (!empty($_COOKIE['sid'])) {
    // check session id in cookies
    session_id($_COOKIE['sid']);
}

session_start();
require_once 'classes/Auth.class.php';

$questions = [ "Сколько лет вашей маме? (40)", 
        "Вы уверены в том, что это ваша мама? (Нет) ", 
        "Вы уверены в том, что вашего отца зовут Олег? (Нет)", 
        "Может быть его зовут Паша? (Да)" ];

$correct_answers = ["40",
                    "Нет",
                    "Нет",
                    "Да" ];

if ( isset( $_POST['getQuestions'] ) ) { 
    $value = array('status' => 'OK', 'questions' => $questions );
    echo json_encode( $value );
    
} else if ( isset( $_POST['number'] ) && $_POST['answer'] != "" ) {
    
    $number = $_POST['number'];
    $answer = $_POST['answer'];
    
    if ( mb_strtolower( $correct_answers[$number] ) == mb_strtolower( $answer ) ) {
        $value =  array('status' => 'correct' );
        $number++;
        $user = new Auth\User;
        $user->addAnswer($number);
        if ( count( $questions ) == $number ) {
            $value['finish'] = 1;
        }
        
    } else {
        $value =  array('status' => 'incorrect', 'number' => $number, 'answer' => $answer );
    }
    
    echo json_encode($value);
    
} else { 
    $value =  array('status' => 'error');
    echo json_encode($value);    
}
?>