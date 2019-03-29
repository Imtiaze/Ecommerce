<?php include '../classes/Category.php'; ?>

<?php

$category = new Category();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $categoryName = $_POST['category'];

  $addCategory = $category->addCategory($categoryName);
}

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Add New Category</h2>
    <br>
    <?php if (isset($addCategory)): ?>
      <p style="font-size: 18px; color:red;"><?php echo $addCategory; ?></p>
      <br>
    <?php endif; ?>
    <div class="block copyblock">
      <form action="catadd.php" method="post">
        <table class="form">
          <tr>
            <td>
              <input type="text" name="category" placeholder="Enter Category Name..." class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<?php include 'inc/footer.php';?>
