<?php include '../classes/Brand.php'; ?>

<?php
$brand = new Brand();
$brandList = $brand->brandList();
?>

<?php
if (isset($_GET['branddelid'])) {
    $delid = $_GET['branddelid'];
    $deleteBrand = $brand->deleteBrand($delid);
}
?>



<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Brand List</h2>
        <div class="block">
            <?php
            if (isset($deleteBrand)) {
                echo $deleteBrand;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Brand Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($brandList) {
                        $i = 0;
                        while($value = $brandList->fetch_assoc()){
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['brandName']; ?></td>
                                <td>
                                    <a href="brandedit.php?brandid=<?php echo $value['brandId']; ?>">Edit</a> ||
                                    <a onclick="return confirm('Are you sure to delete?')" href="?branddelid=<?php echo $value['brandId']; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function () {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>
