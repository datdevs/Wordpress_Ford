<?php

/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'vuj_autoford' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', 'root' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ' e1jfOOaTHtRpp=ckd1]YC0U00r~G2fnNf]=os)cp^-Y}laE]a1;b-=_o^Iu f7k' );
define( 'SECURE_AUTH_KEY',  'n]u[%gGlQ<`.:$(K[k9.fyzYD]efgTh%~J<b P&G{>mKAPf/sY*>st?kYwb8{!/<' );
define( 'LOGGED_IN_KEY',    'Kv(}*6hOdS</~x!J:sX1^SifQPao2t.2E#~Yrj0WMS4 6w8x]`_aQs@,bYB[t{bk' );
define( 'NONCE_KEY',        '!f,II,`9F-8n;rTRik.E4sq~.$p/|gA_,S><?~g}$>+^{0[=H1W=N@y_z3lo?zfR' );
define( 'AUTH_SALT',        '{#pOXAviNXABNjfCf$/XD!`_MG@HL/>pot|n9i:.5Lzf-c(f:9NBbK5]!+w6;EMH' );
define( 'SECURE_AUTH_SALT', 'Jmq`=WU!)aeU4wGxGJb=1MiddGE{4cKe@hJ Sl)5&FZz{Z3i GHIPK-( >4/oU`x' );
define( 'LOGGED_IN_SALT',   '1THS)-eo+7xw+S9V[95yYL/U!&{Fn<V8Sb/oGYihmsB(f?3h-,4Q=(ztE A-SC8<' );
define( 'NONCE_SALT',       'Y6#mM[m^Uw3hH? ^$+VlHcT)#}q~ml%18t)v3&tW/f7[UE[F/Z0`}C~y:HKSoz3R' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'vuj_';

/**
 * Vô hiệu hóa cập nhật tự động WP core
 */
define( 'WP_AUTO_UPDATE_CORE', false );

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');

/**
 * Tắt thông báo cập nhật Plugins
 */
function disable_plugin_updates( $value ) {
  if ( isset($value) && is_object($value) ) {
    if ( isset( $value->response['wp-schema-pro/wp-schema-pro.php'] ) ) {
      unset( $value->response['wp-schema-pro/wp-schema-pro.php'] );
    }
		if ( isset( $value->response['wordpress-seo/wp-seo.php'] ) ) {
      unset( $value->response['wordpress-seo/wp-seo.php'] );
    }
    if ( isset( $value->response['woocommerce-products-filter/index.php'] ) ) {
      unset( $value->response['woocommerce-products-filter/index.php'] );
    }
    if ( isset( $value->response['woo-product-gallery-slider/woo-product-gallery-slider.php'] ) ) {
      unset( $value->response['woo-product-gallery-slider/woo-product-gallery-slider.php'] );
    }
  }
  return $value;
}

add_filter( 'site_transient_update_plugins', 'disable_plugin_updates' );
