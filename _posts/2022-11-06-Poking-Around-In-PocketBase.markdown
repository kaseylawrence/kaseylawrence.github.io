---
layout: post
title:  "Poking Around in PocketBase"
date:   2022-11-06 08:13:15 +0000
categories: dev
---

I've stolen this phrase from a work colleague: "I'm not a DBA, though I have played one on TV". It makes more sense when he says it, since I've only scratched the surface on DBs, particularly with PostgreSQL. So much more to learn...

Anyway, I'm working on personal project where I can learn and create. The goal is an MVP of a lab managment software, and I've started exploring [PocketBase](https://pocketbase.io/) as a backend. I really like the admin UI and API support. It's open-source, lightweight (since it's SQLite), and made for the web.

Some things that I've learned so far, and it's really for my reference later.

1. One way to get a JWT token is via the SDK. Example in JS:
`import PocketBase from 'pocketbase';
const client = new PocketBase('serverURLHere:portHere');

const adminData = await client.admins.authViaEmail('emailhere', 'password here');

console.log(adminData);`

saved the above in a .js file, then ran node pocketbase_auth.js.

Got an error: `Warning: To load an ES module, set "type": "module" in the package.json or use the .mjs extension.`

This meant I needed to create a package.json file in the same directory that looked like this:
```json
{
    "type": "module"
}`
```
Then I got a new error: 
{% highlight bash %}
ReferenceError: AbortController is not defined
{% endhighlight %}
Which meant I needed to update my version of node. I used homebrew on mac. 

Then the final command the worked. The experimental-modules may or not be necessary now: 
{%highlight bash %}
`node --experimental-modules pocketbase_auth.js`
{% endhighlight %}
Response with a Token:
```json
{
  admin: n {
    id: '2qbuk2zk58u3wdl',
    created: '2022-09-17 00:25:39.647',
    updated: '2022-11-06 00:19:29.692',
    avatar: 1,
    email: 'myAdminEmailHere',
    lastResetSentAt: ''
  },
  token: 'LongTokenHere'
}
```

Using Postman to create an entry in the database via the API:

Include in the header: 
```json
{
    'Authorization': 'Admin tokenHere'
}
```
POST to /api/collections/samples/records with form-data option:
```json
{
    "@collectionId": "4s1qnhuxv33im85",
    "@collectionName": "samples",
    "created": "2022-11-06 19:54:27.056",
    "id": "7po95tr09xppp11",
    "name": "mysampleDNA",
    "sampleid": 123456,
    "updated": "2022-11-06 19:54:27.056"
}
```

Definitely felt great to see that first 200 response come through. Hands went up for sure.
<iframe src="https://giphy.com/embed/xT9IgKWQeoclWggTDO" width="480" height="480" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/laff-tv-comedy-that-70s-show-xT9IgKWQeoclWggTDO">via GIPHY</a></p>

Give PocketBase a try. It might be great for that project that you're working on.
