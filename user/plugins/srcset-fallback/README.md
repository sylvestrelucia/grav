# Grav Srcset Fallback Plugin

`srcset fallback` is a simple [Grav](http://github.com/getgrav/grav) plugin that adds **srcset attribute** support to older browsers via the Filament Group polyfill [Picturefill](http://scottjehl.github.io/picturefill/).

# Installation

Installing the Srcset Fallback plugin can be done in one of two ways. Our GPM (Grav Package Manager) installation method enables you to quickly and easily install the plugin with a simple terminal command, while the manual method enables you to do so via a zip file.

## GPM Installation (Preferred)

The simplest way to install this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm) through your system's Terminal (also called the command line).  From the root of your Grav install type:

    bin/gpm install srcset-fallback

This will install the Srcset Fallback plugin into your `/user/plugins` directory within Grav. Its files can be found under `/your/site/grav/user/plugins/srcset-fallback`.

## Manual Installation

To install this plugin, just download the zip version of this repository and unzip it under `/your/site/grav/user/plugins`. Then, rename the folder to `srcset-fallback`. You can find these files either on [GitHub](https://github.com/Gertt/grav-plugin-srcset-fallback) or via [GetGrav.org](http://getgrav.org/downloads/plugins#extras).

You should now have all the plugin files under

    /your/site/grav/user/plugins/srcset-fallback

>> NOTE: This plugin is a modular component for Grav which requires [Grav](http://github.com/getgrav/grav) to function

# Usage

All you need to do is enable this plugin for it to start working. The Picturefill JavaScript library will take care of the rest automatically. To learn more about Picturefill, you can go to its [website](http://scottjehl.github.io/picturefill/).

Because Picturefill is written in JavaScript, older browsers that do not support the `srcset` attribute, will already have downloaded your fallback image ( the one Grav places in `src` attribute ) before Picturefill can teach the browser about `srcset`, this might result in two images being requested from the server instead of one. To solve this problem, this plugin has an active mode that manipulates the HTML output of Grav to make sure only one image needs to be requested. Set the `mode` configuration option to **active** to enable this behaviour. Default is **passive** mode which does not apply this behaviour.

You can do this configuration in the plugin's configuration.  Simply copy the `user/plugins/srcset-fallback/srcset-fallback.yaml` into `user/config/plugins/srcset-fallback.yaml` and make your modifications.

```
enabled: true                 # global enable/disable the entire plugin
mode: passive                 # 'inactive' disables, 'passive' includes only Picturefill, 'active' optimizes HTML markup to prevent double image downloads
```

The setting can be done on a page level by adding it in the header under `srcset-fallback`, i.e.

```
title: My Page
srcset-fallback:
  mode: passive                 # 'inactive' disables, 'passive' includes only Picturefill, 'active' optimizes HTML markup to prevent double image downloads
```

# Updating

As development for the Srcset Fallback plugin continues, new versions may become available that add additional features and functionality, improve compatibility with newer Grav releases, and generally provide a better user experience. Updating Srcset Fallback is easy, and can be done through Grav's GPM system, as well as manually.

## GPM Update (Preferred)

The simplest way to update this plugin is via the [Grav Package Manager (GPM)](http://learn.getgrav.org/advanced/grav-gpm). You can do this with this by navigating to the root directory of your Grav install using your system's Terminal (also called command line) and typing the following:

    bin/gpm update srcset-fallback

This command will check your Grav install to see if your Srcset Fallback plugin is due for an update. If a newer release is found, you will be asked whether or not you wish to update. To continue, type `y` and hit enter. The plugin will automatically update and clear Grav's cache.

## Manual Update

Manually updating Srcset Fallback is pretty simple. Here is what you will need to do to get this done:

* Delete the `your/site/user/plugins/srcset-fallback` directory.
* Download the new version of the Srcset Fallback plugin from either [GitHub](https://github.com/Gertt/grav-plugin-srcset-fallback) or [GetGrav.org](http://getgrav.org/downloads/plugins#extras).
* Unzip the zip file in `your/site/user/plugins` and rename the resulting folder to `srcset-fallback`.
* Clear the Grav cache. The simplest way to do this is by going to the root Grav directory in terminal and typing `bin/grav clear-cache`.

> Note: Any changes you have made to any of the files listed under this directory will also be removed and replaced by the new set. Any files located elsewhere (for example a YAML settings file placed in `user/config/plugins`) will remain intact.
