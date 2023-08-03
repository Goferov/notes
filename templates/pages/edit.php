<h2>Edytuj notatke</h2>
<div>
    <form class="note-form" action="/?action=edit" method="post">
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
</div>