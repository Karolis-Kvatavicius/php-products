<?php
    if (isset($_SESSION['username'])) {
?>
<div class="card my-3 mx-3 col">
    <div class="card-body">
        <h5 class="card-title"><?= $row['name'] ?></h5>
        <h6 class="card-subtitle mb-2 text-muted"><?= $row['price'] . " $" ?></h6>
        <p class="card-text"><?= $row['description'] ?></p>
<?php
    if (isset($_SESSION['role']) && $_SESSION['role'] == 1) {
?>
        <a href="./edit_product.php?name=<?= $row['name'] ?>&price=<?= $row['price'] ?>&description=<?= $row['description'] ?>" class="card-link">Edit</a>
        <a href="./delete_product.php?name=<?= $row['name'] ?>&delete=1" class="card-link">Delete</a>
<?php
    } else {
?>        
        <a href="#" class="card-link">Add to cart</a>
<?php
    }
?>
    </div>
</div>
<?php
    }
?>