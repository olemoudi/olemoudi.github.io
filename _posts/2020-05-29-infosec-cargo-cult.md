---
layout: post                          # (require) default post layout
title: "Is your Information Security program suffering from Cargo Cult syndrome?"                   # (require) a string title
date: 2020-05-29 19:00:02 +0100       # (require) a post date
categories: [cargocult, appsec, strategy]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: cargocult.jpg            # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---


The concept of **Cargo Cult** as a belief system truly fascinates me. Its paralellism is exceptionally eloquent at explaining things that frequently happen in tech fields such as Information Security. A great summary of the origins of the term follows:

> *During World War 2, natives in the remote South Pacific islands first made contact with the outside world following the arrival of the American armed forces. They also flew in wonderful goods from the developed world. However, with their subsequent departure that marked the end of the war, the natives no longer enjoyed such luxuries.*
>
>*Out of desperation, they sought to duplicate the elaborate American airbases through which they obtained their precious cargo. The replicas included an elaborate wooden runway, furnished with a small hut that served as a control tower.*
>
>*The natives religiously carried out their air traffic duties, hoping for the planes to return, but their efforts were clearly in vain.*
>
> [Don't be deceived by cargo cult economics](https://www.nst.com.my/news/2016/07/158616/dont-be-deceived-cargo-cult-economics?d=1) - *New Straits Times 2016*

So in a nutshell the Cargo Cult Syndrome describes undeveloped societies that crave to obtain goods from more advanced societies by merely applying coincidental techniques, tools or processes whimsically. **There is no understanding of what else is necessary for everything to work as expected.**. Because of this, the Infosec Lifecycle ensues:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">Infosec lifecycle:<br>It won&#39;t happen<br>It happened<br>Buy shiny tool <br>Happened again<br>Turn it on<br>And again<br>Now tune it<br>And again<br>Buy new shiny tool</p>&mdash; Steve Werby (@stevewerby) <a href="https://twitter.com/stevewerby/status/768419835655098368?ref_src=twsrc%5Etfw">August 24, 2016</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

In the Information Security field, the most prevalent example of Cargo Cult is when we buy products to improve the security of our company. We sometimes believe that just by purchasing a product (i.e. the runway and the airplane) we obtain the corresponding expected benefit. At some point halvarflake tweeted about the 5 types of security communities:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">... something that needs to be deeply engineered into the platforms), Offensive security folks (people that build real-world attacks), Conference-security-research folks (who research possible vulnd in order to publish), and non-platform Defenders (who work on defending ...</p>&mdash; halvarflake (@halvarflake) <a href="https://twitter.com/halvarflake/status/1222049036733243392?ref_src=twsrc%5Etfw">January 28, 2020</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

Cargo Cult syndrome seems to manifest more frequently in Security Product People. Take for example Static-Analysis Tools (SAST). In the wake of the DevOps transformation we purchased things such as Fortify, Checkmarx, Veracode...  believing that just by making them scan our code and fixing the bugs we would deliver more secure apps. Part of the blame here could be attributed to marketing and the appeal of products sold as autonomous problem-solving agents. The hard truth is that these tools need dedicated teams to review the relentless stream of bugs they spit, to refine rules to eliminate false-positives (careful enough to not create false-negatives), and work with development teams in fixes that cannot happen just following OWASP-lore. You need talent, you need dedication, you need people with a strong understanding of these tools and the affected apps. These are the processes and investments around SAST tools that are usually missing.

Cargo Cult and DevOps have been (and still are sometimes) shameful travel companions in terms of picking up technology trends without [the corresponding cultural changes](https://www.linkedin.com/pulse/devops-thoughts-senior-leadership-team-andrew-stickland/) and processes. 

Other notorious examples for the Cargo Cult Syndrome in Infosec include things such as [Content-Security-Policy](https://youtu.be/9dCvcq7KkxA?t=1279) and other HTTP Security Headers, SSL Pinning or WAFs & IDS. We copy those from the industry best practices but we seldom ensure the proceses beneath those are complete. Cryptography in general is another good example. As [@laparisa](https://twitter.com/laparisa) put it: "[Blockchain is not gonna solve all of our security problems](https://www.youtube.com/watch?v=py2qmGbyhlw&feature=youtu.be&t=1572)". Employee security awareness campaigns suffer from the same problem. We rarely complete the process with the steps needed to actually make our users [more resilient to mistakes](https://www.seancassidy.me/phishing-simulations-considered-harmful.html) when handling out their credentials.

Why does this happen? Because we are lazy. [Designing for understandability](https://landing.google.com/sre/resources/foundationsandprinciples/srs-book/) is hard and there are incentives around having to only need to look in a single point to understand security invariants. Nevertheless we should strive to detect when we are falling short when integrating new tools and processes, and suffering from the Cargo Cult Syndrome.






