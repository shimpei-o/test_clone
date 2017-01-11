<?php
    $search_result_count = count($article_url['url']);

    echo $keyword . " の検索結果: " . $search_result_count . "件";
?>

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
            <?php for($i=0; $i<count($article_url['url']); $i++): ?>
            <a href="<?php echo $article_url['url'][$i]; ?>">・<?php echo $article_url['title'][$i]; ?></a><br><Hr>
            <?php endfor; ?>
        </td>
        <td>
            <?php for($i=0; $i<count($article_url['hateb_count']); $i++): ?>
                <?php echo $article_url['hateb_count'][$i]; ?> count<br><Hr>
            <?php endfor; ?>
        </td>
    </tr>
</tbody>

</table>
<?php for($x=1; $x <= $pagination; $x++) { ?>
    <a href="?page=<?php echo $x ?>"><?php echo $x;?></a>
<?php }