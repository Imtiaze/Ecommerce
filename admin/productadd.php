<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $product = new Product();

  $addProduct = $product->addProduct($_POST, $_FILES);

}
?>


<div class="grid_10">
  <div class="box round first grid">
    <h2>Add New Product</h2>
    <div class="block">
      <?php

      if (isset($addProduct)) {
        echo $addProduct;
      }
      ?>
      <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
          <tr>
            <td>
              <label>Name</label>
            </td>
            <td>
              <input type="text" name="name" placeholder="Enter Product Name..." class="medium" />
            </td>
          </tr>
          <tr>
            <td>
              <label>Category</label>
            </td>
            <td>
              <select id="select" name="catId">
                <?php
                $cat = new Category();
                $category = $cat->categoryList();
                if ($category) {
                  foreach ($category as  $value) {
                    ?>
                    <option value="<?php echo $value['catId']; ?>"><?php echo $value['categoryName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td>
              <label>Brand</label>
            </td>
            <td>
              <select id="select" name="brandId">
                <?php
                $brand = new Brand();
                $brands = $brand->brandList();
                if ($brands) {
                  foreach ($brands as  $value) {
                    ?>
                    <option value="<?php echo $value['brandId']; ?>"><?php echo $value['brandName']; ?></option>
                    <?php
                  }
                }
                ?>
              </select>
            </td>
          </tr>

          <tr>
            <td style="vertical-align: top; padding-top: 9px;">
              <label>Description</label>
            </td>
            <td>
              <textarea name="description" class="tinymce"></textarea>
            </td>
          </tr>
          <tr>
            <td>
              <label>Price</label>
            </td>
            <td>
              <input type="text" name="price" placeholder="Enter Price..." class="medium" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Upload Image</label>
            </td>
            <td>
              <input type="file" name="image" />
            </td>
          </tr>

          <tr>
            <td>
              <label>Product Type</label>
            </td>
            <td>
              <select id="select" name="type">
                <option value="1">Featured</option>
                <option value="2">Non-Featured</option>
              </select>
            </td>
          </tr>

          <tr>
            <td></td>
            <td>
              <input type="submit" name="submit" Value="Save" />
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function () {
  setupTinyMCE();
  setDatePicker('date-picker');
  $('input[type="checkbox"]').fancybutton();
  $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>
