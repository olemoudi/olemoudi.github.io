---
layout: post                          # (require) default post layout
title: "Quirks of Storing Sensitive Data client-side in 2019"                   # (require) a string title
date: 2018-12-18 19:00:02 +0100       # (require) a post date
categories: [crypto, mobile, android, ios, web]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: Broadcast_Mail.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

This content was originally posted as a [Twitter Thread](https://twitter.com/olemoudi/status/1075067288741666817). Copied here for archive purposes. Please, forgive potential typos and the succinct writing style.

---

![secure element](/static/img/secure-element.jpg)

It's almost 2019, most of us have access to modern mobile hardware but aside from platform services such as Apple/Google Pay and Local Authentication (FaceID/Fingerprints) there's still a shortage of sound crypto for handling secrets on the client-side. Here's why:

Don't get me wrong, we have good crypto out there, but it's still hard to effectively leverage the full capabilities of end user hardware, particularly at scale Let's examine the current situation for iOS, Android and Browsers:

iOS has generally the best posture here. It was quite early that they realized developer need to store sensitive data on devices. They came up with Keychain and Secure Enclave, but unfortunately IMHO failed miserably to provide a friendly API. At least they have verbose flags.

Also implementing common use cases such as verification of challenge signature done within the Secure Enclave is not straightfoward. In some cases exported public keys are [not compatible with OpenSSL](https://forums.developer.apple.com/thread/8030)

Apple even refused to document [which specific cipher suite was using](https://blog.trailofbits.com/2016/06/28/start-using-the-secure-enclave-crypto-api/). A real bliss to implement right?

All this led to the proliferation of ["Githubish" boilerplate code](https://github.com/trailofbits/SecureEnclaveCrypto) that it's hard to pick for your products at scale (can I trust the maintainers in the long run?)

You could find some [unexpected quirk way](https://github.com/square/Valet/pull/116) down the road which forced you to send a PR and cross your fingers. But, all in all, iOS looking good thanks to default Keychain data protection structure, which relies on your device passcode.

Handling secrets on Android looks much more bleak in comparison for products at scale. All because of the well-known device fragmentation. First, contrary to what the term "Android Keystore" (AKS) suggests, you cannot actually *store* anything there. You can ask it to generate keys and keep them stored there, but that's it.

Actually, they eventually realized this was a needed feature and recently implemented the feature for [importing your own keys](https://android-developers.googleblog.com/2018/12/new-keystore-features-keep-your-slice.html)

Still not getting an storage for secrets of arbitrary format (such as an API key) though. Lots of [blog posts ](https://medium.com/@ericfu/securely-storing-secrets-in-an-android-application-501f030ae5a3) about a seemingly mundane security feature ensued.

Second, AKS was a mess until Android M arrived. Using it created serious UX problems for disappearing keys after user switched lockscreen credentials or removed them altogether.

You can see [here](https://issuetracker.google.com/issues/37099642) how the bug actually evolved into the form of a UX/GUI issue related to "how do we inform the user that secrets will get wiped?" [Still Open](https://issuetracker.google.com/issues/37099642)

After Android M, keystore was more stable and more feature rich by supporting symmetric key generation which are most useful for protecting custom secrets at rest. Still, you face the problem of fragmentation. Your code needs to gracefully handle different API Levels and OTA updates transitioning through feature availability borders. Too much complexity and moving parts for products at scale.

Developers just ended up ditching the AKS for more mundane solutions that just [derive keys](https://github.com/tozny/java-aes-crypto/blob/master/aes-crypto/src/main/java/com/tozny/crypto/android/AesCbcWithIntegrity.java#L136) from regular providers which are not hardware backed. You pay 800e for a phone with an advanced HSM and apps just derive keys on userland using static device ids as seeds. Great.

Can't blame the guys though. They have enough work trying to dodge [landmines on StackOverflow](https://nelenkov.blogspot.com/2012/04/using-password-based-encryption-on.html) about insecure code snippets

As with iOS, Android has its own share of Githubish solutions to wrap around AKS low level API. They rarely actually use AKS to protect secrets at rest. [This comment](https://github.com/tozny/java-aes-crypto/blob/master/aes-crypto/src/main/java/com/tozny/crypto/android/AesCbcWithIntegrity.java#L136) summarizes it pretty well.

And regarding Browsers, Web Crypto API is your chance to prevent key exposure on userland code (JS), but still needs to keep an eye on legacy user support matrix.

The problem of a lost or stolen device (laptop) persists. Are keys protected in an independent secure environment? (SE, TPM, TEE...) This was left as [implementation-dependent](https://www.w3.org/TR/WebCryptoAPI/#concepts-key-storage)... 

Again, put on the shoes of any developer, why bothering with dealing with this fragmentation mess for an app that operates at scale? Just not worth it.
