<div class="list">
    <section>
        <div class="message error">
            <?php
            if (!empty($params['error'])) {
                switch ($params['error']) {
                    case 'noteNotFound':
                        echo 'Taka notatka nie istnieje!';
                        break;
                    case 'missingNoteId':
                        echo 'Nieprawidłowy ID notatki!';
                        break;
                }
            }
            ?>
        </div>
        <div class="message">
            <?php
            if (!empty($params['msg'])) {
                switch ($params['msg']) {
                    case 'created':
                        echo 'Notatka zostało utworzona';
                        break;
                    case 'edited':
                        echo 'Notatka zostało zaktualizowana';
                        break;
                    case 'deleted':
                        echo 'Notatka zostało usunięta';
                        break;
                }
            }
            ?>
        </div>

        <?php
        $sort = $params['sort'] ?? [];
        $by = $sort['by'] ?? 'title';
        $order = $sort['order'] ?? 'asc';
        $page = $params['page'] ?? [];
        $size = $page['size'] ?? 10;
        $currentPage = $page['number'] ?? 1;
        $pages = $page['pages'] ?? 1;
        $phrase = $params['phrase'] ?? null;

        $paginationUrl = '&phrase='.$phrase.'&pagesize='.$size.'&sortby='.$by.'&sortorder='.$order;
        ?>

        <div>
            <form class="settings-form" action="/" method="GET">
                <div>
                    <label>Wyszukaj: <input type="text" name="phrase" value="<?= $phrase ?>"/></label>
                </div>
                <div>
                    <div>Sortuj po:</div>
                    <label>Tytule: <input name="sortby" type="radio" value="title" <?= $by === 'title' ? 'checked' : '' ?>/></label>
                    <label>Dacie: <input name="sortby" type="radio" value="created" <?= $by === 'created' ? 'checked' : '' ?>/></label>
                </div>
                <div>
                    <div>Kierunek sortowania</div>
                    <label>Rosnąco: <input name="sortorder" type="radio" value="asc" <?= $order === 'asc' ? 'checked' : '' ?>/></label>
                    <label>Malejąco: <input name="sortorder" type="radio" value="desc" <?= $order === 'desc' ? 'checked' : '' ?>/></label>
                </div>
                <div>
                    <div>Liczba pozycji:</div>
                    <label>10 <input name="pagesize" type="radio" value="10" <?= $size === 10 ? 'checked' : '' ?>/> </label>
                    <label>15 <input name="pagesize" type="radio" value="15" <?= $size === 15 ? 'checked' : '' ?>/> </label>
                    <label>20 <input name="pagesize" type="radio" value="20" <?= $size === 20 ? 'checked' : '' ?>/> </label>
                    <label>25 <input name="pagesize" type="radio" value="25" <?= $size === 25 ? 'checked' : '' ?>/> </label>
                </div>
                <input type="submit" value="Sort"/>
            </form>
        </div>
        <div class="tbl-header">
            <table cellpadding="0" cellspacing="0" border="0">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Tytuł</th>
                    <th>Data</th>
                    <th>Opcje</th>
                </tr>
                </thead>
            </table>
        </div>
        <div class="tbl-content">
            <table cellpadding="0" cellspacing="0" border="0">
                <tbody>
                    <?php foreach ($params['notes'] as $note): ?>
                        <tr>
                            <td><?= $note['id'] ?></td>
                            <td><?= $note['title'] ?></td>
                            <td><?= $note['created'] ?></td>
                            <td>
                                <a href="/?action=show&id=<?= $note['id'] ?>"><button>Show</button></a>
                                <a href="/?action=delete&id=<?= $note['id'] ?>"><button>Delete</button></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <ul class="pagination">
            <?php if($currentPage !== 1): ?>
            <li>
                <a href="/?pagenumber=<?= $currentPage - 1 ?><?= $paginationUrl ?>">
                    <button><<</button>
                </a>
            </li>
            <?php endif; ?>
            <?php for($i = 1; $i <= $pages; $i++): ?>
            <li>
                <a href="/?pagenumber=<?= $i ?><?= $paginationUrl ?>">
                    <button><?= $i ?></button>
                </a>
            </li>
            <?php endfor; ?>
            <?php if($currentPage < $pages): ?>
            <li>
                <a href="/?pagenumber=<?= $currentPage + 1 ?><?= $paginationUrl ?>">
                    <button>>></button>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </section>
</div>