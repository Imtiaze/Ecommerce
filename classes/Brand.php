<?php
include_once '../lib/Database.php';
include_once '../helpers/Format.php';
?>

<?php


class Brand{

  private $db;
  private $fm;

  public function __construct(){
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function addBrand($brandName){
    $brandName = $this->fm->validation($brandName);
    $brandName = mysqli_real_escape_string($this->db->link,$brandName);

    if (empty($brandName)) {
      $brandMsg = "<span style='font-size: 18px; color:red;'>Brand Name can not be empty</span>";
      return $brandMsg;
    }

    else{
      $queryAddBrand = "INSERT INTO tbl_brand(brandName) VALUE('$brandName')";
      $addBrandResult = $this->db->insert($queryAddBrand);
      if ($addBrandResult) {
        $brandMsg = "<span style='font-size: 18px; color:green;'>Brand Name added Succesfully</span>";
        return $brandMsg;
      }
      else{
        $brandMsg = "<span style='font-size: 18px; color:red;'>Brand Name not Added</span>";
        return $brandMsg;
      }
    }
  }

  public function brandList() {
    $queryListBrand = "SELECT * FROM tbl_brand ORDER BY brandId DESC";
    $listBrandResult = $this->db->select($queryListBrand);
    if ($listBrandResult) {
      return $listBrandResult;
    }
  }


  public function getBrandById($brandid){
    $queryGetBrand = "SELECT * FROM tbl_brand WHERE brandId='$brandid' ";
    $getBrandResult = $this->db->select($queryGetBrand);
    if ($getBrandResult) {
      return $getBrandResult;
    }
  }

  public function updateBrand($brandName, $brandid){

    if (empty($brandName)) {
      $updateMsg = "<span style='font-size: 18px; color:red;'>Brand Name can not Empty.</span>";
      return $updateMsg;
    }
    else{
      $queryUpdateBrand = "UPDATE tbl_brand SET brandName='$brandName' WHERE brandId='$brandid' ";
      $updateBrandResult = $this->db->update($queryUpdateBrand);
      if ($updateBrandResult) {
        $updateMsg = "<span style='font-size: 18px; color:green;'>Brand updated Succesfully</span>";
        return $updateMsg;
      }
      else{
        $updateMsg = "<span style='font-size: 18px; color:red;'>Brand not updated</span>";
        return $updateMsg;
      }
    }
  }
  public function deleteBrand($delid) {
    $queryDeleteBrand = "DELETE FROM tbl_brand WHERE brandId='$delid' ";
    $deleteBrandResult = $this->db->delete($queryDeleteBrand);
    if ($deleteBrandResult) {
      $deleteMsg = "<span style='font-size: 18px; color:red;'>Brand deleted Succesfully.</span>";
      return $deleteMsg;
    }
    else{
      $deleteMsg = "<span style='font-size: 18px; color:red;'>Brand not deleted.</span>";
      return $deleteMsg;
    }
  }



}
