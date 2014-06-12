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

<h2>Dealing with the problem with PHP</h2>
<p>The solution I came up is to monitor all those referer urls and treat them accordingly. If a referer from a .ru domain is found it gets blacklisted and we redirect them to their origin. I am sure there are better ways out there but since I am a PHP guy I go with php.</p>

<h2>Basic Usage</h2>
<p> In the most simple way the class can be used like this
<pre>$mama = new DetectRu("www.example.ru");</pre>
Go through the examples directory for more</p>

<h2>To Do</h2>
<ul>
<li>Add a check function to check if the provided argument is a valid url</li>
<li>Add support for txt lookup of unwanted strings like .ru (ex. also look for China (.cn) domains)</li>
<li>Add check to be able to supply $_SERVER or string (at the moment only strings are welcome)</li>
<li>Code cleanup and improvement</li>
<ul>

<h2>Examples</h2>
You can find the original post and examples at <a href="http://www.tsartsaris.gr/send-them-home-mama" target="_blank">this post</a>

<h2>Results</h2>
Check out the results folder for so far stored hits. Non .ru domains inspected carefuly before submition in the list. 

Mail me info@tsartsaris.gr or tsartsaris@gmail.com for anything you want. Cheers.
