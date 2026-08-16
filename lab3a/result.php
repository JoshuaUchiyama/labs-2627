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

// Get the user's answers
$answers = $_POST['answers'] ?? [];

// Calculate the score
$score = compute_score($answers);

// Get all quiz data
$quiz = retrieve_questions();

$questions = $quiz['questions'];
$correct_answers = $quiz['answers'];

// Determine hero color
$hero_class = ($score > 2) ? 'is-success' : 'is-danger';

// Format birthdate
$formatted_birthdate = date(
    "F d, Y",
    strtotime($birthdate)
);

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">

    <title>IPT10 Laboratory Activity #3A</title>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">

    <!-- Confetti library -->
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>

</head>

<body>


<!-- Score -->

<section class="hero <?php echo $hero_class; ?>">

    <div class="hero-body">

        <p class="title">
            Your Score: <?php echo $score; ?>/5
        </p>

        <p class="subtitle">
            This is the IPT10 PHP Quiz Web Application Laboratory Activity.
        </p>

    </div>

</section>


<section class="section">

<div class="container">


    <!-- User Information -->

    <h1 class="title is-4">
        Registration Information
    </h1>

    <div class="table-container">

        <table class="table is-bordered is-hoverable is-fullwidth">

            <tbody>

                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>

                <tr>
                    <td>Complete Name</td>
                    <td>
                        <?php echo htmlspecialchars($complete_name); ?>
                    </td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>
                        <?php echo htmlspecialchars($email); ?>
                    </td>
                </tr>

                <tr>
                    <td>Birthdate</td>
                    <td>
                        <?php echo htmlspecialchars($formatted_birthdate); ?>
                    </td>
                </tr>

                <tr>
                    <td>Contact Number</td>
                    <td>
                        <?php echo htmlspecialchars($contact_number); ?>
                    </td>
                </tr>

            </tbody>

        </table>

    </div>


    <!-- Question Results -->

    <h1 class="title is-4 mt-6">
        Quiz Results
    </h1>

    <div class="table-container">

        <table class="table is-bordered is-hoverable is-fullwidth">

            <thead>

                <tr>

                    <th>Question</th>

                    <th>Correct Answer</th>

                    <th>Your Answer</th>

                </tr>

            </thead>

            <tbody>

                <?php foreach ($questions as $index => $question): ?>

                    <tr>

                        <td>
                            <?php
                            echo htmlspecialchars(
                                $question['question']
                            );
                            ?>
                        </td>

                        <td>

                            <?php

                            $correct_key =
                                $correct_answers[$index];

                            foreach ($question['options'] as $option) {

                                if ($option['key'] === $correct_key) {

                                    echo htmlspecialchars(
                                        $option['value']
                                    );

                                    break;
                                }
                            }

                            ?>

                        </td>

                        <td>

                            <?php

                            if (isset($answers[$index])) {

                                $user_key =
                                    $answers[$index];

                                foreach ($question['options'] as $option) {

                                    if ($option['key'] === $user_key) {

                                        echo htmlspecialchars(
                                            $option['value']
                                        );

                                        break;
                                    }
                                }

                            } else {

                                echo "No answer";

                            }

                            ?>

                        </td>

                    </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>


</div>

</section>


<?php if ($score == 5): ?>

    <!-- Confetti only appears for a perfect score -->

    <canvas id="confetti-canvas"></canvas>

    <script>

        var confettiSettings = {
            target: 'confetti-canvas'
        };

        var confetti =
            new ConfettiGenerator(confettiSettings);

        confetti.render();

    </script>

<?php endif; ?>


</body>

</html>