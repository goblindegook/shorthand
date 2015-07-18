# Shorthand

[![Packagist](https://img.shields.io/packagist/v/goblindegook/shorthand.svg)](https://packagist.org/packages/goblindegook/shorthand) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/goblindegook/shorthand/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/goblindegook/shorthand/?branch=master)

A bunch of shortcodes developed for my site, now offered to the public.  [Shortcake](https://github.com/fusioneng/Shortcake) is supported because, honestly, who doesn't love cake?

## Installation

This plugin is not (yet?) available in the repository, [Composer](https://getcomposer.org) is the recommended way to install it:

```bash
$ composer require goblindegook/shorthand
```

If you want to know more about using Composer with WordPress, there's [a good introduction at the Roots project site](https://roots.io/using-composer-with-wordpress/).

## Shortcodes

### Pull Quote

Renders a pull quote aside block with `pull-quote` and `pull-quote--<center|left|right>` classes.  Integrates with Shortcake.

**Usage:** `[pull-quote align="<center|left|right>"]CONTENT[/pull-quote]`

### Small Caps

Renders an inline element with a `small-caps` class.

**Usage:** `[small-caps]CONTENT[/small-caps]`

### Underline

Renders an inline element with an `underline` class.

**Usage:** `[u]CONTENT[/u]`

## Hooks

### Filter: `shorthand_styles_enabled`

Allows plugin and theme developers to turn off the stylesheet bundled with Shorthand.

The quickest way to accomplish this is calling `add_filter( 'shorthand_styles_enabled', '__return_false' );` at the `init` step.

It's up to developers to enqueue their own replacement styles for the frontend as well as Shortcake's live preview.

#### Parameters

`$enabled`
: _(boolean)_ Shorthand styles flag to filter (default is `true`).

### Filter: `shorthand_shortcode`

Allows plugin and theme developers to filter the output of a shortcode.

#### Parameters

`$output`
: _(string)_ Shortcode output to filter.

`$atts`
: _(array)_ Shortcode attributes.

`$content`
: _(string)_ Original inner content (for closing shortcodes).

`$tag`
: _(string)_ Shortcode tag.
