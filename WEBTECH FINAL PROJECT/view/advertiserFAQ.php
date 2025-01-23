<?php
require_once('../model/userModel.php');
$advertiserFAQs = getFAQsByRole('advertiser');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Advertiser FAQ</title>
    <style>
        body {
            background-color: #e0f7fa; /* Light blue background */
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
            color: #007bb5; /* Blue color for the title */
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
            background-color: #007bb5; /* Blue header background */
            color: white;
        }

        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: none;
        }

        button {
            background-color: #007bb5; /* Blue button background */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #005f8c; /* Darker blue on hover */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Advertiser FAQ</h1>

    <h2>Frequently Asked Questions</h2>
    <?php if (!empty($advertiserFAQs)): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Answer</th>
            </tr>
            <?php foreach ($advertiserFAQs as $faq): ?>
                <tr>
                    <td><?php echo $faq['id']; ?></td>
                    <td><?php echo htmlspecialchars($faq['question']); ?></td>
                    <td><?php echo htmlspecialchars($faq['answer'] ?? 'Pending'); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No FAQs available yet.</p>
    <?php endif; ?>

    <h2>Ask a Question</h2>
    <form method="POST" action="../controller/faqController.php">
        <textarea name="question" placeholder="Ask your question" required></textarea><br>
        <input type="hidden" name="role" value="advertiser">
        <button type="submit" name="action" value="add_question">Submit Question</button>
    </form>
</div>
</body>
</html>
