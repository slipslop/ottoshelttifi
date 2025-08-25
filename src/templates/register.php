<?php ?>

<main>
    <div class="container">
        <div class="form-container">
            <form action="" method="post">
                <input type="hidden" name="csrf_token" value="<?=authGetCSRF()?>">
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" required max="32" value="<?=$user['username'] ?? ''?>">
                <?php if (isset($errors['username'])): ?>
                    <span class="error"><?=$errors['username'];?></span>
                <?php endif; ?>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required maxlength="64">
                <?php if (isset($errors['password'])): ?>
                    <span class="error"><?=$errors['password'];?></span>
                <?php endif; ?>
                <label for="password">Confirm password:</label>
                <input type="password" name="password_confirm" id="password_confirm" required maxlength="64">
                <?php if (isset($errors['password_confirm'])): ?>
                    <span class="error"><?=$errors['password_confirm'];?></span>
                <?php endif; ?>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</main>