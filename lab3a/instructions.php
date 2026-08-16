<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$complete_name = $_POST['complete_name'];
$email = $_POST['email'];
$birthdate = $_POST['birthdate'];
$contact_number = $_POST['contact_number'];

$name_parts = explode(" ", trim($complete_name));
$first_name = $name_parts[0];

?>

<html>

<head>
    <meta charset="utf-8">

    <title>IPT10 Laboratory Activity #3A</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>

<body>

<section class="section">

<div class="container">

    <h1 class="title">
        Hello <?php echo htmlspecialchars($first_name); ?>,
        please read the instructions first
    </h1>

    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity.
    </h2>

    <form method="POST" action="quiz.php">

        <!-- Hidden registration information -->

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


        <!-- Quiz instructions -->

        <div class="box">

            <p>
                Please read the following instructions carefully before
                starting the quiz.
            </p>

            <br>

            <p>
                Answer all questions to the best of your ability.
                You will have 60 seconds to complete the quiz.
            </p>

        </div>


        <!-- Terms and conditions -->

        <div class="field">

            <label class="label">
                Terms and conditions
            </label>

            <div class="control">

                <textarea
                    class="textarea"
                    readonly>By starting the quiz, you agree to answer the questions honestly and understand that your answers will be submitted for evaluation.</textarea>

            </div>

        </div>


        <!-- Agreement -->

        <div class="field">

            <div class="control">

                <label class="checkbox">

                    <input
                        type="checkbox"
                        id="agree"
                        name="agree"
                        value="1">

                    I agree to the
                    <a href="#">terms and conditions</a>

                </label>

            </div>

        </div>


        <!-- Start Quiz -->

        <button
            id="startQuiz"
            type="submit"
            class="button is-link"
            disabled>

            Start Quiz

        </button>

    </form>

</div>

</section>


<script>

const agree =
    document.getElementById("agree");

const startQuiz =
    document.getElementById("startQuiz");

agree.addEventListener("change", function () {

    startQuiz.disabled =
        !agree.checked;

});

</script>

</body>

</html>