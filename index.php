<?php
session_start();
include('./phpfiles/connection.php');
include('./phpfiles/viewfunctions.php');
include('./phpfiles/functions.php');
$db = new database();
$vf = new viewfunctions();

$_SESSION['vf'] = $vf;
?>

<html>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>
			Checkouts
		</title>
		<link rel="stylesheet" href="./styles/styles.css">
		<script src="https://www.google.com/recaptcha/api.js?render=6Le97tsbAAAAAEFpxAhEZtI-jd5rJA4OCQeWPsII"></script>

	</head>
	<body>
	<div id = "wrapper">
		<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
		<script type="text/javascript" src="./jsfiles/popupOrderWrap.js"> </script>
		<div id="popupOrder"> 
			<div id="popupOrderContent">
				<button id="close">X</button>
				<p>Dziękujemy za zamówienie!</p>
				<p class="orderid"></p>
			</div>
		</div>
		<div id="left">
			<div class="headers">
				<img src="./pngfiles/human.png" class="shipImages">
				<p class = "headersTitle">1. TWOJE DANE</p>
			</div>	
			<div class="content">
				<div id = "login">
					<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
					<script type="text/javascript" src="./jsfiles/popupLoginOpen.js"> </script>
					<input type="button" value="Logowanie" id = "buttonLogin" >
					<p id="loginText">Masz już konto? Zaloguj się!</p>
					<div id="popupLogin"> 
						<div id="popupLoginX">
							<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
							<script type="text/javascript" src="./jsfiles/popupLoginWrap.js"> </script>
							<button id="closeLogin">X</button>
						</div>
						<div id="popupLoginContent">
							<form action="#" id="formlogin">
								<input type="text" placeholder="Login" name="loginuser" id="loginuser" >
								<input type="password" placeholder="Hasło" name="passworduser" id="passworduser">
								<input type="submit" value="Zaloguj się" name="loginsubmit" id="loginsubmit">
							</form>
						</div>
					</div>
				</div>
				<div id = "registerDiv">
					<input type="checkbox" name="register" id="register" style="width:auto" >
					<label for="register">Stwórz nowe konto</label>
					<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
					<script type="text/javascript" src="./jsfiles/registerWrap.js"> </script>
				</div>
				<div class = "hiddenRegister" style="display:none;">
					<form id="registerOrder" action="./phpfiles/Order.php" method="POST">
						<input type="text" placeholder="Login" name="login" id="login" v-model="login" minlength="3">
						<input type="password" placeholder="Hasło" name="password" id="password" minlength="8" v-model="password">
						<input type="password" placeholder="Potwierdz hasło" name="password2" id="password2" minlength="8" v-model="password2">
						<input type="text" placeholder="Imię *" name="name" id="name" minlength="3" v-model="name" required>
						<input type="text" placeholder="Nazwisko *" name="surname" id="surname" minlength="3" v-model="surname" required>
						<select name="country"  v-model="country" required>
							<option value="poland">Polska</option>
							<option value="germany">Niemcy</option>
						</select>
						<input type="text" placeholder="Adres *" name="address" id="address"  v-model="address" required> 
						<input type="text" placeholder="Kod pocztowy *" name="zipcode" id="zipcode"  v-model="zipcode" pattern="[0-9]{2}-[0-9]{3}" required> 
						<input type="text" placeholder="Miasto *" name="city" id="city"  v-model="city" minlength="3" required>
						<input type="tel" placeholder="Telefon *" name="phone" id="phone"  v-model="phone" pattern="[0-9]{9}" required>
					
				</div>
			</div>
		</div>

		<div id="middle">
			<div class="headers">
				<img src="./pngfiles/ship.png" class="shipImages">
				<p class = "headersTitle">2. METODA DOSTAWY</p> 
			</div>
			<!-- Prawdopodobnie lepiej byłoby printować dane z bazy -->
			<div class="content">
				<div class="tableGrid">
					<table>
						<tr>
						<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
						<script type="text/javascript" src="./jsfiles/checkingShip.js"> </script>
							<td style="width:10%">
								<input class = "myradio" type="radio" id="inpost" name="ship" value="1"  v-model="ship">
							</td>
								
							<td style="width:10%">
								<img src="./pngfiles/inpost.png" alt="inpost" class = "shipImages" >
							</td>
								
							<td style="width:70%">
								<p class="shipText">Paczkomaty 24/7</p>
							</td>
								
							<td style="width:10%">
								<p class="shipText"><?php echo $vf->viewShip($db->db_connection, 1);?></p>
							</td>
						</tr>

						<tr>
							<td>
								<input class = "myradio" type="radio" id="dpd" name="ship" value="2" v-model="ship">
							</td>
								
							<td>
								<img src="./pngfiles/dpd.png" alt="dpd" class = "shipImages">
							</td>
								
							<td>
								<p class="shipText">Kurier DPD</p>
							</td>
								
							<td>
								<p class="shipText"><?php echo $vf->viewShip($db->db_connection, 2);?></p>
							</td>
						</tr>

						<tr>
							<td>
								<input class = "myradio" type="radio" id="dpdp" name="ship" value="3"  v-model="ship">
							</td>
								
							<td>
								<img src="./pngfiles/dpd.png" alt="dpd" class = "shipImages">
							</td>
								
							<td>
								<p class="shipText">Kurier DPD Pobranie</p>
							</td>
								
							<td> 
								<div style="width:100%;">
									<p class="shipText"><?php echo $vf->viewShip($db->db_connection, 3);?></p>
								</div>
								
							</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="headers">
				<img src="./pngfiles/payment.png" class="shipImages">
				<p class = "headersTitle">3. METODA PŁATNOŚCI</p>
				<!-- Prawdopodobnie lepiej byłoby printować dane z bazy -->
			</div>	
			<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
			<script type="text/javascript" src="./jsfiles/paymentWrap.js"> </script>
			<div class="content">
				<div class="tableGrid">
					<table>
						<tr class = "shipBox">
							<td class = "tableFirstColumn">
								<input class = "myradio2" type="radio" id="payu" name="payment" value="1"  v-model="payment">
							</td>
								
							<td style="width:10%">
								<img src="./pngfiles/payu.png" alt="payu" class = "shipImages">
							</td>
								
							<td style="width:80%">
								<p class="shipText">PayU</p>
							</td>
							
						</tr>

						<tr class = "shipLocal">
							<td class = "tableFirstColumn">
								<input class = "myradio2" type="radio" id="inhand" name="payment" value="2"  v-model="payment">
							</td>
								
							<td>
								<img src="./pngfiles/inhand.png" alt="inhand" class = "shipImages">
							</td>
								
							<td>
								<p class="shipText">Płatność przy odbiorze</p>
							</td>

						</tr>

						<tr class = "shipOnline">
							<td class = "tableFirstColumn">
								<input class = "myradio2" type="radio" id="traditional" name="payment" value="3"  v-model="payment">
							</td>
								
							<td>
								<img src="./pngfiles/traditional.png" alt="traditional" class = "shipImages">
							</td>
								
							<td>
								<p class="shipText">Przelew bankowy zwykły</p>
							</td>

						</tr>
					</table>

					<div id = "login">
						<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
						<script type="text/javascript" src="./jsfiles/checkingDiscount.js"> </script>
						<input type="text" placeholder="Wpisz kod rabatowy" id = "discount"  name="discountcode" v-model="discountcode">
						<p class="discountcomment"></p>
						
					</div>
				</div>
			</div>
		</div>


		<div id="right">
			<div class="headers">
				<img src="./pngfiles/order.png" class="shipImages">
				<p class = "headersTitle">4. PODSUMOWANIE</p>
			</div>	
			<div class="content">
				<?php 
				$product = $vf->viewProduct($db->db_connection, 1);
				
				?>
				<div id="product">
					<!-- Prawdopodobnie lepiej byłoby printować dane z bazy -->
					<!-- I utworzyć klasę koszyk lub koszyk oparty na sesjach -->
					<div id="productImg"> 
						<p>
						<?php
						echo '<img class = "productsImg" src="data:image/jpeg;base64,'.base64_encode($product[2]).'">';
						?>	
						</p>
					</div>
					<div id="productDescription">
						<p id="productDesc"><?php echo $product[0];?></p>
						<p id="productQua"><?php echo "Ilość: 1";?></p>
					</div>
					<div id="productPrice">
						<p><?php echo $product[1];?></p>
					</div>
				
				</div>
				<div id="sum">
					<div id="partSum">
						<p> suma cześciowa</p>
						<div id="partSumPrice">
							
							<p><?php echo $product[1]." zł";?></p>
							<p class="getshipprice"> </p>
							<p class="getdiscountcode"></p>
						</div>
					</div>
					<div id="wholeSum">
						<p>Łącznie</p>
						<div id="wholeSumPrice">
							<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
							<script type="text/javascript" src="./jsfiles/calculatePrice.js"> </script>
							<p id="wholeSumText"></p>
						</div>
					</div>
				</div>
				<div id="finalizing">
					<div id="finalTextArea">
						<textarea placeholder="Komentarz" name="comment" id="comment" rows="2" cols="25"></textarea>
					</div>
					<div id="finalCheckbox">
						<div id = "finalNewsletter">
							<input type="checkbox" name="newsletter" id="newsletter" style="width:auto" >
							<label for="newsletter">Zapisz się aby otrzymywać newsletter</label>
						</div>
						<div id = "finalTerms">
							<input type="checkbox" name="terms" id="terms" style="width:auto" required>
							<label for="terms">Zapoznałem się z <a href="#">Regulaminem</a> Zakupów</label>
						</div>
						<div id = "finalSubmit">
							<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
							<script type="text/javascript" src="./jsfiles/formSubmit.js"> </script>
							<input type="submit" value="POTWIERDŹ ZAKUP" id = "submitOrder" name="submit">
							<div id="googleBadge">
							<p>This site is protected by reCAPTCHA and the Google</p>
							<a href="https://policies.google.com/privacy">Privacy Policy</a> and
							<a href="https://policies.google.com/terms">Terms of Service</a> apply.
							</div>
							<div class="formerrors" ></div>
							<input type="hidden" name="token" id="token">
	
						</form>
						<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js'> </script>
						<script type="text/javascript">
						grecaptcha.ready(function () {
							grecaptcha.execute('6Le97tsbAAAAAEFpxAhEZtI-jd5rJA4OCQeWPsII', { action: 'homepage' }).then(function (token) {
								document.getElementById("token").value = token;
    							});
						});
						</script>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	</body>
</html>
