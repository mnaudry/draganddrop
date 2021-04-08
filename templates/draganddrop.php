<div class="page-draganddrop">
    <h1 class="h4 text-center">Drag and Drop Page</h1>
    <ul id="sortable" class="mx-auto">
        <?php
            
            foreach ($row_items as $key => $items) {
                
                print '<li class="'.$items['name'].' '.$items['color'].'" data-position="'.$items['position'].'" data-id="'.$items['id'].'" >'.$items['name'].'</li>';
            }

        ?>
    </ul>

</div>