# HMS Events
All notable changes to this project will be documented in this file.

# Getting Started
This plugin requires the use of Advanced Custom Fields and ACF to Rest plugins. Eventaully fields will be built into the plugin.

#Change Log

## 0.0.41
- Fixed html tags in callback.


## 0.0.4
- Added header Rich Text.
- Added notification if no events are found.
- Refactored fields.php so that fields can be displayed in the child theme independently.

## 0.0.32
- Added additional information fields for address and contact information.
- Setup schema.
- Added additional display options to Event Post Block.
- Modified display on singular and archive event posts.

## 0.0.31
- Added conditional for query if $attributes['categories'] == null
- Re-tested block.

## 0.0.3 
- Fixed posts non displaying on front end. 
- Fixed taxonomy dropdown in the Events Feed Block.

## 0.0.2
- Added events-cpt.php to register post types from the block.
- Updated various files.
- Refactored plugin.
- Fixed taxonomy bug.
- Added ACF fields to plugin to reduce setup time.
- Modified $content on the archive and singlular post to display event start and event end times.

## 0.0.1
- Working version of plugin. 
- Testing Events Custom Post Type block.

### Bugs
- Events posts feed does not show up correctly in the editor. The front end does display correctly.
