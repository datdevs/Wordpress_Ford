<?php

/**
 * Theme functions and definitions.
 * This child theme was generated by YITH Proteo.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/*
 * If your child theme has more than one .css file (eg. ie.css, style.css, main.css) then
 * you will have to make sure to maintain all of the parent theme dependencies.
 *
 * Make sure you're using the correct handle for loading the parent theme's styles.
 * Failure to use the proper tag will result in a CSS file needlessly being loaded twice.
 * This will usually not affect the site appearance, but it's inefficient and extends your page's loading time.
 *
 * @link https://codex.wordpress.org/Child_Themes
 */
function yithproteo_child_enqueue_styles()
{
  wp_enqueue_script('yith-proteo-themejs', get_stylesheet_directory_uri() . '/js/theme.min.js', array('jquery'), YITH_PROTEO_VERSION, true);
  wp_enqueue_script('bs-modal', get_stylesheet_directory_uri() . '/js/modal.min.js', array('jquery'), YITH_PROTEO_VERSION, true);
  wp_enqueue_style('yith-proteo-style', get_template_directory_uri() . '/style.css', array('select2'), YITH_PROTEO_VERSION);
  wp_enqueue_style('yith-proteo-responsive', get_template_directory_uri() . '/responsive.css', array('yith-proteo-style'), YITH_PROTEO_VERSION);
  wp_enqueue_style(
    'yith-proteo-child-style',
    get_stylesheet_directory_uri() . '/style.css',
    array('yith-proteo-style'),
    wp_get_theme()->get('Version')
  );
}

function yithproteo_child_dequeue_script()
{
  wp_dequeue_script('yith-proteo-modals-js');
  wp_deregister_script('yith-proteo-modals-js');
  wp_dequeue_style('yith-proteo-modals-css');
  wp_deregister_style('yith-proteo-modals-css');
}

add_action('wp_enqueue_scripts', 'yithproteo_child_enqueue_styles');
add_action('wp_enqueue_scripts', 'yithproteo_child_dequeue_script', 11);

function remove_yith_proteo_breadcrumbs()
{
  remove_action('woocommerce_single_product_summary', 'woocommerce_breadcrumb', 0);
  add_action('yith_proteo_before_page_content', 'wrap_woocommerce_breadcrumb', 0);
}

function wrap_woocommerce_breadcrumb()
{
  global $post;
  add_action('inner_woocommerce_breadcrumb', 'woocommerce_breadcrumb', 0);

  if (!is_front_page()) {
?>
    <div class="fnt-breadcrumbs">
      <?php if (is_shop() || is_product()) { ?>
        <div class="post-thumbnail">
          <?php echo get_the_post_thumbnail('7'); ?>
        </div>
      <?php } elseif (is_home() || is_single()) { ?>
        <div class="post-thumbnail">
          <?php echo get_the_post_thumbnail('703'); ?>
        </div>
      <?php } else { ?>
        <?php yith_proteo_post_thumbnail(); ?>
      <?php } ?>
      <div class="container d-flex align-items-center justify-content-md-center">
        <?php do_action('inner_woocommerce_breadcrumb'); ?>
      </div>
    </div>
  <?php
  }
}

add_action('template_redirect', 'remove_yith_proteo_breadcrumbs', 11);

add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
  return array(
    'width' => 150,
    'height' => 150,
    'crop' => 0,
  );
});

function add_script_fix_devgg()
{ ?>
  <script>
    (function() {
      var supportsPassive = eventListenerOptionsSupported();

      if (supportsPassive) {
        var addEvent = EventTarget.prototype.addEventListener;
        overwriteAddEvent(addEvent);
      }

      function overwriteAddEvent(superMethod) {
        var defaultOptions = {
          passive: true,
          capture: false
        };

        EventTarget.prototype.addEventListener = function(type, listener, options) {
          var usesListenerOptions = typeof options === 'object';
          var useCapture = usesListenerOptions ? options.capture : options;

          options = usesListenerOptions ? options : {};
          options.passive = options.passive !== undefined ? options.passive : defaultOptions.passive;
          options.capture = useCapture !== undefined ? useCapture : defaultOptions.capture;

          superMethod.call(this, type, listener, options);
        };
      }

      function eventListenerOptionsSupported() {
        var supported = false;
        try {
          var opts = Object.defineProperty({}, 'passive', {
            get: function() {
              supported = true;
            }
          });
          window.addEventListener("test", null, opts);
        } catch (e) {}

        return supported;
      }
    })();
  </script>
<?php }

add_action('wp_footer', 'add_script_fix_devgg');
