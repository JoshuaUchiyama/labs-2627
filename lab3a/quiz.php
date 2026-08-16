<?php

require "helpers.php";

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Get registration information
$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];
$agree = $_POST['agree'];

// Retrieve quiz data
$quiz = retrieve_questions();

// Get the actual questions
$questions = $quiz['questions'];

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>IPT10 Laboratory Activity #3A</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

</head>

<body>

<section class="section">

<div class="container">

    <h1 class="title">
        PHP Quiz
    </h1>

    <h2 class="subtitle">
        Answer all <?php echo MAX_QUESTION_NUMBER; ?> questions.
    </h2>


    <form method="POST" action="result.php">

        <!-- Registration information -->

        <input type="hidden"
               name="complete_name"
               value="<?php echo htmlspecialchars($complete_name); ?>">

        <input type="hidden"
               name="email"
               value="<?php echo htmlspecialchars($email); ?>">

        <input type="hidden"
               name="birthdate"
               value="<?php echo htmlspecialchars($birthdate); ?>">

        <input type="hidden"
               name="contact_number"
               value="<?php echo htmlspecialchars($contact_number); ?>">

        <input type="hidden"
               name="agree"
               value="<?php echo htmlspecialchars($agree); ?>">


        <!-- Questions -->

        <?php foreach ($questions as $question_number => $question): ?>

            <div class="box">

                <h3 class="title is-5">
                    Question <?php echo $question_number + 1; ?>
                </h3>

                <p class="mb-4">
                    <?php echo htmlspecialchars($question['question']); ?>
                </p>


                <?php foreach ($question['options'] as $option): ?>

                    <div class="field">

                        <label class="radio">

                            <input
                                type="radio"
                                name="answers[<?php echo $question_number; ?>]"
                                value="<?php echo htmlspecialchars($option['key']); ?>"
                                required
                            >

                            <?php echo htmlspecialchars($option['value']); ?>

                        </label>

                    </div>

                <?php endforeach; ?>

            </div>

        <?php endforeach; ?>


        <button
            type="submit"
            class="button is-primary">

            Submit Quiz

        </button>

    </form>

</div>

</section>


<script>

setTimeout(function () {

    document.querySelector("form").submit();

}, 60000);

</script>

</body>

</html>