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
    </section>
</div>