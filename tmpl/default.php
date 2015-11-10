<div id="inscritos">
<?php 
	if(is_array($cadastrados['Inscrito'])):
 		foreach( $cadastrados['Inscrito'] as $inscrito ):
?>
	<div class="inscrito">
		<?php if( isset($inscrito['Facebook']->picture->data->url)): ?>
		<img src="<?php echo $inscrito['Facebook']->picture->data->url; ?>" alt="<?php echo $inscrito['Nome']; ?>" title="<?php echo $inscrito['Nome']; ?>" />
		<?php endif; ?>
	</div>
<?php 
		endforeach;
	endif;
?>
</div>
<div id="pre-inscritos">
</div>