<div class="show">
    <?php $note = $params['note']; ?>
    <?php if($note): ?>
        <ul>
            <li>Id: <?= $note['id'] ?></li>
            <li>Tytuł: <?= $note['title'] ?></li>
            <li>Opis: <?= $note['description'] ?></li>
            <li>Utworzono: <?= $note['created'] ?></li>
        </ul>
        <a href="/?action=edit&id=<?= $note['id'] ?>"><button>Edit</button></a>
    <?php endif; ?>
    <a href="/"><button>Powrót do listy notatek</button></a>
</div>