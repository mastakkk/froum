foreach ($singles as $single) {
            $user = GetUser($single->id_user);
            $count_comments = getCount_comments($single->id);
			?>
			<article class="state">
				<div class="state-under">
					<div class="state-user">
						<div class="img-for-single">
							<a href="profile.php?id_profile=<?=$user->id?>"><img src="<?=$user->img?>" alt=""></a>
						</div>
						<div class="under-state-user">
							<div class="nickname-state"><a href="profile.php?id_profile=<?=$user->id?>"><?=$user->login?></a></div>
							<div class="data-state"><?=$single->date?></div>
						</div>
						<div>
							<img src="/img/flag.png" alt="">
						</div>
						<div>
							<img src="/img/three.png" alt="">
						</div>
					</div>
					<div class="title-under-state"><?=$single->title?></div>
					<a href="state.php?id_single=<?=$single->id?>">
							<div class="text-under-state"><?

							if (strpos($single->text, "<br>") == true) {
								echo htmlspecialchars(substr($single->text, 0, strpos($single->text, "<br>")));
							} else { 
								echo htmlspecialchars($single->text);
							}
							
							?></div>
					</a>
				</div>
				<div class="img-state">
					<img src="<?=$single->img_preview?>" alt="">
				</div>
				<div class="footer-state">
					<div><?=$count_comments?> comments</div>
					<div><?=$single->views?> views</div>
					<div><?=$single->likes?> likes</div>
				</div>
			</article>
		<?}            ?> 