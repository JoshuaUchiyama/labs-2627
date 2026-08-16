<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>

    <!-- Bulma CSS -->
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>

<body>

<section class="section">

    <div class="container">

        <h1 class="title">User Registration</h1>

        <h2 class="subtitle">
            This is the IPT10 PHP Quiz Web Application Laboratory Activity.
            Please register.
        </h2>

        <form method="POST" action="instructions.php">

            <div class="field">
                <label class="label">Name</label>

                <div class="control">
                    <input
                        class="input"
                        type="text"
                        name="complete_name"
                        placeholder="Complete Name"
                        required>
                </div>
            </div>


            <div class="field">
                <label class="label">Email</label>

                <div class="control">
                    <input
                        class="input"
                        name="email"
                        type="email"
                        placeholder="Email Address"
                        required>
                </div>
            </div>


            <div class="field">
                <label class="label">Birthdate</label>

                <div class="control">
                    <input
                        class="input"
                        name="birthdate"
                        type="date"
                        required>
                </div>
            </div>


            <div class="field">
                <label class="label">Contact Number</label>

                <div class="control">
                    <input
                        class="input"
                        name="contact_number"
                        type="tel"
                        placeholder="Contact Number"
                        required>
                </div>
            </div>


            <button
                id="nextButton"
                type="submit"
                class="button is-link"
                disabled>

                Proceed Next

            </button>

        </form>

    </div>

</section>


<script>

const nameInput =
    document.querySelector('input[name="complete_name"]');

const emailInput =
    document.querySelector('input[name="email"]');

const nextButton =
    document.getElementById("nextButton");


function validateForm() {

    const nameValid =
        nameInput.value.trim() !== "";

    const emailValid =
        emailInput.value.trim() !== "" &&
        emailInput.checkValidity();

    nextButton.disabled =
        !(nameValid && emailValid);
}


nameInput.addEventListener(
    "input",
    validateForm
);

emailInput.addEventListener(
    "input",
    validateForm
);

</script>

</body>
</html>