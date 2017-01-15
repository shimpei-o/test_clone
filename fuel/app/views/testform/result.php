<?php

$total = DB::select('titles')->from('hatebs')->where('keyword',Input::post('keyword'))->execute()->as_array();
$total_pages = ceil(count($total) / 40);

$all_data = DB::select('titles', 'hateb_counts', 'urls')->from('hatebs')->where('keyword',Input::post('keyword'))->limit($limit)->execute()->as_array();


echo Input::post('keyword') . " の検索結果: " . count($total) . "件";
?>
<?php for ($i=1; $i<=$total_pages; $i++): ?>
    <?php if($page==$i): ?>
    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php else: ?>
    <a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
    <?php endif; ?>
<?php endfor; ?>

<table border="1">
<thead>
    <tr>
        <th>URL</th>
        <th>はてぶ数</th>
    </tr>
</thead>
<tbody>
    <tr>
        <td>
            <?php foreach($all_data as $data):?>
                <a href="<?php echo $data['titles']; ?>">・<?php echo htmlspecialchars($data['titles'],ENT_QUOTES,'UTF-8');?></a><br><Hr>
            <?php endforeach; ?>
        </td>
        <td>
            <?php foreach($all_data as $data):?>
                <?php echo htmlspecialchars($data['hateb_counts'],ENT_QUOTES,'UTF-8');?><br><Hr>
            <?php endforeach; ?>
        </td>
    </tr>
</tbody>

</table>