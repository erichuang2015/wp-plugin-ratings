# WP RATINGS - A small Wordpress plugin

> A small plugin which allows to create ratings with a small and simple frontend which can be used via shortcode [wp-rating]


## Necessary preparations
All you need is a running Wordpress instance. [Here](https://wordpress.org/download/) you could get the latest version of WP. <br>
At the time I wrote this plugin I used WP 5.3.2.


## Setup
You have to clone this project to your `WordpressDocRoot/wp-content/plugins` folder. After this you have to login as admin to your backend area. <br>
Go to **Plugins** and activate our new Plugin called ***WP Ratings***.


## Usage
After activating our plugin you can see a new top level menu entry called `Ratings`. In this "section" you could create your ratings. In each rating you can find your shortcode, with which you can embed it to one or more of your pages. just copy this shortcode where you wann place it.


## Structure with short explanation
I decided to get a simple and flat ordner structure.<br>
So we have just typical basic stuff like README and LICENSE and than 3 folders and the main.php file.<br>
<br>
*A bit more detailed*:
<br><br>
**wp-plugin-ratings.php** <br>
The "main" PHP file where I include all the other php files.
<br><br>
**admin (directory)** <br>
Here you can find all backend/admin specific styles and scripts.
<br><br>
**public (directory)** <br>
As you allready thought, here you can find all relevant frontend relevant styles and scripts.
<br><br>
**includes (directory)** <br>
Here we have all other PHP files, like the one which includes our scripts, creates the post-type, ...


## PHP files (includes)
Here I try to give a short explanation about the "magic" in each PHP file, so if you need to adapt it, you know where to start (even if I tried to name them right).
<br><br>
**meta-box.php** <br>
Here we have our optical representation for each rating in our backend.
<br><br>
**post-type.php** <br>
The registration of our `wp-ratings` post-type. For Example here yu could adapt the labels of our post type.
<br><br>
**scripts.php** <br>
Here we just include all our scripts for backend and frontend.
<br><br>
**shortcodes.php** <br>
"The frontend handling" of our plugin. Here we register our shortcode called `[wp-rating]` to show a specific post in pur frontend. Also we have our whole frontend here. To use it you ned the shortcode from the rating you created in the backend which should look something like `[wp-rating id="13"]`.

## Issues / Questions
You found a bug, have a new feature, an idea, an improvement, ... please write an [issue](https://github.com/R4xx4r/wp-plugin-ratings/issues)
