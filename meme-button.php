<?
/*
Plugin Name: Meme Button
Plugin URI: http://wordpress.org/extend/plugins/meme-button/
Description: Integra meemi nel tuo blog, aggiungendo il bottone per la condivisione veloce del tuo articolo, della tua pagina su meemi....
Author: Vincenzo La Rosa
Version: 1.2
Author URI: http://www.vincenzolarosa.it 
*/
/*Opzioni di default*/
add_option('meme_befor','1');
add_option('meme_after','0');
add_option('meme_img','2');
add_option('meme_post','1');
add_option('meme_page','0');
/*Fine opzioni default*/
function meme_button($content){
	$meme_befor=get_option('meme_befor');
	$meme_after=get_option('meme_after');
	$meme_img=get_option('meme_img');
	$dir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	global $post;
	$meme_link = get_permalink($post->ID);$meme_title = get_the_title($post->ID);
	$meme_button_link="<br /><a href=\"http://meemi.com/meme/".$meme_title." ".$meme_link."\" target=\"_blank\"><img src=\"".$dir."img/".$meme_img.".png\" /></a>";
	if ((is_single())&&(get_option('meme_post')==1)){
		if($meme_after==1)$content=$meme_button_link.$content;
		if($meme_befor==1)$content=$content.$meme_button_link;
	}
	if ((is_page())&&(get_option('meme_page')==1)){
		if($meme_after==1)$content=$meme_button_link.$content;
		if($meme_befor==1)$content=$content.$meme_button_link;
	}
	return $content;
}
function meme_addmenu(){
	add_options_page("Meme Button", "Meme Button", "administrator", "meme-buttton", "meme_option_page");
}
function meme_option_page(){
	$dir = WP_PLUGIN_URL.'/'.str_replace(basename( __FILE__),"",plugin_basename(__FILE__));
	$action=$_POST['action'];
	if ($action=='update' ) {
		if (get_option('meme_img')!=$_POST['meme_img']){
			update_option('meme_img',$_POST['meme_img']);
		}
		if (get_option('meme_after')!=$_POST['meme_after']){
			update_option('meme_after',$_POST['meme_after']);
		}
		if (get_option('meme_befor')!=$_POST['meme_befor']){
			update_option('meme_befor',$_POST['meme_befor']);
		}
		if (get_option('meme_post')!=$_POST['meme_post']){
			update_option('meme_post',$_POST['meme_post']);
		}
		if (get_option('meme_page')!=$_POST['meme_page']){
			update_option('meme_page',$_POST['meme_page']);
		}
		
		
		echo "<div id=\"message\" class=\"updated fade\"><p><strong>"._e('Options saved.')."</strong></p></div>";
	}
?>
	<div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#appId=174427065949905&amp;xfbml=1"></script>
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	<div class="wrap">
		<h2><? echo _e('Meme Button Opzioni','meme-button');?></h2>
		<br />
		<form method="post" action="options.php">
			<h3><? echo _e('Seleziona l\'immagine','meme-button');?></h3>
			<table border="0">
			<tr>
			<?for ($i=1;$i<5;$i++){
			?>
				<td><input type="radio" name="meme_img" value="<?echo $i;?>" <?if(get_option('meme_img')==$i){echo "checked=\"checked\"";} ?> /></td><td><img src="<? echo $dir."img/".$i.".png"; ?>" /></td>
			<?}?>
			</tr>
			</table><br /><br />
			<h3><? echo _e('Posizione del Meme Button','meme-button');?></h3><br />
			<table border="0">
			<tr>
			<td><input type="checkbox" name="meme_after" value="1" <? if (get_option('meme_after')=='1'){?> checked="true" <?}?> value="meme-after">  <? echo _e('Prima del test dell\'articolo e dopo il titolo','meme-button');?></td>
			<td><input type="checkbox" name="meme_befor" value="1" <? if (get_option('meme_befor')=='1'){?> checked="true" <?}?> value="meme-befor">  <? echo _e('Dopo il testo dell\'articolo','meme-button');?></td>
			</tr>
			<tr>
			<td><input type="checkbox" name="meme_post" value="1" <? if (get_option('meme_post')=='1'){?> checked="true" <?}?> value="meme-after">  <? echo _e('Inserisci in ogni articolo','meme-button');?></td>
			<td><input type="checkbox" name="meme_page" value="1" <? if (get_option('meme_page')=='1'){?> checked="true" <?}?> value="meme-after">  <? echo _e('Inserisci in ogni pagina','meme-button');?></td>
			</tr>
			</table>
			<p class="submit"><input type="submit" value="<?php _e('Save') ?>" class="button-primary" name="catalog_page_save"/></p>
			<?php wp_nonce_field('update-options'); ?>
			<input type="hidden" name="page_options" value="meme_img,meme_befor,meme_after,meme_post,meme_page">
			<input type="hidden" name="action" value="update" />
		</form>
		<br />
		<h2><? echo _e('Support Plugin','meme-button');?></h2>
		<p><br />
		<h3><a href="http://meemi.com/p/signup/enzolarosa" target="_blank">Registrati su Meemi</a></h3>
		<table border="0">
		<tr>
		<td><? echo _e('Clicca Mi Piace','meme-button');?></td>
		<td><fb:like href="http://www.facebook.com/vincenzolarosa.it" send="false" layout="button_count" width="150" show_faces="false" font="verdana"></fb:like></td>
		<td><a href="http://twitter.com/enzolarosa" class="twitter-follow-button" data-lang="it">Follow</a></td>
		<td><a href="http://twitter.com/oceanphonenet" class="twitter-follow-button" data-lang="it">Follow</a></td>
		<td><? echo _e('Seguimi su Meemi','meme-button');?></td><td><a href="http://meemi.com/enzolarosa" target="_blank">enzolarosa</a></td>
		</tr>
		</table>
		</p>
	</div>
<?}
add_action('admin_menu', 'meme_addmenu');
add_filter('the_content', 'meme_button');
?>