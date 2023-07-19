<h2>Dodaj notatke</h2>
<div>
    <?php if($params['created']): ?>
        <div>
            <p>Tytuł: <?= $params['title'] ?></p>
            <p>Treść: <?= $params['description'] ?></p>
        </div>
    <?php else: ?>
    <form class="note-form" action="/?action=create" method="post">
        <ul>
            <li>
                <label>Tytuł <span class="required">*</span></label>
                <input type="text" name="title" class="field-long"/>
            </li>
            <li>
                <label>Opis</label>
                <textarea name="description" id="field" class="field-long field-textarea"></textarea>
            </li>
            <li>
                <input type="submit" value="Submit"/>
            </li>
        </ul>
    </form>
    <?php endif; ?>
</div>