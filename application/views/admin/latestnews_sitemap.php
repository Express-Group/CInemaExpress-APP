<?php header ("Content-Type:text/xml");?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title>cinemaexpress.com Instant Articles</title>
		<link><?php print BASEURL; ?></link>
		<description>Cinema Express is a premier movie portal providing the latest news, movie reviews and upcoming information from the Bollywood, kollywood and tollywood film industry cini entertainment news.</description>
		<language>en</language>
	    <?php print $data; ?>
	</channel>
</rss>