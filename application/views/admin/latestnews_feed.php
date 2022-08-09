<?php header ("Content-Type:text/xml");?>
<rss version="2.0" xmlns:content="http://purl.org/rss/1.0/modules/content/">
	<channel>
		<title>cinemaexpress</title>
		<link><?php print BASEURL.@$sectionDetails['URLSectionStructure']; ?></link>
		<description>Cinema Express is a premier movie portal providing the latest news, movie reviews and information from the film industry.</description>
		<language>en</language>
	    <?php print $data; ?>
	</channel>
</rss>