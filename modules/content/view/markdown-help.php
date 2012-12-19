<div id="helpModal" class="modal hide fade">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h3>Markdown Syntax Help</h3>
    </div>
    <div class="modal-body">


<p>BLOCK ELEMENTS</p>
<p>PARAGRAPHS AND LINE BREAKS</p>
<p>A paragraph is simply one or more consecutive lines of text, separated by one or more blank lines. (A blank line is any line that looks like a blank line — a line containing nothing but spaces or tabs is considered blank.) Normal paragraphs should not be indented with spaces or tabs.</p>
<p>The implication of the “one or more consecutive lines of text” rule is that Markdown supports “hard-wrapped” text paragraphs. This differs significantly from most other text-to-HTML formatters (including Movable Type’s “Convert Line Breaks” option) which translate every line break character in a paragraph into a &lt;br /&gt; tag.</p>
<p>When you do want to insert a &lt;br /&gt; break tag using Markdown, you end a line with two or more spaces, then type return.</p>
<p>Yes, this takes a tad more effort to create a &lt;br /&gt;, but a simplistic “every line break is a &lt;br /&gt;” rule wouldn’t work for Markdown. Markdown’s email-style blockquoting and multi-paragraph list items work best — and look better — when you format them with hard breaks.</p>
<p>HEADERS</p>
<p>Markdown supports two styles of headers, Setext and atx.</p>
<p>Setext-style headers are “underlined” using equal signs (for first-level headers) and dashes (for second-level headers). For example:</p>
<pre>This is an H1
=============

This is an H2
-------------</pre>
<p>  Any number of underlining =’s or -’s will work.</p>
<p>Atx-style headers use 1-6 hash characters at the start of the line, corresponding to header levels 1-6. For example:</p>
<pre># This is an H1

## This is an H2

###### This is an H6
</pre>
<p>  Optionally, you may “close” atx-style headers. This is purely cosmetic — you can use this if you think it looks better. The closing hashes don’t even need to match the number of hashes used to open the header. (The number of opening hashes determines the header level.) :</p>
<pre># This is an H1 #

## This is an H2 ##

### This is an H3 ######</pre>
<p>BLOCKQUOTES</p>
<p>Markdown uses email-style &gt; characters for blockquoting. If you’re familiar with quoting passages of text in an email message, then you know how to create a blockquote in Markdown. It looks best if you hard wrap the text and put a &gt; before every line:</p>
<pre>&gt; This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
&gt; consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
&gt; Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.
&gt; 
&gt; Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
&gt; id sem consectetuer libero luctus adipiscing.</pre>
<p>Markdown allows you to be lazy and only put the &gt; before the first line of a hard-wrapped paragraph:</p>
<pre>&gt; This is a blockquote with two paragraphs. Lorem ipsum dolor sit amet,
consectetuer adipiscing elit. Aliquam hendrerit mi posuere lectus.
Vestibulum enim wisi, viverra nec, fringilla in, laoreet vitae, risus.

&gt; Donec sit amet nisl. Aliquam semper ipsum sit amet velit. Suspendisse
id sem consectetuer libero luctus adipiscing.</pre>
<p>  Blockquotes can be nested (i.e. a blockquote-in-a-blockquote) by adding additional levels of &gt;:</p>
<pre>&gt; This is the first level of quoting.
&gt;
&gt; &gt; This is nested blockquote.
&gt;
&gt; Back to the first level.</pre>
<p>Blockquotes can contain other Markdown elements, including headers, lists, and code blocks:</p>
<pre>&gt; ## This is a header.
&gt; 
&gt; 1.   This is the first list item.
&gt; 2.   This is the second list item.
&gt; 
&gt; Here's some example code:
&gt; 
&gt;     return shell_exec(&quot;echo $input | $markdown_script&quot;);</pre>
<p>Any decent text editor should make email-style quoting easy. For example, with BBEdit, you can make a selection and choose Increase Quote Level from the Text menu.</p>
<p>LISTS</p>
<p>Markdown supports ordered (numbered) and unordered (bulleted) lists.</p>
<p>Unordered lists use asterisks, pluses, and hyphens — interchangably — as list markers:</p>
<pre>*   Red
*   Green
*   Blue</pre>
<p>is equivalent to:</p>
<pre>+   Red
+   Green
+   Blue</pre>
<p>and:</p>
<pre>-   Red
-   Green
-   Blue</pre>
<p>Ordered lists use numbers followed by periods:</p>
<pre>1.  Bird
2.  McHale
3.  Parish</pre>
<p>It’s important to note that the actual numbers you use to mark the list have no effect on the HTML output Markdown produces. The HTML Markdown produces from the above list is:</p>
<pre>&lt;ol&gt;
&lt;li&gt;Bird&lt;/li&gt;
&lt;li&gt;McHale&lt;/li&gt;
&lt;li&gt;Parish&lt;/li&gt;
&lt;/ol&gt;</pre>
<p>If you instead wrote the list in Markdown like this:</p>
<pre>1.  Bird
1.  McHale
1.  Parish</pre>
<p>or even:</p>
<pre>3. Bird
1. McHale
8. Parish</pre>
<p>you’d get the exact same HTML output. The point is, if you want to, you can use ordinal numbers in your ordered Markdown lists, so that the numbers in your source match the numbers in your published HTML. But if you want to be lazy, you don’t have to.</p>
<p>If you do use lazy list numbering, however, you should still start the list with the number 1. At some point in the future, Markdown may support starting ordered lists at an arbitrary number.</p>
<p>List markers typically start at the left margin, but may be indented by up to three spaces. List markers must be followed by one or more spaces or a tab.</p>
<p>To make lists look nice, you can wrap items with hanging indents:</p>
<pre>*   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
    Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
    viverra nec, fringilla in, laoreet vitae, risus.
*   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
    Suspendisse id sem consectetuer libero luctus adipiscing.</pre>
<p>  But if you want to be lazy, you don’t have to:</p>
<pre>*   Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
Aliquam hendrerit mi posuere lectus. Vestibulum enim wisi,
viverra nec, fringilla in, laoreet vitae, risus.
*   Donec sit amet nisl. Aliquam semper ipsum sit amet velit.
Suspendisse id sem consectetuer libero luctus adipiscing.</pre>
<p>If list items are separated by blank lines, Markdown will wrap the items in &lt;p&gt; tags in the HTML output. For example, this input:</p>
<pre>*   Bird
*   Magic</pre>
<p>will turn into:</p>
<pre>&lt;ul&gt;
&lt;li&gt;Bird&lt;/li&gt;
&lt;li&gt;Magic&lt;/li&gt;
&lt;/ul&gt;</pre>
<p>But this:</p>
<pre>*   Bird

*   Magic</pre>
<p>will turn into:</p>
<pre>&lt;ul&gt;
&lt;li&gt;&lt;p&gt;Bird&lt;/p&gt;&lt;/li&gt;
&lt;li&gt;&lt;p&gt;Magic&lt;/p&gt;&lt;/li&gt;
&lt;/ul&gt;</pre>
<p>List items may consist of multiple paragraphs. Each subsequent paragraph in a list item must be indented by either 4 spaces or one tab:</p>
<pre>1.  This is a list item with two paragraphs. Lorem ipsum dolor
    sit amet, consectetuer adipiscing elit. Aliquam hendrerit 
    mi posuere lectus.

        Vestibulum enim wisi, viverra nec, fringilla in, laoreet
    vitae, risus. Donec sit amet nisl. Aliquam semper ipsum
    sit amet velit.

2.  Suspendisse id sem consectetuer libero luctus adipiscing.</pre>
<p>It looks nice if you indent every line of the subsequent paragraphs, but here again, Markdown will allow you to be lazy:</p>
<pre>*   This is a list item with two paragraphs.

    This is the second paragraph in the list item. You're
only required to indent the first line. Lorem ipsum dolor
sit amet, consectetuer adipiscing elit.

*   Another item in the same list.</pre>
<p>To put a blockquote within a list item, the blockquote’s &gt; delimiters need to be indented:</p>
<pre>*   A list item with a blockquote:

    &gt; This is a blockquote
    &gt; inside a list item.</pre>
<p>To put a code block within a list item, the code block needs to be indented twice — 8 spaces or two tabs:</p>
<pre>*   A list item with a code block:

    &lt;code goes here&gt;</pre>
<p>It’s worth noting that it’s possible to trigger an ordered list by accident, by writing something like this:</p>
<pre>1986. What a great season.</pre>
<p>In other words, a number-period-space sequence at the beginning of a line. To avoid this, you can backslash-escape the period:</p>
<pre>1986\. What a great season.</pre>
<p>CODE BLOCKS</p>
<p>Pre-formatted code blocks are used for writing about programming or markup source code. Rather than forming normal paragraphs, the lines of a code block are interpreted literally. Markdown wraps a code block in both &lt;pre&gt; and &lt;code&gt; tags.</p>
<p>To produce a code block in Markdown, simply indent every line of the block by at least 4 spaces or 1 tab. For example, given this input:</p>
<pre>This is a normal paragraph:

    This is a code block.</pre>
<p>Markdown will generate:</p>
<pre>&lt;p&gt;This is a normal paragraph:&lt;/p&gt;

&lt;pre&gt;&lt;code&gt;This is a code block.
&lt;/code&gt;&lt;/pre&gt;</pre>
<p>One level of indentation — 4 spaces or 1 tab — is removed from each line of the code block. For example, this:</p>
<pre>Here is an example of AppleScript:

    tell application &quot;Foo&quot;
       beep
    end tell</pre>
<p>will turn into:</p>
<pre>&lt;p&gt;Here is an example of AppleScript:&lt;/p&gt;

&lt;pre&gt;&lt;code&gt;tell application &quot;Foo&quot;
   beep
end tell
&lt;/code&gt;&lt;/pre&gt;</pre>
<p>A code block continues until it reaches a line that is not indented (or the end of the article).</p>
<p>Within a code block, ampersands (&amp;) and angle brackets (&lt; and &gt;) are automatically converted into HTML entities. This makes it very easy to include example HTML source code using Markdown — just paste it and indent it, and Markdown will handle the hassle of encoding the ampersands and angle brackets. For example, this:</p>
<pre>    &lt;div class=&quot;footer&quot;&gt;
        &amp;copy; 2004 Foo Corporation
    &lt;/div&gt;</pre>
<p>will turn into:</p>
<pre>&lt;pre&gt;&lt;code&gt;&amp;lt;div class=&quot;footer&quot;&amp;gt;
   &amp;amp;copy; 2004 Foo Corporation
&amp;lt;/div&amp;gt;
&lt;/code&gt;&lt;/pre&gt;</pre>
<p>Regular Markdown syntax is not processed within code blocks. E.g., asterisks are just literal asterisks within a code block. This means it’s also easy to use Markdown to write about Markdown’s own syntax.</p>
<p>HORIZONTAL RULES</p>
<p>You can produce a horizontal rule tag (&lt;hr /&gt;) by placing three or more hyphens, asterisks, or underscores on a line by themselves. If you wish, you may use spaces between the hyphens or asterisks. Each of the following lines will produce a horizontal rule:</p>
<pre>* * *

***

*****

- - -

---------------------------------------</pre>
<p>SPAN ELEMENTS</p>
<p>LINKS</p>
<p>Markdown supports two style of links: inline and reference.</p>
<p>In both styles, the link text is delimited by [square brackets].</p>
<p>To create an inline link, use a set of regular parentheses immediately after the link text’s closing square bracket. Inside the parentheses, put the URL where you want the link to point, along with an optional title for the link, surrounded in quotes. For example:</p>
<pre>This is [an example](http://example.com/ &quot;Title&quot;) inline link.

[This link](http://example.net/) has no title attribute.</pre>
<p>Will produce:</p>
<pre>&lt;p&gt;This is &lt;a href=&quot;http://example.com/&quot; title=&quot;Title&quot;&gt;
   an example&lt;/a&gt; inline link.&lt;/p&gt;

&lt;p&gt;&lt;a href=&quot;http://example.net/&quot;&gt;This link&lt;/a&gt; has no
   title attribute.&lt;/p&gt;</pre>
<p>If you’re referring to a local resource on the same server, you can use relative paths:</p>
<pre>See my [About](/about/) page for details. </pre>
<p>Reference-style links use a second set of square brackets, inside which you place a label of your choosing to identify the link:</p>
<pre>This is [an example][id] reference-style link.</pre>
<p>You can optionally use a space to separate the sets of brackets:</p>
<pre>This is [an example] [id] reference-style link.</pre>
<p>Then, anywhere in the document, you define your link label like this, on a line by itself:</p>
<pre>[id]: http://example.com/  &quot;Optional Title Here&quot;</pre>
<p>That is:</p>
<ul>
  <li>Square brackets containing the link identifier (optionally indented from the left margin using up to three spaces);</li>
  <li>followed by a colon;</li>
  <li>followed by one or more spaces (or tabs);</li>
  <li>followed by the URL for the link;</li>
  <li>optionally followed by a title attribute for the link, enclosed in double or single quotes, or enclosed in parentheses.</li>
</ul>
<pre>The following three link definitions are equivalent:</pre>
<pre>[foo]: http://example.com/  &quot;Optional Title Here&quot;
[foo]: http://example.com/  'Optional Title Here'
[foo]: http://example.com/  (Optional Title Here)</pre>
<p>NOTE: There is a known bug in Markdown.pl 1.0.1 which prevents single quotes from being used to delimit link titles.</p>
<p>The link URL may, optionally, be surrounded by angle brackets:</p>
<pre>[id]: &lt;http://example.com/&gt;  &quot;Optional Title Here&quot;</pre>
<p>You can put the title attribute on the next line and use extra spaces or tabs for padding, which tends to look better with longer URLs:</p>
<pre>[id]: http://example.com/longish/path/to/resource/here 
    &quot;Optional Title Here&quot;</pre>
<p>Link definitions are only used for creating links during Markdown processing, and are stripped from your document in the HTML output.</p>
<p>Link definition names may consist of letters, numbers, spaces, and punctuation — but they are not case sensitive. E.g. these two links:</p>
<pre>[link text][a]
[link text][A]</pre>
<p>are equivalent.</p>
<p>The implicit link name shortcut allows you to omit the name of the link, in which case the link text itself is used as the name. Just use an empty set of square brackets — e.g., to link the word “Google” to the google.com web site, you could simply write:</p>
<pre>[Google][]</pre>
<p>And then define the link:</p>
<pre>[Google]: http://google.com/</pre>
<p>Because link names may contain spaces, this shortcut even works for multiple words in the link text:</p>
<pre>Visit [Daring Fireball][] for more information.</pre>
<p>And then define the link:</p>
<pre>[Daring Fireball]: http://daringfireball.net/</pre>
<p>Link definitions can be placed anywhere in your Markdown document. I tend to put them immediately after each paragraph in which they’re used, but if you want, you can put them all at the end of your document, sort of like footnotes.</p>
<p>Here’s an example of reference links in action:</p>
<pre>I get 10 times more traffic from [Google] [1] than from
[Yahoo] [2] or [MSN] [3].

[1]: http://google.com/        &quot;Google&quot;
[2]: http://search.yahoo.com/  &quot;Yahoo Search&quot;
[3]: http://search.msn.com/    &quot;MSN Search&quot;</pre>
<p>Using the implicit link name shortcut, you could instead write:</p>
<pre>I get 10 times more traffic from [Google][] than from
[Yahoo][] or [MSN][].

[google]: http://google.com/        &quot;Google&quot;
[yahoo]:  http://search.yahoo.com/  &quot;Yahoo Search&quot;
[msn]:    http://search.msn.com/    &quot;MSN Search&quot;</pre>
<p>Both of the above examples will produce the following HTML output:</p>
<pre>&lt;p&gt;I get 10 times more traffic from &lt;a href=&quot;http://google.com/&quot;
title=&quot;Google&quot;&gt;Google&lt;/a&gt; than from
&lt;a href=&quot;http://search.yahoo.com/&quot; title=&quot;Yahoo Search&quot;&gt;Yahoo&lt;/a&gt;
or &lt;a href=&quot;http://search.msn.com/&quot; title=&quot;MSN Search&quot;&gt;MSN&lt;/a&gt;.&lt;/p&gt;</pre>
<p>For comparison, here is the same paragraph written using Markdown’s inline link style:</p>
<pre>I get 10 times more traffic from [Google](http://google.com/ &quot;Google&quot;)
than from [Yahoo](http://search.yahoo.com/ &quot;Yahoo Search&quot;) or
[MSN](http://search.msn.com/ &quot;MSN Search&quot;).</pre>
<p>The point of reference-style links is not that they’re easier to write. The point is that with reference-style links, your document source is vastly more readable. Compare the above examples: using reference-style links, the paragraph itself is only 81 characters long; with inline-style links, it’s 176 characters; and as raw HTML, it’s 234 characters. In the raw HTML, there’s more markup than there is text.</p>
<p>With Markdown’s reference-style links, a source document much more closely resembles the final output, as rendered in a browser. By allowing you to move the markup-related metadata out of the paragraph, you can add links without interrupting the narrative flow of your prose.</p>
<p>EMPHASIS</p>
<p>Markdown treats asterisks (*) and underscores (_) as indicators of emphasis. Text wrapped with one * or _ will be wrapped with an HTML &lt;em&gt; tag; double *’s or _’s will be wrapped with an HTML &lt;strong&gt; tag. E.g., this input:</p>
<pre>*single asterisks*

_single underscores_

**double asterisks**

__double underscores__</pre>
<p>will produce:</p>
<pre>&lt;em&gt;single asterisks&lt;/em&gt;

&lt;em&gt;single underscores&lt;/em&gt;

&lt;strong&gt;double asterisks&lt;/strong&gt;

&lt;strong&gt;double underscores&lt;/strong&gt;</pre>
<p>You can use whichever style you prefer; the lone restriction is that the same character must be used to open and close an emphasis span.</p>
<p>Emphasis can be used in the middle of a word:</p>
<pre>un*frigging*believable</pre>
<p>But if you surround an * or _ with spaces, it’ll be treated as a literal asterisk or underscore.</p>
<p>To produce a literal asterisk or underscore at a position where it would otherwise be used as an emphasis delimiter, you can backslash escape it:</p>
<pre>\*this text is surrounded by literal asterisks\*</pre>
<p>CODE</p>
<p>To indicate a span of code, wrap it with backtick quotes (`). Unlike a pre-formatted code block, a code span indicates code within a normal paragraph. For example:</p>
<pre>Use the `printf()` function.</pre>
<p>will produce:</p>
<pre>&lt;p&gt;Use the &lt;code&gt;printf()&lt;/code&gt; function.&lt;/p&gt;</pre>
<p>To include a literal backtick character within a code span, you can use multiple backticks as the opening and closing delimiters:</p>
<pre>``There is a literal backtick (`) here.``</pre>
<p>which will produce this:</p>
<pre>&lt;p&gt;&lt;code&gt;There is a literal backtick (`) here.&lt;/code&gt;&lt;/p&gt;</pre>
<p>The backtick delimiters surrounding a code span may include spaces — one after the opening, one before the closing. This allows you to place literal backtick characters at the beginning or end of a code span:</p>
<pre>A single backtick in a code span: `` ` ``

A backtick-delimited string in a code span: `` `foo` ``</pre>
<p>will produce:</p>
<pre>&lt;p&gt;A single backtick in a code span: &lt;code&gt;`&lt;/code&gt;&lt;/p&gt;

&lt;p&gt;A backtick-delimited string in a code span: &lt;code&gt;`foo`&lt;/code&gt;&lt;/p&gt;</pre>
<p>With a code span, ampersands and angle brackets are encoded as HTML entities automatically, which makes it easy to include example HTML tags. Markdown will turn this:</p>
<pre>Please don't use any `&lt;blink&gt;` tags.</pre>
<p>into:</p>
<pre>&lt;p&gt;Please don't use any &lt;code&gt;&amp;lt;blink&amp;gt;&lt;/code&gt; tags.&lt;/p&gt;</pre>
<p>You can write this:</p>
<pre>`&amp;#8212;` is the decimal-encoded equivalent of `&amp;mdash;`.</pre>
<p>to produce:</p>
<pre>&lt;p&gt;&lt;code&gt;&amp;amp;#8212;&lt;/code&gt; is the decimal-encoded
equivalent of &lt;code&gt;&amp;amp;mdash;&lt;/code&gt;.&lt;/p&gt;</pre>
<p>IMAGES</p>
<p>Admittedly, it’s fairly difficult to devise a “natural” syntax for placing images into a plain text document format.</p>
<p>Markdown uses an image syntax that is intended to resemble the syntax for links, allowing for two styles: inline and reference.</p>
<p>Inline image syntax looks like this:</p>
<pre>![Alt text](/path/to/img.jpg)

![Alt text](/path/to/img.jpg &quot;Optional title&quot;)</pre>
<p>That is:</p>
<ul>
  <li>An exclamation mark: !;</li>
  <li>followed by a set of square brackets, containing the alt attribute text for the image;</li>
  <li>followed by a set of parentheses, containing the URL or path to the image, and an optional title attribute enclosed in double or single quotes.</li>
</ul>
<p>Reference-style image syntax looks like this:</p>
<pre>![Alt text][id]</pre>
<p>Where “id” is the name of a defined image reference. Image references are defined using syntax identical to link references:</p>
<pre>[id]: url/to/image  &quot;Optional title attribute&quot;</pre>
<p>As of this writing, Markdown has no syntax for specifying the dimensions of an image; if this is important to you, you can simply use regular HTML &lt;img&gt; tags.</p>
<p>MISCELLANEOUS</p>
<p>AUTOMATIC LINKS</p>
<p>Markdown supports a shortcut style for creating “automatic” links for URLs and email addresses: simply surround the URL or email address with angle brackets. What this means is that if you want to show the actual text of a URL or email address, and also have it be a clickable link, you can do this:</p>
<pre>&lt;http://example.com/&gt;</pre>
<p>Markdown will turn this into:</p>
<pre>&lt;a href=&quot;http://example.com/&quot;&gt;http://example.com/&lt;/a&gt;</pre>
<p>Automatic links for email addresses work similarly, except that Markdown will also perform a bit of randomized decimal and hex entity-encoding to help obscure your address from address-harvesting spambots. For example, Markdown will turn this:</p>
<pre>&lt;address@example.com&gt;</pre>
<p>into something like this:</p>
<pre>&lt;a href=&quot;&amp;#x6D;&amp;#x61;i&amp;#x6C;&amp;#x74;&amp;#x6F;:&amp;#x61;&amp;#x64;&amp;#x64;&amp;#x72;&amp;#x65;
&amp;#115;&amp;#115;&amp;#64;&amp;#101;&amp;#120;&amp;#x61;&amp;#109;&amp;#x70;&amp;#x6C;e&amp;#x2E;&amp;#99;&amp;#111;
&amp;#109;&quot;&gt;&amp;#x61;&amp;#x64;&amp;#x64;&amp;#x72;&amp;#x65;&amp;#115;&amp;#115;&amp;#64;&amp;#101;&amp;#120;&amp;#x61;
&amp;#109;&amp;#x70;&amp;#x6C;e&amp;#x2E;&amp;#99;&amp;#111;&amp;#109;&lt;/a&gt;</pre>
<p>which will render in a browser as a clickable link to “address@example.com”.</p>
<p>(This sort of entity-encoding trick will indeed fool many, if not most, address-harvesting bots, but it definitely won’t fool all of them. It’s better than nothing, but an address published in this way will probably eventually start receiving spam.)</p>
<p>BACKSLASH ESCAPES</p>
<p>Markdown allows you to use backslash escapes to generate literal characters which would otherwise have special meaning in Markdown’s formatting syntax. For example, if you wanted to surround a word with literal asterisks (instead of an HTML &lt;em&gt; tag), you can use backslashes before the asterisks, like this:</p>
<pre>\*literal asterisks\*</pre>
<p>Markdown provides backslash escapes for the following characters:</p>
<pre>\   backslash
`   backtick
*   asterisk
_   underscore
{}  curly braces
[]  square brackets
()  parentheses
#   hash mark
+   plus sign
-   minus sign (hyphen)
.   dot
!   exclamation mark</pre>
<p>Markdown:</p>
        <pre>If you want your page to validate under XHTML 1.0 Strict,
you've got to put paragraph tags in your blockquotes:

    &lt;blockquote&gt;
        &lt;p&gt;For example.&lt;/p&gt;
    &lt;/blockquote&gt;  </pre>
        <p>Output:</p>
        <pre>&lt;p&gt;If you want your page to validate under XHTML 1.0 Strict,
you've got to put paragraph tags in your blockquotes:&lt;/p&gt;

&lt;pre&gt;&lt;code&gt;&amp;lt;blockquote&amp;gt;
    &amp;lt;p&amp;gt;For example.&amp;lt;/p&amp;gt;
&amp;lt;/blockquote&amp;gt;
&lt;/code&gt;&lt;/pre&gt;  </pre>
        
    </div><!-- /modal-body -->
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal">Close</a>
    </div>
</div>