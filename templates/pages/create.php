<h2>Add note</h2>
<div>
    <form class="note-form" action="/?action=create" method="post">
        <ul>
            <li>
                <label>Title <span class="required">*</span></label>
                <input type="text" name="title" class="field-long"/>
            </li>
            <li>
                <label>Description</label>
                <textarea name="description" id="field" class="field-long field-textarea"></textarea>
            </li>
            <li>
                <input type="submit" value="Submit"/>
            </li>
        </ul>
    </form>
</div>