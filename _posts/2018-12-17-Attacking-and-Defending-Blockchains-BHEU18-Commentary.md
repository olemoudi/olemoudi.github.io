---
layout: post                          # (require) default post layout
title: "Commentary on @veorq's talk on Attacking & Securing Blockchains from BlackHat EU18"                   # (require) a string title
date: 2018-12-17 19:00:02 +0100       # (require) a post date
categories: [security]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1074799343985680391). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

Great [introductory talk](https://aumasson.jp/data/talks/bheu18.pdf) from [@veorq](https://twitter.com/veorq) on the principles of secure public blockchains and errors of the past. Lots of recurring security themes touched here, which apply to general purpose apps. Let's go through some of them:

External dependencies: the more moving parts you outsource, the more exposed you are to failures. Online wallets and online GUIs represent the perfect target to compromise all users at once. You can't protect from that.

Unvested open-source utility code can become harmful as bip32gen fiasco showed, and package management tools may hide insecure/deprecation warnings. Improve your posture by using dependency tracking with tools tailored for security, e.g [https://github.com/BBVA/deeptracy]

Crypto APIs should be designed to be misuse resistant, particularly on default settings, and discourage devs from any sort of agility. Time to bump [good ol'advice](https://news.ycombinator.com/item?id=4779015#4779555) from [@tqbf](https://twitter.com).

![ptacek on plutonium](/static/img/plutonium.jpg)

Mobile Apps may be offline once installed but their delivery channel isn't. We tend to forget someone can obtain access to developer account + signing cert and push a malicious app update through markets.

Whats the actual value of this GPlay developer account+cert? [https://play.google.com/store/apps/details?id=com.android.keepass&hl=en]

Maybe mentioned during the talk but not on the slides: Prevent high profile mobile apps from auto-updating from markets. Keep available updates on the fridge for a week until no red flags raised

Lastly, in [@magoo](https://twitter.com/magoo)'s [5 Factors to secure systems](https://medium.com/starting-up-security/the-five-factors-used-to-secure-systems-7f58be0f447f): things will fail frequently, but you should recover quickly. Parity wallet bug is a good example of unrecoverable bug. Design first with recovery in mind. Panic buttons are a good pattern to exercise.


