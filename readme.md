Harvard University

Computer Science S-15 - Dynamic Web applications

Project 4

Live URL: http://ciphersnippet-tarin.rhcloud.com/

Completed by: Tarin Poddar

email: tarinpoddar27@gmail.com

Harvard ID: 30946944

Title of Project: Cipher Snippet

Description: This is an app for developers to share and view regularly used code snippets to make their coding life easier. They won't have to recode the regularly used code. They could just find the code snippet and use it in their projects easily. 

Notes for the checker:

1. I have used a bootstrap CSS theme. Source: http://bootswatch.com/cosmo/

2. I have broken a few MVC principles at certain places in my views. The reason is, I couldn't find a way to concatenate strings in blade and after trying a lot of things, this was the last resort. Hence, just in a few places I have broken this rule.

3. I have also used a little bit of php in some of my views because when I was displaying the snippet, HTML wasn't showing the blank spaces (" " and "\n") appropriately. The user entered the snippet code and I am saving the snippet in my MySQL database in the text field category, however when displaying HTML didn't show it properly. Hence, in my view I had to run a str_replace function to include the blank spaces and \n, so that the HTML shows it.

4. Similar problem to the above one - When the user adds a snippet, if he uses tab to indent 4 spaces, the tab was taking the user to the next form field. I took help and fixed this using javascript. However, the tab space still doesn't show in the view of the snippet. I still don't know how to fix this.

5. I really wanted to show the snippet code beautifully with syntax highlighting and also found a few online links which I could use (eg. http://alexgorbatchev.com/SyntaxHighlighter/). 
However, I couldn't figure out how to use them. The snippets would have looked really really beautiful with the syntax coloured and highlighted. It would have looked like real code.

6. I really wanted to add a sticky footer, but after trying several times I was unsuccessful. The footer always came up and didn't stick to the bottom of the page. I still don't know the correct CSS for that.

7. Thank you! I really learnt a lot by making this project.
