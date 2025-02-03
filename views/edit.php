<?php

use App\Http\Request;

$title = "CRUD users - Edit";

ob_start();
?>

<div class="container">
    <div class="row">
        <h1>Edit</h1>
    </div>
    <div class="row flex-center">
        <div class="form-div">
            <form class="form" action="<?php echo Request::getBaseUrl(); ?>/users/update/<?php echo htmlspecialchars($user->getId()); ?>" method="POST">
                <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user->getName()); ?>" required>
                <input type="email" name="email" placeholder="E-mail" value="<?php echo htmlspecialchars($user->getEmail()); ?>" required>
                <input type="password" name="password" placeholder="Senha" value="<?php echo htmlspecialchars($user->getPassword()); ?>" required>
                <button class="btn btn-success text-white" type="submit">Save</button>
            </form>
        </div>
    </div>
</div>

<?php

$content = ob_get_clean();

require_once 'layout.php';
