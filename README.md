
# Verification grabber

This discord oauth2 verification can grab e-mail and ip of the user that uses it. It's all written in php & json.


## 1. Variables

To use this project, you will have to add some variables, in `config.php`

#### Bot informations **(required):**

`$client_id = "CLIENT_ID";`

`$secret_id = "SECRET_ID";`

`$bot_token = "BOT_TOKEN";`

#### Redirect & scopes **(required):**


`$scopes = "identify+email";` Please don't modify this or it won't work !

`$redirect_url = "https://VOTRESITE.COM/includes/login.php";` *here is your redirect URI, locate the login.php file in the /includes/ folder and add the location here.*

#### Server information **(optional):**

`$guild_id = "SERVER_ID";`

`$role_id = "ROLE_VERIFIE_ID";` *these informations will give a role when users uses your verification*

## 2. Setup your verification

Ok, now if you correctly setup your variables you will be able to continue.

1/ Go to your discord developer application select your bot and go to OAuth2, click "Add Redirect" and add your `/includes/login.php` URI

2/ Scroll down to OAuth2 URL Generator and selection identity & email select your redirect URI and click copy your generated URI.

3/ 

&nbsp;&nbsp;&nbsp;&nbsp;3.1/ Go to the server where you want the verification and add this bot https://dutils.shay.cat/bot.

&nbsp;&nbsp;&nbsp;&nbsp;3.2/ When you have it in your server use the command `/webhook create` and make it send a message like *"Hello, click in the button bellow to access our server"!* 

&nbsp;&nbsp;&nbsp;&nbsp;3.3 Now right click in the webhook's message > Applications > Add Button > Link. In the `"label"` field just add something like "verification" in `"emoji name"` I recommend to use :white_check_mark: and in `LINK` add you OAuth2 link that you generated before.

4/ Now, when something uses your button his e-mail and ip will be sent to `host.com/results/`!

## Use the api

you can use https://host.com/api/v1/api.php?id=ID_VERIFIED_USER to get informations with a bot.


## Credits



Thanks to MarkisDev (https://github.com/MarkisDev) for his incredible discord OAuth2 login flow

## Contact 

Discord: lkcw (1220845503806177353)
