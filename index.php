<?php 
 $host = 'localhost'; // адрес сервера 
$database = 'shop'; // имя базы данных
$user = 'node'; // имя пользователя
$password = 'zx15619'; // пароль
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));

$query ="SELECT * FROM products";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));




 ?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>магазин</title>
	 <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/uikit.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js"></script>
        <script src="js/uikit.min.js"></script>
        <script src="js/uikit-icons.min.js"></script>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>
	
	<div class="wrap_products">
		<div class="products">
			<?php  
			$rows = mysqli_num_rows($result); // количество полученных строк

   for ($i = 0 ; $i < $rows ; ++$i)
    {
        $row = mysqli_fetch_row($result);
        
            {
            	echo '<div class="cards_product id_'.$row[0].'" >';
            	 echo '<div class="product_name">'.$row[2].'</div>';
             echo '<div class="product_img"><img src="'.$row[1].'" alt='.$row[3].' id='.$row[0].'></div>';
             echo '<div class="description">'.$row[3].'</div>';
             echo '<div class="price">'.$row[4].'руб</div>';
             echo '<p uk-margin>
        <button class="uk-button uk-button-danger bay" for_id='.$row[0].'>в корзину</button>';
             echo '</div>';
         }
        
    }
    ?>
			
			
			<div class="card">КОРЗИНА
                   <!-- <img src="img/block_7.jpg" alt="">-->
                    <!-- This is a button toggling the modal -->
<button class="uk-button uk-button-default uk-margin-small-right" type="button" uk-toggle="target: #modal-example"><img src="img/block_7.jpg" alt=""></button>

<!-- This is an anchor toggling the modal -->


<!-- This is the modal -->
<div id="modal-example" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title">Headline</h2>
        <div class="wrap_card_products">
        	<div class="string_product"></div>
        </div>


        <p class="uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Save</button>
        </p>
    </div>
</div>
</div>


			</div>
		</div>
</div>
<script>
	$(document).ready(function(){
     var products_in_card = [];// пустой массив для счета товаров в корзине

		$(".bay").on("click",function(){
        var id = $(this).attr("for_id");
            console.log(id);
        $('[id = '+ id +']')
            .clone()
            .css({'position' : 'absolute', 'z-index' : '11100', top: $(this).offset().top-300, left:$(this).offset().left-100})
            .appendTo("body")
            .animate({opacity: 0.05,
                left: $(".card").offset()['left'],
                top: $(".card").offset()['top'],
                width: 20}, 1000, function() {
                $(this).remove();
            });// end эффект перелета изображения товара в корзину

products_in_card.push(id);

    });
	 $('.card button').click(function(){

       products_in_card.sort();
       products_in_card.forEach(function(value){
       	console.log(value);
           var product_name = $('.id_'+value + '>.product_name').text();
           var price = $('.id_'+value + '>.price').text();
           if (Number($('.id_card_'+ value).text()) == 0) {
            var how_mach = '<div ><span class="how_mach id_card_'+ value +'">1</span><span> шт</span></div>';} else {
               var how_mach = '<div ><span class="how_mach id_card_'+ value +'">'+(Number($('.id_card_'+ value).text() +1 )  + '</span><span> шт</span></div>';
            }
           var how_mach = '<div ><span class="how_mach id_card_'+ value +'">1</span><span> шт</span></div>';
           var string_product = '<div class="string_product"><div class="string_name">'+product_name+ '</div><div class="string_price">'+price+'</div>' + how_mach+'</div>';
           $('.wrap_card_products').append(string_product); 
          console.log(product_name + ' _ ' + price);
       });
	 	
	 });
	

	});//end ready
</script>
</body>
</html>