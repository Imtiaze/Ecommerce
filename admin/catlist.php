<?php include '../classes/Category.php'; ?>

<?php
$category = new Category();
$categoryList = $category->categoryList();
?>

<?php
if (isset($_GET['delcatid'])) {
    $delid = $_GET['delcatid'];
    $deleteCategory = $category->deleteCategory($delid);
}
?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <?php
            if (isset($deleteCategory)) {
                echo $deleteCategory;
            }
            ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>Serial No.</th>
                        <th>Category Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($categoryList) {
                        $i = 0;
                        while($value = $categoryList->fetch_assoc()){
                            $i++;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $i; ?></td>
                                <td><?php echo $value['categoryName']; ?></td>
                                <td>
                                    <a href="editcat.php?catid=<?php echo $value['id']; ?>">Edit</a> ||
                                    <a href="?delcatid=<?php echo $value['id']; ?>">Delete</a>
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
