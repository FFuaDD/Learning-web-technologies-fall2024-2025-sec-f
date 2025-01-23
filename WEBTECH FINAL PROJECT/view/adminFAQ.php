<?php
require_once('../model/userModel.php');
 
 
$pendingFAQs = getPendingFAQs();
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin FAQ</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #d0e7f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
 
        .faq-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 80%;
            max-width: 900px;
        }
 
        h1 {
            text-align: center;
            color: #004080;
        }
 
        h2 {
            text-align: center;
            color: #0066cc;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
 
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
 
        th {
            background-color: #0066cc;
            color: #ffffff;
        }
 
        td {
            background-color: #f9f9f9;
        }
 
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: none;
        }
 
        button {
            background-color: #004080;
            color: #ffffff;
            padding: 8px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 5px;
        }
 
        button:hover {
            background-color: #002d60;
        }
 
        p {
            text-align: center;
            color: #333333;
        }
 
        .error {
            color: red;
            font-size: 14px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="faq-container">
        <h1>Admin FAQ Panel</h1>
        <h2>Pending Questions</h2>
 
        <?php if (!empty($pendingFAQs)): ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Answer</th>
                </tr>
                <?php foreach ($pendingFAQs as $faq): ?>
                    <tr>
                        <td><?php echo $faq['id']; ?></td>
                        <td><?php echo $faq['question']; ?></td>
                        <td><?php echo $faq['role']; ?></td>
                        <td><?php echo ucfirst($faq['status']); ?></td>
                        <td>
                            <form id="faqForm_<?php echo $faq['id']; ?>" onsubmit="return validateAnswer(<?php echo $faq['id']; ?>)" method="POST" action="../controller/faqController.php">
                                <input type="hidden" name="faq_id" value="<?php echo $faq['id']; ?>">
                                <textarea id="answer_<?php echo $faq['id']; ?>" name="answer" placeholder="Enter answer"></textarea><br>
                                <span id="errorMsg_<?php echo $faq['id']; ?>" class="error"></span>
                                <button type="submit" name="action" value="answer_question">Submit Answer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>No pending questions found.</p>
        <?php endif; ?>
    </div>
 
    <script>
        function validateAnswer(faqId) {
            const answerField = document.getElementById(`answer_${faqId}`);
            const errorMsg = document.getElementById(`errorMsg_${faqId}`);
            const answer = answerField.value.trim();
 
            if (answer === "") {
                errorMsg.textContent = "Answer cannot be empty.";
                return false;
            } else {
                errorMsg.textContent = "";
                return true;
            }
        }
    </script>
</body>
</html>