<div class="main_container">
	<div class="pda_faq">
		<h3>Q: I get this error "Plugin could not be activated because it triggered a fatal error" when activating
			the plugin, what should I do?</h3>
		<p>Please check with your web hosting provider about its PHP version and make sure it supports PHP version
			5.4 or greater. Our plugin's codes are not compatible with outdated PHP versions. As a matter of fact,
			WordPress also recommend your host supports:</p>
		<ul style="list-style-type: disc; margin-left: 17px; ">
			<li>PHP version 7 or greater</li>
			<li>MySQL version 5.6 or greater OR MariaDB version 10.0 or greater</li>
			<li>HTTPS support</li>
			<li>Older PHP or MySQL versions may expose your site to security vulnerabilities.</li>
		</ul>
		<h3>Q: Why can I still access my files through non-protected URLs?</h3>
		<p>Please clear your browser's cache (press CTRL+F5 on PC, CMD+SHIFT+R on Mac) as files and especially
			images are usually cached by your browsers.</p>
		<p>Also, if you're using a caching plugin such as W3 Total Cache or WP Super Cache to speed up your
			WordPress website, please make sure you clear your cache as well. Your browsers and caching plugin could
			still be showing a cached (older) version of your files.</p>
		<h3>Q: Why am I getting “page not found” 404 error when accessing private links?</h3>
		<p>It seems our custom rewrite rules are not inserted into your .htaccess file properly. There are a few reasons for this:</p>
		<ul style="list-style-type: disc; margin-left: 17px; ">
			<li>You edit and mess up your .htaccess rules <br/>
				Please validate your .htaccess rules under <a href="<?php echo $helper_url ?>">Helpers</a> tab
			</li>
			<li>Your WordPress folders are structured differently from usual</li>
		</ul>
		<p>For example, your domain’s root folder is located at, let's say, <code>home/</code> directory but your WordPress files are put under <code>home/wp/</code> directory. In such cases, our plugin can't insert our .htaccess codes properly, and so, you have to manually update your .htaccess located at <code>home/wp/</code> directory with our plugin's custom rewrite rules.</p>
		<p>For more information, please visit our
            <a href="https://preventdirectaccess.com/faq/?utm_source=gold&utm_content=settings-link&utm_campaign=pda_gold">official	FAQ</a>.</p>
	</div>
</div>