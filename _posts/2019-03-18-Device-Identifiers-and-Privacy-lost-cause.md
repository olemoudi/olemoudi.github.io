---
layout: post                          # (require) default post layout
title: "Non-resettable Device Identifiers and Privacy: a lost cause"                   # (require) a string title
date: 2019-03-18 19:00:02 +0100       # (require) a post date
categories: [android, ios, mobile]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: passports.png             # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

![passports](/static/img/passports.png)

Applications typically need to establish a way to detect when the user changes devices or to identify applications that are installed on the same device. Device identifiers serve this purpose by providing a token that usually covers the following requirements:

 - **Universally unique** - there should be enough identifiers available to cover the space of all possible devices
 - **Extremely Low Collision probability** - when generating a device identifier, the chance of generating a duplicate must be negligible
 - **Non predictability** - it should not be possible to predict the identifier of a particular device without device/network access 
 - **Persistence** - Device ID should remain constant throughout device usage flows in a best-effort manner, but always with platform limitations in mind. 

This last point regarding persistence is what this post is about and where the battle is usually fought. Non-resettable Device IDs have always been the Holy Grail to anti-abuse and fraud prevention teams. The ability to detect device re-use (or device freshness for that matter) is a quite potent capability for someone interested in knowing when an unusual event is taking place, potentially a tell for miscreant activities.

Traditional web browsers have been historically hostile to persistent identifiers of any sort. Regular users soon became familiar with Cookies (and with their usual tracking purpose) so attempts to implement non-resettable identifiers on browsers thrived with varying success across years. Initiatives such as [Supercookies](https://mashable.com/2011/09/02/supercookies-internet-privacy/?europe=true#Uz6wOMePmkq7) and [Panopticlick](https://panopticlick.eff.org/) are good examples of smart techniques that aim to uniquely tie devices/hardware to user sessions, but without providing enough reliability for the use case at hand. More recent developments such as the [Evercookie](https://github.com/samyk/evercookie) raise the bar by leveraging multiple techniques simultaneously, but the general consensus is that, beyond mere academic or best-effort techniques, there is no reliable way to tie device/hardware to users with enough confidence to deploy effective security countermeasures around that input.

Enter Mobile Platforms. With the return of native, thick client apps on Android and iOS and the plethora of platform APIs to access hardware parameters and device information, developers quickly realized that it was possible to keep track of the specific hardware your users owned for tracking purposes.

Generally speaking, there are several reasons to avoid using hardware data when generating Device Identifiers:

- Hardware property availability greatly vary across devices with different form factors and capabilities (e.g. Tablets VS Phones) and between OS Versions
- They do not truly guarantee uniqueness nor low collision probability
- Usage of most of them is deprecated or frowned upon by OS vendors (Google and Apple) which are quite adamant about applications not relying on them for device identification purposes. This means that their availability through platform APIs may change in the future.

In 2013 Apple reacted to this once they realized developers were harvesting _Universal Device Identifiers_ for tracking purposes by [banning access to this data](https://www.macrumors.com/2013/03/21/apple-will-no-longer-approve-apps-using-unique-device-identifier-udid-beginning-may-1/) from application code. The absence of iOS APIs to read SIM information (ICCID, MSISDN...) left developers with very little room to gather non-resettable inputs from device hardware. Some nifty tricks based on [Keychain quirks](https://forums.developer.apple.com/message/210531#210531) were used for years but eventually were shot down by Apple. The message was clear: non-resettable identifiers harm user privacy, and Apple is [fairly adamant](https://9to5mac.com/2019/01/05/apple-privacy-billboard-vegas-ces/) about safeguarding that very privilege on behalf of their clients.

Vendor offering of fingerprinting, anti-fraud and user-tracking solutions for iOS claim they can provide non-resettable, persistent hardware identifiers without a sweat. I don't dispute there may still be unofficial/deprecated ways (or even secret sauces) to access low level hardware APIs or particular device quirks that disclose enough information to create somewhat reliable identifiers. However, it remains unclear how this solutions will keep dodging the relentless mission Apple has to safeguard user's privacy (at least caring for that pose) and the progressive hardening of an already intrusive [app review process](https://developer.apple.com/app-store/review/guidelines/). Can you really afford to incorporate these proprietary fingerprinting solutions at scale and risk a future take down from Apple?

On the other end of the mobile spectrum there is Android. Historically an extremely open platform when it comes to accessing all sorts of hardware information. Developers have been able to create non-resettable persistent identifiers of varying degrees. From the rarely changed [Android ID](https://developer.android.com/reference/android/provider/Settings.Secure.html#ANDROID_ID) to true hardware identifiers such as the [IMEI](https://developer.android.com/reference/android/telephony/TelephonyManager.html#getImei(int)). Google was also giving [casual hints](https://developer.android.com/training/articles/user-data-ids.html) about how using these information to track users was a bad idea, but developers kept doing it anyway.

And for a time... it was ok.

It wasn't until very recently with [Android Q](https://developer.android.com/preview/) arrival that Google confirmed the trend of promoting user privacy to first class citizen on Android too. Several privacy enhancing milestones have been reached latest versions of Android over the last couple of years, changing Android ID behaviour, protecting how information gets delivered through broadcasts within the internal app ecosystem and [restricting SMS read permission](https://play.google.com/about/privacy-security-deception/permissions/) for most apps.

The latest milestone is the complete eviction of the ability to read popular hardware identifiers from the SIM card (ICCID, MSISDN, IMEI...) except by device admin applications. This paints a quite similar landscape to iOS for apps that attempt to fingerprint Android device.

It is unclear how this fight will develop in the upcoming years, but something seems clear to me. It looks futile to try to circumvent platform restrictions in pursuit of device binding or identification with userland code. Both Android and iOS provide OS capabilities that help developers detect app lifecycle changes and deploy anti-abuse mechanisms. Attempts at hardware identification is not the correct path, or at least platform vendors are hinting that it is not. And they have the upper hand here.

A good alternative to hardware identifiers is **device binding**. This entails a set of techniques that bind some enrollment data to the device itself, making it extremelly hard to have it migrated to a different device. Some of these techniques include:

- Android: Enrolling non-exportable, [attested keys](https://developer.android.com/training/articles/security-key-attestation.html)
- iOS: [Keychain accessibility constants](https://developer.apple.com/documentation/security/keychain_services/keychain_items/restricting_keychain_item_accessibility) with `ThisDeviceOnly` suffix

Of course you will still have to deal with OS fragmentation, platform quirks, unexpected behavours and corner cases, particularly for applications at scale. Is it really worth it or you can get away to just generating installation IDs? Think carefully.




