<h1>All Users</h1>

<?php if (isset($users) && count($users) > 0): ?>
    <ul>
        <?php foreach ($users as $user): ?>
            <li>
                <a href="/user/show/<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></a>
                (<?php echo htmlspecialchars($user['email']); ?>)
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>