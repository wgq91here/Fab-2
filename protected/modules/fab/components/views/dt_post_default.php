<table id="datatables<?php echo $ID; ?>" class="display">
    <thead>
    <tr>
        <th style="width: 140px;">递交时间</th>
        <th style="width: 80px;">递交者</th>
        <?php foreach ($fields as $n => $fieldName) {
            echo '<th>' . $fieldName . '</th>';
        }
        ?>
        <th style="width: 30px;">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($data as $n => $d): ?>
        <tr>
            <td><?php echo Fabdate($d->created, 'Y-m-d 星期* H:i'); ?></td>
            <td><strong><?php
                    if (isset($d->user) > 0) {
                        echo CHtml::link(CHtml::encode($d->user->username), array('model/submit/id/' . $d->mid), array('target' => 'preview'));
                    } else {
                        echo '匿名';
                    } ?></strong>
            </td>

            <?php foreach ($fields as $fn => $fieldName) {
                $postData = unserialize($d->pdata);
                echo "<td>" . preg_replace("/<(\/?)(\w+)>/e", "'<\\1'.strtoupper('\\2').'>'", strip_tags(html_entity_decode(nl2br($postData[$fn]), ENT_QUOTES, 'UTF-8'), '<br><b><i><u><a><strong>')) . "</td>";
            }
            ?>
            <?php //echo CHtml::encode($d->pdata); ?>

            <td>
                <?php echo CHtml::ajaxLink(
                    Yii::t('FabModule.fab', 'Delete'),
                    Yii::app()->urlManager->createUrl('fab/post/delete'),
                    array(
                        'dataType' => 'json',
                        'type' => 'POST',
                        'beforeSend' => 'function() { if (confirm("你确信要删除此记录吗？")) { return true;} else {return false; } }',
                        'success' => "function(data) { eval(data.html);oTable.fnDeleteRow(data.n); }",
                        'data' => array('n' => $n, 'id' => $d->pid, 'mid' => $d->mid)),
                    array('id' => 'delete_' . $d->pid)
                ); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>