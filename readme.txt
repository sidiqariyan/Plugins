=== CF7 Restriction Plugin ===
Contributors: Ariyan Sidiq
Tags: contact form 7, form restriction, submission limit, form validation, spam prevention
Requires at least: 5.0
Tested up to: 6.2
Requires PHP: 7.2
Stable tag: 1.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

== Description ==
CF7 Restriction Plugin prevents users from submitting the Contact Form 7 form more than once every hour. This plugin enhances user experience and helps in preventing spam by ensuring that forms are not abused.

== Installation ==
1. Upload the `cf7-restriction-plugin` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Ensure you have the Contact Form 7 and CFDB7 (Contact Form 7 Database) plugins installed and activated.
4. The plugin is now ready to use and will automatically restrict form submissions to once per hour per user based on their email address.

== Usage ==
1. Create or edit your Contact Form 7 form and include the email field.
2. When a user submits the form, the plugin will check the last submission time.
3. If the last submission was within the last hour, the form submission will be blocked, and the user will be notified.

== Changelog ==
= 1.0 =
* Initial release.

== Frequently Asked Questions ==

= How does the plugin restrict form submissions? =
The plugin uses a combination of JavaScript and server-side PHP code to check the timestamp of the user's last form submission. If the last submission was made within the past hour, the form submission is blocked.

= Do I need to configure anything after installation? =
No additional configuration is required. Just ensure that you have the Contact Form 7 and CFDB7 plugins installed and activated.

= Can the restriction time be customized? =
In the current version, the restriction is set to one hour. Customization requires modifying the plugin code.

== License ==
This plugin is licensed under the GPLv2 or later.

== Screenshots ==
1. Plugin activated and working seamlessly with Contact Form 7.
