<?php
// プラグインのCSSとJSを管理画面にも読み込む
wp_enqueue_style('smartfootnotes', plugins_url('../css/smartfootnotes.css', __FILE__));
?>
<div class="wrap">
    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div class="smartfootnotes-usage">
        <h2><?php esc_html_e('使い方', 'smartfootnotes'); ?></h2>
        <div class="usage-content">
            <h3><?php esc_html_e('脚注の追加方法とカスタマイズ方法', 'smartfootnotes'); ?></h3>
            <p><?php esc_html_e('投稿エディタで以下のようにショートコードを使用します：', 'smartfootnotes'); ?></p>
            <pre>[sfnote]ここに脚注の内容を入力します。[/sfnote]</pre>
            <p><?php esc_html_e('脚注は自動的に番号付けされ、記事内の該当箇所に表示されます。マウスを重ねると脚注の内容がポップアップ表示されます。', 'smartfootnotes'); ?></p>
            <p><?php esc_html_e('下記の設定から、お好みの脚注スタイルとポップアップスタイルを選択できます。', 'smartfootnotes'); ?></p>
        </div>
    </div>

    <form action="options.php" method="post">
        <?php
        settings_fields('smart_footnotes_options');
        do_settings_sections('smart_footnotes_options');
        ?>

        <table class="form-table">
            <tr>
                <th scope="row"><?php esc_html_e('脚注スタイル', 'smartfootnotes'); ?></th>
                <td>
                    <select name="smart_footnotes_style" id="smart_footnotes_style">
                        <?php
                        $current_style = get_option('smart_footnotes_style', 'style1');
                        $styles = array(
                            'style1' => __('デフォルト（シンプル）', 'smartfootnotes'),
                            'style2' => __('角丸グレー', 'smartfootnotes'),
                            'style3' => __('ブラックスクエア', 'smartfootnotes'),
                            'style4' => __('ミニマル細字', 'smartfootnotes'),
                            'style5' => __('黒枠グレー太字', 'smartfootnotes'),
                            'style6' => __('ピンク白抜き', 'smartfootnotes'),
                            'style7' => __('水色', 'smartfootnotes'),
                            'style8' => __('紺', 'smartfootnotes'),
                            'style9' => __('イエロー', 'smartfootnotes'),
                            'style10' => __('シンプルパープル', 'smartfootnotes'),
                            'style11' => __('フラット（マット）', 'smartfootnotes'),
                            'style12' => __('ピンクグラデーション', 'smartfootnotes'),
                            'style13' => __('ブルーライン（下線）', 'smartfootnotes'),
                            'style14' => __('緑ボタン', 'smartfootnotes'),
                            'style15' => __('ネオン（光彩）', 'smartfootnotes'),
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
                <th scope="row"><?php esc_html_e('ポップアップスタイル', 'smartfootnotes'); ?></th>
                <td>
                    <select name="smart_footnotes_popup_style" id="smart_footnotes_popup_style">
                        <?php
                        $current_popup_style = get_option('smart_footnotes_popup_style', 'popup1');
                        $popup_styles = array(
                            'popup1' => __('シンプル（ダーク）', 'smartfootnotes'),
                            'popup2' => __('ライト（明るい）', 'smartfootnotes'),
                            'popup3' => __('ダーク（濃色）', 'smartfootnotes'),
                            'popup4' => __('グラス（半透明）', 'smartfootnotes'),
                            'popup5' => __('カラフル（グラデーション）', 'smartfootnotes'),
                            'popup6' => __('モダン（サイドライン）', 'smartfootnotes'),
                            'popup7' => __('ミニマル（シンプル）', 'smartfootnotes'),
                            'popup8' => __('エレガント（高級感）', 'smartfootnotes'),
                            'popup9' => __('ソフト（優しい）', 'smartfootnotes'),
                            'popup10' => __('シャープ（かっこいい）', 'smartfootnotes'),
                            'popup11' => __('3D（立体的）', 'smartfootnotes'),
                            'popup12' => __('ネオン（光る）', 'smartfootnotes'),
                            'popup13' => __('グラデーションボーダー', 'smartfootnotes'),
                            'popup14' => __('フロスト（すりガラス）', 'smartfootnotes'),
                            'popup15' => __('ダイナミック（動く）', 'smartfootnotes'),
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
                <th scope="row"><?php esc_html_e('脚注の見出し', 'smartfootnotes'); ?></th>
                <td>
                    <input type="text" name="smart_footnotes_heading" id="smart_footnotes_heading" value="<?php echo esc_attr(get_option('smart_footnotes_heading', __('脚注', 'smartfootnotes'))); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の見出しとして表示する文字列を設定します。デフォルト: 脚注', 'smartfootnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('戻るボタンの文字列', 'smartfootnotes'); ?></th>
                <td>
                    <input type="text" name="smart_footnotes_return_text" id="smart_footnotes_return_text" value="<?php echo esc_attr(get_option('smart_footnotes_return_text', '↩')); ?>" class="regular-text">
                    <p class="description"><?php esc_html_e('脚注一覧の戻るボタンに表示する文字列を設定します。デフォルト: ↩', 'smartfootnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('カスタムCSS', 'smartfootnotes'); ?></th>
                <td>
                    <textarea name="smart_footnotes_custom_css" rows="10" cols="50" class="large-text code"><?php echo esc_textarea(get_option('smart_footnotes_custom_css', '')); ?></textarea>
                    <p class="description"><?php esc_html_e('脚注のスタイルをカスタマイズするためのCSSを入力してください。', 'smartfootnotes'); ?></p>
                </td>
            </tr>
            <tr>
                <th scope="row"><?php esc_html_e('脚注一覧の表示', 'smartfootnotes'); ?></th>
                <td>
                    <label>
                        <input type="checkbox" name="smart_footnotes_show_list" value="1" <?php checked(get_option('smart_footnotes_show_list', true)); ?>>
                        <?php esc_html_e('記事の末尾に脚注一覧を表示する', 'smartfootnotes'); ?>
                    </label>
                </td>
            </tr>
        </table>

        <?php submit_button(); ?>
    </form>

    <div class="smartfootnotes-preview">
        <h2><?php esc_html_e('プレビュー', 'smartfootnotes'); ?></h2>
        <div class="preview-content">
            <div class="preview-article">
                <p>
                    <?php esc_html_e('これは脚注のプレビューです', 'smartfootnotes'); ?>
                    <span class="smartfootnotes-ref preview-footnote <?php echo esc_attr($current_style . ' ' . $current_popup_style); ?>" id="preview-ref-1" data-footnote="<?php esc_attr_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'smartfootnotes'); ?>">
                        <a href="#preview-footnote-1">[1]</a>
                    </span>
                </p>
            </div>
            <div class="smartfootnotes-list">
                <h4 id="preview-heading"><?php echo esc_html(get_option('smart_footnotes_heading', __('脚注', 'smartfootnotes'))); ?></h4>
                <ol>
                    <li id="preview-footnote-1">
                        <?php esc_html_e('これは脚注の例です。スタイルを変更すると、このプレビューにリアルタイムで反映されます。', 'smartfootnotes'); ?>
                        <a href="#preview-ref-1" class="footnote-return" id="preview-return">
                            <?php echo esc_html(get_option('smart_footnotes_return_text', '↩')); ?>
                        </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
</div>

<style>
/* 管理画面用のスタイル */
.smartfootnotes-usage {
    background: #fff;
    padding: 20px;
    margin: 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.smartfootnotes-usage h2 {
    margin-top: 0;
    color: #23282d;
}

.smartfootnotes-usage h3 {
    margin: 1.5em 0 1em;
    padding-bottom: 5px;
    border-bottom: 1px solid #eee;
    color: #23282d;
}

.smartfootnotes-usage pre {
    background: #f5f5f5;
    padding: 15px;
    border-radius: 4px;
    overflow-x: auto;
}

.smartfootnotes-usage ul {
    list-style-type: disc;
    margin-left: 20px;
}

.smartfootnotes-usage li {
    margin-bottom: 10px;
    line-height: 1.5;
}

/* プレビュー領域のスタイル */
.smartfootnotes-preview {
    margin-top: 30px;
    padding: 20px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 4px;
}

.smartfootnotes-preview h2 {
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
.preview-content .smartfootnotes-ref {
    display: inline-block;
    position: relative;
}

.preview-content .smartfootnotes-ref a {
    text-decoration: none;
    color: inherit;
}

.preview-content .smartfootnotes-ref::after {
    display: block !important;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s, visibility 0.3s;
}

.preview-content .smartfootnotes-ref:hover::after {
    opacity: 1;
    visibility: visible;
}

/* プレビュー用の脚注一覧スタイル */
.preview-content .smartfootnotes-list {
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #ddd;
}

.preview-content .smartfootnotes-list h4 {
    margin-bottom: 15px;
}

.preview-content .smartfootnotes-list ol {
    margin-left: 20px;
}

.preview-content .smartfootnotes-list li {
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
        var selectedStyle = $('#smart_footnotes_style').val();
        var selectedPopupStyle = $('#smart_footnotes_popup_style').val();
        
        $('.preview-footnote')
            .removeClass(function(index, className) {
                return (className.match(/(^|\s)(style|popup)\S+/g) || []).join(' ');
            })
            .addClass(selectedStyle + ' ' + selectedPopupStyle);
            
        // ポップアップの更新
        updatePopup();
    }
    
    // ポップアップの作成と更新
    function updatePopup() {
        // 既存のポップアップコンテナを削除
        $('.admin-footnote-popup-container').remove();
        
        // ポップアップコンテナの作成
        var $popupContainer = $('<div>', {
            class: 'admin-footnote-popup-container footnote-popup-container'
        }).appendTo('body');
        
        // プレビュー用の脚注参照にポップアップを追加
        $('.preview-footnote').each(function() {
            var $ref = $(this);
            var content = $ref.attr('data-footnote');
            var popupId = 'popup-' + $ref.attr('id');
            
            // ポップアップ要素の作成
            var $popup = $('<div>', {
                id: popupId,
                class: 'footnote-popup ' + $ref.attr('class').replace('smartfootnotes-ref preview-footnote', '').trim(),
                'data-ref-id': $ref.attr('id')
            }).html(content);
            
            // ポップアップをコンテナに追加
            $popupContainer.append($popup);
        });
        
        // ホバーイベントの設定
        $('.preview-footnote').hover(
            function() {
                var $ref = $(this);
                var popupId = 'popup-' + $ref.attr('id');
                var $popup = $('#' + popupId);
                
                // ポップアップの位置を参照要素に合わせて調整
                var refOffset = $ref.offset();
                var refWidth = $ref.outerWidth();
                var popupWidth = $popup.outerWidth();
                
                $popup.css({
                    'top': refOffset.top - $popup.outerHeight() - 10,
                    'left': refOffset.left + (refWidth / 2) - (popupWidth / 2)
                }).addClass('active');
            },
            function() {
                var popupId = 'popup-' + $(this).attr('id');
                $('#' + popupId).removeClass('active');
            }
        );
    }

    // スタイル変更時のイベントハンドラ
    $('#smart_footnotes_style, #smart_footnotes_popup_style').on('change', function() {
        updatePreview();
    });

    // 戻るボタンのテキスト変更時のプレビュー更新
    $('#smart_footnotes_return_text').on('input', function() {
        $('#preview-return').text($(this).val() || '↩');
    });

    // 脚注の見出し変更時のプレビュー更新
    $('#smart_footnotes_heading').on('input', function() {
        $('#preview-heading').text($(this).val() || '脚注');
    });

    // プレビューのクリックイベント
    $('.smartfootnotes-preview a').on('click', function(e) {
        e.preventDefault();
        var target = $($(this).attr('href'));
        if (target.length) {
            $('.smartfootnotes-preview').animate({
                scrollTop: target.offset().top - $('.smartfootnotes-preview').offset().top + $('.smartfootnotes-preview').scrollTop()
            }, 500);
        }
    });

    // 初期表示時のプレビュー更新
    updatePreview();
});
</script>