<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment and Review System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container">
    <h1>Comments and Reviews</h1>

    <form id="comment-form">
        <input type="hidden" id="content-id" name="content_id" value="1"> 
        <input type="hidden" id="user-id" name="user_id" value="1">
        <textarea id="content" name="content" placeholder="Write your comment..." required></textarea>
        <select id="rating" name="rating" required>
            <option value="">Rate...</option>
            <option value="1">1 Star</option>
            <option value="2">2 Stars</option>
            <option value="3">3 Stars</option>
            <option value="4">4 Stars</option>
            <option value="5">5 Stars</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <div id="comment-section"></div>
</div>

<script src="scripts.js"></script>
</body>
</html>
