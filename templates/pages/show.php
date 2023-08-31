<div class="show">
    <?php $note = $params['note']; ?>
    <?php if($note): ?>
        <ul>
            <li>Id: <?= $note['id'] ?></li>
            <li>Title: <?= $note['title'] ?></li>
            <li>Description: <?= $note['description'] ?></li>
            <li>Create date: <?= $note['created'] ?></li>
        </ul>
        <a href="/?action=edit&id=<?= $note['id'] ?>"><button>Edit</button></a>
    <?php endif; ?>
    <a href="/"><button>Back to list of notes</button></a>
</div>