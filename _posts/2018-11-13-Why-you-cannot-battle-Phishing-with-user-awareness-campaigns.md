---
layout: post                          # (require) default post layout
title: "This is why you cannot battle phishing with user-awareness campaigns"                   # (require) a string title
date: 2018-11-13 19:00:02 +0100       # (require) a post date
categories: [phishing, awareness]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1062127172629028864). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">Unpopular opinion of the day: <a href="https://twitter.com/hashtag/phishing?src=hash&amp;ref_src=twsrc%5Etfw">#phishing</a> awareness campaigns and teaching your users to stay frosty is a close to useless endeavour. A waste of resources. Read on to see my point (1/n) /cc <a href="https://twitter.com/troyhunt?ref_src=twsrc%5Etfw">@troyhunt</a> <a href="https://twitter.com/randomdross?ref_src=twsrc%5Etfw">@randomdross</a> <a href="https://twitter.com/sirdarckcat?ref_src=twsrc%5Etfw">@sirdarckcat</a></p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/1062127172629028864?ref_src=twsrc%5Etfw">November 12, 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

I know anti-phishing is a business that feeds a lot of people but the way this war is fought today just seems off to me.

First, I differentiate targeted phishing campaigns (usually APTs) from massive or moderately massive phishing. I don't think I need to point out why you can't fight the former with awareness.

Massive phishing is like mail spam: Cheap, risk-free and thrives under big numbers. 1 victim for each 100 targets might seem a low turnover but if you have 100k targets from the same bank figures suddenly get grimmer, while staying cheap for the phisher. But 1% is sooo distant from real world figures for phishing click-through from regular users. In one of my past gigs we conducted regular internal phishing on employees massively. Click-through never went below 10%.

Awareness campaigns ensued to deliver guidance to people to look out for unexpected emails, not opening attachments or clicking on links. Results still randomly ranged between 10% and 20% regularly. It was common to hear victims state how coincidental it was that Rachel, the phisher, shared first name with some other Rachel who regularly emailed them. I don't blame them.

The message will happen to be believable enough to someone, somewhere. It just happens.

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">I am an engineer working for an anti-phishing security company and I confess I have had some -majorly- close calls from our training simulations. Everyone gets tired, distracted, or careless, not just unsophisticated people.</p>&mdash; Nathaniel Jones (@thenthj) <a href="https://twitter.com/thenthj/status/1037474559849652225?ref_src=twsrc%5Etfw">September 5, 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

And we are just getting started on the "don't click on unknown links" silly security adagio you still often get from awareness campaigns.

Yeah right, as if in 2018 you could know where the hundreds of links you click every day take you: link shorteners, open redirects from trusted domains, no status bar preview on touchscreens, TOCTOU, tabnabbing... 

If you still believe you can prevent users from brainlessly clicking on links, consider also there are links that do not look like links at all. 

Exhibit A: 

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">This is the closest I&#39;ve ever come to falling for a Gmail phishing attack. If it hadn&#39;t been for my high-DPI screen making the image fuzzy… <a href="https://t.co/MizEWYksBh">pic.twitter.com/MizEWYksBh</a></p>&mdash; Tom Scott (@tomscott) <a href="https://twitter.com/tomscott/status/812265182646927361?ref_src=twsrc%5Etfw">December 23, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  
  

Exhibit B:

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">Phishing (or malware) Google Doc links that appear to come from people you may know are going around. DELETE THE EMAIL. DON&#39;T CLICK. <a href="https://t.co/fSZcS7ljhu">pic.twitter.com/fSZcS7ljhu</a></p>&mdash; zeynep tufekci (@zeynep) <a href="https://twitter.com/zeynep/status/859840026082988038?ref_src=twsrc%5Etfw">May 3, 2017</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

  
  

Exhibit C:

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">How to make paranoid targets click on email link: send a short newsletter about upcoming training courses with small unsubscribe link</p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/595953316858884096?ref_src=twsrc%5Etfw">May 6, 2015</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  
  

OK, people brainlessly click through. But at least we can teach them not to put their credentials on untrusted sites right? Well just before you start with the awareness there is some prep work you need to do. 

For your awareness campaign to be remotely successful, you need to keep your login pages (that is, the forms where your users put credentials) *consistent*.

Consistent means you cannot have a myriad of places (URLs, frames, apps) where your users can login (and all with a different UI or CSS). Multiple logins, on different sites, UI dialogs, CSS... it's just [bad security urbanism](https://krausefx.com/blog/ios-privacy-stealpassword-easily-get-the-users-apple-id-password-just-by-asking)

You can only have your users putting credentials on a *single* place. If they are not gonna check the URL properly (or they actually can't, more on that later) at least give them a fixed familiar form to mentally refer to when things get ugly. e.g. https://accounts.google.com

That helps them build mentally a model of "how does it look when this company asks for credentials". Sending them email messages telling them that they won't be asked for a password via email or phone won't help. Also, by doing that you retain control and can [properly notify users](https://gsuiteupdates.googleblog.com/2018/06/a-new-look-for-google-sign-in-screens.html) of upcoming changes so they actually expect them

But even if you do that, you still need to give users a way of actually checking whether it is you or some phisher the one asking for the credentials. It turns out there is only one way to do that: [The Almighty Browser Address Bar](https://lists.openwall.net/full-disclosure/2011/12/08/6).

So let's say after your awareness campaign your users actually glance at the address bar (which is assuming a lot). First, are they able to do that? There is a [ton of situations](https://insights.sei.cmu.edu/cert/2016/08/the-risks-of-google-sign-in-on-ios-devices.html) where you are just out of luck with no clear indicator of who is actually receiving your credentials
  

In some other cases, you are being deceived by UI bugs: 
  

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">RT if you think the address bar should display an origin.  <a href="https://twitter.com/msftsecresponse?ref_src=twsrc%5Etfw">@msftsecresponse</a> says it shouldn&#39;t.  =( <a href="https://t.co/qv4fuGW2ct">pic.twitter.com/qv4fuGW2ct</a></p>&mdash; baseband javascript rce nightmare scenario (@randomdross) <a href="https://twitter.com/randomdross/status/704366020610228225?ref_src=twsrc%5Etfw">February 29, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  


Even the size of your screen matters:

<blockquote class="twitter-tweet" data-conversation="none" data-lang="en"><p lang="en" dir="ltr">Even the size of your screen matters: <a href="https://t.co/CXJhmhZs46">pic.twitter.com/CXJhmhZs46</a></p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/1062127205797584896?ref_src=twsrc%5Etfw">November 12, 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

  

And... it's not enough to only check the address bar *only once*, heh, what were you thinking?

<iframe width="560" height="315" src="https://www.youtube.com/embed/AXEXcV7m3ds" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

  

Lastly, have you considered Mobile UI design principles? Real state is pricy so the address bar is just not there sometimes:

  

<blockquote class="twitter-tweet" data-conversation="none" data-lang="en"><p lang="en" dir="ltr"><a href="https://twitter.com/randomdross?ref_src=twsrc%5Etfw">@randomdross</a> it seems the iOS Gmail app thinks the same <a href="https://t.co/Yl2aQ4y4lN">pic.twitter.com/Yl2aQ4y4lN</a></p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/704809052359016448?ref_src=twsrc%5Etfw">March 1, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

  

I could go on but you get the point. How do we effectively fix this in a sustainable manner? Not by focusing on awareness that's for sure. Cheers

UPDATE
------

Another Example: this one is a fake popup resembling the "Login with Facebook" window that is used in most social logins. The popup is actually built as part of the original origin, thus having full access to the login form.

<iframe width="560" height="315" src="https://www.youtube.com/embed/nq1gnvYC144" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>







