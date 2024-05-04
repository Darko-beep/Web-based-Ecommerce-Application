<?php
include('server/connection.php');

if(isset($_GET['product_id'])){
  $product_id = $_GET['product_id'];

  $stmt = $conn->prepare("SELECT * FROM products  WHERE product_id=?");
  $stmt->bind_param("i",$product_id);

  $stmt->execute();

  $product = $stmt->get_result();
  
}else{
  header('location: index.php');
}

?>


<?php  include('layouts/header.php')  ?>

<!--single page-->
<section class="single-product my-5 pt-5">
    <div class="row mt-5">
      <?php while($row = $product->fetch_assoc()){ ?>

        <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="/assets/images/<?php echo $row['product_image']; ?>" id="mainImg"/>
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="/assets/images/<?php echo $row['product_image']; ?>" width="100%" class="small-img" />
                </div>
                <div class="small-img-col">
                    <img src="/assets/images/<?php echo $row['product_image2']; ?>" width="100%" class="small-img"/>
                </div>
                <div class="small-img-col">
                    <img src="/assets/images/<?php echo $row['product_image3']; ?>" width="100%" class="small-img" />
                </div>
                <div class="small-img-col">
                    <img src="/assets/images/<?php echo $row['product_image4']; ?>" width="100%" class="small-img" />
                </div>
            </div>
        </div>

      

        <div class="col-lg-6 col-md-12 col-12">
            <h6>Mushroom</h6>
            <h3 class="py-4"><?php echo $row['product_name']; ?></h3>
            <h2><?php echo $row['product_price']; ?></h2>

            <form method="post" action="cart.php">
            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>" >
            <input type="hidden" name="product_image" value="<?php echo $row['product_image']; ?> ">
            <input type="hidden" name="product_name" value="<?php echo $row['product_name']; ?>" >
            <input type="hidden" name="product_price" value="<?php echo $row['product_price']; ?>">

              <input type="number" name="product_quantity" value="1">
              <button class="buy-btn" type="submit" name="add_to_cart" >Add to Cart</button>

            </form>

            
            <h4 class="mt-5 mb-5">Product details</h4>
            <span><?php echo $row['product_description']; ?></span>
        </div>
        
        <?php } ?>


    </div>
</section>

<!--Related Products-->
<section id="Related Products" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
      <h3>Related Products</h3>
      <hr class="mx-auto">
      <!--<p>Our products are organic, fresh & authentic.</p>-->
    </div>
    <div class="row mx-auto container-fluid">
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
      <div class="product text-center col-md-4 col-sm-12">
        <img src="/assets/images/mushroom_sac.jpg"  class="img-fluid mb-3"/>
        <h5 class="p-name">Mushrooms</h5>
        <h4 class="p-price">$199.8</h4>
        <button class="buy-btn">Buy Now</button>
      </div>
  
  
    </div>
  </section>


  <?php  include('layouts/footer.php')  ?>