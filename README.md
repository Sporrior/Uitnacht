=== Uitnacht Information & Location Manager ===
Contributors: Ahmad Mahouk, Damien Engelen, Sintayu de Kuiper, Wessam Naj  
Tags: events, location, maps, uitnacht, google maps, leaflet, event management  
Requires at least: 5.0  
Tested up to: 6.3  
Stable tag: 1.0.0  
Requires PHP: 7.4  
License: GPLv2 or later  
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A powerful event management plugin for Uitnacht, allowing you to add, display, and manage locations, events, and maps in a user-friendly way.

== Description ==

The **Uitnacht Information & Location Manager** plugin is designed to streamline the process of managing and displaying events for Uitnacht. This plugin integrates seamlessly into the WordPress dashboard, enabling event organizers to add, edit, and delete event locations while offering an interactive map view for visitors.

**Key Features**:
* Manage multiple event locations with ease.
* Display events and locations on an interactive map using Leaflet.js or Google Maps.
* Provide detailed information about each event, including name, date, time, description, and location.
* Search functionality to filter events.
* Simple and clean admin interface.
* Shortcode support for embedding location maps on pages or posts.
* Bulk actions to remove multiple locations.
* Localization ready (text domain included).

This plugin is ideal for anyone managing multiple event locations and wishing to provide an intuitive way for users to find events on a map.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/uitnacht` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Use the **Uitnacht Dashboard** to start adding and managing event locations.
4. Embed your map on any page using the `[uitnacht_location_map]` shortcode.

== Frequently Asked Questions ==

= How do I add a new event location? =

Simply go to the **Uitnacht Dashboard** in the WordPress admin panel, fill out the details of your event (name, address, date, time, description), and the plugin will automatically geocode the address and display it on the map.

= Can I use Google Maps instead of Leaflet.js for the maps? =

At this time, the plugin uses Leaflet.js for embedding maps using OpenStreetMap tiles, but it can be extended to support Google Maps via custom development.

= How do I display the map with event locations on a page? =

You can display the map by using the shortcode `[uitnacht_location_map]` on any page or post. This will display all the locations you’ve added.

= How do I delete all event locations? =

You can go to the **Uitnacht Dashboard** and click the "Verwijder Alle Locaties" button to remove all event locations at once.

== Screenshots ==

1. **Admin Dashboard**: The admin interface where event locations are added and managed.
2. **Map View**: Interactive map displaying multiple event locations.
3. **Event Details**: Example of the event details that can be viewed on the map popups.
4. **Event List**: View of all events and their associated actions (edit, delete).

== Changelog ==

= 1.0.0 =
* Initial release of the Uitnacht Information & Location Manager plugin.
* Basic event management functionality.
* Integrated Leaflet.js for interactive maps.
* Shortcode to display map and event locations.

== Upgrade Notice ==

= 1.0.0 =
First stable release of the plugin. No upgrade necessary.
