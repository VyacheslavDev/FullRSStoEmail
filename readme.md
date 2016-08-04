This is script for work with RSS and sending full RSS Feeds on Email.
All setting script's you will find on RSStoEmail.php - file, as comments.

Special attention shoud be paid to:
     	$description[$i] = $html->find('div.story-body',0)->plaintext; 
Here you shoud will find on your site with RSS feed - body with data text of the news and add in field "find('here',0)".

For example you have RSS http://feeds.bbci.co.uk/russian/rss.xml

1. select first post, and go to web site BBC.com with post.
2. activate mode view HTML code, and seek body with data text of the news, this is <div class="story-body"> very good.
3. next step you insert this in "find('div.story-body',0)" this all.
