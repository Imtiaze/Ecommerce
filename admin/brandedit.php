<?php include '../classes/Brand.php'; ?>

<?php
//brandlist.php->brandid
if (!isset($_GET['brandid']) || $_GET['brandid'] == NULL) {
  echo "<script>window.location = 'brandlist.php'</script>";
}
else{
  $brandid = $_GET['brandid'];
}

?>

<?php

$brand = new Brand();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $brandName = $_POST['brand'];

  $updateBrand = $brand->updateBrand($brandName, $brandid);
}

?>


<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
  <div class="box round first grid">
    <h2>Update Brand</h2>
    <br>
    <?php if (isset($updateBrand)): ?>
      <?php echo $updateBrand; ?>
      <br>
    <?php endif; ?>
    <div class="block copyblock">
      <?php
      $getBrandById = $brand->getBrandById($brandid);
      ?>
      <form action="" method="post">
        <table class="form">
          <?php
          if ($getBrandById) {
            while($value = $getBrandById->fetch_assoc()){
              ?>
              <tr>
                <td>
                  <input type="text" name="brand" value="<?php echo $value['brandName']; ?>" class="medium" />
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
