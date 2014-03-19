<?php
$diaporama = array();
$fullWidth = (get_option('etendard_diaporama_width') === 'full');

$custom = get_post_custom();
if (isset($custom['etendard_portfolio_diaporama'], $custom['etendard_portfolio_diaporama_lien'])){
	$unresizedDiaporama = maybe_unserialize($custom['etendard_portfolio_diaporama'][0]);
	$diaporama = array();
	$liens = maybe_unserialize($custom['etendard_portfolio_diaporama_lien'][0]);
	
	if (is_array($unresizedDiaporama)){
		$width = ($fullWidth) ? 1600 : 960;
		$height = (int)get_option('etendard_diaporama_height');
		if (!$height) $height = 500;
		
		$uploadDirs = wp_upload_dir();
		$upload_url = $uploadDirs['baseurl'];
		$upload_path = $uploadDirs['basedir'];
		
		//switch to resized images
		foreach ($unresizedDiaporama as $img){
			if (!$img) continue;
			//full path to the image, without root url
			$fullPath = substr($img, strlen($upload_url));

			$exploded = explode('/', $fullPath);
			$imgName = array_pop($exploded);//only the image name
			$imgDir = implode($exploded, '/').'/';//direcotry containing the image, with leading and trailing slash
			
			//compute the name of the resized image
			$separator = strrpos($imgName, '.');
			$wanted = substr($imgName, 0, $separator).'-'.$width.'x'.$height.substr($imgName, $separator);

			if (!file_exists($upload_path.$imgDir.$wanted)){
				//create resized image
				$editor = wp_get_image_editor($upload_path.$imgDir.$imgName);
				if (!is_wp_error($editor)){
					$editor->resize($width, $height, true);
					$editor->save($upload_path.$imgDir.$wanted);
				}
				else{
					//default fallabck to normal image
					$wanted = $imgName;
				}
			}

			array_push($diaporama, $upload_url.$imgDir.$wanted);
		}
	}
}
?>

<?php if (count($diaporama) > 0): ?>
<div class="wrapper <?php if ($fullWidth) echo 'full'; ?>">
	<div class="slider">
		<ul class="slides">
			<?php foreach ($diaporama as $index=>$img){ ?>
			<li class="slide">
				<div class="img" style="background-image:url(<?php echo $img; ?>);height: <?php echo $height; ?>px;"></div>
			</li>
			<?php } ?>
		</ul>
	</div>
</div>
<?php endif; ?>