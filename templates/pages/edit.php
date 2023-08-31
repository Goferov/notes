<h2>Edit note</h2>
<div>
    <?php $note = $params['note']; ?>
    <?php if($note): ?>
        <form class="note-form" action="/?action=edit" method="post">
            <ul>
                <li>
                    <label>Title <span class="required">*</span></label>
                    <input type="text" name="title" value="<?= $note['title'] ?>" class="field-long"/>
                </li>
                <li>
                    <label>Description</label>
                    <textarea name="description" id="field" class="field-long field-textarea"><?= $note['description'] ?></textarea>
                </li>
                <li>
                    <input type="submit" value="Submit"/>
                </li>
            </ul>
            <input type="hidden" value="<?= $note['id'] ?>" name="id">
        </form>
    <?php else: ?>
        <div>
            No data to display
            <a href="/"><button>Back to list of notes</button></a>
        </div>
    <?php endif; ?>
</div>