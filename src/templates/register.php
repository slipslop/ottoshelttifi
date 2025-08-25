<?php ?>

<main>
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?=$_SESSION['csrf_token'];?>">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required max="32">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required maxlength="64">
                <label for="password">Confirm password:</label>
                <input type="password" name="password_confirm" id="password_confirm" required maxlength="64">
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</main>