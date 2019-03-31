<?php include '../classes/Category.php'; ?>
<?php include '../classes/Brand.php'; ?>
<?php include '../classes/Product.php'; ?>
<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
// productlist -> proid
if (!isset($_GET['proid']) || $_GET['proid'] == NULL) {
  echo "<script>window.location = 'productlist.php'</script>";
}
else{
  $productId = $_GET['proid'];
}

?>

<?php
$product = new Product();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
  $updateProduct = $product->updateProduct($_POST, $_FILES, $productId);
}
?>




<div class="grid_10">
  <div class="box round first grid">
    <h2>Update Product</h2>
    <div class="block">
      <?php
      if (isset($updateProduct)) {
        echo $updateProduct;
      }
      ?>
      <?php
      $editProduct = $product->getProductById($productId);
      if ($editProduct) {
        while($result = $editProduct->fetch_assoc()){
          ?>
          <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
              <tr>
                <td>
                  <label>Name</label>
                </td>
                <td>
                  <input type="text" name="name" value="<?php echo $result['name']; ?>" class="medium" />
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
                        <option
                        <?php
                        if ($result['catId'] == $value['catId']) {
                          echo "selected";
                        }
                         ?>
                        value="<?php echo $value['catId']; ?>"><?php echo $value['categoryName']; ?></option>
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
                        <option
                        <?php
                        if ($result['brandId'] == $value['brandId']) {
                          echo "selected";
                        }
                         ?>
                        value="<?php echo $value['brandId']; ?>"><?php echo $value['brandName']; ?></option>
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
                  <textarea name="description" class="tinymce"><?php echo $result['description']; ?></textarea>
                </td>
              </tr>
              <tr>
                <td>
                  <label>Price</label>
                </td>
                <td>
                  <input type="text" name="price" value="<?php echo $result['price']; ?>" class="medium" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Upload Image</label>
                </td>
                <td>
                  <img src="<?php echo $result['image']; ?>" height="60" width="60" alt="">
                  <br>
                  <input type="file" name="image" />
                </td>
              </tr>

              <tr>
                <td>
                  <label>Product Type</label>
                </td>
                <td>
                  <select id="select" name="type">
                    <?php
                    if ($result['type'] == 1) {
                      ?>
                      <option selected value="1">Featured</option>
                      <option value="2">General</option>
                      <?php
                    }
                    if ($result['type'] == 2){
                      ?>
                      <option value="1">Featured</option>
                      <option selected value="2">General</option>
                      <?php
                    }
                     ?>

                  </select>
                </td>
              </tr>

              <tr>
                <td></td>
                <td>
                  <input type="submit" name="submit" Value="Update" />
                </td>
              </tr>
            </table>
          </form>
          <?php
        }
      }
      else{
        echo "There is  no Product with this id";
      }

      ?>
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
