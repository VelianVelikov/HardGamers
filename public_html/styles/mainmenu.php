	<div id="menu">
		<ul>
			<li class='active '><a href='index.php'><span>Начало</span></a></li>
			<li class='active '><a href='reviews.php'><span>Ревюта</span></a></li>
			<li class='active '><a href='gameplay.php'><span>Игри</span></a></li>
			<?php if ($CURUSER) { ?>
			<li class='active '><a href='members.php'><span>Потребители</span></a></li>
			<?php } ?>
			<li class='active '><a href='rules.php'><span>Правила</span></a></li>
		</ul>
	</div>