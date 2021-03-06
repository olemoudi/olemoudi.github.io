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

   

I know anti-phishing is a business that feeds a lot of people but the way this war is fought today just seems a bit off to me.

First, I differentiate targeted phishing campaigns (usually APTs) from massive or moderately massive phishing. I don't think I need to point out why you can't fight the former with awareness.

Massive phishing is like mail spam: Cheap, risk-free and thrives under big numbers. Getting 1 user to fall for it for each 100 targets may seem a low turnover but if you have 100k targets from the same company... figures suddenly get grimmer. Still staying cheap for the phisher. But 1% is **so** distant from real world figures for phishing click-through by regular users. 

In one of my past gigs we conducted regular internal phishing campaigns on employees massively. Click-through rates consistently went over 10%. Awareness campaigns ensued to deliver tips to look out for in unexpected emails, not opening attachments nor clicking on links. Results still randomly ranged between 10% and 20% consistently. It was common to hear victims state how coincidental it was that Rachel, the phisher, shared first name with some other Rachel who regularly emailed them. I don't blame them.

The bait will happen to be believable enough to someone, somewhere. It just happens.

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">I am an engineer working for an anti-phishing security company and I confess I have had some -majorly- close calls from our training simulations. Everyone gets tired, distracted, or careless, not just unsophisticated people.</p>&mdash; Nathaniel Jones (@thenthj) <a href="https://twitter.com/thenthj/status/1037474559849652225?ref_src=twsrc%5Etfw">September 5, 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

   

And we are just getting started on the *"don't click on unknown links"*  typical security adagio you still often get from awareness campaigns.

Yeah right, as if in 2018 you could know where the hundreds of links you click every day take you to. Consider link shorteners, open redirects from trusted domains, lack of status bar preview on touchscreens, TOCTOU, tabnabbing... 

If you still believe you can teach users to not click on links brainlessly, consider also that **there are links that do not look like links at all**. 

   

### Exhibit A: 

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">This is the closest I&#39;ve ever come to falling for a Gmail phishing attack. If it hadn&#39;t been for my high-DPI screen making the image fuzzy… <a href="https://t.co/MizEWYksBh">pic.twitter.com/MizEWYksBh</a></p>&mdash; Tom Scott (@tomscott) <a href="https://twitter.com/tomscott/status/812265182646927361?ref_src=twsrc%5Etfw">December 23, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  
   


### Exhibit B:

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">Phishing (or malware) Google Doc links that appear to come from people you may know are going around. DELETE THE EMAIL. DON&#39;T CLICK. <a href="https://t.co/fSZcS7ljhu">pic.twitter.com/fSZcS7ljhu</a></p>&mdash; zeynep tufekci (@zeynep) <a href="https://twitter.com/zeynep/status/859840026082988038?ref_src=twsrc%5Etfw">May 3, 2017</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

   
  
  
### Exhibit C:

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">How to make paranoid targets click on email link: send a short newsletter about upcoming training courses with small unsubscribe link</p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/595953316858884096?ref_src=twsrc%5Etfw">May 6, 2015</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  
  

OK, people brainlessly click on links and it's hard to stop them. But at least we can teach them not to enter their credentials on untrusted sites right? Well just before you start rolling out your awareness campaign there is some prep work you need to do. 

For your awareness campaign to be remotely successful, you need to keep your login pages (that is, the forms where your users put credentials) **consistent**.

Consistent means you cannot have a myriad of places (URLs, frames, apps) where your users can login (and all with a different UI or CSS). Multiple logins, on different sites, UI dialogs, CSS... it's just [bad security urbanism](https://krausefx.com/blog/ios-privacy-stealpassword-easily-get-the-users-apple-id-password-just-by-asking)

You can only have your users putting credentials on a **single** place. If they are not gonna check the URL properly (or they actually can't, more on that later) at least give them a fixed familiar form to mentally refer to when things get ugly. e.g. [https://accounts.google.com](https://accounts.google.com) . Teach them it is unusual for random forms popping up in different places to ask them for credentials.

That helps them build mentally a model of _"how does it look when this company asks for credentials?"_. Also, by doing that you retain control of what your users naturally expect and you can [properly notify users](https://gsuiteupdates.googleblog.com/2018/06/a-new-look-for-google-sign-in-screens.html) of upcoming changes in the way you regularly ask for credentials.

But even if you do that, you still need to give users a way of actually checking whether it is you or some phisher the one asking for the credentials. It turns out there is only one way to do that: [The Almighty Browser Address Bar](https://lists.openwall.net/full-disclosure/2011/12/08/6).

So let's say after your awareness campaign your users actually glance at the address bar (which is assuming a lot). First, are they able to do that? There is a [ton of situations](https://insights.sei.cmu.edu/cert/2016/08/the-risks-of-google-sign-in-on-ios-devices.html) where you are just out of luck with no clear indicator of who is actually receiving your credentials
  

In some other cases, you are being deceived by UI bugs: 

   
  

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">RT if you think the address bar should display an origin.  <a href="https://twitter.com/msftsecresponse?ref_src=twsrc%5Etfw">@msftsecresponse</a> says it shouldn&#39;t.  =( <a href="https://t.co/qv4fuGW2ct">pic.twitter.com/qv4fuGW2ct</a></p>&mdash; baseband javascript rce nightmare scenario (@randomdross) <a href="https://twitter.com/randomdross/status/704366020610228225?ref_src=twsrc%5Etfw">February 29, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
  

   

In other cases, it's the size of the screen what matters:

   

<blockquote class="twitter-tweet" data-conversation="none" data-lang="en"><p lang="en" dir="ltr">Even the size of your screen matters: <a href="https://t.co/CXJhmhZs46">pic.twitter.com/CXJhmhZs46</a></p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/1062127205797584896?ref_src=twsrc%5Etfw">November 12, 2018</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

   

And... it's not enough to only check the address bar *only once*, heh, what were you thinking?

   

<iframe width="560" height="315" src="https://www.youtube.com/embed/AXEXcV7m3ds" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

  

Lastly, have you considered Mobile UI design principles? Real state is pricy so the address bar is just not there sometimes:

   

<blockquote class="twitter-tweet" data-conversation="none" data-lang="en"><p lang="en" dir="ltr"><a href="https://twitter.com/randomdross?ref_src=twsrc%5Etfw">@randomdross</a> it seems the iOS Gmail app thinks the same <a href="https://t.co/Yl2aQ4y4lN">pic.twitter.com/Yl2aQ4y4lN</a></p>&mdash; Martín Obiols (@olemoudi) <a href="https://twitter.com/olemoudi/status/704809052359016448?ref_src=twsrc%5Etfw">March 1, 2016</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

  

I could go on but you get the point. How do we effectively fix this in a sustainable manner? Not by focusing on awareness that's for sure. Some people think the only way forward is down [the U2F road](https://www.troyhunt.com/beyond-passwords-2fa-u2f-and-google-advanced-protection/). I mostly agree, but time will tell. 

   

UPDATES
------

* Update 28-4-2019 - This one exploits Mobile UI optimization of screen space. By hiding the Address Bar, mobile browsers expose themselves to redressing attacks that fool the user with fake Address Bars: [The Inception Bar](https://jameshfisher.com/2019/04/27/the-inception-bar-a-new-phishing-method/), a new phishing method

<video width="100%" controls="" autoplay="" loop="" style="margin: 0 auto; border: 2px solid black;">
  <source src="https://d33wubrfki0l68.cloudfront.net/783bd862c3df19b6fb4eac0b4f687d598c957891/a3915/assets/2019-04-27/demo.webm" type="video/webm">
  Your browser does not support the video tag.
</video>

There is also a great [quote](https://news.ycombinator.com/item?id=19770055) from the [Hacker News](https://news.ycombinator.com/item?id=19768072) thread:


> > I can't help but think that this was made possible by the complete collapse in common UI standards. 'Apps' have stopped being OS-toolkit apps and moved onto the web, and of course each designer needs to have their own special on-brand widget style. This has leaked onto the few remaining desktop apps: Chrome rejects the standard Mac OS widgets and reimplements everything, from buttons to the print dialog. Spotify does its own thing. And lest we think Apple has much respect for UX, iTunes is a mess. I genuinely can't use it. The result is that users have been trained not to expect consistent UI paradigms. Every UI is hunt-and-peck. And that paves the way for this kind of exploit.

* Update 14-2-2019 - Another Example of hopelessness: this one is a fake popup resembling the "Login with Facebook" window that is used in most social logins. The popup is actually built as part of the original origin, thus having full access to the login form.

<iframe width="560" height="315" src="https://www.youtube.com/embed/nq1gnvYC144" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>



* Update - [Cursory Attack](https://jameshfisher.github.io/cursory-hack/)





