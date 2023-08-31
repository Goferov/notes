<div class="show">
    <?php $note = $params['note']; ?>
    <?php if($note): ?>
        <ul>
            <li>Id: <?= $note['id'] ?></li>
            <li>Title: <?= $note['title'] ?></li>
            <li>Description: <?= $note['description'] ?></li>
            <li>Create date: <?= $note['created'] ?></li>
        </ul>
        <form action="/?action=delete" method="post">
            <input type="hidden" value="<?= $note['id'] ?>" name="id"/>
            <input type="submit" value="Delete">
        </form>
    <?php endif; ?>
    <a href="/"><button>Back to list of notes</button></a>
</div><?php
