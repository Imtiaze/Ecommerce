<?php
include '../lib/Database.php';
include '../helpers/Format.php';
?>

<?php


class Category{

  private $db;
  private $fm;

  public function __construct(){
    $this->db = new Database();
    $this->fm = new Format();
  }

  public function addCategory($categoryName){
    $categoryName = $this->fm->validation($categoryName);
    $categoryName = mysqli_real_escape_string($this->db->link,$categoryName);

    if (empty($categoryName)) {
      $categoryMsg = "<span style='font-size: 18px; color:red;'>Category Name can not be empty</span>";
      return $categoryMsg;
    }

    else{
      $queryAddCategory = "INSERT INTO tbl_category(categoryName) VALUE('$categoryName')";
      $addCategoryResult = $this->db->insert($queryAddCategory);
      if ($addCategoryResult) {
        $categoryMsg = "<span style='font-size: 18px; color:green;'>Category Name added Succesfully</span>";
        return $categoryMsg;
      }
      else{
        $categoryMsg = "<span style='font-size: 18px; color:red;'>Category Name not Added</span>";
        return $categoryMsg;
      }
    }
  }


  public function categoryList() {
    $queryListCategory = "SELECT * FROM tbl_category";
    $listCategoryResult = $this->db->select($queryListCategory);
    if ($listCategoryResult) {
      return $listCategoryResult;
    }
  }

  public function getCategoryById($catid){
    $queryGetCategory = "SELECT * FROM tbl_category WHERE id='$catid' ";
    $getCategoryResult = $this->db->select($queryGetCategory);
    if ($getCategoryResult) {
      return $getCategoryResult;
    }
  }

  public function updateCategory($categoryName, $catid){

    if (empty($categoryName)) {
      $updateMsg = "<span style='font-size: 18px; color:red;'>Category Name can not Empty.</span>";
      return $updateMsg;
    }
    else{
      $queryUpdateCategory = "UPDATE tbl_category SET categoryName='$categoryName' WHERE id='$catid' ";
      $updateCategoryResult = $this->db->update($queryUpdateCategory);
      if ($updateCategoryResult) {
        $updateMsg = "<span style='font-size: 18px; color:green;'>Category updated Succesfully</span>";
        return $updateMsg;
      }
      else{
        $updateMsg = "<span style='font-size: 18px; color:red;'>Category not updated</span>";
        return $updateMsg;
      }
    }
  }

  public function deleteCategory($delid) {
    $queryDeleteCategory = "DELETE FROM tbl_category WHERE id='$delid' ";
    $deleteCategoryResult = $this->db->delete($queryDeleteCategory);
    if ($deleteCategoryResult) {
      $deleteMsg = "<span style='font-size: 18px; color:red;'>Category deleted Succesfully.</span>";
      return $deleteMsg;
    }
    else{
      $deleteMsg = "<span style='font-size: 18px; color:red;'>Category not deleted.</span>";
      return $deleteMsg;
    }
  }

}
