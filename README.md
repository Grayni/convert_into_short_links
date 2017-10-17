## Convert long links in short  
***
#### Description: 
      Service build with bootstrap v4.0.0-beta, PHP language and db mySQL.  
      The module convert long links into short links.
***

#### What was used and involved:
1. **Gulp and node librarys**  
    For build and minify project.

2. **Bootstrap v4.0.0-beta**  
    For designe and build grid.  

3. **JQuery, javaScript, Ajax**
    For interaction with user and frontend-validation form.  
    Also Ajax was involved for interaction with php.  

4. **PHP and Mysql**  
    Core of project. All logic and work with server - php.  
    PHP also used for validation form on side the server.  
    Mysql for write links from users.  

    PHP and Mysql together generate new short links.  
    Was used math function _base\_convert()_ for conversion 10-number system  
    in max possibe number system - 36, used only function PHP and Mysql.  

    For Mysql can use function for string conv().  
    Different in this functions: _base\_convert()_ - used only small letters,  
    _conv()_ - only big. For extension functional project can combine  
    this functions for create yet more variants strings.

5. **Class idna_convert (php)**
    Idna used for correctly check foreign domain consisting out not latin world.  
    For example, russian domain _домены.рф_ consist out cyrillic symbols.  
    For correctly check on 404 error and exist need to apply this class.  
***

#### For view and use visit:
### [links.grayni.ru](http://links.grayni.ru)
***
### Status: in test mode



