<?php
require_once('../model/userModel.php');
 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'add_question' && isset($_POST['question']) && isset($_POST['role'])) {
            $question = trim($_POST['question']);
            $role = trim($_POST['role']);
            if (!empty($question) && !empty($role)) {
                addFAQ($question, $role);
                header("Location: ../view/{$role}FAQ.php?success=1");
                exit();
            }
        } elseif ($_POST['action'] === 'answer_question' && isset($_POST['faq_id']) && isset($_POST['answer'])) {
            $faq_id = intval($_POST['faq_id']);
            $answer = trim($_POST['answer']);
            if (!empty($faq_id) && !empty($answer)) {
                answerFAQ($faq_id, $answer);
                header("Location: ../view/adminFAQ.php?success=1");
                exit();
            }
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
    $input = json_decode(file_get_contents('php://input'), true);
 
   
    if (isset($input['action']) && $input['action'] === 'add_question' && !empty($input['question'])) {
        $question = $input['question'];
        $role = $input['role'];
 
       
        $faq_id = addFAQ($question, $role);
 
       
        if ($faq_id) {
            echo json_encode(['success' => true, 'faq_id' => $faq_id, 'question' => $question]);
        } else {
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}
?>
 
 