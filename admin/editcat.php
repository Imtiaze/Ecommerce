<?php include '../classes/Category.php'; ?>

<?php
if (!isset($_GET['catid']) || $_GET['catid'] == NULL) {
  echo "<script>window.location = 'catlist.php'</script>";
}
else{
  $catid = $_GET['catid'];
}

?>

<?php

$category = new Category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $categoryName = $_POST['category'];

  $updateCategory = $category->updateCategory($categoryName, $catid);
}

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Add New Category</h2>
    <br>
    <?php if (isset($updateCategory)): ?>
      <?php echo $updateCategory ?>
      <br>
    <?php endif; ?>
    <div class="block copyblock">
      <?php
      $getCategoryById = $category->getCategoryById($catid);
      ?>
      <form action="" method="post">
        <table class="form">
          <?php
          if ($getCategoryById) {
            while($value = $getCategoryById->fetch_assoc()){
              ?>
              <tr>
                <td>
                  <input type="text" name="category" value="<?php echo $value['categoryName']; ?>" class="medium" />
                </td>
              </tr>
              <tr>
                <?php
              }
            }
            ?>
            <tr>
              <td>
                <input type="submit" name="submit" Value="Update" />
              </td>
            </tr>
          </table>
        </form>
      </div>
    </div>
  </div>
  <?php include 'inc/footer.php';?>
