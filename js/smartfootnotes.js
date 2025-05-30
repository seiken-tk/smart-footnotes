jQuery(document).ready(function($) {
    // 脚注参照のクリックイベント
    $('.smartfootnotes-ref').on('click', function(e) {
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
    var $popupContainer = $('<div>', {
        class: 'footnote-popup-container'
    }).appendTo('body');
    
    $('.smartfootnotes-ref').each(function() {
        var $ref = $(this);
        var content = $ref.attr('data-footnote');
        var popupId = 'popup-' + $ref.attr('id');
        
        // ポップアップ要素の作成（HTMLをデコード）
        var $popup = $('<div>', {
            id: popupId,
            class: 'footnote-popup ' + $ref.attr('class').replace('smartfootnotes-ref', '').trim(),
            'data-ref-id': $ref.attr('id')
        }).html(content); // .html()を使用してHTMLを適切に処理
        
        // ポップアップをコンテナに追加
        $popupContainer.append($popup);
    });

    // ホバーイベントの設定
    $('.smartfootnotes-ref').hover(
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

    // モバイルデバイスでのホバー対応
    if ('ontouchstart' in window) {
        $('.smartfootnotes-ref').on('click', function(e) {
            // タッチデバイスでは最初のタップでツールチップを表示
            var $this = $(this);
            if (!$this.hasClass('touched')) {
                e.preventDefault();
                $('.smartfootnotes-ref').removeClass('touched');
                $('.footnote-popup').removeClass('active');
                $this.addClass('touched');
                
                // ポップアップを表示
                var popupId = 'popup-' + $this.attr('id');
                var $popup = $('#' + popupId);
                
                // ポップアップの位置を参照要素に合わせて調整
                var refOffset = $this.offset();
                var refWidth = $this.outerWidth();
                var popupWidth = $popup.outerWidth();
                
                $popup.css({
                    'top': refOffset.top - $popup.outerHeight() - 10,
                    'left': refOffset.left + (refWidth / 2) - (popupWidth / 2)
                }).addClass('active');
            }
        });

        // 他の場所をタップしたらツールチップを非表示
        $(document).on('touchstart', function(e) {
            if (!$(e.target).closest('.smartfootnotes-ref').length &&
                !$(e.target).closest('.footnote-popup').length) {
                $('.smartfootnotes-ref').removeClass('touched');
                $('.footnote-popup').removeClass('active');
            }
        });
    }
});