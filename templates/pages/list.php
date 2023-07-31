<div>
    <div class="message">
        <?php
            if(!empty($params['msg'])) {
                switch ($params['msg']) {
                    case 'created':
                        echo 'Notatka została utworzona';
                        break;
                }
            }
        ?>
    </div>
    <h2>Lista notatek</h2>

</div>

