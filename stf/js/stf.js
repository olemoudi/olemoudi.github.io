/*

Skip Tracing Framework

http://makensi.es/stf/

Comments/Suggestions: @olemoudi


*/

var lastupdated = '31/08/2012'


var inputs = [
	{
		"code" : "domain",
		"name" : "Domain name",
		"desc" : "Gather info about a Domain such as <i>google.com</i> :"
	},
	{
		"code" : "ip",
		"name" : "IP Address/Range",
		"desc" : "Available information about IP addresses or network ranges:"
	},
	{
		"code" : "company",
		"name" : "Company name",
		"desc" : "Search info about a certain company:"
	},	
	{
		"code" : "website",
		"name" : "Website",
		"desc" : "Information about a certain website:"
	},	
	{
		"code" : "name",
		"name" : "Name",
		"desc" : "Full name, surname search tools:"
	},
	{
		"code" : "email",
		"name" : "Email address",
		"desc" : "Gather info about email addresses:"
	},
	{
		"code" : "phone",
		"name" : "Phone number",
		"desc" : "Phone numbers information listings:"
	},
	{
		"code" : "nick",
		"name" : "Nick or ID",
		"desc" : "Search by nickname or moniker:"
	},
	{
		"code" : "hostname",
		"name" : "Hostname",
		"desc" : "Search info about machines by their FQDN or hostname:"
	},
	{
		"code" : "password",
		"name" : "Password/Hash",
		"desc" : "Search info about passwords and hashes:"
	},
	{
		"code" : "image",
		"name" : "Image",
		"desc" : "Search info about images:"
	},			
	{
		"code" : "url",
		"name" : "URL",
		"desc" : "Info about URLs:"
	},
	{
		"code" : "zone",
		"name" : "Regional/Country specific",
		"desc" : "Regional or country specific tools :"
	},	
	{
		"code" : "other",
		"name" : "Other data",
		"desc" : "Tools general searches"
	}						
];
	

/* 
	"transformname" : 
	{
		"name" : "",
		"desc" : "",
		"inputs": 
		[
			"",
			""
		],
		"url" : [""],
		"rating" : 5		
	},
*/


var transforms = [
//////////////////////////////////////////////////
	{
		"code" : "whois",
		"name" : "Whois",
		"desc" : "Whois protocol databases",
		"inputs": 
		[
			"domain",
			"ip",
			"as",
			"website"
		],
		"urls" : 
		[
			{
				"tag" : "Domain Tools",
				"url" :	"http://www.domaintools.com",
				"rating" : 9
			},
			{
				"tag" : "Whois Archive Volumes",
				"url" :	"http://www.itistimed.com/whois-archive/whois-db-001.php",
				"rating" : 6
			},
            {
				"tag" : "Whois Archive Volumes (alt mirror)",
				"url" :	"http://www.pitzilica.ro/whois-archive/whois-db-001.php",
				"rating" : 0
			},
			{
				"tag" : "DNSStuff",
				"url" :	"http://www.dnsstuff.com",
				"rating" : 7
			},			
			{
				"tag" : "CentralOps",
				"url" :	"http://centralops.net/co/",
				"rating" : 6
			},	
			{
				"tag" : "Fixed Orbit",
				"url" :	"http://www.fixedorbit.com/search.htm",
				"rating" : 6
			},	
			{
				"tag" : "IP Tools",
				"url" :	"http://www.iptools.com/	",
				"rating" : 6
			},
			{
				"tag" : "Robtex Tools",
				"url" :	"http://www.robtex.com/",
				"rating" : 7
			}									
							
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "geoloc",
		"name" : "Geolocalization",
		"desc" : "Geolocalization tools",
		"inputs": 
		[
			"ip"
		],
		"urls" : 
		[
			{
				"tag" : "IP2Location",
				"url" :	"http://www.ip2location.com",
				"rating" : 4
			},
			{
				"tag" : "Geo IP Tool",
				"url" :	"http://geoiptool.com",
				"rating" : 6
			},
			{
				"tag" : "Tejji geoip",
				"url" :	"http://tejji.com/ip/",
				"rating" : 5
			},
			{
				"tag" : "MaxMind GeoIP demo",
				"url" :	"http://www.maxmind.com/app/locate_demo_ip",
				"rating" : 6
			},
			{
				"tag" : "IP Tools",
				"url" :	"http://www.iptools.com/	",
				"rating" : 5
			}			
						
		],
		"rating" : 5		
	},	
//////////////////////////////////////////////////
	{
		"code" : "asadmin",
		"name" : "AS Information",
		"desc" : "Autonomous System information",
		"inputs": 
		[
			"ip",
            "as"
		],
		"urls" : 
		[
			{
				"tag" : "Get AS admin emails",
				"url" :	"http://www.google.com/safebrowsing/alerts/",
				"rating" : 7
			}
						
		],
		"rating" : 5		
	},	
//////////////////////////////////////////////////
	{
		"code" : "dnschecks",
		"name" : "DNS Tests",
		"desc" : "DNS information and health checks:",
		"inputs": 
		[
			"domain",
			"hostname",
			"email"
		],
		"urls" : 
		[
			{
				"tag" : "Passive DNS Replication",
				"url" :	"http://www.bfk.de/bfk_dnslogger.html?",
				"rating" : 3
			},	
			{
				"tag" : "MX Blacklist tests",
				"url" :	"http://www.mxtoolbox.com",
				"rating" : 7
			},	
			{
				"tag" : "Health and configuration for DNS",
				"url" :	"http://www.intodns.com",
				"rating" : 8
			},
			{
				"tag" : "DNS checks",
				"url" :	"http://www.dnssy.com/",
				"rating" : 7
			}						
		
						
		],
		"rating" : 5		
	},		
//////////////////////////////////////////////////
	{
		"code" : "icann",
		"name" : "Authoritative Bodies",
		"desc" : "Internet authoritative bodies",
		"inputs": 
		[
			"domain",
			"ip",
			"as"
		],
		"urls" : 
		[
			{
				"tag" : "IANA",
				"url" :	"http://www.iana.com/",
				"rating" : 1
			},
			{
				"tag" : "ICANN",
				"url" :	"http://www.icann.org",
				"rating" : 1
			},	
			{
				"tag" : "Number Resource Organization",
				"url" :	"http://www.nro.net",
				"rating" : 1
			},	
		],
		"rating" : 1		
	},	

//////////////////////////////////////////////////
	{
		"code" : "rwhois",
		"name" : "Referral Whois",
		"desc" : "Referral Whois extension of the original protocol",
		"inputs": 
		[
			"domain",
			"ip",
			"as",
			"website"
		],
		"urls" : 
		[
			{
				"tag" : "Arin RWhois",
				"url" :	"http://projects.arin.net/rwhois/prwhois.html",
				"rating" : 1
			},
			{
				"tag" : "Los Nettos",
				"url" :	"http://rwhois.ln.net/",
				"rating" : 1
			},			
		],
		"rating" : 3		
	},	
//////////////////////////////////////////////////
	{
		"code" : "korea",
		"name" : "Korea",
		"desc" : "Specific korean tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Nate",
				"url" :	"http://www.nate.com",
				"rating" : 1
			}									
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "china",
		"name" : "China",
		"desc" : "Specific chinese tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Baidu search engine",
				"url" :	"http://www.baidu.com/",
				"rating" : 7
			}									
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "japan",
		"name" : "Japan",
		"desc" : "Specific japanese tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Mixi Social Network",
				"url" :	"http://mixi.jp/",
				"rating" : 7
			}									
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "espana",
		"name" : "Spain",
		"desc" : "Specific spanish tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Consulta de datos catastrales de un inmueble",
				"url" :	"https://www1.sedecatastro.gob.es/OVCFrames.aspx?TIPO=CONSULTA",
				"rating" : 4
			},
			{
				"tag" : "Listas de boda ECI",
				"url" :	"https://www.elcorteingles.es/listasdeboda_ssl/invitados/celebrantes_acceso.asp?promo=01",
				"rating" : 5
			},
			{
				"tag" : "Get Mobile Carrier for a phone number",
				"url" :	"http://www.cmt.es/estado-portabilidad-movil",
				"rating" : 10
			},
			{
				"tag" : ".es domains",
				"url" :	"http://www.nic.es",
				"rating" : 2
			},
			{
				"tag" : "Tuenti Social Network",
				"url" :	"http://www.tuenti.com",
				"rating" : 6
			}									
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "netherlands",
		"name" : "Netherlands",
		"desc" : "Specific tools for Netherlands:",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Hyves Social Network",
				"url" :	"http://www.hyves.nl/",
				"rating" : 6
			}					
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "hungary",
		"name" : "Hungary",
		"desc" : "Specific tools for Hungary:",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "iWiW",
				"url" :	"http://www.iwiw.hu/",
				"rating" : 5
			}					
		],
		"rating" : 6		
	},
//////////////////////////////////////////////////
	{
		"code" : "uk",
		"name" : "UK",
		"desc" : "Specific UK tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "People, Businesses & places (UK only)",
				"url" :	"http://www.192.com/",
				"rating" : 6
			},
			{
				"tag" : "Yasni people search",
				"url" :	"http://www.yasni.co.uk/",
				"rating" : 4
			}			
							
		],
		"rating" : 6		
	},			
//////////////////////////////////////////////////
	{
		"code" : "usa",
		"name" : "USA",
		"desc" : "Specific USA tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "411",
				"url" :	"http://www.411.com",
				"rating" : 8
			},	
			{
				"tag" : "ZabaSearch",
				"url" :	"http://www.zabasearch.com/	",
				"rating" : 5
			},					
			{
				"tag" : "Web Investigator (people or phone)",
				"url" :	"http://www.webinvestigator.org",
				"rating" : 7
			},
							{
				"tag" : "EDGAR - Company information, including real-time filings.",
				"url" :	"http://www.sec.gov/edgar/searchedgar/companysearch.html",
				"rating" : 7
			}			
		],
		"rating" : 6		
	},	
//////////////////////////////////////////////////
	{
		"code" : "africa",
		"name" : "Africa",
		"desc" : "Africa related tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Africa Network Information Center",
				"url" :	"http://www.afrinic.net/",
				"rating" : 1
			},	
			{
				"tag" : "BlackPlanet Social Network",
				"url" :	"http://www.blackplanet.com",
				"rating" : 5
			},								
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "asiaoceania",
		"name" : "Asia & Oceania",
		"desc" : "Asia and Oceania related tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Asia Pacific Network Information Centre",
				"url" :	"http://wq.apnic.net/apnic-bin/whois.pl/",
				"rating" : 1
			},						
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "northamerica",
		"name" : "North America",
		"desc" : "North America related tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "American Registry for Internet Numbers",
				"url" :	"http://whois.arin.net/ui",
				"rating" : 1
			},						
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "latinamerica",
		"name" : "Latin America",
		"desc" : "Latin America related tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Latin America and Caribbean Network Information Centre",
				"url" :	"http://www.lacnic.net",
				"rating" : 1
			},						
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "europamiddleeast",
		"name" : "Europe & Middle East",
		"desc" : "Europe and Middle East related tools",
		"inputs": 
		[
			"zone"
		],
		"urls" : 
		[
			{
				"tag" : "Reseaux IP Européens—Network Coordination Centre (RIPE)",
				"url" :	"http://www.ripe.net/",
				"rating" : 1
			},						
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "exposed",
		"name" : "Public Vulnerabilities",
		"desc" : "Search for public vulnerabilities and data disclosures:",
		"inputs": 
		[
			"domain",
			"hostname",
			"company",
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Zone-H - Unrestricted Information",
				"url" :	"http://www.zone-h.org/",
				"rating" : 4
			},
			{
				"tag" : "US-Cert Vulnerability Notes Database",
				"url" :	"http://www.kb.cert.org/vuls",
				"rating" : 5.5
			},
			{
				"tag" : "Online SQLi scanner",
				"url" :	"http://wolfscps.com/gscanner.php",
				"rating" : 3
			},
			{
				"tag" : "XSS Attacks information archive",
				"url" :	"http://www.xssed.com/",
				"rating" : 5
			},							
			{
				"tag" : "sla.ckers.org web application security forum",
				"url" :	"http://sla.ckers.org/forum/",
				"rating" : 2
			},
			{
				"tag" : "Exploit Database",
				"url" :	"http://www.exploit-db.com/",
				"rating" : 3
			},	
			{
				"tag" : "Owned & Exploiting Bot (search archive using Social Media SE)",
				"url" :	"http://www.twitter.com/ownedexploiting",
				"rating" : 1
			}																											
		],
		"rating" : 1		
	},	
//////////////////////////////////////////////////
	{
		"code" : "specialse",
		"name" : "Specialized SE",
		"desc" : "Specialized search engines, discretionary use:",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Reverse Google Analytics search",
				"url" :	"http://www.ewhois.com/analytics-id/UA-7503551/",
				"rating" : 7
			},
			{
				"tag" : "Reverse Google Analytics search (alt)",
				"url" :	"http://www.websitelooker.com/analytics/UA-7503551",
				"rating" : 7
			},
			{
				"tag" : "Gogloom - Chat room search engine",
				"url" :	"http://www.gogloom.com/",
				"rating" : 7
			},
			{
				"tag" : "OSINT Reuser - Search engine compilation (TONS of links)",
				"url" :	"http://rr.reuser.biz/",
				"rating" : 10
			},
			{
				"tag" : "FTP search engines",
				"url" :	"http://www.ftpsearchengines.com/",
				"rating" : 6
			},
			{
				"tag" : "Hakia - Semantic web search",
				"url" :	"http://hakia.com",
				"rating" : 6
			},
			{
				"tag" : "Wolfram Alpha - Computational Knowledge Engine",
				"url" :	"http://www.wolframalpha.com/",
				"rating" : 3
			},
			{
				"tag" : "Big Boards - Forum search",
				"url" :	"http://www.big-boards.com/",
				"rating" : 4
			},
			{
				"tag" : "Open Site Explorer - search engine for links",
				"url" :	"http://www.opensiteexplorer.org",
				"rating" : 7
			},
	
			{
				"tag" : "Search IRC",
				"url" :	"http://searchirc.com/",
				"rating" : 7
			},							
			{
				"tag" : "XDCC Search engine",
				"url" :	"http://www.xdccreport.com",
				"rating" : 5
			},				
			{
				"tag" : "Search engine for Error codes and messages.",
				"url" :	"http://www.errorkey.com/",
				"rating" : 10
			},		
			{
				"tag" : "The On-Line Encyclopedia of Integer Sequences (OEIS)",
				"url" :	"http://oeis.org/",
				"rating" : 10
			},
			{
				"tag" : "Should I Change My Password? email checker",
				"url" :	"https://shouldichangemypassword.com/",
				"rating" : 9.5
			},									
			{
				"tag" : "Pwned List",
				"url" :	"https://www.pwnedlist.com",
				"rating" : 10
			},									
			{
				"tag" : "Open Source Code Search Engine",
				"url" :	"http://koders.com/",
				"rating" : 6
			},
			{
				"tag" : "Google Code Search Engine",
				"url" :	"http://www.google.com/codesearch",
				"rating" : 5
			},			
			{
				"tag" : "Brand Visibility Search",
				"url" :	"http://www.howsociable.com",
				"rating" : 5
			},			
			{
				"tag" : "Shodan Computer Search Engine",
				"url" :	"http://www.shodanhq.com",
				"rating" : 8
			},
			{
				"tag" : "Google Hacking Database",
				"url" :	"http://www.exploit-db.com/google-dorks/",
				"rating" : 8.5
			}			
									
								
												
		],
		"rating" : 8		
	},	
//////////////////////////////////////////////////
	{
		"code" : "pastebin",
		"name" : "Text sharing sites",
		"desc" : "Text sharing tools and boards",
		"inputs": 
		[
			"any"
		],
		"urls" : 
		[
			{
				"tag" : "Pastebin",
				"url" :	"http://www.pastebin.com",
				"rating" : 8
			},
			{
				"tag" : "GitHub gists",
				"url" :	"https://gist.github.com/",
				"rating" : 8
			},
			{
				"tag" : "Pastebin Alerts",
				"url" :	"http://andrewmohawk.com/pasteLertV2/",
				"rating" : 7
			},
			{
				"tag" : "PasteScrape Tool (searches several paste sites)",
				"url" :	"http://www.andrewmohawk.com/pasteScrape",
				"rating" : 4
			},
			{
				"tag" : "Pastie",
				"url" :	"http://www.pastie.org",
				"rating" : 1
			},
			{
				"tag" : "Pastebin.ca",
				"url" :	"http://pastebin.ca",
				"rating" : 2
			},			
		],
		"rating" : 4			
		
	},
//////////////////////////////////////////////////
	{
		"code" : "webinfo",
		"name" : "Website information",
		"desc" : "Website information gathering tools:",
		"inputs": 
		[
			"domain",
			"website"
		],
		"urls" : 
		[
			{
				"tag" : "CopyScape: find copies of a website",
				"url" :	"http://www.copyscape.com/",
				"rating" : 7
			},	
			{
				"tag" : "Domain Crawler",
				"url" :	"http://www.domaincrawler.com/",
				"rating" : 9.5
			},	
			{
				"tag" : "The Wayback Machine (archive.org)",
				"url" :	"http://www.archive.org",
				"rating" : 8
			},	
			{
				"tag" : "Alexa Web Information",
				"url" :	"http://www.alexa.com/",
				"rating" : 5
			},
			{
				"tag" : "Netcraft Research",
				"url" :	"http://www.netcraft.com/",
				"rating" : 8
			},
			{
				"tag" : "Special files: /robots.txt, /crossdomain.xml, /clientaccesspolicy.xml ...",
				"url" :	"http:///",
				"rating" : 6
			},
			{
				"tag" : "Bing linkfromdomain: trick",
				"url" :	"http://www.bing.com/search?q=linkfromdomain%3Agoogle.com",
				"rating" : 4
			},
			{
				"tag" : "Open Site Explorer",
				"url" :	"http://www.opensiteexplorer.org/",
				"rating" : 6
			},
			{
				"tag" : "Yahoo site explorer",
				"url" :	"http://siteexplorer.search.yahoo.com/",
				"rating" : 7
			},
			{
				"tag" : "Loads.in - Load a page from different countries",
				"url" :	"http://loads.in/",
				"rating" : 2
			}																
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////
	{
		"code" : "username",
		"name" : "Username check",
		"desc" : "Username availability:",
		"inputs": 
		[
			"nick",
			"name"
		],
		"urls" : 
		[
			{
				"tag" : "Username availability on Social Web (Knowem)",
				"url" :	"http://knowem.com",
				"rating" : 10
			},
			{
				"tag" : "Wikipedia username check",
				"url" :	"http://wikiwatcher.virgil.gr/pmcu/",
				"rating" : 3
			},
			{
				"tag" : "Steam Community ID checker",
				"url" :	"http://steamidfinder.com/",
				"rating" : 2
			},	
			{
				"tag" : "Steam Community other aliases check",
				"url" :	"http://steamcommunity.com/id/<nick>/ajaxaliases",
				"rating" : 7
			},	
            
			{
				"tag" : "Xbox Live Gametag search",
				"url" :	"http://www.xboxgamertag.com",
				"rating" : 2
			},
			{
				"tag" : "Last.fm music indexer",
				"url" :	"http://www.last.fm/user/xxxxxx",
				"rating" : 6
			},
			{
				"tag" : "eBay Member finder",
				"url" :	"http://www.ebay.com/sch/ebayadvsearch/",
				"rating" : 8
			},
			{
				"tag" : "Reddit username",
				"url" :	"http://www.reddit.com/user/xxxxx",
				"rating" : 3
			},
			{
				"tag" : "Youtube username",
				"url" :	"http://www.youtube.com/user/",
				"rating" : 3
			}											
															
		],
		"rating" : 7		
		
	},		
//////////////////////////////////////////////////	
	{
		"code" : "ipneighbors",
		"name" : "IP Neighbors",
		"desc" : "Shared hosting domains and IP neighbors (Reverse IP)",
		"inputs": 
		[
			"ip",
			"domain",
			"website",
            "hostname"
		],
		"urls" : 
		[
			{
				"tag" : "Bing IP search",
				"url" :	"http://www.bing.com/search?q=ip%3Ax.x.x.x",
				"rating" : 7
			},		
			{
				"tag" : "You get signal - reverse ip",
				"url" :	"http://www.yougetsignal.com",
				"rating" : 8.5
			},		
			{
				"tag" : "whois.Webhosting.info",
				"url" :	"http://whois.webhosting.info/<ip>",
				"rating" : 8
			},		
			{
				"tag" : "Ip-Neighbors",
				"url" :	"http://www.ip-neighbors.com/",
				"rating" : 5
			},	
			{
				"tag" : "Host Spy",
				"url" :	"http://hostspy.org",
				"rating" : 4
			},	
			{
				"tag" : "My-Ip-Neighbors",
				"url" :	"http://www.my-ip-neighbors.com/",
				"rating" : 5
			},	
			{
				"tag" : "MyIPNeighbors",
				"url" :	"http://www.myipneighbors.com/",
				"rating" : 4
			}	
												
		],
		"rating" : 7			
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "spamsites",
		"name" : "Spam lists",
		"desc" : "Search un spam blacklists",
		"inputs": 
		[
			"ip",
            "domain"
		],
		"urls" : 
		[
			{
				"tag" : "SpamCop",
				"url" :	"http://www.spamcop.net/bl.shtml",
				"rating" : 7
			},
			{
				"tag" : "Check SPAM IP/Domain",
				"url" :	"http://www.stopforumspam.com/",
				"rating" : 6
			},											
			{
				"tag" : "SURBL URI Reputation Data",
				"url" :	"http://www.surbl.org/surbl-analysis",
				"rating" : 8
			},	
			{
				"tag" : "JoeWein spam domain blacklist",
				"url" :	"http://joewein.net/spam/blacklist.htm",
				"rating" : 8
			},	
												
		],
		"rating" : 7			
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "mailinglists",
		"name" : "Mailing Lists",
		"desc" : "Search in mailing lists",
		"inputs": 
		[
			"any"
		],
		"urls" : 
		[
			{
				"tag" : "Mail Archive: search mailing lists",
				"url" :	"http://www.mail-archive.com/",
				"rating" : 4
			},							
			{
				"tag" : "Mailing lists archives",
				"url" :	"http://marc.info/",
				"rating" : 3
			},							
			{
				"tag" : "Gmane mailing list carrier",
				"url" :	"http://gmane.org",
				"rating" : 4
            }							
												
		],
		"rating" : 7			
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "metasearch",
		"name" : "Meta SE",
		"desc" : "Meta search engines and crawlers:",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Kartoo Meta search engine",
				"url" :	"http://www.kartoo.com/",
				"rating" : 6
			},
			{
				"tag" : "Dogpile",
				"url" :	"http://www.dogpile.com/",
				"rating" : 5
			},			
			{
				"tag" : "BlogPulse",
				"url" :	"http://www.blogpulse.com/",
				"rating" : 5
			},
			{
				"tag" : "Technorati",
				"url" :	"http://technorati.com",
				"rating" : 5
			},			
			{
				"tag" : "Forum Discussion search",
				"url" :	"http://www.boardtracker.com/",
				"rating" : 5
			},
			{
				"tag" : "Icerocket buzz search",
				"url" :	"http://www.icerocket.com/",
				"rating" : 5
			},
			{
				"tag" : "Google Blog Search",
				"url" :	"http://www.google.com/blogsearch",
				"rating" : 6
			},
			{
				"tag" : "Tag search engine",
				"url" :	"http://www.keotag.com/	",
				"rating" : 5
			},
			{
				"tag" : "Samepoint Reputation Management Search Engine",
				"url" :	"http://www.samepoint.com/",
				"rating" : 5
			},
			{
				"tag" : "Delicious Bookmark search",
				"url" :	"http://delicious.com/",
				"rating" : 6
			},
			{
				"tag" : "Xmarks Bookmark search",
				"url" :	"http://www.xmarks.com/",
				"rating" : 5
			},											
																					
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "clustersearch",
		"name" : "Clustering Search Engines",
		"desc" : "Organize results based on related topics",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Carrot2",
				"url" :	"http://search.carrot2.org/",
				"rating" : 6
			},
			{
				"tag" : "Yippy",
				"url" :	"http://search.yippy.com",
				"rating" : 5
			},
			{
				"tag" : "WebClust",
				"url" :	"http://www.webclust.com",
				"rating" : 4
			},
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "webdirectories",
		"name" : "Web Directories",
		"desc" : "Systematically arranged listings of links by humans.",
		"inputs": 
		[
                "other"
		],
		"urls" : 
		[
			{
				"tag" : "Open Directory",
				"url" :	"http://www.dmoz.org/",
				"rating" : 5
			},
			{
				"tag" : "ipl2",
				"url" :	"http://www.ipl.org/",
				"rating" : 5
			},
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "dnscmd",
		"name" : "DNS command line",
		"desc" : "DNS Information Gathering command line tools:",
		"inputs": 
		[
			"domain",
			"hostname"
		],
		"urls" : 
		[
			{
				"tag" : "$ dig @dns.domain.com domain.com AXFR",
				"url" :	"http://www.geektools.com/digtool.php",
				"rating" : 6
			},
			{
				"tag" : "Fierce Domain Scan",
				"url" :	"http://ha.ckers.org/fierce/fierce.pl",
				"rating" : 9
			},
			{
				"tag" : "DNSEnum tool",
				"url" :	"http://code.google.com/p/dnsenum/",
				"rating" : 7
			},
			{
				"tag" : "The Harvester command line tool",
				"url" :	"http://www.edge-security.com/theHarvester.php",
				"rating" : 8
			}																	
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "googlealt",
		"name" : "Google alternatives",
		"desc" : "Alternative search engines (there's world beyond Google ;):",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Zuula",
				"url" :	"http://www.zuula.com",
				"rating" : 4
			},
			{
				"tag" : "Exalead",
				"url" :	"http://www.exalead.com",
				"rating" : 5
			},
			{
				"tag" : "Yippy",
				"url" :	"http://search.yippy.com/",
				"rating" : 4.5
			},		
			{
				"tag" : "Ask",
				"url" :	"http://www.ask.com",
				"rating" : 4.5
			},		
			{
				"tag" : "Gigablast",
				"url" :	"http://gigablast.com",
				"rating" : 4.5
			}		
																					
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "alertservices",
		"name" : "Alert Services",
		"desc" : "Free Alert Services for automatic monitoring:",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Google Alerts",
				"url" :	"http://www.google.es/alerts",
				"rating" : 3
			},
			{
				"tag" : "Tweet Alarm",
				"url" :	"http://www.tweetalarm.com/",
				"rating" : 5
			},
			{
				"tag" : "Pastebin Alert",
				"url" :	"http://andrewmohawk.com/pasteLertV2/",
				"rating" : 7
			}		
																					
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "facebookalt",
		"name" : "Alternative SN",
		"desc" : "Alternative Social Networks (there's world beyond Facebook/Twitter ;):",
		"inputs": 
		[			
			"name",
			"email",
			"nick"
		],
		"urls" : 
		[
			{
				"tag" : "Bebo",
				"url" :	"http://www.bebo.com/",
				"rating" : 6
			},
			{
				"tag" : "Netlog",
				"url" :	"http://en.netlog.com/",
				"rating" : 4
			},
			{
				"tag" : "Yippy",
				"url" :	"http://search.yippy.com/",
				"rating" : 4.5
			},
			{
				"tag" : "Badoo",
				"url" :	"http://www.badoo.com/",
				"rating" : 8
			},			
			{
				"tag" : "Orkut",
				"url" :	"http://www.orkut.com",
				"rating" : 7
			},
			{
				"tag" : "Xing",
				"url" :	"http://www.xing.com/",
				"rating" : 6
			},
			{
				"tag" : "LinkedIn",
				"url" :	"http://www.linkedin.com/",
				"rating" : 7.5
			},			
			{
				"tag" : "Yahoo Pulse",
				"url" :	"http://pulse.yahoo.com",
				"rating" : 5
			},
			{
				"tag" : "Xanga",
				"url" :	"http://www.xanga.com/",
				"rating" : 5
			}																		
																					
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "emailtracing",
		"name" : "Email tracing",
		"desc" : "Email dossiers and tracing tools",
		"inputs": 
		[
			"email"
		],
		"urls" : 
		[
			{
				"tag" : "Google AROUND trick",
				"url" :	"http://www.google.com/?q=%3Cname%3E+at+AROUND+3+%22dot+com%22+%3Cdomain1+%3EOR+%3Cdomain2%3E",
				"rating" : 7
			},	
			{
				"tag" : "Google Facebook Group search",
				"url" :	"http://www.google.com/search?q=email+site%3Afacebook.com+inurl%3Agroup",
				"rating" : 7
			},					
			{
				"tag" : "CentralOps",
				"url" :	"http://centralops.net/co/",
				"rating" : 3
			},
			{
				"tag" : "Email Trace",
				"url" :	"http://www.ip-adress.com/trace_email/",
				"rating" : 7
			},
			{
				"tag" : "Spam Locator",
				"url" :	"http://www.geobytes.com/spamlocator.htm",
				"rating" : 2
			},			
			{
				"tag" : "IP Tools - Identify free email address",
				"url" :	"http://www.iptools.com/	",
				"rating" : 6
			},
						{
				"tag" : "Facebook Email Reset Enumeration Functionality",
				"url" :	"http://pastebin.com/7bDS0W40",
				"rating" : 8
			},
			{
				"tag" : "The Harvester command line tool",
				"url" :	"http://www.edge-security.com/theHarvester.php",
				"rating" : 8
			},
			{
				"tag" : "RedIris PGP Key Directory",
				"url" :	"http://pgp.rediris.es:11371/pks/lookup?search=KEYWORD&op=index",
				"rating" : 9
			},												
			{
				"tag" : "PGP Key Directory",
				"url" :	"https://keyserver.pgp.com/",
				"rating" : 2
			},											
			{
				"tag" : "Check SPAM account",
				"url" :	"http://www.stopforumspam.com/",
				"rating" : 5
			},											
		],
		"rating" : 6			
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "people",
		"name" : "People SE",
		"desc" : "People search engines and directories:",
		"inputs": 
		[
			"name",
			"phone",
			"nick",
			"email"
		],
		"urls" : 
		[

						
			{
				"tag" : "123 People ",
				"url" :	"http://www.123people.com/",
				"rating" : 7
			},			
			
			{
				"tag" : "Usenet Addresses",
				"url" :	"http://usenet-addresses.mit.edu/",
				"rating" : 5
			},			
            {
				"tag" : "Wink",
				"url" :	"http://wink.com/people-search",
				"rating" : 5
			},			
            {
				"tag" : "Jigsaw",
				"url" :	"http://www.jigsaw.com/SearchAcrossCompanies.xhtml?opCode=advancedSearch&showAdvancedSearch=true",
				"rating" : 6
			},			
			{
				"tag" : "Pipl ",
				"url" :	"http://pipl.com/",
				"rating" : 6
			},	
			{
				"tag" : "Spokeo",
				"url" :	"http://www.spokeo.com/",
				"rating" : 6
			},
			{
				"tag" : "Foursquare",
				"url" :	"https://www.foursquare.com/search?q=john+doe",
				"rating" : 7
			}											
																					
		],
		"rating" : 7.14
		
	},
//////////////////////////////////////////////////
	{
		"code" : "search",
		"name" : "Company Info",
		"desc" : "Company information listings:",
		"inputs": 
		[
			"company",
			"name"
		],
		"urls" : 
		[
			{
				"tag" : "Hoovers - Business Intelligence, Insight and Results. US and UK ",
				"url" :	"http://www.hoovers.com",
				"rating" : 3
			},
			{
				"tag" : "Foursquare - Locate offices",
				"url" :	"http://www.foursquare.com",
				"rating" : 7
			},
			{
				"tag" : "Samepoint Reputation Management Search Engine",
				"url" :	"http://www.samepoint.com/",
				"rating" : 3
			},															
		],
		"rating" : 7		
		
	},		
//////////////////////////////////////////////////
	{
		"code" : "deepweb",
		"name" : "Deep Web",
		"desc" : "Search the deep web",
		"inputs": 
		[
			"name",
			"nick",
			"phone",
			"company",
            "other"
		],
		"urls" : 
		[
			{
				"tag" : "Goshme",
				"url" :	"http://www.goshme.com",
				"rating" : 6.5
			},		
			{
				"tag" : "IncyWincy",
				"url" :	"http://www.incywincy.com",
				"rating" : 5
			},		
			{
				"tag" : "Complete Planet",
				"url" :	"http://www.completeplanet.com",
				"rating" : 6
			},		
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////
	{
		"code" : "criminal",
		"name" : "Special searches",
		"desc" : "Special Individual/Company searches:",
		"inputs": 
		[
			"name",
			"nick",
			"phone",
			"company"
		],
		"urls" : 
		[
			{
				"tag" : "Evil - Phone numbers of unsuspecting Facebookers",
				"url" :	"http://www.tomscott.com/evil/",
				"rating" : 6
			},		
			{
				"tag" : "Search Engine Suggestion search",
				"url" :	"http://www.soovle.com",
				"rating" : 8
			},		
			{
				"tag" : "Creepy - tool to geolocate users",
				"url" :	"http://ilektrojohn.github.com/creepy/",
				"rating" : 7
			},		
			{
				"tag" : "We Know What You Are Doing - Social Network sensitive messages",
				"url" :	"http://www.weknowwhatyouredoing.com",
				"rating" : 5
			},
			{
				"tag" : "Criminal Records Background check Reverse Phone lookup Driving Records People Search Marriage Records Verify College Degrees Employment Check covers public records",
				"url" :	"http://www.abika.com/",
				"rating" : 5
			},
							{
				"tag" : "Monster Job Openings",
				"url" :	"http://www.monster.es/geo/siteselection",
				"rating" : 7
			}														
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////	
	{
		"code" : "reverseimage",
		"name" : "Reverse Image",
		"desc" : "Reverse Image search engines:",
		"inputs": 
		[
			"image"
		],
		"urls" : 
		[
			{
				"tag" : "Tineye - finds same image on other places",
				"url" :	"http://www.tineye.com/",
				"rating" : 8
			},
			{
				"tag" : "Stolen camera finder",
				"url" :	"http://www.stolencamerafinder.com/",
				"rating" : 7
			},
			{
				"tag" : "Google search by image - finds similar images",
				"url" :	"http://images.google.com/",
				"rating" : 8
			},
			{
				"tag" : "RevIMG",
				"url" :	"http://www.revimg.net/",
				"rating" : 5
			},
			{
				"tag" : "Bit.ly original URL link search",
				"url" :	"http://bit.ly/xxxx+",
				"rating" : 3
			},
			{
				"tag" : "Canv.as submission form",
				"url" :	"http://canv.as/",
				"rating" : 4
			}																								
		],
		"rating" : 7		
		
	},		
//////////////////////////////////////////////////		
	{
		"code" : "hashes",
		"name" : "Hash tools",
		"desc" : "Tools for identifying hashes:",
		"inputs": 
		[
			"password"
		],
		"urls" : 
		[
			{
				"tag" : "Gcrack.py: Cracking hashes using Google",
				"url" :	"https://github.com/tkisason/gcrack",
				"rating" : 7
			},
			{
				"tag" : "Passfault OWASP utility to identify semantics in passwords",
				"url" :	"https://passfault.appspot.com/",
				"rating" : 5
			},
			{
				"tag" : "Identify a hash by a given string",
				"url" :	"http://forum.insidepro.com/viewtopic.php?t=8225",
				"rating" : 9
			},
			{
				"tag" : "Identify a hash by a given string (mirror)",
				"url" :	"http://pastebin.com/4NgtfQgA",
				"rating" : 0
			},
			{
				"tag" : "Reverse hash lookup",
				"url" :	"http://hashcrack.com",
				"rating" : 6
			},
			{
				"tag" : "Online hash crack",
				"url" :	"http://www.onlinehashcrack.com/",
				"rating" : 6
			},
			{
				"tag" : "FindMyHash.py - try to crack different types of hashes using free online services.",
				"url" :	"http://code.google.com/p/findmyhash/",
				"rating" : 9
			},
												{
				"tag" : "SANS Reverse Hash Calculator",
				"url" :	"http://isc.sans.edu/tools/reversehash.html",
				"rating" : 8
			}															
		],
		"rating" : 7		
		
	},	

//////////////////////////////////////////////////	
	{
		"code" : "lulzsec",
		"name" : "Password disclosure",
		"desc" : "Public disclosure of account passwords:",
		"inputs": 
		[
			"email",
			"nick"
		],
		"urls" : 
		[
			{
				"tag" : "Lulzsec clear text passwords",
				"url" :	"http://dazzlepod.com/lulzsec/final/",
				"rating" : 9
			},
			{
				"tag" : "Should I Change My Password? email checker",
				"url" :	"https://shouldichangemypassword.com/",
				"rating" : 9.5
			},																		
			{
				"tag" : "Pwned List",
				"url" :	"https://www.pwnedlist.com",
				"rating" : 10
			},																		
			{
				"tag" : "SkullSecurity Leaked Password directory",
				"url" :	"http://www.skullsecurity.org/wiki/index.php/Passwords#Leaked_passwords",
				"rating" : 8.5
			},																		
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////	
	{
		"code" : "whatweb",
		"name" : "Software Identification",
		"desc" : "Tools for identifying which software is a website running:",
		"inputs": 
		[
			"website"
		],
		"urls" : 
		[
			{
				"tag" : "Wappalizer extension",
				"url" :	"http://wappalyzer.com/",
				"rating" : 7
			},
			{
				"tag" : "WhatWeb command line tool",
				"url" :	"http://www.morningstarsecurity.com/research/whatweb",
				"rating" : 9
			}																			
		],
		"rating" : 7		
		
	},		
//////////////////////////////////////////////////		http://www.shodanhq.com	
	{
		"code" : "machines",
		"name" : "Machine specific tools",
		"desc" : "Machine specific tools and databases",
		"inputs": 
		[
			"ip",
			"domain",
			"website",
			"hostname"
		],
		"urls" : 
		[
			{
				"tag" : "This IP has downloaded...",
				"url" :	"http://www.youhavedownloaded.com/",
				"rating" : 5
			},
			{
				"tag" : "Shodan Computer Search Engine",
				"url" :	"http://www.shodanhq.com",
				"rating" : 8
			},
			{
				"tag" : "Check IP Reputation",
				"url" :	"http://www.commtouch.com/check-ip-reputation",
				"rating" : 6
			},
			{
				"tag" : "Check SPAM IP",
				"url" :	"http://www.stopforumspam.com/",
				"rating" : 5
			},											
			{
				"tag" : "Test for compromised SSH-keys",
				"url" :	"http://serversniff.net/sshreport.php",
				"rating" : 3
			}																									
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////
	{
		"code" : "tor",
		"name" : "Anonymous Networks",
		"desc" : "Anonymous Networks proxies and IPs",
		"inputs": 
		[
			"ip"
		],
		"urls" : 
		[
			{
				"tag" : "Public Tor Proxy List",
				"url" :	"http://proxy.org/tor.shtml",
				"rating" : 5
}																							
            ],
		"rating" : 7		
		
	},
//////////////////////////////////////////////////
	{
		"code" : "urlsearches",
		"name" : "Bookmarking sites",
		"desc" : "Seach who else visited some URL:",
		"inputs": 
		[
			"url",
            "image"
		],
		"urls" : 
		[
			{
				"tag" : "Open Site Explorer",
				"url" :	"http://www.opensiteexplorer.org/",
				"rating" : 6
            },
			{
				"tag" : "Delicious Bookmarks: see what people are saying",
				"url" :	"http://www.delicious.com/url",
				"rating" : 4
            },
			{
				"tag" : "Delicious Bookmarks: check who else saved it",
				"url" :	"http://www.delicious.com",
				"rating" : 5
            },
			{
				"tag" : "Bit.ly: create link and append '+' to it",
				"url" :	"http://www.bit.ly",
				"rating" : 6
            },
			{
				"tag" : "Stumbleupon: submit new url",
				"url" :	"http://www.stumbleupon.com",
				"rating" : 5
            },
			{
				"tag" : "SARG Dork",
				"url" :	"http://www.google.com/?q=%22squid+analysis+report+generator%22+inurl:pieceofurl.html",
				"rating" : 4
            }
		],
		"rating" : 7		
		
	},
//////////////////////////////////////////////////	
	{
		"code" : "socialnetwork",
		"name" : "Social Networks Intel",
		"desc" : "Find intel on social networks",
		"inputs": 
		[
			"nick",
            "name",
            "other"
		],
		"urls" : 
		[
			{
				"tag" : "Twittego - Finds connections between 2 twitter accounts",
				"url" :	"http://makensi.es/tools/twittego.txt",
				"rating" : 7
			},
			{
				"tag" : "Tweetstats",
				"url" :	"http://tweetstats.com",
				"rating" : 8
			},
			{
				"tag" : "Twitter map",
				"url" :	"http://twittermap.appspot.com",
				"rating" : 6
			},
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////			
	{
		"code" : "geoloc",
		"name" : "Geolocalization",
		"desc" : "Other Geolocalization tools",
		"inputs": 
		[
			"other"
		],
		"urls" : 
		[
			{
				"tag" : "Google Geolocalization by AP MAC Adress",
				"url" :	"http://pastebin.com/yjG85h6M",
				"rating" : 8
			},
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////			
	{
		"code" : "cms",
		"name" : "CMS User Enumeration",
		"desc" : "Enumerate users for popular CMS",
		"inputs": 
		[
            "website"
		],
		"urls" : 
		[
			{
				"tag" : "Concrete5 /members",
				"url" :	"http://site/members",
				"rating" : 7
			},
   // 		{
   // 			"tag" : "Concrete5 Full Path Disclosure 0day",
   // 			"url" :	"http://site/tools/required/files/properties?fID=<integer>",
   // 			"rating" : 8
   // 		},
			{
				"tag" : "Wordpress User enumeration: wpbrute3.py",
				"url" :	"http://makensi.es/tools/wpbrute3.txt",
				"rating" : 6
			},
			{
				"tag" : "Wordpress Scan: full fledged tool",
				"url" :	"http://wpscan.org/",
				"rating" : 8
			},
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////			
	{
		"code" : "ssl",
		"name" : "SSL certificates",
		"desc" : "Gather info from SSL certificates",
		"inputs": 
		[
			"ip",
            "hostname",
            "website",
		],
		"urls" : 
		[
			{
				"tag" : "Alternate DNS names from SSL certificates",
				"url" :	"https://andrewmohawk.com/SSLAssociated/",
				"rating" : 8
			},
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////			
	{
		"code" : "metadata",
		"name" : "Metadata",
		"desc" : "Metadata extractors",
		"inputs": 
		[
			"image"
		],
		"urls" : 
		[
			{
				"tag" : "Jeffrey's Exif viewer (images)",
				"url" :	"http://regex.info/exif.cgi",
				"rating" : 6
			},
			{
				"tag" : "Extract Metadata - (do not share sensitive files)",
				"url" :	"http://www.extractmetadata.com",
				"rating" : 4
			},
			{
				"tag" : "Foca Online (you should really download Free version ;)",
				"url" :	"http://www.informatica64.com/foca/",
				"rating" : 7
			}																											
		],
		"rating" : 7		
		
	},	
//////////////////////////////////////////////////			
	{
		"code" : "companytools",
		"name" : "Company Tools/SaaS",
		"desc" : "Company services in the cloud:",
		"inputs": 
		[
			"company",
			"email",
			"domain"
		],
		"urls" : 
		[
			{
				"tag" : "Screencast Google Dork",
				"url" :	"https://www.google.es/#hl=en&output=search&sclient=psy-ab&q=site%3Ascreencast.com+inurl%3A%2Ft%2F+(portal+OR+intranet+OR+login)&oq=site:screencast.com+inurl%3A%2Ft%2F+(portal+OR+intranet+OR+login)&gs_l=hp.3...1004.1004.0.1515.1.1.0.0.0.0.110.110.0j1.1.0...0.0.CGIzFSp4u1g&pbx=1&fp=1&biw=1241&bih=594&bav=on.2,or.r_gc.r_pw.r_cp.r_qf.,cf.osb&cad=b",
				"rating" : 6
			},
			{
				"tag" : "Yammer Private Social Network for employees",
				"url" :	"https://www.yammer.com/ebay.com",
				"rating" : 6
			},
			{
				"tag" : "Service-Now IT service portal SaaS",
				"url" :	"https://dell.service-now.com",
				"rating" : 7
			},
			{
				"tag" : "Basecamp",
				"url" :	"https://ebay.basecamphq.com/login",
				"rating" : 5
			},
			{
				"tag" : "Ning Social",
				"url" :	"https://xxxx.ning.com",
				"rating" : 3
			}																														
		],
		"rating" : 7		
		
	},				
			
//////////////////////////////////////////////////	
];

