<h1>All Users</h1>

<?php if (isset($users) && count($users) > 0): ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="<?= base_url('/users/') . $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></a>
                (<?php echo htmlspecialchars($user['email']); ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>

<a href="<?= base_url(''); ?>">asd</a>