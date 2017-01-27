### Challenge project

##### installation
* mkdir <folder_name>
* cd <folder_name>
* git clone --bare <repo_url> .git
* git config --bool core.bare false
* git reset --hard
* set database details into .env.ini
* composer dump-autoload
* open page into favorite browser

##### features

for now implemented everything from task list
also included different error messages for example:
* login or password not set in login form
* password set incorrect
* and so on. This is just leaved for better error handling and status messages that must be finished and better with js...