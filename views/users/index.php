<?php

use App\Http\Request;

$title = "CRUD users - List";

?>

<div class="">
    <h1>List</h1>
    <a class="btn btn-primary text-white" href="/users/create">Create</a>
    <table class="table">
        <tr>
            <th scope="col">Name</th>
            <th scope="col">E-mail</th>
            <th scope="col">Actions</th>
        </tr>
        <?php if (empty($users)): ?>
            <tr>
                <td colspan="3">No users found.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td class="user-name">
                        <?php echo htmlspecialchars($user->name); ?>
                    </td>
                    <td class="user-email">
                        <?php echo htmlspecialchars($user->email); ?>
                    </td>
                    <td class="d-flex">
                        <a class="btn btn-primary text-white" href="/users/<?php echo htmlspecialchars($user->id); ?>">Show</a>
                        <a class="btn btn-primary text-white" href="/users/edit/<?php echo htmlspecialchars($user->id); ?>">Edit</a>
                        <form class="inline-block" action="/users/delete/<?php echo htmlspecialchars($user->id); ?>" method="POST" onsubmit="return confirm('Certeza?')">
                            <button class="btn btn-danger text-white" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</div>
