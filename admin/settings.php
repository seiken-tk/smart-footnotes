<?php
// プラグインのCSSとJSを管理画面にも読み込む
wp_enqueue_style('wp-footnote', plugins_url('../css/wp-footnote.css', __FILE__));
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="wp-footnote-usage">
        <h2><?php esc_html_e('使い方', 'wp-footnote'); ?></h2>
        <div class="usage-content">
            <h3><?php esc_html_e('1. 脚注の追加', 'wp-footnote'); ?></h3>
            <p><?php esc_html_e('投稿エディタで以下のようにショートコードを使用します：', 'wp-footnote'); ?></p>
            <pre>[wpnote]ここに脚注の内容を入力します。[/wpnote]</pre>
            
            <h3><?php esc_html_e('2. 脚注の表示', 'wp-footnote'); ?></h3>
            <ul>
                <li><?php esc_html_e('脚注は自動的に番号付けされ、記事内の該当箇所に表示されます。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('脚注番号にマウスを重ねると、脚注の内容がポップアップ表示されます。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('脚注番号をクリックすると、記事末尾の脚注一覧の該当箇所にスクロールします。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('脚注一覧の戻るボタンをクリックすると、元の位置に戻ります。', 'wp-footnote'); ?></li>
            </ul>

            <h3><?php esc_html_e('3. カスタマイズ', 'wp-footnote'); ?></h3>
            <ul>
                <li><?php esc_html_e('下記の設定から、お好みの脚注スタイルとポップアップスタイルを選択できます。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('カスタムCSSを使用して、独自のスタイルを適用することもできます。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('脚注一覧の表示/非表示を切り替えることができます。', 'wp-footnote'); ?></li>
                <li><?php esc_html_e('脚注一覧の戻るボタンの文字列を変更できます。', 'wp-footnote'); ?></li>
            </ul>
        </div>
    </div>

    <form action="options.php" method="post">
        <?php
        settings_fields('wp_footnote_options');
        do_settings_sections('wp_footnote_options');
        ?>

        <table class="form-table">
            <tr>
                <th scope="row"><?php esc_html_e('脚注スタイル', 'wp-footnote'); ?></th>
                <td>
                    <select name="wp_footnote_style" id="wp_footnote_style">
                        <?php
                        $current_style = get_option('wp_footnote_style', 'style1');
                        $styles = array(
                            'style1' => __('デフォルト（シンプル）', 'wp-footnote'),
                            'style2' => __('角丸グレー', 'wp-footnote'),
                            'style3' => __('ブラックスクエア', 'wp-footnote'),
                            'style4' => __('ミニマル細字', 'wp-footnote'),
                            'style5' => __('黒枠グレー太字', 'wp-footnote'),
                            'style6' => __('ピンク白抜き', 'wp-footnote'),
                            'style7' => __('水色', 'wp-footnote'),
                            'style8' => __('紺', 'wp-footnote'),
                            'style9' => __('イエロー', 'wp-footnote'),
                            'style10' => __('シンプルパープル', 'wp-footnote'),
                            'style11' => __('フラット（マット）', 'wp-footnote'),
                            'style12' => __('ピンクグラデーション', 'wp-footnote'),
                            'style13' => __('ブルーライン（下線）', 'wp-footnote'),
                            'style14' => __('緑ボタン', 'wp-footnote'),
                            'style15' => __('ネオン（光彩）', 'wp-footnote'),
                        );
                        foreach ($styles as $value => $label) {
                            printf(
                                '<option value="%s" %s>%s</option>',
                                esc_attr($value),
                                selected($current_style, $value, false),
                                esc_html($label)
                            );
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('ポップアップスタイル', 'wp-footnote'); ?></th>
                <td>
                    <select name="wp_footnote_popup_style" id="wp_footnote_popup_style">
                        <?php
                        $current_popup_style = get_option('wp_footnote_popup_style', 'popup1');
                        $popup_styles = array(
                            'popup1' => __('シンプル（ダーク）', 'wp-footnote'),
                            'popup2' => __('ライト（明るい）', 'wp-footnote'),
                            'popup3' => __('ダーク（濃色）', 'wp-footnote'),
                            'popup4' => __('グラス（半透明）', 'wp-footnote'),
                            'popup5' => __('カラフル（グラデーション）', 'wp-footnote'),
                            'popup6' => __('モダン（サイドライン）', 'wp-footnote'),
                            'popup7' => __('ミニマル（シンプル）', 'wp-footnote'),
                            'popup8' => __('エレガント（高級感）', 'wp-footnote'),
                            'popup9' => __('ソフト（優しい）', 'wp-footnote'),
                            'popup10' => __('シャープ（かっこいい）', 'wp-footnote'),
                            'popup11' => __('3D（立体的）', 'wp-footnote'),
                            'popup12' => __('ネオン（光る）', 'wp-footnote'),
                            'popup13' => __('グラデーションボーダー', 'wp-footnote'),
                            'popup14' => __('フロスト（すりガラス）', 'wp-footnote'),
                            'popup15' => __('ダイナミック（動く）', 'wp-footnote'),
                        );
                        foreach ($popup_styles as $value => $label) {
                            printf(
                                '<option value="%s" %s>%s</option>',
                                esc_attr($value),
                                selected($current_popup_style, $value, false),
                                esc_html($label)
                            );
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('脚注の見出し', 'wp-footnote'); ?></th>
                <td>
                    <input type="text" name="wp_footnote_heading" id="wp_footnote_heading" value="<?php echo esc_attr(get_option('wp_footnote_heading', __('脚注', 'wp-footnote'))); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の見出しとして表示する文字列を設定します。デフォルト: 脚注', 'wp-footnote'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('戻るボタンの文字列', 'wp-footnote'); ?></th>
                <td>
                    <input type="text" name="wp_footnote_return_text" id="wp_footnote_return_text" value="<?php echo esc_attr(get_option('wp_footnote_return_text', '↩')); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の戻るボタンに表示する文字列を設定します。デフォルト: ↩', 'wp-footnote'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('カスタムCSS', 'wp-footnote'); ?></th>
                <td>
                    <textarea name="wp_footnote_custom_css" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('wp_footnote_custom_css', '')); ?></textarea>
                    <p class="description"><?php esc_html_e('脚注のスタイルをカスタマイズするためのCSSを入力してください。', 'wp-footnote'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('脚注一覧の表示', 'wp-footnote'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="wp_footnote_show_list" value="1" <?php checked(get_option('wp_footnote_show_list', true)); ?>>
                        <?php esc_html_e('記事の末尾に脚注一覧を表示する', 'wp-footnote'); ?>
                    </label>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <div class="wp-footnote-preview">
        <h2><?php esc_html_e('プレビュー', 'wp-footnote'); ?></h2>
        <div class="preview-content">
            <div class="preview-article">
                <p>
                    <?php esc_html_e('これは脚注のプレビューです', 'wp-footnote'); ?>
                    <span class="wp-footnote-ref preview-footnote <?php echo esc_attr($current_style . ' ' . $current_popup_style); ?>" id="preview-ref-1" data-footnote="<?php esc_attr_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'wp-footnote'); ?>">
                        <a href="#preview-footnote-1">[1]</a>
                    </span>
                </p>
            </div>
            <div class="wp-footnotes-list">
                <h4 id="preview-heading"><?php echo esc_html(get_option('wp_footnote_heading', __('脚注', 'wp-footnote'))); ?></h4>
                <ol>
                    <li id="preview-footnote-1">
                        <?php esc_html_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'wp-footnote'); ?>
                        <a href="#preview-ref-1" class="footnote-return" id="preview-return">
                            <?php echo esc_html(get_option('wp_footnote_return_text', '↩')); ?>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<style>
/* 管理画面用のスタイル */
.wp-footnote-usage {
    background: #fff;
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.wp-footnote-usage h2 {
    margin-top: 0;
    color: #23282d;
}

.wp-footnote-usage h3 {
    margin: 1.5em 0 1em;
    padding-bottom: 5px;
    border-bottom: 1px solid #eee;
    color: #23282d;
}

.wp-footnote-usage pre {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 4px;
    overflow-x: auto;
}

.wp-footnote-usage ul {
    list-style-type: disc;
    margin-left: 20px;
}

.wp-footnote-usage li {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* プレビュー領域のスタイル */
.wp-footnote-preview {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.wp-footnote-preview h2 {
    margin-top: 0;
    margin-bottom: 20px;
}

.preview-content {
    position: relative;
    min-height: 200px;
    padding: 20px;
    background: #fff;
    border: 1px solid #eee;
    border-radius: 4px;
}

.preview-article {
    margin-bottom: 30px;
}

/* プレビュー用の脚注スタイル上書き */
.preview-content .wp-footnote-ref {
    display: inline-block;
    position: relative;
}

.preview-content .wp-footnote-ref a {
    text-decoration: none;
    color: inherit;
}

.preview-content .wp-footnote-ref::after {
    display: block !important;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.preview-content .wp-footnote-ref:hover::after {
    opacity: 1;
    visibility: visible;
}

/* プレビュー用の脚注一覧スタイル */
.preview-content .wp-footnotes-list {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.preview-content .wp-footnotes-list h4 {
    margin-bottom: 15px;
}

.preview-content .wp-footnotes-list ol {
    margin-left: 20px;
}

.preview-content .wp-footnotes-list li {
    margin-bottom: 10px;
}

.preview-content .footnote-return {
    margin-left: 5px;
    text-decoration: none;
}
</style>

<script>
jQuery(document).ready(function($) {
    // スタイル変更時のプレビュー更新
    function updatePreview() {
        var selectedStyle = $('#wp_footnote_style').val();
        var selectedPopupStyle = $('#wp_footnote_popup_style').val();
        
        $('.preview-footnote')
            .removeClass(function(index, className) {
                return (className.match(/(^|\s)(style|popup)\S+/g) || []).join(' ');
            })
            .addClass(selectedStyle + ' ' + selectedPopupStyle);
    }

    // スタイル変更時のイベントハンドラ
    $('#wp_footnote_style, #wp_footnote_popup_style').on('change', function() {
        updatePreview();
    });

    // 戻るボタンのテキスト変更時のプレビュー更新
    $('#wp_footnote_return_text').on('input', function() {
        $('#preview-return').text($(this).val() || '↩');
    });

    // 脚注の見出し変更時のプレビュー更新
    $('#wp_footnote_heading').on('input', function() {
        $('#preview-heading').text($(this).val() || '脚注');
    });

    // プレビューのクリックイベント
    $('.wp-footnote-preview a').on('click', function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            $('.wp-footnote-preview').animate({
                scrollTop: target.offset().top - $('.wp-footnote-preview').offset().top + $('.wp-footnote-preview').scrollTop()
            }, 500);
        }
    });

    // 初期表示時のプレビュー更新
    updatePreview();
});
</script>