---
layout: post                          # (require) default post layout
title: "Securely managing Capability-bearing URLs"                   # (require) a string title
date: 2018-12-18 19:00:02 +0100       # (require) a post date
categories: [web, appsec]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1031939066747596800). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

App stance on securely managing Capability-Bearing URLs has improved over time, but it's surprising the shortage of Security Engineering Cheatsheets on the topic. 

Capability-bearing URLs (AKA magic links) most prevalent habitat are password reset or email validation functions. But are also used to protect sensitive content or perform one-click sensitive actions (e.g. reading private files, setting modifications, approvals...). Proving posession of a magic link is all you need to perform the associated operation (rwx), so typically no other authentication or authorization mechanism is involved. When AuthN/Z is also present and orthogonal, we are not talking about magic links, but deep-links instead.

And while we are at it, if your user clicks _unsubscribe_ on an email, please make that a magic link (automatic action) and not a deep link (asking for login first).

So, how do you manage magic links in your app in a secure fashion?

First, decide whether you need to be capable of revoking the validity of magic links one by one discretionarily and that you don't anticipate scaling problems from storing state after each generated link. If you answer Yes to both, you need to generate magic links that are **STATEFUL**, that is, contain a mere identifier (token) to the associated action/state stored on your side.

Otherwise, you can get away with **STATELESS** magic links, which incorporate all the required data/state for the associated action in the query part of your URL.

For **STATEFUL** links, security often boils down to the unpredictability of the token, which is easy to accomplish. Use 256-bit random numbers. Generate those using Crypto-Strong PRNGs (i.e. /dev/urandom). Avoid other random generators that operate on userland (e.g. OpenSSL). When in doubt, reach to your nearest crypto-nerd for validation.

For **STATELESS** links, things are trickier. First, ensure links for a fixed action change every time you generate them (unless they should never ever expire, which is weird). For this, add a nonce or timestamp to the included data. Guarantee at least the integrity of the included data, but also decide if you need to encrypt the data so it's not world-readable (spoiler: you want to encrypt).

For integrity only (against medical advice), append an HMAC-SHA2 of the included data, and beware of how you canonicalize that data beforehand. Yes, that involves managing a secret/key of some sort on your side.

Don't try to ditch the key and get away with concatenating `data + timestamp + whatever` in funky ways and feeding the result into a regular hashing functions. You won't create a secure MAC/Signature. It's just too easy to mess up.

If you wisely decide to encrypt the data, you still need integrity, so use some form of Authenticated Encryption (such as AES-GCM). Run from other encryption primitives that do not offer built-in integrity.

Also, if you need to restrict the amount of valid magic links for a given action at any given time to 1 (e.g. for password resets), STATELESS links will give you headaches. You will probably end up with some cache of revoked links, which is not that stateless after all.

It's easy to come up with situations that may arise where you will need to revoke old magic links. So yeah, STATELESS links are not easy to get right. Resort to STATEFUL when possible.

Regardless of your choice, if you find yourself doing string comparison with tokens or MACs, use functions that operate on constant-time. You can find more info on [this topic here](https://blog.ircmaxell.com/2014/11/its-all-about-time.html).

Ensure you prefix all your magic links with a pattern that can easily be included in your `/robots.txt` file to prevent accidental leaks of valid magic links to search engines. Avoid long-lived links when possible, particularly for overly-sensitive actions.

Be wary of front-end configs that support wildcards in their virtualhosts. If your application supports arbitrary values in the Host HTTP Request header the resulting magic links could be [leaked to attackers](https://www.skeletonscribe.net/2013/05/practical-http-host-header-attacks.html).

Magic links that grant privileged actions such as reset passwords or to sensitive documents should ensure that the response content do not link external subresources (JS, CSS) from 3rd parties. If 3rd party resources are present, magic links can leak through referrers, so at least rely on "rel=noreferrer" attributes to prevent this.

Remember Open Redirects in your application could cause magic link leakage in corner cases. Check out [this reference](https://makensi.es/rvl/openredirs/#/43) just to be sure

Finally, protect particularly sensitive magic links from inadvertent copy/paste operations from sloppy users by leveraging the JavaScript History API (history.replaceState()) after a successful load.

That's it, hope it is useful. As usual, enhancements or corrections are welcome!


