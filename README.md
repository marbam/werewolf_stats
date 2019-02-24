# Bristol Werewolf Analysis and Statistics
A laravel based package to be used by the Bristol Werewolf group. Concept to start with.<br>
Allows the entry of certain details per game<br>
Allows analysis of each role/faction and their win/loss and survival ratio over time via Google charts plugin. <br><br>

Requires a handful of .env variables set for the php artisan migrate function to run:<br>
ADMIN_EMAIL<br>
ADMIN_PASSWORD<br>
APPROVED_EMAIL<br>
APPROVED_PASSWORD<br>
UNAPPROVED_EMAIL<br>
UNAPPROVED_PASSWORD<br>
The migrate process will block you if these are not populated.
