define(["builderFragments", "triggerUtilities"], function (builderFragments, triggerUtilities) {
	var _resizeInput = function($this) {
		var text = $this.text();
        $.fn.textWidth = function(text, font) {
		    if (!$.fn.textWidth.fakeEl) $.fn.textWidth.fakeEl = $('<span>').hide().appendTo(document.body);
		    $.fn.textWidth.fakeEl.text(text || this.val() || this.text()).css('font', font || this.css('font'));
		    return $.fn.textWidth.fakeEl.width();
		};

		var width = $this.textWidth();
        $this.css({ 'width': width + 16 });

    };

    return {
    	resizeInput : _resizeInput
    }
});
