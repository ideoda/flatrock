my history:
- finding an operatable boilerplate: symfony 4 + docker + mysql + xdebug
- integrate mysql service: issues with connection: docker container interference bug (no signs for this at all: evil)
- integrate xdebug
- intalling encore: issues, installing by symfony docs, found a bug
- building symfony controllers+twig: homepage+quiz
- first push to git repo, gitignore settings
- integrate encore by another way: succeeded
- issues with admin login: symfony make auth command drives me to a bug - no resolution found
- integrate jQuery, timer
- 10 hours passed
- working with symfony authenticator, making user+auth: AnnotationDriver is missing bug again https://serveanswer.com/questions/getting-error-annotationdriver-does-not-exist-on-fresh-symfony-project
- added good or bad answer indication

extra notes:
- no translation used in strings (nor in php, nor in twig): it was faster
- the fliptimer jquery plugin is not an npm, it has been downloaded to the assets folder: it was faster
- commits are big, and contains more than one operation: it was faster
- at the quiz, enter keypress submits all the form - should apply something like event.preventDefault()
- you can submit a quiz without giving any answer - should not be able to do this
- the timer makes an alert when time is up, closing the alert makes the quiz be restarted... not working as in the description
- the good or bad answer text is handled by an ajax request, its an issue: anyone can evaluate a question who realises this url

admin feature is not implemented:
- I went into this two times but I had an issue with symfony make:... commands, so I couldnt create the whole user auth system.
- Thats why I gave up it because I not have time to create it by hand
- The admin question crud is also not implemented, because it consumes more time, but technically its not more complicated than I have done on the quiz. we can discuss how I would make it.
