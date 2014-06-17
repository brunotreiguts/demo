 


<div class="panel panel-default">
    <div class="panel-heading">Lietotāju saraksts</div>
    <div class="panel-body">
        <p>Sarakstā attēloti visi lietotāji. Izvēlieties lietotāju, kuru vēlaties labot.</p>
    </div>
    <table class="table">
        <tr>
            <td>Lietotājvārds</td>
            <td>E-pasta adrese</td>
            <td>Lietotāja grupa</td>
            <td>Darbība</td>
        </tr>
        <?php foreach ($users as $item): ?>
            <tr>
                <td><?php echo $item->username; ?></td>
                <td><?php echo $item->email; ?></td>
                <td><?php echo $item->group; ?></td>
                <td>
                    <?php
                    echo Html::anchor('users/change/' . $item->id, Asset::img('pencil.png'), array(
                        'class' => 'edit-btn',
                        'title' => 'Labot lietotāju'));
                    echo Html::anchor('users/delete/' . $item->id, Asset::img('delete_user.png'), array(
                        'class' => 'delete-btn',
                        'onclick' => 'return confirm(\'Are you sure you want to delete this item?\');',
                        'title' => 'Dzēst lietotāju'));
                    ?> </td>
            </tr>
<?php endforeach; ?>
    </table>
</div>





