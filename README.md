# SMPLFY Spinning Animation

WordPress plugin that adds a `[spinning_animation]` shortcode: a CSS-only loading spinner that cycles through the Simplify Biz brand colors (blue, green, yellow, red).

## Install

1. Download `smplfy-loading-spinning-animation.zip` from the [latest release](https://github.com/sblik/smplfy-loading-spinning-animation/releases/latest). Use the attached zip, not "Source code (zip)".
2. Plugins > Add New > Upload Plugin > Activate.

Sites check this repo for new releases and update themselves. Enable auto-updates on the plugin row to skip the click.

## Use

In a page or post:

```
[spinning_animation]
```

The spinner is removed automatically when the page finishes loading.

### Attributes

| Attribute | Default | What it does |
|-----------|---------|--------------|
| `size`    | `40`    | Width and height in px. |
| `color`   | brand cycle | One color (`color="red"`) or a comma list (`color="#012184, #22c55e"`) that replaces the brand cycle. |
| `persist` | `0`     | `persist="1"` keeps the spinner after page load. Your own code removes it. |

```
[spinning_animation size="60"]
[spinning_animation color="red"]
[spinning_animation size="24" persist="1"]
```

### From PHP (themes, other plugins)

```php
echo do_shortcode( '[spinning_animation size="24"]' );
```

### While a request is running

Render it with `persist="1"`, keep it hidden, then show and remove it around the request:

```php
echo '<div id="status" hidden>' . do_shortcode( '[spinning_animation persist="1" size="24"]' ) . ' Working...</div>';
```

```js
status.hidden = false;
await fetch( ... );
status.remove();
```

The markup is a single `<div class="smplfy-spinner">`, so `status.innerHTML = spinnerHtml + ' Working...'` also works.

## Release a new version

1. Bump `Version:` in `loading_spinning_animation.php`.
2. `git tag X.Y && git push origin main --tags`
3. Publish a GitHub release for the tag and attach the zip:
   `git archive --format=zip --prefix=smplfy-loading-spinning-animation/ -o smplfy-loading-spinning-animation.zip X.Y`

Sites see the release within 12 hours, or immediately via "Check for updates" on the plugin row.
