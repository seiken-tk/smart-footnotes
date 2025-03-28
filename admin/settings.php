<?php
// プラグインのCSSとJSを管理画面にも読み込む
wp_enqueue_style('simple-footnotes', plugins_url('../css/simple-footnotes.css', __FILE__));
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="simple-footnotes-usage">
        <h2><?php esc_html_e('使い方', 'simple-footnotes'); ?></h2>
        <div class="usage-content">
            <h3><?php esc_html_e('1. 脚注の追加', 'simple-footnotes'); ?></h3>
            <p><?php esc_html_e('投稿エディタで以下のようにショートコードを使用します：', 'simple-footnotes'); ?></p>
            <pre>[sfnote]ここに脚注の内容を入力します。[/sfnote]</pre>
            
            <h3><?php esc_html_e('2. 脚注の表示', 'simple-footnotes'); ?></h3>
            <ul>
                <li><?php esc_html_e('脚注は自動的に番号付けされ、記事内の該当箇所に表示されます。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('脚注番号にマウスを重ねると、脚注の内容がポップアップ表示されます。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('脚注番号をクリックすると、記事末尾の脚注一覧の該当箇所にスクロールします。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('脚注一覧の戻るボタンをクリックすると、元の位置に戻ります。', 'simple-footnotes'); ?></li>
            </ul>

            <h3><?php esc_html_e('3. カスタマイズ', 'simple-footnotes'); ?></h3>
            <ul>
                <li><?php esc_html_e('下記の設定から、お好みの脚注スタイルとポップアップスタイルを選択できます。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('カスタムCSSを使用して、独自のスタイルを適用することもできます。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('脚注一覧の表示/非表示を切り替えることができます。', 'simple-footnotes'); ?></li>
                <li><?php esc_html_e('脚注一覧の戻るボタンの文字列を変更できます。', 'simple-footnotes'); ?></li>
            </ul>
        </div>
    </div>

    <form action="options.php" method="post">
        <?php
        settings_fields('simple_footnotes_options');
        do_settings_sections('simple_footnotes_options');
        ?>

        <table class="form-table">
            <tr>
                <th scope="row"><?php esc_html_e('脚注スタイル', 'simple-footnotes'); ?></th>
                <td>
                    <select name="simple_footnotes_style" id="simple_footnotes_style">
                        <?php
                        $current_style = get_option('simple_footnotes_style', 'style1');
                        $styles = array(
                            'style1' => __('デフォルト（シンプル）', 'simple-footnotes'),
                            'style2' => __('角丸グレー', 'simple-footnotes'),
                            'style3' => __('ブラックスクエア', 'simple-footnotes'),
                            'style4' => __('ミニマル細字', 'simple-footnotes'),
                            'style5' => __('黒枠グレー太字', 'simple-footnotes'),
                            'style6' => __('ピンク白抜き', 'simple-footnotes'),
                            'style7' => __('水色', 'simple-footnotes'),
                            'style8' => __('紺', 'simple-footnotes'),
                            'style9' => __('イエロー', 'simple-footnotes'),
                            'style10' => __('シンプルパープル', 'simple-footnotes'),
                            'style11' => __('フラット（マット）', 'simple-footnotes'),
                            'style12' => __('ピンクグラデーション', 'simple-footnotes'),
                            'style13' => __('ブルーライン（下線）', 'simple-footnotes'),
                            'style14' => __('緑ボタン', 'simple-footnotes'),
                            'style15' => __('ネオン（光彩）', 'simple-footnotes'),
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
                <th scope="row"><?php esc_html_e('ポップアップスタイル', 'simple-footnotes'); ?></th>
                <td>
                    <select name="simple_footnotes_popup_style" id="simple_footnotes_popup_style">
                        <?php
                        $current_popup_style = get_option('simple_footnotes_popup_style', 'popup1');
                        $popup_styles = array(
                            'popup1' => __('シンプル（ダーク）', 'simple-footnotes'),
                            'popup2' => __('ライト（明るい）', 'simple-footnotes'),
                            'popup3' => __('ダーク（濃色）', 'simple-footnotes'),
                            'popup4' => __('グラス（半透明）', 'simple-footnotes'),
                            'popup5' => __('カラフル（グラデーション）', 'simple-footnotes'),
                            'popup6' => __('モダン（サイドライン）', 'simple-footnotes'),
                            'popup7' => __('ミニマル（シンプル）', 'simple-footnotes'),
                            'popup8' => __('エレガント（高級感）', 'simple-footnotes'),
                            'popup9' => __('ソフト（優しい）', 'simple-footnotes'),
                            'popup10' => __('シャープ（かっこいい）', 'simple-footnotes'),
                            'popup11' => __('3D（立体的）', 'simple-footnotes'),
                            'popup12' => __('ネオン（光る）', 'simple-footnotes'),
                            'popup13' => __('グラデーションボーダー', 'simple-footnotes'),
                            'popup14' => __('フロスト（すりガラス）', 'simple-footnotes'),
                            'popup15' => __('ダイナミック（動く）', 'simple-footnotes'),
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
                <th scope="row"><?php esc_html_e('脚注の見出し', 'simple-footnotes'); ?></th>
                <td>
                    <input type="text" name="simple_footnotes_heading" id="simple_footnotes_heading" value="<?php echo esc_attr(get_option('simple_footnotes_heading', __('脚注', 'simple-footnotes'))); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の見出しとして表示する文字列を設定します。デフォルト: 脚注', 'simple-footnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('戻るボタンの文字列', 'simple-footnotes'); ?></th>
                <td>
                    <input type="text" name="simple_footnotes_return_text" id="simple_footnotes_return_text" value="<?php echo esc_attr(get_option('simple_footnotes_return_text', '↩')); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の戻るボタンに表示する文字列を設定します。デフォルト: ↩', 'simple-footnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('カスタムCSS', 'simple-footnotes'); ?></th>
                <td>
                    <textarea name="simple_footnotes_custom_css" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('simple_footnotes_custom_css', '')); ?></textarea>
                    <p class="description"><?php esc_html_e('脚注のスタイルをカスタマイズするためのCSSを入力してください。', 'simple-footnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('脚注一覧の表示', 'simple-footnotes'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="simple_footnotes_show_list" value="1" <?php checked(get_option('simple_footnotes_show_list', true)); ?>>
                        <?php esc_html_e('記事の末尾に脚注一覧を表示する', 'simple-footnotes'); ?>
                    </label>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <div class="simple-footnotes-preview">
        <h2><?php esc_html_e('プレビュー', 'simple-footnotes'); ?></h2>
        <div class="preview-content">
            <div class="preview-article">
                <p>
                    <?php esc_html_e('これは脚注のプレビューです', 'simple-footnotes'); ?>
                    <span class="simple-footnotes-ref preview-footnote <?php echo esc_attr($current_style . ' ' . $current_popup_style); ?>" id="preview-ref-1" data-footnote="<?php esc_attr_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'simple-footnotes'); ?>">
                        <a href="#preview-footnote-1">[1]</a>
                    </span>
                </p>
            </div>
            <div class="simple-footnotes-list">
                <h4 id="preview-heading"><?php echo esc_html(get_option('simple_footnotes_heading', __('脚注', 'simple-footnotes'))); ?></h4>
                <ol>
                    <li id="preview-footnote-1">
                        <?php esc_html_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'simple-footnotes'); ?>
                        <a href="#preview-ref-1" class="footnote-return" id="preview-return">
                            <?php echo esc_html(get_option('simple_footnotes_return_text', '↩')); ?>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<style>
/* 管理画面用のスタイル */
.simple-footnotes-usage {
    background: #fff;
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.simple-footnotes-usage h2 {
    margin-top: 0;
    color: #23282d;
}

.simple-footnotes-usage h3 {
    margin: 1.5em 0 1em;
    padding-bottom: 5px;
    border-bottom: 1px solid #eee;
    color: #23282d;
}

.simple-footnotes-usage pre {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 4px;
    overflow-x: auto;
}

.simple-footnotes-usage ul {
    list-style-type: disc;
    margin-left: 20px;
}

.simple-footnotes-usage li {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* プレビュー領域のスタイル */
.simple-footnotes-preview {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.simple-footnotes-preview h2 {
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
.preview-content .simple-footnotes-ref {
    display: inline-block;
    position: relative;
}

.preview-content .simple-footnotes-ref a {
    text-decoration: none;
    color: inherit;
}

.preview-content .simple-footnotes-ref::after {
    display: block !important;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.preview-content .simple-footnotes-ref:hover::after {
    opacity: 1;
    visibility: visible;
}

/* プレビュー用の脚注一覧スタイル */
.preview-content .simple-footnotes-list {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.preview-content .simple-footnotes-list h4 {
    margin-bottom: 15px;
}

.preview-content .simple-footnotes-list ol {
    margin-left: 20px;
}

.preview-content .simple-footnotes-list li {
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
        var selectedStyle = $('#simple_footnotes_style').val();
        var selectedPopupStyle = $('#simple_footnotes_popup_style').val();
        
        $('.preview-footnote')
            .removeClass(function(index, className) {
                return (className.match(/(^|\s)(style|popup)\S+/g) || []).join(' ');
            })
            .addClass(selectedStyle + ' ' + selectedPopupStyle);
    }

    // スタイル変更時のイベントハンドラ
    $('#simple_footnotes_style, #simple_footnotes_popup_style').on('change', function() {
        updatePreview();
    });

    // 戻るボタンのテキスト変更時のプレビュー更新
    $('#simple_footnotes_return_text').on('input', function() {
        $('#preview-return').text($(this).val() || '↩');
    });

    // 脚注の見出し変更時のプレビュー更新
    $('#simple_footnotes_heading').on('input', function() {
        $('#preview-heading').text($(this).val() || '脚注');
    });

    // プレビューのクリックイベント
    $('.simple-footnotes-preview a').on('click', function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            $('.simple-footnotes-preview').animate({
                scrollTop: target.offset().top - $('.simple-footnotes-preview').offset().top + $('.simple-footnotes-preview').scrollTop()
            }, 500);
        }
    });

    // 初期表示時のプレビュー更新
    updatePreview();
});
</script>