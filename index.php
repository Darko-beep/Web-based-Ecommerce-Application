<?php  include('layouts/header.php')  ?>

<!--Main Section / Home -->

<section id="home">
  <div class="container">
    <h5>Welcome To MushFams</h5>
    <h1><span>MushFams</span> is Located at Offinso</h1>
    <p>MushFams provides you with the best</p>
    <button>Buy From Us</button>
  </div>
</section>

<!--end of the main section -->

<!--featured-->

<section id="featured" class="my-5 pb-5">
  <div class="container text-center mt-5 py-5">
    <h3>Our Featured Products</h3>
    <hr class="mx-auto">
    <p>Our products are organic, fresh & authentic.</p>
  </div>
  <div class="row mx-auto container-fluid">


  <?php include('server/get_featured_products.php'); ?>

  <?php while($row = $featured_products->fetch_assoc()) { ?>

    <div class="product text-center col-md-4 col-sm-12">
      <img src="/assets/images/<?php echo $row['product_image']; ?>"  class="img-fluid mb-3"/>
      <h5 class="p-name"><?php echo $row['product_name']; ?></h5>
      <h4 class="p-price">$<?php echo $row['product_price']; ?></h4>
      <a href="<?php echo "single_product.php?product_id=". $row['product_id']; ?>"><button class="buy-btn">Buy Now</button></a>
    </div>

    <?php } ?>
  </div>
</section>

<!-- Why Choose MushFam Section -->
<section id="why-choose-us" class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <h2 class="section-title">Why Choose MushFam?</h2>
        <p class="section-description">At MushFam, we strive to provide you with the best quality products and an exceptional experience. Here's why you should choose us:</p>
        <ul class="reasons-list">
          <li><i class="bi bi-check2"></i> Locally Sourced Mushrooms</li>
          <li><i class="bi bi-check2"></i> Sustainable and Organic Practices</li>
          <li><i class="bi bi-check2"></i> Commitment to Quality and Freshness</li>
          <li><i class="bi bi-check2"></i> Wide Range of Mushroom Varieties</li>
          <li><i class="bi bi-check2"></i> Dedicated to Customer Satisfaction</li>
        </ul>
      </div>
      <div class="col-lg-6">
        <img src="/assets/images/mushroom_khebab.jpg" alt="Why Choose MushFam" class="img-fluid">
      </div>
    </div>
  </div>
</section>


<!--end of featured-->

<?php  include('layouts/footer.php')  ?>
