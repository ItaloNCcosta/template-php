<?php

$title = "CRUD users - Show";

?>

<div class="container">
    <div class="row">
        <h1>Show</h1>
    </div>
    <a class="btn btn-primary text-white" href="/users">back</a>
    <div class="row flex-center">
        <div class="form-div">
            <p>
                Id: <?php echo htmlspecialchars($user->getId()); ?>
                <br>
                Name: <?php echo htmlspecialchars($user->getName()); ?>
                <br>
                E-mail: <?php echo htmlspecialchars($user->getEmail()); ?>
            </p>
        </div>
    </div>
</div>
