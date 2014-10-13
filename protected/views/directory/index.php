<?php
/* @var $this DirectoryController */

Yii::app()->clientScript->registerPackage('dataTables');
$this->breadcrumbs=array(
	Yii::t("main",'Directory'),
);
?>

<script>
$(document).ready(function() {
    oTable = $('#directory').dataTable({
        "oLanguage": {
            "sLengthMenu": "Отображено _MENU_ записей на страницу",
            "sSearch": "Поиск:",
            "sZeroRecords": "Ничего не найдено - извините",
            "sInfo": "Показано с _START_ по _END_ из _TOTAL_ записей",
            "sInfoEmpty": "Показано с 0 по 0 из 0 записей",
            "sInfoFiltered": "(filtered from _MAX_ total records)",
            "oPaginate": {
                "sFirst": "Первая",
                "sLast":"Посл.",
                "sNext":"След.",
                "sPrevious":"Пред.",
            }
        },
        "iDisplayLength":20,
        "iDisplayStart": 20
      //  "bJQueryUI": true,
      //  "sPaginationType": "full_numbers"
    })
    ;
} );
</script>

<table id="directory">
<thead>
    <tr>
		<th>ФИО</th>
		<th>Телефон</th>
        <th>IP.тел.</th>
		<th>mail</th>
        <th></th>
    </tr>
</thead>
<tbody>
<?php 
foreach ($list as $person){
    ?>
    <tr>
        <td><?php echo $person['displayname'];?></td>
        <td title="<?php echo @$person['l'];?>"><?php echo @$person['telephonenumber'];?></td>
        <td><?php echo @$person['ipphone'];?></td>
        <td><?php echo @$person['mail'];?></td>
        <td><?php echo @$person['l'];?></td>
    </tr>
    <?php
}
?>
</tbody>
</table>
