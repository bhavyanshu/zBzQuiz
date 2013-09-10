#HELP DOCUMENT     
       
zBzApp Manual by:         
Bhavyanshu Parasher                   
Chander Khaneja                                           
© 2013                           

##Table Of Contents

    1.LICENCE
    2.Preface
    3.Getting Started
    4.Installation and Configuration
        4.1.General Installation Considerations
        4.2.Installation on *nix systems
        4.3.Installation on Mac OS X
        4.4.Installation on Windows systems
    5.Hacking the source code
    6.Security
        6.1.Introduction
        6.2.Database Security
        6.3.Filesystem Security
    7.Features
        7.1.User Authentication & Roles
	7.2 Password Hashing — Safe Password Hashing
        7.3.Advanced User Interface for Managing Tests
	7.4.Realtime User Interface for Search
	7.5.Responsive Layout
	7.6.Timer interactivity with UI.  
    8.FAQ: Frequently Asked Questions
        8.1.General Information
        8.2.Mailing lists
        8.3.Obtaining PHP
        8.4.Database issues
        8.5.Installation
    9.Appendices
        9.1.Apache License 2.0
        9.2.Changelog

###LICENSE

> Copyright 2013 Bhavyanshu Parasher (http://bhavyanshu.github.io) & Chander Khaneja.

> Licensed under the Apache License, Version 2.0 (the "License"); you
may not use this project except in compliance with the License. You 
may obtain a copy of the License at 
> http://www.apache.org/licenses/LICENSE-2.0.

>Unless required by applicable law or agreed to in writing, software 
distributed under the License is distributed on an "AS IS" BASIS, 
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or 
implied. See the License for the specific language governing 
permissions and limitations under the License.


###Preface

zBzQuiz is responsive, fresh, modern, bold and completely free web application used for hosting MCQ quizes in schools, colleges and other educational institutes. Its back-end code is written in php and is very well documented. It's easy to install and runs perfectly well on most modern browsers.


###Getting Started

This is for the people who don't wish to go into details and just get on with setting up the app on their own server to host quizes.

###Installation and Configuration

1. Download and install xampp(windows)/lampp(linux)/mampp(Mac OS) to get php, mysql and apache server running on your system.
2. Move the zbzapp folder to the htdocs (Usually in C://windows/xampp) folder. (or /opt/lampp/htdocs in linux).
3. The folder "Setup Utils" contains the zbzapp_main.sql file so that you can import it via your phpmyadmin. (will be updated accordingly as the development progresses). 
4. Now you can enjoy the service. It is simple. It just takes 5 minutes to set up the app.

###Hacking the source code

The source code is written in php mainly. All the core modules are in php. Interface is provided by html and css. JQuery is used to provide client side support. Ajax is used for displaying real time changes via php. So in order to build your own custom modules for this app, you simply can hack into the source code if you know above languages. We are not using any MVC for this. We have developed it from scratch. We won't be using MVC model for this particular web application. 

###Security

####Introduction    

The web application is very secure. We have used the best of php in making it secure. We know nothing is completely secure and keeping this in mind we accept any pull requests regarding the security of the application because it is our top priority.              

1. Database Security: We are using the object oriented approach using the PDO classes. PDO provides us with prepared statements that enhance the security of the web application. It is latest and we do not need to modify the code for using the application with a different database driver. PDO is a little more intuitive, and it feels more truly object oriented whereas mysqli feels like it is just a procedural API that has been objectified. PDO moreover helps in preventing sqlinjections because PDO::quote() places quotes around the input string and escapes special characters within the input string, using a quoting style appropriate to the underlying database driver.                      

2. Filesystem Security: Direct access to all the module files has been restricted the file system structure is kept pretty simple and understandable. The directories have been properly indexed and does not allow methods to directly crawl the files without having authentication parameters verified. 

