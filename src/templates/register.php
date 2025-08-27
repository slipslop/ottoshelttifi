<main>
    <div class="form-container">
        <form method="post">
            <input type="hidden" name="csrf_token" value="<?=authGetCSRF()?>">

            <div class="form-group">
                <label for="username">Username:</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    maxlength="32"
                    aria-describedby="username-error"
                    value="<?= $user['username'] ?? '' ?>">

                <?php if (isset($errors['username'])): ?>
                    <span class="error" id="username-error" role="alert">
                        <?= $errors['username']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    maxlength="64"
                    aria-describedby="password-error">

                <?php if (isset($errors['password'])): ?>
                    <span class="error" id="password-error" role="alert">
                        <?= $errors['password']; ?>
                    </span>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="password_confirm">Confirm password:</label>
                <input
                    type="password"
                    id="password_confirm"
                    name="password_confirm"
                    required
                    maxlength="64">
            </div>

            <button type="submit">Register</button>
        </form>
    </div>
</main>
