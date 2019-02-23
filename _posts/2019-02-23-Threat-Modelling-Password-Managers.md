---
layout: post                          # (require) default post layout
title: "Password Managers and Threat Modelling in 2019"                   # (require) a string title
date: 2019-02-23 19:00:02 +0100       # (require) a post date
categories: [passwords, threatmodelling, commentary]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: keys.png            # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1097991256637145093). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

![sim swapping](/static/img/keys.png)

[Interesting research](https://www.securityevaluators.com/casestudies/password-manager-hacking/), albeit based on a limited Threat Model that does not suit the real issues with password managers in 2019.

Paper assumes local attacker or digital acquisition scenario for a stolen device as the main threat. Long term memory persistence is indeed an issue for master passwords but for particular entries... they most probably will end up leaking from the consuming apps. Local attacker is a pretty rough threat model scenario in most cases. Not really worth protecting against with userland code. As per the real threats that are not considered in the paper, first, most managers encourage users to use integration plugins that ultimately perform autofill with minimal user interaction on browser and other apps

Here is where [most of the historical security issues appeared](https://www.howtogeek.com/338209/you-should-turn-off-autofill-in-your-password-manager/), in some cases rooted deeply into how the web is designed, without any sort of possible fix other than disabling autofill altogether .

Second, the problem of securely receiving updates to the password manager. On all channels, your passwords are ultimately trusted to the software maintainers. Should the binaries get [inadvertently compromised somehow](https://www.symantec.com/connect/blogs/check-your-sources-trojanized-open-source-ssh-software-used-steal-information), it's gameover for all users.

Or worse, what if the official maintainer of a FOSS manager on Google Play suddently goest banrukpt and needs money? What if he [sells ownership to the wrong folks](https://www.bleepingcomputer.com/news/security/-particle-chrome-extension-sold-to-new-dev-who-immediately-turns-it-into-adware/)?