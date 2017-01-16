<?php
# Stop Hacking attempt
if(!defined('__APP__')) {
	die("Hacking attempt");
	}

print '
<section id="three" class="wrapper style3 special">
				<div class="container">
					<header class="major">
						<h2>Trebate više informacija?</h2>
						<p>Slobodno nas kontaktirajte !</p>
					</header>
				</div>
				<div class="container 50%">
					<form action="#" method="post">
						<div class="row uniform">
							<div class="6u 12u$(small)">
								<input name="name" id="name" value="" placeholder="Vaše ime" type="text">
							</div>
							<div class="6u$ 12u$(small)">
								<input name="email" id="email" value="" placeholder="Vaš email" type="email">
							</div>
							<div class="12u$">
								<textarea name="message" id="message" placeholder="Vaša poruka" rows="6"></textarea>
							</div>
							<div class="12u$">
								<ul class="actions">
									<li><input value="Pošalji poruku" class="special big" type="submit"></li>
								</ul>
							</div>
						</div>
					</form>
				</div>
			</section>';
			?>