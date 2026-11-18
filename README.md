# Rock River Core

Site plugin for Rock River Outfitters, my client for Content Management Systems 2. It holds the custom content so it stays put even if the site changes themes.

## What it registers

- The trip post type. It shows up as Trips in the dashboard with a map icon, and the archive uses the trips slug.
- The difficulty taxonomy for trips, with Beginner, Intermediate and Advanced.
- Nine custom fields on each trip: launch_site, takeout_site, distance_miles, paddle_time, price, min_age, start_times, season and is_guided.

## Extras

- The single-trip and archive-trip templates in my child theme show the fields with block bindings. This plugin adds the dollar sign to the price and the words around distance and age, and it turns is_guided into Guided trip or Self-guided with shuttle.
- The Trips archive and the difficulty pages list the shortest trips first, using distance_miles.

Made by Travis Vogel for Week 4.
