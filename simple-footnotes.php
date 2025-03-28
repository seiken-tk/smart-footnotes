<?php
/**
 * Plugin Name: Simple Footnotes
 * Plugin URI: https://seiken.tk/wp-plugin/simple-footnotes
 * Description: WordPressの投稿に脚注を簡単に追加できるプラグインです。ショートコードを使用して脚注を追加し、自動的に番号付けされた脚注を記事の末尾に表示します。ホバーで脚注内容の確認や、クリックでの移動にも対応しています。
 * Version: 1.0.0
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Author: Seiken TAKAMATSU
 * Author URI: https://seiken.tk
 * Text Domain: simple-footnotes
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit;
}

class Simple_Footnotes {
    private static $instance = null;
    private $footnotes = array();
    private $footnote_count = 0;

    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function __construct() {
        add_action('init', array($this, 'init'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('admin_menu', array($this, 'add_admin_menu'));
        add_action('admin_init', array($this, 'register_settings'));
        add_shortcode('sfnote', array($this, 'footnote_shortcode'));
        add_filter('the_content', array($this, 'append_footnotes'), 999);
    }

    public function init() {
        load_plugin_textdomain('simple-footnotes', false, dirname(plugin_basename(__FILE__)) . '/languages');
        
        // デフォルト設定の登録
        if (false === get_option('simple_footnotes_return_text')) {
            update_option('simple_footnotes_return_text', '↩');
        }
        if (false === get_option('simple_footnotes_popup_style')) {
            update_option('simple_footnotes_popup_style', 'popup1');
        }
        if (false === get_option('simple_footnotes_heading')) {
            update_option('simple_footnotes_heading', __('脚注', 'simple-footnotes'));
        }
    }

    public function enqueue_scripts() {
        wp_enqueue_style(
            'simple-footnotes',
            plugins_url('css/simple-footnotes.css', __FILE__),
            array(),
            '1.0.0'
        );

        wp_enqueue_script(
            'simple-footnotes',
            plugins_url('js/simple-footnotes.js', __FILE__),
            array('jquery'),
            '1.0.0',
            true
        );

        // CSSクラスをJSに渡す
        wp_localize_script('simple-footnotes', 'simpleFootnotesSettings', array(
            'popupStyle' => get_option('simple_footnotes_popup_style', 'popup1')
        ));
    }

    public function footnote_shortcode($atts, $content = null) {
        $this->footnote_count++;
        $footnote_id = 'footnote-' . $this->footnote_count;
        $this->footnotes[$this->footnote_count] = array(
            'content' => $content,
            'id' => $footnote_id
        );

        $style = get_option('simple_footnotes_style', 'style1');
        $popup_style = get_option('simple_footnotes_popup_style', 'popup1');
        $html = sprintf(
            '<sup class="simple-footnotes-ref %s %s" id="ref-%s" data-footnote="%s">[%d]</sup>',
            esc_attr($style),
            esc_attr($popup_style),
            esc_attr($footnote_id),
            esc_attr($content),
            $this->footnote_count
        );

        return $html;
    }

    public function append_footnotes($content) {
        if (empty($this->footnotes) || !get_option('simple_footnotes_show_list', true)) {
            return $content;
        }

        $return_text = get_option('simple_footnotes_return_text', '↩');
        $footnotes_html = '<div class="simple-footnotes-list">';
        $footnotes_html .= '<h4>' . esc_html(get_option('simple_footnotes_heading', __('脚注', 'simple-footnotes'))) . '</h4>';
        $footnotes_html .= '<ol>';

        foreach ($this->footnotes as $num => $footnote) {
            $footnotes_html .= sprintf(
                '<li id="%s">%s <a href="#ref-%s" class="footnote-return" title="%s">%s</a></li>',
                esc_attr($footnote['id']),
                wp_kses_post($footnote['content']),
                esc_attr($footnote['id']),
                esc_attr__('元の位置に戻る', 'simple-footnotes'),
                esc_html($return_text)
            );
        }

        $footnotes_html .= '</ol></div>';

        return $content . $footnotes_html;
    }

    public function add_admin_menu() {
        add_options_page(
            __('Simple Footnotes Settings', 'simple-footnotes'),
            __('Simple Footnotes', 'simple-footnotes'),
            'manage_options',
            'simple-footnotes',
            array($this, 'render_settings_page')
        );
    }

    public function register_settings() {
        register_setting('simple_footnotes_options', 'simple_footnotes_style');
        register_setting('simple_footnotes_options', 'simple_footnotes_popup_style');
        register_setting('simple_footnotes_options', 'simple_footnotes_custom_css');
        register_setting('simple_footnotes_options', 'simple_footnotes_show_list');
        register_setting('simple_footnotes_options', 'simple_footnotes_return_text');
        register_setting('simple_footnotes_options', 'simple_footnotes_heading');
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        require_once plugin_dir_path(__FILE__) . 'admin/settings.php';
    }
}

// Initialize the plugin
Simple_Footnotes::get_instance();