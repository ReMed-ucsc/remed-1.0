<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User</title>
</head>

<body>
    <h1>Edit User</h1>
    <form action="<?= ROOT ?>/dashboard/edit/<?= $user->id ?>" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($user->name) ?>" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
        <br>
        <label for="password">Password (leave blank to keep current password):</label>
        <input type="password" id="password" name="password">
        <br>
        <button type="submit">Update</button>
    </form>
    <?php if (!empty($errors)): ?>
        <div>
            <ul>
                <?php foreach ($errors as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>
</body>

</html>