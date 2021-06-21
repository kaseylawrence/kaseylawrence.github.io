---
layout: post
title:  "Pitfalls of Data Science"
date:   2021-06-20 19:13:15 +0000
categories: misc
---
<!---You’ll find this post in your `_posts` directory. Go ahead and edit it and re-build the site to see your changes. You can rebuild the site in many different ways, but the most common way is to run `jekyll serve`, which launches a web server and auto-regenerates your site when a file is updated. --->

Over the past few years I have stepped my feet in and out of the water of data science and bioinformatics - most of it self-taught through necessity. In the past I've generated a multitude of genomics data from various sample types and library prep workflows that needed analysis. The need to make sense of all of the data was what ignited my love for linux, informatics, and coding. The tech realm is vast and one can never learn everything. I was definitely better in the past in some aspects due to immersion. About 5-6 years ago I was building command-line pipelines, improving in Docker, and solving some really interesting problems for my labmates. I'm back in a more data-centric role and have already seen myself make strides in these areas again.

Across all of the tutorials, course materials and classes I have taken for coding and data science, one of the most important aspects of this field goes silent: dealing with structured data. One of the first things data scientists should be learning is how to actually look at data in json and xml formats. I don't understand why this is not even addressed - we deal with these data structures constantly and have yet to see these covered in course materials unless hunting them down. 

## xPaths for xml - xml.etree

Let's start with xml. I'm going to use the example xml from [w3schools](https://www.w3schools.com/xml/xml_tree.asp) to work demonsrate.

{% highlight xml %}
<?xml version="1.0" encoding="UTF-8"?>
<bookstore>
  <book category="cooking">
    <title lang="en">Everyday Italian</title>
    <author>Giada De Laurentiis</author>
    <year>2005</year>
    <price>30.00</price>
  </book>
  <book category="children">
    <title lang="en">Harry Potter</title>
    <author>J K. Rowling</author>
    <year>2005</year>
    <price>29.99</price>
  </book>
  <book category="web">
    <title lang="en">Learning XML</title>
    <author>Erik T. Ray</author>
    <year>2003</year>
    <price>39.95</price>
  </book>
</bookstore>
{% endhighlight %}

First let's import os and ElementTree, load in the xml(saved as a file).

{% highlight python %}
import os
from xml.etree import ElementTree
#specify name of the xml file to read
fileName = 'w3example.xml'
#get the full path to the file
fullPath = os.path.abspath(os.path.join('/Users/kasey/Documents', fileName))
dom = ElementTree.parse(fullPath)
#parse the xml file with ElementTree, find the book tag
findBooks = dom.findall('./book')
root = dom.getroot()
#loop over within the book tag. Let's print the book categories
for elm in findBooks:
    category = elm.attrib['category'] 
    print(category)
{% endhighlight %}

Output:
{% highlight text %}
cooking
children
web
{% endhighlight %}

xPaths can also be set similar to wildcards by using ".//itenname" - the specified tag will be found throughout the entire document, regardless of its hierarchy. The 'find' attribute can also be utilized to find tags. Once a tag is found, the text/data within the tag can be called using .text. Expanding the loop above:

{% highlight python %}
for elm in findBooks:
    category = elm.attrib['category'] 
    #print(category)
    title = elm.find('title').text
    author = elm.find('author').text
    year = elm.find('year').text
    price = elm.find('price').text
    print(f'The book {title} written by {author} in the year {year} is on sale for {price}'')
  
{% endhighlight %}

Output:
{% highlight text %}
The book Everyday Italian written by Giada De Laurentiis in 2005 is 30.00
The book Harry Potter written by J K. Rowling in 2005 is 29.99
The book Learning XML written by Erik T. Ray in 2003 is 39.95
{% endhighlight %}

## json examples here

Work in progress 