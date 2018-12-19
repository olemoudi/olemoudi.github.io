---
layout: post                          # (require) default post layout
title: "Securely Handling User-Submitted Files"                   # (require) a string title
date: 2018-07-30 19:00:02 +0100       # (require) a post date
categories: [web, appsec]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1023976897661870083). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

So you need to accept user-submitted files on you app while maintaining a good security posture? Here's what you need to know.

This is probably old, well-known lore but sometimes advice is scattered through different guides out there. Also I got inspired by excellent [@magoo](https://twitter.com/magoo) essays at https://scrty.io and [@tqbf](https://twitter.com/tqbf) [crypto right answers](https://latacora.micro.blog/2018/04/03/cryptographic-right-answers.html)

First and foremost, consider that file-upload functionalities are fraught with pitfalls and extremelly hard to implement securely. By letting your users to upload files you are exposing yourself to remote code execution if somehow your tech-stack family is one of those fetching files from places and executing them at runtime.

But also you expose your app to script execution (XSS), which enables potent attacks against your users and file-uploads come handy for all sorts of platform abuse. Ranging from affecting the normal operation of your app, to impacting billing costs or illegal-content distribution


So, what can you do to protect yourself? (If you cannot afford to just outsource to S3...).

Standard 3-prong approach: 
1. Input Validation
2. Sandboxed Storage
3. Proper serving


Your first line of defense should be basic input validation checks: file size limits, whitelist of accepted file extensions and content validation by doing magic bit sniffing (e.g. using [Apache Tika](https://tika.apache.org/ )

Remember not to store the received file anywhere just yet while you conduct your full-fledged assessment over it. Don't do delete when wrong but instead publish when right. Race conditions could bite you if you don't follow this practice.

Design file-uploads using asynchronous patterns. You don't want to keep connections open while you do all sorts of slow validation on received files.

Now the tricky parts: carefully evaluate if you can afford to re-encode every file you receive. This has HUGE security benefits since you leave out all sorts of metadata attacks, file-smuggling, polyglots and other shenanigans.

This of course depends on the array of formats that you accept but typically for images should be a must-do for every app.

Establish additional rules of engagement before attempting encoding operations. Some very small images can actually have 6-digit pixel resolutions and [1kbyte zipfiles extract to thousands of gigabytes](http://www.unforgettable.dk/)

Processing user-submitted files is like strolling on thin ice. Also you should tune in to updates in your [third party encoding libraries](https://imagetragick.com/  )

Or just copy the [libraries Google uses](https://www.google.com/about/appsecurity/patch-rewards/ )


BUT if you can't affort to reencode, at least try to open the received file and check for sanity bounds.

_-Why does this xls file have 0 sheets?_

_-why do I get an exception when trying to read resolution from this jpg?_

_-OK, file looks good, where do I put it?_

Before that, generate a random filename. Yes, random please, you don't want this to be predictable before the full process finishes for several reasons. This is just good old defense in depth. If you need to keep the original filename save it elsewhere as data pointing somehow to the actual disk file.


Now, save it so it is accessed using a dedicated (sandbox) domain (e.g. googleusercontent, fbcdn...). You may need to make URLs unpredictable enough so nobody tries to list arbitrary files, unless you want to sign and validate requests to this alternate origin.

Bonus: run nightly malware scans with updated signatures. If there are too many, at least pick random files to scan.

Finally, serve properly. Instruct the web server to append `X-Content-Type-Options: nosniff`

Return well-known `Content-Type` values. Run away from generic types such as `text/plain`

Use `Content-Disposition: attachment` with apropiate filename values. Or again, if you can afford it, just store and serve from S3.

I think I don't forget anything major. Please complete with anything that I may have missed. Cheers!




