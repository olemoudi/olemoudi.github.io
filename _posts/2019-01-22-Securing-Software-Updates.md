---
layout: post                          # (require) default post layout
title: "Securely Delivering Software Updates"                   # (require) a string title
date: 2019-01-22 19:00:02 +0100       # (require) a post date
categories: [appsec, crypto]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

![software update](/static/img/oreo.png)

VideoLAN team have recently attracted some heat because of their refusal to evaluate the need of adding TLS to their update distribution channels.

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">We all love your media player, but that’s really rude <a href="https://twitter.com/hashtag/VLC?src=hash&amp;ref_src=twsrc%5Etfw">#VLC</a> 🙄<br><br>VLC developers refused to consider <a href="https://twitter.com/hashtag/software?src=hash&amp;ref_src=twsrc%5Etfw">#software</a> &quot;update-over-HTTP&quot; as a threat.<br><br>Responded→ “no threat model. no proof. no <a href="https://twitter.com/hashtag/security?src=hash&amp;ref_src=twsrc%5Etfw">#security</a> bug&quot;<br><br>It wouldn&#39;t hurt if you simply consider the suggestion.<a href="https://t.co/GWhE1US5Ko">https://t.co/GWhE1US5Ko</a> <a href="https://t.co/L77KDcNUMy">pic.twitter.com/L77KDcNUMy</a></p>&mdash; The Hacker News (@TheHackersNews) <a href="https://twitter.com/TheHackersNews/status/1086659984958652416?ref_src=twsrc%5Etfw">January 19, 2019</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


At first, they seem to have a point here. VLC software update distribution (similar to other software package management tools such as Debian/Ubuntu APT) is based on a network of uncontrolled mirrors. These mirrors alleviate last-mile downloads while thriving without the need of approval or official support from the software maintainer.

To mitigate the obvious risk of rogue or malicious package distribution posing as official packages, maintainer signs binaries and introduces some sort of signature check before applying downloaded updates. This effectively reduces the security of the scheme to a mere *has this package been modified since the original maintainer created it?*

In certain distribution models, this reduction seems to make sense from a slightly limited threat modelling point of view and  some people have bothered to [explain it carefully](https://whydoesaptnotusehttps.com/). Limited because it rules out the possibility of potential crypto fails or bugs.

It is true that, when talking about software distribution, it is generally more crucial to sign binaries that it is to transmit updates over secure channels. This is one of the reasons Apple got away with updates over HTTP up until iOS 10 (they did control the mirrors though). Typically, one can find distribution channels over TLS through unofficial mirrors that do not provide signature checking. At most, they provide text signatures and shift the responsibility of checking package signatures to the end user by bundling hashes with each download. 

Let's not forget that for a very long time, it was not possible to [download Putty in any secure fashion whatsoever](https://news.ycombinator.com/item?id=9577861).

I can relate to the fact that too much heat was pointed towards APT and VLC teams for not using TLS, while the community chose to ignore lots of other packages distributed over TLS but without signatures. However good defense in depth principles suggest that we should not ditch TLS just because of package signatures seem to get us covered under a particular threat model.

Aside from the fact that TLS in 2019 is ridicously cheap in all senses and excuses for not deploying it have been entirely debunked, as Matthew Green puts it, opting out is probably a bad decision in the long run. Software signing and verification schemes are greatly unvetted compared to TLS protocols, and bugs do appear eventually.

<blockquote class="twitter-tweet" data-lang="en"><p lang="en" dir="ltr">A lot of people think TLS is unnecessary for software updates, provided the update mechanism already includes signing/verification. Unless you’re Microsoft, this seems like a big mistake.</p>&mdash; Matthew Green (@matthew_d_green) <a href="https://twitter.com/matthew_d_green/status/1087451107436228608?ref_src=twsrc%5Etfw">January 21, 2019</a></blockquote>
<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>


Incidentally, the very day this discussion was peaking in Twitter, [CVE-2019-3462](https://justi.cz/security/2019/01/22/apt-rce.html) came out.

Good timing I guess. 

