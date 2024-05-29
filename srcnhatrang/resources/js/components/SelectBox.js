class SelectBox {
    constructor(selectElement) {
        this.selectElement = selectElement;
        this.numOfOptions = this.selectElement.children('option').length;
        this.$selectLabel = null;
        this.$cusList = null;
        this.bindOpenList = this.openList.bind(this);
        this.bindCloseList = this.closeList.bind(this);
    }

    createSelectBox() {
        // Hide select tag
        this.selectElement.addClass('s-hidden');

        // Wrapping default selectbox into custom select block
        this.selectElement.wrap('<div class="cusSelBlock"></div>');

        // Creating custom select div
        this.$selectLabel = $('<div class="selectLabel"></div>').insertAfter(this.selectElement);
        this.$selectLabel.text(this.selectElement.children('option').eq(0).text());

        // Appending options to custom un-ordered list tag
        this.$cusList = $('<ul/>', { 'class': 'options'}).insertAfter(this.$selectLabel);
        for (let i = 0; i < this.numOfOptions; i++) {
            $('<li/>', {
                text: this.selectElement.children('option').eq(i).text(),
                rel: this.selectElement.children('option').eq(i).val()
            }).appendTo(this.$cusList);
        }
    }

    init() {
        this.createSelectBox();
        // Click event functions
        this.$selectLabel.click(() => {
            this.toggleSelect();
        });

        this.$cusList.on('keypress click', 'li', (e) => {
            e.preventDefault();
            this.selectItem($(e.currentTarget));
        });
    }

    toggleSelect() {
        this.$selectLabel.toggleClass('active');
        if (this.$selectLabel.hasClass('active')) {
            this.bindOpenList();
            this.focusItems();
        } else {
            this.bindCloseList();
        }
    }

    selectItem($item) {
        this.$cusList.find('li').removeClass();
        this.bindCloseList();
        this.$selectLabel.removeClass('active');
        this.$selectLabel.text($item.text());
        this.selectElement.val($item.text());
        $('.selected-item p span').text(this.$selectLabel.text());
    }

    openList() {
        this.$cusList.children('li').each((i, el) => {
            $(el).attr('tabindex', i).css({
                'transform': 'translateY(' + (i * 100 + 100) + '%)',
                'transition-delay': i * 30 + 'ms'
            });
        });
    }

    closeList() {
        this.$cusList.children('li').each((i, el) => {
            $(el).css({
                'transform': 'translateY(' + i * 0 + 'px)',
                'transition-delay': i * 0 + 'ms'
            });
        });
        this.$cusList.children('li').eq(1).css('transform', 'translateY(' + 2 + 'px)');
        this.$cusList.children('li').eq(2).css('transform', 'translateY(' + 4 + 'px)');
    }

    focusItems() {
        this.$cusList.on('focus', 'li', function() {
            $(this).addClass('active').siblings().removeClass();
        }).on('keydown', 'li', function(e) {
            if (e.keyCode == 40) {
                $(this).next().focus();
                return false;
            } else if (e.keyCode == 38) {
                $(this).prev().focus();
                return false;
            }
        }).find('li').first().focus();
    }
}

new SelectBox($('.select-box')).init()
