<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">


</head>


<body class="bg-gray-100 h-screen ">
    <main class="container">
        <div class="container mx-auto p-4">
            <header class="mb-4">
                <h1 class="text-3xl font-bold">creation de quiz</h1>
                <nav>
                    <a href="/quiz/index.php" class="text-blue-500 hover:underline ml-4 p-2">Acceuil</a>
                    <a href="/quiz/app/view/quizzes/index_quizzes.php" class="text-blue-500 hover:underline ml-4 p-2">Liste des Quiz</a>
                    <a href="/quiz/app/view/quizzes/form_add_quizzes.php" class="text-blue-500 hover:underline">cree un quizz</a>
                    <a href="/quiz/app/view/questions/index_questions.php" class="text-blue-500 hover:underline">Liste des questions</a>
                    <a href="/quiz/app/view/questions/form_add_questions.php" class="text-blue-500 hover:underline">Ajouter une question</a>
                </nav>
            </header>
        </div>
        <?php echo $content ?>
    </main>
</body>

</html>