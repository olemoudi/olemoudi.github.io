---
layout: post                          # (require) default post layout
title: "Can Facebook read my WhatsApp chats?"                   # (require) a string title
date: 2020-03-23 19:00:02 +0100       # (require) a post date
categories: [privacy, e2ee]          # (custom) some categories, but makesure these categories already exists inside path of `category/`
tags: [foo, bar]                      # (custom) tags only for meta `property="article:tag"`
image: whatsapp.jpg            # (custom) image only for meta `property="og:image"`, save your image # inside path of `static/img/_posts`
---

# Before you read this

This article is a collection of relevant information and reference links to enrich the discussion of whether unauthorized parties can obtain access to WhatsApp messages without user explicit consent.

There are plausible arguments on both sides of the discussion. The article presents them to help the reader take an informed decision about the debate. 

However, be aware that as of today the author's (me) personal opinion remains in line with WhatsApp claims, and this may leak somewhere below. 

This article is divided into the following major sections:

1. [Introduction & Context](#intro)
2. [Understanding End-to-End Encryption (E2EE)](#understanding)
3. [The Trust Factor](#trust)
3. [Context suggesting WhatsApp could be eavesdropped](#badcontext)
3. [Context suggesting WhatsApp messages cannot be read by third parties (not even themselves)](#goodcontext)
3. [Additional Relevant Information on the Security of your Chats](#plus)
3. [Conclusion](#conclusion)

## [Introduction & Context](#intro)

<div style="text-align:center"><img src="/static/img/e2ee/banner.png" /></div>
 
  
  
Much has been written about the privacy tax that companies impose on their users. The infamously overstated _if the product is free, then you are the product_ is frequently raised against the security and privacy of platforms where users share personal information. But are these claims mere uninformed fearmongering which stems from lack of technical knowledge? Do we ignore other facts that point in the opposite direction? Or are they completely justified?

WhatsApp has gotten its fair share of heat in this regard, and it is understandable. Users intensively use this platform to send hundreds of messages each day without paying a single cent for the service. This situation raises some eyebrows and probably suggests that something is amiss with the whole deal. Is Facebook profitting somehow off the memes I send through WhatsApp? 

It is hard to grasp the exact business model behind reading what [1.6 billion users](https://www.messengerpeople.com/global-messenger-usage-statistics/) send to each other. However, given the obvious vantage point it would serve to Law-enforcement agencies or the US Goverment and given Facebook track record on privacy decisions it seems natural to just think users are giving away at least part of their privacy. 

But how much privacy are users giving away?

Let's present some relevant information to help us get a clearer picture.

<a name="understanding"></a>
## [Understanding End-to-End Encryption (E2EE)](#understanding)

<a name="tls"></a>
# [How encrypted communications typically work](#tls)

First, let's see how the most common form of channel encryption works: [**Transport Layer Security or TLS**](https://en.wikipedia.org/wiki/Transport_Layer_Security).

Whenever you connect to your bank, to an ecommerce or, thankfully in 2020, to [almost any site](https://transparencyreport.google.com/https/overview?hl=en) your device establishes an encrypted communication channel to protect the confidentiality of the data you receive or send to that server. Typically, this happens as shown in the following picture. As you can see, potential eavesdroppers that happen to live between you and the server cannot read or modify the exchanged data because they don't have the decryption key.

<div style="text-align:center"><img src="/static/img/e2ee/tls.png" /></div>

If you happen to be sending data to someone else, the server typically needs to act as a man in the middle of that communication. In this situation, eavesdroppers still cannot read or modify the data you send. But here's the catch: **the server can**. Why? because the encrypted TLS channels only happen in the two legs of the trip, but not the middle point. The encryption key agreement in TLS happens twice, first between you and the server and then, between the server and the recipient. This means the server has the two decryption keys for each encrypted TLS connection. 

<div style="text-align:center"><img src="/static/img/e2ee/tls2.png" /></div>

As shown in the picture, this means **the owner of the service can, in theory, read and modify everything that you send**. This does not mean that he should, but the option is there. This is why privacy matters on free services (and even paid ones) become iffy. How do you know the owner is behaving? Often you can't.

Regardless, for particularly sensitive communications **the point might not be who else has the capability to read the messages, but if anyone can at all**. In this sense, regardless of the ethics or business model of the service owner, the opportunity remains available for law enforcement, state agencies and malicious actors alike.

<div style="text-align:center"><img src="/static/img/e2ee/tls3.png" /></div>


<a name="e2ee"></a>
# [Enter End-to-End Encryption](#e2ee)

Alternatively and typically on top of the previously shown TLS scenario, the sender and the recipient can utilize encryption and decryption keys only the two of them agree on in a pairwise fashion. This means no one but them have the ability to encrypt or decrypt messages into or from the channel.

In theory, the first thing they need to do is to reach an agreement on the keys to be used. Ideally this should happen directly between the sender and recipient, without intermediaries, and frequently through some sort of physical interaction.

<div style="text-align:center"><img src="/static/img/e2ee/e2ee.png" /></div>

**In practice, this is rarely done**. Most platforms incorporate security trade-offs in this step where this agreement is by default granted. This initial authentication is granted based on some other known info such as the phone number that is used. WhatsApp in this case, by forcing users to go through a [phone number proof of ownership](https://faq.whatsapp.com/en/kaios/26000179/), implicitly authenticates users.



On top of that, WhatsApp offers the posibility to verify the party with access to an established chat by doing a close contact [QR ceremony](https://faq.whatsapp.com/en/general/28030015). Unless you actually conduct this ceremony with your contacts, you are not actually authenticating users but their phone numbers. 

<div style="text-align:center"><img src="/static/img/e2ee/e2ee2.png" /></div>

Then with this agreement, you can establish a secure end-to-end encrypted channel with the other party in a way that not even the platform owner can read or modify the data. 

<div style="text-align:center"><img src="/static/img/e2ee/e2ee3.png" /></div>

For protocols like the one used by WhatsApp (Signal protocol), the technical side of how this is actually accomplished is [publicly documented and available for review](https://www.whatsapp.com/security/WhatsApp-Security-Whitepaper.pdf). For other protocols, it is not and sometimes puts their security [under scrutiny](https://news.ycombinator.com/item?id=6916860). This of course is overwhelming for most people, so in the end, there's always a component of trust involved. [Information Security Experts](https://twitter.com/tqbf/status/951231270025158657) are here to help you, but again, some positions on the matter may vary.

More on that later.

<a name="other"></a>

# [WhatsApp has E2EE, how about other platforms?](#other)

Once we understand what E2EE means, when choosing a platform to communicate with your contacts, you may want to do an informed decision on which one actually provides you with this sort of protection.

With dozens of instant-messaging platforms sprouting every year, it can be pointless to present a comprehensive list. The [network-effect](https://en.wikipedia.org/wiki/Network_effect) predates smaller ones and dictates which ones you will most probably end-up using. Because of this it is important to at least understand the posture of the most popular ones.

**Information about the availablity of E2EE on a platform should be easy to find**. It makes sense for the provider to advertise this implementation as much as possible but **it is also important to understand potential loopholes or misleading statements**.

For the case at hand, [WhatsApp advertises their implementation of E2EE](https://faq.whatsapp.com/en/general/28030015/?category=5245250) based on the Signal Protocol by Open Whisper Systems, which is the de-facto standard and [industry acclaimed](http://previous-recipients.levchinprize.com/2/) baseline for E2EE. WhatsApp also [points out](https://faq.whatsapp.com/en/android/28030015/) that E2EE is implemented by default and it is not possible to disable it. 

On the other hand, some platforms such as [Telegram](https://telegram.org/) offer E2EE as a opt-in feature. You need to explicitly enable it by creating what they call a [secret-chat](https://telegram.org/faq#secret-chats). This lack of enforcement by default raises some criticism from the security industry. The less choices you leave to the final user, the easier they will end up making the appropiate choice on each case.

There's also the previously mentioned point of whether the E2EE implementation is available for public review. Telegram's MTProto has had it's fair share of heat in this regard. And you will find sides defending opposing realities [[1](https://eprint.iacr.org/2015/1177.pdf)][[2](https://core.telegram.org/mtproto)]. 

> *If guys with a PhD IN CRYPO don’t even know what your crypto protocols are defending against, that’s a bad sign. Telegram might not be broken, but it might not be secure either. These statements are equally true… and that is exactly why you should not use it. No one has a clue why it does what it does*
> 
> [COMSEC Beyond Encryption, 2014](https://grugq.github.io/presentations/COMSEC%20beyond%20encryption.pdf)

And then the case of dubious marketing. For example [Zoom was caught recently](https://theintercept.com/2020/03/31/zoom-meeting-encryption/) claiming that their meetings were end-to-end encrypted when in fact they only provide server-to-client encryption. You can follow the discussion that ensued in the [HackerNews thread](https://news.ycombinator.com/item?id=22735746).

<a name="otherbad"></a>

# [Which platforms are not end-to-end encrypted?](#otherbad)

Short answer: most.

E2EE is the new kid on the block. Its availability on some of the most popular platforms used today should not make us forget that we have been sending data to our contacts for decades without E2EE. 

Among all the ways used to send data without E2EE, email remains the most misunderstood channel security-wise. **Email was not built for sending secrets**. It will never be. There's a general industry consensus that modern E2EE protocols were invented for a reason, so we should not try to modify existing ancient protocols trying to step up their security game artificially. [Email is unsafe and cannot be made safe](https://latacora.micro.blog/2020/02/19/stop-using-encrypted.html).

In absence of any information, you should assume that the data you send over the internet is done merely under the TLS model we saw earlier. You now should be able to understand which threats this model protects against and which ones prevail. You should remain sensitive to this fact.

<a name="trust"></a>

## [The Trust Factor](#trust)

Earlier in the article, we introduced the trust factor that affects the choice of platforms to communicate. [Ben Nagy](https://twitter.com/rantyben) was very eloquent years ago when he wrote about the implications of *[outsourcing understanding](https://lists.immunityinc.com/pipermail/dailydave/2013-September/000450.html)*.

> *If you happen to actually BE a person of interest, however, "better than nothing" is actually worse than nothing. If you had zero crypto, you might actually think about the content and traffic / timing patterns of your comms. If you had no 'anonymisation' then you might actually give a shit when and from where you connect. [...] if you don't have a strong mental picture of these things BEFORE you start deploying tools and being all crypto-ninja-slash-stealth-sexy-leopard, then you're going to see exactly what that worst case outcome looks like from the inside.*

It is not reasonable to assume that you will achieve complete certainty about the confidentiality of your data when using third party platforms. In the end, you will have to trust someone's claims about the security of each particular platform. There's another recent take on this by [TheGrugq](https://twitter.com/thegrugq)

> *The school of thought that holds that all communication failures are the fault of developers for not making things SO usable and pervasive that “average users” cannot ever get things wrong is stupid. **It outsources understanding to the developers of those “usable systems” which also outsources trust - but those devs won’t be going to be going to jail for you***
>
> [COMSEC Beyond Encryption](https://grugq.github.io/presentations/COMSEC%20beyond%20encryption.pdf)

<a name="badcontext"></a>

## [Context suggesting WhatsApp could be eavesdropped](#badcontext)

Ever since WhatsApp was acquired by Facebook, their trustworthiness has been put under scrutiny. This is mainly because Facebook, first of all, has an horrendous reputation among users (and people in general whether they use the platform or not) in terms of plausible monetization of private data.

On top of that, their track record does not help building trust on a platform fully owned by the company, as it is the case with WhatsApp. Let's examine some of them, quoting some of the statements that were presented by different news sources.

<a name="sample"></a>

# [A sample of past privacy related Facebook incidents](#sample)

This is a by-no-means-comprehensive sample of recent news of concern from a privacy perspective. Despite WhatsApp has not suffered any major privacy incident yet, these may however help showcase examples of foreseeable incidents.

#### Facebook has been paying people to install a “Research” VPN

> *Desperate for data on its competitors, Facebook  has been secretly paying people to install a “Facebook Research” VPN that **lets the company suck in all of a user’s phone and web activity**, similar to Facebook’s Onavo Protect app that Apple banned in June and that was removed in August.*
> 
>  [Techcrunch 2019](https://techcrunch.com/2019/01/29/facebook-project-atlas/)

#### Facebook Is Giving Advertisers Access to Your Shadow Contact Information

> *Facebook is not content to use the contact information you willingly put into your Facebook profile for advertising. It is also **using contact information you handed over for security purposes and contact information you didn’t hand over at all**, but that was collected from other people’s contact books, a hidden layer of details Facebook has about you that I’ve come to call “shadow contact information.”*
>
> [Gizmodo 2018](https://gizmodo.com/facebook-is-giving-advertisers-access-to-your-shadow-co-1828476051)


#### Ever Record a Video on Facebook? Facebook Still Has It.

> *Facebook’s current data policy says that the company can “collect the content and other information you provide when you use our Services, including when you sign up for an account, create or share, and message or communicate with others.” “Create” is the operative word in there. By that logic, **Facebook technically could save any video a user filmed but did not publish** because you created it on the platform.* 
> 
> [NYMag 2018](https://nymag.com/intelligencer/2018/03/facebook-secretly-saved-videos-users-deleted.html)


#### Cambridge Analytica data scandal

> *The Facebook–Cambridge Analytica data scandal was a major scandal in early 2018 where **Cambridge Analytica harvested the personal data of millions of people's Facebook profiles without their consent** and used it for political advertising. It has been described as a watershed moment in the public understanding of personal data and precipitated a huge fall in Facebook's stock price and calls for tighter regulation of tech companies' use of personal data.*
> 
> [Wikipedia 2020](https://en.wikipedia.org/wiki/Facebook%E2%80%93Cambridge_Analytica_data_scandal)

<a name="suggest"></a>

# [What does the previous sample suggest?](#suggest)

Facebook does indeed need to somehow monetize their userbase. Platform advertising seems the most straighforward source of income for them but things are more complicated than that. Seems plausible to assume quirks in EULA agreements, metadata profiling or just borderline harvesting of private data through legal loopholes will continue in the future for them to continue being profitable. In the end, users cannot find any statement saying that data shared in the platform will remain private under **all** circumstances.

Does this mean they have today (or want to have in the future) access to the messages you send through WhatsApp? Not necessarily, and facts explicitly pointing in that direction have not been made evident as of yet.

<a name="badle"></a>

# [Relationship with Law Enforcement](#badle)

Besides that, Facebook does publish [guidelines for Law Enforcement Authorities](https://www.facebook.com/safety/groups/law/guidelines/), clearly showing that potentially all of your data will be made available to them upon a valid subpoena. If you remember what we saw earlier about channels without E2EE, this basically means that data is available also potentially to State Actors or malicious parties that happen to compromise the Facebook Platform.

<div style="text-align:center"><img src="/static/img/e2ee/tls3.png" /></div>

Straight from the guidelines:

>*A search warrant issued under the procedures described in the Federal Rules of Criminal Procedure or equivalent state warrant procedures upon a showing of probable cause is required to compel the **disclosure of the stored contents of any account, which may include messages, photos, videos, timeline posts, and location information***

This applies to Facebook platform, not necessarily to WhatsApp. In fact, as you will see later in this article, these guidelines are not inherited by WhatsApp. But since in this section we are identifying potential indicators of welcoming relationships with Law Enforcement, it may be relevant to know Facebook official position in that regard.

<a name="clumsy"></a>

# [Plain Clumsyness](#clumsy)

Ok so just because WhatsApp is owned by Facebook, which seems to be a company with certain tendency to gravitate towards private data in order to maintain business, it does not mean that they will not honor the rules of end-to-end encryption. Maybe they really want to maintain privacy and confidentiality of WhatsApp messages.

But also there is the possibility that they are just making mistakes. 

Exhibit A:

#### Facebook Stored Hundreds of Millions of User Passwords in Plain Text for Years 
>*The Facebook source said the investigation so far indicates between 200 million and 600 million Facebook users may have had their account passwords stored in plain text and searchable by more than 20,000 Facebook employees. The source said Facebook is still trying to determine how many passwords were exposed and for how long, but so far the inquiry has uncovered archives with plain text user passwords dating back to 2012.*
>
> [Krebs on Security 2019](https://krebsonsecurity.com/2019/03/facebook-stored-hundreds-of-millions-of-user-passwords-in-plain-text-for-years/)

On top of that, unfortunately even if no failures or bugs were found on WhatsApp, this does not guarantee that some leak is yet to be discovered.   Quoting [a whitepaper on the matter](https://www.microsoft.com/en-us/research/wp-content/uploads/2015/09/unfalsifiabilityOfSecurityClaims.pdf) from Microsoft:

>*There is an inherent asymmetry in computer security: things can be declared insecure by observation, but not the reverse. **There is no observation that allows us to declare an arbitrary system or technique secure**.*

And this happens to be true even for companies that take pride on respect for the privacy of their users

<div style="text-align:center"><img src="/static/img/e2ee/apple.png" /></div>

[The Verge 2019](https://www.theverge.com/2019/1/28/18201383/apple-facetime-bug-iphone-eavesdrop-listen-in-remote-call-security-issue)


<a name="goodcontext"></a>

## [Context suggesting WhatsApp messages cannot be read by third parties (not even themselves)](#goodcontext)

So yeah, based on what we just saw and in absence of any other indicators, it could seem reasonable to just tilt the judgement on the safe side and just assume that everything you send through WhatsApp can indeed be read at some point by a man in the middle.

However, there are also **strong arguments that point in the opposite direction**. Let's examine some of the most prominent ones.

<a name="goodle"></a>

# [WhatsApp Law Enforcement Guidelines](#goodle)

As we saw earlier, Facebook does include in their [guidelines for Law Enforcement Authorities](https://www.facebook.com/safety/groups/law/guidelines/) a statement that talks about disclosing private data under certain conditions. However, [WhatsApp offer its own version of the guidelines](https://faq.whatsapp.com/en/general/26000050) where the statement is a bit different.

> *A court order issued under 18 U.S.C. Section 2703(d) is required to compel the disclosure of certain records or other information pertaining to the account, **not including contents of communications**, which may include numbers blocking or blocked by the user, in addition to the basic subscriber records identified above*.

This is fundamentally different, since they explicitly state that a court order will not grant access to the contents of communications. They go even further with this other statement:

> *A search warrant issued under the procedures described in the Federal Rules of Criminal Procedure or equivalent state warrant procedures upon a showing of probable cause is required to compel the disclosure of the stored contents of any account, which may include "about" information, profile photos, group information and address book, if available. In the ordinary course of providing our service, **WhatsApp does not store messages once they are delivered or transaction logs of such delivered messages, and undelivered messages are deleted from our servers after 30 days. WhatsApp offers end-to-end encryption for our services, which is always activated***.

One could argue these are outright lies, but there are indeed cases where Law Enforcement inability to access WhatsApp messages has been made evident in the way [some investigations have unfolded](https://translate.google.com/translate?sl=es&tl=en&u=https%3A%2F%2Fwww.movilzona.es%2F2016%2F10%2F25%2Fwhatsapp-se-niega-a-dar-ultimos-mensajes-que-leyo-diana-quer%2F) (Google translated). 

<a name="nobackdoors"></a>

# [Publicly advertised no backdoors policy](#nobackdoors)

WhatsApp staff have no trouble ocasionally engaging in online boards discussing news that suggest they maybe lying in their terms or that maybe there's a state agency backdoor somewhere. Here's the latest take of [Will Carthcart](https://www.linkedin.com/in/will-cathcart-9bb6605/), Head of WhatsApp, on [some news](https://www.bloomberg.com/news/articles/2019-09-28/facebook-whatsapp-will-have-to-share-messages-with-u-k-police) about potential sharing of message data to UK authorities:

> *We were surprised to read this story and are not aware of discussions that would force us to change our product. **We believe people have a fundamental right to have private conversations. End-to-end encryption protects that right for over a billion people every day***.
>
>***We will always oppose government attempts to build backdoors** because they would weaken the security of everyone who uses WhatsApp including governments themselves. In times like these we must stand up both for the security and the privacy of our users everywhere. We will continue do so.*
[Will Carthcart on HackerNews, 2019](https://news.ycombinator.com/item?id=21102696)

<a name="moxie"></a>

# [Competitors publicly vowing for WhatsApp E2EE](#moxie)

Moxie Marlinspike co-runs the instant messaging platform known as Signal, [frequently mentioned](https://theintercept.com/2016/06/22/battle-of-the-secure-messaging-apps-how-signal-beats-whatsapp/) as the beacon of privacy and security for the industry. He was the creator of the Signal-protocol which lies at the heart of WhatsApp as their base implementation of E2EE.

In 2017 The Guardian featured a story where it claimed that WhastApp contained a backdoor enabling authorities to access to end-to-end encrypted comms. An actual misunderstanding of some quirk of the platform was quickly twisted into a backdoor story. 

We will examine this exact issue [later in the article](#limbo), but regading potential backdoors, heres what Moxie himself said:

>  *We believe that WhatsApp remains a great choice for users concerned with the privacy of their message content.*
[Moxie Marlinspike at Signal Blog, 2017](https://signal.org/blog/there-is-no-whatsapp-backdoor/)


<a name="core"></a>

# [When privacy is core business: The San Bernardino Case](#core)

At this point it is undeniable that WhatsApp takes pride in the measures they have deployed to protect the privacy of your messages. The quest for earning respect and trust from your users is a long journey, in which you only need to mess things up once to lose all your progress.

When the privacy of your users becomes one of the core values of your business, things can get complicated after the [Four Horsemen of the Information Apocalypse](https://www.schneier.com/blog/archives/2019/12/scaring_people_.html) knock on your door. 

The San Bernardino case was the first time company core values, and platform privacy were put before state abilities to fight the horsemen.

> *In 2015 and 2016, **Apple Inc. received and objected to or challenged at least 11 orders** issued by United States district courts under the All Writs Act of 1789. Most of these seek to compel Apple "to use its existing capabilities to extract data like contacts, photos and calls from locked iPhones running on operating systems iOS 7 and older" **in order to assist in criminal investigations and prosecutions**. A few requests, however, involve phones with more extensive security protections, which Apple has no current ability to break. These orders would compel Apple to write new software that would let the government bypass these devices' security and unlock the phones.*
>
> [FBI–Apple encryption dispute, Wikipedia 2020](https://en.wikipedia.org/wiki/FBI%E2%80%93Apple_encryption_dispute)

This constitutes an actual case of a company defending the privacy of their users and the trust they built over time. It may be possible that this trend of incorporating E2EE and subpoena-proof platforms has the hidden advantage of giving companies the opportunity to shrug and dodge blame when a case such as the San Bernardino one comes up.

**By completely removing your ability to help Law Enforcement requests over user data (both technically and legally) you have mostly dodged any potential pressures from authorities to introduce backdoors on your platform**.

<a name="plus"></a>

## [Additional Relevant Information on the Security of your Chats](#plus)

Beyond mere E2EE technical or legal topics, there are other aspects to understand in order to get the full picture of what could affect the privacy of the WhatsApp platform.

<a name="bugs"></a>

# [Bugs on client software](#bugs)

**E2EE is completely vulnerable of misbehaving clients**. That is, any code on the devices that establish the E2EE communication ultimately has access to all the data you send and receive. Because of this, your data is still vulnerable to physical device compromise, proximity attacks or just rare bugs like this one from 2019.

#### Bug lets snoopers put spyware on your phone with just a call

> *WhatsApp has disclosed a serious vulnerability in the messaging app that gives snoops a way to remotely inject Israeli spyware on iPhone and Android devices simply by calling the target.*
>
> [ZDNet 2019](https://www.zdnet.com/article/update-whatsapp-now-bug-lets-snoopers-put-spyware-on-your-phone-with-just-a-call/)


<a name="backups"></a>

# [WhatsApp Backups](#backups)

Since WhatsApp does not store your messages, users are encouraged to use external cloud storage services to save chat copies, namely, [Google Drive](https://faq.whatsapp.com/en/android/28000019/) and [iCloud](https://faq.whatsapp.com/en/iphone/26000285).

It goes without saying that those services open up another way for third parties to potentially get access to your messages. Analysis of each cloud storage option would call for an article such as this one by themselves.

<a name="metadata"></a>

# [The Metadata is the actual Message](#metadata)

When using WhatsApp consider that the platform (and thus potentially Facebook) have access to all the metadata that you generate.

We refer to metadata as the information that you generate when using a service like WhatsApp that essentially is eveything but the actual message contents. This *at least* includes:

* Contact information
* Who you contact
* When you contact them
* Frequency of messages
* Size of messages
* When and how you interact with the app

This data alone could be enough to cause huge impact on the privacy of most people. **If you consider the amount of enriched information that you can extract from metadata only, you would reconsider if access to the actual contents of messages is really necessary to profile people in a way that clearly has a toll on their privacy**.

<a name="limbo"></a>

# [Automatic Message retransmission](#limbo)

[Moxie's post](https://signal.org/blog/there-is-no-whatsapp-backdoor/) defending the absence of backdoors in WhatsApp was motivated by people getting acquainted with some quirk in WhatsApp platform that is relevant to the discussion.

In essence, WhatsApp servers keep a copy of the encrypted messages that you send but which are not yet delivered (e.g. because the recipient's phone is off). Whenever the recipient is available for delivery again, there is a possibility that his key might have changed (e.g. he switched his account to a different device). In this corner case only, WhatsApp reaches out the sender (you) and asks your local WhatsApp Mobile Client to grab the original message, reencrypt it with the new keys and send it again.

**The key point is that this happens without your consent**. This opens up the possibility of someone (e.g. Law Enforcement) to exploit this scenario and obtain copies of the messages that are still in WhatsApp servers waiting for delivery. They just need to overcome the phone verification process for the recipients number, something that is perfectly within reach for Law Enforcement (e.g. just ask the carrier for [a new SIM](https://en.wikipedia.org/wiki/SIM_swap_scam)).

Why? Well, as [Moxie](https://signal.org/blog/there-is-no-whatsapp-backdoor/) puts it:

> *When a contact’s key changes, should WhatsApp require the user to manually verify the new key before continuing, or should WhatsApp display an advisory notification and continue without blocking the user. Given the size and scope of WhatsApp’s user base, we feel that their choice to display a non-blocking notification is appropriate.*

Other less prominent but equally right voices were raised against claims that this could be considered a backdoor:

#### In Response to Guardian’s Irresponsible Reporting on WhatsApp: A Plea for Responsible and Contextualized Reporting on User Security

> *The behavior described in your article is not a backdoor in WhatsApp. This is the overwhelming consensus of the cryptography and security community. It is also the collective opinion of the cryptography professionals whose names appear below. **The behavior you highlight is a measured tradeoff that poses a remote threat  in return for real benefits that help keep users secure**, as we will discuss in a moment.*
>
> [Technosociology post, 2018](http://technosociology.org/?page_id=1687)

<a name="abuse"></a>

# [E2EE, Content moderation and Abuse](#abuse)

E2EE is great but there's another catch: if service providers cannot look at what you send or receive... how are they supposed to fight abuse?

#### Modern anti-spam and E2E crypto

> _The first problem we have in the E2E context is that reputation databases
require input from **all** mail. We can imagine an email client that knows
how to decrypt a message, performs feature extraction and then uploads a
"good mail" or "bad mail" report to some handwave central facility. But
then that central facility is going to learn not only who you are talking
with but also what links are in the mail. That's probably quite valuable
information to have. As you add features this problem gets worse._
>
> [Modern anti-spam and E2E crypto](https://moderncrypto.org/mail-archive/messaging/2014/000780.html)

Safety and Privacy often are traded-off. Another take on this:

<blockquote class="twitter-tweet"><p lang="en" dir="ltr">There are product design techniques that can reduce abuse without collecting data, but in a situation where you are dealing with intelligent adversaries, preventing abuse will generally require some reduction of privacy and user choice.</p>&mdash; Alex Stamos (@alexstamos) <a href="https://twitter.com/alexstamos/status/1115628846424838144?ref_src=twsrc%5Etfw">April 9, 2019</a></blockquote> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

<a name="conclusion"></a>

## [Conclusion](#conclusion)

This article presents a collection of relevant information that may help you decide for yourself how probable is that the messages that you send through WhatsApp can be read at some point by unauthorized parties.

I tried to present it as objectively as possible but my opinion probable leaked at some point. I do believe that WhatsApp is honest when they say their implementation of E2EE thwarts any potential old-fashioned eavesdropping. So most users are probably ok using it.

Regarding the value of metadata... thats a whole different story.

Oh, also, you may want to check out [Thaddeus t. Grugq guide to operational WhatsApp](https://medium.com/@thegrugq/operational-whatsapp-on-ios-ce9a4231a034). It's great.

Peace
 
   
  *Icons from pictures made by Turkkub, dinosoftlabs, vectors market, freepik and prettycons from [www.flaticon.com](https://www.flaticon.com)*

  *Header photo by Rachit Tank ([www.unsplash.com](https://unsplash.com/photos/lZBs-lD9LPQ))*




