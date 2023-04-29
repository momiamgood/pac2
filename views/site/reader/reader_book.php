<?php

use Src\Auth\Auth;

?>
<div class="sidebar">
    <div class="sidebar-top">
        <p class="logo"><img class="logo-img" src="../../../public/static/media/lib_logo.png" alt="logo-ico">Библиотека
        </p>
        <nav>
            <a href="<?= app()->route->getUrl('/books') ?>">Книги</a>
            <a href="<?= app()->route->getUrl('/readers') ?>">Читатели</a>

            <?php if (Auth::user()->role->role === 'admin'): ?>
                <a href="<?= app()->route->getUrl('/genre') ?>">Жанры</a>
                <a href="<?= app()->route->getUrl('/publishers') ?>">Издательства</a>
                <a href="<?= app()->route->getUrl('/halls') ?>">Залы</a>
                <a href="<?= app()->route->getUrl('/librarians') ?>">Сотрудники</a>
            <?php endif; ?>
        </nav>
    </div>
    <div class="sidebar-bottom">
        <a href="<?= app()->route->getUrl('/profile') ?>" class="sidebar-link sidebar-img-link"><img
                    src="../../../public/static/media/profile_icon.svg"
                    alt="profile-icon"><?= app()->auth::user()->name ?>
        </a>
        <a href="<?= app()->route->getUrl('/logout') ?>" class="sidebar-link sidebar-img-link"><img
                    src="../../../public/static/media/logout_icon.svg" alt="logout-icon">Выход</a>
    </div>
</div>
<main>
    <h1>Выдача книги</h1>
    <form method="post">
        <label for="book_id">Книга</label>

        <?php
        if (isset($date_issue) && isset($book)) {
            ?>
            <p>Дата выдачи: <?= $date_issue ?></p>
            <p>Книга: <?= $book ?></p>
            <?php
        }
        ?>

        <select class="form-select" aria-label="Default select example" name="book_id" id="book_id">
            <option selected>Выберете книгу</option>
            <?php
            foreach ($book_list as $book){?>
                <option value="<?= $book->book_id ?>"><?= $book->name ?></option>
                <?php
            }
            ?>

        </select>
        <label for="date">Дата возврата</label>
        <input type="date" name="date_back" id="date">

        <button class="submit-btn">Добавить</button>
    </form>

</main>
