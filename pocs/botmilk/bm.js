
async function hmacSha256(str, key) {
  const buf = new TextEncoder("utf-8").encode(str);
  const sig = await window.crypto.subtle.sign("HMAC", key, buf);
  return buf2hex(sig);
}

function buf2hex(buffer) { // buffer is an ArrayBuffer
  return Array.prototype.map.call(new Uint8Array(buffer), x => ('00' + x.toString(16)).slice(-2)).join('');
}

async function sha256(message) {

    // encode as UTF-8
    const msgBuffer = new TextEncoder('utf-8').encode(message);

    // hash the message
    const hashBuffer = await crypto.subtle.digest('SHA-256', msgBuffer);
    
    // convert ArrayBuffer to Array
    const hashArray = Array.from(new Uint8Array(hashBuffer));

    // convert bytes to hex string
    const hashHex = hashArray.map(b => ('00' + b.toString(16)).slice(-2)).join('');
    return hashHex;
}

function makeNonce(l) {
  var nonce = "";
  var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

  for (var i = 0; i < l; i++)
    nonce += possible.charAt(Math.floor(Math.random() * possible.length));

  return nonce;
}

async function makeNonceKey(sid) {
    sidarray = new TextEncoder("utf-8").encode(sid);
    const pwdKey = await window.crypto.subtle.importKey(
      'raw',
      sidarray,
      { name: 'PBKDF2' },
      false,
      ['deriveKey']
    );    
    const newNonceKey = await window.crypto.subtle.deriveKey(
        {
            name: 'PBKDF2',
            salt: window.crypto.getRandomValues(new Uint8Array(16)),
            iterations: 1000,
            hash: 'SHA-256'
        },
        pwdKey,
        {
            name: 'HMAC',
            hash: 'SHA-256'
        },
        true,
        ['sign']
        );  

    return newNonceKey;
}

/*
 * 9
 * 8 
 * 7 
 * 6
 * 5
 * 4
 * 3
 * 2
 * 1
 * 0
 * 09
 */
function isBeyondFloor(hash, floor, step) {
    preffix = parseInt(hash.slice(0, floor), 16);
    return preffix < step;
}

var sid = 'abcd';
var start = new Date();
var end;
var hash = 'fffffffffffffffffff';
var seconds = 0;
var step = 16;
var floor = 1;
var key = makeNonceKey(sid);
var total_seconds = 0;
var iteration = 1
key.then( function(key) {
    chillout.till(async function() {
            //console.log(key);
            if (isBeyondFloor(hash, floor, step)) {
                end = new Date();
                diff = end - start
                diff /= 1000;
                seconds = Math.round(diff);
                pretty_step = 16-step+1;
                if (step === 1) {
                    floor += 1;
                    step = 16;
                } else {
                    step -= 1;
                }
                if (floor === 5) {
                    total_seconds += seconds;
                    msg = "Hash " + hash.slice(0,floor) + " goes over step "+ pretty_step + " of floor " + floor + " in " + seconds + " seconds (average = " + Math.round(total_seconds / iteration) + ")" ;
                    document.write("<h3>" + msg + "</h3>");
                    iteration += 1;
                    start = new Date();
                    step = 16;
                    floor = 1;
                    hash = 'fffffffffffffffffff';
                }
            } else {
                nonce = makeNonce(32);
                hash = await hmacSha256(nonce, key);
            }

    }).then(function() {
        console.log('finished');
    });
});

