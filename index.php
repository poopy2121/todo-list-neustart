<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do-List</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <h1>To-Do-List</h1> 
        <div id="inputandbtn">
            <form action="tasks.php" method="POST" id="taskForm">
                <input type="text" name="task" id="taskInput" placeholder="Add your task">
                <button type="submit" id="add">ADD</button>
            </form>
        </div>

        <ul id="tasklist">
            <?php include 'tasks.php'; ?>
        </ul>
    </div>

    <script src="script.js"></script> 
</body>
</html>