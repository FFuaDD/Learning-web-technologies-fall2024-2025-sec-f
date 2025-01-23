<?php
require_once('../model/userModel.php');
 
$viewerFAQs = getFAQsByRole('viewer');
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Viewer FAQ</title>
    <style>
        body {
            background-color: #f8d7da; /* Light pink background */
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
 
        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white; /* White background for the content */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
 
        h1 {
            color: #c2185b; /* Pink color for the title */
            margin-bottom: 20px;
        }
 
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
 
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
 
        th {
            background-color: #c2185b; /* Pink header background */
            color: white;
        }
 
        td {
            background-color: #f9f9f9;
        }
 
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }
 
        button {
            background-color: #c2185b; /* Pink button background */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
 
        button:hover {
            background-color: #a31545; /* Darker pink on hover */
        }
 
        #msg {
            margin-top: 20px;
            color: #28a745;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Viewer FAQ</h1>
 
    <h2>Frequently Asked Questions</h2>
    <?php if (!empty($viewerFAQs)): ?>
        <table id="faqTable">
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
            </tr>
            <?php foreach ($viewerFAQs as $faq): ?>
                <tr id="faq-<?php echo $faq['id']; ?>">
                    <td><?php echo htmlspecialchars($faq['id']); ?></td>
                    <td><?php echo htmlspecialchars($faq['question']); ?></td>
                    <td><?php echo htmlspecialchars($faq['answer'] ?? 'Pending'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No FAQs available yet.</p>
    <?php endif; ?>
 
    <h2>Ask a Question</h2>
    <form id="faqForm">
        <textarea name="question" id="question" placeholder="Ask your question" required></textarea><br>
        <input type="hidden" name="role" value="viewer">
        <button type="button" onclick="submitQuestion()">Submit Question</button>
    </form>
 
    <p id="msg"></p>
</div>
 
<script>
    function submitQuestion() {
        let question = document.getElementById('question').value;
        let role = document.querySelector('input[name="role"]').value;
 
       
        let xhttp = new XMLHttpRequest();
        xhttp.open('POST', '../controller/faqController.php', true);
        xhttp.setRequestHeader('Content-Type', 'application/json');
 
     
        let data = JSON.stringify({ question: question, role: role, action: 'add_question' });
        xhttp.send(data);
 
       
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                let response = JSON.parse(this.responseText);
                if (response.success) {
                   
                    let faqTable = document.getElementById('faqTable');
                    let newRow = faqTable.insertRow(1); // Insert at the top
                    let idCell = newRow.insertCell(0);
                    let questionCell = newRow.insertCell(1);
                    let answerCell = newRow.insertCell(2);
 
             
                    idCell.innerHTML = 'new';
                    questionCell.innerHTML = question;
                    answerCell.innerHTML = 'Pending';
 
               
                    document.getElementById('faqForm').reset();
                    document.getElementById('msg').innerHTML = 'Your question has been submitted!';
                } else {
                    document.getElementById('msg').innerHTML = 'There was an error submitting your question.';
                }
            }
        };
    }
</script>
 
</body>
</html>