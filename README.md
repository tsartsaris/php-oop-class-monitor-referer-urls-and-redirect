Send Them Home Mama
===============================================

This is an OOP PHP class to monitor , save and redirect referrers from .ru domains with a malicious SEO strategy. 

<h2> Why this class </h2>
<p>Recently I started a personal project to server my own web site analytics with PHP and Neo4j graph database. As I was examining the url referer from the $_SERVER array I discovered many .ru domains with links to my sites giving me hits on certain pages. Searching around the web I came up with a lot articles explaining the SEO strategy of most .ru domains and it goes like this : Webmasters inject backlinks to several sites over the internet (preferable to sites with open statistics). If a domain has it's aw stats in example with no security then this can be crawled by spiders and count those hits from .ru domains as backlinks to them. This way they increase their conent value.</p>

<h2>Taking measures against those tactics:</h2>
<ul>
<li>Secure aw stats or any other analytics software you have (You must and you should have them all ready secured)</li>
<li>Redirect a range of IPs from .ru sites in your .htaccess (Althought a popular technique, not recomended since you might block good referer urls as well)</li>
<li>Keep a blacklist and check against this list to block the incoming hit before it would get into account, finally redirect them back to their home</li></ul>
To be continued from here.... got to go.
