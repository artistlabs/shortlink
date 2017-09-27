function ShortLink(options) {
    this.addUrl = options.url;
    this.btnSelector = options.btnSelector;
    this.inputSelector = options.inputSelector;
    this.labelSelector = options.labelSelector;
}

ShortLink.prototype.init = function () {
    var self = this;
    $(this.btnSelector).on('click', function () {
        $.ajax({
            type: 'POST',
            url: self.addUrl,
            data: {
                url: $(self.inputSelector).val()
            }
            ,
            success: function (data, status) {
                var link = $(self.labelSelector);
                link.html(data.url);
                link.attr('href', data.url);

            },
            error: function (data, status) {
                $(self.labelSelector).html(data.statusText);
            }
        })
    });
};
ShortLink.prototype.onClick = function () {

};