<main>
    <div class="form-container">

        <form method="post">
            <?php if (isset($errors['error'])): ?>
                <span class="error" id="error" role="alert">
                    <?= $errors['error']; ?>
                </span>
            <?php endif; ?>
            <input type="hidden" name="csrf_token" value="<?=requestGetCSRF()?>">

            <div class="form-group">
                <label for="username">Username:</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    maxlength="32"
                    value="<?= $user['username'] ?? '' ?>">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                    maxlength="64">
            </div>

            <button type="submit">Login</button>
        </form>
    </div>
</main>
