<?php include '../classes/Product.php'; ?>

<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
	<div class="box round first grid">
		<h2>Product List</h2>
		<div class="block">
			<table class="data display datatable" id="example">
				<thead>
					<tr>
						<th>Serial</th>
						<th>Name</th>
						<th>Category</th>
						<th>Brand</th>
						<th>Description</th>
						<th>Price</th>
						<th>Image</th>
						<th>Type</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$fm = new Format();
					$product = new Product();
					$productList = $product->productList();
					if ($productList) {
						$i = 0;
						while($value = $productList->fetch_assoc()){
							$i++;
							?>
							<tr class="odd gradeX">
								<td><?php echo $i; ?></td>
								<td><?php echo $value['name']; ?></td>
								<td><?php echo $value['categoryName']; ?></td>
								<td><?php echo $value['brandName']; ?></td>
								<td><?php echo $fm->textShorten($value['description'], 50); ?></td>
								<td><?php echo '$'.$value['price']; ?></td>
								<td> <img src="<?php echo $value['image']; ?>" width="60" height="40" alt=""> </td>
								<td>
									<?php
									 if (1 == $value['type']) {
									 	echo "Featured";
									 }
									 if (2 == $value['type']) {
									 	echo "General";
									 }

									 ?>
								</td>

								<td>
										<a href="productedit.php?proid=<?php echo $value['productId']; ?>">Edit</a> ||
										<a onclick="return confirm('Are you sure to delete?')" href="?prodelid=<?php echo $value['productId']; ?>">Delete</a>
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
