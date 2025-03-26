jQuery(document).ready(function($) {
    // 脚注参照のクリックイベント
    $('.wp-footnote-ref').on('click', function(e) {
        e.preventDefault();
        var targetId = $(this).attr('id').replace('ref-', '');
        var target = $('#' + targetId);
        
        if (target.length) {
            // スムーズスクロール
            $('html, body').animate({
                scrollTop: target.offset().top - 50 // 50pxの余白を確保
            }, 500);
            
            // ハイライト効果
            target.addClass('highlight');
            setTimeout(function() {
                target.removeClass('highlight');
            }, 2000);
        }
    });

    // 戻るリンクのクリックイベント
    $('.footnote-return').on('click', function(e) {
        e.preventDefault();
        var targetId = 'ref-' + $(this).parent().attr('id');
        var target = $('#' + targetId);
        
        if (target.length) {
            // スムーズスクロール
            $('html, body').animate({
                scrollTop: target.offset().top - 50 // 50pxの余白を確保
            }, 500);
            
            // ハイライト効果
            target.addClass('highlight');
            setTimeout(function() {
                target.removeClass('highlight');
            }, 2000);
        }
    });

    // ポップアップの作成
    $('.wp-footnote-ref').each(function() {
        var $ref = $(this);
        var content = $ref.attr('data-footnote');
        var popupId = 'popup-' + $ref.attr('id');
        
        // ポップアップ要素の作成（HTMLをデコード）
        var $popup = $('<div>', {
            id: popupId,
            class: 'footnote-popup ' + $ref.attr('class').replace('wp-footnote-ref', '').trim()
        }).html(content); // .html()を使用してHTMLを適切に処理
        
        // ポップアップの配置
        $ref.append($popup);
    });

    // ホバーイベントの設定
    $('.wp-footnote-ref').hover(
        function() {
            var popupId = 'popup-' + $(this).attr('id');
            $('#' + popupId).addClass('active');
        },
        function() {
            var popupId = 'popup-' + $(this).attr('id');
            $('#' + popupId).removeClass('active');
        }
    );

    // モバイルデバイスでのホバー対応
    if ('ontouchstart' in window) {
        $('.wp-footnote-ref').on('click', function(e) {
            // タッチデバイスでは最初のタップでツールチップを表示
            var $this = $(this);
            if (!$this.hasClass('touched')) {
                e.preventDefault();
                $('.wp-footnote-ref').removeClass('touched');
                $this.addClass('touched');
            }
        });

        // 他の場所をタップしたらツールチップを非表示
        $(document).on('touchstart', function(e) {
            if (!$(e.target).closest('.wp-footnote-ref').length) {
                $('.wp-footnote-ref').removeClass('touched');
            }
        });
    }
});