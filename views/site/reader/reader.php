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


<table class="table">
    <thead>
    <tr>
        <th scope="col">Номер читательского билета</th>
        <th scope="col">ФИО</th>
    </tr>
    </thead>
    <tbody
        <?php
        foreach ($reader_list

        as $reader){
        ?>
    >
    <tr>
        <th scope="row"><?= $reader->id ?></th>
        <td><?= $reader->fio ?></td>

    </tr>
</table>

<?php

}