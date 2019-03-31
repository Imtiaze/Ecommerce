<?php include_once '../lib/Database.php'; ?>
<?php include_once '../helpers/Format.php'; ?>


<?php

class Product{

  private $db;
  private $fm;

  public function __construct(){
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function addProduct($data, $files) {
    $name        = $this->fm->validation($data['name']);
    $catId       = $this->fm->validation($data['catId']);
    $brandId     = $this->fm->validation($data['brandId']);
    $description = $data['description'];
    $price       = $data['price'];
    $type        = $this->fm->validation($data['type']);

    $permited  = array('jpg', 'jpeg', 'png', 'gif');
    $file_name = $files['image']['name'];
    $file_size = $files['image']['size'];
    $file_temp = $files['image']['tmp_name'];

    $div = explode('.', $file_name);
    $file_ext = strtolower(end($div));
    $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
    $uploaded_image = "uploads/".$unique_image;

    if(empty($name) ){
      $addMsg = "<span style='font-size:18px; color:red;'>Name should not be empty</span>";
      return $addMsg;
    }
    elseif( empty($catId)  ){
      $addMsg = "<span style='font-size:18px; color:red;'>Category should not be empty</span>";
      return $addMsg;
    }
    elseif( empty($brandId)){
      $addMsg = "<span style='font-size:18px; color:red;'>Brand should not be empty</span>";
      return $addMsg;
    }
    elseif( empty($description)    ){
      $addMsg = "<span style='font-size:18px; color:red;'>Description should not be empty</span>";
      return $addMsg;
    }
    elseif( empty($price) ){
      $addMsg = "<span style='font-size:18px; color:red;'>Price should not be empty</span>";
      return $addMsg;
    }
    elseif( !is_numeric($price) ){
      $addMsg = "<span style='font-size:18px; color:red;'>Price should not be Text. </span>";
      return $addMsg;
    }
    elseif( empty($type) ){
      $addMsg = "<span style='font-size:18px; color:red;'>Type should not be empty</span>";
      return $addMsg;
    }
    elseif (empty($file_name)) {
      $addMsg = "<span style='font-size:18px; color:red;'>Please Select any Image !</span>";
      return $addMsg;
    }
    elseif ($file_size >1048567) {
      $addMsg ="<span style='font-size:18px; color:red;'>Image Size should be less then 1MB!  </span>";
      return $addMsg;
    }
    elseif (in_array($file_ext, $permited) === false) {
      $addMsg ="<span style='font-size:18px; color:red;'>You can upload only:-".implode(', ', $permited)."</span>";
      return $addMsg;
    }
    else{
      move_uploaded_file($file_temp, $uploaded_image);
      $queryAddProduct = "INSERT INTO tbl_product(name, catId, brandId, description, price, image, type) VALUES('$name', '$catId', '$brandId', '$description', '$price', '$uploaded_image', '$type')";
      $addProductResult = $this->db->insert($queryAddProduct);
      if ($addProductResult) {
        $addMsg ="<span style='font-size:18px; color:green;'>Product added Succesfully.</span>";
        return $addMsg;
      }
      else{
        $addMsg ="<span style='font-size:18px; color:green;'>Product not  Added.</span>";
        return $addMsg;
      }
    }
  }

  public function productList() {
  /*  $queryProductList = "SELECT tbl_product.*,tbl_category.categoryName, tbl_brand.brandName
                          FROM tbl_product
                          INNER JOIN tbl_category
                          ON tbl_product.catId = tbl_category.catId
                          INNER JOIN tbl_brand
                          ON tbl_product.brandId = tbl_brand.brandId
                          ORDER BY tbl_product.productId DESC"; */

    $queryProductList = "SELECT p.*, c.categoryName, b.brandName
                          FROM tbl_product as p, tbl_category as c, tbl_brand as b
                          WHERE p.catId =  c.catId AND p.brandId = b.brandId
                          ORDER BY p.productId DESC";

    $productListResult = $this->db->select($queryProductList);
    if ($productListResult) {
      return $productListResult;
    }
  }

  public function getProductById($productId){
    $queryProductEdit = "SELECT * FROM tbl_product WHERE productId='$productId' ";
    $productEditResult = $this->db->select($queryProductEdit);
    if ($productEditResult) {
      return $productEditResult;
    }
  }



  public function updateProduct($data, $files, $productId) {

    $name        = $this->fm->validation($data['name']);
    $catId       = $this->fm->validation($data['catId']);
    $brandId     = $this->fm->validation($data['brandId']);
    $description = $data['description'];
    $price       = $data['price'];
    $file_name = $files['image']['name'];
    $type        = $this->fm->validation($data['type']);

    if(empty($name) ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Name should not be empty</span>";
      return $updateMsg;
    }
    elseif( empty($catId)  ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Category should not be empty</span>";
      return $updateMsg;
    }
    elseif( empty($brandId)){
      $updateMsg = "<span style='font-size:18px; color:red;'>Brand should not be empty</span>";
      return $updateMsg;
    }
    elseif( empty($description)    ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Description should not be empty</span>";
      return $updateMsg;
    }
    elseif( empty($price) ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Price should not be empty</span>";
      return $updateMsg;
    }
    elseif( !is_numeric($price) ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Price should not be Text. </span>";
      return $updateMsg;
    }
    elseif( empty($type) ){
      $updateMsg = "<span style='font-size:18px; color:red;'>Type should not be empty</span>";
      return $updateMsg;
    }

    else {
      if (!empty($file_name)) {
        $permited  = array('jpg', 'jpeg', 'png', 'gif');
        $file_name = $files['image']['name'];
        $file_size = $files['image']['size'];
        $file_temp = $files['image']['tmp_name'];

        $div = explode('.', $file_name);
        $file_ext = strtolower(end($div));
        $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
        $uploaded_image = "uploads/".$unique_image;



        if ($file_size >1048567) {
          $updateMsg ="<span style='font-size:18px; color:red;'>Image Size should be less then 1MB!  </span>";
          return $updateMsg;
        }
        elseif (in_array($file_ext, $permited) === false) {
          $updateMsg ="<span style='font-size:18px; color:red;'>You can upload only:-".implode(', ', $permited)."</span>";
          return $updateMsg;
        }
        else{
          //for deleting existing image
          $queryDelImage = "SELECT image FROM tbl_product WHERE productId='$productId' ";
          $delImageResult = $this->db->select($queryDelImage);
          if ($delImageResult) {
            while($delimg = $delImageResult->fetch_assoc()){
              $img = $delimg['image'];
            }
          }
          unlink($img);

          move_uploaded_file($file_temp, $uploaded_image);

          $queryUpdateProduct = "UPDATE tbl_product
                                  SET
                                  name = '$name',
                                  catId = '$catId',
                                  brandId = '$brandId',
                                  description = '$description',
                                  price = '$price',
                                  image = '$uploaded_image',
                                  type = '$type'
                                  WHERE
                                  productId='$productId'
                                  ";

          $updateProductResult = $this->db->update($queryUpdateProduct);
          if ($updateProductResult) {
            $updateMsg ="<span style='font-size:18px; color:green;'>Product Updated Succesfully.</span>";
            return $updateMsg;
          }
          else{
            $updateMsg ="<span style='font-size:18px; color:green;'>Product not  Updated.</span>";
            return $updateMsg;
          }
        }
      }

      else{
        $queryUpdateProduct = "UPDATE tbl_product
                                SET
                                name = '$name',
                                catId = '$catId',
                                brandId = '$brandId',
                                description = '$description',
                                price = '$price',
                                type = '$type'
                                WHERE
                                productId='$productId'
                                ";

        $updateProductResult = $this->db->update($queryUpdateProduct);
        if ($updateProductResult) {
          $updateMsg ="<span style='font-size:18px; color:green;'>Product Updated Succesfully.</span>";
          return $updateMsg;
        }
        else{
          $updateMsg ="<span style='font-size:18px; color:green;'>Product not  Updated.</span>";
          return $updateMsg;
        }
      }
    }






  }




























}
