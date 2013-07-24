<?php
/**
 * @package WordPress
 * @subpackage Default_Theme
 */
/*
Template Name: Contact Us
*/
?>

<?php get_header(); ?>
<div id="donate-header" style="background: url('<?php bloginfo('template_directory'); ?>/gfx/banner_contactus.jpg');"></div>
<div id="movement">
    <div id="contact-left">
        <div class="contact-box" id="contact-form">
                <h2 class="header100" style="width:238px;">SEND US A MESSAGE</h2>
		<div>
			<?php gravity_form(3, false, false); ?>
		</div>
	</div>       
        <div class="contact-box" id="contact-country-small" style="float:right;">
            <h2 class="header100" style="width:78px;">LAOS</h2>
            <img src="http://maps.google.com/maps/api/staticmap?center=19.871856,102.135773&zoom=14&markers=19.871856,102.135773&size=250x200&sensor=false">
                <p class="contact-address"><i>Ban Naviengkham,<br/>Luang Prabang, Laos</i></p>
                <p><a href="mailto:PoPNicaragua@pencilsofpromise.org">PoPLaos@pencilsofpromise.org</a></p>
        </div>
        <div class="contact-box" id="contact-country-small" style="float:left">
            <h2 class="header100" style="width:150px;">GUATEMALA</h2>
            <img src="http://maps.google.com/maps/api/staticmap?center=14.740611,-91.159417&zoom=14&markers=14.740611,-91.159417&size=250x200&sensor=false">
                <p class="contact-address"><i>Vía Callejón Chotzar<br/>
                (15 metros de la Posada Los Encuentros)<br/>
                Zona 4, Barrio Jucanya<br/>
                Panajachel, Sololá, Guatemala</i></p>
                <p><a href="mailto:PoPGuatemala@pencilsofpromise.org">PoPGuatemala@pencilsofpromise.org</a></p>
        </div>
    </div>
    <div id="contact-right">
        <div class="contact-box" id="contact-check">      
            <h2 class="header100" style="width:170px;">MAIL A CHECK</h2>
            <span class="address100">Attn: Tom Casazzone</span>
            <span class="address100">Pencils of Promise</span>
            <span class="address100">37 West 28th Street, 3rd Floor</span>
            <span class="address100">New York, NY 10001</span>                   
        </div>
        <div class="contact-box" id="contact-country-large">    
            <h2 class="header100" style="width:130px;">NEW YORK</h2> 
            <img src="http://maps.google.com/maps/api/staticmap?center=40.745826,-73.989015&amp;zoom=14&amp;markers=40.745826,-73.989015&amp;size=255x408&amp;sensor=false">
            <p class="contact-address"><i>37 West 28th Street, 3rd Floor<br/>New York, NY 10001</i></p>
            <p><a href="mailto:info@pencilsofpromise.org">info@pencilsofpromise.org</a></p>
        </div>
        <div class="contact-box" id="contact-country-small">
            <h2 class="header100" style="width:150px;">NICARAGUA</h2>
                <img src="http://maps.google.com/maps/api/staticmap?center=12.929299,-85.918045&amp;zoom=14&amp;markers=12.929299,-85.918045&amp;size=250x200&amp;sensor=false">
                <p class="contact-address"><i>De Catedral 1 cuadra al norte y 75 varas al  oeste, mano derecha.</i></p>
                <p><a href="mailto:PoPNicaragua@pencilsofpromise.org">PoPNicaragua@pencilsofpromise.org</a></p>
        </div>           
    </div>
<?php get_footer(); ?>