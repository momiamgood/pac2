<table class="table">
    <thead>
    <tr>
        <th scope="col">Название</th>
        <th scope="col">Автор</th>
        <th scope="col">Год выпуска</th>
        <th scope="col">Издательство</th>
    </tr>
    </thead>
    <tbody
            <?php
                foreach ($book_list as $book ){
            ?>
    >
    <tr>
        <th scope="row"><?= $book->name ?></th>
        <td><?= $book->author ?></td>
        <td><?= $book->price ?></td>
        <td><?= $book->date_publish ?></td>
    </tr>
</table>

<?php

}