		</div>
				<div class="blog_boxes_right"><div class="blog_part_right_box"><div id="categories_ico"></div>
		<div class="blog_part_right_header">
		<font size="5">���������</font>
		</div>
		<div class="events">
		<?php
	$catId = (int)$_GET['post'];

	
	$result = mysql_query("SELECT * FROM  categories ORDER BY cat_id = '$catID' ") or die (mysql_error());
	while($post = mysql_fetch_assoc($result)){
	echo'
	<li class=active><b>�</b><a href="viewCategory.php?post='.htmlspecialchars_decode($post['cat_id']).'">'.htmlspecialchars_decode($post['name']).'</a><br>';
	}
	?>
		</div>
		</div></div>
		<div class="blog_boxes_right"><div class="blog_part_right_box"><div id="pacman_ico"></div>
		<div class="blog_part_right_header">
		<font size="5">GamePlay</font>
		</div>
		<div class="events">
<div id="cont" style="display: none">
<iframe scrolling="yes"  frameborder="0" width="290" src="lastGamePlay.php" style="height: 534px; margin-left: -15px;"></iframe><center><font size="1" >Note: ������� ������� ���������� 10.</font></center>

</div>
<div id="load" style="height: 322px; margin-top: 240px;">
<center>
<img src="styles/images/loading.gif" width="64" height="64"/>
</br><font size="3">���������...</font>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br><font size="1">Note: ��� ������� �� �������� � ���.</font>
</center></div>
</div>
		</div>
		</div>

		</div>
	</br>
	     <div class="clearer"></div>
	<hr>
	<div id="footer">
	<div class="footer_floats">
<img src="styles/images/vsvproductions.png" width="307" height="150"/>
	</div>
	<div class="footer_floats">
	<font size="5">Hard-Gamers.Bg/Info</font>
			<li class='active '><b>�</b><a href='reviews.php'><span>������</span></a></li>
			<li class='active '><b>�</b><a href='gameplay.php'><span>����</span></a></li>
			<li class='active '><b>�</b><a href='rules.php'><span>�������</span></a></li>
			<li class='active '><b>�</b><a href='ekip.php'><span>����</span></a></li>
			<li class='active '><b>�</b><a href='reg.php'><span>�����������</span></a></li>
	</div>
	<div class="footer_floats">
	<font size="5">��������</font>
			<li class='active '><b>�</b><a href="mailto:velianstoychev@gmail.com"><span>������ �������</span></a></li>
			<li class='active '><b>�</b><a href="mailto:sil.jordanova@abv.bg"><span>������ ���������</span></a></li>
			<li class='active '><b>�</b><a href="skype:velian99?call"><span>Skype</span></a></li>
			<li class='active '><b>�</b><a href="http://mg-babatonka.bg/news.php"><span>���� �� ����������</span></a></li>
	</div>	
	</div>
	<div id="bottombar">
	<hr>
	<center>������ ����� ��������. � 2013-2014 Hard-Gamers.Bg/Info</center>
	</div>

	 </div>