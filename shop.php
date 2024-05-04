<?php 

include('server/connection.php');

$stmt = $conn->prepare("SELECT * FROM products");

$stmt->execute();

$featured_products = $stmt->get_result();

?>





<?php  include('layouts/header.php')  ?>



  <!--Shop-->

<section id="featured" class="my-5 py-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured Products</h3>
    <hr class="mx-auto">
    <p>Our products are organic, fresh & authentic.</p>
  </div>
  <div class="row mx-auto container">

  <?php while($row = $featured_products->fetch_assoc()) { ?>

    <div onclick="window.location.href='single_product.php';" class="product text-center col-md-4 col-sm-12">
      <img src="/assets/images/<?php echo $row['product_image']; ?>"  class="img-fluid mb-3"/>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price"><?php echo $row['product_price']; ?></h4>
      <a class="btn buy-btn" href="single_product.php?product_id=<?php echo $row['product_id']?>">Buy Now</a>
    </div>

      <?php } ?>
 
      <nav aria-label="page navigation example">
        <ul class="pagination mt-5">
          <li class="page-item"><a href="" class="page-link">Previous</a></li>
          <li class="page-item"><a href="" class="page-link">1</a></li>
          <li class="page-item"><a href="" class="page-link">2</a></li>
          <li class="page-item"><a href="" class="page-link">3</a></li>
          <li class="page-item"><a href="" class="page-link">Next</a></li>
        </ul>
      </nav>

  </div>
</section>
<!--featured mushroom products-->



<?php  include('layouts/footer.php')  ?>