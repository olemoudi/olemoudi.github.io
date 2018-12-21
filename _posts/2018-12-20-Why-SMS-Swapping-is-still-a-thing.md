---
layout: post                          # (require) default post layout
title: "Why SIM Swapping Attacks are still a thing in 2018"                   # (require) a string title
date: 2018-12-20 19:00:02 +0100       # (require) a post date
categories: [phishing, mobile, mfa]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1075862329949126657). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

![ptacek on plutonium](/static/img/sim-swapping.jpg)

[News out there](https://twitter.com/olemoudi/status/1075862329949126657) that attackers are bypassing 2FA based on One-time codes sent in SMS. A bit misleading since the attack is based on tricking people into sharing their codes with a fake login site.

This would work as well for TOTPs, email codes... since the actual vector is to play the man, not the cards.

SMS OTPs are weak for a whole other reason. Using them as 2nd factor eliminate the need to trick the victim by tricking someone else, typically the mobile carrier or the SS7 network.

Why not removing SMS as a 2fa? Because it's convenient (everyone has it available) and because is easy to recover (you just go ask your carrier for a new SIM).

Without SMS it's hard to deploy universal account recovery flows for cases where your users lose access to all their enrolled devices.

If their phone falls to the swimming pool, they will have to ask for a SIM dupe regardless of other services, hence recovering access to your second factor too.


If you remove that sort of universal what-you-have-with-built-in-recovery-flow factor you are on your own. You don't want to have your users exposed to SIM Swapping attacks but neither to make them physically go anywhere just to login again to your app from their new device.

Tough trade-offs.

I have only seen two solutions in the wild for this problem:

1. [Authy's 24h delay SMS based account recovery](https://twitter.com/olemoudi/status/1075862329949126657). They give a window of opportunity for the victim to detect SIM swapping attacks against his account and deny the attacker's request. Basically they periodically send warnings through that 24h period to the victim's email and phone, allowing to take one-click actions to cancel the recovery process.

2. Google's recently launched [Advanced Protection Program](https://twitter.com/olemoudi/status/1075862329949126657). In a nutshell, they remove the SMS entirely as 2nd factor option and rely on redundant hardware (usb key) for your swimming-pool related recovery needs.

Authy's one is more universal, albeit hard to sell to business people. You need to convince users to enroll multiple devices to use them as backup recovery. Otherwise they may face a self-imposed 24h outage of your services. 

So yeah, it's hard for services to ditch SMS as a 2nd factor. You will have to support multi-device trust networks and educate users on the benefits of having more than one device enrolled.



